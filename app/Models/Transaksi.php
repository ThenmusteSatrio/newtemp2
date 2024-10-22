<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = "tbl_transaksi";
    protected $guarded = [""];
    protected $primaryKey = 'id';

    public $timestamps = false;

    public function member()
    {
        return $this->belongsTo(Member::class, 'nik', 'nik');
    }

    public function mobil()
    {
        return $this->belongsTo(Car::class, 'nopol', 'nopol');
    }

    public function kembali()
    {
        return $this->hasOne(Kembali::class, 'id_transaksi', 'id');
    }
}
