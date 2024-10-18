<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class transaksiBahanBakuModel extends Model
{
    use HasFactory;
    protected $table = 'transaksi_bahan_baku';

    protected $fillable = [
        'tanggal',
        'created_at',
        'updated_at',
    ];

    public function detailTransaksiBahanBaku()
    {
        return $this->hasMany(DetailTransaksiBahanBaku::class, 'transaksi_bahan_baku_id');
    }
}
