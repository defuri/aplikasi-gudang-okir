<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\kategoriController;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kategoriModel extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $fillable= [
        'nama',
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the produk for the kategoriModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kategori(): HasMany
    {
        return $this->hasMany(kategoriController::class, 'id_kategori', 'id');
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
