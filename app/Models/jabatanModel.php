<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jabatanModel extends Model
{
    use HasFactory;
    protected $table = 'jabatan';
    protected $fillable = [
        'nama',
        'gaji',
        'created_at',
        'updated_at',
    ];
}
