<?php

namespace App\QueryFilter;


class Type extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());
        if (empty($q))
        {
            return $builder;
        }
        return $builder->where('type',$q);
    }
}
