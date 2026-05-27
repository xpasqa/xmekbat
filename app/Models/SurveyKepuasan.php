<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyKepuasan extends Model
{
    use HasFactory;
    protected $table = 'survey_kepuasan';
    protected $primaryKey = 'id_survey';
    protected $fillable = [
        "id_user",
        "id_project",
        "ketepatan_waktu",
        "komunikasi",
        "kejelasan",
        "informasi",
    ];
}
