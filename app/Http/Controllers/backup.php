<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mqrcode;
use App\Karcis;
use App\Tabelvis;
use Carbon\Carbon;
use App\User;
use App\Exports\Vistorexp;
use App\Visitor;
use App\Kodeqris;
use Str;
use DB;
use App\Jobs\Proseswa;
use Auth;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('back.master');
    }

    public function pengunjung()
    {
        return view('back.tabelvis');
    }

    public function loadtabelvis()
    {
        $data = Tabelvis::orderBy('id', 'DESC');
        return Datatables::of($data)
         ->editColumn('hari', function ($data) {
             $waktu = $data->hari .'&nbsp;&nbsp;&nbsp;<span class="badge badge-dark">'.$data->jam.'</span>';
             return $waktu;
         })
         ->editColumn('jenis', function ($data) {
             if ($data->jenis ==  'RODA 4') {
                 $jenis = '<span class="text-danger" style="font-weight:900;">'.$data->jenis.'</span>';
             }
             if ($data->jenis ==  'RODA 2') {
                 $jenis = '<span class="text-warning" style="font-weight:900;">'.$data->jenis.'</span>';
             }
             if ($data->jenis ==  'PEJALAN') {
                 $jenis = '<span class="text-info" style="font-weight:900;">'.$data->jenis.'</span>';
             }
             return $jenis;
         })
         ->editColumn('wisatawan', function ($data) {
             if ($data->wisatawan ==  'Nusantara') {
                 $wisatawan = '<span style="font-weight:900;color:#04A600">'.$data->wisatawan.'</span>';
             }
             if ($data->wisatawan ==  'Mancanegara') {
                 $wisatawan = '<span style="font-weight:900;"color:#DE07C7">'.$data->wisatawan.'</span>';
             }

             return $wisatawan;
         })
         ->editColumn('total', function ($data) {
             $total = '<h1 class="badge" style="background-color:#4A07E1;color:white;font-size:18px">'.number_format($data->total, 0, ",", ".").'</h1>';
             return $total;
         })
         ->rawColumns(['hari','total','jenis','wisatawan'])
            ->addIndexColumn()
            ->make(true)
        ;
    }

    public function karcis()
    {
        $data = Karcis::get();
        return view('back.karcis', compact('data'));
    }
    public function posthapuskarcis(Request $request)
    {
        $id = $request->txtid;
        $hapus = Karcis::Findorfail($id)->delete();
        if ($hapus) {
            return back()->with('sukses', 'Berhasil di hapus');
        } else {
            return back()->with('gagal', 'Gagal di hapus');
        }
    }

    public function postupdatekarcis(Request $request)
    {
        if (Auth::user()->role !== "ADMIN") {
            return redirect('/');
        }
        $id = $request->txtid;
        $harga = $request->harga;
        $this->validate($request, [
           'harga' => 'required|numeric',
        ]);

        $update = Karcis::where('id', $id)->update([
            'harga' => $request->harga
        ]);

        if ($update) {
            return back()->with('sukses', 'Berhasil di update');
        } else {
            return back()->with('gagal', 'Gagal di update');
        }
    }

    public function user()
    {
        if (Auth::user()->role !== "ADMIN") {
            return redirect('/');
        }
        $data = User::get();
        return view('back.user', compact('data'));
    }
    public function posthapususer(Request $request)
    {
        if (Auth::user()->role !== "ADMIN") {
            return redirect('/');
        }
        $id = $request->txtid;
        $hapus = User::where('id', $id)->delete();
        if ($hapus) {
            return back()->with('sukses', 'Berhasil di hapus');
        } else {
            return back()->with('gagal', 'Gagal di hapus');
        }
    }
    public function postupdateuser(Request $request)
    {
        if (Auth::user()->role !== "ADMIN") {
            return redirect('/');
        }
        $id = $request->txtid;
        $this->validate($request, [
           'txtnama' => 'required',
         'txtnope' => 'required|numeric',
         'txtemail' => 'required',
         'txtrole' => 'required',

        ]);

        $update = User::where('id', $id)->update([
            'name' => $request->txtnama,
             'nope' =>  $request->txtnope,
              'email' => $request->txtemail,
               'role' => $request->txtrole,
        ]);

        if ($update) {
            return back()->with('sukses', 'Berhasil di update');
        } else {
            return back()->with('gagal', 'Gagal di update');
        }
    }

    public function datakunjungan()
    {
        return view('back.tabelkunjungan');
    }
    public function loadtabelkun(Request $request)
    {
        if (request()->ajax()) {
            if (empty($request->from_date)) {
                $data = Visitor::orderBy('id', 'DESC');
            }
            if (!empty($request->from_date)) {
                $data = Visitor::orderBy('id', 'DESC')
                        ->whereDate('tanggal', '>=', $request->from_date)
                        ->whereDate('tanggal', '<=', $request->to_date);
            }

            return Datatables::of($data)
         ->editColumn('hari', function ($data) {
             $waktu = $data->hari .'&nbsp;&nbsp;&nbsp;<span class="badge badge-dark">'.$data->jam.'</span>';
             return $waktu;
         })
         ->editColumn('jenis', function ($data) {
             if ($data->jenis ==  'RODA 4') {
                 $jenis = '<span class="text-danger" style="font-weight:900;">'.$data->jenis.'</span>';
             }
             if ($data->jenis ==  'RODA 2') {
                 $jenis = '<span class="text-warning" style="font-weight:900;">'.$data->jenis.'</span>';
             }
             if ($data->jenis ==  'PEJALAN') {
                 $jenis = '<span class="text-info" style="font-weight:900;">'.$data->jenis.'</span>';
             }
             return $jenis;
         })
        ->editColumn('harga', function ($data) {
            $harga = number_format($data->harga, 0, ",", ".");
            return $harga;
        })
        ->addcolumn('aksi', function ($data) {
            $kata = 'Tanggal '.$data->tanggal.'<br>Hari '.$data->hari.'<br>Jam'.$data->jam.'<br>Jenis '.$data->jenis.'<br>Harga '.$data->harga;
            $hapus = "<button style='padding:4px 7px 4px 7px' title='Selesai' class='btn btn-danger fas fa-check-circle  btn-md mt-1 ml-1' data-toggle='modal' data-target='#hapus'
            data-txtid='{$data->id}'
            data-txtkata='{$kata}'>
            
            </button>";
            return $hapus;
        })
         ->rawColumns(['hari','jenis','harga','aksi'])
            ->addIndexColumn()
            ->make(true)
        ;
        }
    }
    public function postvisitor($idjenis)
    {
        if (Auth::user()->role !== "PETUGAS") {
            return redirect('/');
        }
        $cari = Karcis::where('id', $idjenis)->first();
        if ($cari) {
            $jenis = $cari->jenis;
            $harga = $cari->harga;

            $day = Carbon::parse(date('Y-m-d'))->format('D');
            $hariArray = [
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu',
            'Sun' => 'Minggu',
        ];
            $tgl = date('Y-m-d');
            $tglh =  Carbon::parse(date('Y-m-d'))->format('d M Y');
            $jam = date('H:i');
            $hari = $hariArray[$day];
            $simpan = Visitor::insert([
            'tanggal' => $tgl,
            'hari' => $hari,
            'jam' => $jam,
            'jenis' => $jenis,
            'harga' => $harga,
         ]);

            if ($simpan) {
                $dua = Visitor::where('tanggal', date('Y-m-d'))->where('jenis', 'RODA 2')->count();
                $empat = Visitor::where('tanggal', date('Y-m-d'))->where('jenis', 'RODA 4')->count();
                $pe = Visitor::where('tanggal', date('Y-m-d'))->where('jenis', 'PEJALAN')->count();
                $totalvi = $dua+$empat+$pe;
                $totsum = Visitor::where('tanggal', $tgl)->sum('harga');
                $totsum1 = number_format($totsum, 0, ",", ".");
                $hargah = number_format($harga, 0, ",", ".");

                $nope ='';
                $pesan = "
*KUNJUNGAN*

📅 *Tgl. Scan*  : {$tglh}
📅 *Hari*  : {$hari}
🕐 *jam*   : {$jam}
❤️ *Jenis Kendaraan* : {$jenis}
💵 *Harga* : {$hargah}

*PENGUNJUNG SAAT INI:*

🛵 Roda 2 = *$dua* Kendaraan 
🚕 Roda 4 = *$empat* Kendaraan
🏃🏻‍♂️ PEJALAN = *$pe* Pejalan
📌 Total kunjungan saat ini *$totalvi*

💵 *Total Pendapatan:* Rp{$totsum1}


";

                Proseswa::dispatch($pesan, $nope)->delay(
                    now()->addSeconds(1)
                );
                return redirect('sukses')->with(['sukses' => 'Berhasil']);
            } else {
                return 'gagal';
            }
        } else {
            return 'qrcode tidak terdaftar';
        }
    }

    public function sukses()
    {
        if (Auth::user()->role !== "PETUGAS") {
            return redirect('/');
        }
        return view('back.sukses');
    }

    public function posthapuskunjungan(Request $request)
    {
        if (Auth::user()->role !== "ADMIN") {
            return redirect('/');
        }
        $id = $request->txtid;
        $hapus = Visitor::where('id', $id)->delete();
        if ($hapus) {
            return back()->with('sukses', 'Berhasil di hapus');
        } else {
            return back()->with('gagal', 'Gagal di hapus');
        }
    }

    public function printvisitor(Request $request)
    {
        $dr =  Carbon::parse($request->txtdari)->format('Y-m-d');
        $ke = Carbon::parse($request->txtke)->format('Y-m-d');
        return Excel::download(new Vistorexp($dr, $ke), date('d M Y').' - Tabel kunjungan'.$dr.'-'.$ke.'.xlsx');
    }

    public function postadduser(Request $request)
    {
        if (Auth::user()->role !== "ADMIN") {
            return redirect('/');
        }
        $this->validate($request, [
         'txtrole' => 'required',
         'txtnama' => 'required',
         'email' => 'required|email|unique:users',
         'txtnope' => 'required',

        ]);

        $pass = '123456';
        $simpan = User::insert([
            'name' => $request->txtnama,
            'email' => $request->email,
            'role' => $request->txtrole,
            'nope' => $request->txtnope,
            'password' => Hash::make($pass)
         ]);

        if ($simpan) {
            return back()->with('sukses', 'Berhasil di simpan');
        } else {
            return back()->with('gagal', 'Gagal di simpan');
        }
    }

    public function datakarcis()
    {
        $data = Kodeqris::orderBy('id', 'DESC')->get();
        return view('back.datakarcis', compact('data'));
    }

    public function postaddkode(Request $request)
    {
        $jumlah = $request->jumlah;
        $jenis = $request->jenis;
        $unik = date('YmdHis');
        $folder = '';
        if ($jenis == 'RODA2') {
            $folder = 'motor';
        }
        if ($jenis == 'RODA4') {
            $folder = 'mobil';
        }
        if ($jenis == 'PEJALAN') {
            $folder = 'pejalan';
        }
        for ($i = 1; $i <= $jumlah; $i++) {
            $random = Str::random(6).$unik;

            $simpan = Kodeqris::create([
            'jenis' => $jenis,
            'kode' => $random,
            'tanggalb' => date('Y-m-d'),
            'jamb' => date('H:i'),
            'status' => 'ready',
        ]);

            $output = storage_path("app/public/public/coba1.png"); // lokasi

            $input = storage_path('app/public/public/coba1.png'); // sumber gambar yang mau diolah
            $gambar = imagecreatefrompng($input);

            //warna
        $black = imagecolorallocate($gambar, 0, 0, 0); // ganti warna background gambar
        $white = imagecolorallocate($gambar, 255, 255, 255);

            // seting data textnya
            $font_size =  30;
            $rotasi =  0;
            $x_text =  89;
            $y_text = 190;
            $font_type = storage_path('app/public/public/Montserrat-Light.ttf');
            $text_input = 'nama';
            $text_input2 = 'jabatan';
            $text_input3 = 'email';
            $y_text2 =  228;
            $font_size2 =  20;

            $text1 = imagettftext($gambar, $font_size, $rotasi, $x_text, $y_text, $white, $font_type, $text_input); //pengaturan text pada gambar
         $text2 = imagettftext($gambar, $font_size2, $rotasi, $x_text, $y_text2, $white, $font_type, $text_input2); //pengatu

        imagepng($gambar, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(200)
                    ->backgroundColor(255, 255, 255)
                    ->generate($random, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefrompng($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 810;
            $qry = $cekidcard->qry ?? 260;
            $qrw = $cekidcard->qrw ?? 200;
            $qrh = $cekidcard->qrh ?? 200;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagepng($image, storage_path("app/public/public/{$folder}/{$simpan->kode}.png"));
            imagepng($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
                //  Output straight to the browser.
        }

        if ($simpan) {
            return back()->with('sukses', 'Berhasil di simpan');
        } else {
            return back()->with('gagal', 'Gagal di simpan');
        }
    }

    public function loadtabelkarcis(Request $request)
    {
        if (request()->ajax()) {
            if (empty($request->from_date)) {
                $data = Kodeqris::orderBy('id', 'DESC');
            }
            if (!empty($request->from_date)) {
                $data = Kodeqris::orderBy('id', 'DESC')
                        ->whereDate('tanggals', '>=', $request->from_date)
                        ->whereDate('tanggals', '<=', $request->to_date);
            }

            return Datatables::of($data)
         ->editColumn('tanggalb', function ($data) {
             $waktu = $data->tanggalb.' '.$data->jamb;
             return $waktu;
         })
         ->editColumn('jenis', function ($data) {
             $jenis ='';
             if ($data->jenis ==  'RODA4') {
                 $jenis = '<span class="text-danger" style="font-weight:900;">RODA 4</span>';
             }
             if ($data->jenis ==  'RODA2') {
                 $jenis = '<span class="text-warning" style="font-weight:900;">RODA 4</span>';
             }
             if ($data->jenis ==  'PEJALAN') {
                 $jenis = '<span class="text-info" style="font-weight:900;">PEJALAN</span>';
             }
             return $jenis;
         })

        ->addcolumn('aksi', function ($data) {
            $kata = $data->kode;
            $hapus = "<button style='padding:4px 7px 4px 7px' title='Selesai' class='btn btn-danger fas fa-check-circle  btn-md mt-1 ml-1' data-toggle='modal' data-target='#hapus'
            data-txtid='{$data->id}'
            data-txtkata='{$kata}'>
            
            </button>";
            return $hapus;
        })
         ->rawColumns(['tanggalb','jenis','aksi'])
            ->addIndexColumn()
            ->make(true)
        ;
        }
    }
}
