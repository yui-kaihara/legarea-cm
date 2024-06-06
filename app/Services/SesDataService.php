<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\SesData;

class SesDataService
{
    /**
     * 保存
     * 
     * @param array $requests
     * @return void
     */
    public function store(array $requests)
    {
        $sesData = new SesData();
        $sesData->fill($requests)->save();
    }
}