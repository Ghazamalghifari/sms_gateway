<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grub extends Model
{
    //
    protected $fillable = ['id','pemilik_grub','nama_grub','jumlah_anggota'];
}
