<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Relations\BelongsToMany;
use illuminate\Database\Eloquent\Relations\HasOne;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function wali(): HasOne{
        return $this->hasOne('App\Models\wali');
    }

    public function matakuliah(): BelongsToMany{
        return $this->belongsToMany('App\Models\Matakuliah');
    }
}
