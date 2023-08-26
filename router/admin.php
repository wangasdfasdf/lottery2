<?php


use app\controller\admin\AdminUserController;
use app\controller\admin\AgentController;
use app\controller\admin\AgentWalletPaymentLogController;
use app\controller\admin\AppVersionController;
use app\controller\admin\AuthController;
use app\controller\admin\ConfigController;
use app\controller\admin\UploadController;
use app\controller\admin\VersionController;
use app\middleware\CheckAdminLogin;
use Webman\Route;


Route::group("/admin/v1/", function () {

    //登录
    Route::post('login', [AuthController::class, 'login']);



    Route::group('', function () {
        //管理员添加
        Route::post("admin", [AdminUserController::class, 'store']);
        Route::get("admin", [AdminUserController::class, 'index']);
        Route::put("admin/{id}", [AdminUserController::class, 'update']);
        Route::get("admin/{id}", [AdminUserController::class, 'show']);
        Route::delete("admin/{id}", [AdminUserController::class, 'destroy']);

        //代理
        Route::post("agent", [AgentController::class, 'store']);
        Route::get("agent", [AgentController::class, 'index']);
        Route::put("agent/{id}", [AgentController::class, 'update']);
        Route::get("agent/{id}", [AgentController::class, 'show']);
        Route::delete("agent/{id}", [AgentController::class, 'destroy']);

        // 配置
        Route::post('config', [ConfigController::class, 'store']);
        Route::put('config/{id}', [ConfigController::class, 'update']);
        Route::get('config', [ConfigController::class, 'index']);
        Route::get('config/{key}', [ConfigController::class, 'show']);

        //更新版本
        Route::get('app-version', [AppVersionController::class, 'index']);
        Route::post('app-version', [AppVersionController::class, 'store']);

        //版本设置
        Route::post('version', [VersionController::class, 'store']);

        //钱包记录
        Route::get("wallet-payment-log", [AgentWalletPaymentLogController::class, 'index']);
        //上传
        Route::post('upload', [UploadController::class, 'upload']);
    })->middleware([
        CheckAdminLogin::class,
    ]);

});