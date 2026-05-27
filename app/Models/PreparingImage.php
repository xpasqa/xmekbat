<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreparingImage extends Model
{
    use HasFactory;
    protected $table = 'preparing_images';
    protected $primaryKey = 'id_preparing_image';
    protected $fillable = [
        "id_project",
        "image",
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'id_project', 'id_project');
    }
}
