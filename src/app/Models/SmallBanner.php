<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmallBanner extends Model
{
    use HasFactory;

    public function childbanner(){
        return $this->hasMany(SmallBanner::class,'parent_id','id');
    }
}
