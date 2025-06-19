<?= $this->extend('frontoffice/layout') ?>

<?= $this->section('main') ?>
<!-- Product Detail -->
<div class="uk-section-default uk-section uk-section-small" style="background-image: url('<?= base_url('images/hero-bg.svg') ?>'); background-size: cover; background-position: center;">
    <div class="uk-container uk-container-large">
        
        <!-- Breadcrumb dan Share -->
        <div class="uk-child-width-1-2@m uk-flex-middle uk-margin-bottom" uk-grid>
            <div>
                <ul class="uk-breadcrumb">
                    <li><a href="<?= site_url() ?>">Home</a></li>
                    <li><a href="<?= site_url('product') ?>">Menu</a></li>
                    <li><span><?= esc($product['name']) ?></span></li>
                </ul>
            </div>
            <div class="uk-text-right">
                <span class="uk-margin-small-right">Share:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="uk-icon-button uk-margin-small-right" uk-icon="facebook"></a>
                <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>&text=<?= urlencode($product['name']) ?>" target="_blank" class="uk-icon-button uk-margin-small-right" uk-icon="twitter"></a>
                <a href="https://wa.me/?text=<?= urlencode($product['name'] . ' ' . current_url()) ?>" target="_blank" class="uk-icon-button" uk-icon="whatsapp"></a>
            </div>
        </div>

        <!-- Products Content -->
        <div class="uk-grid-match uk-child-width-1-2@m uk-flex-middle" uk-grid uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 200">
            <!-- Image -->
            <div>
                <div class="uk-card uk-card-default uk-overflow-hidden" style="border-radius: 25px;">
                    <div class="uk-inline-clip uk-transition-toggle">
                        <img src="/images/menu/<?= esc($product['image']) ?>" alt="<?= esc($product['name']) ?>" class="uk-transition-scale-up uk-transition-opaque" style="border-radius: 25px; object-fit: cover;">
                    </div>
                </div>
            </div>

            <!-- Products Informations -->
            <div>
                <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
                    <h2 class="uk-heading-bullet uk-margin-remove-bottom">
                        <?= esc($product['name']) ?>
                        <?php if ($product['favorite']): ?>
                            <span class="uk-label uk-label-warning uk-margin-small-left">Favorit</span>
                        <?php endif; ?>
                    </h2>
                    <h5 class="uk-text-muted uk-margin-small-top uk-margin-remove-bottom">
                        Kategori: 
                        <a href="<?= site_url('product#' . $product['category_id']) ?>">
                            <?= esc($product['category_name']) ?>
                        </a>
                    </h5>
                    <hr class="uk-divider-small">
                    <p class="uk-text-lead"><?= esc($product['description']) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product Detail End -->
<?= $this->endSection() ?>