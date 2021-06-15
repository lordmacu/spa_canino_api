<?php

namespace App\Repositories;

use App\Models\Coupons;
use App\Repositories\BaseRepository;

/**
 * Class CouponsRepository
 * @package App\Repositories
 * @version June 15, 2021, 12:14 pm UTC
*/

class CouponsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'price',
        'code',
        'date'
    ];

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
        return Coupons::class;
    }
}
