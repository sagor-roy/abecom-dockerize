<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPage extends Model
{
    use HasFactory;

    public function footer_widget(){
        return $this->belongsTo(FooterWidget::class);
    }

}
