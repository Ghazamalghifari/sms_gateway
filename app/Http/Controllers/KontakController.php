<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Kontak;
use Auth;
use Session;

class KontakController extends Controller
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
            $kontaks = Kontak::select(['id','pemilik_kontak','panggilan','nama','alamat','nomor_hp'])->where('pemilik_kontak', Auth::user()->id);
            return Datatables::of($kontaks)->addColumn('action', function($kontak){
                    return view('datatable._action', [
                        'model'     => $kontak,
                        'form_url'  => route('kontaks.destroy', $kontak->id),
                        'edit_url'  => route('kontaks.edit', $kontak->id),
                        'confirm_message'   => 'Yakin Mau Menghapus Kontak ' . $kontak->nama . '?'
                        ]);
                })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'panggilan', 'name' => 'panggilan', 'title' => 'Panggilan'])
        ->addColumn(['data' => 'nama', 'name' => 'nama', 'title' => 'Nama']) 
        ->addColumn(['data' => 'nomor_hp', 'name' => 'nomor_hp', 'title' => 'Nomor Hp'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable'=>false]);

        return view('kontaks.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('kontaks.create');
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
            'panggilan'   => 'max:225',
            'nama'     => 'required',
            'nomor_hp'    => "required|unique:kontaks,nomor_hp,Null,id,pemilik_kontak,$id_user",
            'alamat'=> 'max:225'
            ]);

         $kontak = Kontak::create([
            'pemilik_kontak' => $id_user,
            'panggilan' =>$request->panggilan,
            'nama'=>$request->nama,
            'nomor_hp'=>$request->nomor_hp,
            'alamat'=>$request->alamat]);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambah Kontak $kontak->nama"
            ]);
        return redirect()->route('kontaks.index');
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
        $kontak = Kontak::find($id);
        return view('kontaks.edit')->with(compact('kontak')); 
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
            'panggilan'   => 'max:225',
            'nama'     => 'required',
            'nomor_hp'    => 'required|unique:kontaks,nomor_hp,' .$id,
            'alamat'=> 'max:225' 
            ]);
        Kontak::where('id', $id) ->update([
            'pemilik_kontak' => $id_user,
            'panggilan' =>$request->panggilan,
            'nama'=>$request->nama,
            'nomor_hp'=>$request->nomor_hp,
            'alamat'=>$request->alamat]);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengubah Kontak $request->nama"
            ]);

        return redirect()->route('kontaks.index');
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
       
        if(!Kontak::destroy($id)) 
        {
            return redirect()->back();
        }
        else{
        Session:: flash("flash_notification", [
            "level"=>"success",
            "message"=>"Kontak Berhasil Di Hapus"
            ]);
        return redirect()->route('kontaks.index');
        }
    }
}
