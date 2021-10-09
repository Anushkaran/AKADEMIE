<?php


namespace App\Contracts;


interface EvaluationSessionContract extends BaseContracts\CrudContract
{
    public function findOneBy(array $params,array $relations = []);

    /**
     * @param $id
     * @param $users
     * @return mixed
     */
    public function attachUser($evaluation,$session,$users);

    /**
     * @param $id
     * @param $users
     * @return mixed
     */
    public function detachUser($evaluation,$session,$users);
}
