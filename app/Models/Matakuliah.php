<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Relations\BelongsToMany;

class Matakuliah extends Model
{
    public function mahasiswa(): BelongsToMany{
        return $this->belongsToMany('App\Models\Mahasiswa');
    }
}
