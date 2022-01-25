<!doctype html>
<html lang="en" class="sc-login-page">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Bikin.co Backoffice</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/fav/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/fav/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/fav/favicon-16x16.png')}}">
    <link rel="mask-icon" href="{{ asset('img/fav/safari-pinned-tab.svg')}}" color="#5bbad5">

    <link rel="manifest" href="{{ asset('manifest.json')}}">
    <meta name="theme-color" content="#607D8B">

    <style>
        .appLoading {
            background: #bdbdbd
        }

        .appLoading body {
            visibility: hidden;
            overflow: hidden;
            max-height: 100%;
        }

    </style>
    <script>
        var html = document.getElementsByTagName('html')[0];
        html.className += ' appLoading';

    </script>

    <!-- UIkit js -->
    <script src="{{ asset('js/uikit.min.js')}}"></script>
</head>

<body>

    @yield('content')

    <!-- async assets-->
    <script src="{{ asset('js/vendor/loadjs.min.js')}}"></script>
    <script>
        var html = document.getElementsByTagName('html')[0];
        // ----------- CSS
        loadjs(['{{ asset('node_modules/uikit/dist/css/uikit.min.css')}}', '{{ asset('css/login_page.min.css')}}'], {
            success: function () {
                // add id to main stylesheet
                var mainCSS = document.querySelectorAll("link[href='{{ asset('css/login_page.min.css')}}']");
                mainCSS[0].setAttribute('id', 'main-stylesheet');
                // show page
                setTimeout(function () {
                    html.className = html.className.replace(/(?:^|\s)appLoading(?!\S)/g, '');
                }, 100);
                // mdi icons CSS
                loadjs('{{ asset('css/materialdesignicons.min.css')}}', {
                    before: function (path, scriptEl) {
                        if (/(^css!|\.css$)/.test(path)) {
                            document.head.insertBefore(scriptEl, mainCSS[0])
                        }
                        return false;
                    }
                });
            },
            async: false
        });
        // mdi icons (base64) & google fonts (base64)
        loadjs(['{{ asset('css/fonts/mdi_fonts.css')}}', '{{ asset('css/fonts/roboto_base64.css')}}']);
        // vendor
        loadjs('{{ asset('js/vendor.min.js')}}', {
            success: function () {
                // scutum common functions/helpers
                loadjs('{{ asset('js/scutum_common.min.js')}}', {
                    success: function () {
                        scutum.init();
                    }
                });
            }
        });

    </script>

</body>

</html>
