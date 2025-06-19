<?= $this->extend('frontoffice/layout') ?>

<?= $this->section('main') ?>
<!-- Sticky Centered Category Navbar -->
<?= $this->section('extraNav') ?>
<div class="uk-container-expand" uk-sticky show-on-up animation="uk-animation-slide-top" cls-active="uk-navbar-sticky" sel-target=".uk-navbar-nav" cls-inactive="uk-navbar-transparent" style="background-color: #f8f9fa; padding: 5px 10px; margin-top: 100px;">
    <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
        <ul class="uk-navbar-nav uk-flex-nowrap uk-flex-center" style="min-width: max-content; flex-wrap: nowrap;">
            <li class="<?= (!isset($activeCategory) || $activeCategory === 'all') ? 'uk-active' : '' ?>">
                <a href="#" data-category="all">
                    <span class="uk-icon" uk-icon="icon: tag"></span>
                    Semua
                </a>
            </li>
            <?php
            // Collect unique categories from $outlets
            $uniqueCategories = [];
            foreach ($outlets as $outlet) {
                if (!empty($outlet['category']) && !in_array($outlet['category'], $uniqueCategories)) {
                    $uniqueCategories[] = $outlet['category'];
                }
            }

            // Urutkan nama kategori secara alfabetis
            sort($uniqueCategories, SORT_STRING | SORT_FLAG_CASE); // Case-insensitive sort

            // Tampilkan kategori
            foreach ($uniqueCategories as $category) { ?>
                <li class="<?= (isset($activeCategory) && $activeCategory == $category) ? 'uk-active' : '' ?>">
                    <a href="#" data-category="<?= esc($category) ?>">
                        <span class="uk-icon" uk-icon="icon: tag"></span>
                        <?= esc($category) ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<?= $this->endSection() ?>
<!-- Sticky Centered Category Navbar End -->
 
<!-- Padding Top -->
<div class="uk-visible@m" style="padding-top: 250px;"></div>
<!-- Padding Top End -->

<!-- Outlet List -->
<div style="background-image: url('<?= base_url('images/hero-bg.svg') ?>'); background-size: cover; background-position: center;">
    <div class="uk-container uk-container-large">
        <h2 class="uk-heading-bullet uk-margin-medium">Daftar Outlet</h2>
        <div class="uk-child-width-1-1 uk-child-width-1-3@m uk-child-width-1-4@l uk-grid-match uk-grid-margin" uk-grid uk-height-match="target: > div > .uk-card" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 300; repeat: false;">
            <?php foreach ($outlets as $outlet) { ?>
                <div class="outlet-item" data-category="<?= esc($outlet['category']) ?>" id="<?= esc($outlet['category']) ?>">
                    <div class="uk-card uk-card-default uk-card-body uk-card-hover" style="border-radius: 25px;">
                        <div>
                            <h3><?= $outlet['name'] ?></h3>
                        </div>
                        <div>
                            <p><?= $outlet['address'] ?></p>
                        </div>
                        <div>
                            <span class="uk-text-bolder"><i class="uk-text-primary" uk-icon="clock"></i> <?= $outlet['operational_hours'] ?></span>
                        </div>
                        <div class="uk-text-center uk-margin">
                            <button class="uk-button uk-button-text" type="button" uk-toggle="target: #modal-outlet-<?= $outlet['id'] ?>">Lihat Detail</button>

                            <!-- Modal -->
                            <div id="modal-outlet-<?= $outlet['id'] ?>" class="uk-flex-top" uk-modal>
                                <div class="uk-modal-dialog uk-margin-auto-vertical" uk-overflow-auto style="border-radius: 20px;">
                                    <button class="uk-modal-close-default" type="button" uk-close></button>
                                    <div class="uk-modal-body">
                                        <div class="uk-child-width-1-2@m uk-child-width-1-1" uk-grid>
                                            <div>
                                                <h2 class="uk-modal-title uk-text-primary"><?= $outlet['name'] ?></h2>
                                                <div class="uk-text-meta uk-margin"><?= $outlet['address'] ?></div>
                                                <div class="uk-text-bolder uk-margin-small"><i class="uk-text-primary" uk-icon="clock"></i> <?= $outlet['operational_hours'] ?></div>
                                                <a class="uk-text-bolder uk-margin-small" href="https://wa.me/<?=$outlet['phone']?>" target="_blank"><i class="uk-text-primary" uk-icon="whatsapp"></i> <?= $outlet['phone'] ?></a>
                                            </div>
                                            <div>
                                                <img class="uk-width-1-1" src="images/outlet/<?=$outlet['image']?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-modal-footer">
                                        <iframe src="https://www.google.com/maps/embed?pb=<?= $outlet['maps'] ?>!5m2!1sen!2sid" class="uk-width-1-1" width="200" height="200" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Script Shorting -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryLinks = document.querySelectorAll('[data-category]');
        const outletItems = document.querySelectorAll('.outlet-item');

        categoryLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                
                // Ambil kategori yang diklik
                const selectedCategory = this.getAttribute('data-category');

                // Ubah tampilan kategori aktif
                categoryLinks.forEach(l => l.parentElement.classList.remove('uk-active'));
                this.parentElement.classList.add('uk-active');

                // Tampilkan atau sembunyikan outlet
                outletItems.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');

                    if (selectedCategory === 'all' || itemCategory === selectedCategory) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
<!-- Script Shorting End -->
<!-- Outlet List End -->
<?= $this->endSection() ?>