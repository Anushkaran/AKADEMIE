<?php


namespace App\Contracts;


interface EvaluationContract extends BaseContracts\CrudContract
{

    /**
     * @param $id
     * @param $students
     * @return mixed
     */
    public function attachStudent($id,$students);

    /**
     * @param $id
     * @param $students
     * @return mixed
     */
    public function detachStudent($id,$students);

    /**
     * @param $id
     * @param $skills
     * @return mixed
     */
    public function attachSkill($id,$skills);

    /**
     * @param $id
     * @param $skills
     * @return mixed
     */
    public function detachSkill($id,$skills);

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function createSession($id,array $data);

    /**
     * @param $ev
     * @param $session
     * @param array $relations
     * @param array $scopes
     * @return mixed
     */
    public function findSession($ev,$session,array $relations =[],array $scopes = []);

    /**
     * @param $id
     * @param $session
     * @return mixed
     */
    public function deleteSession($id,$session);

    public function findByPartner($id,$per_page = 10, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = []);
    public function findOneByPartner($id,$evaluation, array $relations = [], array $columns = ['*'], array $scopes = [], array $relations_count = []);
}
