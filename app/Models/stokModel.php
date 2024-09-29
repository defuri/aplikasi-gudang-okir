<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class stokModel extends Model
{
    use HasFactory;
    protected $table = 'stok';
    protected $fillable = [
        'tanggal',
        'id_gudang',
        'id_produk',
        'stok',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the gudang that owns the detailGudangModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gudang(): BelongsTo
    {
        return $this->belongsTo(gudangModel::class, 'id_gudang');
    }

    /**
     * Get the produk that owns the detailGudangModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(produkModel::class, 'id_produk');
    }
}
