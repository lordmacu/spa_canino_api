<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Pets
 * @package App\Models
 * @version June 15, 2021, 12:12 pm UTC
 *
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $user_id
 */
class Pets extends Model
{


    public $table = 'pets';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'name',
        'description',
        'image',
        'user_id'
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
        'image' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string',
        'description' => 'required|string',
        'image' => 'required|string',
        'user_id' => 'required|integer'
    ];

    
}
