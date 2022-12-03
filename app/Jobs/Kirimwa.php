<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
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
use App\Jobs\Kirimwa;
use Auth;
use DataTables;
use Storage;
use File;
use Hash;

class Kirimwa implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $link;
    protected $jumlah;
    protected $seri;
    protected $jenis;
    public function __construct($link, $jumlah, $seri, $jenis)
    {
        $this->link = $link;
        $this->jumlah = $jumlah;
        $this->seri = $seri;
        $this->jenis = $jenis;
    }



    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $jenis = $this->jenis;
        $jumlah = $this->jumlah;
        $link =  $this->link;
        $template ='';
        $folder ='';
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
            $noseri = str_pad($this->seri++, 6, "0", STR_PAD_LEFT);
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

            $input = storage_path("app/public/public/{$template}.png"); // sumber gambar yang mau diolah
            $gambar = imagecreatefrompng($input);

            //warna
        $black = imagecolorallocate($gambar, 0, 0, 0); // ganti warna background gambar
        $white = imagecolorallocate($gambar, 255, 255, 255);

            // seting data textnya
            $font_size =  21;
            $rotasi =  0;
            $rotasi2 =  270;
            $x_text = 90;
            $y_text = 45;
            $font_type = storage_path('app/public/public/FontsFree-Net-ww.ttf');
            $text_input = $noseri;
            $text_input2 = $noseri;
            $text_input3 = '';
            $y_text2 = 82;
            $x_text2 = 1240;
            $font_size2 =  21;

            $text1 = imagettftext($gambar, $font_size, $rotasi, $x_text, $y_text, $black, $font_type, $text_input); //pengaturan text pada gambar
    $text2 = imagettftext($gambar, $font_size2, $rotasi2, $x_text2, $y_text2, $black, $font_type, $text_input2); //pengatu

        imagepng($gambar, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(159)
                    ->backgroundColor(253, 193, 1)
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    // ->gradient(145, 197, 237, 8, 32, 50,  'diagonal')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$random, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefrompng($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 708;
            $qry = $cekidcard->qry ?? 320;
            $qrw = $cekidcard->qrw ?? 159;
            $qrh = $cekidcard->qrh ?? 159;

            imagecopymerge($image, $frame, $qrx, $qry, 0, 0, $qrw, $qrh, 100);
            // Save the image to a file
            imagepng($image, storage_path("app/public/public/{$folder}/{$simpan->kode}.png"));
            imagepng($image, storage_path("app/public/public/idcard.png"));
            // $depan  = Storage::copy('public/idcard/back.png', 'public/absensi/'.$cari->id.'/'.'back.png');
            //  Output straight to the browser.

            // -----------------------------------------------------------------
                //buat lagi qrcode nya
                  $input1 = storage_path("app/public/public/{$folder}/{$simpan->kode}.png"); // sumber gambar yang mau diolah
                  $gambar1 = imagecreatefrompng($input1);

            imagepng($gambar1, $output);

            // // buat juga qrcode nya

            $text_input3 = \QrCode::format('png')
                    ->size(159)
                    ->backgroundColor(253, 193, 1)
                    // ->setForegroundColor(['r' => 255, 'g' => 0, 'b' => 0, 'a' => 0]);
                    // ->backgroundColor(240, 202, 255, 75)
                    ->errorCorrection('H')->eye('circle')
                    ->mergeString(Storage::get('public/public/mobil.png'), .4)
                    ->generate($link.$random, storage_path("app/public/public/qrcode1.png"))
                ;

            $image = imagecreatefrompng($output);
            $frame = imagecreatefrompng(storage_path("app/public/public/qrcode1.png"));

            $qrx = $cekidcard->qrx ?? 1010;
            $qry = $cekidcard->qry ?? 190;
            $qrw = $cekidcard->qrw ?? 159;
            $qrh = $cekidcard->qrh ?? 159;

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
}
