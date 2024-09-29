<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class penjualanModel extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $fillable = [
        'tanggal',
        'id_produk',
        'jumlah',
        'omzet',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the produk that owns the penjualanModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(produkModel::class, 'id_produk');
    }
}
