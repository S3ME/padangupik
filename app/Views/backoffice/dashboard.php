<?= $this->extend('backoffice/layout') ?>

<?= $this->section('extraScripts') ?>
<script>
    jQuery(window).on("load", function () {
        $('#loading').attr('hidden', '');
        $('#main').removeAttr('hidden');
    });
</script>
<?= $this->endSection() ?>

<?= $this->section('main') ?>
<section id="loading" class="uk-width-1-1 uk-height-1-1 uk-flex uk-flex-center uk-flex-middle">
    <div uk-spinner="ratio: 3"></div>
</section>
<section id="main" class="uk-section uk-section-small" hidden>
    <div class="uk-container uk-container-expand">
        <h2 class="uk-h3 uk-heading-bullet uk-margin-remove">Dashboard</h2>
        <div class="uk-margin-top uk-grid-match uk-child-width-1-2@s" uk-grid>
            <div>
                <div class="uk-card uk-card-primary uk-card-body uk-border-rounded">
                    <h3 class="uk-card-title">Selamat Datang</h3>
                    <p style="color: #fff!important;">Hai <strong><?= esc($user->username ?? 'Admin') ?></strong>, selamat datang di panel manajemen Warung Padang Upik. Gunakan dashboard ini untuk memantau dan mengelola outlet, menu, dan konten lainnya dengan mudah.</p>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-secondary uk-card-body uk-border-rounded">
                    <h3 class="uk-card-title">Aktivitas Terakhir</h3>
                    <ul class="uk-list uk-list-divider" style="color: #fff!important;">
                        <li>Login terakhir: <?= esc(date('d M Y H:i', strtotime($lastLogin)) ?? 'Belum tersedia') ?></li>
                        <li>Penambahan banner terakhir: <?= esc(date('d M Y H:i', strtotime($lastBanners)) ?? 'Belum tersedia') ?></li>
                        <li>Penambahan galeri foto terakhir: <?= esc(date('d M Y H:i', strtotime($lastGalleries)) ?? 'Belum tersedia') ?></li>
                        <li>Penambahan kategori menu terakhir: <?= esc($lastCategories ?? '-') ?></li>
                        <li>Penambahan menu terakhir: <?= esc($lastProduct ?? '-') ?></li>
                        <li>Penambahan outlet terakhir: <?= esc($lastOutlet ?? '-') ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="uk-grid-small uk-child-width-1-3@m uk-child-width-1-2@s uk-text-center" uk-grid>
            <!-- Banner -->
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                    <span uk-icon="icon: image; ratio: 2"></span>
                    <h3 class="uk-card-title">Banner</h3>
                    <p class="uk-text-large"><?= esc($totalBanner ?? 0) ?> Banner</p>
                </div>
            </div>

            <!-- Kategori -->
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                    <span uk-icon="icon: tag; ratio: 2"></span>
                    <h3 class="uk-card-title">Kategori Menu</h3>
                    <p class="uk-text-large"><?= esc($totalCategory ?? 0) ?> Kategori</p>
                </div>
            </div>

            <!-- Menu / Produk -->
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                    <span uk-icon="icon: list; ratio: 2"></span>
                    <h3 class="uk-card-title">Menu</h3>
                    <p class="uk-text-large"><?= esc($totalProduct ?? 0) ?> Item</p>
                </div>
            </div>

            <!-- Galeri -->
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                    <span uk-icon="icon: image; ratio: 2"></span>
                    <h3 class="uk-card-title">Galeri</h3>
                    <p class="uk-text-large"><?= esc($totalGallery ?? 0) ?> Foto</p>
                </div>
            </div>

            <!-- Outlet -->
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                    <span uk-icon="icon: location; ratio: 2"></span>
                    <h3 class="uk-card-title">Outlet</h3>
                    <p class="uk-text-large"><?= esc($totalOutlet ?? 0) ?> Outlet</p>
                </div>
            </div>

            <!-- Pengguna -->
            <div>
                <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                    <span uk-icon="icon: users; ratio: 2"></span>
                    <h3 class="uk-card-title">Pengguna</h3>
                    <p class="uk-text-large"><?= esc($totalUser ?? 0) ?> Admin</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>