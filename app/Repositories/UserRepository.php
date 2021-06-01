<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository extends BaseRepository implements \App\Contracts\UserContract
{

    /**
     * @inheritDoc
     */
    public function findOneById($id, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        return User::with($relations)->select($columns)->withCount($relations_count)->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function findByFilter($per_page = 10, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        $query = User::with($relations)->select($columns)->withCount($relations_count)->newQuery();
        return $this->applyFilter($query,$per_page);
    }

    /**
     * @inheritDoc
     */
    public function new(array $data)
    {
        User::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $user = $this->findOneById($id);
        $user->update($data);
        return $user;
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        return User::destroy($id);
    }
}
