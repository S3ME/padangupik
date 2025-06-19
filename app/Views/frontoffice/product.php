<?= $this->extend('frontoffice/layout') ?>

<?= $this->section('main') ?>
<!-- Sticky Centered Category Navbar -->
<?= $this->section('extraNav') ?>
<div class="uk-container-expand" uk-sticky show-on-up animation="uk-animation-slide-top" cls-active="uk-navbar-sticky" sel-target=".uk-navbar-nav" cls-inactive="uk-navbar-transparent" style="background-color: #f8f9fa; padding: 5px 10px; margin-top: 100px;">
    <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
        <ul class="uk-navbar-nav uk-flex-nowrap uk-flex-center" style="min-width: max-content; flex-wrap: nowrap;">
            <li class="<?= (!isset($activeCategory) || $activeCategory === 'all') ? 'uk-active' : '' ?>">
                <a href="#all" data-category="all">
                    <span class="uk-icon" uk-icon="icon: tag"></span>
                    Semua
                </a>
            </li>
            <?php foreach ($categories as $category): ?>
                <li class="<?= (isset($activeCategory) && $activeCategory == $category['id']) ? 'uk-active' : '' ?>">
                    <a href="#<?= $category['id'] ?>" data-category="<?= $category['id'] ?>">
                        <span class="uk-icon" uk-icon="icon: tag"></span>
                        <?= esc($category['name']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('.uk-navbar-nav a[data-category]');
        const navItems = document.querySelectorAll('.uk-navbar-nav li');
        const sections = {};
        const sectionOrder = [];
        <?php foreach ($categories as $category): ?>
            sections['<?= $category['id'] ?>'] = document.getElementById('<?= $category['id'] ?>');
            sectionOrder.push('<?= $category['id'] ?>');
        <?php endforeach; ?>
        sections['all'] = document.body;
        sectionOrder.unshift('all');

        // Always set default active to 'all' on load
        function setDefaultActiveAll() {
            navLinks.forEach(link => {
                if (link.getAttribute('data-category') === 'all') {
                    link.parentElement.classList.add('uk-active');
                } else {
                    link.parentElement.classList.remove('uk-active');
                }
            });
        }

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const cat = this.getAttribute('data-category');
                navItems.forEach(li => li.classList.remove('uk-active'));
                this.parentElement.classList.add('uk-active');
                if (cat === 'all') {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } else if (sections[cat]) {
                    sections[cat].scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // Always default to 'all' active on page load
        setDefaultActiveAll();

        // Scrollspy-like nav activation on scroll
        function onScroll() {
            let scrollPos = window.scrollY || window.pageYOffset;
            let activeCat = 'all';
            for (let i = sectionOrder.length - 1; i >= 0; i--) {
                let cat = sectionOrder[i];
                if (cat === 'all') continue;
                let section = sections[cat];
                if (section && section.offsetTop - 120 <= scrollPos) {
                    activeCat = cat;
                    break;
                }
            }
            navLinks.forEach(link => {
                if (link.getAttribute('data-category') === activeCat) {
                    link.parentElement.classList.add('uk-active');
                } else {
                    link.parentElement.classList.remove('uk-active');
                }
            });
            // If at the very top, default to 'all'
            if (scrollPos < 10) {
                setDefaultActiveAll();
            }
        }
        window.addEventListener('scroll', onScroll, { passive: true });
    });
</script>
<style>
    /* Make navbar horizontally scrollable on small screens */
    @media (max-width: 960px) {
        .uk-navbar-nav {
            flex-wrap: nowrap !important;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .uk-navbar-nav > li {
            flex: 0 0 auto;
        }
    }
</style>
<?= $this->endSection() ?>
<!-- Sticky Centered Category Navbar End -->

<!-- Padding Top -->
<div class="uk-visible@m" style="padding-top: 250px;"></div>
<!-- Padding Top End -->

<!-- Product List -->
<div class="" style="background-image: url('<?= base_url('images/hero-bg.svg') ?>'); background-size: cover; background-position: center;">
    <div class="uk-container uk-container-large" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 500; repeat: false;">
        <?php
        // Group products by category_id
        $productsByCategory = [];
        foreach ($products as $product) {
            $catId = $product['category_id'] ?? 'uncategorized';
            $productsByCategory[$catId][] = $product;
        }
        ?>

        <!-- Loop through categories (including 'all') -->
        <?php foreach ($categories as $category) { ?>
            <div id="<?= $category['id'] ?>" class="uk-margin">
                <h3 class="uk-heading-bullet"><span><?= esc($category['name']) ?></span></h3>
                <div class="uk-child-width-1-2 uk-child-width-1-3@m uk-child-width-1-5@l uk-grid-match uk-grid-margin" uk-grid uk-height-match="target: > a > div" uk-scrollspy="target: > a; cls: uk-animation-fade; delay: 500; repeat: false;">
                    <?php if (!empty($productsByCategory[$category['id']])) { ?>
                        <?php foreach ($productsByCategory[$category['id']] as $product) { ?>
                            <a href="<?= site_url('product/' . $product['id']) ?>">
                                <div>
                                    <div class="uk-card uk-card-default uk-overflow-hidden uk-border-rounded uk-margin">
                                        <div class="uk-inline-clip uk-transition-toggle">
                                            <img class="uk-transition-scale-up uk-transition-opaque" style="border-radius: 25px; object-fit: cover;" src="/images/menu/<?= $product['image'] ?>" alt="<?= esc($product['name']) ?>">
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="uk-text-center"><?= esc($product['name']) ?></h4>
                                        <p class="uk-text-center">
                                            <?php if (!empty($product['favorite']) && $product['favorite']) { ?>
                                                <span class="uk-text-primary">#FAVORITE</span>
                                            <?php } ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    <?php } else {?>
                        <div>
                            <p class="uk-text-center">Tidak ada Menu pada kategori ini.</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- Product List End -->
<?= $this->endSection() ?>