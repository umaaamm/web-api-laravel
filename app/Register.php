<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $table = 'registrasi';
    protected $fillable = ['id','nama','no_telp','email','keterangan'];
}
