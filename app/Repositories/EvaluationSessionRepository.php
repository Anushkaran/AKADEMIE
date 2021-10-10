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
        $es = $this->findOneBy(['evaluation_id'=> $data['evaluation'],'id' => $id]);
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

    public function findOneBy(array $params, array $relations = [])
    {
        return EvaluationSession::with($relations)->where($params)->firstOrFail();
    }

    public function attachUser($evaluation,$session,$users)
    {
        $s = $this->findOneBy(['evaluation_id'=>$evaluation,'id' => $session]);
        $users = is_array($users) ? $users : [$users];
        $attachedIds = $s->users()->whereIn('users.id', $users['users'])->pluck('users.id');
        $newIds = array_diff($users['users'], $attachedIds->all());
        $s->users()->attach($newIds);
        return $s;
    }

    public function detachUser($evaluation,$session,$users)
    {
        $s = $this->findOneBy(['evaluation_id'=>$evaluation,'id' => $session]);
        $users = is_array($users) ? $users : [$users];
        $s->users()->detach($users);
        return $s;
    }
}
