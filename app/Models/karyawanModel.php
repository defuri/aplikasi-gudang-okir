<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class karyawanModel extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    protected $fillable = [
        'nama',
        'id_jabatan',
        'id_divisi',
        'jenis_kelamin',
        'alamat',
        'no_tlp',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the jabatan that owns the karyawanModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(jabatanModel::class, 'id_jabatan');
    }

    /**
     * Get the divisi that owns the karyawanModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function divisi(): BelongsTo
    {
        return $this->belongsTo(divisiModel::class, 'id_divisi');
    }
}
