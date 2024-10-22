<?php

namespace App\Livewire;

use App\Models\Bayar;
use App\Models\Kembali;
use App\Models\Transaksi;
use Carbon\Carbon;
use Faker\Core\Number;
use Livewire\Component;

use function PHPSTORM_META\type;

class Permintaan extends Component
{

    protected $listeners = ['approve' => 'approve', 'formBayar'];
    public $permintaan;
    public $denda;
    public $kondisimobil;
    public $tglkembali;
    public $modalKembali = false;
    public $modalBayar = false;

    public $tglkembaliawal;
    public $harga;
    public $idCar;
    public $kekurangan;

    public $sudahDikembalikan;
    public $bayar;
    public $tglbayar;

    public function store()
    {
        $totalBayar = ($this->kekurangan + $this->denda) - $this->bayar;
        $status = intval($totalBayar) > 0 ? "belum lunas" : "lunas";


        if ($this->idCar != null) {
            if ($this->sudahDikembalikan != null) {
                $transaksi = Transaksi::where('id', $this->sudahDikembalikan->id_transaksi)->first();
                $totalBayar = $transaksi->kekurangan - $this->bayar;
                $status = intval($totalBayar) > 0 ? "belum lunas" : "lunas";
                $updateTransaksi = Transaksi::where('id', $this->idCar)->update([
                    'kekurangan' => $totalBayar,
                ]);

                $updateTransaksi = Transaksi::where('id', $this->idCar)->first();
                $kembali = Kembali::where('id_transaksi', $transaksi->id)->first();
                $bayar = Bayar::where('id_kembali', $kembali->id)->first();
                $bayar->update([
                    "total_bayar" => $bayar->total_bayar + $this->bayar,
                    "lunas" => $status,
                    "tgl_bayar" => $this->tglbayar,
                ]);

                if ($updateTransaksi && $bayar && $kembali) {
                    return redirect('/petugas/control/panel/permintaan');
                }
            }
            $updateTransaksi = Transaksi::where('id', $this->idCar)->update([
                'kekurangan' => $totalBayar,
            ]);
            $updateTransaksi = Transaksi::where('id', $this->idCar)->first();


            $result = Kembali::create([
                "id_transaksi" => $this->idCar,
                "tgl_kembali" => $this->tglkembali,
                "kondisi_mobil" => $this->kondisimobil,
                "denda" => $this->denda,
            ]);

            $sendTagihan = Bayar::create([
                "id_kembali" => $result->id,
                "tgl_bayar" => now(),
                "total_bayar" => $this->bayar + $updateTransaksi["downpayment"],
                "lunas" => $status,
            ]);

            if ($result && $sendTagihan && $updateTransaksi) {
                return redirect('/petugas/control/panel/permintaan');
            }
        }
    }

    public function clearData()
    {
        $this->reset(["denda", "kondisimobil", "tglkembali", "idCar", "tglkembaliawal", "harga"]);
        $this->getAllPermintaan();
        $this->dispatch("reload");
    }

    public function checkDenda()
    {
        $tanggalPengembalianAwal = Carbon::parse($this->tglkembaliawal);
        $tanggalPengembalianAkhir = Carbon::parse($this->tglkembali);

        if ($tanggalPengembalianAkhir->greaterThan($tanggalPengembalianAwal)) {
            $diffInDays = $tanggalPengembalianAkhir->diffInDays($tanggalPengembalianAwal) * -1;
            $this->denda = $diffInDays * $this->harga;
        } else {
            $this->denda = 0;
        }
    }

    public function fillForm($id, $harga, $tglkembaliawal, $kekurangan)
    {
        $this->sudahDikembalikan = Kembali::where('id_transaksi', $id)->first();
        if ($this->sudahDikembalikan) {
            $this->tglkembali = $this->sudahDikembalikan->tgl_kembali;
            $this->kondisimobil = $this->sudahDikembalikan->kondisi_mobil;
            $this->denda = $this->sudahDikembalikan->denda;
        }
        $this->modalKembali = true;
        $this->harga = $harga;
        $this->kekurangan = $kekurangan;
        $this->tglkembaliawal = $tglkembaliawal;
        $this->idCar = $id;
        $this->dispatch("reload");
    }
    public function approve($id)
    {
        $permintaan = Transaksi::where('id', $id)->update([
            'status' => 'approve'
        ]);
        if ($permintaan) {
            $this->getAllPermintaan();
            $this->dispatch("reload");
        }
    }

    public function getAllPermintaan()
    {
        $this->permintaan = Transaksi::all();
    }

    public function mount()
    {
        $this->getAllPermintaan();
    }
    public function render()
    {
        return view('livewire.permintaan')->extends('layouts.master')->section('content');
    }
}
