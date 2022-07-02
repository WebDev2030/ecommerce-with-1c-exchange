<?php

namespace App\Catalog\Repositories;

use Illuminate\Database\Eloquent\Model;

trait WithExternalIDTrait {
    /**
     * @param $externalID
     * @return Model
     */
    function getByExternalID($externalID): Model|null
    {
        return $this->getModel()->where('external_id', $externalID)->limit(1)->first();
    }
}
