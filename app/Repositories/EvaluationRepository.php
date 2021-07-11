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

    public function attachStudent($id, $students)
    {
        $e = $this->findOneById($id);
        $students = is_array($students) ? $students : [$students];
        $attachedIds = $e->students()->whereIn('students.id', $students['students'])->pluck('students.id');
        $newIds = array_diff($students['students'], $attachedIds->all());
        $e->students()->attach($newIds);
        return $e;

    }

    public function detachStudent($id, $students)
    {
        $e = $this->findOneById($id);
        $students = is_array($students) ? $students : [$students];

        $e->students()->detach($students);
        return $e;
    }

    public function attachSkill($id, $skills)
    {
        $e = $this->findOneById($id);
        $skills = is_array($skills) ? $skills : [$skills];
        $attachedIds = $e->skills()->whereIn('skills.id', $skills['skills'])->pluck('skills.id');
        $newIds = array_diff($skills['skills'], $attachedIds->all());
        $e->skills()->attach($newIds);
        return $e;
    }

    public function detachSkill($id, $skills)
    {
        $e = $this->findOneById($id);
        $skills = is_array($skills) ? $skills : [$skills];

        $e->skills()->detach($skills);
        return $e;
    }

    public function createSession($id, array $data)
    {
        $e = $this->findOneById($id);
        $e->sessions()->create($data);
        return $e;
    }

    public function deleteSession($id, $session)
    {
        $e = $this->findOneById($id);
        $s = $e->sessions()->where('id',$session)->firstOrFail();
        $s->delete();
        return $e;
    }
}
