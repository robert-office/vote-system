<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'survey_id',
    ];

    public function survey()
    {
        return $this->BelongsTo(Survey::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
