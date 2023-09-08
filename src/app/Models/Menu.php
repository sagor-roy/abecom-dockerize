<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    public function sub_menu(){
        return $this->hasMany(SubMenu::class);
    }

    public function role(){
        return $this->belongsToMany(Role::class);
    }
}
