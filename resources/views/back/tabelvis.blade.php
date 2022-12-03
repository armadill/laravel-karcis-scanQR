@extends('back.master')
@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('storage/public/back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('storage/public/back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('storage/public/back/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('konten')
<!-- Default box -->
<div class="card">
   <div class="card-header">
      <h3 class="card-title">Tabel Pengunjung</h3>
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
      <table id="example2" class="table table-bordered table-hover table-sm">
         <thead>
            <tr>
               <th>No</th>
               <th>Tanggal</th>
               <th>Hari</th>
               <th>Jenis</th>
               <th>Wisatawan</th>
               <th>Jumlah</th>
               <th>Total</th>
            </tr>
         </thead>
      </table>
   </div>
   <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
@section('js')
@section('js')
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
       processing: true,
        serverSide: true,
        ajax: "{{route('ajax.load.tabelvis')}}",
        columns: [
         { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
        { data: 'tanggal', name: 'tanggal'},
        { data: 'hari', name: 'hari'},
        {data: 'jenis',  name: 'jenis'},
        {data: 'wisatawan',  name: 'wisatawan'},
         {data: 'jumlah',  name: 'jumlah'},
         {data: 'total',  name: 'total'},

        ],
     });
   });
</script>
@endsection