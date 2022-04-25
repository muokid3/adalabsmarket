@if(session()->has('error'))
    <div class="alert alert-danger">
        <button class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> {!! session()->get('error') !!}
    </div>
@endif
