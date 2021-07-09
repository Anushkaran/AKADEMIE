<?php


namespace App\QueryFilter;


class Sort extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());

        if (in_array($q,['asc','desc']))
        {
            return $builder->orderBy('created_at',$q);
        }

        return $builder;
    }
}
