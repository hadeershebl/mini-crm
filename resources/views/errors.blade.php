@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul style="">
            @foreach ($errors->all() as $error)
                <li style="text-align: center;list-style: none; height: 0.95rem; margin-top:5px">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('error'))
        <li class="alert alert-danger" role="alert"
         id="error" style="text-align: center; list-style: none; height: 0.5rem" >{{Session::get('error')}}</li>
        <?php Session::put('error', null); ?>
@endif

<script type="text/javascript">
	setTimeout(function() {
  $('#error').hide()
}, 250);
</script> 