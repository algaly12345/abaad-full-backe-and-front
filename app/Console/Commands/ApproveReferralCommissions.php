<?php

namespace App\Console\Commands;

use App\Services\ReferralCommissionService;
use Illuminate\Console\Command;

class ApproveReferralCommissions extends Command
{
    protected $signature = 'referrals:process-commissions';

    protected $description = 'اعتماد عمولات الإحالة المستحقة (انتهت مدة الانتظار) وإضافتها لمحفظة المسوّقين';

    public function handle(ReferralCommissionService $service): int
    {
        $expired = $service->expireStalePendingReferrals();
        $result = $service->processPendingCommissions();

        $this->info("Expired: {$expired}, Approved: {$result['approved']}, Cancelled: {$result['cancelled']}");

        return self::SUCCESS;
    }
}
