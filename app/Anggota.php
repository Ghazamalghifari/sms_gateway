<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    //
    protected $fillable = ['id','grub','kontak'];

	public function grub()
	{
	return $this->belongsTo('App\Grub','grub');
	}

	public function kontak()
	{
	return $this->belongsTo('App\Kontak','kontak');
	}
}
