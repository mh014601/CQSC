<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'Home/Infor/uploadPic',
        'Admin/User/userDel',
        'Admin/Index/ajaxCaptcha',
        'Admin/Role/ajaxRoleDel',
        'Admin/Role/ajaxRoleName',
        'Admin/Auth/ajaxAuthName',
        'Admin/Auth/ajaxAuthDel',
        'Admin/Manager/ajaxManagerName',
        'Goods/addCollection',
        'WeChat/Api'
    ];
}
