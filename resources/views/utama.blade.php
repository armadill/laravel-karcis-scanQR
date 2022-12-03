<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 <style type="text/css">
        body {
  background-image: url('storage/public/bg.png');
  background-repeat: repeat;
  max-width: max-content;
   margin: auto;

}
.container {
    border: 0px solid red;
    width: auto;
    height: auto;
     align-items: center;
}
    h1,h2,p,a{
        font-family: sans-serif;
        font-weight: normal;
    }
 
    .jam-digital-malasngoding {
        overflow: hidden;
        width: auto;
        margin: 3px auto;
    }
    .kotak{
        float: left;
        width: 110px;
        height: 100px;
    }
    .jam-digital-malasngoding p {
        color: black;
        font-size: 36px;
        text-align: center;
        margin-top: 5px;
    }
 
 
.clock {
    color: #000000;
    font-size: 36px;
    font-weight: bold;
    font-family: Orbitron;
    letter-spacing: 7px;
    text-align: center;
   


}

div.text {
    background: linear-gradient(-45deg, #6355a4, #6355a4, #e89a3e, #e89a3e);
    background-size: 300%;
    font-family: Arial, Helvetica, sans-serif;
    font-weight: 900;
    font-size: 5vw;
    letter-spacing: -5px;
    text-transform: uppercase;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: animated_text 10s ease-in-out infinite;
    -moz-animation: animated_text 10s ease-in-out infinite;
    -webkit-animation: animated_text 10s ease-in-out infinite;
}

@keyframes animated_text {
    0% { background-position: 0px 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0px 50%; }
}
    </style>

</head>
<body>
  

     
      <?php
         $tanggal = date('Y-m-d');
         $tampil = \Carbon\Carbon::parse($tanggal)->format('d M Y');
         $day = \Carbon\Carbon::parse($tanggal)->format('D');
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
        
         <div class="container">
        
            <div class="text">SCAN DISINI</div>
            <!-- <h1 style="font-size:24x;text-align:center;;font-weight:bold">SCAN DISINI</h1> -->
                <h2  style="text-align:center;font-weight:900;font-sze: 5vw">{{$tampil}}</h2>
                <h2  style="text-align:center;font-weight:900;font-sze: 5vw">{{$hari}}</h2>

<div id="MyClockDisplay" class="clock" onload="showTime()"></div>
<!--                 <div class="jam-digital-malasngoding">
    <div class="kotak">
        <p id="jam"></p>
    </div>
    <div class="kotak">
        <p id="menit"></p>
    </div>
    <div class="kotak">
        <p id="detik"></p>
    </div>
</div> -->
            <h2  style="text-align:center;font-weight:bold"> <img  src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
                        ->size(300)->errorCorrection('H')
                        ->generate($data->kode)) !!} "></h2>
               
         </div>
              
    </div>
    <script>
    window.setTimeout("waktu()", 1000);
 
    function waktu() {
        var waktu = new Date();
        setTimeout("waktu()", 1000);
        document.getElementById("jam").innerHTML = waktu.getHours();
        document.getElementById("menit").innerHTML = waktu.getMinutes();
        document.getElementById("detik").innerHTML = waktu.getSeconds();
    }
</script>

<script>
    function showTime(){
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    
    setTimeout(showTime, 1000);
    
}

showTime();
</script>

</body>
</html>
