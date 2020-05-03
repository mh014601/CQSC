<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//主页的路由

Route::get('/',['uses'=>'Home\IndexController@index']);
Route::any('WeChat/Api',['uses'=>'WeChat\ApiController@Index']);
//前台
Route::group(['prefix'=>'/Home'],function (){
    //跳转登录页
    Route::get('/login','Home\LoginController@login');
    //跳转注册页
    Route::get('/register','Home\LoginController@register');
    //登录处理页面
    Route::post('/procLogin','Home\LoginController@procLogin');
    //注册处理页面
    Route::any('/reg','Home\LoginController@reg');
    //处理验证码页面
    Route::post('/checkVerify','Home\LoginController@checkVerify');
    //验证手机号是否存在ajax
    Route::any('/checkphone','Home\LoginController@checkphone');
    //ajax注册手机号到数据库
    Route::any('/regphone','Home\LoginController@regphone');
    //加入购物车ajax 处理
    Route::any('/introduction','Home\ShopCartController@introduction');

    Route::group(['prefix'=>'Infor'],function () {
        //个人中心
        Route::any('/information', ['uses' => 'Home\InforController@information']);
        Route::any('/saveEditAction', ['uses' => 'Home\InforController@saveEditAction']);
        Route::any('/uploadPic', ['uses' => 'Home\InforController@uploadPic']);
        Route::any('/touxiang', ['uses' => 'Home\InforController@touxiang']);
        //安全设置
        Route::any('/safety', ['uses' => 'Home\InforController@safety']);
        Route::get('/ajax_checkPassword', ['uses' => 'Home\InforController@ajax_checkPassword']);
        //密码修改处理
        Route::any('/safetyAction', ['uses' => 'Home\InforController@safetyAction']);

    });



});
//商品页面的所有路由
Route::group(['prefix'=>'/Goods'],function (){
    //这是商品搜索跳转的处理页面
    Route::any('/seach','Goods\GoodsController@seach');
    //这是商品搜索页页面

    //这是商品详情页页面
    Route::get('/info','Goods\GoodsController@info')->middleware('info');
    //购物车跳转
    Route::any('/shopcart','Goods\GoodsController@shopcart');
    //商品详情页加入收藏处理
    Route::any('/addCollection','Goods\GoodsController@addCollection');
    //加入购物车处理
    Route::any('/infoAction','Goods\GoodsController@infoAction');
    //点击结算时  生成订单
    Route::any('/creatOrder','Goods\GoodsController@creatOrder');
    //结算详情页
    Route::any('/pay','Goods\GoodsController@pay');
    //购物车详情页处理  ajax
    Route::any('/cartAction','Goods\GoodsController@cartAction');
    //更改收货地址的路由
    Route::post('/shipAddress','Goods\GoodsController@shipAddress');
    //支付时更新订单
    Route::post('/updateOrder','Goods\GoodsController@updateOrder');
    //跳转支付成功页面
    Route::any('/sucess','Goods\GoodsController@sucess');
    //收藏
    Route::any('/collection','Goods\GoodsController@collection');
    //收藏处理
    Route::any('/collectionAction','Goods\GoodsController@collectionAction');
    //足迹
    Route::any('/goodsfoot','Goods\GoodsController@goodsfoot');
    //足迹处理
    Route::any('/footAction','Goods\GoodsController@footAction');


});
//这是个人信息的所有路由
Route::group(['prefix'=>'/Person'],function (){
    //这是个人信息  地址管理的路由
    Route::get('/address','Person\AddressController@address');
    //这是添加地址的路由
    Route::any('/addaddre','Person\AddressController@addaddre');
    //这是 ajax 地址三级联动的路由
    Route::get('/address1','Person\AddressController@address1');

    //这是ajax删除地址的路由
    Route::any('/clearAddre','Person\AddressController@clearAddre');
    //设置默认地址的路由
    Route::any('/setdefa','Person\AddressController@setdefa');
    //个人信息订单的路由
    Route::any('/order','Person\orderController@order');
    //个人信息订单详情
    Route::any('/orderinfo','Person\orderController@orderinfo');



});



Route::group(['prefix'=>'Admin','middleware'=>'adminLogin'],function (){
//后台首页
    Route::group(['prefix'=>'Index'],function (){
        //主页面
        Route::get('/index',['uses'=>'Admin\IndexController@index']);
        //顶部
        Route::get('/top',['uses'=>'Admin\IndexController@top']);
        //左部
        Route::get('/left',['uses'=>'Admin\IndexController@left']);
        //主要页面
        Route::get('/main',['uses'=>'Admin\IndexController@main']);
        //底部
        Route::get('/footer',['uses'=>'Admin\IndexController@footer']);
        //管理员登录  登录处理
        Route::get('/login',['uses'=>'Admin\IndexController@login']);
        Route::post('/loginAction',['uses'=>'Admin\IndexController@loginAction']);
        //退出
        Route::get('/loginOut',['uses'=>'Admin\IndexController@loginOut']);
        Route::get('/verify',['uses'=>'Admin\IndexController@verify']);
        Route::post('/ajaxCaptcha',['uses'=>'Admin\IndexController@ajaxCaptcha']);
        //找回密码
        Route::get('/findWord',['uses'=>'Admin\IndexController@findWord']);

    });
    //管理员 增删改查
    Route::group(['prefix'=>'Manager'],function (){
        //管理员列表
        Route::any('/managerList',['uses'=>'Admin\ManagerController@managerList']);
        //添加管理员页面
        Route::get('/managerAdd',['uses'=>'Admin\ManagerController@managerAdd']);
        //添加管理员处理
        Route::post('/managerAddAction',['uses'=>'Admin\ManagerController@managerAddAction']);
        //管理员删除
        Route::get('/managerDel',['uses'=>'Admin\ManagerController@managerDel']);
        //管理员编辑
        Route::get('/managerEdit/{id}',['uses'=>'Admin\ManagerController@managerEdit']);
        Route::post('/ajaxManagerName',['uses'=>'Admin\ManagerController@ajaxManagerName']);
        //管理员编辑处理
        Route::post('/managerEditAction',['uses'=>'Admin\ManagerController@managerEditAction']);
    });
    //商品分类管理
    Route::group(['prefix'=>'GoodsCate'],function (){
        //商品分类增加
        Route::get('/goodsCateAdd',['uses'=>'Admin\GoodsCateController@goodsCateAdd']);
        //商品分类列表
        Route::get('/goodsCateList',['uses'=>'Admin\GoodsCateController@goodsCateList']);
        //商品分类增加处理
        Route::post('/goodsCateAddAction',['uses'=>'Admin\GoodsCateController@goodsCateAddAction']);
        Route::post('/goodsCateDel',['uses'=>'Admin\GoodsCateController@goodsCateDel']);

    });
    //商品管理
    Route::group(['prefix'=>'Goods'],function (){
        //商品增加
        Route::get('/goodsAdd',['uses'=>'Admin\GoodsController@goodsAdd']);
        //商品列表
        Route::any('/goodsList',['uses'=>'Admin\GoodsController@goodsList']);
        //商品增加处理
        Route::post('/goodsAddAction',['uses'=>'Admin\GoodsController@goodsAddAction']);
        //商品删除
        Route::post('/goodsDel',['uses'=>'Admin\GoodsController@goodsDel']);
        //商品编辑
        Route::get('/goodsEdit/{id}',['uses'=>'Admin\GoodsController@goodsEdit']);
        //商品编辑处理
        Route::post('/goodsEditAction',['uses'=>'Admin\GoodsController@goodsEditAction']);
    });

    Route::group(['prefix'=>'User'],function (){
        //用户列表
        Route::any('/userList',['uses'=>'Admin\UserController@userList']);
        //用户编辑
        Route::get('/userEdit/{id}',['uses'=>'Admin\UserController@userEdit']);
        Route::post('/userEditAction/{id}',['uses'=>'Admin\UserController@userEditAction']);
        //用户删除
        Route::post('/userDel',['uses'=>'Admin\UserController@userDel']);
        //用户添加
        Route::get('/userAdd',['uses'=>'Admin\UserController@userAdd']);
        Route::post('/userAddAction',['uses'=>'Admin\UserController@userAddAction']);
    });

    Route::group(['prefix'=>'Role'],function (){
        //角色列表
        Route::get('/roleList',['uses'=>'Admin\RoleController@roleList']);
        //分配权限
        Route::get('/assignAuth',['uses'=>'Admin\RoleController@assignAuth']);
        Route::post('/assignAuthAction',['uses'=>'Admin\RoleController@assignAuthAction']);
        //角色添加
        Route::get('/roleAdd',['uses'=>'Admin\RoleController@roleAdd']);
        Route::post('/roleAddAction',['uses'=>'Admin\RoleController@roleAddAction']);
        //角色删除
        Route::post('/ajaxRoleDel',['uses'=>'Admin\RoleController@ajaxRoleDel']);
        Route::post('/ajaxRoleName',['uses'=>'Admin\RoleController@ajaxRoleName']);
    });


    Route::group(['prefix'=>'Auth'],function (){
        //权限列表
        Route::get('/authList',['uses'=>'Admin\AuthController@authList']);

        //权限添加
        Route::get('/authAdd',['uses'=>'Admin\AuthController@authAdd']);
        Route::post('/authAddAction',['uses'=>'Admin\AuthController@authAddAction']);
        Route::post('/ajaxAuthName',['uses'=>'Admin\AuthController@ajaxAuthName']);
        Route::post('/ajaxAuthDel',['uses'=>'Admin\AuthController@ajaxAuthDel']);
    });


    Route::group(['prefix'=>'Order'],function (){
        //订单列表
        Route::any('/orderList',['uses'=>'Admin\OrderController@orderList']);
        //订单编辑
        Route::get('/orderEdit/{id}',['uses'=>'Admin\OrderController@orderEdit']);
        Route::post('/orderEditAction',['uses'=>'Admin\OrderController@orderEditAction']);
    });
//回收站
    Route::group(['prefix'=>'Recycle'],function (){


        Route::any('/goodsRecycle',['uses'=>'Admin\RecycleController@goodsRecycle']);
        //商品还原
        Route::get('/goodsReduction/{id}',['uses'=>'Admin\RecycleController@goodsReduction']);

        Route::post('/goodsRecycleDel',['uses'=>'Admin\RecycleController@goodsRecycleDel']);


    });
});