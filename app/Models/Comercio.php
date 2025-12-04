<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comercio extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_NOACTIVE = 'noactive';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'keyword',
        'area_id',
        'user_id',
        'avatar',
        'banner',
        'dominio',
        'contactcellphone',
        'contactphone',
        'email',
        'youtube',
        'twitter',
        'facebook',
        'address',
        'rifLetter',
        'rifNumber',
    ];

    protected $appends = [
        'avatar_url',
        'banner_url',
    ];

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && Storage::disk('avatarscomercios')->exists($this->avatar)) {   
            return Storage::disk('avatarscomercios')->url($this->avatar);
        }
        return asset('/img/panexpres_logo.png');
        //return asset('noimage.png');
    }

    public function getBannerUrlAttribute()
    {
        if ($this->banner && Storage::disk('bannerscomercios')->exists($this->banner)) {
            return Storage::disk('bannerscomercios')->url($this->banner);
        }
        return asset('nobanner.png');
    }

    public function getTelefonoAttribute()
    {
        return $this->contactcellphone . ' ' . $this->contactphone;
    }

    public function propietario()
    {
        $propietario = User::find($this->user_id);
        return $propietario->name;
        
    }

    public function getPropietario()
    {
        $propietario = User::find($this->user_id);
        
        return $propietario;        
    }

    public function OperacionNoConfirmada()
    {
        return Transaccion::query()
            ->where('comercio_id', $this->id)
            ->where('status', 'norevisado')
            ->count();
    }

    public function area ()
    {
        return $this->hasOne(Area::class);
    }

    public function categories ()
    {
        return $this->hasMany(Category::class);
    }

    public function manufacturersOriginal()
    {
        return Manufacturer::where('comercio_id', $this->id)->where('mercado', 'original')->get();
        //return $this->hasMany(Manufacturer::class);
    }

    public function valoracionProduct()
    {
        return $this->hasOne(ValoracionProduct::class, 'product_id', 'id')->withDefault([
            'ca_valoracion' => '0',
            'class' => 'star',
            'comment' => '',
        ]);
    }
    
}
