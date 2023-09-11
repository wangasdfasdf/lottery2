<?php


use app\controller\admin\AdController;
use app\controller\admin\AdminUserController;
use app\controller\admin\AgentAccountDaysLogController;
use app\controller\admin\AgentController;
use app\controller\admin\AgentOrderController;
use app\controller\admin\AgentShopController;
use app\controller\admin\AgentWalletPaymentLogController;
use app\controller\admin\AppVersionController;
use app\controller\admin\AuthController;
use app\controller\admin\ConfigController;
use app\controller\admin\ShopLinkController;
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
        Route::put("agent/{id}/account-days", [AgentController::class, 'accountDays']);

        // 配置
        Route::post('config', [ConfigController::class, 'store']);
        Route::put('config/{id}', [ConfigController::class, 'update']);
        Route::get('config', [ConfigController::class, 'index']);
        Route::get('config/{key}', [ConfigController::class, 'show']);

        //更新版本
        Route::get('app-version', [AppVersionController::class, 'index']);
        Route::post('app-version', [AppVersionController::class, 'store']);

        Route::get('order', [AgentOrderController::class, 'index']);
        Route::get('order/statistical', [AgentOrderController::class, 'statistical']);

        //店铺
        Route::get('shop', [AgentShopController::class, 'index']);
        Route::get('shop/{id:\d+}', [AgentShopController::class, 'show']);
        Route::put('shop/{id:\d+}/domain', [AgentShopController::class, 'updateDomain']);
//        Route::post('shop', [AgentShopController::class, 'store']);
//        Route::put('shop/{id}', [AgentShopController::class, 'update']);
//        Route::delete('shop/{id}', [AgentShopController::class, 'destroy']);


        //广告
        Route::post("ad", [AdController::class, 'store']);
        Route::get("ad", [AdController::class, 'index']);
        Route::put("ad/{id}", [AdController::class, 'update']);
        Route::get("ad/{id}", [AdController::class, 'show']);
        Route::delete("ad/{id}", [AdController::class, 'destroy']);

        //版本设置
        Route::post('version', [VersionController::class, 'store']);

        //钱包记录
        Route::get("wallet-payment-log", [AgentWalletPaymentLogController::class, 'index']);
        //上传
        Route::post('upload', [UploadController::class, 'upload']);

        Route::get('link', [ShopLinkController::class, 'index']);
        Route::delete('link/{id}', [ShopLinkController::class, 'destroy']);

        //账户记录
        Route::get('agent/account-day/log', [AgentAccountDaysLogController::class, 'index']);


    })->middleware([
        CheckAdminLogin::class,
    ]);

});