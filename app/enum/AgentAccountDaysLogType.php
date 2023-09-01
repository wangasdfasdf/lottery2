<?php

namespace app\enum;

enum AgentAccountDaysLogType: string
{
     // U充值
    case U_CHARGE = 'u_charge';

    //跟店铺充值
    case SHOP_REDUCE = 'shop_reduce';

    //后台添加
    case  ADMIN_CHARGE = 'admin_charge';
}