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
     * @param $id
     * @param $session
     * @return mixed
     */
    public function deleteSession($id,$session);
}
