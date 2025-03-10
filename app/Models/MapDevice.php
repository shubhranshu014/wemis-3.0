<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MapDevice extends Model
{
    public function barcodes(): HasOne
    {
        return $this->HasOne(BarCode::class, 'id','device_seriel_no');
    }

    public function dealer(): HasOne{

        return $this->HasOne(Dealer::class, 'id','dealer_id');
    }
}
