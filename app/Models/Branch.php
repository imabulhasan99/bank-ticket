<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branches';

    protected $fillable = ['name', 'address', 'routing', 'status'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }
}
