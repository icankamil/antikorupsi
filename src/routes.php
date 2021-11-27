<?php

use App\Akumulasi\Controller\AkumulasiController;
use App\AuthPortal\Controller\AuthPortalController;
use App\KuisionerPublik\Controller\KuisionerPublikController;
use App\Pertanyaan\Controller\PertanyaanController;
use App\Responden\Controller\RespondenController;
use Core\RouteCollection;

$routes = new RouteCollection();

/* -------------------------------------------------------------------------- */
/*                        Route Application Start Here                        */
/* -------------------------------------------------------------------------- */

// kuisioner publik
$routes->push('kuisioner_publik', '/', [KuisionerPublikController::class, 'index']);
$routes->push('kuisioner_publik_send', '/kuisioner-public-send', [KuisionerPublikController::class, 'send']);

// admin
$routes->prefix('admin', function ($routes) {

    // akumulasi
    $routes->push('akumulasi', '/akumulasi', [AkumulasiController::class, 'index']);

    // pertanyaan
    $routes->prefix('pertanyaan', function ($routes) {
        $routes->push('pertanyaan_index', '', [PertanyaanController::class, 'index']);
        $routes->push('pertanyaan_store', '/store', [PertanyaanController::class, 'store']);
        $routes->push('pertanyaan_get', '/{id}/get', [PertanyaanController::class, 'get']);
        $routes->push('pertanyaan_update', '/{id}/update', [PertanyaanController::class, 'update']);
        $routes->push('pertanyaan_delete', '/{id}/delete', [PertanyaanController::class, 'delete']);
    });

    // detail akumulasi
    $routes->push('detail_akumulasi', '/detail-akumulasi', [AkumulasiController::class, 'detail']);

    // responden
    $routes->prefix('responden', function ($routes) {
        $routes->push('responden_index', '', [RespondenController::class, 'index']);
        $routes->push('responden_get', '/{id}/get', [RespondenController::class, 'get']);
        $routes->push('responden_update', '/{id}/update', [RespondenController::class, 'update']);
        $routes->push('responden_delete', '/{id}/delete', [RespondenController::class, 'delete']);
    });
});

// handle auth portal request
$routes->push('authPortal', '/auth/check', [AuthPortalController::class, 'auth']);
$routes->push('authPortalLogout', '/logout', [AuthPortalController::class, 'logout']);


return $routes;
