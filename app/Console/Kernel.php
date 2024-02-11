<?php

namespace App\Console;

use App\Models\PeminjamanBuku;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    // protected function schedule(Schedule $schedule)
    // {
    //     // $schedule->command('inspire')
    //     //          ->hourly();
    // }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $peminjaman = PeminjamanBuku::where('status', 1)
                ->where('tanggal_peminjaman', '<=', now()->subDays(7)) // Masa pinjam 7 hari
                ->get();

            foreach ($peminjaman as $p) {
                $p->update(['status' => 3]); // Mengubah status peminjaman menjadi 'Harap Dikembalikan'
            }
        })->daily(); // Jalankan tugas setiap hari
    }
}
