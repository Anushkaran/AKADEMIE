<?php


namespace App\Contracts\BaseContracts;


interface CrudContract
{
    /**
     * @param $id
     * @param array $relations
     * @param array|string[] $column
     * @param array $scopes
     * @param array $relations_count
     * @return mixed
     */
    public function findOneById($id, array $relations = [],array $column = ['*'], array $scopes = [], array $relations_count = []);

    /**
     * @param array $relations
     * @param array|string[] $column
     * @param array $scopes
     * @param array $relations_count
     * @return mixed
     */
    public function findByFilter(array $relations = [],array $column = ['*'], array $scopes = [], array $relations_count = []);

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
