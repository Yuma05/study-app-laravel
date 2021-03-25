<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AuthorObservable;

class Question extends Model
{
    use HasFactory, AuthorObservable;
}
