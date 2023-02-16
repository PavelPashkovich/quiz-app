@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block mr-2">
        <button type="button" class="btn btn-outline-success close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block mr-2">
        <button type="button" class="btn btn-outline-danger close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block mr-2">
        <button type="button" class="btn btn-outline-warning close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block mr-2">
        <button type="button" class="btn btn-outline-info close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger mr-2">
        <button type="button" class="btn btn-outline-danger close" data-dismiss="alert">×</button>
        Check the following errors :(
        {{ $message }}
    </div>
@endif

<script>
    const close = document.getElementsByClassName("close");

    for (let i = 0; i < close.length; i++) {
        close[i].onclick = function() {
            const div = this.parentElement;
            div.remove();
        }
    }
</script>
