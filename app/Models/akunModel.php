<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class akunModel extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'id_hak',
        'username',
        'password',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the hak that owns the akunModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hak(): BelongsTo
    {
        return $this->belongsTo(hakModel::class, 'id_hak');
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
