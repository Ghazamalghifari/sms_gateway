<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB; 
use App\Anggota;
use App\Grub;
use App\Kontak;
use Auth;
use Session;


class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */   
    public function index(Request $request, Builder $htmlBuilder,$id)
    {
        //
        if ($request->ajax()) { 
            # code...
            $anggotas = Anggota::with(['grub','kontak'])->where('grub',$id);
            return Datatables::of($anggotas)->addColumn('action', function($anggota){
                    return view('grubs._keluar', [
                        'model'     => $anggota,
                        'form_url'  => route('anggotas.destroy', $anggota->id),
                        'edit_url'  => route('anggotas.edit', $anggota->id), 
                        'confirm_message'   => 'Yakin Mau Mengeluarkan Anggota Dari Grup ?',
                        ]);
                })->make(true);


        }


        $html = $htmlBuilder 
        ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'Id'])  
        ->addColumn(['data' => 'kontak.nama', 'name' => 'kontak.nama', 'title' => 'Nama'])  
        ->addColumn(['data' => 'kontak.nomor_hp', 'name' => 'kontak.nomor_hp', 'title' => 'Nomor Hp'])  
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable'=>false]);

        $grub = Grub::select(['id','pemilik_grub','nama_grub','jumlah_anggota'])->find($id);
        return view('grubs.anggota',['grub' => $grub])->with(compact('html'));
    }


    public function datatable_kontak(Request $request, Builder $htmlBuilder, $id)
    {
        //
        if ($request->ajax()) { 
            # code...
            $kontaks = Kontak::select(['id','pemilik_kontak','panggilan','nama','alamat','nomor_hp'])->where('pemilik_kontak', Auth::user()->id)->get(); 
            return Datatables::of($kontaks)->addColumn('action', 
                '<a href="{{ url("sms/grub/masuk-kontak/$id/'.$id.'") }}" class="btn btn-sm btn-primary">Masuk<a>'
            )->make(true);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id_kontak,$id_grup)
    {
        //  
    $status_anggota =  Anggota::where('kontak',$id_kontak)->where('grub',$id_grup)->count(); 
    if ($status_anggota == 0) {
        # code.
  $komentar = Anggota::create([
    'kontak' => $id_kontak,
    'grub' => $id_grup,]);

        $grub = Grub::find($id_grup);
        $grub->jumlah_anggota +=1;
        $grub->save();
 
  Session::flash("flash_notification", [
    "level"=>"success",
    "message"=>"Berhasil Menambahkan Anggota Ke Grup"
    ]); 
    }
    else {
  Session::flash("flash_notification", [
    "level"=>"danger",
    "message"=>"Tidak Bisa Menambahkan Anggota Ke Grup Karna Sudah Ada"
    ]); 

    }


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
$anggota = Anggota::find($id); 


        $grub = Grub::find( $anggota->grub);
        $grub->jumlah_anggota -=1;
        $grub->save();

        Session:: flash("flash_notification", [
            "level"=>"success",
            "message"=>"Anggota Berhasil Di Keluarkan"
            ]);

        Anggota::destroy($id);
  return redirect()->back();
    }
}
