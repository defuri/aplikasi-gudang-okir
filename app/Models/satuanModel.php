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

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i');
    }

    public function getFormattedUpdatedAttribute()
    {
        return $this->updated_at->timezone('Asia/Jakarta')->format('d-m-Y H:i');
    }
}
