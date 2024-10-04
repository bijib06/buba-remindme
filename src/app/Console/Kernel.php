<?php

namespace App\Console;

use App\Mail\SendReminderEmail;
use App\Models\Reminder;
use DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        
        $schedule->call(function () {

            DB::transaction(function () {
                $reminders = Reminder::where("remind_at", "<=", now()->timestamp)->where("event_at", ">", now()->timestamp)->get();
                foreach ($reminders as $reminder) 
                {
                    //Queue reminder email
                    Mail::to('buba.bbojang@gmail.com')->queue(new SendReminderEmail($reminder));
                    Reminder::destroy($reminder->id);
                }
            });

        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
