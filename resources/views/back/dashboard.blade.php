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
@import "https://code.highcharts.com/css/highcharts.css";

.highcharts-pie-series .highcharts-point {
    stroke: #ede;
    stroke-width: 2px;
}

.highcharts-pie-series .highcharts-data-label-connector {
    stroke: silver;
    stroke-dasharray: 2, 2;
    stroke-width: 2px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 320px;
    max-width: 600px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>
@endsection
@section('konten')
<!-- Default box -->

<div class="card">
   <div class="card-header">
      <?php 
      $day = \Carbon\Carbon::parse(date('Y-m-d'))->format('D');
        $hariArray = [
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu',
            'Sun' => 'Minggu',
        ];
        $hari = $hariArray[$day];
      ?>
      <h3 class="card-title">Dashboard <br> Selamat Datang : <span class="badge badge-danger">{{Auth::user()->name}}</span>
         | <span class="badge badge-info"> {{$hari}} {{date('d-m-Y')}}</span> <b style="font-size: 16px; font-family: arial;" id="jam"> </b></h3>
   
   </div>
   <div class="card-body">
      <h3>Total kunjungan hari ini</h3>
      <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-car"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Roda 4</span>
                <span class="info-box-number">
                  {{$rd4}}
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-motorcycle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Roda 2</span>
                <span class="info-box-number">{{$rd2}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-walking"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pejalan</span>
                <span class="info-box-number">{{$p}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-plane"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Mancanegara</span>
                <span class="info-box-number">{{$m}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
       <div class="row">
           <div class="col-md-6 gar">
           <figure class="highcharts-figure">
  <div id="container"></div>

</figure>
        </div>
        <div class="col-md-6 gar">
         <figure class="highcharts-figure">
    <div id="container1"></div>
    
    </p>
</figure>
           
        </div>
       </div>
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
<script type="text/javascript">
    window.onload = function() { jam(); }
   
    function jam() {
     var e = document.getElementById('jam'),
     d = new Date(), h, m, s;
     h = d.getHours();
     m = set(d.getMinutes());
     s = set(d.getSeconds());
   
     e.innerHTML = h +':'+ m +':'+ s;
   
     setTimeout('jam()', 1000);
    }
   
    function set(e) {
     e = e < 10 ? '0'+ e : e;
     return e;
    }
   </script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
   // Data retrieved from https://gs.statcounter.com/vendor-market-share/mobile/
Highcharts.chart('container', {
    chart: {
        styledMode: true
    },
    title: {
        text: 'DATA KUNJUNGAN' 
    },
    subtitle: {
        text: '01-{{date('M-Y')}} sampai {{$ak}}'
    },
    series: [{
        type: 'pie',
        allowPointSelect: true,
        keys: ['name', 'y', 'selected', 'sliced'],
        data: [
            ['RODA 4', {{$rd41}}, false],
            ['RODA 2', {{$rd21}}, false],
            ['PEJALAN', {{$p1}}, false],
            ['MANCANEGARA',{{$m1}}, false],
        ],
        showInLegend: true
    }]
});
</script>
<script>
// Data retrieved https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature
Highcharts.chart('container1', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'DATA KUNJUNGAN'
    },
    subtitle: {
        text: 'TAHUN {{date('Y')}}'
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        accessibility: {
            description: 'Months of the year'
        }
    },
    yAxis: {
        title: {
            text: 'Jumlah Kunjungan'
        },
        labels: {
            formatter: function () {
                return this.value + ' Visitor';
            }
        }
    },
    tooltip: {
        crosshairs: true,
        shared: true
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: '#666666',
                lineWidth: 1
            }
        }
    },
    series: [{
        name: 'RODA 4',
        marker: {
            symbol: 'square'
        },
        data: [{{$blrde1}}, {{$blrde2}},{{$blrde3}},{{$blrde4}},{{$blrde5}},{{$blrde6}},{{$blrde7}}, {
            y: {{$blrde8}},
            
            accessibility: {
                description: 'Sunny symbol, this is the warmest point in the chart.'
            }
        }, {{$blrde9}},{{$blrde10}},{{$blrde11}},{{$blrde12}}]

    },

    {
      name: 'RODA 2',
        marker: {
            symbol: 'square'
        },
        data: [{{$blrdd1}}, {{$blrdd2}},{{$blrdd3}},{{$blrdd4}},{{$blrdd5}},{{$blrdd6}},{{$blrdd7}}, {
            y: {{$blrdd8}},
           
            accessibility: {
                description: 'Sunny symbol, this is the warmest point in the chart.'
            }
        },{{$blrdd9}},{{$blrdd10}},{{$blrdd11}},{{$blrdd12}}]

    },
    {
      name: 'PEJALAN',
        marker: {
            symbol: 'square'
        },
        data: [{{$blrdp1}}, {{$blrdp2}},{{$blrdp3}},{{$blrdp4}},{{$blrdp5}},{{$blrdp6}},{{$blrdp7}}, {
            y: {{$blrdp8}},
           
            accessibility: {
                description: 'Sunny symbol, this is the warmest point in the chart.'
            }
        }, {{$blrdp9}},{{$blrdp10}},{{$blrdp11}},{{$blrdp12}}]

    },
    {
        name: 'MANCANEGARA',
        marker: {
            symbol: 'diamond'
        },
        data: [{
            y:{{$blrdm1}},
           
            accessibility: {
                description: 'Snowy symbol, this is the coldest point in the chart.'
            }
        },{{$blrdm2}},{{$blrdm3}},{{$blrdm4}},{{$blrdm5}},{{$blrdm6}},{{$blrdm7}},{{$blrdm8}},{{$blrdm9}},{{$blrdm10}},{{$blrdm11}},{{$blrdm12}}]
    }]
});

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

@endsection