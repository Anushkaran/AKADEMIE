<?php


namespace App\Repositories;


use App\Models\Task;

class TaskRepository extends BaseRepository implements \App\Contracts\TaskContract
{

    /**
     * @inheritDoc
     */
    public function findOneById($id, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        return Task::with($relations)
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
        $query = Task::with($relations)
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
        return Task::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $t = $this->findOneById($id);
        $t->update($data);
        return $t;
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        $t = $this->findOneById($id);
        return $t->delete();
    }
}
