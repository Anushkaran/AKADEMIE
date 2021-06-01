<?php


namespace App\Repositories;


use Illuminate\Routing\Pipeline;

abstract class BaseRepository
{

    protected $base_filters = [

    ];

    public function applyFilter($query, $per_page = 10, array $filters = [])
    {
        $filters = array_merge($this->base_filters,$filters);

        $result = app(Pipeline::class)
            ->send($query)
            ->through($filters)
            ->thenReturn();

        return $per_page > 0
            ? $result->paginate($per_page)->withQueryString()
            : $result->get();
    }
}
