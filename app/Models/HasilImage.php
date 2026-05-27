<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilImage extends Model
{
    use HasFactory;
    protected $table = 'hasil_image';
    protected $primaryKey = 'id_hasil_image';
    protected $fillable = [
        "id_project",
        "name",
        "image",
    ];
}
