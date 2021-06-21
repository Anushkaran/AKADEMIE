<?php


namespace App\Repositories;


use App\Models\Admin;
use App\Traits\UploadAble;

class AdminRepository extends BaseRepository implements \App\Contracts\AdminContract
{
    use UploadAble;
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
        if (array_key_exists('image',$data))
        {
            $data['image'] = $this->uploadOne($data['image'],'admin/img');
        }

        $data['password'] = bcrypt($data['password']);
        return Admin::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $admin = $this->findOneById($id);
        if (array_key_exists('image',$data))
        {
            if ($admin->image)
            {
                $this->deleteOne($admin->image);
            }
            $data['image'] = $this->uploadOne($data['image'],'admin/img');
        }

        if (array_key_exists('password',$data))
        {
            $data['password'] = bcrypt($data['password']);
        }

        $admin->update($data);
        return $admin;
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        $admin = $this->findOneById($id);
        if ($admin->image)
        {
            $this->deleteOne($admin->image);
        }
        return $admin->delete();
    }
}
