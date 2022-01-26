<?php

namespace App\Repositories;

use App\Models\PedagogicalReferent;

class PedagogicalReferentRepository extends BaseRepository implements \App\Contracts\PedagogicalReferentContract
{

    /**
     * @inheritDoc
     */
    public function findOneById($id, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        return PedagogicalReferent::with($relations)
            ->scopes($scopes)
            ->select($columns)
            ->withCount($relations_count)
            ->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function findByFilter($per_page = 10, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        $query = PedagogicalReferent::with($relations)
            ->withCount($relations_count)
            ->scopes($scopes)
            ->select($columns)
            ->newQuery();
        return $this->applyFilter($query, $per_page,[
            \App\QueryFilter\Search::class
        ]);
    }

    /**
     * @inheritDoc
     */
    public function new(array $data)
    {
        return PedagogicalReferent::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $s = $this->findOneById($id);
        $s->update($data);
        return $s;
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        return $this->findOneById($id)->delete();
    }
}
