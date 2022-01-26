<?php

namespace App\Repositories;

use App\Models\Resource;
use App\Traits\UploadAble;

class ResourceRepository extends BaseRepository implements \App\Contracts\ResourceContract
{
    use UploadAble;
    /**
     * @inheritDoc
     */
    public function findOneById($id, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        return Resource::with($relations)->select($columns)->withCount($relations_count)->scopes($scopes)->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function findByFilter($per_page = 10, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        $query = Resource::with($relations)->withCount($relations_count)->select($columns)->scopes($scopes)->newQuery();
        return $this->applyFilter($query, $per_page,[
            \App\QueryFilter\Search::class
        ]);
    }

    /**
     * @inheritDoc
     */
    public function new(array $data)
    {
        if (array_key_exists('file',$data))
        {
            $data['link'] = $this->uploadOne($data['file'],'resources','s3');
        }
        $resource = Resource::create($data);
        if (array_key_exists('resource_category_id',$data))
        {
            $resource->categories()->attach($data['resource_category_id']);
        }

        return $resource;
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $resource = $this->findOneById($id);

        $resource->update($data);

        if (array_key_exists('resource_category_id',$data))
        {
            $resource->categories()->sync($data['resource_category_id']);
        }

        return $resource;
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        $resource = $this->findOneById($id);

        if ($resource->link)
        {
            $this->deleteOne($resource->link,'s3');
        }

        return $resource->delete();
    }

    public function attachUser($id, array $data)
    {
        $resource = $this->findOneById($id);

        $resource->users()->syncWithoutDetaching($data['users']);

        return $resource;
    }

    public function detachUser($id, $user)
    {
        $users = is_array($user) ? $user : [$user];
        $resource = $this->findOneById($id);
        $resource->users()->detach($users);
        return$resource;
    }
}
