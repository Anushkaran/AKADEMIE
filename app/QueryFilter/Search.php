<?php


namespace App\QueryFilter;


class Search extends Filter
{

    protected function applyFilters($builder)
    {
        $q = request($this->filterName());
        return $builder->where('name','like','%'.$q.'%');
    }
}
