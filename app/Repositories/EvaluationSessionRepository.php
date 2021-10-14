<?php


namespace App\Repositories;


use App\Models\EvaluationSession;
use App\Models\Task;

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
        $es = EvaluationSession::create($data);
        if ($es->is_final)
        {
            $tasks = Task::whereHas('sessions',function ($s) use ($es){
                $s->where('evaluation_id',$es->evaluation_id);
            })->pluck('id');
            $es->tasks()->attach($tasks->all());
        }

        return $es;
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

    public function attachTask($evaluation, $session, $tasks)
    {
        $s = $this->findOneBy(['evaluation_id'=>$evaluation,'id' => $session]);
        if ($s->is_final)
        {
            return false;
        }
        $tasks = is_array($tasks) ? $tasks : [$tasks];
        $attachedIds = $s->tasks()->whereIn('tasks.id', $tasks['tasks'])->pluck('tasks.id');
        $newIds = array_diff($tasks['tasks'], $attachedIds->all());
        $s->tasks()->attach($newIds);
        return $s;
    }

    public function detachTask($evaluation, $session, $tasks)
    {
        $s = $this->findOneBy(['evaluation_id'=>$evaluation,'id' => $session]);
        if ($s->is_final)
        {
            return false;
        }
        $tasks = is_array($tasks) ? $tasks : [$tasks];
        $s->tasks()->detach($tasks);
        return $s;
    }

    public function findBy(array $params, array $relations = [])
    {
        $query =  EvaluationSession::with($relations)->newQuery();
        return $this->applyFilter($query,0);
    }
}
