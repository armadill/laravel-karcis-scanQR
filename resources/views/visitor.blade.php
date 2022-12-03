<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,  minimum-scale=1.0"> 
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.33/sweetalert2.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        body {
  align-items: center;
  background-color: #000;
  display: flex;
  justify-content: center;
  background-image: url('storage/public/public/sukses.png');
  background-repeat: repeat-y;
}

.form {
  background-color: #15172b;
  border-radius: 20px;
  box-sizing: border-box;
  height: 700px;
  padding: 20px;
  width: 320px;
}

.title {
  color: #eee;
  font-family: sans-serif;
  font-size: 36px;
  font-weight: 600;
  margin-top: 30px;
}

.subtitle {
  color: #eee;
  font-family: sans-serif;
  font-size: 16px;
  font-weight: 600;
  margin-top: 10px;
}

.input-container {
  height: 50px;
  position: relative;
  width: 100%;
}

.ic1 {
  margin-top: 40px;
}

.ic2 {
  margin-top: 30px;
}

.input {
  background-color: #303245;
  border-radius: 12px;
  border: 0;
  box-sizing: border-box;
  color: #eee;
  font-size: 18px;
  height: 100%;
  outline: 0;
  padding: 4px 20px 0;
  width: 100%;
}

.cut {
  background-color: #15172b;
  border-radius: 10px;
  height: 20px;
  left: 20px;
  position: absolute;
  top: -20px;
  transform: translateY(0);
  transition: transform 200ms;
  width: 76px;
}

.cut-short {
  width: 50px;
}

.input:focus ~ .cut,
.input:not(:placeholder-shown) ~ .cut {
  transform: translateY(8px);
}

.placeholder {
  color: #65657b;
  font-family: sans-serif;
  left: 20px;
  line-height: 14px;
  pointer-events: none;
  position: absolute;
  transform-origin: 0 50%;
  transition: transform 200ms, color 200ms;
  top: 20px;
}

.input:focus ~ .placeholder,
.input:not(:placeholder-shown) ~ .placeholder {
  transform: translateY(-30px) translateX(10px) scale(0.75);
}

.input:not(:placeholder-shown) ~ .placeholder {
  color: #808097;
}

.input:focus ~ .placeholder {
  color: #dc2f55;
}

.submit {
  background-color: #08d;
  border-radius: 12px;
  border: 0;
  box-sizing: border-box;
  color: #eee;
  cursor: pointer;
  font-size: 18px;
  height: 50px;
  margin-top: 38px;
  // outline: 0;
  text-align: center;
  width: 100%;
}

.submit:active {
  background-color: #06b;
}

    </style>
</head>
<body>

       <div id="theDiv"></div>
      <div id="kotakform">
        <h1 id="sk" style="color:white"></h1>
        <div class="form">
      <div class="title">Selamat datang!</div>
      <div class="subtitle">Silahkan diisi</div>
       
        <form id="postjenis">
        @csrf
        <input type="hidden" id="txtjumlah" name="txtjumlah" value="1">
       <div class="input-container ic2">
        <select id="jenis" name="jenis" class="input" type="text" >
            <option value="-">PILIH</option>
           @foreach($karcis as $kc)
         <option value="{{$kc->jenis}}">{{$kc->jenis}} - {{number_format($kc->harga,0,',','.')}}</option>
        @endforeach
        </select>
        <div class="cut"></div>
        <label for="jenis" class="placeholder">Jenis Kendaraan</label>
      </div>
    </form>


      <form id="postjumlah">    
        @csrf
        <input type="hidden" id="txtjenis" name="txtjenis">
       <div class="input-container ic2">
        <select id="jumlah" name="jumlah" class="input" type="text" >
            <option value="1">1</option>
             <option value="2">2</option>
              <option value="3">3</option>
               <option value="4">4</option>
                <option value="5">5</option>
             <option value="6">6</option>
              <option value="7">7</option>
               <option value="8">8</option>
                <option value="9">9</option>
             <option value="10">10</option>
              <option value="11">11</option>
               <option value="12">12</option>
                <option value="13">13</option>
             <option value="14">14</option>
              <option value="15">15</option>
               <option value="16">16</option>
        </select>
        <div class="cut"></div>
        <label for="jumlah" class="placeholder">Jumlah</label>
      </div>
    </form>


      <form id="postkirim" class="from-prevent-multiple-submits">
        @csrf
      <input type="hidden" id="fjenis" name="fjenis">
      <input type="hidden" id="fjumlah" value="1" name="fjumlah">
      <input type="hidden" id="kode" value="{{$kode}}" name="fkode">
      <input type="hidden" id="ftotal" name="ftotal">
      <div class="input-container ic2">
        <select id="wisatawan" name="wisatawan" class="input" type="text" >
            <option value="Nusantara">Nusantara</option>
             <option value="Mancanegara">Mancanegara</option>
        </select>
        <div class="cut"></div>
        <label for="wisatawan" class="placeholder">Wisatawan</label>
      </div>

      <div class="input-container ic2">
        <h3 style="color:white">
          Tot. Bayar:
        </h3>
          <h3 style="color:#FFEB40">
          <p id="total"></p></h3>
      </div>
    <input type="submit" id="bt" class="submit from-prevent-multiple-submits"  value="Kirim">
    </div>
    </form>
      </div>

 
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.33/dist/sweetalert2.all.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous"></script>
<script type="text/javascript">
(function(){
$('.from-prevent-multiple-submits').on('submit', function(){
    $('.from-prevent-multiple-submits').attr('disabled','true');
})
})();
</script>
<script>
  $( document ).ready(function() {
    $( "#jumlah" ).prop( "disabled", true );
    $( "#wisatawan" ).prop( "disabled", true );
     $("#bt").prop("disabled", true);
});
</script>
<script>
    $('#jumlah').on('change', function() {
    var jumlah = $('#jumlah').val();
     $('#txtjumlah').val(jumlah);
     $('#fjumlah').val(jumlah);
});
</script>

<script>
    $('#jenis').on('change', function() {
    var jenis = $('#jenis').val();
      if(jenis !== '-'){
        $('#txtjenis').val(jenis);
        $('#fjenis').val(jenis);
         $( "#jumlah" ).prop( "disabled", false );
         $( "#wisatawan" ).prop( "disabled", false );
          $( "#submit" ).prop( "disabled", false );
            $("#bt").prop("disabled", false);
      }else {
          $( "#jumlah" ).prop( "disabled", true );
        $( "#wisatawan" ).prop( "disabled", true );
          $("#bt").prop("disabled", true);
         $( "#total" ).html('');
         $('#fjenis').val('-');


      }
     
});
</script>

<script>
   $(document).ready(function(){
   
    $('#postjenis').on('change', function(event){
     event.preventDefault();
     $.ajax({
      url:"{{ route('getjenis') }}",
      method:"POST",
      data:new FormData(this),
      dataType:'JSON',
      contentType: false,
      processData: false,
      success:function(data)
      {
   
        if(data.sukses == 'sukses'){ // if true (1)
        $('#total').html('Rp'+data.total);
        $('#ftotal').val(data.ftotal);
         
         }
         if(data.pesan == 'berhasil'){ // if true (1)
          
         }
      
      }
     })
    });
   
   });
</script>

<script>
   $(document).ready(function(){
   
    $('#postjumlah').on('change', function(event){
     event.preventDefault();
     $.ajax({
      url:"{{ route('getjumlah') }}",
      method:"POST",
      data:new FormData(this),
      dataType:'JSON',
      contentType: false,
      processData: false,
      success:function(data)
      {
   
        if(data.sukses == 'sukses'){ // if true (1)
          $('#total').html('Rp'+data.total);
          $('#ftotal').val(data.ftotal);
         
         }
         if(data.pesan == 'berhasil'){ // if true (1)
          
         }
      
      }
     })
    });
   
   });
</script>

<script>
   $(document).ready(function(){
   
    $('#postkirim').on('submit', function(event){
     event.preventDefault();
     $.ajax({
      url:"{{ route('postkirim') }}",
      method:"POST",
      data:new FormData(this),
      dataType:'JSON',
      contentType: false,
      processData: false,
      success:function(data)
      {
   
        if(data.sukses == 'true'){ // if true (1)
               Swal.fire({
        title: 'BERHASIL!',
  text: data.pesan,
  icon: 'success',
  confirmButtonText: 'OK'
 })
$('.form').hide();
$('#theDiv').prepend('<img width="100px" height="100px" id="theImg" src="{{url("storage/public/sukses.png")}}" />');
$('#sk').prepend('SUKSES');

SUKSES

         
         
         }
         if(data.pesan == 'false'){ // if true (1)
          alert(data.pesan);
         }
      
      }
     })
    });
   
   });
</script>

</html>


