<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdukMasukModel extends Model
{
    use HasFactory;

    protected $table = 'produk_masuk';

    protected $fillable = [
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

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i');
    }

    public function getFormattedUpdatedAttribute()
    {
        return $this->updated_at->timezone('Asia/Jakarta')->format('d-m-Y H:i');
    }
}
