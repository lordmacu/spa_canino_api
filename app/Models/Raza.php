<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class About
 * @package App\Models
 * @version June 15, 2021, 12:06 pm UTC
 *
 * @property string $title
 * @property string $extract
 * @property string $description
 * @property string $image
 */
class Raza extends Model
{


    public $table = 'razas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'name',
     
    ];
    
    public function getRazaByName($name){ 
        return $this->where("name",$name)->first();
    }

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
     
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string',
 
    ];

    
}
