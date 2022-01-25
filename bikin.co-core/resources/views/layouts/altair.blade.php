<!doctype html>
<html lang="en">
<head>

 <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>
    <meta name="_token" content="{{csrf_token()}}" />

    <link rel="icon" type="image/png" href="{{ asset('assets_altair/img/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('assets_altair/img/favicon-32x32.png') }}" sizes="32x32">

    <title>Bikin.Co</title>


    <!-- uikit -->
    <link rel="stylesheet" href="{{ asset('bower_components/uikit/css/uikit.almost-flat.min.css') }}" media="all">
    <!-- flag icons -->
    <link rel="stylesheet" href="{{ asset('assets_altair/icons/flags/flags.min.css')}}" media="all">

    <!-- style switcher -->
    <link rel="stylesheet" href="{{ asset('assets_altair/css/style_switcher.min.css') }}" media="all">
    
    <!-- altair admin -->
    <link rel="stylesheet" href="{{ asset('assets_altair/css/main.min.css') }}" media="all">

    <!-- themes -->
    <link rel="stylesheet" href="{{ asset('assets_altair/css/themes/themes_combined.min.css') }}" media="all">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    


    @stack('css-dropify')
    @stack('plugin-sweetalert')

</head>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe uk-height-1-1">

@php
    $vendorRoles = \DB::table('vendors')->where('id',Auth::guard('vendor')->user()->id)->get();
    $role = count($vendorRoles);
@endphp


<!-- async asset-->

    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">
                                
                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>
                
                <!-- secondary sidebar switch -->
                <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                    <span class="sSwitchIcon"></span>
                </a>
          
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_image"><img class="md-user-image" src="{{ asset('assets_altair/img/avatars/avatar_11_tn.png') }}" alt=""/></a>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="page_user_profile.html">Profil</a></li>
                                    <li><a href="{{ route('logout.vendor') }}">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header><!-- main header end -->
    <!-- main sidebar -->
    <aside id="sidebar_main">
        
        <div class="sidebar_main_header">
            <div class="sidebar_logo">
                <a href="index.html" class="sSidebar_hide sidebar_logo_large">
                    <img class="logo_regular" src="{{ asset('assets_altair/img/logo_main.png') }}" alt="" height="15" width="71"/>
                    <img class="logo_light" src="{{ asset('assets_altair/img/logo_main_white.png') }}" alt="" height="15" width="71"/>
                </a>
                <a href="index.html" class="sSidebar_show sidebar_logo_small">
                    <img class="logo_regular" src="{{ asset('assets_altair/img/logo_main_small.png') }}" alt="" height="32" width="32"/>
                    <img class="logo_light" src="{{ asset('assets_altair/img/logo_main_small_light.png') }}" alt="" height="32" width="32"/>
                </a>
            </div>
        </div>
        
        <div class="menu_section">
            <ul>
                <li title="Beranda">
                    <a href="../so-beranda.html">
                        <span class="menu_icon"><i class="material-icons">home</i></span>
                        <span class="menu_title">Beranda</span>
                    </a>
                </li>
             
                @if ($role > 0)
                 <li class="{{ request()->is('order_masuk/vendor*') || request()->is('order_proses/vendor*') || request()->is('order_pelunasan/vendor*') || request()->is('order_selesai/vendor*') || request()->is('order/complain/vendor*') || request()->is('order/selesai/vendor/produksi*') == true ? 'submenu_trigger current_section act_section' : '' }}" title="Product">
                        <a href="#">
                            <span class="uk-nav-icon"><i class="mdi mdi-basket"></i></span>
                            <span class="uk-nav-title">Order Produk</span>
                        </a>
                        <ul class="sc-sidebar-menu-sub" style="display: none;">
                            <li class="{{ request()->is('order_masuk/vendor*') ? 'act_item' : '' }}">
                                <a href="{{ route('vendor.order_masuk.index')}}">Order Masuk<div id="order_masuk_vendor"></div></a>
                            </li>
                            <li class="{{ request()->is('order_proses/vendor*') ? 'act_item' : '' }}">
                                <a href="{{ route('vendor.order_proses.index') }}">Diproses<div id="jumlah_vendor_order_proses"></div></a>
                            </li>
                            <li class="{{ request()->is('order/selesai/vendor/produksi*') ? 'act_item' : '' }}">
                                <a href="{{ route('vendor.selesai_produksi.index') }}">Selesai Produksi<div id="jumlah_vendor_selesai_produksi"></div></a>
                            </li>
                            <li class="{{ request()->is('order_pelunasan/vendor*') ? 'act_item' : '' }}">
                                <a href="{{ route('vendor.order_pelunasan.index')}}">Pelunasan<div id="jumlah_vendor_konfirmasi_pelunasan"></div></a>
                            </li>

                            <li class="{{ request()->is('order_selesai/vendor*') ? 'act_item' : '' }}">
                                <a href="{{ route('vendor.order_selesai.index') }}">Order Selesai<div id="jumlah_vendor_order_selesai"></div></a>
                            </li>
                            <li class="{{ request()->is('order/complain/vendor*') ? 'act_item' : '' }}">
                                <a href="{{ route('complain_vendor.index') }}">Dalam Komplain<div id="jumlah_complain_vendor"></div></a>
                            </li>
                        </ul>
                    </li>
                @endif
              
            </ul>
        </div>
    </aside><!-- main sidebar end -->
    @yield('content')

    @include('sweetalert::alert')
     <!-- google web fonts -->
    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
    <!-- common functions -->
    <script src="{{ asset('assets_altair/js/common.min.js')}}"></script>
    <!-- uikit functions -->
    <script src="{{ asset('assets_altair/js/uikit_custom.min.js') }}"></script>
    <!-- altair common functions/helpers -->
    <script src="{{ asset('assets_altair/js/altair_admin_common.min.js') }}"></script>

     <!-- page specific plugins -->
    <!-- dragula.js -->
    <script src="{{ asset('bower_components/dragula.js/dist/dragula.min.js') }}"></script>

    <!--  scrum board functions -->
    <script src="{{ asset('assets_altair/js/pages/page_scrum_board.min.js') }}"></script>
    

     <!-- page specific plugins -->
    <!-- datatables -->
    <script src="{{ asset('bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <!-- datatables buttons-->
    <script src="{{ asset('bower_components/datatables-buttons/js/dataTables.buttons.js') }}"></script>
    <!-- <script src="{{ asset('assets_altair/js/custom/datatables/buttons.uikit.js') }}"></script> -->
    <script src="{{ asset('bower_components/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('bower_components/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('bower_components/pdfmake/build/vfs_fonts.js') }}"></script>
    <!-- <script src="{{ asset('bower_components/datatables-buttons/js/buttons.colVis.js') }}"></script> -->
    <script src="{{ asset('bower_components/datatables-buttons/js/buttons.html5.js') }}"></script>
    <script src="{{ asset('bower_components/datatables-buttons/js/buttons.print.js') }}"></script>
    
    <!-- datatables custom integration -->
    <script src="{{ asset('assets_altair/js/custom/datatables/datatables.uikit.min.js') }}"></script>

    <!--  datatables functions -->
    <script src="{{ asset('assets_altair/js/pages/plugins_datatables.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    <script>
        $(function() {
            if(isHighDensity()) {
                $.getScript( "asset('assets_altair//js/custom/dense.min.js')", function(data) {
                    // enable hires images
                    altair_helpers.retina_images();
                });
            }
            if(Modernizr.touch) {
                // fastClick (touch devices)
                FastClick.attach(document.body);
            }
        });
        $window.load(function() {
            // ie fixes
            altair_helpers.ie_fix();
        });
    </script>

        <div id="style_switcher">
        <div id="style_switcher_toggle"><i class="material-icons">&#xE8B8;</i></div>
        <div class="uk-margin-medium-bottom">
            <h4 class="heading_c uk-margin-bottom">Colors</h4>
            <ul class="switcher_app_themes" id="theme_switcher">
                <li class="app_style_default active_theme" data-app-theme="">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_a" data-app-theme="app_theme_a">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_b" data-app-theme="app_theme_b">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_c" data-app-theme="app_theme_c">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_d" data-app-theme="app_theme_d">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_e" data-app-theme="app_theme_e">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_f" data-app-theme="app_theme_f">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_g" data-app-theme="app_theme_g">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_h" data-app-theme="app_theme_h">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_i" data-app-theme="app_theme_i">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
                <li class="switcher_theme_dark" data-app-theme="app_theme_dark">
                    <span class="app_color_main"></span>
                    <span class="app_color_accent"></span>
                </li>
            </ul>
        </div>
        <div class="uk-visible-large uk-margin-medium-bottom">
            <h4 class="heading_c">Sidebar</h4>
            <p>
                <input type="checkbox" name="style_sidebar_mini" id="style_sidebar_mini" data-md-icheck />
                <label for="style_sidebar_mini" class="inline-label">Mini Sidebar</label>
            </p>
            <p>
                <input type="checkbox" name="style_sidebar_slim" id="style_sidebar_slim" data-md-icheck />
                <label for="style_sidebar_slim" class="inline-label">Slim Sidebar</label>
            </p>
        </div>
        <div class="uk-visible-large uk-margin-medium-bottom">
            <h4 class="heading_c">Layout</h4>
            <p>
                <input type="checkbox" name="style_layout_boxed" id="style_layout_boxed" data-md-icheck />
                <label for="style_layout_boxed" class="inline-label">Boxed layout</label>
            </p>
        </div>
        <div class="uk-visible-large">
            <h4 class="heading_c">Main menu accordion</h4>
            <p>
                <input type="checkbox" name="accordion_mode_main_menu" id="accordion_mode_main_menu" data-md-icheck />
                <label for="accordion_mode_main_menu" class="inline-label">Accordion mode</label>
            </p>
        </div>
    </div>

    <script>
        $(function() {
            var $switcher = $('#style_switcher'),
                $switcher_toggle = $('#style_switcher_toggle'),
                $theme_switcher = $('#theme_switcher'),
                $mini_sidebar_toggle = $('#style_sidebar_mini'),
                $slim_sidebar_toggle = $('#style_sidebar_slim'),
                $boxed_layout_toggle = $('#style_layout_boxed'),
                $accordion_mode_toggle = $('#accordion_mode_main_menu'),
                $html = $('html'),
                $body = $('body');


            $switcher_toggle.click(function(e) {
                e.preventDefault();
                $switcher.toggleClass('switcher_active');
            });

            $theme_switcher.children('li').click(function(e) {
                e.preventDefault();
                var $this = $(this),
                    this_theme = $this.attr('data-app-theme');

                $theme_switcher.children('li').removeClass('active_theme');
                $(this).addClass('active_theme');
                $html
                    .removeClass('app_theme_a app_theme_b app_theme_c app_theme_d app_theme_e app_theme_f app_theme_g app_theme_h app_theme_i app_theme_dark')
                    .addClass(this_theme);

                if(this_theme == '') {
                    localStorage.removeItem('altair_theme');
                    $('#kendoCSS').attr('href','asset("bower_components/kendo-ui/styles/kendo.material.min.css")');
                } else {
                    localStorage.setItem("altair_theme", this_theme);
                    if(this_theme == 'app_theme_dark') {
                        $('#kendoCSS').attr('href','asset("bower_components/kendo-ui/styles/kendo.materialblack.min.css")');
                    } else {
                        $('#kendoCSS').attr('href','asset("bower_components/kendo-ui/styles/kendo.material.min.css")');
                    }
                }

            });

            // hide style switcher
            $document.on('click keyup', function(e) {
                if( $switcher.hasClass('switcher_active') ) {
                    if (
                        ( !$(e.target).closest($switcher).length )
                        || ( e.keyCode == 27 )
                    ) {
                        $switcher.removeClass('switcher_active');
                    }
                }
            });

            // get theme from local storage
            if(localStorage.getItem("altair_theme") !== null) {
                $theme_switcher.children('li[data-app-theme='+localStorage.getItem("altair_theme")+']').click();
            }


        // toggle mini sidebar

            // change input's state to checked if mini sidebar is active
            if((localStorage.getItem("altair_sidebar_mini") !== null && localStorage.getItem("altair_sidebar_mini") == '1') || $body.hasClass('sidebar_mini')) {
                $mini_sidebar_toggle.iCheck('check');
            }

            $mini_sidebar_toggle
                .on('ifChecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.setItem("altair_sidebar_mini", '1');
                    localStorage.removeItem('altair_sidebar_slim');
                    location.reload(true);
                })
                .on('ifUnchecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.removeItem('altair_sidebar_mini');
                    location.reload(true);
                });

        // toggle slim sidebar

            // change input's state to checked if mini sidebar is active
            if((localStorage.getItem("altair_sidebar_slim") !== null && localStorage.getItem("altair_sidebar_slim") == '1') || $body.hasClass('sidebar_slim')) {
                $slim_sidebar_toggle.iCheck('check');
            }

            $slim_sidebar_toggle
                .on('ifChecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.setItem("altair_sidebar_slim", '1');
                    localStorage.removeItem('altair_sidebar_mini');
                    location.reload(true);
                })
                .on('ifUnchecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.removeItem('altair_sidebar_slim');
                    location.reload(true);
                });

        // toggle boxed layout

            if((localStorage.getItem("altair_layout") !== null && localStorage.getItem("altair_layout") == 'boxed') || $body.hasClass('boxed_layout')) {
                $boxed_layout_toggle.iCheck('check');
                $body.addClass('boxed_layout');
                $(window).resize();
            }

            $boxed_layout_toggle
                .on('ifChecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.setItem("altair_layout", 'boxed');
                    location.reload(true);
                })
                .on('ifUnchecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.removeItem('altair_layout');
                    location.reload(true);
                });

        // main menu accordion mode
            if($sidebar_main.hasClass('accordion_mode')) {
                $accordion_mode_toggle.iCheck('check');
            }

            $accordion_mode_toggle
                .on('ifChecked', function(){
                    $sidebar_main.addClass('accordion_mode');
                })
                .on('ifUnchecked', function(){
                    $sidebar_main.removeClass('accordion_mode');
                });


        });
    </script>




@include('jquery.count')


@stack('dropify')

@stack('scripts')


</body>


</html>

