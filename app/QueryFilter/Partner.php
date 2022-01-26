<?php

namespace App\QueryFilter;

use App\Models\Student;
use App\Models\User;

class Partner extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());

        if (empty($q))
        {
            return $builder;
        }

        $model = $builder->getModel();

        if (
            $model instanceof User || $model instanceof Student
        )
        {
            $builder->where('partner_id',$q);
        }

        return $builder;
    }
}
