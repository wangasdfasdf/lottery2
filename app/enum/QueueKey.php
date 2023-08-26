<?php

namespace app\enum;

enum QueueKey :string
{
  case  CANCEL_AGENT_WALLET_ADDRESS = 'cancel:agent:wallet:address';
  case  CANCEL_AGENT_SHOP_WALLET_ADDRESS = 'cancel:agent:shop:wallet:address';
}