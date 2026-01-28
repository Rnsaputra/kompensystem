<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kompensasi extends Model
{
    protected $guarded = ['id'];

    // --- TAMBAHKAN INI (WAJIB) ---
    protected $casts = [
        'completed_days' => 'array',
    ];
    // -----------------------------

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
