<?php

namespace App\Repositories;

use App\Models\Popular;
use App\Repositories\BaseRepository;

/**
 * Class PopularRepository
 * @package App\Repositories
 * @version June 20, 2021, 7:07 pm UTC
*/

class PopularRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'product_id'
    ];
    
   public function product(){
        $this->belongsTo(\App\Models\Products::class);
    }

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Popular::class;
    }
}
