<?php


namespace App\Repositories;


use App\Models\Partner;

class PartnerRepository extends BaseRepository implements \App\Contracts\PartnerContract
{

    /**
     * @inheritDoc
     */
    public function findOneById($id, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        return Partner::with($relations)
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
        $query =  Partner::with($relations)
            ->withCount($relations_count)
            ->select($columns)
            ->scopes($scopes)
            ->newQuery();
        return $this->applyFilter($query,$per_page);
    }

    /**
     * @inheritDoc
     */
    public function new(array $data)
    {
        return Partner::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $p = $this->findOneById($id);
        $p->update($data);
        return $p;
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        $p = $this->findOneById($id);
        return $p->delete();
    }
}
