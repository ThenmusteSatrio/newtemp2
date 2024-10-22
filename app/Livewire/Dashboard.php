<?php

namespace App\Livewire;

use App\Charts\MonthlyUsersChart;
use App\Models\Car;
use App\Models\Member;
use App\Models\Transaksi;
use Livewire\Component;

class Dashboard extends Component
{

    public $totalCars;
    public $totalMembers;
    public $totalTransaksi;

    public function mount()
    {
        $this->totalCars = Car::count();
        $this->totalMembers = Member::count();
        $this->totalTransaksi = Transaksi::count();
    }
    public function render(MonthlyUsersChart $peminjamanChart)
    {
        return view('layouts.dashboard', ['peminjamanChart' => $peminjamanChart->build()])->extends('layouts.master')->section('content');
    }
}
