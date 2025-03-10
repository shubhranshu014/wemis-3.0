<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Wlp extends Authenticatable
{
    use HasFactory, Notifiable;
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
