<?php

namespace App\Livewire;

use App\Models\Bayar;
use App\Models\Car;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $cars;
    public $car;

    public $carnopol;
    public $sopir;
    public $tglambil;
    public $tglkembali;
    public $downpayment;
    public $total;
    public $kekurangan;

    public $permintaan;
    public $billing;

    public $modalBayar = false;
    public $tglbayar;
    public $bayar;
    public $nominal;

    public function fillForm($id)
    {
        dd($id);
        $bayar = Bayar::where('id_kembali', $id)->first();
        $this->modalBayar = true;
    }
    public function kembalikan($id)
    {
        $permintaan = Transaksi::where('id', $id)->update([
            'status' => 'kembali'
        ]);
        if ($permintaan) {
            $this->getPermintaan();
        }
    }
    public function updateStatus($id)
    {
        $permintaan = Transaksi::where('id', $id)->update([
            'status' => 'ambil'
        ]);
        if ($permintaan) {
            $this->getPermintaan();
        }
    }
    public function rental()
    {
        if ($this->kekurangan == null) {
            $this->initializeKekurangan();
        }
        $this->validate([
            'carnopol' => 'required',
            'sopir' => 'required',
            'tglambil' => 'required',
            'tglkembali' => 'required',
            'downpayment' => 'required',
            'total' => 'required',
            'kekurangan' => 'required',
        ]);

        $result = Transaksi::create([
            "nik" => Auth::guard('member')->user()->nik,
            "nopol" => $this->carnopol,
            "supir" => intval($this->sopir),
            "tgl_booking" => Carbon::now(),
            "tgl_ambil" => $this->tglambil,
            "tgl_kembali" => $this->tglkembali,
            "downpayment" => $this->downpayment,
            "total" => $this->total,
            "kekurangan" => $this->kekurangan,
            "status" => "booking",
        ]);

        if ($result) {
            return redirect('/home');
        }
    }

    public function initializeTransaksi($total, $nopol)
    {
        $this->total = $total;
        $this->carnopol = $nopol;
    }
    public function initializeKekurangan()
    {
        $this->kekurangan = $this->total - $this->downpayment;
    }
    public function updateTotalFromDay()
    {
        if ($this->tglambil != null && $this->tglkembali != null) {
            $tanggal1 = Carbon::parse($this->tglambil);
            $tanggal2 = Carbon::parse($this->tglkembali);
            $totalDay = $tanggal2->diffInDays($tanggal1) * -1;
            $this->total = $this->total * $totalDay;
        }
    }

    public function updateTotal()
    {
        if ($this->sopir != null) {
            if ($this->sopir == "1") {
                $plusSopir = 100000;
                $tanggal1 = Carbon::parse($this->tglambil);
                $tanggal2 = Carbon::parse($this->tglkembali);
                $totalDay = $tanggal2->diffInDays($tanggal1) * -1;

                $totalPlusSopir = $plusSopir * $totalDay;
                $this->total = $this->total + $totalPlusSopir;
            }
        }
    }


    public function getPermintaan()
    {
        $this->permintaan = Transaksi::where('nik', Auth::guard('member')->user()->nik)->get();
    }

    public function getBilling()
    {
        $this->billing = Transaksi::where('nik', Auth::guard('member')->user()->nik)
            ->with('kembali')
            ->get();
    }

    public function setCar($car)
    {
        $this->car = $car;
    }
    public $explore = false;
    public function getCars()
    {
        $this->cars = Car::all();
    }
    public function render()
    {
        return view('users.home')->extends('layouts.master')->section('content');
    }
}
