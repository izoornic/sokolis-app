<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stranica;

class UserStranicaPrikaz extends Model
{
    use HasFactory;

    /**
     * Checks if current rolle has access
     *
     * @param  mixed $userPozicijaTipId
     * @param  mixed $routeName
     * @return void
     */
    public static function isRoleHasRightToAccess($userPozicijaTipId, $routeName)
    { 
        try{
            $stranica = Stranica::where('route_name', $routeName)->firstOrFail();
            try{
               $model = UserStranicaPrikaz::where('user_tip_Id', $userPozicijaTipId)
                                ->where('stranica_Id', $stranica->id)
                                ->firstOrFail();
                return $model ? true : false;
            }catch(\Throwable $th){
                //throw $th
                return false;
            }
        }catch(\Throwable $th){
            //throw $th
            return false;
        }
    }
}
