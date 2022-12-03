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
      <br />
         <div class="form-row align-items-center justify-content-end input-daterange">
            <div class="col-sm-2 my-1">
               <label class="sr-only" for="from_date">Dari Tanggal</label>
               <input type="date" autocomplete="off" class="form-control" name="from_date" id="from_date" placeholder="Dari">
            </div>
            <div class="col-sm-2 my-1">
               <label class="sr-only" for="to_date">Sampai Tanggal</label>
               <input type="date" autocomplete="off" class="form-control"  name="to_date" id="to_date" placeholder="Ke">
            </div>
            <div class="col-auto my-2">
               <button type="button" name="filter" id="filter" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button> &nbsp; 
               <button type="button" name="refresh" id="refresh" class="btn  btn-sm btn-secondary"><i class="fas fa-sync-alt"></i></button>
            </div>
             <div class="col-auto">
 <form method="post" action="{{url('printvisitor')}}">
                  @csrf
               <input type="hidden" id="dr" name="txtdari">
               <input type="hidden" id="ke" name="txtke">
               <button type="submit" name="print" id="print" class="btn  btn-sm btn-dark"><i class="fas fa-print"></i></button>
            </form>

             </div>


            


         </div>
         <br />
      <table id="example2" class="table table-bordered table-hover table-sm">
         <thead>
            <tr>
               <th>No</th>
               <th>Tanggal</th>
              <th>Hari</th>
               <th>Jenis</th>
               <th>Harga</th>
               <th>Petugas</th>
               @if(Auth::user()->role == 'ADMIN')
               <th>Aksi</th>
               @endif

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
    $('#from_date').on('change', function() {
    var dari = $('#from_date').val();
     $('#dr').val(dari);
    
});

     $('#to_date').on('change', function() {
    var ke = $('#to_date').val();
     $('#ke').val(ke);
    
});
</script>

<!-- untuk proses hapus  -->
<div class="modal  fade" id="hapus" tabindex="-1" role="dialog" data-backdrop="static">
   <div class="modal-dialog " role="document">
      <div class="modal-content">
         <div class="modal-header bg-danger">
            <h4 class="modal-title" id="defaultModalLabel">Konfirmasi</h4>
         </div>
         <div class="modal-body">
              <form action="{{url('posthapuskunjungan')}}" method="post" enctype="multipart/form-data">
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


<!-- untuk hapus user-->
<script type="text/javascript">
   $('#hapus').on('show.bs.modal', function (event) {
     var button = $(event.relatedTarget)
     var txtid = button.data('txtid') 
    var txtkata = button.data('txtkata')

    
     var modal = $(this)
     modal.find('.modal-body #txtid').val(txtid)
      modal.find('.modal-body #idhapus').html("<h5> "+txtkata+" ?</h5>");
    
     
   })
</script>


<script>
   $(document).ready(function(){
   load_data();
   
   function load_data(from_date = '', to_date = '')
   {
   $('#example2').DataTable({
       responsive: true,
       ScrollX: true,
       autoWidth: false,
       searching: true,
       paging: true,
       lengthChange: true,
       ordering: true,
       info: true,
       processing: true,
       serverSide: true,
    ajax: {
     url:'{{ route("ajax.load.tabelkunjungan") }}',
     data:{from_date:from_date, to_date:to_date}
    },
    columns: [
     { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
     
     { data: 'tanggal', name: 'tanggal'},
        { data: 'hari', name: 'hari'},
        {data: 'jenis',  name: 'jenis'},
         {data: 'harga',  name: 'harga'},
         {data: 'by',  name: 'by'},
         @if(Auth::user()->role == 'ADMIN')
           {data: 'aksi',  name: 'aksi'},
           @endif


            
    ]
   });
   }
   
   $('#filter').click(function(){
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   if(from_date != '' &&  to_date != '')
   {
    $('#example2').DataTable().destroy();
    load_data(from_date, to_date);
   }
   else
   {
    alert('Tanggal dari dan ke harus di isi');
   }
   });

   $('#print').click(function(){
   var from_date = $('#from_date').val();
   var to_date = $('#to_date').val();
   if(from_date != '' &&  to_date != '')
   {
    $('#example2').DataTable().destroy();
    load_data(from_date, to_date);
   }
   else
   {
    alert('Tanggal dari dan ke harus di isi');
   }
   });
   
   $('#refresh').click(function(){
   $('#from_date').val('');
   $('#to_date').val('');
   $('#example2').DataTable().destroy();
   load_data();
   });
   
   });
</script>


@endsection