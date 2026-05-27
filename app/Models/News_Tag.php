<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News_Tag extends Model
{
    use HasFactory;
    protected $table = 'news_tags';
    protected $primaryKey = 'id_news_tag';
    protected $fillable = [
        "id_news",
        "id_tag",
    ];
}
