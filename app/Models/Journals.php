<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journals extends Model
{
    use HasFactory;
    protected $table = 'journals';
    protected $primaryKey = 'id_journal';
    protected $fillable = [
        "title",
        "author",
        "type",
        "year",
        "description",
        "keyword",
    ];
}
