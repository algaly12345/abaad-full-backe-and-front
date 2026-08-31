<?php

namespace App\Console;

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
        // $schedule->command('inspire')->hourly();

        // اعتماد عمولات الإحالة المستحقة يوميًا (انظر ReferralCommissionService).
        $schedule->command('referrals:process-commissions')->daily();

        // شبكة أمان الدفع: تفعيل أي اشتراك خُصم ثمنه في Moyasar ولم يؤكَّد
        // (فات webhook + callback). انظر ReconcileMoyasarPayments.
        $schedule->command('payments:reconcile-moyasar')
            ->everyFiveMinutes()
            ->withoutOverlapping();
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
