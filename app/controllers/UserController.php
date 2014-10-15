<?php
class UserController extends BaseController {
    public function showLogin()
    {
        if(Sentry::check())
        {
            $this->data['page'] = 'profile';
            return View::make("profile", $this->data);
        }
        else
        {
            $this->data['page'] = 'login';
            return View::make("login", $this->data);
        }
    }

    public function showRegister()
    {
        if(Sentry::check())
        {
            $this->data['page'] = 'profile';
            return View::make("profile", $this->data);
        }
        else
        {
            $this->data['page'] = 'register';
            return View::make("register", $this->data);
        }
    }

    public function activate($userId, $code)
    {
        try
        {
            // Find the user using the user id
            $user = Sentry::findUserById($userId);

            // Attempt to activate the user
            if ($user->attemptActivation($code))
            {
                // User activation passed
                return Redirect::to('/login')->with('success', true)->with('message', 'Your account is now activated. You can now login!');
            }
            else
            {
                // User activation failed
                return Redirect::to('/login')->with('error', true)->with('message', 'We could not activate that user. Please write our support at alex@youngandcreative.de about your problem.');
            }
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Redirect::to('/login')->with('error', true)->with('message', 'We could not find any users for that activation code.');
        }
        catch (Cartalyst\Sentry\Users\UserAlreadyActivatedException $e)
        {
            return Redirect::to('/login')->with('error', true)->with('message', 'This user is already activated. Please login! :-)');
        }
    }

    public function processRegister()
    {
        try
        {
            // Let's register a user.
            $user = Sentry::register([
                 'email'    => Input::get('email'),
                 'password' => Input::get('password'),
                 'username' => Input::get('username'),
            ]);

            // Let's get the activation code
            $activationCode = $user->getActivationCode();

            // Send activation code to the user so he can activate the account
            Mail::send('emails.auth.activation', ['code' => $activationCode, 'userId' => $user->getId() ], function($message)
            {
                $message->from('register@android-libs.com', "Android-Libs.com");
                $message->to(Input::get('email'), Input::get('username'))->subject('Android-Libs.com - Activate your account!');
            });

            return Redirect::to('/login')->with('success', true)->with('message', 'Thank you for registration. Please check your E-Mail Account to activate your account. <strong>Make sure to check out your Spam Folder!</strong>');

        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            return Redirect::to('/login')->with('error', true)->with('message', 'The login field is required.');
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            return Redirect::to('/login')->with('error', true)->with('message', 'The password field is required.');
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            return Redirect::to('/login')->with('error', true)->with('message', 'A user with this username already exists. Please choose another one!');
        }
    }

    public function processLogin()
    {
        $credentials = [
            "username"  => Input::get('username'),
            "password" => Input::get('password')
        ];
        try {
            $oUser = Sentry::authenticate($credentials, Input::get('remember', false));
            return Redirect::to('/')->with('success', true)->with('message', 'Welcome back, ' . $oUser->username . '!');
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            return Redirect::to('/login')->with('error', true)->with('message', 'The login field is required.');
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            return Redirect::to('/login')->with('error', true)->with('message', 'The password field is required.');
        }
        catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            return Redirect::to('/login')->with('error', true)->with('message', 'You have entered a wrong username or password.');
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Redirect::to('/login')->with('error', true)->with('message', 'You have entered a wrong username or password.');
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            return Redirect::to('/login')->with('error', true)->with('message', 'This user is not activated. Please check your E-Mail Account.');
        }
    }

    public function logout()
    {
        Sentry::logout();
        return Redirect::to('/')->with('success', true)->with('message', 'You sucessfully logged out.');
    }

    public function forgotPassword()
    {
        try
        {
            // Find the user using the user email address
            $user = Sentry::findUserByLogin(Input::get('email'));

            // Get the password reset code
            $resetCode = $user->getResetPasswordCode();

            Mail::send('emails.auth.reminder', ['token' => $resetCode], function($message)
            {
                $message->to('foo@example.com', 'John Smith')->subject('Welcome!');
            });

            // Now you can send this code to your user via email for example.

            return Redirect::to('/login')->with('success', true)->with('message', 'Please check your e-mail account for further instructions.');
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Redirect::to('/login')->with('error', true)->with('message', 'We could not find that e-mail address.');
        }
    }

}