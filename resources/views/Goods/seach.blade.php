<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>搜索页面</title>

		<link href="{{asset('AmazeUI-2.4.2/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('AmazeUI-2.4.2/assets/css/admin.css')}}" rel="stylesheet" type="text/css" />

		<link href="{{asset('basic/css/demo.css')}}" rel="stylesheet" type="text/css" />

		<link href="{{asset('css/seastyle.css')}}" rel="stylesheet" type="text/css" />
		<script src="{{asset('layui/layui/layui.js')}}"></script>

		<script type="text/javascript" src="{{asset('basic/js/jquery-1.7.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
{{--		<link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
	</head>

	<body>

		<!--顶部导航条 -->
		@include('Public.header1')

			<!--悬浮搜索框-->
		@include('Public.seach')

			<div class="clear"></div>
			<b class="line"></b>
           <div class="search">
			<div class="search-list">
			<div class="nav-table">
		@include('Public/header')
			</div>


					<div class="am-g am-g-fixed">
						<div class="am-u-sm-12 am-u-md-12">
	                  	<div class="theme-popover">
							<div class="searchAbout">
								<span class="font-pale">相关搜索：</span>
								<a title="坚果" href="#">坚果</a>
								<a title="瓜子" href="#">瓜子</a>
								<a title="鸡腿" href="#">豆干</a>

							</div>
							<ul class="select">
								<p class="title font-normal">
									<span class="fl">松子</span>
									<span class="total fl">搜索到<strong class="num">997</strong>件相关商品</span>
								</p>
								<div class="clear"></div>
								<li class="select-result">
									<dl>
										<dt>已选</dt>
										<dd class="select-no"></dd>
										<p class="eliminateCriteria">清除</p>
									</dl>
								</li>
								<div class="clear"></div>
								<li class="select-list">
									<dl id="select1">
										<dt class="am-badge am-round">品牌</dt>

										 <div class="dd-conent">
											<dd class="select-all selected"><a href="#">全部</a></dd>
											<dd><a href="#">百草味</a></dd>
											<dd><a href="#">良品铺子</a></dd>
											<dd><a href="#">新农哥</a></dd>
											<dd><a href="#">楼兰蜜语</a></dd>
											<dd><a href="#">口水娃</a></dd>
											<dd><a href="#">考拉兄弟</a></dd>
										 </div>

									</dl>
								</li>
								<li class="select-list">
									<dl id="select2">
										<dt class="am-badge am-round">种类</dt>
										<div class="dd-conent">
											<dd class="select-all selected"><a href="#">全部</a></dd>
											<dd><a href="#">东北松子</a></dd>
											<dd><a href="#">巴西松子</a></dd>
											<dd><a href="#">夏威夷果</a></dd>
											<dd><a href="#">松子</a></dd>
										</div>
									</dl>
								</li>
								<li class="select-list">
									<dl id="select3">
										<dt class="am-badge am-round">选购热点</dt>
										<div class="dd-conent">
											<dd class="select-all selected"><a href="#">全部</a></dd>
											<dd><a href="#">手剥松子</a></dd>
											<dd><a href="#">薄壳松子</a></dd>
											<dd><a href="#">进口零食</a></dd>
											<dd><a href="#">有机零食</a></dd>
										</div>
									</dl>
								</li>

							</ul>
							<div class="clear"></div>
                        </div>
							<div class="search-content">
								<div class="sort">
									<li class="first"><a title="综合">综合排序</a></li>
									<li><a title="销量">销量排序</a></li>
									<li><a title="价格">价格优先</a></li>
									<li class="big"><a title="评价" href="#">评价为主</a></li>
								</div>
								<div class="clear"></div>

								<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
									@forelse($rows as $v)
									<li>
										<a href="{{url('Goods/info')}}?id={{$v->id}}">
										<div class="i-pic limit">
											<img lay-src='{{asset("/upload/$v->pic")}}'  width="218px" height="218px"/>
											<p class="title fl">{{$v->good_name}}</p>
											<p class="price fl">
												<b>¥</b>
												<strong>{{$v->new_price}}</strong>
											</p>
											<p class="number fl">
												销量<span>{{$v->month_sale}}</span>
											</p>
										</div>
										</a>
									</li>
										@empty
									<li>很抱歉,小店还没有该商品,正在努力与商家联系中.......</li>
									@endforelse
								</ul>
							</div>
							<div class="search-side">

								<div class="side-title">
									经典搭配
								</div>

								<li>
									<div class="i-pic check">
										<img src="{{asset('images/cp.jpg')}}" />
										<p class="check-title">萨拉米 1+1小鸡腿</p>
										<p class="price fl">
											<b>¥</b>
											<strong>29.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic check">
										<img src="{{asset('images/cp2.jpg')}}" />
										<p class="check-title">ZEK 原味海苔</p>
										<p class="price fl">
											<b>¥</b>
											<strong>8.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>
								<li>
									<div class="i-pic check">
										<img src="{{asset('images/cp.jpg')}}" />
										<p class="check-title">萨拉米 1+1小鸡腿</p>
										<p class="price fl">
											<b>¥</b>
											<strong>29.90</strong>
										</p>
										<p class="number fl">
											销量<span>1110</span>
										</p>
									</div>
								</li>

							</div>
							<div class="clear"></div>
							<!--分页 -->
							<ul class="am-pagination am-pagination-right" id="page">
								<li class="am-disabled"><a href="#">&laquo;</a></li>
								<li class="am-active"><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>

								<li><a href="#">5</a></li>
								<li><a href="#">&raquo;</a></li>
{{--							<li><a href="">{{$rows->links()}}</a></li>--}}
							</ul>

						</div>
					</div>
				@include('Public.footer')
				</div>

			</div>

		<!--引导 -->
		<div class="navCir">
			<li><a href="home2.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>
			<li><a href="../person/index.html"><i class="am-icon-user"></i>我的</a></li>
		</div>

		<!--菜单 -->
	@include('Public/right')

		<script type="text/javascript" src="{{asset('basic/js/quick_links.js')}}"></script>

<div class="theme-popover-mask"></div>

	</body>

</html>
<script>
	layui.use('flow', function(){
		var flow = layui.flow;
		//当你执行这样一个方法时，即对页面中的全部带有lay-src的img元素开启了懒加载（当然你也可以指定相关img）
		flow.lazyimg();

	});
</script>
