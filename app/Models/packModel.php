<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class packModel extends Model
{
    use HasFactory;
    protected $table = 'pack';
    protected $fillable = [
        'nama',
        'ukuran',
        'id_satuan',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the satuan that owns the packModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function satuan(): BelongsTo
    {
        return $this->belongsTo(satuanModel::class, 'id_satuan', 'id');
    }

    /**
     * Get all of the pack for the packModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pack(): HasMany
    {
        return $this->hasMany(packModel::class, 'id_pack');
    }
}
