@extends('layout')

@section('content')
<div class="container">
    @include('alerts')
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#public-libs" role="tab" data-toggle="tab"><i class="fa fa-fw fa-globe"></i> Public libraries</a></li>
        <li><a href="#submitted-libs" role="tab" data-toggle="tab"><i class="fa fa-fw fa-send-o"></i> Submitted libraries</a></li>
        <li><a href="#add" role="tab" data-toggle="tab"><i class="fa fa-fw fa-plus-square"></i> Add library</a></li>
    </ul>
    <br>
    <div class="tab-content">
        <div class="tab-pane fade in active" id="public-libs">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover table-bordered table-with-actions datatable">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>E-Mail</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($public_libraries) == 0)
                            <tr>
                                <td colspan="6" class="text-muted text-center">No libraries are public.</td>
                            </tr>
                        @endif
                        @foreach($public_libraries as $lib)
                        <tr>
                            <td><a href="assets/img/libs/{{ $lib->img . $lib->img_ext }}" class="prev-img" target="_blank"><img src="assets/img/libs/{{ $lib->img . $lib->img_ext }}" class="td-img" alt="Image"></a></td>
                            <td>{{ $lib->title }}</td>
                            <td>{{ $lib->submittor_email }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ $lib->github }}" class="btn btn-primary" target="_blank"><i class="fa fa-fw fa-globe"></i></a>
                                    <a href="#" class="btn btn-danger btn-remove" data-id="{{ $lib->id }}"><i class="fa fa-fw fa-ban"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="submitted-libs">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover table-bordered table-with-actions datatable">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>E-Mail</th>
                            <th>Short description</th>
                            <th>Long description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($submitted_libraries) == 0)
                        <tr>
                            <td colspan="6" class="text-muted text-center">No libraries were submitted.</td>
                        </tr>
                        @endif
                        @foreach($submitted_libraries as $lib)
                        <tr>
                            <td><a href="assets/img/libs/{{ $lib->img . $lib->img_ext }}" class="prev-img" target="_blank"><img src="assets/img/libs/{{ $lib->img . $lib->img_ext }}" class="td-img" alt="Image"></a></td>
                            <td>{{ $lib->title }}</td>
                            <td>{{ $lib->submittor_email }}</td>
                            <td>{{ $lib->short_desc }}</td>
                            <td>{{ $lib->long_desc }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ $lib->github }}" class="btn btn-primary" target="_blank"><i class="fa fa-fw fa-globe"></i></a>
                                    <a href="#" class="btn btn-success btn-accept" data-id="{{ $lib->id }}"><i class="fa fa-fw fa-check"></i></a>
                                    <a href="#" class="btn btn-danger btn-decline" data-id="{{ $lib->id }}"><i class="fa fa-fw fa-ban"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="add">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <form role="form" class="add-lib-form" enctype="multipart/form-data" method="post" action="admin/lib/add">
                        <div class="form-group">
                            <label for="inputTitle">Library name</label>
                            <input type="text" class="form-control" name="inputTitle" id="inputTitle" placeholder="Toast library" required>
                        </div>
                        <div class="form-group">
                            <label for="inputGithub">Github URL</label>
                            <input type="url" class="form-control" name="inputGithub" id="inputGithub" placeholder="http://github.com/example" required>
                        </div>
                        <div class="form-group">
                            <label for="inputImage">Image (500x500 pixel)</label>
                            <input type="file" id="inputImage" class="inputImage" accept="image" name="inputImage" required>
                        </div>
                        <div class="form-group">
                            <label>Preview</label><br>
                            <img src="http://placehold.it/500x500&text=Preview Image" alt="Preview Image" class="add-prev-img">
                        </div>
                        <div class="form-group">
                            <label for="inputShortDesc">Short description</label><br>
                            <textarea class="form-control max-length-input"  name="inputShortDesc" id="inputShortDesc" maxlength="250" placeholder="Enter a short description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputLongDesc">Long description</label><br>
                            <textarea class="form-control max-length-input" name="inputLongDesc" id="inputLongDesc" maxlength="1000" rows="10" placeholder="Enter a long description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-block btn-default">Submit library</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop