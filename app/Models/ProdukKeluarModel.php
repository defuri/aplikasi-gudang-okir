<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdukKeluarModel extends Model
{
    use HasFactory;

    protected $table = 'produk_keluar';

    protected $fillable = [
        'waktu',
        'id_gudang',
        'id_produk',
        'jumlah',
    ];

    /**
     * Get the gudang that owns the ProdukMasukModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gudang(): BelongsTo
    {
        return $this->belongsTo(gudangModel::class, 'id_gudang');
    }


    /**
     * Get the produk  that owns the ProdukMasukModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(produkModel::class, 'id_produk');
    }
}
