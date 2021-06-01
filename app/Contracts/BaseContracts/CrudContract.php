<?php


namespace App\Contracts\BaseContracts;


interface CrudContract
{
    /**
     * @param $id
     * @param array $relations
     * @param array|string[] $columns
     * @param array $scopes
     * @param array $relations_count
     * @return mixed
     */
    public function findOneById($id, array $relations = [],array $columns = ['*'], array $scopes = [], array $relations_count = []);

    /**
     * @param array $relations
     * @param array|string[] $columns
     * @param array $scopes
     * @param array $relations_count
     * @return mixed
     */
    public function findByFilter($per_page = 10, array $relations = [],array $columns = ['*'], array $scopes = [], array $relations_count = []);

    /**
     * @param array $data
     * @return mixed
     */
    public function new(array $data);

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

}
