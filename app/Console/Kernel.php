<?php
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        '\App\Console\Commands\NotificarSolicitud',
        '\App\Console\Commands\CancelarSolicitud',
        '\App\Console\Commands\FinalizaSolicitud',
        '\App\Console\Commands\RecordatorioEvaluaciones',
    ];
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notifica:solicitud')
            ->everyMinute();
        $schedule->command('cancelar:solicitud')
            ->everyMinute();
        $schedule->command('finaliza:solicitud')
            ->everyMinute();
        $schedule->command('notifica:evaluaciones')
            ->weekly();
    }
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
