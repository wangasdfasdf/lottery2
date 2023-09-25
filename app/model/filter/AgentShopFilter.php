<?php
namespace app\model\filter;


use app\model\abstract\QueryFilter;


class AgentShopFilter extends QueryFilter
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
     * 过滤登录名
     *
     * @param $loginName
     * @return mixed
     */
    public function loginName($loginName)
    {
        return $this->builder->where('login_name', 'like', "%{$loginName}%" );
    }


    /**
     * 过滤联系电话
     *
     * @param $phone
     * @return mixed
     */
    public function phone($phone)
    {
        return $this->builder->where('phone', $phone);
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
     * 过滤名称
     *
     * @param $name
     * @return mixed
     */
    public function name($name)
    {
        return $this->builder->where('name','like', "%{$name}%" );
    }


    /**
     * 过滤1:启用 -1:禁用
     *
     * @param $status
     * @return mixed
     */
    public function status($status)
    {
        return $this->builder->where('status', $status);
    }


    /**
     * 过滤到期时间
     *
     * @param $expiryTime
     * @return mixed
     */
    public function expiryTime($expiryTime)
    {
        return $this->builder->where('expiry_time', $expiryTime);
    }


    /**
     * 过滤机器编码
     *
     * @param $machineId
     * @return mixed
     */
    public function machineId($machineId)
    {
        return $this->builder->where('machine_id', $machineId);
    }


    /**
     * 过滤1:有历史下单 -1:没有
     *
     * @param $isHistory
     * @return mixed
     */
    public function isHistory($isHistory)
    {
        return $this->builder->where('is_history', $isHistory);
    }


    /**
     * 过滤打印类型 1:广告版  2:地址版
     *
     * @param $printType
     * @return mixed
     */
    public function printType($printType)
    {
        return $this->builder->where('print_type', $printType);
    }


    /**
     * 过滤订单号前缀
     *
     * @param $orderPrefix
     * @return mixed
     */
    public function orderPrefix($orderPrefix)
    {
        return $this->builder->where('order_prefix', $orderPrefix);
    }


    /**
     * 过滤店铺地址
     *
     * @param $address
     * @return mixed
     */
    public function address($address)
    {
        return $this->builder->where('address', $address);
    }


    /**
     * 过滤底部编码
     *
     * @param $bottomCode
     * @return mixed
     */
    public function bottomCode($bottomCode)
    {
        return $this->builder->where('bottom_code', $bottomCode);
    }


    /**
     * 过滤历史权限
     *
     * @param $roleHistory
     * @return mixed
     */
    public function roleHistory($roleHistory)
    {
        return $this->builder->where('role_history', $roleHistory);
    }


    /**
     * 过滤本期权限
     *
     * @param $roleCurrent
     * @return mixed
     */
    public function roleCurrent($roleCurrent)
    {
        return $this->builder->where('role_current', $roleCurrent);
    }


    /**
     * 过滤是否开通线上支付 -1:不开通 1:开通
     *
     * @param $isOpenOnlinePay
     * @return mixed
     */
    public function isOpenOnlinePay($isOpenOnlinePay)
    {
        return $this->builder->where('is_open_online_pay', $isOpenOnlinePay);
    }


    /**
     * 过滤月付金额
     *
     * @param $monthMoney
     * @return mixed
     */
    public function monthMoney($monthMoney)
    {
        return $this->builder->where('month_money', $monthMoney);
    }


    /**
     * 过滤季付金额
     *
     * @param $quarterMoney
     * @return mixed
     */
    public function quarterMoney($quarterMoney)
    {
        return $this->builder->where('quarter_money', $quarterMoney);
    }


    /**
     * 过滤钱包地址
     *
     * @param $walletAddress
     * @return mixed
     */
    public function walletAddress($walletAddress)
    {
        return $this->builder->where('wallet_address', $walletAddress);
    }


    /**
     * 过滤钱包图片
     *
     * @param $walletAddressImg
     * @return mixed
     */
    public function walletAddressImg($walletAddressImg)
    {
        return $this->builder->where('wallet_address_img', $walletAddressImg);
    }


    /**
     * 过滤备注
     *
     * @param $note
     * @return mixed
     */
    public function note($note)
    {
        return $this->builder->where('note', $note);
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
     * 过滤创建管理员ID
     *
     * @param $adminId
     * @return mixed
     */
    public function adminId($adminId)
    {
        return $this->builder->where('admin_id', $adminId);
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
     * @param $domain
     * @return mixed
     */
    public function domain($domain)
    {
        return $this->builder->where('domain', $domain);
    }


    /**
     * 过滤名称
     *
     * @param $exceed
     * @return mixed
     */
    public function exceed($exceed)
    {
        if ($exceed == 1 ){
            return $this->builder->where('expiry_time', '<=', now());
        }
        if ($exceed == 2 ){
            return $this->builder->where('expiry_time', '>', now());
        }
    }


}
