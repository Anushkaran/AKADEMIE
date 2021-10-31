<?php

namespace App\Contracts;

interface ResourceContract extends BaseContracts\CrudContract
{
    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function attachUser($id,array $data);

    /**
     * @param $id
     * @param $user
     * @return mixed
     */
    public function detachUser($id,$user);
}
