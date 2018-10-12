<?php

namespace App;

use App\AnimalAdoption;
use Auth;
use Illuminate\Database\Eloquent\Builder;

class AnimalImpound extends AnimalAdoption
{
    protected $table = 'animal_adoptions';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('submittedBy', function (Builder $builder) {
            $builder->where('submitted_by', Auth::id());
        });
    }
}
