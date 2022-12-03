@extends('back.master')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('storage/public/back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('storage/public/back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('storage/public/back/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<!-- toster -->
<link rel="stylesheet" href="{{asset('storage/public/back/plugins/toastr/toastr.min.css')}}">
<style type="text/css">
   /*table {
    table-layout: auto;
    border-collapse: collapse;
    width: 100%;
}
table td {
    border: 1px solid #ccc;
}
table .full {
    width: 100%;
}*/
</style>
@endsection
@section('konten')

<div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              {{Auth::user()->name}}
            </h3>
          </div>
          <div class="card-body">
          	  @if (count($errors) > 0)
         <div class="alert alert-danger" style="padding:8px">
          
            <ul>
               @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
         @endif
            <h4>Profil</h4>
            <div class="row">
              <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="false">Utama</a>
                  <a class="nav-link " id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="true">Ganti Password</a>
                  
                
                </div>
              </div>
              <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <div class=" active show tab-pane text-left fade" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                    <div class="card-body">
                    	<form method="post" action="{{url('updatepass')}}">
                    		@csrf
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" disabled name="txtnama" class="form-control" id="nama" value="{{Auth::user()->name}}" placeholder="Nama">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="txtemail"  value="{{Auth::user()->email}}" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                     <div class="form-group">
                    <label for="nope">No Tlp</label>
                    <input type="text" name="txtnope" class="form-control"  value="{{Auth::user()->nope}}" id="nope" placeholder="No Tlp">
                  </div>

                   <div class="form-group">
                    <label for="nope">Hak Akses</label>
                    <input type="text" disabled name="txtrole" class="form-control"  value="{{Auth::user()->role}}" id="nope" >
                  </div>
                 
                
          	
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>


                  </div>
                  <div class="tab-pane fade " id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                    
                  		<form method="post" action="{{url('updatepassa')}}">
                    		@csrf
                    <div class="form-group">
                    <label for="exampleInputPassword1">Password lama</label>
                    <input type="password" name="passold"  class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>

                   <div class="form-group">
                    <label for="exampleInputPassword1">Password Baru</label>
                    <input type="password" name="passnew" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>

                   <div class="form-group">
                    <label for="exampleInputPassword1">Konfrimasi Password</label>
                    <input type="password" name="passnew1"  class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>

                   <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>


                  </div>
                 
                 
                </div>
              </div>
            </div>
       
          </div>
          <!-- /.card -->
        </div>





@endsection
@section('js')
<!-- toaster -->
<script src="{{asset('storage/public/back/plugins/toastr/toastr.min.js')}}"></script>

@if(Session('sukses'))
<script>
    toastr.success("{{ Session::get('sukses') }}");
</script>
@endif
@if(Session('gagal'))
<script>
   toastr.error("{{ Session::get('gagal') }}");
</script>
@endif

@endsection