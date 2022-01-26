<?php


namespace App\QueryFilter;


use Closure;
use Illuminate\Support\Str;

abstract class Filter
{
    public function handle($request, Closure $next)
    {

        if( ! request()->has($this->filterName())){
            return $next($request);
        }

        return $next($request)->where(function($q)
        {
            $this->applyFilters($q);
        });
    }

    abstract protected function applyFilters($builder);

    protected function filterName(): string
    {
        return Str::snake(class_basename($this));
    }
}
