<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurStores extends Model
{
    use HasFactory;

    public function child(){
        return $this->hasMany(OurStores::class,"parent_id","id");
    }
}
