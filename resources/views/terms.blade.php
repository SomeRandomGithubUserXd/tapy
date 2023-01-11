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
                <li class="nav-item" style="margin-right:<br/> -1.5rem">
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
<main class="overflow-hidden w-100 d-flex justify-content-center">
    <p class="w-50">
        Пользовательское Соглашение
        Настоящее Пользовательское Соглашение (Далее Соглашение) регулирует отношения между владельцем qcd-link.ru (далее QCD или Администрация) с одной стороны и пользователем сайта с другой.
        Сайт QCD не является средством массовой информации.
        <br/>
        <br/>
        Используя сайт, Вы соглашаетесь с условиями данного соглашения.
        Если Вы не согласны с условиями данного соглашения, не используйте сайт QCD!
        <br/>
        <br/>
        Предмет соглашения
        Администрация предоставляет пользователю право на размещение на сайте следующей информации:
        <br/>
        <br/>
        Предмет соглашения
        Администрация предоставляет пользователю право на размещение на сайте следующей информации:
       <br/> - Текстовой информации
       <br/> - Видеоматериалов
       <br/> - Фотоматериалов
       <br/> - Ссылок на материалы, размещенные на других сайтах
        <br/>
        <br/>
        Права и обязанности сторон
        Пользователь имеет право:
       <br/> - осуществлять поиск информации на сайте
       <br/> - получать информацию на сайте
       <br/> - создавать информацию для сайта
       <br/> - распространять информацию на сайте
       <br/> - копировать информацию на другие сайты с разрешения Администрации сайта
       <br/> - копировать информацию на другие сайты с разрешения правообладателя
       <br/> - требовать от администрации скрытия любой информации о пользователе
       <br/> - использовать информацию сайта в личных некоммерческих целях
        <br/>
        <br/>
        Администрация имеет право:
       <br/> - по своему усмотрению и необходимости создавать, изменять, отменять правила
       <br/> - ограничивать доступ к любой информации на сайте
       <br/> - создавать, изменять, удалять информацию
       <br/> - удалять учетные записи
       <br/> - отказывать в регистрации без объяснения причин
        <br/>
        <br/>
        Пользователь обязуется:
       <br/> - обеспечить достоверность предоставляемой информации
       <br/> - обеспечивать сохранность личных данных от доступа третьих лиц
       <br/> - обновлять Персональные данные, предоставленные при регистрации, в случае их изменения
       <br/> - не распространять информацию, которая направлена на пропаганду войны, разжигание национальной, расовой или религиозной ненависти и вражды, а также иной информации, за распространение которой предусмотрена уголовная или административная ответственность
       <br/> - не нарушать работоспособность сайта
       <br/> - не создавать несколько учётных записей на Сайте, если фактически они принадлежат одному и тому же лицу
       <br/> - не совершать действия, направленные на введение других Пользователей в заблуждение
       <br/> - не передавать в пользование свою учетную запись и/или логин и пароль своей учетной записи третьим лицам
       <br/> - не размещать материалы рекламного, эротического, порнографического или оскорбительного характера, а также иную информацию, размещение которой запрещено или противоречит нормам действующего законодательства РФ
       <br/> - не использовать скрипты (программы) для автоматизированного сбора информации и/или взаимодействия с Сайтом и его Сервисами
        <br/>
        <br/>
        Администрация обязуется:
       <br/> - поддерживать работоспособность сайта за исключением случаев, когда это невозможно по независящим от Администрации причинам.
       <br/> - защищать информацию, распространение которой ограничено или запрещено законами путем вынесения предупреждения либо удалением учетной записи пользователя, нарушившего правила
       <br/> - предоставить всю доступную информацию о Пользователе уполномоченным на то органам государственной власти в случаях, установленных законом
        <br/>
        <br/>
        Ответственность сторон
       <br/> - пользователь лично несет полную ответственность за распространяемую им информацию
       <br/> - администрация не несет никакой ответственности за достоверность информации, скопированной из других источников
       <br/> - администрация не несёт ответственность за несовпадение ожидаемых Пользователем и реально полученных услуг
       <br/> - администрация не несет никакой ответственности за услуги, предоставляемые третьими лицами
       <br/> - в случае возникновения форс-мажорной ситуации (боевые действия, чрезвычайное положение, стихийное бедствие и т. д.) Администрация не гарантирует сохранность информации, размещённой Пользователем, а также бесперебойную работу информационного ресурса
        <br/>
        <br/>
        Условия действия Соглашения
        Данное Соглашение вступает в силу при любом использовании данного сайта.
        Соглашение перестает действовать при появлении его новой версии.
        Администрация оставляет за собой право в одностороннем порядке изменять данное соглашение по своему усмотрению.
    </p>
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
