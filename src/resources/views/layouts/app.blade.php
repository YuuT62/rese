<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo header__logo-rese">
                    <label class="modal__button modal__button-open" for="modal-open">--<br/>----<br/>-</span></label>
                    <input class="modal__check-open" type="radio" name="modal-check" id="modal-open">
                    <!-- ↓ モーダルウィンドウ ↓ -->
                    <div class="modal__overlay">
                        <div class="modal__content">
                            <div class="header__logo">
                                <label class="modal__button modal__button-close" for="modal-close">✕</label>
                                <input class="modal__check-close" type="radio" name="modal-check" id="modal-close">
                            </div>
                            <div class="modal__menu">
                                <div class="modal__menu-button">
                                    <a href="/">Home</a>
                                </div>

                                @if(Auth::check())
                                    <form class="modal__menu-button" action="/logout" method="post">
                                        @csrf
                                        <button class="modal__menu-button-submit" type="submit">Logout</button>
                                    </form>
                                @else
                                    <div class="modal__menu-button">
                                        <a href="/register">Registration</a>
                                    </div>
                                @endif

                                @if(Auth::check())
                                    <form class="modal__menu-button" action="/mypage" method="get">
                                        <button class="modal__menu-button-submit" type="submit">Mypage</button>
                                    </form>
                                @else
                                    <div class="modal__menu-button">
                                        <a href="/login">login</a>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <!-- ↑ モーダルウィンドウ ↑ -->
            </div>
            @yield('header')
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>