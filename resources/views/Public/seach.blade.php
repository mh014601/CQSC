<div class="nav white">
    <div class="logo"><img src="{{asset('images/logo.png')}}" /></div>
    <div class="logoBig">
        <li><a href="{{url('/')}}"><img src="{{asset('images/logobig.png')}}" /></a></li>
    </div>

    <div class="search-bar pr">
        <a name="index_none_header_sysc" href="#"></a>
        <form action="{{url('Goods/seach')}}" method="post">
            {{csrf_field()}}
            <input id="searchInput" name="keywords" type="text" placeholder="搜索" autocomplete="off">
            <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
        </form>
    </div>
</div>
