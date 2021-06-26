<?php


namespace App\Repositories;


use App\Models\Student;

class StudentRepository extends BaseRepository implements \App\Contracts\StudentContract
{

    /**
     * @inheritDoc
     */
    public function findOneById($id, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        return Student::with($relations)
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
        $query = Student::with($relations)
            ->withCount($relations_count)
            ->scopes($scopes)
            ->select($columns)
            ->newQuery();
        return $this->applyFilter($query, $per_page);
    }

    /**
     * @inheritDoc
     */
    public function new(array $data)
    {
        return Student::create($data);
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
        $s = $this->findOneById($id);
        return $s->delete();
    }
}
