<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kembali extends Model
{
    protected $table = "tbl_kembali";
    protected $guarded = [""];
    protected $primaryKey = 'id';

    public $timestamps = false;


    public function bayar()
    {
        return $this->hasOne(Bayar::class, 'id_kembali', 'id');
    }
}
