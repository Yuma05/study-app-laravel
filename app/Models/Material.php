<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AuthorObservable;

class Material extends Model
{
    use HasFactory, AuthorObservable;
}
