<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    //
    protected $fillable = ['id','pemilik_kontak','panggilan','nama','alamat','nomor_hp'];
}
