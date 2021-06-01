<?php


namespace App\Repositories;


use App\Models\Center;

class CenterRepository extends BaseRepository implements \App\Contracts\CenterContract
{

    /**
     * @inheritDoc
     */
    public function findOneById($id, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        return Center::with($relations)
            ->withCount($relations_count)
            ->select($columns)
            ->scopes($scopes)
            ->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function findByFilter($per_page = 10, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        $query = Center::with($relations)->withCount($relations_count)->select($columns)->scopes($scopes)->newQuery();
        return $this->applyFilter($query, $per_page);
    }

    /**
     * @inheritDoc
     */
    public function new(array $data)
    {
        return Center::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $center = $this->findOneById($id);
        $center->update($data);
        return $center;
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        return Center::destroy($id);
    }
}
