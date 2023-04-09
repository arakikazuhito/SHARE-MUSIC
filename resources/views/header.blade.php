<div class="header-items">
    <div class="header-logo">
        <a href="{{ route('top')  }}"><img src="/img/logo.png"></a>
    </div>
    <div class="header-titles">
        <div class="header-serch">
            <form action="{{ route('serch') }}" method="get">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="serch" name="serch" id="serch-form" placeholder="キーワードをご入力ください">
            </form>
        </div>
        <ul class="header-nav">
            @auth
            <li><a href="{{ route('user_detail')  }}">{{ Auth::user()->name }}</a></li>
            @endauth
            @guest
            <li></li>
            @endguest
            <li><a href="{{  route('post')  }}">投稿</a></li>
            <li class="top"><a href="{{  route('top')   }}">トップ</a></li>
            @auth
            <li><a href="{{  route('logout') }}">ログアウト</a></li>
            @endauth
            @guest
            <li class="logout"><a href="{{  route('login') }}">ログイン</a></li>
            @endguest
        </ul>
    </div>
</div>