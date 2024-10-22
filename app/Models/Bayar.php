<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bayar extends Model
{
    protected $table = "tbl_bayar";
    protected $guarded = [""];
    protected $primaryKey = 'id';

    public $timestamps = false;
}
