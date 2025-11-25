<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingComercio extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'comercio_id',
        'site_email',
        'site_name',
        'site_title',
        'footer_text',
        'sidebar_collapse',
        'in_cellphonecontact',
        'in_sliderprincipal',
        'in_marcasproductos',
        'api_bcv',
        'currency',
        'in_impuesto',
    ];
}
