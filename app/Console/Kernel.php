<?php

namespace App\Console;

use App\Models\Souscriptions;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function (){
            $souscript=Souscriptions::where('modePayement','retenu direct')->get();
            if(count($souscript) > 0){
                foreach($souscript as $souscript){
                    $taux=($souscript->salaire*12)/84;
                    if($souscript->montantRestant>0){
                    $souscript->update(['montantPayé'=> $souscript->montantPayé+$taux]);
                    $souscript->update(['montantRestant'=>$souscript->montantTotal-$souscript->montantPayé]);
                    }
                }
            };
        })->monthly() ;
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
