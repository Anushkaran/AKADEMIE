<?php


namespace App\Repositories;


use App\Models\Admin;

class AdminRepository extends BaseRepository implements \App\Contracts\AdminContract
{

    /**
     * @inheritDoc
     */
    public function findOneById($id, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        return Admin::with($relations)
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
        $query = Admin::with($relations)
            ->withCount($relations_count)
            ->select($columns)
            ->scopes($scopes)->newQuery();
        return $this->applyFilter($query, $per_page);
    }

    /**
     * @inheritDoc
     */
    public function new(array $data)
    {
        return Admin::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $admin = $this->findOneById($id);
        $admin->update($data);
        return $admin;
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        return Admin::destroy($id);
    }
}
