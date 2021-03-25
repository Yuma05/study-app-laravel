<?php
namespace App\Traits;

use App\Observers\AuthorObserver;
use Illuminate\Database\Eloquent\Model;

trait AuthorObservable
{
    public static function bootAuthorObservable()
    {
        self::observe(AuthorObserver::class);
    }
}
