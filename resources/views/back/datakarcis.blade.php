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
.gr {
   border: 0px solid red;
}
.dataTables_wrapper .dt-buttons {
  float:left !important;
  margin: 5px !important;

}
.dataTables_filter {
   float: right !important;
}
.bth ul {
   list-style: none;
   margin-top: 40px;

}
.bth ul li {
   float: right;
   margin-right: 10px;
   margin-top: 5px;
}
</style>
@endsection
@section('konten')
<!-- Default box -->
<div class="card">
   <div class="card-header">
      <h3 class="card-title">Data Karcis</h3>
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

         <div class="col-md-12 gr row">
            <div class="col-md-6 gr">
               <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-text-width"></i>
                 Stok karcis dan Nomor seri
                </h3>
              </div>
              <!-- /.card-header -->
             <div class="row">
                <div class="col-md-6"> <div class="card-body">
                <dl class="row">
                  <dt class="col-sm-6">PEJALAN</dt>
                  <dd class="col-sm-4"><span class="badge badge-info">{{$p}} </span> </dd>
                  <dt class="col-sm-6">RODA DUA</dt>
                  <dd class="col-sm-4"><span class="badge badge-warning">{{$rd2}}  </span> </dd>
                  <dt class="col-sm-6">RODA EMPAT</dt>
                  <dd class="col-sm-4"><span class="badge badge-danger">{{$rd4}} </span> </dd>
                  <dt class="col-sm-6">M. NEGARA</dt>
                  <dd class="col-sm-4"><span class="badge badge-primary">{{$m}} </span> </dd>
                </dl>
              </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                <dl class="row">
                  <dt class="col-sm-6">PEJALAN</dt>
                  <dd class="col-sm-4"><span class="badge badge-dark">{{$p1->noseri ?? ''}}  </span> </dd>
                  <dt class="col-sm-6">RODA DUA</dt>
                  <dd class="col-sm-4"><span class="badge badge-dark">{{$rd21->noseri ?? '' }}  </span> </dd>
                  <dt class="col-sm-6">RODA EMPAT</dt>
                  <dd class="col-sm-4"><span class="badge badge-dark">{{$rd41->noseri ?? ''}}</span> </dd>
                  <dt class="col-sm-6">M. NEGARA</dt>
                  <dd class="col-sm-4"><span class="badge badge-dark">{{$m1->noseri ?? ''}} </span> </dd>
                </dl>
              </div>
                </div>
             </div>
              <!-- /.card-body -->
            </div>
            
            </div>
            <div class="col-md-6 gr text-right">
             
                <div class="form-row align-items-center justify-content-end input-daterange">
            <div class="col-sm-4 my-1">
               <label class="sr-only" for="inlineFormInputGroupUsername">Dari Tanggal</label>
               <input type="date" autocomplete="off" class="form-control" name="from_date" id="from_date" placeholder="Dari">
            </div>
            <div class="col-sm-4 my-1">
               <label class="sr-only" for="inlineFormInputGroupUsername">Sampai Tanggal</label>
               <input type="date" autocomplete="off" class="form-control"  name="to_date" id="to_date" placeholder="Ke">
            </div>
            <div class="col-auto my-2">
               <button type="button" name="filter" id="filter" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button> &nbsp; 
               <button type="button" name="refresh" id="refresh" class="btn  btn-sm btn-secondary"><i class="fas fa-sync-alt"></i></button>
            </div>
             <div class="bth">
               <ul>
                  <li><a href="{{url('dlroda2')}}" class="btn brn-sm btn-warning text-right"> <i class="fas fa-motorcycle"></i>&nbsp;&nbsp; Roda 2 &nbsp;</a>
                  </li>
                  <li><a href="{{url('dlroda4')}}" class="btn brn-sm btn-danger text-right"> <i class="fas fa-car"></i> &nbsp; Roda 4&nbsp;</a></li>
                  <li><a href="{{url('dlpejalan')}}" class="btn brn-sm btn-info text-right"> <i class="fas fa-walking"></i> &nbsp; Pejalan&nbsp;</a></li>
                  <li><a href="{{url('dlmancanegara')}}" class="btn brn-sm btn-primary text-right"> <i class="fas fa-plane"></i> M. Negara</a></li>
                  <li> @if(Auth::user()->role == 'ADMIN')
<button class="btn btn-success text-right" data-toggle='modal' data-target='#tambah'> <i class="fas fa-plus"></i> Tambah</button>

              @endif</li>
</li>
               </ul>
             </div>


            


         </div>


            </div>
         </div>
     
         <!-- <select name="month-select" id="position" class="monthlist">
                <option value="">Month's</option>
                <option value="ready">ready</option>
                <option value="terpakai">terpakai</option>
                </select> -->

      <table id="example2" class="table table-bordered table-hover table-sm">
         <thead>
            <tr>
               <th>No</th>
               <th>Jenis Kendaraan</th>
               <th>Tgl Buat</th>
               <th>Status</th>
               <th>Tgl Scan</th>
               <th>Kode</th>
               <th>No. Seri</th>
               <th>Discan oleh</th>
               @if(Auth::user()->role == "ADMIN")
               <th class="full">Aksi</th>
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
   $(document).ready(function(){
     
   load_data();
   
   function load_data(from_date = '', to_date = '')
   {
 var table =   $('#example2').DataTable({
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
      lengthMenu: [ [10, 25, 50, 100,200, -1], [10, 25, 50, 100,200, "All"] ],
      dom: 'Bfrtip',
       buttons: [
        {
            extend: 'pageLength',
            text: '<span class="fa fa-file-excel"></span> No Halaman',
            className: 'btn btn-dark btn-sm',
            exportOptions: {
                modifier: {
                    search: 'applied',
                    order: 'applied'
                }
            }
        },
        {
            extend: 'colvis',
            text: '<span class="fa fa-file-excel"></span> Kolom',
            className: 'btn btn-primary btn-sm',
            exportOptions: {
                modifier: {
                    search: 'applied',
                    order: 'applied'

                }
            }
        },
        {
            extend: 'excel',
            text: '<span class="fa fa-file-excel"></span> Excel',
            className: 'btn btn-success btn-sm',
            exportOptions: {
                columns: ':visible',
                modifier: {
                    search: 'applied',
                    order: 'applied',
                     columns: ':visible'
                }
            }
        },
         {
            extend: 'csv',
            text: '<span class="fa fa-file-excel"></span> CSV',
            className: 'btn btn-info btn-sm',
            exportOptions: {
                columns: ':visible',
                modifier: {
                    search: 'applied',
                    order: 'applied'
                }
            }
        },
        ,
         {
            extend: 'pdf',
            text: '<span class="fa fa-file-excel"></span> PDF',
            className: 'btn btn-danger btn-sm',
            exportOptions: {
                columns: ':visible',
                modifier: {
                    search: 'applied',
                    order: 'applied'
                }
            }
        },
        {
           extend: 'print',
            text: '<span class="fa fa-file-excel"></span> Print',
            className: 'btn btn-secondary btn-sm',
            exportOptions: {
                columns: ':visible',
                modifier: {
                    search: 'applied',
                    order: 'applied'
                }
            }
        }
    ],
    ajax: {
     url:'{{ route("ajax.load.tabelkarcis") }}',
     data:{from_date:from_date, to_date:to_date}
    },
    columns: [
     { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
     
     { data: 'jenis', name: 'jenis'},
        { data: 'tanggalb', name: 'tanggalb'},
       {data: 'status',  name: 'status'},
        { data: 'tanggals', name: 'tanggals'},
         {data: 'kode',  name: 'kode'},
         {data: 'noseri',  name: 'noseri'},
         {data: 'bys',  name: 'bys'},
         @if(Auth::user()->role == "ADMIN")
           {data: 'aksi',  name: 'aksi'},
         @endif

            
    ]
   });

    $('#position').on('change', () => {            
        table.search($("#position").val()).draw();
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


<!-- untuk proses tambah  -->
<div class="modal  fade" id="tambah" tabindex="-1" role="dialog" data-backdrop="static">
   <div class="modal-dialog " role="document">
      <div class="modal-content">
         <div class="modal-header bg-success">
            <h4 class="modal-title" id="defaultModalLabel">Tambah Karcis</h4>
         </div>
         <div class="modal-body">
              <form action="{{url('postaddkode')}}" method="post" enctype="multipart/form-data">
               {{csrf_field()}}
              
           <div class="form-group">
                        <label>Jenis Kendaraan</label>
                        <select class="form-control" name="jenis">
                          <option  value="RODA2">RODA 2</option>
                          <option value="RODA4">RODA 4</option>
                          <option value="PEJALAN">PEJALAN</option>
                           <option value="MANCANEGARA">MANCANEGARA</option>
                        </select>
                      </div>

               <div class="form-group">
                    <label for="kode">Jumlah karcis</label>
                    <input type="text" class="form-control" id="kode" autocomplete="off" name="jumlah" placeholder="Masukan jumlah Karcis yang ingin di buat">
                  </div>

                 <div class="form-group">
                    <label for="noseri">Awal nomor seri</label>
                    <input type="text" class="form-control" id="noseri" autocomplete="off" name="noseri" placeholder="Masukan awalan nomor seri">
                  </div>


         
            <div class="modal-footer">
         <button type="submit" class="btn bg-success waves-effect">Buat</button>
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
              <form action="{{url('posthapuskodekarcis')}}" method="post" enctype="multipart/form-data">
               {{csrf_field()}}
               <input type="hidden" name="txtid" id="txtid">
               <input type="hidden" name="txtkodeqris" id="txtkodeqris">
               <input type="hidden" name="txtfolder" id="txtfolder">

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
              <form action="{{url('postupdatekarcis')}}" method="post" enctype="multipart/form-data">
               {{csrf_field()}}
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
    var txtkata = button.data('txtkata')
     var txtkodeqris = button.data('txtkodeqris')
       var txtfolder = button.data('txtfolder')

    
     var modal = $(this)
     modal.find('.modal-body #txtid').val(txtid)
      modal.find('.modal-body #txtkodeqris').val(txtkodeqris)
      modal.find('.modal-body #txtfolder').val(txtfolder)
      modal.find('.modal-body #idhapus').html("<h5> "+txtkata+" ?</h5>");
    
     
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