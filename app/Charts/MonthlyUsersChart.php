<?php

namespace App\Charts;

use App\Models\Transaksi;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class MonthlyUsersChart extends Chart
{
    protected $chart;

    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        parent::__construct();
    }

    public function build()
    {
        $peminjamanToday = Transaksi::where("tgl_booking", now()->format('Y-m-d'))->count();
        $peminjamanTodayMin1 = Transaksi::where("tgl_booking", now()->subDays(1)->format('Y-m-d'))->count();
        $peminjamanTodayMin2 = Transaksi::where("tgl_booking", now()->subDays(2)->format('Y-m-d'))->count();
        $peminjamanTodayMin3 = Transaksi::where("tgl_booking", now()->subDays(3)->format('Y-m-d'))->count();
        $peminjamanTodayMin4 = Transaksi::where("tgl_booking", now()->subDays(4)->format('Y-m-d'))->count();
        $peminjamanTodayMin5 = Transaksi::where("tgl_booking", now()->subDays(5)->format('Y-m-d'))->count();

        $pengembalianToday = Transaksi::where("tgl_kembali", now()->format('Y-m-d'))->count();
        $pengembalianTodayMin1 = Transaksi::where("tgl_kembali", now()->subDays(1)->format('Y-m-d'))->count();
        $pengembalianTodayMin2 = Transaksi::where("tgl_kembali", now()->subDays(2)->format('Y-m-d'))->count();
        $pengembalianTodayMin3 = Transaksi::where("tgl_kembali", now()->subDays(3)->format('Y-m-d'))->count();
        $pengembalianTodayMin4 = Transaksi::where("tgl_kembali", now()->subDays(4)->format('Y-m-d'))->count();
        $pengembalianTodayMin5 = Transaksi::where("tgl_kembali", now()->subDays(5)->format('Y-m-d'))->count();

        return $this->chart->areaChart()
            ->setToolbar(true)
            ->setTitle('Peminjaman & Pengembalian Harian')
            ->setSubtitle('Dalam periode 5 hari.')
            ->addData('Peminjaman', [$peminjamanTodayMin5, $peminjamanTodayMin4, $peminjamanTodayMin3, $peminjamanTodayMin2, $peminjamanTodayMin1, $peminjamanToday])
            ->addData('Pengembalian', [$pengembalianTodayMin5, $pengembalianTodayMin4, $pengembalianTodayMin3, $pengembalianTodayMin2, $pengembalianTodayMin1, $pengembalianToday])
            ->setXAxis([now()->subDays(5)->format('M d'), now()->subDays(4)->format('M d'), now()->subDays(3)->format('M d'), now()->subDays(2)->format('M d'), now()->subDays(1)->format('M d'), now()->format('M d')]);

        // return $this->chart->lineChart()
        //     ->setTitle('Peminjaman & Pengembalian Harian')
        //     ->setSubtitle('Dalam periode 5 hari.')
        //     ->addData('Peminjaman', [$peminjamanTodayMin5, $peminjamanTodayMin4, $peminjamanTodayMin3, $peminjamanTodayMin2, $peminjamanTodayMin1, $peminjamanToday])
        //     ->addData('Pengembalian', [$pengembalianTodayMin5, $pengembalianTodayMin4, $pengembalianTodayMin3, $pengembalianTodayMin2, $pengembalianTodayMin1, $pengembalianToday])
        //     ->setXAxis([now()->subDays(5)->format('M d'), now()->subDays(4)->format('M d'), now()->subDays(3)->format('M d'), now()->subDays(2)->format('M d'), now()->subDays(1)->format('M d'), now()->format('M d')]);
    }
}
