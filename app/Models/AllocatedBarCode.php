<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AllocatedBarCode extends Model
{
    public function barcode(): HasOne
    {
        return $this->hasOne(BarCode::class, 'id','barcode_id');
    }
}
