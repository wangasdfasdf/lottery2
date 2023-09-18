<?php


use app\controller\shop\AdController;
use app\controller\shop\AgentConfigController;
use app\controller\shop\AgentFeedbackController;
use app\controller\shop\AgentOrderController;
use app\controller\shop\AgentShopController;
use app\controller\shop\AgentShopExpiryTimeLogController;
use app\controller\shop\AgentShopTicketConfigController;
use app\controller\shop\AuthController;
use app\controller\shop\ConfigController;
use app\controller\shop\HistoryMatchController;
use app\controller\shop\LotteryController;
use app\controller\shop\ShopLinkController;
use app\controller\shop\UploadController;
use app\controller\shop\VersionController;
use app\middleware\CheckShopExpiry;
use app\middleware\CheckShopLogin;
use app\middleware\CheckShopRsaLogin;
use app\middleware\CheckShopTag;
use Webman\Route;

Route::group("/shop/v1/", function () {

    //登录
    Route::post('login', [AuthController::class, 'login']);
    Route::get('version', [VersionController::class, 'show']);

    Route::get('address', [AgentShopController::class, 'addAddress']);
    //代理配置
    Route::get('agent-config/{key}', [AgentConfigController::class, 'info']);

    Route::post('link', [ShopLinkController::class, 'store']);


    Route::group("", function () {

        Route::get('info', [AgentShopController::class, 'info']);
        Route::put('info', [AgentShopController::class, 'update']);

        // 问题反馈
        Route::get('feedback/read', [AgentFeedbackController::class, 'isRead']);
        Route::post("feedback", [AgentFeedbackController::class, 'store']);
        Route::get("feedback", [AgentFeedbackController::class, 'index']);
        Route::put("feedback/{id:\d+}", [AgentFeedbackController::class, 'update']);
        Route::get("feedback/{id:\d+}", [AgentFeedbackController::class, 'show']);
        Route::delete("feedback/{id:\d+}", [AgentFeedbackController::class, 'destroy']);

        Route::post('order', [AgentOrderController::class, 'store']);
        Route::get('order/statistical', [AgentOrderController::class, 'statistical']);
        Route::post('order/print-info', [AgentOrderController::class, 'printInfo']);
        Route::post('order/grf', [AgentOrderController::class, 'grf']);
        Route::put('order/{id}/redeem', [AgentOrderController::class, 'redeem']);
        Route::put('order/{id}', [AgentOrderController::class, 'update']);
        Route::get('order', [AgentOrderController::class, 'index']);
        Route::get('order/{id}', [AgentOrderController::class, 'show']);

        //三方接口
        Route::post('third', [LotteryController::class, 'thirdResult']);

        //上传
        Route::post('upload', [UploadController::class, 'upload']);

        //历史数据
        Route::get('history/match/{path}', [HistoryMatchController::class, 'show']);
        Route::get('history/day', [HistoryMatchController::class, 'day']);

        //广告
        Route::get("ad", [AdController::class, 'index']);
        Route::get("ad/{id}", [AdController::class, 'show']);

        //加时记录
        Route::get("expiry-time-log", [AgentShopExpiryTimeLogController::class, 'index']);

        // 票面配置
        Route::post("ticket/config", [AgentShopTicketConfigController::class, 'store']);
        Route::get("ticket/config", [AgentShopTicketConfigController::class, 'index']);
        Route::put("ticket/config/{id:\d+}", [AgentShopTicketConfigController::class, 'update']);
        Route::get("ticket/config/{id:\d+}", [AgentShopTicketConfigController::class, 'show']);
        Route::delete("ticket/config/{id:\d+}", [AgentShopTicketConfigController::class, 'destroy']);

        //配置
        Route::get('config/{key}', [ConfigController::class, 'info']);

        //oss上传
        Route::get("policy", [UploadController::class, 'policy']);

    })->middleware([
        CheckShopLogin::class,
        CheckShopExpiry::class
    ]);


})->middleware([
    CheckShopTag::class,
    CheckShopRsaLogin::class,

]);