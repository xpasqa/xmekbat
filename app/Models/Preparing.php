<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preparing extends Model
{
    use HasFactory;
    protected $table = 'preparing';
    protected $primaryKey = 'id_preparing';
    protected $fillable = [
        "id_project",
        "depth",
        "length",
        "lithology",
        "pp",
        "ucs",
        "ds",
        "uv",
        "pli",
        "bz",
        "tx",
        "notice",
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'id_project', 'id_project');
    }
}
