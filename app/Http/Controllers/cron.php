<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mqrcode;
use App\Karcis;
use App\Tabelvis;
use App\Kodeqris;
use Carbon\Carbon;
use App\User;
use Str;
use DB;
use App\Jobs\Proseswa;
use Auth;
use Session;
use Illuminate\Support\Facades\Crypt;

class cron extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            // return view('')
        } else {
            return view('auth.login');
        }
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }

    public function qrcode()
    {
        $tgl = date('Y-m-d');
        $jam = date('H:i');
        $web = ENV('APP_URL');
        $kode =  $web.'masuk/'.Str::random(60);
        $total = '0';
        $day = Carbon::parse($tgl)->format('D');
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

        $simpan = Mqrcode::updateOrCreate(
            ['nama' => 'qrcode'],
            ['tanggal' => $tgl,
            'jam' => $jam,
            'hari' => $hari,
            'kode' => $kode]
        )->increment('total');
        ;
        dd($simpan);
    }

    public function index()
    {
        $data = Mqrcode::first();

        $encrypted = Crypt::encryptString($data->kode);
        $decrypted = Crypt::decryptString($encrypted);

        return view('utama', compact('data'));
    }

    public function masuk($link)
    {
        $web = ENV('APP_URL');
        $kode =  $web.'masuk/'.$link;
        $cek = Mqrcode::where('kode', $kode)->first();
        if ($cek->kode ?? 'gda' == $kode) {
            $karcis =  Karcis::get();
            $kode = $cek->kode;
            return view('visitor', compact('karcis', 'kode'));
        } else {
            echo 'gda';
        }
    }

    public function getjenis(Request $request)
    {
        $cek = Karcis::where('jenis', $request->jenis)->first();
        $harga = $cek->harga;
        $jumlah = $request->txtjumlah;
        $hasil = $jumlah * $harga;
        $total = number_format($hasil, 0, ",", ".");
        return response()->json([
                'sukses' => 'sukses',
                'pesan' =>'ok ada',
                'total' => $total,
                'ftotal' => $hasil,
            ]);
    }

    public function getjumlah(Request $request)
    {
        $cek = Karcis::where('jenis', $request->txtjenis)->first();
        $harga = $cek->harga;
        $jumlah = $request->jumlah;
        $hasil = $jumlah * $harga;
        $total = number_format($hasil, 0, ",", ".");
        return response()->json([
                'sukses' => 'sukses',
                'pesan' =>'ok ada',
                'total' => $total,
                'ftotal' => $hasil,
            ]);
    }

    public function postkirim(Request $request)
    {
        $jenis = $request->fjenis;
        $jumlah = $request->fjumlah;
        $wisata = $request->wisatawan;
        $total = $request->ftotal;
        $kode = $request->fkode;
        $jam = date('H:s');
        $tgl = Carbon::parse(date('Y-m-d'))->format('d M Y');
        $day = Carbon::parse($tgl)->format('D');
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

        $ftotal = 'Rp'.number_format($total, 0, ",", ".");

        $simpan = Tabelvis::create([
            'tanggal' =>$tgl,
            'hari' =>$hari,
            'jam' =>$jam,
            'kode' =>$kode,
            'jenis' =>$jenis,
            'wisatawan' =>$wisata,
            'jumlah' =>$jumlah,
            'total' => $total,
            'by' => Auth::user()->name,
        ]);

        if ($simpan) {
            $pesan =
"    *✅ DATA MASUK*
------------------------------

*🗓️ Tanggal:* $tgl 
*🕒 Jam:* $jam 
*🚗 Jenis:* $jenis
*🔢 Jumlah:* $jumlah
*💰 Total:* $ftotal
*👩🏻 Wisatawan:* $wisata";

            $admin = DB::table('users')->get();
            foreach ($admin as $key) {
                $nope = $key->nope;
                Proseswa::dispatch($pesan, $nope);
            }
            return response()->json([
                'sukses' => 'true',
                'pesan' =>'Terimakasih telah berkunjung',
                'redirect' =>'https://facebook.com',

            ]);
        } else {
            return response()->json([
                'sukses' => 'false',
                'pesan' =>'Terjadi kesalahan',
            ]);
        }
    }


    public function coba()
    {
        $admin = DB::table('users')->get();
        foreach ($admin as $key) {
            $nope = $key->nope;
            echo $nope;
        }
    }

    public function cektiket(){

       $p = Kodeqris::where('jenis', 'PEJALAN')->where('status', 'ready')->count();
        $m = Kodeqris::where('jenis', 'MANCANEGARA')->where('status', 'ready')->count();
        $rd2 = Kodeqris::where('jenis', 'RODA2')->where('status', 'ready')->count();
        $rd4 = Kodeqris::where('jenis', 'RODA4')->where('status', 'ready')->count(); 

        if($p <= 40 or $m <= 40 or $rd2 <= 40 or  $rd4 <= 40){
$pesan ="🎟️ *Stok karcis di bawah 50*
lakukan penambahan stok karcis di aplikasi 😉

------------------------------------------------
*Beikut data stok karcis saat ini*:
------------------------------------------------
🚕 RODA Empat : *$rd4*
🛵 RODA Dua : *$rd2*
🏃🏻‍♂️ PEJALAN : *$p*
✈️ MANCANEGARA : *$m*
";
                $link = env('APP_URL');
                $data = [
                    'api_key' => 'faaa17688df67fb57538c3d3b7232fd6e43a5c84',
                    'sender' => '62895623663095',
                    'number' => '120363029958938420@g.us',
                    'message' => $pesan,
                    'footer' => 'Klik link untuk masuk ke aplikasi ',
                    'template1' => 'url|CEK TIKET|'.$link,
                ];
                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL => 'https://mywhatsapp.my.id/send-template',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => [
                        'Content-Type: application/json',
                    ],
                ]);

                $response = curl_exec($curl);

                curl_close($curl);

        }
    }


}
