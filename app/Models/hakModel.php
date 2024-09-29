<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hakModel extends Model
{
    use HasFactory;

    protected $table = 'hak';
    protected $fillable = [
        'nama',
        'created_at',
        'updated_at',
    ];
}
