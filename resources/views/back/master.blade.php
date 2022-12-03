<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="theme-color" content="#C619FF">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    
    <?php 
    if( Request::url() == url('/datakarcis')){
      echo "DATA KARCIS";
    }else {
       echo "APLIKASI SISTEM KARCIS";
    }
    ?>


  </title>
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('storage/public/back/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('storage/public/back/dist/css/adminlte.min.css')}}">
   @yield('css')
   <style type="text/css">
     .gar {
      border: 0px solid red;
     }
     .wrapper {
  background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
  background-size: 400% 400%;
  animation: gradient 15s ease infinite;
}
 .aa {
  background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
  background-size: 400% 400%;
  animation: gradient 15s ease infinite;
}

@keyframes gradient {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

.bubbles{
  position:absolute;
  width:100%;
  height: 100%;
  z-index:0;
  overflow:hidden;
  top:0;
  left:0;
}
.bubble{
  position: absolute;
  bottom:-100px;
  width:40px;
  height: 40px;
  background:#9088FB;
  border-radius:50%;
  opacity:0.5;
  animation: rise 10s infinite ease-in;
}
.bubble:nth-child(1){
  width:40px;
  height:40px;
  left:10%;
  animation-duration:8s;
}
.bubble:nth-child(2){
  width:20px;
  height:20px;
  left:20%;
  animation-duration:5s;
  animation-delay:1s;
}
.bubble:nth-child(3){
  width:50px;
  height:50px;
  left:35%;
  animation-duration:7s;
  animation-delay:2s;
}
.bubble:nth-child(4){
  width:80px;
  height:80px;
  left:50%;
  animation-duration:11s;
  animation-delay:0s;
}
.bubble:nth-child(5){
  width:35px;
  height:35px;
  left:55%;
  animation-duration:6s;
  animation-delay:1s;
}
.bubble:nth-child(6){
  width:45px;
  height:45px;
  left:65%;
  animation-duration:8s;
  animation-delay:3s;
}
.bubble:nth-child(7){
  width:90px;
  height:90px;
  left:70%;
  animation-duration:12s;
  animation-delay:2s;
}
.bubble:nth-child(8){
  width:25px;
  height:25px;
  left:80%;
  animation-duration:6s;
  animation-delay:2s;
}
.bubble:nth-child(9){
  width:15px;
  height:15px;
  left:70%;
  animation-duration:5s;
  animation-delay:1s;
}
.bubble:nth-child(10){
  width:90px;
  height:90px;
  left:25%;
  animation-duration:10s;
  animation-delay:4s;
}
@keyframes rise{
  0%{
    bottom:-100px;
    transform:translateX(0);
  }
  50%{
    transform:translate(100px);
  }
  100%{
    bottom:1080px;
    transform:translateX(-200px);
}
}
.active > .nav-icon {
  color:white !important;
}
   </style>
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class=" main-header navbar navbar-expand navbar-white navbar-light">
    <div class="bubbles">
      <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    
  </div>
    <!-- Left navbar links -->
     <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
    

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
  

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('storage/public/user.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
          <a href="#" style="color:#FFFFFF" class="badge badge-danger">{{Auth::user()->role}}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item">
            <a href="{{url('pengunjung')}}" class="nav-link">
              <i class="nav-icon fas fa-users" style="color:#CD2ACF"></i>
              <p>
                Data pengunjung
              </p>
            </a>
          </li> -->
           <li class="nav-item">
            <a href="{{url('/')}}" class="nav-link {{ Request::url() == url('/') ? 'active' : '' }}">
             <i class="nav-icon  fas fa-home" style="color:#FFFFFF"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('datakunjungan')}}" class="nav-link {{ Request::url() == url('/datakunjungan') ? 'active' : '' }}">
             <i class="nav-icon fas fa-users" style="color:#CD2ACF"></i>
              <p>
                Data Pengunjung
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="{{url('karcis')}}" class="nav-link {{ Request::url() == url('/karcis') ? 'active' : '' }}">
              <i class="nav-icon fas far fa-ticket-alt" style="color:#CDE355"></i>
              <p>
                Karcis
              </p>
            </a>
          </li>
          
          @if(Auth::user()->role == "ADMIN" or Auth::user()->role == "USER"  )
           <li class="nav-item">
            <a href="{{url('datakarcis')}}" class="nav-link {{ Request::url() == url('/datakarcis') ? 'active' : '' }}">
              <i class="nav-icon fas fa-download" style="color:#2FA6E3"></i>
              <p>
                Data Karcis
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->role == "ADMIN")
          <li class="nav-item">
            <a href="{{url('user')}}" class="nav-link {{ Request::url() == url('/user') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user" style="color:#7F58F0"></i>
              <p>
                User
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{url('profil')}}" class="nav-link {{ Request::url() == url('/profil') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-cog" style="color:#839777"></i>
              <p>
                Profil
              </p>
            </a>
          </li>
           @if(Auth::user()->email == "alman.bpp@gmail.com")
          <li class="nav-item">
            <a href="{{url('logalman')}}" class="nav-link {{ Request::url() == url('/logalman') ? 'active' : '' }}">
              <i class="nav-icon fas fa-bolt" style="color:#48D5D3"></i>
              <p>
                Log
              </p>
            </a>
          </li>
          @endif
              <li class="nav-item">
            <a href="{{url('logout')}}" class="nav-link">
               <i class="nav-icon fas fa-bolt" style="color:#F03535"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
    
      
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper aa">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      @yield('konten')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2022-{{date('Y')}} <a href="#">💓 Indonesia - Sulawesi Tenggara</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('storage/public/back/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('storage/public/back/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('storage/public/back/dist/js/adminlte.min.js')}}"></script>

 @yield('js')
</body>
</html>
