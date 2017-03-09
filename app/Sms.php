<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    //
    protected $fillable = ['id','id_kontak','isi_pesan','nomor_tujuan','status_kirim','pemilik_sms','jumlah_sms','created_at'];
    
	public function kontak()
	{
	return $this->belongsTo('App\Kontak','id_kontak');
	}
}
