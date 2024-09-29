<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\divisiController;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class divisiModel extends Model
{
    use HasFactory;
    protected $table = 'divisi';
    protected $fillable = [
        'nama',
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the divisi for the divisiModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function divisi(): HasMany
    {
        return $this->hasMany(divisiController::class, 'id_divisi');
    }
}
