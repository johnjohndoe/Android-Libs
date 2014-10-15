@extends('layout')

@section('content')

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm">{{ $oLib->title }} / <span class="text-light-gray">{{ $oLib->categories->name }}</span></h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row hidden-xs">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
                <div class="pull-right col-xs-12 col-sm-auto">

                    @if($oLib->isGitHubUrl())
                    <a href="{{ $oLib->url }}" class="btn btn-default btn-labeled" target="_blank">
                        <span class="btn-label icon fa fa-github"></span> To GitHub website
                    </a>
                    @else
                    <a href="{{ $oLib->url }}" class="btn btn-default btn-labeled" target="_blank">
                        <span class="btn-label icon fa fa-globe"></span> To libraries website
                    </a>
                    @endif

                    {{--<a href="{{ Sentry::check() ? '#' : url('/login') }}" class="btn btn-primary btn-labeled btn-like"--}}
                    <a href="#" class="btn btn-primary btn-labeled btn-like"
                        onclick="bootbox.alert('Feature coming soon!');"
                        data-lib-id="{{ $oLib->id }}">
                        <span class="btn-label icon fa fa-thumbs-up"></span> Like
                    </a>
                    <a href="#" class="btn btn-facebook sharrre btn-labeled" data-text="I've found this awesome library on Android-Libs! @Android_Libs" data-url="{{ url('/lib/' . $oLib->slug) }}" data-share="facebook">
                        <span class="btn-label icon fa fa-facebook"></span> Facebook
                    </a>
                    <a href="#" class="btn btn-info sharrre twitter btn-labeled" data-text="I've found this awesome library on Android-Libs! @Android_Libs" data-url="{{ url('/lib/' . $oLib->slug) }}" data-share="twitter">
                        <span class="btn-label icon fa fa-twitter"></span> Twitter
                    </a>
                    <a href="#" class="btn btn-danger sharrre gplus btn-labeled" data-text="I've found this awesome library on Android-Libs! @Android_Libs" data-url="{{ url('/lib/' . $oLib->slug) }}" data-share="gplus">
                        <span class="btn-label icon fa fa-google-plus"></span> Google+
                    </a>
                </div>
            </div>
            {{--SMARTPHONE BUTTONS--}}
            <div class="row visible-xs">
                <div class="col-xs-12">
                    <hr>
                    <div class="row margin-bottom-10">
                        <div class="col-xs-12">
                            @if($oLib->isGitHubUrl())
                            <a href="{{ $oLib->url }}" class="btn btn-default btn-block btn-labeled" target="_blank">
                                <span class="btn-label icon fa fa-github"></span> To GitHub website
                            </a>
                            @else
                            <a href="{{ $oLib->url }}" class="btn btn-default btn-block btn-labeled" target="_blank">
                                <span class="btn-label icon fa fa-globe"></span> To libraries website
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            {{--<a href="{{ Sentry::check() ? '#' : url('/login') }}" class="btn btn-primary btn-labeled btn-like"--}}
                            <a href="#" class="btn btn-primary btn-labeled btn-block btn-like"
                                onclick="bootbox.alert('Feature coming soon!');"
                                data-lib-id="{{ $oLib->id }}">
                                <span class="btn-label icon fa fa-thumbs-up"></span> Like
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title"><i class="panel-title-icon fa fa-image"></i> Images</span>
                        <button type="button" data-toggle="modal" data-target="#suggestImageModal" class="btn btn-primary btn-xs pull-right btn-labeled">
                            <span class="btn-label icon fa fa-bullhorn"></span> Suggest Image
                        </button>
                    </div> <!-- / .panel-heading -->
                    <div class="panel-body padding-sm">
                        @if($oLib->getImages() == null)
                            <div class="text-center text-muted">
                                We could not find any images for this library.
                            </div>
                        @else
                            @foreach($oLib->getImages() as $sImage)
                                <img src="{{ asset('/assets/img/libs/' . $sImage . '.png') }}" class="img-responsive">
                            @endforeach
                        @endif
                    </div> <!-- / .panel-body -->
                </div>
            </div>
            <div class="col-xs-12">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title"><i class="panel-title-icon fa fa-file-text-o"></i> Description</span>
                    </div> <!-- / .panel-heading -->
                    <div class="panel-body padding-sm panel-description">
                        {{ $oLib->description }}
                    </div> <!-- / .panel-body -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon fa fa-info"></i>Details</span>
            </div> <!-- / .panel-heading -->
            <div class="panel-body padding-sm">
                <table class="table">
                    <tr>
                        <th class="no-border-t"><i class="fa fa-fw fa-calendar"></i> Added at:</th>
                        <td class="no-border-t">{{ $oLib->getCreatedDate() }}</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-fw fa-level-up"></i> Minimum SDK Level:</th>
                        <td>{{ $oLib->categories->getMinSdk() }}</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-fw fa-tag"></i> Category:</th>
                        <td>{{ $oLib->categories->name }}</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-fw fa-thumbs-up"></i> Likes:</th>
                        <td>{{ $oLib->likes->count() }}</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-fw fa-check"></i> See also:</th>
                        <td>
                            @foreach($oFiveRandomLibs as $oRandLib)
                                <a href="{{ url('/lib/' . $oRandLib->slug) }}">{{ $oRandLib->title }}</a><br>
                            @endforeach
                        </td>
                    </tr>
                </table>
            </div> <!-- / .panel-body -->
            @if(!$oLib->isGitHubUrl())
                <div class="panel-footer btn-footer">
                    <a href="{{ $oLib->url }}" target="_blank" class="btn btn-block btn-primary btn-full"><i class="fa fa-fw fa-globe"></i> Website</a>
                </div>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-md-4">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon fa fa-github-square"></i> GitHub Details</span>
            </div> <!-- / .panel-heading -->
            <div class="panel-body padding-sm">
                @if($oLib->isGitHubUrl())
                    <table class="table">

                            @if($oLib->githubOk)
                            <tr>
                                <th class="no-border-t"><i class="fa fa-fw fa-user"></i> Owner:</th>
                                <td class="no-border-t">
                                    <a href="{{ $oGitHub->owner->html_url }}" target="_blank">
                                        {{ $oGitHub->owner->login }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-fw fa-star"></i> Starred:</th>
                                <td>{{ $oGitHub->stargazers_count }}</td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-fw fa-eye"></i> Watchers:</th>
                                <td>{{ $oGitHub->subscribers_count }}</td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-fw fa-code-fork"></i> Forks:</th>
                                <td>{{ $oGitHub->forks_count }}</td>
                            </tr>
                            <tr>
                                <th><i class="fa fa-fw fa-exclamation-circle"></i> Open Issues:</th>
                                <td>{{ $oGitHub->open_issues }}</td>
                            </tr>
                        @else
                            <tr>
                                <th class="no-border-t"><i class="fa fa-fw fa-user"></i> Owner:</th>
                                <td class="no-border-t">
                                    {{ $oLib->getGitHubUserName() }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center text-muted" colspan="2">Could not get more information from GitHub.</td>
                            </tr>
                        @endif
                    </table>
                @else
                    <div class="text-center text-muted">
                        This Library has no GitHub URL yet.
                    </div>
                @endif
            </div> <!-- / .panel-body -->
            @if($oLib->isGitHubUrl())
                <div class="panel-footer btn-footer">
                    <a href="{{ $oGitHub->html_url }}" target="_blank" class="btn btn-block btn-primary btn-full"><i class="fa fa-fw fa-github"></i> GitHub Site</a>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon fa fa-comments"></i> Comments</span>
            </div> <!-- / .panel-heading -->
            <div class="panel-body padding-sm">
                 <div id="disqus_thread"></div>
                    <script type="text/javascript">
                        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                        var disqus_shortname  = 'android-libs'; // required: replace example with your forum shortname
                        var disqus_identifier = '{{ $oLib->disqus }}';
                        var disqus_url = '{{ url('/lib/' . $oLib->slug ) }}';

                        /* * * DON'T EDIT BELOW THIS LINE * * */
                        (function() {
                            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
            </div> <!-- / .panel-body -->
        </div>
    </div>
</div>
@include('modals.show')
@stop