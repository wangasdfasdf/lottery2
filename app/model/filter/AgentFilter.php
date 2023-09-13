<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class AgentFilter extends QueryFilter
{

    /**
     * 过滤
     *
     * @param $id
     * @return mixed
     */
    public function id($id)
    {
        return $this->builder->where('id', $id);
    }


    /**
     * 过滤登录名称
     *
     * @param $loginName
     * @return mixed
     */
    public function loginName($loginName)
    {
        return $this->builder->where('login_name', $loginName);
    }


    /**
     * 过滤登录密码
     *
     * @param $password
     * @return mixed
     */
    public function password($password)
    {
        return $this->builder->where('password', $password);
    }


    /**
     * 过滤昵称
     *
     * @param $name
     * @return mixed
     */
    public function name($name)
    {
        return $this->builder->where('name', $name);
    }


    /**
     * 过滤头像
     *
     * @param $avatar
     * @return mixed
     */
    public function avatar($avatar)
    {
        return $this->builder->where('avatar', $avatar);
    }


    /**
     * 过滤token
     *
     * @param $token
     * @return mixed
     */
    public function token($token)
    {
        return $this->builder->where('token', $token);
    }


    /**
     * 过滤
     *
     * @param $createdAt
     * @return mixed
     */
    public function createdAt($createdAt)
    {
        return $this->builder->where('created_at', $createdAt);
    }


    /**
     * 过滤
     *
     * @param $updatedAt
     * @return mixed
     */
    public function updatedAt($updatedAt)
    {
        return $this->builder->where('updated_at', $updatedAt);
    }


    /**
     * 过滤
     *
     * @param $deletedAt
     * @return mixed
     */
    public function deletedAt($deletedAt)
    {
        return $this->builder->where('deleted_at', $deletedAt);
    }


    public function domains($domains)
    {
        return $this->builder->whereJsonContains('domains', $domains);
    }

}
