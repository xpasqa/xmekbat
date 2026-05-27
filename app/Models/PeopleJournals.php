<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleJournals extends Model
{
    use HasFactory;
    protected $table = 'people_journals';
    protected $primaryKey = 'id_people_journals';
    protected $fillable = [
        "id_people",
        "id_journal",
    ];
}
