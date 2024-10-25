<?php

namespace App\Models;

use App\Models\suplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class bahanBakuModel extends Model
{
    use HasFactory;

    protected $table = 'bahan_baku';
    protected $fillable = [
        'nama',
        'id_suplier',
        'created_at',
        'updated_at',
    ];

    public function suplier() {
        return $this->belongsTo(suplier::class, 'id_suplier');
    }

    public function transaksiBahanbaku(): HasMany {
        return $this->hasMany(bahanBakuModel::class, 'id_bahan_baku');
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
