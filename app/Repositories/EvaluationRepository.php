<?php


namespace App\Repositories;


use App\Models\Evaluation;

class EvaluationRepository extends BaseRepository implements \App\Contracts\EvaluationContract
{

    /**
     * @inheritDoc
     */
    public function findOneById($id, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        return Evaluation::with($relations)
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
        $query = Evaluation::with($relations)->withCount($relations_count)->scopes($scopes)->select($columns)->newQuery();
        return $this->applyFilter($query, $per_page);
    }

    /**
     * @inheritDoc
     */
    public function new(array $data)
    {
        return Evaluation::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $evaluation = $this->findOneById($id);
        $evaluation->update($data);
        return $evaluation;
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        return Evaluation::destroy($id);
    }
}
