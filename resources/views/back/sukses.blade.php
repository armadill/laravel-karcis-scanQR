<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>APLIKASI</title>
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('storage/public/back/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('storage/public/back/dist/css/adminlte.min.css')}}">
  <!-- toster -->
<link rel="stylesheet" href="{{asset('storage/public/back/plugins/toastr/toastr.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">

  @if(Session('gagal'))

                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-ban"></i> GAGAL!</h5>
                  {{ Session::get('gagal') }}
                </div>

    @endif

    @if(Session('sukses'))

                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-check"></i> BERHASIL!</h5>
                  {{ Session::get('sukses') }}
                </div>
    @endif
 

  

<!-- <button id="foo">Press to play sound</button> -->
<!-- jQuery -->
<script src="{{asset('storage/public/back/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('storage/public/back/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('storage/public/back/dist/js/adminlte.min.js')}}"></script>
 <!-- toaster -->
<script src="{{asset('storage/public/back/plugins/toastr/toastr.min.js')}}"></script>
<script>
    $( "#foo" ).trigger( "click" );
</script>


<script>

  $(document).ready(function() {
     $( "#foo" ).trigger( "click" );
});

</script>



<script>

  $(document).ready(function() {
    $("button").click(function(){
       var obj = document.createElement("audio");
            obj.src = "https://assets.mixkit.co/sfx/download/mixkit-retro-game-notification-212.wav"; 
            obj.play(); 
       $( "#foo" ).trigger( "click" );
    }); 
});

</script>



</body>
</html>
