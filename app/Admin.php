<?php

namespace App;
use App\src\Models\Product;
use App\src\Models\Distrito;
use App\src\Models\SubCategory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'proveedor';
    protected $guard = 'proveedor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'distrito_id',
        'ruc',
        'razon_social',      
        'role',  
        'propietario',
        'dni',
        'correo',
        'telefono',
        'sub_category_id',
        'email', //este es el usuario
        'pass',
        'password',
        'monto_extra',
        'codigo_proveedor', 
        'pasarela_active',
        'image'
           
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
     public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function distrito(){
        return $this->belongsTo(Distrito::class, 'distrito_id', 'idDist');
    }
}
