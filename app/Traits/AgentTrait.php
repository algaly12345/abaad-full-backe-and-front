<?php

namespace App\Traits;

trait AgentTrait
{
    public function scopeRealEstateOffices($q)
    {
        $q->whereHas('agent', function ($q) {
            $q->where('agent_type', 'مكتب عقاري');
        });
    }

    
    public function scopeRealEstateCompanies($q)
    {
        $q->whereHas('agent', function ($q) {
            $q->where('agent_type', 'شركة عقارية');
        });
    }

    public function scopeIndividuals($q)
    {
        $q->whereHas('agent', function ($q) {
            $q->where('agent_type', 'فرد');
        });
    }
}
