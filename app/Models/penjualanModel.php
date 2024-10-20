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
        'created_at',
        'updated_at',
    ];

    /**
     * Get the detail penjualan records associated with the penjualanModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id');
    }
}
