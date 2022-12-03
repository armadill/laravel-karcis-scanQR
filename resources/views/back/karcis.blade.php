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
      <h3 class="card-title">Pengaturan Harga Karcis</h3>
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
               <!-- <div class="col-md-12 text-md-right">
                        <div class="form-group">
                        <button class="btn btn-success text-right" data-toggle='modal' data-target='#tambah'> <i class="fas fa-file-excel"></i> Tambah</button>
                     </div>
                    </div> -->
      <table id="example2" class="table table-bordered table-hover table-sm">
         <thead>
            <tr>
               <th>No</th>
               <th>Jenis Kendaraan</th>
               <th>Harga</th>
               @if(Auth::user()->role == "ADMIN")
               <th class="full">Aksi</th>
               @endif
            </tr>
         </thead>
         <tbody>
            @php $no =1; @endphp
            @foreach ($data as $dt)
            <tr>
               <td>{{$no++}}</td>
               <td>{{$dt->jenis}}</td>
               <td>{{number_format($dt->harga, 0, ",", ".")}}</td>
               <!-- <td>
                  <img  src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                        ->size(140)->errorCorrection('H')->eye('circle')->mergeString(Storage::get('public/public/mobil.png'), .4)->backgroundColor(240, 202, 255, 75)
                        ->generate(env('APP_URL').'buton_is_the_best/'.$dt->id)) !!} ">
               </td> -->
               @if(Auth::user()->role == "ADMIN")
               <td valign="middle">
                  
                  <button class="btn-round btn btn-sm btn-primary" data-toggle="modal" data-target="#edit" data-txtid="{{$dt->id}}" data-txtharga="{{$dt->harga}}">&nbsp; Edit &nbsp;</button>

                             <button class="btn-round btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus" data-txtid="{{$dt->id}}" data-txtnama="{{$dt->jenis}}">Hapus</button>
               </td>
               @endif
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
            <h4 class="modal-title" id="defaultModalLabel">Upload data</h4>
         </div>
         <div class="modal-body">
              <form action="{{url('postimportuser')}}" method="post" enctype="multipart/form-data">
              @csrf
              
           <div class="form-group">
                        <label>Jenis Kendaraan</label>
                        <select class="form-control" name="jenis">
                          <option  value="RODA 2">RODA 2</option>
                          <option value="RODA 4">RODA 4</option>
                          <option value="PEJALAN">PEJALAN</option>
                          <option value="MANCANEGARA">MANCANEGARA</option>
                        </select>
                      </div>

               <div class="form-group">
                    <label for="hrga">Harga</label>
                    <input type="text" class="form-control" id="hrga" placeholder="Masukan Harga">
                  </div>


         
            <div class="modal-footer">
         <button type="submit" class="btn bg-success waves-effect">Tambah</button>
         <button type="button" class="btn bg-secondary waves-effect" data-dismiss="modal">Batalkan</button>
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
              <form action="{{url('posthapuskarcis')}}" method="post" enctype="multipart/form-data">
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
              <form action="{{url('postupdatekarcis')}}" method="post">
              @csrf
               <input type="hidden" name="txtid" id="txtid">

               <div class="form-group">
                    <label for="txtharga">Harga</label>
                    <input type="text" name="harga" class="form-control"  id="txtharga">
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
    var txtnama = button.data('txtnama')

    
     var modal = $(this)
     modal.find('.modal-body #txtid').val(txtid)
      modal.find('.modal-body #idhapus').html("<h5> "+txtnama+" ?</h5>");
    
     
   })
</script>

<!-- untuk edit-->
<script type="text/javascript">
   $('#edit').on('show.bs.modal', function (event) {
     var button = $(event.relatedTarget)
     var txtid = button.data('txtid') 
    var txtharga = button.data('txtharga')

    
     var modal = $(this)
     modal.find('.modal-body #txtid').val(txtid)
     modal.find('.modal-body #txtharga').val(txtharga)
      
     
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