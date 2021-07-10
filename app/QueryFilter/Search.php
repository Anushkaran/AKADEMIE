<?php


namespace App\QueryFilter;


class Search extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());
        if (request()->is(['*students*']))
        {
            return $builder->where('first_name','like','%'.$q.'%')->orWhere('last_name','like','%'.$q.'%');
        }
        return $builder->where('name','like','%'.$q.'%');
    }
}
