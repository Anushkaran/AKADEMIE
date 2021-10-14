<?php


namespace App\Contracts;


interface EvaluationSessionContract extends BaseContracts\CrudContract
{
    public function findOneBy(array $params,array $relations = []);

    public function findBy(array $params,array $relations = []);


    /**
     * @param $evaluation
     * @param $session
     * @param $users
     * @return mixed
     */
    public function attachUser($evaluation,$session,$users);

    /**
     * @param $evaluation
     * @param $session
     * @param $users
     * @return mixed
     */
    public function detachUser($evaluation,$session,$users);

    /**
     * @param $evaluation
     * @param $session
     * @param $tasks
     * @return mixed
     */
    public function attachTask($evaluation,$session,$tasks);

    /**
     * @param $evaluation
     * @param $session
     * @param $tasks
     * @return mixed
     */
    public function detachTask($evaluation,$session,$tasks);
}
