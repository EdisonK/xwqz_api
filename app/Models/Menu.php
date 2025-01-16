<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;
//可批量赋值的字段
    protected $fillable = ['path','name','label','icon','url'];

    public function children():HasMany
    {
        return $this->hasMany(Menu::class,'pid','id');
    }



}
