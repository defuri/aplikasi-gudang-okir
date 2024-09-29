<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class satuanModel extends Model
{
    use HasFactory;

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
