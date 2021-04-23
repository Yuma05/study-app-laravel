<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AuthorObservable;

class Question extends Model
{
    use HasFactory, AuthorObservable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'explanation',
        'material_id',
    ];

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
