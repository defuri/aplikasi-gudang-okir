<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class produkModel extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = [
        'nama',
        'id_rasa',
        'id_kategori',
        'id_pack',
        'harga',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the rasa that owns the produkModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rasa(): BelongsTo
    {
        return $this->belongsTo(rasaModel::class, 'id_rasa');
    }

    /**
     * Get the kategori that owns the produkModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(kategoriModel::class, 'id_kategori');
    }

    /**
     * Get the pack that owns the produkModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pack(): BelongsTo
    {
        return $this->belongsTo(packModel::class, 'id_pack');
    }
}
