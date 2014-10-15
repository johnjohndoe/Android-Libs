<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/assets/img/favicon.ico') }}" rel="icon" type="image/x-icon" />
    <title>AndroidLibs</title>

    <!-- Bootstrap CSS served from a CDN -->
    {{ HTML::style('assets/css/pixeladmin/bootstrap.css') }}
    {{ HTML::style('assets/css/pixeladmin/pixel-admin.css') }}
    {{ HTML::style('assets/css/pixeladmin/widgets.css') }}
    {{ HTML::style('assets/css/pixeladmin/rtl.css') }}
    {{ HTML::style('assets/css/pixeladmin/themes.css') }}
    {{ HTML::style('assets/css/pixeladmin/pages.css') }}
    {{ HTML::style('http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') }}
    {{ HTML::style('assets/css/chosen.min.css') }}
    {{ HTML::style('assets/css/chosen.bootstrap.css') }}
    {{ HTML::style('//cdn.datatables.net/plug-ins/be7019ee387/integration/bootstrap/3/dataTables.bootstrap.css') }}
    {{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:100,300,600') }}
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script>
        var baseUrl = "{{ url('/') }}";
        var init = [];
    </script>

    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-52515505-1', 'auto');
        ga('send', 'pageview');

    </script>
    {{ HTML::style('assets/css/template.css') }}
</head>

@if($page == 'login')
<body class="theme-clean no-main-menu page-signin-alt">
@elseif($page == 'register')
<body class="theme-clean no-main-menu page-signup-alt">
@else
<body class="no-main-menu theme-clean dont-animate-mm-content-sm animate-mm-md animate-mm-lg">
@endif
<div id="main-wrapper">


    <div id="main-navbar" class="navbar navbar-inverse" role="navigation">
    <!-- Main menu toggle -->
    <button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">HIDE MENU</span>
    </button>

    <div class="navbar-inner">
    <!-- Main navbar header -->
    <div class="navbar-header">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="navbar-brand">
            <div><img alt="Pixel Admin" src="{{ asset('/assets/img/navbar_logo.png') }}"></div>
            Android-Libs
        </a>

        <!-- Main navbar toggle -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i
                class="navbar-icon fa fa-bars"></i></button>

    </div>
    <!-- / .navbar-header -->

    <div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
    <div>
    <ul class="nav navbar-nav">
        <li>
            <a href="{{ url('/') }}"><i class="fa fa-fw fa-list"></i> LIBRARIES</a>
        </li>
        <li>
            <a href="{{ url('/submit') }}"><i class="fa fa-fw fa-envelope"></i> SUBMIT A LIBRARY</a>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown"><i class="fa fa-fw fa-share-alt"></i> Share</a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#" class="sharrre-counters btn-labeled" data-text="Cool library list! @Android_Libs" data-url="{{ url('/') }}" data-share="facebook">
                        <i class="fa fa-fw fa-facebook"></i> Facebook
                    </a>
                </li>
                <li>
                    <a href="#" class="sharrre-counters twitter btn-labeled" data-text="Cool library list! @Android_Libs" data-url="{{ url('/') }}" data-share="twitter">
                        <i class="fa fa-fw fa-twitter"></i> Twitter
                    </a>
                </li>
                <li>
                    <a href="#" class="sharrre-counters gplus btn-labeled" data-text="Cool library list! @Android_Libs" data-url="{{ url('/') }}" data-share="gplus">
                        <i class="fa fa-fw fa-google-plus"></i> Google+
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="http://twitter.com/AlexMahrt" target="_blank"><i class="fa fa-fw fa-twitter"></i> Made by AlexMahrt</a>
        </li>
        @if( Sentry::check() )
        <li class="dropdown">
            <a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
                <img src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=25">
                <span>{{ Sentry::getUser()->username }} <i class="fa fa-fw fa-caret-down"></i> </span>
            </a>
            <ul class="dropdown-menu">
                @if( Sentry::getUser()->hasAnyAccess([ 'admin' ]) )
                <li><a href="{{ url('/admin') }}"><i class="fa fa-fw fa-star dropdown-icon"></i> Administration</a></li>
                @endif
                <li class="divider"></li>
                <li><a href="{{ url('/logout') }}"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
            </ul>
        </li>
        @else
        <li><a href="{{ url('/login') }}"><i class="fa fa-fw fa-sign-in"></i> Sign in</a></li>
        <li><a href="{{ url('/register') }}"><i class="fa fa-fw fa-check"></i> Sign up</a></li>
        @endif
    </ul>
    <!-- / .navbar-nav -->

    <div class="right clearfix">
    <ul class="nav navbar-nav pull-right right-navbar-nav">

    <!-- 3. $NAVBAR_ICON_BUTTONS =======================================================================

                                Navbar Icon Buttons

                                NOTE: .nav-icon-btn triggers a dropdown menu on desktop screens only. On small screens .nav-icon-btn acts like a hyperlink.

                                Classes:
                                * 'nav-icon-btn-info'
                                * 'nav-icon-btn-success'
                                * 'nav-icon-btn-warning'
                                * 'nav-icon-btn-danger'
    -->
    <!-- /3. $END_NAVBAR_ICON_BUTTONS -->
    {{--

    <li>
        <form class="navbar-form search-libs-form pull-left">
            <input type="text" class="form-control" placeholder="Search">
        </form>
    </li>
    --}}



    </ul>
    <!-- / .navbar-nav -->
    </div>
    <!-- / .right -->
    </div>
    </div>
    <!-- / #main-navbar-collapse -->
    </div>
    <!-- / .navbar-inner -->
    </div>


    @include('alerts')
    <div class="content-wrapper">
        @yield('content')
    </div>

</div>

{{ HTML::script('assets/js/bootstrap.min.js') }}
{{ HTML::script('assets/js/bootbox.min.js') }}
{{ HTML::script('assets/js/bootstrap.maxlength.js') }}
{{ HTML::script('assets/js/chosen.jquery.min.js') }}
{{ HTML::script('assets/js/starrr.jquery.js') }}
{{ HTML::script('//cdn.datatables.net/1.10.0/js/jquery.dataTables.js') }}
{{ HTML::script('//cdn.datatables.net/plug-ins/be7019ee387/integration/bootstrap/3/dataTables.bootstrap.js') }}
{{ HTML::script('assets/js/ie.min.js') }}
{{ HTML::script('assets/js/sharrre.js') }}
{{ HTML::script('assets/js/pixel-admin.js') }}


{{ HTML::script('assets/js/app.js') }}
</body>
</html>