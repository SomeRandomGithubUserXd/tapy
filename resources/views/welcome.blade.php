<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tapy.me: сервис мультиссылок и микролендингов</title>
    <meta name="description"
          content="Конструктор мультиссылок для инстаграм и других социальных сетей. Не требуются навыки программирования.">
    <meta name="keywords" content="мультиссылка для инстаграм,мультиссылка для tiktok, создать мобильный лендинг">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('Images/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('Images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('Images/favicon-16x16.png')}}">
    <link rel="mask-icon" href="{{asset('fonts/safari-pinned-tab.svg')}}" color="#d55bb6">
    <meta name="msapplication-TileColor" content="#315562">
    <meta name="theme-color" content="#ffffff">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">

    <meta property="og:title" content="Tapy.me: сервис мультиссылок и микролендингов">
    <meta property="og:description"
          content="Конструктор мультиссылок для инстаграм и других социальных сетей. Не требуются навыки программирования.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{config('app.url')}}">
    <meta property="og:image" content="{{asset('Images/apple-touch-icon.png')}}">

    <link rel="stylesheet" href="{{asset('land-assets/styles.css')}}">
    {{--    <script type="text/javascript" async="" src="https://vk.com/js/api/openapi.js?169"></script>--}}
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light">
    <div class="container">
        <a class="navbar-brand d-flex" href="/">
            <img class="logo" height="100px" src="{{asset('logo.svg')}}" alt="">
        </a>
        <div class="d-flex align-items-center">
            <ul class="navbar-nav d-flex d-md-none flex-row align-items-center">
                <li class="nav-item">
                    <a class="nav-link p-2" href="{{route('login')}}">Войти</a>
                </li>
                <li class="nav-item" style="margin-right: -1.5rem">
                    <button class="btn link-secondary shadow-none" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-list d-flex" viewBox="0 0 16 16" style="width: 1.6rem; height: 1.6rem;">
                            <path fill-rule="evenodd"
                                  d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
                        </svg>
                    </button>
                </li>
            </ul>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img class="logo d-flex" height="90px"
                                                                           src="{{asset('logo.svg')}}" alt="">
                </h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item me-4">
                        <a class="nav-link" href="https://tapy.me/page/blog?lang=ru">Блог</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Войти</a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link text-primary" href="{{route('login')}}">Регистрация</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


<main class="overflow-hidden">
    <div class="container py-5">
        <div class="row align-items-center py-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-5 fw-bold lh-1 mb-3">Упрощайте путь вашей аудитории</h1>
                <p class="lead py-4">Разместите ссылки на ваши социальные сети, музыку, видео, подкасты и многое другое
                    на одной странице</p>
                <div class="d-grid gap-2 d-lg-flex justify-content-lg-start justify-content-center mb-5">
                    <div class="magnetic">
                        <span>
                            <a href="{{route('login')}}" class="btn btn-primary btn-lg px-4">Создать страницу</a>
                        </span>
                    </div>
                </div>
            </div>
            <div
                class="intro-col position-relative col-lg-6 d-flex justify-content-center align-items-start justify-content-lg-end align-items-lg-center">
                <div class="magnetic d-block mx-auto position-relative">
                    <span>
                        <img src="{{asset('Images/phone.png')}}" alt="" class="d-block mx-auto" height="580px">
                        <div class="intro-page position-absolute d-flex align-items-center flex-column w-100">
                            <div class="mb-2">
                                <img src="{{asset('Images/avatar.png')}}" alt="" class="d-block rounded-circle"
                                     height="90px">
                            </div>
                            <div class="d-flex align-items-center">
                                Nick
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#3b82f6"
                                     class="bi bi-patch-check-fill ms-2" viewBox="0 0 16 16">
                        <path
                            d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"></path>
                    </svg>
                            </div>
                            <div>
                                <div class="mt-2 mb-3 text-muted small">Blogger &amp; Travaler</div>
                            </div>
                            <div class="intro-button-flip w-100">
                                <div class="intro-button" style="background: #ff0000; color: #fff">YouTube</div>
                                <div class="intro-button" style="background: #000; color: #fff">TikTok</div>
                            </div>
                            <div class="intro-button-flip w-100">
                                <div class="intro-button" style="background: #e33e45; color: #fff">Apple Music</div>
                                <div class="intro-button" style="background: #E1306C; color: #fff">Instagram</div>
                            </div>
                            <div class="intro-button-flip w-100">
                                <div class="intro-button" style="background: #1db954; color: #fff">Spotify</div>
                                <div class="intro-button" style="background: #0084ff; color: #fff">Facebook</div>
                            </div>
                            <div class="intro-button-flip w-100 next">
                                <div class="intro-button" style="background: #1DA1F2; color: #fff">Twitter</div>
                                                                <div class="intro-button"
                                                                     style="background: #25d366; color: #fff">WhatsApp</div>
                            </div>
                            <div class="intro-button-flip w-100 next">
                                <div class="intro-button" style="background: #181a22; color: #fff">Website</div>
                                <div class="intro-button" style="background: #1f9bda; color: #fff">Telegram</div>
                            </div>
                        </div>
                    </span>
                </div>
                <div class="animated-blob">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-8 overflow-hidden how-it-works">
        <p class="h2 pb-7 text-center">Как это работает</p>

        <div class="row row-cols-1 row-cols-md-2 align-items-center pb-4">
            <div class="col pb-5 pb-md-0 check-view viewed">
                <div class="d-flex flex-column align-items-center mw-100 mx-auto step-1" style="width: 300px">
                    <div
                        class="d-flex align-items-center bg-secondary bg-opacity-10 py-2 px-3 mb-4 page fade-show w-100"
                        style="--duration: 1s">
                        <div class="text-muted">tapy.me/</div>
                        <div id="page-link" class="ms-2 text-primary">usernam</div>
                    </div>

                    <img class="mb-3 rounded-circle avatar fade-show" src="{{asset('Images/avatar.png')}}"
                         style="width: 70px; height: 70px; --duration: 1.5s">
                    <div class="mb-2 fw-bold d-flex align-items-center name fade-show" style="--duration: 2s">Nick

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#3b82f6"
                             class="bi bi-patch-check-fill ms-2" viewBox="0 0 16 16">
                            <path
                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"></path>
                        </svg>
                    </div>
                    <div class="text-muted desc fade-show" style="--duration: 2.5s">Blogger &amp; Travaler</div>
                </div>
            </div>
            <div class="col">
                <p class="h4">1. Создайте страницу</p>
                <p class="">Зарегистрируйтесь, чтобы создать свою персональную страницу. Вы можете создать несколько
                    страниц на одном аккаунте.</p>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 align-items-center py-4">
            <div class="col pb-5 pb-md-0">
                <div class="d-flex flex-column align-items-center mw-100 mx-auto check-view viewed"
                     style="width: 300px">

                    <div
                        class="d-flex justify-content-center align-items-center rounded-3 w-100 py-3 px-2 mb-4 fade-show"
                        style="background-color: #E1306C; color: #fff; --duration: 3s">Instagram
                    </div>
                    <div
                        class="d-flex justify-content-center align-items-center rounded-3 w-100 py-3 px-2 mb-4 fade-show"
                        style="background-color: #000; color: #fff; --duration: 3.5s">TikTok
                    </div>

                    <div class="d-flex gap-2 fade-show" style="--duration: 4s">
                        <img class="w-9 h-9 rounded-full bg-gray-300 mb-3"
                             src="{{asset('fonts/whatsapp.svg')}}" alt="">
                        <img class="w-9 h-9 rounded-full bg-gray-300 mb-3"
                             src="{{asset('fonts/spotify.svg')}}" alt="">
                        <img class="w-9 h-9 rounded-full bg-gray-300 mb-3"
                             src="{{asset('fonts/youtube.svg')}}" alt="">
                    </div>

                    <div class="fade-show" style="--duration: 4.5s">
                        <img class="mw-100" src="{{asset('Images/video.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col">
                <p class="h4">2. Добавьте контент</p>
                <p class="">Добавьте ссылки на сайты, социальные сети, музыку, видео, подкасты и многое другое. Вы
                    можете разместить email и номер телефона если это необходимо.</p>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 align-items-center pt-4">
            <div class="col pb-5 pb-md-0">
                <div class="d-flex flex-column align-items-center justify-content-center mw-100 mx-auto"
                     style="width: 300px; height: 300px">
                    <img class="position-absolute" width="75px" src="{{asset('Images/logo_small.svg')}}" alt="">
                    <div class="spin-networks">
                        <div class="spin-network" style="--deg: 0deg">
                            <img src="{{asset('fonts/instagram.svg')}}" alt="">
                        </div>
                        <div class="spin-network" style="--deg: 45deg">
                            <img src="{{asset('fonts/tiktok.svg')}}" alt="">
                        </div>
                        <div class="spin-network" style="--deg: 90deg">
                            <img src="{{asset('fonts/facebook.svg')}}" alt="">
                        </div>
                        <div class="spin-network" style="--deg: 135deg">
                            <img src="{{asset('fonts/twitter.svg')}}" alt="">
                        </div>
                        <div class="spin-network" style="--deg: 180deg">
                            <img src="{{asset('fonts/telegram.svg')}}" alt="">
                        </div>
                        <div class="spin-network" style="--deg: 225deg">
                            <img src="{{asset('fonts/spotify.svg')}}" alt="">
                        </div>
                        <div class="spin-network" style="--deg: 270deg">
                            <img src="{{asset('fonts/soundcloud.svg')}}" alt="">
                        </div>
                        <div class="spin-network" style="--deg: 315deg">
                            <img src="{{asset('fonts/linkedin.svg')}}" alt="">
                        </div>
                    </div>

                </div>
            </div>
            <div class="col">
                <p class="h4">3. Поделитесь ссылкой</p>
                <p class="">Разместите ссылку на Tapy страницу в профилях социальных сетей, используйте в сторис или где
                    посчитаете нужным, чтобы соединить вашу аудиторию с вашим контентом.</p>
            </div>
        </div>

        <div class="d-flex pt-7 flex-column align-items-center justify-content-center py-5">
            <a href="{{route('login')}}" class="btn btn-outline-primary btn-lg">Начать бесплатно</a>
        </div>
    </div>

    <div class="container py-8 overflow-hidden">
        <div class="row row-cols-1 row-cols-md-3 gx-0 gx-md-7 gx-lg-8 gx-xl-9 gx-xxl-10 gy-6 gy-md-0">
            <div class="col">
                <div class="d-flex flex-column align-items-center justify-content-center text-center">
                    <img src="{{asset('fonts/feature1.svg')}}" alt="" class="w-100 feature-image"
                         style="border-radius: 50px;">
                    <p class="h5 fw-bold mt-5 mb-3">Брендируйте страницу</p>
                    <span>
                        Выбирайте цвета и адрес страницы под ваш бренд                    </span>
                </div>
            </div>
            <div class="col">
                <div class="d-flex flex-column align-items-center justify-content-center text-center">
                    <img src="{{asset('fonts/feature2.svg')}}" alt="" class="w-100 feature-image"
                         style="border-radius: 50px;">
                    <p class="h5 fw-bold mt-5 mb-3">Отслеживайте аналитику</p>
                    <span>
                        Узнайте какой контент пользуется успехом у вашей аудитории                    </span>
                </div>
            </div>
            <div class="col">
                <div class="d-flex flex-column align-items-center justify-content-center text-center">
                    <img src="{{asset('Images/feature3.webp')}}" alt="" class="w-100 feature-image"
                         style="border-radius: 50px;">
                    <p class="h5 fw-bold mt-5 mb-3">Без программирования</p>
                    <span>
                        Не требуется навыков программирования и дизайна                    </span>
                </div>
            </div>
        </div>
        <div class="d-flex pt-7 flex-column align-items-center justify-content-center py-5">
            <a href="{{route('login')}}" class="btn btn-outline-primary btn-lg">Создать страницу</a>
        </div>
    </div>

    <div class="py-8 bg-light">
        <div class="container" id="featured-3">
            <p class="h2 pb-2">Вы в хорошей компании</p>
            <p class="pb-4">Популярные люди и бренды используют Tapy в своих маркетинговых стратегиях</p>
        </div>

        <div class="community-items d-flex">
            <a class="community-item d-flex flex-column align-items-center text-black text-decoration-none"
               href="/" target="_blank">
                <div class="community-item-image overflow-hidden">
                    <img class="w-100 h-100" src="{{asset('Images/p1.jpg')}}" alt="">
                </div>
                <div class="d-flex align-items-center pt-3">
                    Pomoshnikov
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#3b82f6"
                         class="bi bi-patch-check-fill ms-2" viewBox="0 0 16 16">
                        <path
                            d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"></path>
                    </svg>
                </div>
            </a>

            <a class="community-item d-flex flex-column align-items-center text-black text-decoration-none"
               href="/" target="_blank">
                <div class="community-item-image overflow-hidden">
                    <img class="w-100 h-100" src="{{asset('Images/p2.jpg')}}" alt="">
                </div>
                <div class="d-flex align-items-center pt-3">
                    K.KRASH
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#3b82f6"
                         class="bi bi-patch-check-fill ms-2" viewBox="0 0 16 16">
                        <path
                            d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"></path>
                    </svg>
                </div>
            </a>

            <a class="community-item d-flex flex-column align-items-center text-black text-decoration-none"
               href="/" target="_blank">
                <div class="community-item-image overflow-hidden">
                    <img class="w-100 h-100" src="{{asset('Images/p3.jpg')}}" alt="">
                </div>
                <div class="d-flex align-items-center pt-3">
                    STRELA
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#3b82f6"
                         class="bi bi-patch-check-fill ms-2" viewBox="0 0 16 16">
                        <path
                            d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"></path>
                    </svg>
                </div>
            </a>

            <a class="community-item d-flex flex-column align-items-center text-black text-decoration-none"
               href="/" target="_blank">
                <div class="community-item-image overflow-hidden">
                    <img class="w-100 h-100" src="{{asset('Images/p4.jpg')}}" alt="">
                </div>
                <div class="d-flex flex-column text-center align-items-center pt-3">
                    <div>
                        «Старая школа»
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#3b82f6"
                             class="bi bi-patch-check-fill ms-2" viewBox="0 0 16 16">
                            <path
                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"></path>
                        </svg>
                    </div>
                    <div class="text-muted mt-2">Подкаст</div>
                </div>
            </a>

            <a class="community-item community-item-plus" href="{{route('login')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg"
                     viewBox="0 0 16 16" style="width: 32px; height: 32px">
                    <path fill-rule="evenodd"
                          d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"></path>
                </svg>
            </a>
        </div>
        <div class="container">
            <div class="d-flex pt-7 flex-column align-items-center justify-content-center py-5">
                <a href="{{route('login')}}" class="btn btn-outline-primary btn-lg">Присоединиться</a>
            </div>
        </div>
    </div>
</main>

<footer class="container pt-10 pb-5">
    <div class="row mb-7">
        <div class="col-sm-12 col-lg-4 col-xl-6 mb-5 mb-lg-0">
            <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                <img height="100px" src="{{asset('logo.svg')}}" alt="">
            </a>
            <div class="row g-2">
                <div class="col-auto">
                    <a href="https://t.me/qcdmet">
                        <img height="32px" src="{{asset('fonts/telegram.svg')}}" alt="" class="rounded-circle">
                    </a>
                </div>
                <div class="col-auto">
                    <a href="https://instagram.com/qcd_barnaul?igshid=YmMyMTA2M2Y=" target="_blank">
                        <img height="32px" src="{{asset('fonts/instagram.svg')}}" alt=""
                             class="rounded-circle">
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4 col-xl-3 mb-4 mb-sm-0">
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="mailto:info@tapy.me" class="nav-link p-0 text-muted d-flex align-items-center gap-2">
                        Обратная связь
                    </a>
                </li>
            </ul>
        </div>

        <div class="col-sm-6 col-lg-4 col-xl-3">
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="/page/privacy?lang=ru" class="nav-link p-0 text-muted">Политика
                        конфиденциальности</a></li>
                <li class="nav-item mb-2"><a href="/page/terms?lang=ru" class="nav-link p-0 text-muted">Пользовательское
                        соглашение</a></li>
            </ul>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <span>© {{ date('Y') }} QCD</span>
        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="/?lang=en" class="nav-link px-2 text-muted">English</a></li>
            <li class="nav-item"><a href="/?lang=ru" class="nav-link px-2 text-muted">Русский</a></li>
        </ul>
    </div>
</footer>
<script async="" src="{{asset('land-assets/script.js')}}"></script>
</body>
</html>
