<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $table = 'detail_penjualan';

    protected $fillable = [
        'penjualan_id',
        'produk_id',
        'jumlah',
        'omzet',
        'created_at',
        'updated_at'
    ];

    public function penjualan()
    {
        return $this->belongsTo(penjualanModel::class, 'penjualan_id');
    }

    public function produk()
    {
        return $this->belongsTo(produkModel::class, 'produk_id');
    }
}
