<?php


namespace App\Repositories;


use App\Models\EvaluationSession;

class EvaluationSessionRepository extends BaseRepository implements \App\Contracts\EvaluationSessionContract
{

    /**
     * @inheritDoc
     */
    public function findOneById($id, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        return EvaluationSession::with($relations)->withCount($relations_count)
            ->select($columns)->scopes($scopes)->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function findByFilter($per_page = 10, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        $query =  EvaluationSession::with($relations)->withCount($relations_count)
            ->select($columns)->scopes($scopes)->newQuery();
        return $this->applyFilter($query,$per_page);
    }

    /**
     * @inheritDoc
     */
    public function new(array $data)
    {
        return EvaluationSession::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $es = $this->findOneById($id);
        $es->update($data);
        return $es;
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        $es = $this->findOneById($id);
        return $es->delete();
    }
}
