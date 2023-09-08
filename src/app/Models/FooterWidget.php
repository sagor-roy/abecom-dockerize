<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterWidget extends Model
{
    use HasFactory;

    public function customer_pages(){
        return $this->hasMany(CustomPage::class);
    }

}
