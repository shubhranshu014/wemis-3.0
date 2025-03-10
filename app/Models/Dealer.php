<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dealer extends Model
{
    public function distributor(): HasOne
    {
        return $this->hasOne( Distributor::class, 'id', 'distributor_id');
    }
    protected function casts(): array
    {
        
        return [
            'password' => 'hashed',
        ];
    }
}
