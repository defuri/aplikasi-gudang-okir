<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class transaksiBahanBakuModel extends Model
{
    use HasFactory;
    protected $table = 'transaksi_bahan_baku';
    protected $fillable = [
        'tanggal',
        'id_bahan_baku',
        'jumlah',
        'id_satuan',
        'harga',
        'created_at',
        'updated_at',
    ];

    public function bahanBaku(): BelongsTo {
        return $this->belongsTo(bahanBakuModel::class, 'id_bahan_baku');
    }

    public function satuan(): BelongsTo {
        return $this->belongsTo(satuanModel::class, 'id_satuan');
    }
}
