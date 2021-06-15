<?php

namespace App\Repositories;

use App\Models\PetHistory;
use App\Repositories\BaseRepository;

/**
 * Class PetHistoryRepository
 * @package App\Repositories
 * @version June 15, 2021, 12:20 pm UTC
*/

class PetHistoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'pet_id',
        'description'
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
        return PetHistory::class;
    }
}
