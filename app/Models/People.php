<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $table = 'people';
    protected $primaryKey = 'id_people';
    protected $fillable = [
        "name",
        "position",
        "description",
        "image",
        "slug",
    ];

    public function journals()
    {
        return $this->hasManyThrough(
            Journals::class,
            PeopleJournals::class,
            'id_people', // Foreign key on the environments table...
            'id_journal', // Foreign key on the deployments table...
            'id_people', // Local key on the projects table...
            'id_journal' // Local key on the environments table...
        );
    }

    public function self_journals()
    {
        return $this->hasMany(SelfJournals::class, 'id_people', 'id_people');
    }
}
