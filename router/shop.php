<?php

use app\controller\shop\AgentFeedbackController;
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

        // 问题反馈
        Route::get('feedback/read', [AgentFeedbackController::class, 'isRead']);
        Route::post("feedback", [AgentFeedbackController::class, 'store']);
        Route::get("feedback", [AgentFeedbackController::class, 'index']);
        Route::put("feedback/{id:\d+}", [AgentFeedbackController::class, 'update']);
        Route::get("feedback/{id:\d+}", [AgentFeedbackController::class, 'show']);
        Route::delete("feedback/{id:\d+}", [AgentFeedbackController::class, 'destroy']);

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