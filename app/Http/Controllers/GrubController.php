<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Grub;
use App\Anggota;
use Auth;
use Session;

class GrubController extends Controller
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
            $grubs = Grub::select(['id','pemilik_grub','nama_grub','jumlah_anggota'])->where('pemilik_grub', Auth::user()->id);
            return Datatables::of($grubs)->addColumn('action', function($grub){
                    return view('grubs._action', [
                        'model'     => $grub,
                        'form_url'  => route('grubs.destroy', $grub->id),
                        'edit_url'  => route('grubs.edit', $grub->id),
                        'anggota_url'  => route('grubs.anggota', $grub->id),
                        'confirm_message'   => 'Yakin Mau Menghapus Grup ' . $grub->nama_grub . '?'
                        ]);
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'nama_grub', 'name' => 'nama_grub', 'title' => 'Nama Grup'])
        ->addColumn(['data' => 'jumlah_anggota', 'name' => 'jumlah_anggota', 'title' => 'Jumlah Anggota'])  
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable'=>false]);

        return view('grubs.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('grubs.create');
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
        $id_user = Auth::user()->id;
         $this->validate($request, [
            'nama_grub'   => 'required|unique:grubs,nama_grub,'
            ]);

         $grub = Grub::create([
            'pemilik_grub' => $id_user, 
            'nama_grub'=>$request->nama_grub]);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambah Grup $grub->nama_grub"
            ]);
        return redirect()->route('grubs.index');
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
        $grub = Grub::find($id);
        return view('grubs.edit')->with(compact('grub')); 
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
        $id_user = Auth::user()->id;
         $this->validate($request, [
            'nama_grub'   => 'required|unique:grubs,nama_grub,' .$id
            ]);

        Grub::where('id', $id) ->update([
            'pemilik_grub' => $id_user, 
            'nama_grub'=>$request->nama_grub]);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengedit Grup $request->nama_grub"
            ]);
        return redirect()->route('grubs.index');
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
        if(!Grub::destroy($id)) 
        {
            return redirect()->back();
        }
        else{
        Session:: flash("flash_notification", [
            "level"=>"success",
            "message"=>"Grup Berhasil Di Hapus"
            ]);
        return redirect()->route('grubs.index');
        }
    }

 
}
