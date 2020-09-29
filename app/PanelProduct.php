<?php

namespace App;

use App\Scopes\AvailableScope;
use Illuminate\Database\Eloquent\Model;
use App\Product;

/*
Extendiendo este modelo del, modelo Product para heredar todas sus funcionadlidades

*/
class PanelProduct extends Product
{

    // Se crea este modelo, para que en los contraladores del Panel de Administracion no sea tomada en cuenta el el Global Scoope de Available
    public static function booted()
    {
         // Dejando el metodo vacio, este se sobrescribe y no ejecutara nada
    }
}
