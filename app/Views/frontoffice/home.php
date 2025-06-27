<?= $this->extend('frontoffice/layout') ?>

<?= $this->section('main') ?>
<!-- Slideshow -->
<?php if ($ismobile == true) {
    $padding = 'padding-top: 0px;';
} else {
    $padding = 'padding-top: 100px;';
} ?>
<div class="uk-section-default uk-section uk-padding-remove-bottom" style="<?=$padding?>">
    <div class="uk-container uk-container-expand uk-padding-remove-horizontal">
        <div uk-slideshow="ratio: 3:1; animation: push; autoplay: true; autoplay-interval: 3000">
            <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">
                <div class="uk-slideshow-items">
                    <?php
                    $i = 1;
                    foreach ($banners as $banner) { ?>
                        <div>
                            <img src="images/banner/<?=esc($banner['image'])?>" alt="Banner <?=$i++?>" uk-cover>
                        </div>
                    <?php } ?>
                </div>
                <!-- <a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slideshow-item="next"></a> -->
            </div>
            <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin"></ul>
        </div>
    </div>
</div>
<!-- Slideshow End -->

<!-- Featured Menu -->
<div class="uk-section-default uk-section uk-section-small">
    <div class="uk-container uk-container-large">
        <div class="uk-child-width-1-2 uk-flex uk-flex-middle" uk-grid uk-scrollspy="target: > .uk-margin; cls: uk-animation-slide-left; delay: 500;">
            <div class="uk-margin">
                <h2 class="uk-heading-bullet uk-margin-medium">Menu Unggulan</h2>
            </div>
            <div class="uk-margin uk-text-right">
                <a href="<?= site_url('menu') ?>">Lihat Semua <i uk-icon="chevron-right"></i></a>
            </div>
        </div>
        <div class="uk-child-width-1-2 uk-child-width-1-3@m uk-child-width-1-4@l uk-grid-match uk-grid-margin" uk-grid uk-height-match="target: > div" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 500; repeat: true;">
            <?php foreach ($newproducts as $newprod) { ?>
                <div>
                    <div class="uk-card uk-card-default uk-card-hover uk-margin uk-overflow-hidden uk-border-rounded" style="border-radius: 25px;">
                        <div class="uk-card-media-top uk-inline-clip uk-transition-toggle">
                            <img src="images/menu/<?= $newprod['image'] ?>" alt="<?= $newprod['name'] ?>" class="uk-transition-scale-up uk-transition-opaque" style="border-radius: 25px; object-fit: cover;">
                        </div>
                    </div>
                    <div>
                        <h3 class="uk-text-center"><?= $newprod['name'] ?></h3>
                    </div>
                    <div class="uk-text-center">
                        <h4 class="uk-text-primary">#NEW</h4>
                    </div>
                    <!-- </?php if ($newprod['favorite']) { ?>
                        <div class="uk-text-center">
                            <h4 class="uk-text-primary">#FAVORITE</h4>
                        </div>
                    </?php } ?> -->
                </div>
            <?php } ?>
            <?php foreach ($favproducts as $favprod) { ?>
                <div>
                    <div class="uk-card uk-card-default uk-card-hover uk-margin uk-overflow-hidden uk-border-rounded" style="border-radius: 25px;">
                        <div class="uk-card-media-top uk-inline-clip uk-transition-toggle">
                            <img src="images/menu/<?= $favprod['image'] ?>" alt="<?= $favprod['name'] ?>" class="uk-transition-scale-up uk-transition-opaque" style="border-radius: 25px; object-fit: cover;">
                        </div>
                    </div>
                    <div>
                        <h3 class="uk-text-center"><?= $favprod['name'] ?></h3>
                    </div>
                    <div class="uk-text-center">
                        <h4 class="uk-text-primary">#FAVORITE</h4>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Featured Menu -->

<!-- About Us -->
<div class="uk-section uk-section-secondary uk-section-small" style="background-image: url('images/hero-bg-2.svg'); background-size: cover; background-position: center;">
    <div class="uk-container uk-container-large">
        <div class="uk-child-width-1-1 uk-child-width-1-2@m uk-flex uk-flex-middle" uk-grid uk-scrollspy="target: > div; cls: uk-animation-slide-right; delay: 300; repeat: false;">
            <div>
                <h2 class="uk-text-bolder" style="color: #e92629 !important;">Sekilas</br>Tentang Kami</h2>
                <p class="uk-text-lead uk-text-justify" style="color: #fff;">Warung Padang UPIK hadir dengan 9 cabang. 4 cabang di Balikpapan, 4 cabang di Samarinda dan 1 cabang di Yogyakarta. Tidak hanya berhenti disini, berbekal 20 tahun pengalaman di bidang kuliner masakan Padang, Warung Padang UPIK masih akan terus mengembangkan diri  untuk memberikan pelayanan masakan terbaik kepada konsumen di seluruh Indonesia.</p>
                <a href="outlet" class="uk-button uk-button-primary uk-border-rounded uk-margin-top">Selengkapnya <i uk-icon="chevron-right"></i></a>
            </div>
            <div class="uk-flex-first uk-flex-last@m">
                <img src="images/outlet/sc-hero-2.png" alt="Warung Padang UPIK" class="uk-box-shadow-medium" style="width: 100%; height: auto; border-radius: 25px;">
            </div>
        </div>
    </div>
</div>
<!-- About Us End -->

<!-- Featured Outlet -->
<div class="uk-section-default uk-section uk-section-small">
    <div class="uk-container uk-container-large">
        <div class="uk-child-width-1-2 uk-flex uk-flex-middle" uk-grid uk-scrollspy="target: > .uk-margin; cls: uk-animation-slide-left; delay: 500;">
            <div class="uk-margin">
                <h2 class="uk-heading-bullet uk-margin-medium">Temukan Kami</h2>
            </div>
            <div class="uk-margin uk-text-right">
                <a href="<?= site_url('outlet') ?>">Lihat Semua <i uk-icon="chevron-right"></i></a>
            </div>
        </div>
        <div class="uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@l uk-grid-match uk-grid-margin uk-flex uk-flex-center@s" uk-grid uk-height-match="target: > div > .uk-card > .uk-card-media-top" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 500; repeat: false;">
            <div>
                <div class="uk-card uk-card-default uk-margin" style="border-radius: 25px">
                    <div class="uk-card-media-top">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6782979530653!2d117.13348387585422!3d-0.4800219352782299!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f21b4ba263b%3A0x59130b4967f0ed8a!2sWarung%20Padang%20UPIK!5e0!3m2!1sen!2sid!4v1749110972976!5m2!1sen!2sid" class="uk-width-1-1" width="600" height="450" style="border-radius: 25px 25px 0 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-text-center uk-margin-remove">Warung Padang UPIK</h3>
                        <h3 class="uk-text-center uk-margin-remove" style="color: #e92629 !important;">Juanda</h3>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-margin" style="border-radius: 25px">
                    <div class="uk-card-media-top">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.842411821728!2d116.85518607585837!3d-1.2672855356074946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df146e8c3cfece3%3A0x59b645c61597a352!2sWarung%20Padang%20%22UPIK%22%20MT%20Haryono!5e0!3m2!1sen!2sid!4v1749111593486!5m2!1sen!2sid" class="uk-width-1-1" width="600" height="450" style="border-radius: 25px 25px 0 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-text-center uk-margin-remove">Warung Padang UPIK</h3>
                        <h3 class="uk-text-center uk-margin-remove" style="color: #e92629 !important;">MT Haryono</h3>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-margin" style="border-radius: 25px">
                    <div class="uk-card-media-top">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.3244620646733!2d110.3595747759167!3d-7.755370476905453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59c3e5c1f42f%3A0xfe439ce988be4ae5!2sWarung%20Padang%20Upik!5e0!3m2!1sen!2sid!4v1749111709885!5m2!1sen!2sid" class="uk-width-1-1" width="600" height="450" style="border-radius: 25px 25px 0 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="uk-card-body">
                        <h3 class="uk-text-center uk-margin-remove">Warung Padang UPIK</h3>
                        <h3 class="uk-text-center uk-margin-remove" style="color: #e92629 !important;">Jamal</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Featured Outlet End -->
<?= $this->endSection() ?>