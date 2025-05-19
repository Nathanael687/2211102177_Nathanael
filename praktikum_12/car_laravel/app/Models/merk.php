<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class merk extends Model
{
     protected $fillable = ['name'];
 
    public function cars()
    {
        return $this->hasMany(car::class);// Ini adalah relasi satu ke banyak, di mana satu merk dapat memiliki banyak mobil
    }
}
