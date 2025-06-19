<!DOCTYPE html>
<html dir="ltr" lang="id" style="overflow-y:hidden;">
    <head>
        <meta charset="UTF-8">
        <title><?= $title ?? 'Developed by Dismas Banar Purnandi' ?></title>
        <meta name="description" content="<?= $description ?? 'Kembangkan Bisnis Anda dengan Aplikasi yang Dirancang Khusus oleh Dismas Banar Purnandi.' ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="<?= $keywords ?? 'padang, upik, wisata, sumatera barat' ?>">
        <meta name="author" content="<?= $author ?? 'Dismas Banar Purnandi' ?>">
        <meta property="og:title" content="<?= $title ?? 'Developed by Dismas Banar Purnandi' ?>">
        <meta property="og:description" content="<?= $description ?? 'Kembangkan Bisnis Anda dengan Aplikasi yang Dirancang Khusus oleh Dismas Banar Purnandi.' ?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?= $url ?? 'https://padangupik.com' ?>">
        <meta property="og:image" content="<?= $image ?? '/favicon/android-icon-192x192.png' ?>">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?= $title ?? 'Developed by Dismas Banar Purnandi' ?>">
        <meta name="twitter:description" content="<?= $description ?? 'Kembangkan Bisnis Anda dengan Aplikasi yang Dirancang Khusus oleh Dismas Banar Purnandi.' ?>">
        <meta name="twitter:image" content="<?= $image ?? '/favicon/android-icon-192x192.png' ?>">
        <link rel="canonical" href="<?= $url ?? 'https://padangupik.com' ?>">
        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
        <link rel="manifest" href="/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="/css/alert.min.css">
        <link rel="stylesheet" href="/css/fontawesome.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <link rel="stylesheet" href="/css/theme.css">

        <!-- Uikit Script -->
        <script src="/js/jquery.min.js"></script>
        <script src="/js/core.min.js"></script>
        <script src="/js/messages.min.js" type="module"></script>
        <script src="/js/uikit.min.js"></script>
        <script src="/js/uikit-icons.min.js"></script>
        <script src="/js/theme.js"></script>
        <script src="/js/newsletter.min.js" defer=""></script>
        <script src="/js/theme-search.js" defer=""></script>
        <!-- Uikit Script End -->

        <?= $this->renderSection('extraScripts') ?>
    </head>
    <body>
        <header class="uk-navbar-container uk-section-defaut">
            <div class="uk-container uk-container-expand">
                <nav uk-navbar>
                    <div class="uk-navbar-left">
                        <?php if ($ismobile) { ?>
                            <a uk-toggle href="#offcanvas" class="uk-navbar-toggle" role="button" aria-label="Open menu">
                                <div uk-navbar-toggle-icon></div>
                            </a>
                        <?php } else { ?>
                            <a class="uk-navbar-item uk-logo" href="/">
                                <img src="/images/logo.svg" loading="eager" width="80" uk-svg />
                            </a>
                        <?php } ?>
                    </div>
                    <?php if ($ismobile) { ?>
                        <div class="uk-navbar-center">
                            <a class="uk-navbar-item uk-logo" href="/">
                                <img src="/images/logo.svg" loading="eager" width="65" uk-svg />
                            </a>
                        </div>
                    <?php } else { ?>
                        <div class="uk-navbar-right">
                            <a href="/logout" class="uk-button uk-button-primary uk-border-rounded">Logout</a>
                        </div>
                    <?php } ?>
                </nav>
            </div>
        </header>
        <main>
            <div class="uk-grid-collapse" uk-grid>
                <?php if (!$ismobile) { ?>
                    <div class="uk-width-1-5">
                        <div class="uk-panel-scrollable" uk-height-viewport="offset-top:true; offset-bottom:#footer;" style="resize:none;">
                            <ul class="uk-nav uk-nav-primary">
                                <li <?=(($uri->getSegment(1) === 'office') && ($uri->getSegment(2) === '') ? 'class="uk-active"' : '')?>>
                                    <a href="/office"><span class="uk-margin-small-right" uk-icon="home"></span> Dashboard</a>
                                </li>
                                <li class="uk-nav-divider"></li>
                                <li <?=(($uri->getSegment(1) === 'office') && ($uri->getSegment(2) === 'banner') ? 'class="uk-active"' : '')?>>
                                    <a href="/office/banner"><span class="uk-margin-small-right" uk-icon="image"></span> Banner</a>
                                </li>
                                <li class="uk-nav-divider"></li>
                                <li <?=(($uri->getSegment(1) === 'office') && ($uri->getSegment(2) === 'category') ? 'class="uk-active"' : '')?>>
                                    <a href="/office/category"><span class="uk-margin-small-right" uk-icon="tag"></span> Kategori Menu</a>
                                </li>
                                <li class="uk-nav-divider"></li>
                                <li <?=(($uri->getSegment(1) === 'office') && ($uri->getSegment(2) === 'product') ? 'class="uk-active"' : '')?>>
                                    <a href="/office/product"><span class="uk-margin-small-right" uk-icon="list"></span> Menu</a>
                                </li>
                                <li class="uk-nav-divider"></li>
                                <li <?=(($uri->getSegment(1) === 'office') && ($uri->getSegment(2) === 'gallery') ? 'class="uk-active"' : '')?>>
                                    <a href="/office/gallery"><span class="uk-margin-small-right" uk-icon="album"></span> Galeri</a>
                                </li>
                                <li class="uk-nav-divider"></li>
                                <li <?=(($uri->getSegment(1) === 'office') && ($uri->getSegment(2) === 'outlet') ? 'class="uk-active"' : '')?>>
                                    <a href="/office/outlet"><span class="uk-margin-small-right" uk-icon="location"></span> Outlet</a>
                                </li>
                                <?php if ($user->inGroup('superadmin')) { ?>
                                    <li class="uk-nav-divider"></li>
                                    <li <?=(($uri->getSegment(1) === 'office') && ($uri->getSegment(2) === 'users') ? 'class="uk-active"' : '')?>>
                                        <a href="/office/users"><span class="uk-margin-small-right" uk-icon="users"></span> Pengguna</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
                <div class="uk-width-1-1 uk-width-4-5@m">
                    <div class="uk-panel-scrollable" uk-height-viewport="offset-top:true; offset-bottom:#footer;" style="resize:none;">
                        <?= $this->renderSection('main') ?>
                    </div>
                </div>
            </div>
        </main>
        <footer id="footer" class="uk-padding-small uk-section-primary">
            <div class="uk-container uk-container-expand">
                <div class="uk-child-width-auto uk-grid-small uk-flex-center uk-flex-between@m" uk-grid>
                    <div class="uk-text-meta uk-text-center uk-text-left@m">
                        <?php
                        function auto_copyright($year = 'auto') {
                            if(intval($year) == 'auto'){ $year = date('Y'); }
                            if(intval($year) == date('Y')){ echo intval($year); }
                            if(intval($year) < date('Y')){ echo intval($year) . ' - ' . date('Y'); }
                            if(intval($year) > date('Y')){ echo date('Y'); }
                        }
                        ?>
                        &copy copyright <?php auto_copyright("2025"); ?>. <span style="color: #fff;">Warung Padang Upik.</span> All rights reserved.
                    </div>
                    <div class="uk-text-meta uk-text-center uk-text-right@m">Developed by <a href="" target="_blank">Dismas Banar Purnandi</a></div>
                </div>
            </div>
        </footer>
        <?php if ($ismobile) { ?>
            <div id="offcanvas" uk-offcanvas="mode: push; overlay: true">
                <div class="uk-offcanvas-bar">
                    <ul class="uk-nav uk-nav-primary">
                        <li <?=(($uri->getSegment(1) === 'office') && ($uri->getSegment(2) === '') ? 'class="uk-active"' : '')?>>
                            <a href="/office"><span class="uk-margin-small-right" uk-icon="home"></span> Dashboard</a>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li <?=(($uri->getSegment(1) === 'office') && ($uri->getSegment(2) === 'banner') ? 'class="uk-active"' : '')?>>
                            <a href="/office/banner"><span class="uk-margin-small-right" uk-icon="image"></span> Banner</a>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li <?=(($uri->getSegment(1) === 'office') && ($uri->getSegment(2) === 'category') ? 'class="uk-active"' : '')?>>
                            <a href="/office/category"><span class="uk-margin-small-right" uk-icon="tag"></span> Kategori Menu</a>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li <?=(($uri->getSegment(1) === 'office') && ($uri->getSegment(2) === 'product') ? 'class="uk-active"' : '')?>>
                            <a href="/office/product"><span class="uk-margin-small-right" uk-icon="list"></span> Menu</a>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li <?=(($uri->getSegment(1) === 'office') && ($uri->getSegment(2) === 'gallery') ? 'class="uk-active"' : '')?>>
                            <a href="/office/gallery"><span class="uk-margin-small-right" uk-icon="album"></span> Galeri</a>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li <?=(($uri->getSegment(1) === 'office') && ($uri->getSegment(2) === 'outlet') ? 'class="uk-active"' : '')?>>
                            <a href="/office/outlet"><span class="uk-margin-small-right" uk-icon="location"></span> Outlet</a>
                        </li>
                        <?php if ($user->inGroup('superadmin')) { ?>
                            <li class="uk-nav-divider"></li>
                            <li <?=(($uri->getSegment(1) === 'office') && ($uri->getSegment(2) === 'users') ? 'class="uk-active"' : '')?>>
                                <a href="/office/users"><span class="uk-margin-small-right" uk-icon="users"></span> Pengguna</a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="uk-margin-large uk-text-center">
                        <a href="/logout" class="uk-button uk-button-default">Logout</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </body>
</html>