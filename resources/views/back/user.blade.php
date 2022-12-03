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
<!-- Default box -->
<div class="card">
   <div class="card-header">
      <h3 class="card-title">Data User</h3>
      <div class="card-tools">
         <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
         <i class="fas fa-minus"></i>
         </button>
         <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
         <i class="fas fa-times"></i>
         </button>
      </div>
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
               <div class="col-md-12 text-md-right">
                        <div class="form-group">
                        <button class="btn btn-success text-right" data-toggle='modal' data-target='#tambah'> <i class="fas fa-plus"></i> Tambah</button>
                     </div>
                    </div>
      <table id="example2" class="table table-bordered table-hover table-sm">
         <thead>
            <tr>
               <th>No</th>
               <th>Nama</th>
               <th>Email</th>
               <th>No Tlp</th>
               <th>Hak Akses</th>
               <th class="full">Aksi</th>
            </tr>
         </thead>
         <tbody>
            @php $no =1; @endphp
            @foreach ($data as $dt)
            <tr>
               <td>{{$no++}}</td>
               <td>{{$dt->name}}</td>
                <td>{{$dt->email}}</td>
                 <td>{{$dt->nope}}</td>
                 <td>{{$dt->role}}</td>
              
               <td valign="middle">
                  
                  <button class="btn-round btn btn-sm btn-primary" data-toggle="modal" data-target="#edit" data-txtid="{{$dt->id}}" data-txtemail="{{$dt->email}}" data-txtnope="{{$dt->nope}}" data-txtnama="{{$dt->name}}"  data-txtrole="{{$dt->role}}">&nbsp; Edit &nbsp;</button>

                             <button class="btn-round btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus" data-txtid="{{$dt->id}}" data-txtemail="{{$dt->email}}">Hapus</button>
               </td>
            </tr>

            @endforeach
         </tbody>
      </table>
   </div>
   <!-- /.card-body -->
</div>
<!-- /.card -->





@endsection
@section('js')
<!-- toaster -->
<script src="{{asset('storage/public/back/plugins/toastr/toastr.min.js')}}"></script>

<!-- DataTables  & Plugins -->
<script src="{{asset('storage/public/back/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('storage/public/back/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('storage/public/back/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('storage/public/back/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('storage/public/back/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('storage/public/back/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('storage/public/back/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('storage/public/back/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('storage/public/back/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('storage/public/back/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('storage/public/back/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('storage/public/back/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
   $(function () {
     $("#example1").DataTable({
       "responsive": true, "lengthChange": false, "autoWidth": false,
       "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
     $('#example2').DataTable({
       "paging": true,
       "lengthChange": false,
       "searching": true,
       "ordering": true,
       "info": true,
       "autoWidth": false,
       "responsive": true,
     });
   });
</script>


<!-- untuk proses tambah  -->
<div class="modal  fade" id="tambah" tabindex="-1" role="dialog" data-backdrop="static">
   <div class="modal-dialog " role="document">
      <div class="modal-content">
         <div class="modal-header bg-success">
            <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
         </div>
         <div class="modal-body">
              <form action="{{url('postadduser')}}" method="post" enctype="multipart/form-data">
               {{csrf_field()}}
             <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input  type="radio" value="ADMIN"  name="txtrole">
                        <label for="admin"> ADMIN
                        </label>
                      </div>
                       &nbsp;&nbsp;  &nbsp;
                      <div class="icheck-primary d-inline">
                        <input  type="radio" value="USER" name="txtrole">
                        <label for="user">USER
                        </label>
                      </div>
  &nbsp;&nbsp;    &nbsp;
                        <div class="icheck-primary d-inline">
                        <input  type="radio" value="PETUGAS" name="txtrole">
                        <label for="user">PETUGAS
                        </label>
                      </div>
                    </div>

                      <div class="form-group">
                    <label for="txtnama">Nama</label>
                    <input type="text" name="txtnama" class="form-control"  id="txtnama">
                  </div>

                   <div class="form-group">
                    <label for="txtemail">Email</label>
                    <input type="email" name="email" class="form-control"  id="txtemail">
                  </div>

                   <div class="form-group">
                    <label for="txtnope">No Tlp</label>
                    <input type="text" name="txtnope" class="form-control"  id="txtnope">
                  </div>

                   <div class="form-group">
                    <label for="txtpass">Password</label>
                    <input type="text" name="txtpass" class="form-control"  id="txtpass">
                  </div>

            <div class="modal-footer">
         <button type="submit" class="btn bg-success waves-effect">Simpan</button>
         <button type="button" class="btn bg-secondary waves-effect "  data-dismiss="modal">Batalkan</button>
      </form>
      </div>
         </div>
      </div>
   </div>
</div>

<!-- untuk proses hapus  -->
<div class="modal  fade" id="hapus" tabindex="-1" role="dialog" data-backdrop="static">
   <div class="modal-dialog " role="document">
      <div class="modal-content">
         <div class="modal-header bg-danger">
            <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
         </div>
         <div class="modal-body">
              <form action="{{url('posthapususer')}}" method="post" enctype="multipart/form-data">
               {{csrf_field()}}
               <input type="hidden" name="txtid" id="txtid">

               <h5><b>Ingin Hapus Data</h5> <div id="idhapus"></div> </b>

            <div class="modal-footer">
         <button type="submit" class="btn bg-danger waves-effect">Hapus</button>
         <button type="button" class="btn bg-secondary waves-effect "  data-dismiss="modal">Batalkan</button>
      </form>
      </div>
         </div>
      </div>
   </div>
</div>

<!-- untuk proses edit  -->
<div class="modal  fade" id="edit" tabindex="-1" role="dialog" data-backdrop="static">
   <div class="modal-dialog " role="document">
      <div class="modal-content">
         <div class="modal-header bg-primary">
            <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
         </div>
         <div class="modal-body">
              <form action="{{url('postupdateuser')}}" method="post" enctype="multipart/form-data">
               {{csrf_field()}}
               <input type="hidden" name="txtid" id="txtid">

                <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input  type="radio" value="ADMIN" id="admin" name="txtrole">
                        <label for="admin"> ADMIN
                        </label>
                      </div>
                       &nbsp;&nbsp; &nbsp; 
                      <div class="icheck-primary d-inline">
                        <input  type="radio" value="USER" id="user" name="txtrole">
                        <label for="user">USER
                        </label>
                      </div>
                        &nbsp;&nbsp; &nbsp; 
                      <div class="icheck-primary d-inline">
                        <input  type="radio" value="PETUGAS" id="petugas" name="txtrole">
                        <label for="user">PETUGAS
                        </label>
                      </div>
                    </div>

                      <div class="form-group">
                    <label for="txtnama">Nama</label>
                    <input type="text" name="txtnama" class="form-control"  id="txtnama">
                  </div>

                   <div class="form-group">
                    <label for="txtemail">Email</label>
                    <input type="email" name="txtemail" class="form-control"  id="txtemail">
                  </div>

                   <div class="form-group">
                    <label for="txtnope">No Tlp</label>
                    <input type="text" name="txtnope" class="form-control"  id="txtnope">
                  </div>

            <div class="modal-footer">
         <button type="submit" class="btn bg-primary waves-effect">Update</button>
         <button type="button" class="btn bg-secondary waves-effect "  data-dismiss="modal">Batalkan</button>
      </form>
      </div>
         </div>
      </div>
   </div>
</div>



<!-- untuk hapus user-->
<script type="text/javascript">
   $('#hapus').on('show.bs.modal', function (event) {
     var button = $(event.relatedTarget)
     var txtid = button.data('txtid') 
    var txtemail = button.data('txtemail')

    
     var modal = $(this)
     modal.find('.modal-body #txtid').val(txtid)
      modal.find('.modal-body #idhapus').html("<h5> "+txtemail+" ?</h5>");
    
     
   })
</script>

<!-- untuk edit-->
<script type="text/javascript">
   $('#edit').on('show.bs.modal', function (event) {
     var button = $(event.relatedTarget)
     var txtid = button.data('txtid') 
    var txtemail = button.data('txtemail')
    var txtnope = button.data('txtnope')
    var txtrole = button.data('txtrole')
    var txtnama = button.data('txtnama')

    
     var modal = $(this)
     modal.find('.modal-body #txtid').val(txtid)
     modal.find('.modal-body #txtemail').val(txtemail)
     modal.find('.modal-body #txtnope').val(txtnope)
     modal.find('.modal-body #txtnama').val(txtnama)
     
      if(txtrole == 'ADMIN'){
          $('#admin').prop('checked', true);
        } else if(txtrole == 'USER'){
          $('#user').prop('checked', true);
        } else if(txtrole == 'PETUGAS'){
          $('#petugas').prop('checked', true);
        }
    
     
   })
</script>
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
<script>
   $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
</script>
@endsection