<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class satuanModel extends Model
{
    use HasFactory, AuthorizesRequests;

    protected $table = 'satuan';
    protected $fillable = [
        'nama',
        'created_at',
        'updated_at',
    ];

    public function satuan() {
        return $this->hasMany(SatuanModel::class, 'id_satuan');
    }
}
