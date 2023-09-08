<?php

namespace App\Models;

use App\Models\Thana;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    public function thanas()
    {
        return $this->hasMany(Thana::class);
    }
}
