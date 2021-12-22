<?php

namespace App\Repositories\Tax;

use App\Interfaces\TaxRepositoryInterface;

class Pph21Repository implements TaxRepositoryInterface
{
    public function calculate()
    {
        return 'Calculating PPh 21...';
    }
}
