<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiBahanBaku extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi_bahan_baku';

    protected $fillable = [
        'transaksi_bahan_baku_id',
        'bahan_baku_id',
        'jumlah',
        'satuan_id',
        'harga',
        'total',
    ];

    public function transaksiBahanBaku()
    {
        return $this->belongsTo(transaksiBahanBakuModel::class, 'transaksi_bahan_baku_id');
    }

    public function bahanBaku()
    {
        return $this->belongsTo(bahanBakuModel::class, 'bahan_baku_id');
    }

    public function satuan() {
        return $this->belongsTo(satuanModel::class, 'satuan_id');
    }
}
