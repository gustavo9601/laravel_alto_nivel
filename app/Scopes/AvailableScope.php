<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AvailableScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */

// Builder => consulta
// Model => Modelo o calase
    public function apply(Builder $builder, Model $model)
    {
        // Available es una funcion local scope del modelo Product, y con builder se accede a dicha consulta
        $builder->available();
    }
}
