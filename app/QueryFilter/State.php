<?php

namespace App\QueryFilter;


class State extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());
        if (empty($q))
        {
            return $builder;
        }
        return $builder->where('state',$q);
    }
}
