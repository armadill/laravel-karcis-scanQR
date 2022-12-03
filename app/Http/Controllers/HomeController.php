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
use App\ActivityLog;
use App\Kodeqris;
use Str;
use DB;
use App\Jobs\Proseswa;
use Auth;
use DataTables;
use Storage;
use File;
use Maatwebsite\Excel\Facades\Excel;
use Hash;
use Illuminate\Support\Arr;

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
        $p = Kodeqris::where('jenis', 'PEJALAN')->where('status', 'terpakai')->where('tanggals', date('Y-m-d'))->count();
        $m = Kodeqris::where('jenis', 'MANCANEGARA')->where('status', 'terpakai')->where('tanggals', date('Y-m-d'))->count();
        $rd2 = Kodeqris::where('jenis', 'RODA2')->where('status', 'terpakai')->where('tanggals', date('Y-m-d'))->count();
        $rd4 = Kodeqris::where('jenis', 'RODA4')->where('status', 'terpakai')->where('tanggals', date('Y-m-d'))->count();
        $bln = date('m');
        $tahun = date('Y');
        $totaltgl = cal_days_in_month(CAL_GREGORIAN, $bln, $tahun); // dapat jumlah tanggal
        $akhir = date('Y-m-').$totaltgl;
        $ak = Carbon::parse($akhir)->format('d-M-Y');

        $s1 = date('Y-m-').'01';
        $s2 = date('Y-m-').$totaltgl;

        $p1 = Kodeqris::where('jenis', 'PEJALAN')->where('status', 'terpakai')->whereBetween('tanggals', [$s1, $s2])->count();
        $m1 = Kodeqris::where('jenis', 'MANCANEGARA')->where('status', 'terpakai')->whereBetween('tanggals', [$s1, $s2])->count();
        $rd21 = Kodeqris::where('jenis', 'RODA2')->where('status', 'terpakai')->whereBetween('tanggals', [$s1, $s2])->count();
        $rd41 = Kodeqris::where('jenis', 'RODA4')->where('status', 'terpakai')->whereBetween('tanggals', [$s1, $s2])->count();

        $blrdd1 = Visitor::where('jenis', 'RODA 2')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '01')->count();
        $blrdd2 = Visitor::where('jenis', 'RODA 2')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '02')->count();
        $blrdd3 = Visitor::where('jenis', 'RODA 2')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '03')->count();
        $blrdd4 = Visitor::where('jenis', 'RODA 2')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '04')->count();
        $blrdd5 = Visitor::where('jenis', 'RODA 2')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '05')->count();
        $blrdd6 = Visitor::where('jenis', 'RODA 2')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '06')->count();
        $blrdd7 = Visitor::where('jenis', 'RODA 2')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '07')->count();
        $blrdd8 = Visitor::where('jenis', 'RODA 2')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '08')->count();
        $blrdd9 = Visitor::where('jenis', 'RODA 2')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '09')->count();
        $blrdd10 = Visitor::where('jenis', 'RODA 2')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '10')->count();
        $blrdd11 = Visitor::where('jenis', 'RODA 2')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '11')->count();
        $blrdd12 = Visitor::where('jenis', 'RODA 2')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '12')->count();



        $blrde1 = Visitor::where('jenis', 'RODA 4')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '01')->count();
        $blrde2 = Visitor::where('jenis', 'RODA 4')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '02')->count();
        $blrde3 = Visitor::where('jenis', 'RODA 4')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '03')->count();
        $blrde4 = Visitor::where('jenis', 'RODA 4')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '04')->count();
        $blrde5 = Visitor::where('jenis', 'RODA 4')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '05')->count();
        $blrde6 = Visitor::where('jenis', 'RODA 4')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '06')->count();
        $blrde7 = Visitor::where('jenis', 'RODA 4')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '07')->count();
        $blrde8 = Visitor::where('jenis', 'RODA 4')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '08')->count();
        $blrde9 = Visitor::where('jenis', 'RODA 4')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '09')->count();
        $blrde10 = Visitor::where('jenis', 'RODA 4')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '10')->count();
        $blrde11 = Visitor::where('jenis', 'RODA 4')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '11')->count();
        $blrde12 = Visitor::where('jenis', 'RODA 4')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '12')->count();




        $blrdp1 = Visitor::where('jenis', 'PEJALAN')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '01')->count();
        $blrdp2 = Visitor::where('jenis', 'PEJALAN')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '02')->count();
        $blrdp3 = Visitor::where('jenis', 'PEJALAN')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '03')->count();
        $blrdp4 = Visitor::where('jenis', 'PEJALAN')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '04')->count();
        $blrdp5 = Visitor::where('jenis', 'PEJALAN')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '05')->count();
        $blrdp6 = Visitor::where('jenis', 'PEJALAN')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '06')->count();
        $blrdp7 = Visitor::where('jenis', 'PEJALAN')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '07')->count();
        $blrdp8 = Visitor::where('jenis', 'PEJALAN')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '08')->count();
        $blrdp9 = Visitor::where('jenis', 'PEJALAN')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '09')->count();
        $blrdp10 = Visitor::where('jenis', 'PEJALAN')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '10')->count();
        $blrdp11 = Visitor::where('jenis', 'PEJALAN')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '11')->count();
        $blrdp12 = Visitor::where('jenis', 'PEJALAN')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '12')->count();


        $blrdm1 = Visitor::where('jenis', 'MANCANEGARA')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '01')->count();
        $blrdm2 = Visitor::where('jenis', 'MANCANEGARA')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '02')->count();
        $blrdm3 = Visitor::where('jenis', 'MANCANEGARA')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '03')->count();
        $blrdm4 = Visitor::where('jenis', 'MANCANEGARA')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '04')->count();
        $blrdm5 = Visitor::where('jenis', 'MANCANEGARA')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '05')->count();
        $blrdm6 = Visitor::where('jenis', 'MANCANEGARA')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '06')->count();
        $blrdm7 = Visitor::where('jenis', 'MANCANEGARA')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '07')->count();
        $blrdm8 = Visitor::where('jenis', 'MANCANEGARA')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '08')->count();
        $blrdm9 = Visitor::where('jenis', 'MANCANEGARA')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '09')->count();
        $blrdm10 = Visitor::where('jenis', 'MANCANEGARA')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '10')->count();
        $blrdm11 = Visitor::where('jenis', 'MANCANEGARA')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '11')->count();
        $blrdm12 = Visitor::where('jenis', 'MANCANEGARA')->whereYear('tanggal', date('Y'))->whereMonth('tanggal', '12')->count();




        return view('back.dashboard', compact('p', 'm', 'rd2', 'rd4', 'ak', 'p1', 'm1', 'rd21', 'rd41', 'blrdd1', 'blrdd2', 'blrdd3', 'blrdd4', 'blrdd5', 'blrdd6', 'blrdd7', 'blrdd8', 'blrdd9', 'blrdd10', 'blrdd11', 'blrdd12', 'blrde1', 'blrde2', 'blrde3', 'blrde4', 'blrde5', 'blrde6', 'blrde7', 'blrde8', 'blrde9', 'blrde10', 'blrde11', 'blrde12', 'blrdp1', 'blrdp2', 'blrdp3', 'blrdp4', 'blrdp5', 'blrdp6', 'blrdp7', 'blrdp8', 'blrdp9', 'blrdp10', 'blrdp11', 'blrdp12', 'blrdm1', 'blrdm2', 'blrdm3', 'blrdm4', 'blrdm5', 'blrdm6', 'blrdm7', 'blrdm8', 'blrdm9', 'blrdm10', 'blrdm11', 'blrdm12'));
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
             if ($data->jenis ==  'MANCANEGARA') {
                 $jenis = '<span class="text-primary" style="font-weight:900;">'.$data->jenis.'</span>';
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
        activity()->log('membuka menu karcis');
        $data = Karcis::get();
        return view('back.karcis', compact('data'));
    }
    public function posthapuskarcis(Request $request)
    {
        $id = $request->txtid;
        $data =  Karcis::where('id', $id)->get(0);
        $hapus = Karcis::Findorfail($id)->delete();
        if ($hapus) {
            activity()->log("mengahpus data karcis $data");
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

        $data = Karcis::where('id', $id)->get();
        $update = Karcis::where('id', $id)->update([
            'harga' => $request->harga
        ]);

        if ($update) {
            activity()->log("update data karcis $data menjadi $harga");
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
        activity()->log('membuka menu user');
        $data = User::where('email','<>','alman.bpp@gmail.com')->get();
        return view('back.user', compact('data'));
    }
    public function posthapususer(Request $request)
    {
        if (Auth::user()->role !== "ADMIN") {
            return redirect('/');
        }
        $id = $request->txtid;
        $nama =  User::where('id', $id)->first();
        $hapus = User::where('id', $id)->delete();
        if ($hapus) {
            activity()->log("delete user $nama->name");
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

        $data = User::where('id', $id)->get();

        $update = User::where('id', $id)->update([
            'name' => $request->txtnama,
             'nope' =>  $request->txtnope,
              'email' => $request->txtemail,
               'role' => $request->txtrole,
        ]);
        $data1 = User::where('id', $id)->get();
        if ($update) {
            activity()->log("update data user $data menjadi $data1 ");
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
                activity()->log("membuka menu data kunjungan");
                $data = Visitor::orderBy('id', 'DESC');
            }
            if (!empty($request->from_date)) {
                activity()->log("mencari data kunjungan dari tanggal $request->from_date sampai $request->to_date ");
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
             if ($data->jenis ==  'MANCANEGARA') {
                 $jenis = '<span class="text-primary" style="font-weight:900;">'.$data->jenis.'</span>';
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
    public function postvisitor($kodekarcis)
    {
        if (Auth::user()->role !== "PETUGAS") {
            activity()->log('HANYA AKUN PETUGAS YANG DAPAT MELAKUKAN SCAN!');
            return redirect('/')->with(['gagal' => 'HANYA AKUN PETUGAS YANG DAPAT MELAKUKAN SCAN!']);
        }
        $carikode = Kodeqris::where('kode', $kodekarcis)->first();
        if (!$carikode) {
             activity()->log("$kodekarcis Karcis tidak terdaftar!");
            return redirect('sukses')->with(['gagal' => 'Karcis tidak terdaftar!']);
        }
        if ($carikode->status == 'terpakai') {
             activity()->log("$kodekarcis Karcis sudah terpakai!");
            return redirect('sukses')->with(['gagal' => 'Karcis sudah terpakai!']);
        }

        $folder = '';
        $jenis = $carikode->jenis;
        if ($jenis == 'RODA2') {
            $jenis = 'RODA 2';
            $folder = 'motor';
        }
        if ($jenis == 'RODA4') {
            $jenis = 'RODA 4';
            $folder = 'mobil';
        }
        if ($jenis == 'PEJALAN') {
            $jenis = 'PEJALAN';
            $folder = 'pejalan';
        }
        if ($jenis == 'MACANEGARA') {
            $jenis = 'MACANEGARA';
            $folder = 'mancanegara';
        }


        $carijenis = Karcis::where('jenis', $jenis)->first();

        if (!$carijenis) {
             activity()->log('Jenis karcis tidak ditemukan!');
            return redirect('sukses')->with(['gagal' => 'Jenis karcis tidak ditemukan!']);
        }

        $jenis = $carijenis->jenis;
        $harga = $carijenis->harga;

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

        DB::beginTransaction();

        try {
            $simpan = Visitor::insert([
            'tanggal' => $tgl,
            'hari' => $hari,
            'jam' => $jam,
            'jenis' => $jenis,
            'harga' => $harga,
            'by' => Auth::user()->name,
         ]);


            $update = Kodeqris::where('kode', $kodekarcis)->where('status', 'ready')->update([
            'status' => 'terpakai',
            'tanggals' => date('Y-m-d'),
            'jams' => date('H:s'),
             'bys' => Auth::user()->name,
           ]);


            DB::commit();
            $file = $kodekarcis.'.png';
            unlink(storage_path("app/public/public/{$folder}/".$file));
            $dua = Visitor::where('tanggal', date('Y-m-d'))->where('jenis', 'RODA 2')->count();
            $empat = Visitor::where('tanggal', date('Y-m-d'))->where('jenis', 'RODA 4')->count();
            $pe = Visitor::where('tanggal', date('Y-m-d'))->where('jenis', 'PEJALAN')->count();
            $ma = Visitor::where('tanggal', date('Y-m-d'))->where('jenis', 'MANCANEGARA')->count();
            $totalvi = $dua+$empat+$pe+$ma;
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
✈️ Mancanegara = *$ma* Mancanegara
📌 Total kunjungan saat ini *$totalvi*

💵 *Total Pendapatan:* Rp{$totsum1}


";
            Proseswa::dispatch($pesan, $nope)->delay(now()->addSeconds(1));
            activity()->log('melakukan scan karcis');
            return redirect('sukses')->with(['sukses' => 'Berhasil!']);
        } catch (Exception $e) {
            DB::rollback();
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
        $data = Visitor::where('id', $id)->get();
        $hapus = Visitor::where('id', $id)->delete();
        if ($hapus) {
            activity()->log("mengahapus data kunjungan $data");
            return back()->with('sukses', 'Berhasil di hapus');
        } else {
            return back()->with('gagal', 'Gagal di hapus');
        }
    }

    public function printvisitor(Request $request)
    {
        $dr =  Carbon::parse($request->txtdari)->format('Y-m-d');
        $ke = Carbon::parse($request->txtke)->format('Y-m-d');
        activity()->log("print data kunjungan dari $dr sampai $ke");
        return Excel::download(new Vistorexp($dr, $ke), date('d M Y'). ' - Tabel kunjungan '.$dr.'-'.$ke.'.xlsx');
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
         'txtpass' => 'required',

        ]);

        $pass = $request->txtpass;
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
        if (Auth::user()->role == "PETUGAS") {
            return redirect('/');
        }
        $data = Kodeqris::orderBy('id', 'DESC')->get();
        $p = Kodeqris::where('jenis', 'PEJALAN')->where('status', 'ready')->count();
        $m = Kodeqris::where('jenis', 'MANCANEGARA')->where('status', 'ready')->count();
        $rd2 = Kodeqris::where('jenis', 'RODA2')->where('status', 'ready')->count();
        $rd4 = Kodeqris::where('jenis', 'RODA4')->where('status', 'ready')->count();

        $p1 = Kodeqris::where('jenis', 'PEJALAN')->where('status', 'ready')->orderby('noseri', 'DESC')->first();
        $m1 = Kodeqris::where('jenis', 'MANCANEGARA')->where('status', 'ready')->orderby('noseri', 'DESC')->first();
        $rd21 = Kodeqris::where('jenis', 'RODA2')->where('status', 'ready')->orderby('noseri', 'DESC')->first();
        $rd41 = Kodeqris::where('jenis', 'RODA4')->where('status', 'ready')->orderby('noseri', 'DESC')->first();

        return view('back.datakarcis', compact('data', 'p', 'm', 'rd2', 'rd4', 'p1', 'm1', 'rd21', 'rd41'));
    }

    public function postaddkode(Request $request)
    {
        if (Auth::user()->role !== "ADMIN") {
            return redirect('/');
        }

        $this->validate($request, [
           'jumlah' => 'required',
           'noseri' => 'required|unique:kodeqris,noseri'

        ]);

        $link= env('APP_URL').'r/';
        $jumlah = $request->jumlah;
        $jenis = $request->jenis;
        $folder = '';
        $template = '';
        if ($jenis == 'RODA2') {
            $folder = 'motor';
            $template = 'motor1';
        }
        if ($jenis == 'RODA4') {
            $folder = 'mobil';
            $template = 'mobil1';
        }
        if ($jenis == 'PEJALAN') {
            $folder = 'pejalan';
            $template = 'pejalan1';
        }
        if ($jenis == 'MANCANEGARA') {
            $folder = 'mancanegara';
            $template = 'mancanegara1';
        }

        for ($i = 1; $i <= $jumlah; $i++) {
            $acak =  Str::random(4);
            $unik  = date('Ymd');
            $noseri = str_pad($request->noseri++, 6, "0", STR_PAD_LEFT);
            $random = $noseri.'-'.$unik.$acak;
            $simpan = Kodeqris::create([
            'jenis' => $jenis,
            'kode' => $random,
            'tanggalb' => date('Y-m-d'),
            'jamb' => date('H:i'),
            'status' => 'ready',
            'noseri' => $noseri,
        ]);

            $output = storage_path("app/public/public/coba1.png"); // lokasi

            $input = storage_path("app/public/public/{$template}.jpeg"); // sumber gambar yang mau diolah
            $gambar = imagecreatefromjpeg($input);

            //warna
        $black = imagecolorallocate($gambar, 0, 0, 0); // ganti warna background gambar
        $white = imagecolorallocate($gambar, 255, 255, 255);

            // seting data textnya
            $font_size =  25;
            $rotasi =  0;
            $rotasi2 =  270;
            $x_text = 110;
            $y_text = 55;
            $font_type = storage_path('app/public/public/FontsFree-Net-ww.ttf');
            $text_input = $noseri;
            $text_input2 = $noseri;
            $text_input3 = '';
            $y_text2 = 90;
            $x_text2 = 1550;
            $font_size2 =  25;

            $text1 = imagettftext($gambar, $font_size, $rotasi, $x_text, $y_text, $black, $font_type, $text_input); //pengaturan text pada gambar
    $text2 = imagettftext($gambar, $font_size2, $rotasi2, $x_text2, $y_text2, $black, $font_type, $text_input2); //pengatu

        imagejpeg($gambar, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    // ->gradient(145, 197, 237, 8, 32, 50,  'diagonal')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$random, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 888;
            $qry = $cekidcard->qry ?? 404;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/{$folder}/{$simpan->kode}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
            //  Output straight to the browser.

            // -----------------------------------------------------------------
                //buat lagi qrcode nya
                  $input1 = storage_path("app/public/public/{$folder}/{$simpan->kode}.png"); // sumber gambar yang mau diolah
                  $gambar1 = imagecreatefromjpeg($input1);

            imagejpeg($gambar1, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->setForegroundColor(['r' => 255, 'g' => 0, 'b' => 0, 'a' => 0]);
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$random, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 1265;
            $qry = $cekidcard->qry ?? 240;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/{$folder}/{$simpan->kode}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
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
        if (Auth::user()->role == "PETUGAS") {
            return redirect('/');
        }
        if (request()->ajax()) {
            if (empty($request->from_date)) {
                activity()->log("membuka menu data karcis");
                $data = Kodeqris::orderBy('id', 'DESC');
            }
            if (!empty($request->from_date)) {
                activity()->log("mencari data karcis dari $request->from_date $request->to_date");
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
                 $jenis = '<span class="text-warning" style="font-weight:900;">RODA 2</span>';
             }
             if ($data->jenis ==  'PEJALAN') {
                 $jenis = '<span class="text-info" style="font-weight:900;">PEJALAN</span>';
             }
             if ($data->jenis ==  'MANCANEGARA') {
                 $jenis = '<span class="text-primary" style="font-weight:900;">MANCANEGARA</span>';
             }
             return $jenis;
         })

        ->editColumn('status', function ($data) {
            $status ='';
            if ($data->status ==  'terpakai') {
                $status = '<span class="badge badge-danger" style="font-weight:900;">Terpakai</span>';
            }
            if ($data->status ==  'ready') {
                $status = '<span class="badge badge-success" style="font-weight:900;">&nbsp;&nbsp;&nbsp;Ready&nbsp;&nbsp;</span>';
            }
            return $status;
        })

        ->addcolumn('aksi', function ($data) {
            $kata = $data->kode;
            $folder = '';
            if ($data->jenis == 'RODA2') {
                $folder = 'motor';
            }
            if ($data->jenis == 'RODA4') {
                $folder = 'mobil';
            }
            if ($data->jenis == 'PEJALAN') {
                $folder = 'pejalan';
            }
            if ($data->jenis == 'MANCANEGARA') {
                $folder = 'mancanegara';
            }
            $hapus = "<button style='padding:4px 7px 4px 7px' title='Selesai' class='btn btn-danger fas fa-check-circle  btn-md mt-1 ml-1' data-toggle='modal' data-target='#hapus'
            data-txtid='{$data->id}'
            data-txtkodeqris='{$data->kode}'
            data-txtfolder='{$folder}'
            data-txtkata='{$kata}'>
            
            </button>";
            return $hapus;
        })
         ->rawColumns(['tanggalb','jenis','aksi','status'])
            ->addIndexColumn()
            ->make(true)
        ;
        }
    }

    public function alman2()
    {
        $data = Kodeqris::where('status', 'ready')->where('jenis', 'RODA2')->orderby('noseri', 'asc')->get();

        foreach ($data as $key) {
            $link= env('APP_URL').'r/';
            $random = $key->kode;


            $output = storage_path("app/public/public/coba1.png"); // lokasi

            $input = storage_path("app/public/public/motor1.jpeg"); // sumber gambar yang mau diolah
            $gambar = imagecreatefromjpeg($input);

            //warna
        $black = imagecolorallocate($gambar, 0, 0, 0); // ganti warna background gambar
        $white = imagecolorallocate($gambar, 255, 255, 255);

            // seting data textnya
            $font_size =  25;
            $rotasi =  0;
            $rotasi2 =  270;
            $x_text = 110;
            $y_text = 55;
            $font_type = storage_path('app/public/public/FontsFree-Net-ww.ttf');
            $text_input = $key->noseri;
            $text_input2 = $key->noseri;
            $text_input3 = '';
            $y_text2 = 90;
            $x_text2 = 1550;
            $font_size2 =  25;

            $text1 = imagettftext($gambar, $font_size, $rotasi, $x_text, $y_text, $black, $font_type, $text_input); //pengaturan text pada gambar
    $text2 = imagettftext($gambar, $font_size2, $rotasi2, $x_text2, $y_text2, $black, $font_type, $text_input2); //pengatu

        imagejpeg($gambar, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    // ->gradient(145, 197, 237, 8, 32, 50,  'diagonal')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$random, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 888;
            $qry = $cekidcard->qry ?? 404;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/motor/{$key->kode}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
            //  Output straight to the browser.

            // -----------------------------------------------------------------
                //buat lagi qrcode nya
                  $input1 = storage_path("app/public/public/motor/{$key->kode}.png"); // sumber gambar yang mau diolah
                  $gambar1 = imagecreatefromjpeg($input1);

            imagejpeg($gambar1, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->setForegroundColor(['r' => 255, 'g' => 0, 'b' => 0, 'a' => 0]);
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$random, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 1265;
            $qry = $cekidcard->qry ?? 240;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/motor/{$key->kode}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
                //  Output straight to the browser.
        }
    }

    public function alman4()
    {
        $data = Kodeqris::where('status', 'ready')->where('jenis', 'RODA4')->orderby('noseri', 'asc')->get();

        foreach ($data as $key) {
            $link= env('APP_URL').'r/';
            $random = $key->kode;


            $output = storage_path("app/public/public/coba1.png"); // lokasi

            $input = storage_path("app/public/public/mobil1.jpeg"); // sumber gambar yang mau diolah
            $gambar = imagecreatefromjpeg($input);

            //warna
        $black = imagecolorallocate($gambar, 0, 0, 0); // ganti warna background gambar
        $white = imagecolorallocate($gambar, 255, 255, 255);

            // seting data textnya
            $font_size =  25;
            $rotasi =  0;
            $rotasi2 =  270;
            $x_text = 110;
            $y_text = 55;
            $font_type = storage_path('app/public/public/FontsFree-Net-ww.ttf');
            $text_input = $key->noseri;
            $text_input2 = $key->noseri;
            $text_input3 = '';
            $y_text2 = 90;
            $x_text2 = 1550;
            $font_size2 =  25;

            $text1 = imagettftext($gambar, $font_size, $rotasi, $x_text, $y_text, $black, $font_type, $text_input); //pengaturan text pada gambar
    $text2 = imagettftext($gambar, $font_size2, $rotasi2, $x_text2, $y_text2, $black, $font_type, $text_input2); //pengatu

        imagejpeg($gambar, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    // ->gradient(145, 197, 237, 8, 32, 50,  'diagonal')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$random, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 888;
            $qry = $cekidcard->qry ?? 404;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/mobil/{$key->kode}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
            //  Output straight to the browser.

            // -----------------------------------------------------------------
                //buat lagi qrcode nya
                  $input1 = storage_path("app/public/public/mobil/{$key->kode}.png"); // sumber gambar yang mau diolah
                  $gambar1 = imagecreatefromjpeg($input1);

            imagejpeg($gambar1, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->setForegroundColor(['r' => 255, 'g' => 0, 'b' => 0, 'a' => 0]);
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$random, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 1265;
            $qry = $cekidcard->qry ?? 240;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/mobil/{$key->kode}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
                //  Output straight to the browser.
        }
    }
    public function almanp()
    {
        $data = Kodeqris::where('status', 'ready')->where('jenis', 'PEJALAN')->orderby('noseri', 'asc')->get();

        foreach ($data as $key) {
            $link= env('APP_URL').'r/';
            $random = $key->kode;


            $output = storage_path("app/public/public/coba1.png"); // lokasi

            $input = storage_path("app/public/public/pejalan1.jpeg"); // sumber gambar yang mau diolah
            $gambar = imagecreatefromjpeg($input);

            //warna
        $black = imagecolorallocate($gambar, 0, 0, 0); // ganti warna background gambar
        $white = imagecolorallocate($gambar, 255, 255, 255);

            // seting data textnya
            $font_size =  25;
            $rotasi =  0;
            $rotasi2 =  270;
            $x_text = 110;
            $y_text = 55;
            $font_type = storage_path('app/public/public/FontsFree-Net-ww.ttf');
            $text_input = $key->noseri;
            $text_input2 = $key->noseri;
            $text_input3 = '';
            $y_text2 = 90;
            $x_text2 = 1550;
            $font_size2 =  25;

            $text1 = imagettftext($gambar, $font_size, $rotasi, $x_text, $y_text, $black, $font_type, $text_input); //pengaturan text pada gambar
    $text2 = imagettftext($gambar, $font_size2, $rotasi2, $x_text2, $y_text2, $black, $font_type, $text_input2); //pengatu

        imagejpeg($gambar, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    // ->gradient(145, 197, 237, 8, 32, 50,  'diagonal')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$random, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 888;
            $qry = $cekidcard->qry ?? 404;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/pejalan/{$key->kode}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
            //  Output straight to the browser.

            // -----------------------------------------------------------------
                //buat lagi qrcode nya
                  $input1 = storage_path("app/public/public/pejalan/{$key->kode}.png"); // sumber gambar yang mau diolah
                  $gambar1 = imagecreatefromjpeg($input1);

            imagejpeg($gambar1, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->setForegroundColor(['r' => 255, 'g' => 0, 'b' => 0, 'a' => 0]);
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$random, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 1265;
            $qry = $cekidcard->qry ?? 240;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/pejalan/{$key->kode}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
                //  Output straight to the browser.
        }
    }

    public function almanm()
    {
        $data = Kodeqris::where('status', 'ready')->where('jenis', 'MANCANEGARA')->orderby('noseri', 'asc')->get();

        foreach ($data as $key) {
            $link= env('APP_URL').'r/';
            $random = $key->kode;


            $output = storage_path("app/public/public/coba1.png"); // lokasi

            $input = storage_path("app/public/public/mancanegara1.jpeg"); // sumber gambar yang mau diolah
            $gambar = imagecreatefromjpeg($input);

            //warna
        $black = imagecolorallocate($gambar, 0, 0, 0); // ganti warna background gambar
        $white = imagecolorallocate($gambar, 255, 255, 255);

            // seting data textnya
            $font_size =  25;
            $rotasi =  0;
            $rotasi2 =  270;
            $x_text = 110;
            $y_text = 55;
            $font_type = storage_path('app/public/public/FontsFree-Net-ww.ttf');
            $text_input = $key->noseri;
            $text_input2 = $key->noseri;
            $text_input3 = '';
            $y_text2 = 90;
            $x_text2 = 1550;
            $font_size2 =  25;

            $text1 = imagettftext($gambar, $font_size, $rotasi, $x_text, $y_text, $black, $font_type, $text_input); //pengaturan text pada gambar
    $text2 = imagettftext($gambar, $font_size2, $rotasi2, $x_text2, $y_text2, $black, $font_type, $text_input2); //pengatu

        imagejpeg($gambar, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    // ->gradient(145, 197, 237, 8, 32, 50,  'diagonal')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$random, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 888;
            $qry = $cekidcard->qry ?? 404;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/mancanegara/{$key->kode}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
            //  Output straight to the browser.

            // -----------------------------------------------------------------
                //buat lagi qrcode nya
                  $input1 = storage_path("app/public/public/mancanegara/{$key->kode}.png"); // sumber gambar yang mau diolah
                  $gambar1 = imagecreatefromjpeg($input1);

            imagejpeg($gambar1, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->setForegroundColor(['r' => 255, 'g' => 0, 'b' => 0, 'a' => 0]);
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$random, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 1265;
            $qry = $cekidcard->qry ?? 240;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/mancanegara/{$key->kode}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
                //  Output straight to the browser.
        }
    }

    public function dlroda2()
    {
        if (Auth::user()->role !== "ADMIN") {
            activity()->log("gagal akses download roda 2");
            return back()->with('gagal', 'ANDA TIDAK MEMILIKI AKSES INI');
        }
        $data = Kodeqris::where('jenis', 'RODA2')->where('status', 'ready')->get();
        if ($data->count() < 1) {
            activity()->log("gagal download roda 2 tidak ada karcis yang ready");
            return back()->with('gagal', 'Tidak ada karcis yang ready');
        }




        $zip_file = 'KARCISRODA2.zip'; // Name of our archive to download

        // Initializing PHP class
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);


        foreach ($data as $key) {
            $kode = $key->kode;
            $datafile = "app/public/public/motor/{$kode}.png";
            $zip->addFile(storage_path($datafile), basename($datafile));
        }

        // Adding file: second parameter is what will the path inside of the archive
        // So it will create another folder called "storage/" inside ZIP, and put the file there.

        $zip->close();

        // We return the file immediately after download
        activity()->log("download karcis roda 2");
        return response()->download($zip_file);

        // $zip = new \ZipArchive();

        // $fileName = 'KARCISRODA2.zip';

        // if ($zip->open(public_path($fileName), \ZipArchive::CREATE) === TRUE)
        // {
        //     $files = File::files(storage_path('app/public/public/motora'));

        //     foreach ($files as $key => $value) {
        //         $relativeNameInZipFile = basename($value);
        //         $zip->addFile($value, $relativeNameInZipFile);
        //     }

        //     $zip->close();
        // }

        // return response()->download(public_path($fileName));
    }


    public function dlroda4()
    {
        if (Auth::user()->role !== "ADMIN") {
            activity()->log("gagal akses download roda 4");
            return back()->with('gagal', 'ANDA TIDAK MEMILIKI AKSES INI');
        }
        $data = Kodeqris::where('jenis', 'RODA4')->where('status', 'ready')->get();
        if ($data->count() < 1) {
            activity()->log("gagal download roda 4 tidak ada karcis yang ready");
            return back()->with('gagal', 'Tidak ada karcis yang ready');
        }
        $zip_file = 'KARCISRODA4.zip'; // Name of our archive to download

        // Initializing PHP class
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);



        foreach ($data as $key) {
            $kode = $key->kode;
            $datafile = "app/public/public/mobil/{$kode}.png";
            $zip->addFile(storage_path($datafile), basename($datafile));
        }

        // Adding file: second parameter is what will the path inside of the archive
        // So it will create another folder called "storage/" inside ZIP, and put the file there.

        $zip->close();

        // We return the file immediately after download
        activity()->log("download karcis roda 4");
        return response()->download($zip_file);
    }


    public function dlpejalan()
    {
        if (Auth::user()->role !== "ADMIN") {
            activity()->log("gagal akses download pejalan");
            return back()->with('gagal', 'ANDA TIDAK MEMILIKI AKSES INI');
        }
        $data = Kodeqris::where('jenis', 'PEJALAN')->where('status', 'ready')->get();
        if ($data->count() < 1) {
            activity()->log("gagal download pejalan tidak ada karcis yang ready");
            return back()->with('gagal', 'Tidak ada karcis yang ready');
        }
        $zip_file = 'KARCISPEJALAN.zip'; // Name of our archive to download

        // Initializing PHP class
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);


        foreach ($data as $key) {
            $kode = $key->kode;
            $datafile = "app/public/public/pejalan/{$kode}.png";
            $zip->addFile(storage_path($datafile), basename($datafile));
        }

        // Adding file: second parameter is what will the path inside of the archive
        // So it will create another folder called "storage/" inside ZIP, and put the file there.

        $zip->close();

        // We return the file immediately after download
        activity()->log("download karcis pejalan");
        return response()->download($zip_file);
    }

    public function dlmancanegara()
    {
        if (Auth::user()->role !== "ADMIN") {
            activity()->log("gagal akses download mancanegara");
            return back()->with('gagal', 'ANDA TIDAK MEMILIKI AKSES INI');
        }
        $data = Kodeqris::where('jenis', 'MANCANEGARA')->where('status', 'ready')->get();
        if ($data->count() < 1) {
            activity()->log("gagal download mancanegara tidak ada karcis yang ready");
            return back()->with('gagal', 'Tidak ada karcis yang ready');
        }

        $zip_file = 'KARCISMANCANEGARA.zip'; // Name of our archive to download
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $data = Kodeqris::where('jenis', 'MANCANEGARA')->where('status', 'ready')->get();
        foreach ($data as $key) {
            $kode = $key->kode;
            $datafile = "app/public/public/mancanegara/{$kode}.png";
            $zip->addFile(storage_path($datafile), basename($datafile));
        }

        // Adding file: second parameter is what will the path inside of the archive
        // So it will create another folder called "storage/" inside ZIP, and put the file there.

        $zip->close();

        // We return the file immediately after download
        activity()->log("download karcis mancanegara");
        return response()->download($zip_file);
    }

    public function posthapuskodekarcis(Request $request)
    {
        if (Auth::user()->role !== "ADMIN") {
            return redirect('/');
        }
        $data =  Kodeqris::where('id', $request->txtid)->get();
        $hapus = Kodeqris::where('id', $request->txtid)->delete();
        if ($hapus) {
            $file = $request->txtkodeqris.'.png';
            $folder = $request->txtfolder;
            unlink(storage_path("app/public/public/{$folder}/".$file));
            activity()->log("delete data karcis $data");
            return back()->with('sukses', 'Berhasil di hapus');
        } else {
            return back()->with('gagal', 'Gagal di hapus');
        }
    }

    public function profil()
    {
        activity()->log("membuka menu profil");
        return view('back.profil');
    }


    public function updatepass(Request $request)
    {
        $this->validate($request, [
           'txtemail' => 'required|email',
           'txtnope' => 'required',


        ]);

        $data = User::where('id', Auth::user()->id)->get();
        $update = User::where('id', Auth::user()->id)->update([
            'email' => $request->txtemail,
            'nope' => $request->txtnope
        ]);

        $data1 = User::where('id', Auth::user()->id)->get();
        if ($update) {
            activity()->log("update profil $data menjadi $data1");
            return back()->with('sukses', 'Berhasil di update');
        } else {
            return back()->with('gagal', 'Gagal di update');
        }
    }

    public function updatepassa(Request $request)
    {
        $this->validate($request, [
           'passold' => 'required',
           'passnew' => 'required',
           'passnew1' => 'required',


        ]);

        $txtoldpass = $request->passold;
        $txtnewpass = $request->passnew;
        $txtpasconfirm = $request->passnew1;
        $data = User::findOrFail(Auth::user()->id);

        if ($txtnewpass != $txtpasconfirm) {
            activity()->log("gagal ganti password, Password baru dan password konfirmasi harus sama");
            return back()->with('gagal', 'Gagal, Password baru dan password konfirmasi harus sama');
        }
        if (Hash::check($txtoldpass, $data->password) && $txtnewpass == $txtpasconfirm) {
            $updatePassword = User::where('id', Auth::user()->id)
                ->update(['password' => bcrypt($txtnewpass)])
            ;

            return back()->with('sukses', 'Sukses, Password diganti');
        } else {
            activity()->log("gagal ganti password,Password lama anda salah");
            return back()->with('gagal', 'Gagal, Password lama anda salah');
        }

        $update = User::where('id', Auth::user()->id)->update([
            'email' => $request->txtemail,
            'nope' => $request->txtnope
        ]);

        if ($update) {
            activity()->log("berhasil mengganti password");
            return back()->with('sukses', 'Berhasil di update');
        } else {
            return back()->with('gagal', 'Gagal di update');
        }
    }

    public function logalman(){
        if(Auth::user()->email <> 'alman.bpp@gmail.com'){
             return redirect('/');
        }

        $data = DB::table('users')
                ->join('activity_log', 'activity_log.causer_id', '=', 'users.id')
                ->where('users.email','<>','alman.bpp@gmail.com')
                ->orderby('activity_log.created_at','DESC')->get();
                 return view('back.log', compact('data'));
    }

    public function printscanedp(){
        if (Auth::user()->role !== "ADMIN") {
            return redirect('/');
        }

        $link= env('APP_URL').'r/';
        $pejalan =  Kodeqris::where('jenis', 'pejalan')->where('status', 'terpakai')->get();
        foreach ($pejalan as $key) {
             $template = 'pejalan1';
             $noseri = substr($key->kode,0,6);
             $tiket = $key->kode;
             $jenisv= "pejalan-terpakai";

            $output = storage_path("app/public/public/coba1.png"); // lokasi

            $input = storage_path("app/public/public/{$template}.jpeg"); // sumber gambar yang mau diolah
            $gambar = imagecreatefromjpeg($input);

            //warna
        $black = imagecolorallocate($gambar, 0, 0, 0); // ganti warna background gambar
        $white = imagecolorallocate($gambar, 255, 255, 255);

            // seting data textnya
            $font_size =  25;
            $rotasi =  0;
            $rotasi2 =  270;
            $x_text = 110;
            $y_text = 55;
            $font_type = storage_path('app/public/public/FontsFree-Net-ww.ttf');
            $text_input = $noseri;
            $text_input2 = $noseri;
            $text_input3 = '';
            $y_text2 = 90;
            $x_text2 = 1550;
            $font_size2 =  25;

            $text1 = imagettftext($gambar, $font_size, $rotasi, $x_text, $y_text, $black, $font_type, $text_input); //pengaturan text pada gambar
    $text2 = imagettftext($gambar, $font_size2, $rotasi2, $x_text2, $y_text2, $black, $font_type, $text_input2); //pengatu

        imagejpeg($gambar, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    // ->gradient(145, 197, 237, 8, 32, 50,  'diagonal')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$tiket, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 888;
            $qry = $cekidcard->qry ?? 404;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/{$jenisv}/{$tiket}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
            //  Output straight to the browser.

            // -----------------------------------------------------------------
                //buat lagi qrcode nya
                  $input1 = storage_path("app/public/public/{$jenisv}/{$tiket}.png"); // sumber gambar yang mau diolah
                  $gambar1 = imagecreatefromjpeg($input1);

            imagejpeg($gambar1, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->setForegroundColor(['r' => 255, 'g' => 0, 'b' => 0, 'a' => 0]);
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$tiket, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 1265;
            $qry = $cekidcard->qry ?? 240;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/{$jenisv}/{$tiket}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
                //  Output straight to the browser.
        

           
        }

           
        
    }


    public function printscaned2(){
        if (Auth::user()->role !== "ADMIN") {
            return redirect('/');
        }

        $link= env('APP_URL').'r/';
        $pejalan =  Kodeqris::where('jenis', 'RODA2')->where('status', 'terpakai')->get();
        foreach ($pejalan as $key) {
             $template = 'motor1';
             $noseri = substr($key->kode,0,6);
             $tiket = $key->kode;
             $jenisv= "motor-terpakai";

            $output = storage_path("app/public/public/coba1.png"); // lokasi

            $input = storage_path("app/public/public/{$template}.jpeg"); // sumber gambar yang mau diolah
            $gambar = imagecreatefromjpeg($input);

            //warna
        $black = imagecolorallocate($gambar, 0, 0, 0); // ganti warna background gambar
        $white = imagecolorallocate($gambar, 255, 255, 255);

            // seting data textnya
            $font_size =  25;
            $rotasi =  0;
            $rotasi2 =  270;
            $x_text = 110;
            $y_text = 55;
            $font_type = storage_path('app/public/public/FontsFree-Net-ww.ttf');
            $text_input = $noseri;
            $text_input2 = $noseri;
            $text_input3 = '';
            $y_text2 = 90;
            $x_text2 = 1550;
            $font_size2 =  25;

            $text1 = imagettftext($gambar, $font_size, $rotasi, $x_text, $y_text, $black, $font_type, $text_input); //pengaturan text pada gambar
    $text2 = imagettftext($gambar, $font_size2, $rotasi2, $x_text2, $y_text2, $black, $font_type, $text_input2); //pengatu

        imagejpeg($gambar, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    // ->gradient(145, 197, 237, 8, 32, 50,  'diagonal')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$tiket, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 888;
            $qry = $cekidcard->qry ?? 404;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/{$jenisv}/{$tiket}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
            //  Output straight to the browser.

            // -----------------------------------------------------------------
                //buat lagi qrcode nya
                  $input1 = storage_path("app/public/public/{$jenisv}/{$tiket}.png"); // sumber gambar yang mau diolah
                  $gambar1 = imagecreatefromjpeg($input1);

            imagejpeg($gambar1, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->setForegroundColor(['r' => 255, 'g' => 0, 'b' => 0, 'a' => 0]);
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$tiket, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 1265;
            $qry = $cekidcard->qry ?? 240;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/{$jenisv}/{$tiket}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
                //  Output straight to the browser.
        

           
        }

           
        
    }

    public function printscaned4(){
        if (Auth::user()->role !== "ADMIN") {
            return redirect('/');
        }

        $link= env('APP_URL').'r/';
        $pejalan =  Kodeqris::where('jenis', 'RODA4')->where('status', 'terpakai')->get();
        foreach ($pejalan as $key) {
             $template = 'mobil1';
             $noseri = substr($key->kode,0,6);
             $tiket = $key->kode;
             $jenisv= "mobil-terpakai";

            $output = storage_path("app/public/public/coba1.png"); // lokasi

            $input = storage_path("app/public/public/{$template}.jpeg"); // sumber gambar yang mau diolah
            $gambar = imagecreatefromjpeg($input);

            //warna
        $black = imagecolorallocate($gambar, 0, 0, 0); // ganti warna background gambar
        $white = imagecolorallocate($gambar, 255, 255, 255);

            // seting data textnya
            $font_size =  25;
            $rotasi =  0;
            $rotasi2 =  270;
            $x_text = 110;
            $y_text = 55;
            $font_type = storage_path('app/public/public/FontsFree-Net-ww.ttf');
            $text_input = $noseri;
            $text_input2 = $noseri;
            $text_input3 = '';
            $y_text2 = 90;
            $x_text2 = 1550;
            $font_size2 =  25;

            $text1 = imagettftext($gambar, $font_size, $rotasi, $x_text, $y_text, $black, $font_type, $text_input); //pengaturan text pada gambar
    $text2 = imagettftext($gambar, $font_size2, $rotasi2, $x_text2, $y_text2, $black, $font_type, $text_input2); //pengatu

        imagejpeg($gambar, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    // ->gradient(145, 197, 237, 8, 32, 50,  'diagonal')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$tiket, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 888;
            $qry = $cekidcard->qry ?? 404;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/{$jenisv}/{$tiket}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
            //  Output straight to the browser.

            // -----------------------------------------------------------------
                //buat lagi qrcode nya
                  $input1 = storage_path("app/public/public/{$jenisv}/{$tiket}.png"); // sumber gambar yang mau diolah
                  $gambar1 = imagecreatefromjpeg($input1);

            imagejpeg($gambar1, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->setForegroundColor(['r' => 255, 'g' => 0, 'b' => 0, 'a' => 0]);
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$tiket, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 1265;
            $qry = $cekidcard->qry ?? 240;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/{$jenisv}/{$tiket}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
                //  Output straight to the browser.
        

           
        }

           
        
    }


    public function printscanedm(){
        if (Auth::user()->role !== "ADMIN") {
            return redirect('/');
        }

        $link= env('APP_URL').'r/';
        $pejalan =  Kodeqris::where('jenis', 'MANCANEGARA')->where('status', 'terpakai')->get();
        foreach ($pejalan as $key) {
             $template = 'mancanegara1';
             $noseri = substr($key->kode,0,6);
             $tiket = $key->kode;
             $jenisv= "mancanegara-terpakai";

            $output = storage_path("app/public/public/coba1.png"); // lokasi

            $input = storage_path("app/public/public/{$template}.jpeg"); // sumber gambar yang mau diolah
            $gambar = imagecreatefromjpeg($input);

            //warna
        $black = imagecolorallocate($gambar, 0, 0, 0); // ganti warna background gambar
        $white = imagecolorallocate($gambar, 255, 255, 255);

            // seting data textnya
            $font_size =  25;
            $rotasi =  0;
            $rotasi2 =  270;
            $x_text = 110;
            $y_text = 55;
            $font_type = storage_path('app/public/public/FontsFree-Net-ww.ttf');
            $text_input = $noseri;
            $text_input2 = $noseri;
            $text_input3 = '';
            $y_text2 = 90;
            $x_text2 = 1550;
            $font_size2 =  25;

            $text1 = imagettftext($gambar, $font_size, $rotasi, $x_text, $y_text, $black, $font_type, $text_input); //pengaturan text pada gambar
    $text2 = imagettftext($gambar, $font_size2, $rotasi2, $x_text2, $y_text2, $black, $font_type, $text_input2); //pengatu

        imagejpeg($gambar, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    // ->gradient(145, 197, 237, 8, 32, 50,  'diagonal')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$tiket, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 888;
            $qry = $cekidcard->qry ?? 404;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/{$jenisv}/{$tiket}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
            //  Output straight to the browser.

            // -----------------------------------------------------------------
                //buat lagi qrcode nya
                  $input1 = storage_path("app/public/public/{$jenisv}/{$tiket}.png"); // sumber gambar yang mau diolah
                  $gambar1 = imagecreatefromjpeg($input1);

            imagejpeg($gambar1, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(195)
                    ->backgroundColor(253, 193, 1)
                    // ->setForegroundColor(['r' => 255, 'g' => 0, 'b' => 0, 'a' => 0]);
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$tiket, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefromjpeg($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 1265;
            $qry = $cekidcard->qry ?? 240;
            $qrw = $cekidcard->qrw ?? 195;
            $qrh = $cekidcard->qrh ?? 195;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagejpeg($image, storage_path("app/public/public/{$jenisv}/{$tiket}.png"));
            imagejpeg($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
                //  Output straight to the browser.
        

           
        }

           
        
    }
}



