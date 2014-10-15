@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <br>
            <form role="form" class="add-lib-form" enctype="multipart/form-data" method="post" action="submit">
                <div class="form-group">
                    <label for="inputTitle">Library name</label>
                    <input type="text" class="form-control" name="inputTitle" id="inputTitle" placeholder="Toast Library" required>
                </div>
                <div class="form-group">
                    <label for="inputUrl">URL to Library</label>
                    <input type="url" class="form-control" name="inputUrl" id="inputUrl" placeholder="http://github.com/example" required>
                    <p class="help-block">We can fetch data, like open issues, from GitHub, if you provide a valid GitHub URL.</p>
                </div>
                <div class="form-group">
                    <label for="inputMinSdk">Minimum SDK Level</label>
                    <input type="text" class="form-control" name="inputMinSdk" id="inputMinSdk" placeholder="12" required>
                    <p class="help-block">Please provide the minimum SDK level required to use your library.</p>
                </div>
                <div class="form-group">
                    <label for="inputCategory">Category</label>
                    <select name="inputCategory" class="form-control chosen" data-placeholder="Please select a category" id="inputCategory" required>
                        <option></option>
                        @foreach($oCategories as $oCat)
                        <option value="{{ $oCat->id }}">{{ $oCat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputSubmitterEmail">Your E-Mail</label>
                    <input type="email" class="form-control" name="inputSubmitterEmail" id="inputSubmitterEmail" placeholder="foo@bar.com" required>
                    <p class="help-block">We will send status-notifications about your submission. <strong>Nothing else!</strong></p>
                </div>
                <div class="form-group">
                    <label for="inputImage">Image (400x200 pixel required) *.png format only</label>
                    <input type="file" id="inputImage" class="inputImage" accept="image/png" name="inputImage" required>
                    <p class="help-block text-danger">If you upload any other sizes we will replace your image with a placeholder!</p>
                </div>
                <div class="form-group">
                    <label>Image Preview</label><br>
                    <img src="http://placehold.it/400x200" alt="Preview Image" class="add-prev-img img-responsive">
                </div>
                <div class="form-group">
                    <label for="inputDesc">Description</label><br>
                    <textarea class="form-control max-length-input" name="inputDesc" id="inputDesc" maxlength="1000" rows="10" placeholder="Describe the library as best as you can." required></textarea>
                </div>
                <button type="submit" class="btn btn-block btn-primary btn-labeled">
                    <span class="btn-label icon fa fa-send"></span> Submit library
                </button>
            </form>
        </div>
    </div>
</div>

@stop