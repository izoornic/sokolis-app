<?php

namespace App\Actions\Zgrada;

use App\Models\Zgrada;

class IzabranaZgrada
{
   public static function getIzabranaZgrada()
   {
    return [ 
        session('upravnik_izabrana_zgrada_id'),
        session('upravnik_izabrana_zgrada_name')
    ];
   }

   public static function getIzabranaZgradaId()
   {
    return session('upravnik_izabrana_zgrada_id');
   }

   public static function getIzabranaZgradaName()
   {
    return session('upravnik_izabrana_zgrada_name');
   }


}