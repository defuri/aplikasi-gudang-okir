<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function formatTanggal()
    {
        return Carbon::parse($this->tanggal)->format('d-m-Y');
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
