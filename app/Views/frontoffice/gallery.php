<?= $this->extend('frontoffice/layout') ?>

<?= $this->section('main') ?>
<!-- Padding Top -->
<div class="uk-visible@m" style="padding-top: 100px;"></div>
<!-- Padding Top End -->

<!-- Content -->
<div class="uk-section-default uk-section uk-padding-remove-bottom" style="background-image: url('images/hero-bg-2.svg'); background-size: cover; background-position: center;">
    <div class="uk-container uk-container-large uk-padding-remove-horizontal">
        <!-- Logo -->
        <h1 class="uk-text-primary uk-position-relative uk-text-center" uk-scrollspy="target: > img; cls: uk-animation-fade; delay: 300; repeat: false;">
            Galeri Foto<br/>Warung Padang UPIK
        </h1>
        <div class="uk-text-center uk-margin-bottom" uk-scrollspy="target: > img; cls: uk-animation-fade; delay: 300; repeat: false;">
            <img src="<?= base_url('images/logo.svg') ?>" alt="Logo Warung Padang UPIK" class="uk-width-1-1 uk-height-auto uk-margin-bottom" style="max-width: 500px; margin: 0 auto;">
        </div>
        <!-- Logo End -->

        <!-- Gallery -->
        <div class="uk-child-width-1-2 uk-child-width-1-4@m uk-margin" uk-grid="masonry: pack" uk-lightbox uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 300; repeat: false;">
            <?php foreach ($galleries as $gallery) { ?>
                <div>
                    <a href="images/gallery/<?=$gallery['image']?>">
                        <div class="uk-card uk-card-default uk-card-hover">
                            <div class="uk-card-media-top">
                                <img class="uk-width-1-1" src="images/gallery/<?=$gallery['image']?>" />
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <div class="uk-flex uk-flex-center uk-margin-large-top">
            <?= $pager->links('galleries', 'uikit_full') ?>
        </div>
        <!-- Gallery End -->
    </div>
</div>
<!-- Content End->
<?= $this->endSection() ?>