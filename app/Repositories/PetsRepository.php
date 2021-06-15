<?php

namespace App\Repositories;

use App\Models\Pets;
use App\Repositories\BaseRepository;

/**
 * Class PetsRepository
 * @package App\Repositories
 * @version June 15, 2021, 12:12 pm UTC
*/

class PetsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'image',
        'user_id'
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
        return Pets::class;
    }
}
