<?php


namespace App\Repositories;


use App\Models\User;
use App\Traits\UploadAble;

class UserRepository extends BaseRepository implements \App\Contracts\UserContract
{
    use UploadAble;
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
        return $this->applyFilter($query,$per_page,[
            \App\QueryFilter\Search::class
        ]);
    }

    /**
     * @inheritDoc
     */
    public function new(array $data)
    {
        if (array_key_exists('image',$data))
        {
            $data['image'] = $this->uploadOne($data['image'],'user/img');
        }

        $data['password'] = bcrypt($data['password']);

        User::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $user = $this->findOneById($id);
        if (array_key_exists('password',$data))
        {
            $data['password'] = bcrypt($data['password']);
        }

        if (array_key_exists('image',$data))
        {
            if ($user->image)
            {
                $this->deleteOne($user->image);

            }
            $data['image'] = $this->uploadOne($data['image'],'user/img');
        }

        $user->update($data);
        return $user;
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        $user = $this->findOneById($id);
        if ($user->image)
        {
            $this->deleteOne($user->image);
        }
        return $user->delete();
    }
}
