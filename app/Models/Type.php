<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Status
 * @package App\Models
 * @version June 20, 2021, 6:59 pm UTC
 *
 * @property string $name
 */
class Type extends Model
{


    public $table = 'types';
    



    public $fillable = [
        'name'
    ];

        
    public function getTypeByname($name){
        return $this->where("name",$name)->first();
    }

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
