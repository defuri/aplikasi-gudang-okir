<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPengiriman extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pengiriman';

    protected $fillable = [
        'pengiriman_id',
        'tanggal_pengiriman',
        'tanggal_sampai',
        'created_at',
        'updated_at',
    ];
}
