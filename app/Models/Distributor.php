<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    protected function casts(): array
    {
        
        return [
            'password' => 'hashed',
        ];
    }
}
