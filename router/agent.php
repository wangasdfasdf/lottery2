<?php


use app\controller\agent\AgentAccountDaysLogController;
use app\controller\agent\AgentConfigController;
use app\controller\agent\AgentController;
use app\controller\agent\AgentFeedbackController;
use app\controller\agent\AgentOrderController;
use app\controller\agent\AgentShopController;
use app\controller\agent\AgentShopWalletPaymentLogController;
use app\controller\agent\AgentWalletPaymentLogController;
use app\controller\agent\AuthController;
use app\controller\agent\ConfigController;
use app\controller\agent\UploadController;
use app\middleware\CheckAgentLogin;
use Webman\Route;

Route::group("/agent/v1/", function () {

    //登录
    Route::post('login', [AuthController::class, 'login']);

    Route::group('', function () {

        //详情
        Route::get('info', [AuthController::class, 'info']);
        Route::put('info', [AuthController::class, 'update']);
        Route::get('address', [AgentController::class, 'address']);


        //店铺
        Route::post('shop', [AgentShopController::class, 'store']);
        Route::get('shop', [AgentShopController::class, 'index']);
        Route::get('shop/{id:\d+}', [AgentShopController::class, 'show']);
        Route::put('shop/{id}', [AgentShopController::class, 'update']);
        Route::delete('shop/{id}', [AgentShopController::class, 'destroy']);
        Route::post('shop/expiry-time', [AgentShopController::class, 'expiryTime']);

        Route::get('order', [AgentOrderController::class, 'index']);
        Route::get('order/statistical', [AgentOrderController::class, 'statistical']);

        //配置
        Route::get('config/{key}', [ConfigController::class, 'info']);

        //代理配置
        Route::post('agent-config', [AgentConfigController::class, 'store']);
        Route::put('agent-config/{id}', [AgentConfigController::class, 'update']);
        Route::get('agent-config', [AgentConfigController::class, 'index']);
        Route::get('agent-config/{key}', [AgentConfigController::class, 'show']);

        //问题反馈
        Route::get("feedback", [AgentFeedbackController::class, 'index']);
        Route::put("feedback/{id:\d+}", [AgentFeedbackController::class, 'update']);

        //账户记录
        Route::get('account-day/log', [AgentAccountDaysLogController::class, 'index']);

        //钱包记录
        Route::get("wallet-payment-log", [AgentWalletPaymentLogController::class, 'index']);

        //上传
        Route::post('upload', [UploadController::class, 'upload']);

        //钱包记录
        Route::get("shop/wallet-payment-log", [AgentShopWalletPaymentLogController::class, 'index']);

        //oss上传
        Route::get("policy", [UploadController::class, 'policy']);

    })->middleware([
        CheckAgentLogin::class
    ]);
});