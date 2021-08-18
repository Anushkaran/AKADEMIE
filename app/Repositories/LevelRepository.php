<?php

namespace App\Repositories;

use App\Contracts\LevelContract;
use App\Models\Level;

class LevelRepository extends BaseRepository implements LevelContract
{

    public function findOneById($id, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        return Level::with($relations)
            ->withCount($relations_count)
            ->select($columns)
            ->scopes($scopes)
            ->findOrFail($id);
    }

    public function findByFilter($per_page = 10, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        $query = Level::with($relations)
            ->withCount($relations_count)
            ->select($columns)
            ->scopes($scopes)
            ->newQuery();

        return $this->applyFilter($query,$per_page,[
            \App\QueryFilter\Search::class
        ]);
    }

    public function new(array $data)
    {
        return Level::create($data);
    }

    public function update($id, array $data)
    {
        $level = $this->findOneById($id);
        $level->update($data);
        return $level;
    }

    public function delete($id)
    {
        return Level::destroy($id);
    }
}
