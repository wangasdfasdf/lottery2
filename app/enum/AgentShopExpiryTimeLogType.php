<?php

namespace app\enum;

enum AgentShopExpiryTimeLogType: string
{
    case U_CHARGE = 'u_charge';
    case AGENT_CHARGE = 'agent_charge';
}