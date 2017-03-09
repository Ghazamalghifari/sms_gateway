<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB; 
use App\Anggota;
use App\Grub;
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
                        'confirm_message'   => 'Yakin Mau Mengeluarkan Anggota Dari Group ?',
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('grubs.anggota');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    $this->validate($request,[
        'kontak' => "required|unique:anggotas,kontak,Null,id,grub,$request->grub",
        'grub' => 'required',]);

  $komentar = Anggota::create([
    'kontak' => $request->kontak,
    'grub' => $request->grub,]);

        $grub = Grub::find($request->grub);
        $grub->jumlah_anggota +=1;
        $grub->save();
 
  Session::flash("flash_notification", [
    "level"=>"success",
    "message"=>"Berhasil Menambahkan Anggota Ke Grub"
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
