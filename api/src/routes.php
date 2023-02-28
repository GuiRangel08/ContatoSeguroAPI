<?php

$r->addGroup('/api', function (\FastRoute\RouteCollector $r) {

    $r->addGroup('/users', function (\FastRoute\RouteCollector $r) {
        $r->addRoute('GET', '', ['UserController', 'getAll']);
        $r->addRoute('GET', '/{id:\d+}', ['UserController', 'getSingle']);
        $r->addRoute('POST', '', ['UserController', 'store'], );
        $r->addRoute('PUT', '', ['UserController', 'update']);
        $r->addRoute('DELETE', '/{id:\d+}', ['UserController', 'destroy']);
    });

    $r->addGroup('/companies', function (\FastRoute\RouteCollector $r) {
        $r->addRoute('GET', '', ['CompanyController', 'getAll']);
        $r->addRoute('GET', '/{id:\d+}', ['CompanyController', 'getSingle']);
        $r->addRoute('POST', '', ['CompanyController', 'store']);
        $r->addRoute('PUT', '', ['CompanyController', 'update']);
        $r->addRoute('DELETE', '/{id:\d+}', ['CompanyController', 'destroy']);
    });

    $r->addGroup('/users_companies', function (\FastRoute\RouteCollector $r) {
        $r->addRoute('GET', '', ['UserCompanyController', 'getAll']);
        $r->addRoute('POST', '', ['UserCompanyController', 'store']);
        $r->addRoute('DELETE', '/{id:\d+}', ['UserCompanyController', 'destroy']);
    });
});