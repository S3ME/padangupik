<!DOCTYPE html>
<html lang="id">
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
    <!-- Header Section -->
        <?php if ($ismobile) { ?>
            <header class="tm-header-mobile" uk-header uk-inverse="target: .uk-navbar-container; sel-active: .uk-navbar-transparent" style="background-color: #fff; box-shadow: 0 0 100px rgba(0, 0, 0, 0.1);">
                <div uk-sticy show-on-up animation="uk-animation-slide-top" cls-active="uk-navbar-sticky" sel-target=".uk-navbar-container" cls-inactive="uk-navbar-transparent" tm-section-start>
                    <div class="uk-navbar-container uk-navbar-transparent uk-dark">
                        <div class="uk-container uk-container-expand">
                            <nav uk-navbar="{'align':'center','container':'.tm-header-mobile > [uk-sticky]','boundary':'.tm-header-mobile .uk-navbar-container','target-x':'.tm-header-mobile .uk-navbar','target-y':'.tm-header-mobile .uk-navbar-container','dropbar':true,'dropbar-anchor':'.tm-header-mobile .uk-navbar-container','dropbar-transparent-mode':'remove'}">
                                <div class="uk-navbar-left">
                                    <a href="<?= base_url(); ?>" aria-label="Back to home" class="uk-logo uk-navbar-item">
                                        <img alt="Warung Padang Upik" loading="eager" width="65" src="/images/logo.svg" uk-svg />
                                    </a>
                                </div>
                                <div class="uk-navbar-right">
                                    <a uk-toggle href="#offcanvas" class="uk-navbar-toggle" role="button" aria-label="Open menu">
                                        <div uk-navbar-toggle-icon></div>
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <?= $this->renderSection('extraNav') ?>
            </header>
            <div id="offcanvas" class="uk-modal-full" uk-modal>
                <div class="uk-modal-dialog uk-flex" role="dialog">
                    <button class="uk-modal-close-default" uk-close uk-toggle="cls: uk-modal-close-full uk-close-large uk-modal-close-default; mode: media; media: @s" aria-label="Close"></button>
                    <div class="uk-modal-body uk-margin-auto uk-flex uk-flex-column uk-box-sizing-content uk-width-auto@s" uk-height-viewport uk-toggle="{'cls':'uk-padding-large','mode':'media','media':'@s'}">
                        <div class="uk-child-width-1-1" uk-grid>
                            <div>
                                <div class="uk-panel uk-flex-center uk-text-center">
                                    <a href="<?=base_url();?>" aria-label="Back to home" class="uk-logo">
                                        <img alt="Warung Padang Upik" loading="eager" width="65" src="/images/logo.svg" uk-svg />
                                    </a>
                                </div>
                            </div>
                            <div>
                                <div class="uk-panel">
                                    <ul class="uk-nav uk-nav-primary uk-nav">
                                        <li <?=($uri->getSegment(1) === 'product' ? 'class="uk-active"' : '')?>>
                                            <a href="/product" class="el-link uk-margin-remove-last-child">Menu</a>
                                        </li>
                                        <li <?=($uri->getSegment(1) === 'gallery' ? 'class="uk-active"' : '')?>>
                                            <a href="/gallery" class="el-link uk-margin-remove-last-child">Galeri</a>
                                        </li>
                                        <li <?=($uri->getSegment(1) === 'outlet' ? 'class="uk-active"' : '')?>>
                                            <a href="/outlet" class="el-link uk-margin-remove-last-child">Lokasi</a>
                                        </li>
                                        <li <?=($uri->getSegment(1) === 'about' ? 'class="uk-active"' : '')?>>
                                            <a href="/about" class="el-link uk-margin-remove-last-child">Tentang Kami</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <header class="tm-header tm-header-overlay" uk-header uk-inverse="target: .uk-navbar-container, .tm-headerbar; sel-active: .uk-navbar-transparent, .tm-headerbar" style="background-color: #fff; box-shadow: 0 0 100px rgba(0, 0, 0, 0.1);">
                <div uk-sticky show-on-up animation="uk-animation-slide-top" cls-active="uk-navbar-sticky" sel-target=".uk-navbar-container" cls-inactive="uk-navbar-transparent" tm-section-start>
                    <div class="uk-navbar-container">
                        <div class="uk-container uk-container-expand">
                            <nav uk-navbar="{'align':'center','container':'.tm-header > [uk-sticky]','boundary':'.tm-header .uk-navbar-container','target-x':'.tm-header .uk-navbar','target-y':'.tm-header .uk-navbar-container','dropbar':true,'dropbar-anchor':'.tm-header .uk-navbar-container','dropbar-transparent-mode':'remove'}">
                                <div class="uk-navbar-left">
                                    <a href="<?=base_url()?>" class="uk-logo uk-navbar-item">
                                        <img alt="Warung Padang Upik" loading="eager" width="80" src="/images/logo.svg" uk-svg />
                                    </a>
                                </div>
                                <div class="uk-navbar-right">
                                    <ul class="uk-navbar-nav">
                                        <li <?=($uri->getSegment(1) === 'product' ? 'class="uk-active"' : '')?>><a href="/product">Menu</a></li>
                                        <li <?=($uri->getSegment(1) === 'gallery' ? 'class="uk-active"' : '')?>><a href="/gallery">Galeri</a></li>
                                        <li <?=($uri->getSegment(1) === 'outlet' ? 'class="uk-active"' : '')?>><a href="/outlet">Lokasi</a></li>
                                        <li <?=($uri->getSegment(1) === 'about' ? 'class="uk-active"' : '')?>><a href="/about">Tentang Kami</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <?= $this->renderSection('extraNav') ?>
            </header>
        <?php } ?>
    <!-- Header Section End -->

    <!-- Main Section -->
    <main>
        <?= $this->renderSection('main') ?>
    </main>
    <!-- Main Section End -->

    <!-- Footer Section -->
    <footer>
        <div class="uk-section-default uk-section uk-section-large uk-padding-remove-bottom">
            <div class="uk-container uk-container-medium">
                <div class="tm-grid-expand uk-grid-row-large uk-grid-margin-large uk-grid-divider" uk-grid>
                    <div class="uk-width-1-1 uk-width-1-3@m uk-text-center">
                        <a href="<?=base_url()?>"><img src="/images/logo.svg" alt="Warung Padang Upik" uk-svg style="width: 250px;" /></a>
                    </div>
                    <div class="uk-width-1-1 uk-width-1-3@m">
                        <h3 class="uk-h5 uk-text-left@m uk-text-center">Halaman</h3>
                        <ul class="uk-list uk-text-left@m uk-text-center">
                            <li><a class="el-link uk-link-muted uk-margin-remove-last-child" href="/product">Menu</a></li>
                            <li><a class="el-link uk-link-muted uk-margin-remove-last-child" href="/gallery">Galeri</a></li>
                            <li><a class="el-link uk-link-muted uk-margin-remove-last-child" href="/outlet">Lokasi</a></li>
                            <li><a class="el-link uk-link-muted uk-margin-remove-last-child" href="/about">Tentang Kami</a></li>
                        </ul>
                    </div>
                    <div class="uk-width-1-1 uk-width-1-3@m">
                        <h3 class="uk-h5 uk-text-left@m uk-text-center">Kontak</h3>
                        <ul class="uk-list uk-text-left@m uk-text-center">
                            <!--<li><a class="el-link uk-link-muted uk-margin-remove-last-child" href="tel:02742850755" target="_blank"><i uk-icon="receiver"></i> 0274-xxxxx</a></li>-->
                            <li><a class="el-link uk-link-muted uk-margin-remove-last-child" href="https://wa.me/+628115479292" target="_blank"><i uk-icon="whatsapp"></i> 08115479292</a></li>
                            <li><a class="el-link uk-link-muted uk-margin-remove-last-child uk-text-small" href="mailto:warungpadangupikmarekting@gmail.com" target="_blank"><i uk-icon="mail"></i> warungpadangupikmarekting@gmail.com</a></li>
                            <li><a class="el-link uk-link-muted uk-margin-remove-last-child" href="https://www.facebook.com/Warungpadangupik/?_rdc=1&_rdr#" target="_blank"><i uk-icon="facebook"></i> Warung Padang UPIK </a></li>
                            <li><a class="el-link uk-link-muted uk-margin-remove-last-child" href="https://www.instagram.com/padangupik_id" target="_blank"><i uk-icon="instagram"></i> padangupik_id</a></li>
                        </ul>
                    </div>
                </div>
                <div class="uk-grid tm-grid-expand uk-child-width-1-1">
                    <div class="uk-width-1-1@m">
                        <hr/>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-section-default uk-section uk-section-small">
            <div class="uk-container uk-container-xlarge">
                <div class="uk-width-1-1 uk-text-center uk-text-meta">
                    <?php
                    function auto_copyright($year = 'auto') {
                        if(intval($year) == 'auto'){ $year = date('Y'); }
                        if(intval($year) == date('Y')){ echo intval($year); }
                        if(intval($year) < date('Y')){ echo intval($year) . ' - ' . date('Y'); }
                        if(intval($year) > date('Y')){ echo date('Y'); }
                    }
                    ?>
                    &copy copyright <?php auto_copyright("2025"); ?>. PT Selera Nusantara Abadi
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Totop -->
    <div class="uk-position-fixed uk-position-bottom-right uk-position-large">
        <div class="uk-child-width-1-1 uk-grid-small" uk-grid>
            <div class="uk-panel uk-text-right">
                <a id="totop-btn" href="#" class="uk-button-primary uk-icon-button" uk-icon="chevron-up" uk-scroll style="display:none;"></a>
            </div>
            <div class="uk-panel uk-text-right">
                <a class="uk-button uk-button-primary uk-visible@m" href="https://wa.me/+628115479292" target="_blank" style="border-radius: 50px; padding: 10px 20px;">
                    <i uk-icon="whatsapp"></i> Butuh Bantuan?
                </a>
                <a class="uk-icon-button uk-hidden@m uk-button-primary" href="https://wa.me/+628115479292" target="_blank" uk-icon="whatsapp"></a>
            </div>
        </div>
    </div>
    <script>
        // Show/hide ToTop button on scroll
        window.addEventListener('scroll', function() {
            var btn = document.getElementById('totop-btn');
            if (window.scrollY > 100) {
                btn.style.display = '';
            } else {
                btn.style.display = 'none';
            }
        });
    </script>
    <!-- Totop End -->
</body>
</html>