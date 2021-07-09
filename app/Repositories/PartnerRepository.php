<?php


namespace App\Repositories;


use App\Models\Partner;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PartnerRepository extends BaseRepository implements \App\Contracts\PartnerContract
{

    /**
     * @inheritDoc
     */
    public function findOneById($id, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = [])
    {
        return Partner::with($relations)
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
        $query =  Partner::with($relations)
            ->withCount($relations_count)
            ->select($columns)
            ->scopes($scopes)
            ->newQuery();
        return $this->applyFilter($query,$per_page,[
            \App\QueryFilter\Search::class
        ]);
    }

    /**
     * @inheritDoc
     */
    public function new(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return Partner::create($data);
    }

    /**
     * @inheritDoc
     * @throws ValidationException
     */
    public function update($id, array $data)
    {
        $p = $this->findOneById($id);

        if (array_key_exists('password',$data))
        {
            if (Hash::check($data['password'],$p->password))
            {
                throw ValidationException::withMessages([
                    'password' => 'new password cannot be the same as old'
                ]);
            }
            $data['password'] = Hash::make($data['password']);
        }

        $p->update($data);
        return $p;
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        $p = $this->findOneById($id);
        return $p->delete();
    }
}
