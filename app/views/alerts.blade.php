@if(Session::get('success', false))
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4><i class="fa fa-fw fa-check"></i> Cool!</h4>
                <p>{{ Session::get('message') }}</p>
            </div>
        </div>
    </div>
</div>

@endif
@if(Session::get('error', false))
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4><i class="fa fa-fw fa-times-circle"></i> Oh oh!</h4>
                <p>{{ Session::get('message') }}</p>
            </div>
        </div>
    </div>
</div>
@endif