<?php


use app\controller\agent\AgentConfigController;
use app\controller\agent\AgentFeedbackController;
use app\controller\agent\AgentShopController;
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

        //店铺
        Route::post('shop', [AgentShopController::class, 'store']);
        Route::get('shop', [AgentShopController::class, 'index']);
        Route::get('shop/{id:\d+}', [AgentShopController::class, 'show']);
        Route::put('shop/{id}', [AgentShopController::class, 'update']);
        Route::delete('shop/{id}', [AgentShopController::class, 'destroy']);

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

        //上传
        Route::post('upload', [UploadController::class, 'upload']);
    })->middleware([
        CheckAgentLogin::class
    ]);
});