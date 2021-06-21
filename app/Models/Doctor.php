<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Doctor
 * @package App\Models
 * @version June 20, 2021, 5:17 pm UTC
 *
 * @property string $name
 * @property string $description
 * @property string $image
 */
class Doctor extends Model
{


    public $table = 'doctors';
    



    public $fillable = [
        'name',
        'description',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
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
