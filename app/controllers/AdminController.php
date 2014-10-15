<?php


class AdminController extends BaseController {
    public function showAdmin()
    {
        if(Sentry::check())
        {
            $this->data['page'] = 'admin';
            $this->data["public_libraries"]    = Libraries::where('public', '=', true)->get();
            $this->data["submitted_libraries"] = Libraries::where('public', '=', false)->get();
            return View::make("admin", $this->data);
        }
        else
        {
            return Redirect::to("login")->with('error', true)->with('message','You must be logged in as an administrator.');
        }
    }

    /*
     * Add new library
     */
    function addLibrary()
    {
        $sInputTitle            = Input::get('inputTitle');
        $sInputGithub           = Input::get('inputGithub');
        $sInputShortDesc        = Input::get('inputShortDesc');
        $sInputLongDesc         = Input::get('inputLongDesc');
        $oInputImage            = Input::file('inputImage');
        $sImageMime             = $oInputImage->getMimeType();
        $sImageGuid             = md5( md5( microtime() ) . md5(microtime() + microtime()) );
        $aAcceptedMimes         = [ "image/png", "image/jpeg" ];

        if(in_array($sImageMime, $aAcceptedMimes))
        {
            $sImageExtension = "";
            if($sImageMime == "image/png")
            {
                $sImageExtension = ".png";
            }
            else
            {
                $sImageExtension = ".jpg";
            }

            $oLib = new Libraries;
            $oLib->title            = $sInputTitle;
            $oLib->github           = $sInputGithub;
            $oLib->short_desc       = $sInputShortDesc;
            $oLib->long_desc        = $sInputLongDesc;
            $oLib->public           = true;
            $oLib->img              = $sImageGuid;
            $oLib->img_ext          = $sImageExtension;
            $oLib->submittor_email  = "mahrt95@gmail.com";
            $oLib->save();


            $oInputImage->move(public_path() . '/assets/img/libs/', $sImageGuid . $sImageExtension);

            return Redirect::to('admin#add')->with('success', true)->with('message', "Library was successfully added!");
        }
        else
        {
            return Redirect::to('admin#add')->with('error', true)->with('message', "We only accept .png or .jpg as file formats.");
        }
    }

    /*
     * Accept library
     */
    function acceptLibrary($id)
    {
        Session::set('LibraryId', $id);
        $oLib = Libraries::find($id);
        $oLib->public = true;
        $oLib->save();

        Mail::send('emails.accepted', [], function($message)
        {
            $oLib = Libraries::find(Session::get('LibraryId'));
            $message->from('submit@android-libs.com', "Android-Libs");
            $message->to($oLib->submittor_email, 'AndroidLibs Submitter')->subject("Your AndroidLibs library '" . $oLib->title . "' has been accepted");
        });

        return Redirect::to('admin#submitted-libs')->with('success', true)->with('message', "Library was successfully accepted!");
    }

    /*
     * Decline library
     */
    function declineLibrary($id, $reason)
    {
        Session::set('LibraryId', $id);

        $oLib = Libraries::find($id);
        //Delete Image
        File::delete(public_path() . '/assets/img/libs/' . $oLib->img . $oLib->img_ext);

        Mail::send('emails.declined', [ "reason" => $reason], function($message)
        {
            $oLib       = Libraries::find(Session::get('LibraryId'));
            $message->from('submit@android-libs.com', "Android-Libs");
            $message->to($oLib->submittor_email, 'AndroidLibs Submitter')->subject("Your AndroidLibs library '" . $oLib->title . "' was declined");
        });

        $oLib->delete();
        return Redirect::to('admin#submitted-libs')->with('success', true)->with('message', "Library was successfully declined!");
    }

    /*
     * Remove library
     */
    function removeLibrary($id)
    {
        $oLib = Libraries::find($id);
        //Delete Image
        File::delete(public_path() . '/assets/img/libs/' . $oLib->img . $oLib->img_ext);
        $oLib->delete();
        return Redirect::to('admin#public-libs')->with('success', true)->with('message', "Library was successfully removed!");
    }
} 