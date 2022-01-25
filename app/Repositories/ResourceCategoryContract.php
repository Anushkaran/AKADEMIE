<?php

namespace App\Repositories;

use App\Models\ResourceCategory;

class ResourceCategoryContract extends BaseRepository implements \App\Contracts\ResourceCategoryContract
{

    /**
     * @inheritDoc
     */
    public function findOneById($id, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        return ResourceCategory::with($relations)->withCount($relations_count)->select($columns)->scopes($scopes)->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function findByFilter($per_page = 10, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        $query = ResourceCategory::with($relations)->withCount($relations_count)->select($columns)->scopes($scopes)->newQuery();
        return $this->applyFilter($query, $per_page,[
            \App\QueryFilter\Search::class
        ]);
    }

    /**
     * @inheritDoc
     */
    public function new(array $data)
    {

        return ResourceCategory::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $resource = $this->findOneById($id);

        $resource->update($data);

        return $resource;
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        return $this->findOneById($id)->delete();
    }


}
