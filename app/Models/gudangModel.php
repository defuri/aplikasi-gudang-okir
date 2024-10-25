<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\gudangController;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class gudangModel extends Model
{
    use HasFactory;

    protected $table = 'gudang';

    protected $fillable = [
        'nama',
        'alamat',
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the gudang for the gudangModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gudang(): HasMany
    {
        return $this->hasMany(gudangController::class, 'id_gudang');
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
