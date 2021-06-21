<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Banner
 * @package App\Models
 * @version June 20, 2021, 4:05 pm UTC
 *
 */
class Banner extends Model
{


    public $table = 'banners';
    



 
    public $fillable = [
         'url',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
     protected $casts = [
        'id' => 'integer',
        'url' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
