<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->HasMany(User::class);
    }
    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }
}


