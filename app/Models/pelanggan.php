<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';

    protected $fillable = [
        'nama',
        'no_tlp',
        'alamat',
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the pelanggan for the pelanggan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pelanggan(): HasMany
    {
        return $this->hasMany(pelanggan::class, 'id_pelanggan');
    }

    public function pesanan(): HasMany {
        return $this->hasMany(Pesanan::class, 'pelanggan_id');
    }
}
