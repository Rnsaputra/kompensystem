<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $guarded = ['id'];

    public function kompensasi()
    {
        return $this->hasOne(Kompensasi::class);
    }
}