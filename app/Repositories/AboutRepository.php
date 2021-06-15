<?php

namespace App\Repositories;

use App\Models\About;
use App\Repositories\BaseRepository;

/**
 * Class AboutRepository
 * @package App\Repositories
 * @version June 15, 2021, 12:06 pm UTC
*/

class AboutRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'extract',
        'description',
        'image'
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
        return About::class;
    }
}
