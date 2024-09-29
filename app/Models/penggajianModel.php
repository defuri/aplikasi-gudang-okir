<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class penggajianModel extends Model
{
    use HasFactory;
    protected $table = 'penggajian';
    protected $fillable = [
        'tanggal',
        'id_karyawan',
        'id_jabatan',
        'lembur',
        'total',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the karyawan that owns the penggajianModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(karyawanModel::class, 'id_karyawan');
    }

    /**
     * Get the jabatan that owns the penggajianModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(jabatanModel::class, 'id_jabatan');
    }
}
