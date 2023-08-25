<?php

namespace app\enum;

enum OrderWinningStatus: string
{
    //未开奖
    case UNDRAWN = "undrawn";

    //中奖
    case  WINNING = 'winning';

    //    未中奖
    case  NOT_WON = 'not_won';


}
