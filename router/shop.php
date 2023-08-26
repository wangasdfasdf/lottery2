<?php


use app\controller\shop\AgentFeedbackController;
use app\controller\shop\AgentOrderController;
use app\controller\shop\AgentShopController;
use app\controller\shop\AuthController;
use app\controller\shop\LotteryController;
use app\controller\shop\UploadController;
use app\controller\shop\VersionController;
use app\middleware\CheckShopLogin;
use app\middleware\CheckShopTag;
use Webman\Route;

Route::group("/shop/v1/", function () {

    //登录
    Route::post('login', [AuthController::class, 'login']);
    Route::get('version', [VersionController::class, 'show']);

    Route::group("", function () {

        Route::get('info', [AgentShopController::class, 'info']);
        Route::put('info', [AgentShopController::class, 'update']);
        Route::get('address', [AgentShopController::class, 'addAddress']);

        // 问题反馈
        Route::get('feedback/read', [AgentFeedbackController::class, 'isRead']);
        Route::post("feedback", [AgentFeedbackController::class, 'store']);
        Route::get("feedback", [AgentFeedbackController::class, 'index']);
        Route::put("feedback/{id:\d+}", [AgentFeedbackController::class, 'update']);
        Route::get("feedback/{id:\d+}", [AgentFeedbackController::class, 'show']);
        Route::delete("feedback/{id:\d+}", [AgentFeedbackController::class, 'destroy']);

        Route::post('order', [AgentOrderController::class, 'store']);
        Route::get('order/statistical', [AgentOrderController::class, 'statistical']);
        Route::put('order/{id}', [AgentOrderController::class, 'update']);
        Route::get('order', [AgentOrderController::class, 'index']);
        Route::get('order/{id}', [AgentOrderController::class, 'show']);


        //三方接口
        Route::post('third', [LotteryController::class, 'thirdResult']);

        //上传
        Route::post('upload', [UploadController::class, 'upload']);
    })->middleware([
        CheckShopLogin::class,
    ]);


})->middleware([
    CheckShopTag::class,

]);