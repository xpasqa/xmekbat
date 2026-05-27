<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelfJournals extends Model
{
    use HasFactory;
    protected $table = 'self_journals';
    protected $primaryKey = 'id_self_journals';
    protected $fillable = [
        "id_people",
        "title",
        "author",
        "type",
        "year",
        "description",
        "keyword",
    ];
}
