<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB; 
use App\Sms; 
use App\Kontak; 
use App\Anggota; 
use App\Grub; 
use Auth;
use Session;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        //
        if ($request->ajax()) {
            # code...
            $sms = Sms::with(['kontak'])->where('pemilik_sms', Auth::user()->id);
            return Datatables::of($sms)->addColumn('action', function($outbox){
                    
                })->make(true);
        }
        $html = $htmlBuilder 
        ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Waktu'])  
        ->addColumn(['data' => 'isi_pesan', 'name' => 'isi_pesan', 'title' => 'Isi Pesan'])  
        ->addColumn(['data' => 'nomor_tujuan', 'name' => 'nomor_tujuan', 'title' => 'Ke'])  
        ->addColumn(['data' => 'jumlah_sms', 'name' => 'jumlah_sms', 'title' => 'Jumlah Sms'])    
        ->addColumn(['data' => 'status_kirim', 'name' => 'status_kirim', 'title' => 'Status'])      
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable'=>false]); 

        return view('sms.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $kontak = Kontak::where('pemilik_kontak', Auth::user()->id)->pluck('nama', 'id');
        return view('sms.create',['kontak' => $kontak]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function parsing_sms($isi_pesan,$nama_kontak){
     
        return $parsing_pesan;
    }

    public function store(Request $request)
    {
        //
        $id_user = Auth::user()->id;
        $this->validate($request,[
        'jumlah_sms' => 'required',
        'isi_pesan' => 'required|max:160',
        'id_kontak' => 'required|exists:kontaks,id',]);

    $kontak = Kontak::find($request->id_kontak);
    $nomor_tujuan = $kontak->nomor_hp;
    $status_kirim = 'Berhasil';

    $isi_pesan = str_replace("[nama]",$kontak->nama,$request->isi_pesan);
    $komentar = Sms::create([
    'pemilik_sms' => $id_user, 
    'jumlah_sms' => $request->jumlah_sms,
    'isi_pesan' => $isi_pesan,
    'id_kontak' => $request->id_kontak,
    'nomor_tujuan'=> $nomor_tujuan,
    'status_kirim'=> $status_kirim,]);
    $isi_pesan = urlencode($isi_pesan);
    $userkey = env('USERKEY');
    $passkey = env('PASSKEY');

if (env('STATUS_SMS') == 1) {
    file_get_contents("https://reguler.zenziva.net/apps/smsapi.php?userkey=$userkey&passkey=$passkey&nohp=$nomor_tujuan&pesan=$isi_pesan");
}
  Session::flash("flash_notification", [
    "level"=>"success",
    "message"=>"Berhasil Terkirim"
    ]); 

  return redirect()->back();
    }

    public function create_grup()
    {
        //
         $grub = Grub::where('pemilik_grub', Auth::user()->id)->pluck('nama_grub', 'id');
        return view('sms.create_grup',['grub' => $grub]);
    }

    public function store_grup(Request $request)
    {
        //
        $id_user = Auth::user()->id;
    $this->validate($request,[
        'isi_pesan' => 'required',
        'id_grup' => 'required|exists:grubs,id',]);

   $anggotas = Anggota::where('grub', $request->id_grup)->get();  
   $status_kirim = 'Berhasil';
    foreach ($anggotas as $anggota ) {
        # code..

$kontak = Kontak::find($anggota->kontak);

    $isi_pesan = str_replace("[nama]",$kontak->nama,$request->isi_pesan);
          $komentar = Sms::create([
    'pemilik_sms' => $id_user, 
    'isi_pesan' => $isi_pesan,
    'id_kontak' => $anggota->kontak,
    'nomor_tujuan'=> $kontak->nomor_hp,
    'status_kirim'=> $status_kirim,]);
    $isi_pesan = urlencode($isi_pesan);
    $userkey = env('USERKEY');
    $passkey = env('PASSKEY');

if (env('STATUS_SMS') == 1) {
    file_get_contents("https://reguler.zenziva.net/apps/smsapi.php?userkey=$userkey&passkey=$passkey&nohp=$kontak->nomor_hp&pesan=$isi_pesan");
}
    }


  Session::flash("flash_notification", [
    "level"=>"success",
    "message"=>"Berhasil Terkirim"
    ]); 

  return redirect()->back();



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
