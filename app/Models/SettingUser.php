<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingUser extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'currency',
    ];

    public function client($comercioId = 1)
    {
        $comercio = Comercio::find($comercioId);
        $Setting = Setting::where('user_id', $comercio->user_id)->first();
        
        if(auth()->user()){
            $settingUser = SettingUser::where('user_id', auth()->user()->id)->first();
        }else{
            $settingUser = $Setting;
        }
        
        if($settingUser){
            return $settingUser->currency;
        }
        else{
            return $Setting->currency;
        }
        
    }
}
