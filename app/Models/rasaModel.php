<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class rasaModel extends Model
{
    use HasFactory;
    protected $table = "rasa";
    protected $fillable = [
        "nama",
        "created_at",
        "updated_at",
    ];

    /**
     * Get all of the rasa for the rasaModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rasa(): HasMany
    {
        return $this->hasMany(rasaModel::class, 'id_rasa');
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
