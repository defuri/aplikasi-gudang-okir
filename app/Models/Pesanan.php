<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'pelanggan_id',
        'tanggal',
        'created_at',
        'updated_at',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'pesanan_id');
    }

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(pelanggan::class, 'pelanggan_id');
    }

    public function detailPesanan() {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }
}
