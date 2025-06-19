<?= $this->extend('backoffice/layout') ?>

<?= $this->section('extraScripts') ?>
<script>
    jQuery(window).on("load", function () {
        $('#loading').attr('hidden', '');
        $('#main').removeAttr('hidden');
    });
</script>

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 25px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 34px;
    }

    .slider:before {
        content: "";
        position: absolute;
        height: 20px;
        width: 20px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #e93232;
    }

    input:checked + .slider:before {
        transform: translateX(25px);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('main') ?>
<section id="loading" class="uk-width-1-1 uk-height-1-1 uk-flex uk-flex-center uk-flex-middle">
    <div uk-spinner="ratio: 3"></div>
</section>
<section id="main" class="uk-section uk-section-small" hidden>
    <div class="uk-container uk-container-expand">
        <!-- Alert Container -->
        <div>
            <?php if (session('errors') !== null) { ?>
                <div class="uk-alert-danger" uk-alert>
                    <a href class="uk-alert-close" uk-close></a>
                    <ul class="uk-list uk-list-disc">
                        <?php foreach (session('errors') as $error) { ?>
                            <li><?=$error?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <?php if (session('error') !== null) { ?>
                <div class="uk-alert-danger" uk-alert>
                    <a href class="uk-alert-close" uk-close></a>
                    <p><?=session('error')?></p>
                </div>
            <?php } ?>
            <?php if (session('message') !== null) { ?>
                <div class="uk-alert-success" uk-alert>
                    <a href class="uk-alert-close" uk-close></a>
                    <p><?=session('message')?></p>
                </div>
            <?php } ?>
        </div>
        <!-- Title -->
        <div class="uk-child-width-auto uk-flex-between" uk-grid>
            <div>
                <h1 class="uk-h3 uk-heading-bullet uk-margin-remove">Menu</h1>
            </div>
            <div>
                <a class="uk-button uk-button-third uk-border-rounded" href="#new-product" uk-toggle>Tambah Menu</a>
            </div>
        </div>
        <!-- New product Modal -->
        <div id="new-product" class="uk-flex-top" uk-modal="bg-close:false;">
            <div class="uk-modal-dialog uk-margin-auto-vertical">
                <form class="uk-margin uk-form-stacked" action="/office/product/new" method="post">
                    <div class="uk-modal-body">
                        <?= csrf_field() ?>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="name">Nama Menu</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="name" name="name" type="text" placeholder="Nama Menu" required />
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label" for="description">Deskripsi Menu</label>
                            <div class="uk-form-controls">
                                <textarea class="uk-textarea" id="description" name="description" placeholder="Deskripsi Menu" aria-label="Textarea" required></textarea>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label" for="category">Kategori</label>
                            <div class="uk-form-controls">
                                <select class="uk-select" id="category" name="category" required aria-label="Pilih Kategori">
                                    <option value="" disabled selected hidden>Pilih Kategori</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= esc($category['id']) ?>"><?= esc($category['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label" for="favorite">Favorite</label>
                            <div class="uk-form-controls uk-margin-small-top">
                                <input type="hidden" name="favorite" value="0">
                                <label class="switch">
                                    <input id="favorite" name="favorite" type="checkbox" value="1">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label" for="image">Foto Menu</label>
                            <div class="uk-form-controls">
                                <div class="new-upload uk-placeholder uk-text-center">
                                    <span uk-icon="icon:move; ratio:2;"></span><br/>
                                    <span class="uk-text-middle">Tarik dan lepas file di sini atau</span>
                                    <div uk-form-custom>
                                        <input type="file" multiple accept="image/*">
                                        <span class="uk-link">pilih satu</span>
                                    </div>
                                    <br/>
                                    <span>Maks 2MB || Ratio 1:1 (Square)</span>
                                </div>
                                <progress id="new-progressbar" class="uk-progress" value="0" max="100" hidden></progress>
                                <input id="image" name="image" required hidden />
                                <div id="image-container" class="uk-height-small uk-flex uk-flex-middle uk-flex-center"></div>

                                <script>
                                    var bar = document.getElementById('new-progressbar');
                                    UIkit.upload('.new-upload', {
                                        url: '/office/product/upload',
                                        multiple: false,
                                        name: 'upload',
                                        method: 'POST',
                                        type: 'json',
                                        beforeSend: function () {
                                            console.log('beforeSend', arguments);
                                        },
                                        beforeAll: function () {
                                            console.log('beforeAll', arguments);
                                        },
                                        load: function () {
                                            console.log('load', arguments);
                                        },
                                        error: function () {
                                            console.log('error', arguments);
                                            var error = arguments[0].xhr.response.message.upload;
                                            alert(error);
                                        },
                                        complete: function () {
                                            console.log('complete', arguments);
                                            var filename = arguments[0].response;
                                            var imagecontainer = document.getElementById("image-container");

                                            imagecontainer.innerHTML = '';
                                            document.getElementById("image").value = filename;

                                            var image = document.createElement('img');
                                            image.setAttribute('src', '/images/menu/'+filename);
                                            image.setAttribute('style', 'max-height:100%; max-width:100%;');

                                            imagecontainer.appendChild(image);
                                        },
                                        loadStart: function (e) {
                                            console.log('loadStart', arguments);
                                            bar.removeAttribute('hidden');
                                            bar.max = e.total;
                                            bar.value = e.loaded;
                                        },
                                        progress: function (e) {
                                            console.log('progress', arguments);
                                            bar.max = e.total;
                                            bar.value = e.loaded;
                                        },
                                        loadEnd: function (e) {
                                            console.log('loadEnd', arguments);
                                            bar.max = e.total;
                                            bar.value = e.loaded;
                                        },
                                        completeAll: function () {
                                            console.log('completeAll', arguments);
                                            setTimeout(function () {
                                                bar.setAttribute('hidden', 'hidden');
                                            }, 1000);
                                            alert('Upload Selesai');
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="uk-modal-footer">
                        <div class="uk-child-width-auto uk-grid-small uk-flex-center" uk-grid>
                            <div><button class="uk-button uk-button-third" type="submit">Simpan</button></div>
                            <div><a class="uk-button uk-button-danger uk-modal-close">Batal</a></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Pagination Top -->
        <div class="uk-flex uk-flex-right uk-margin">
            <?= $pager_links ?>
        </div>
        <!-- product Grid -->
        <div class="uk-child-width-1-1 uk-child-width-1-4@m" uk-grid  uk-height-match="target: > div > .uk-card > .uk-card-body">
            <?php foreach ($products as $product) { ?>
                <div>
                    <div class="uk-card uk-card-default uk-card-hover uk-box-shadow-medium uk-border-rounded">
                        <div class="uk-card-media-top uk-inline uk-flex uk-flex-center uk-height-medium uk-background-muted uk-overflow-hidden">
                            <img src="/images/menu/<?= esc($product['image']) ?>" alt="<?= esc($product['name']) ?>" style="max-height: 100%; max-width: 100%; object-fit: cover;" />
                            <?php if ($product['favorite']) { ?>
                                <div class="uk-position-top-right uk-margin-small">
                                    <span class="uk-label uk-label-primary">★ Favorite</span>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="uk-card-body uk-text-center">
                            <h3 class="uk-card-title uk-margin-small-bottom"><?= esc($product['name']) ?></h3>

                            <div class="uk-margin-small">
                                <span class="uk-label uk-label-warning uk-text-capitalize" style="background-color: #FFCD05;">
                                    <span uk-icon="icon: tag"></span> <?= esc($product['category']) ?>
                                </span>
                            </div>

                            <div class="uk-text-small uk-margin-small-top uk-text-meta" style="font-style: italic;"><?= esc($product['description']) ?></div>
                        </div>

                        <div class="uk-card-footer">
                            <div class="uk-flex uk-flex-center uk-grid-small" uk-grid>
                                <div>
                                    <a href="#edit-<?= esc($product['id']) ?>" uk-toggle class="uk-icon-button uk-button-secondary" uk-tooltip="Edit" uk-icon="pencil" data-tooltip-color="secondary"></a>
                                </div>
                                <div>
                                    <a href="#delete-<?= esc($product['id']) ?>" uk-toggle class="uk-icon-button uk-button-danger" uk-tooltip="Hapus" uk-icon="trash" data-tooltip-color="primary"></a>
                                </div>
                                <script>
                                    document.querySelectorAll('[uk-tooltip]').forEach(el => {
                                        el.addEventListener('mouseenter', () => {
                                            setTimeout(() => {
                                                const tooltip = document.querySelector('.uk-tooltip');
                                                if (!tooltip) return;

                                                const type = el.getAttribute('data-tooltip-color');
                                                if (type === 'primary') {
                                                    tooltip.style.backgroundColor = '#e92629';
                                                } else if (type === 'secondary') {
                                                    tooltip.style.backgroundColor = '#FFCD05';
                                                }
                                            }, 50); // Delay to ensure tooltip exists
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Modal -->
                    <div id="edit-<?= esc($product['id']) ?>" class="uk-flex-top" uk-modal="bg-close:false;">
                        <div class="uk-modal-dialog uk-margin-auto-vertical">
                            <form class="uk-margin uk-form-stacked" action="/office/product/edit/<?= esc($product['id']) ?>" method="post">
                                <div class="uk-modal-body">
                                    <?= csrf_field() ?>
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="name-<?= esc($product['id']) ?>">Nama Menu</label>
                                        <div class="uk-form-controls">
                                            <input class="uk-input" id="name-<?= esc($product['id']) ?>" name="name" type="text" placeholder="Nama Menu" value="<?=esc($product['name'])?>" required />
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="description-<?= esc($product['id']) ?>">Deskripsi</label>
                                        <div class="uk-form-controls">
                                            <textarea class="uk-textarea" id="description-<?= esc($product['id']) ?>" name="description"
                                                placeholder="Deskripsi Menu" rows="3" required><?= esc($product['description']) ?></textarea>
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="category-<?= esc($product['id']) ?>">Kategori</label>
                                        <div class="uk-form-controls">
                                            <select class="uk-select" id="category-<?= esc($product['id']) ?>" name="category" required>
                                                <option disabled hidden>Pilih Kategori</option>
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?= esc($category['id']) ?>" <?= $product['cat_id'] == $category['id'] ? 'selected' : '' ?>><?= esc($category['name']) ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="favorite">Favorite</label>
                                        <div class="uk-form-controls uk-margin-small-top">
                                            <input type="hidden" name="favorite" value="0">
                                            <label class="switch">
                                                <input type="checkbox" id="favorite-<?= esc($product['id']) ?>" name="favorite" value="1" <?= $product['favorite'] ? 'checked' : '' ?>><span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="uk-margin">
                                        <label class="uk-form-label" for="new-image-<?= esc($product['id']) ?>">Foto Menu</label>
                                        <div class="uk-form-controls">
                                            <div class="edit-upload-<?= esc($product['id']) ?> uk-placeholder uk-text-center">
                                                <span uk-icon="icon:move; ratio:2;"></span><br/>
                                                <span class="uk-text-middle">Tarik dan lepas file di sini atau</span>
                                                <div uk-form-custom>
                                                    <input type="file" multiple>
                                                    <span class="uk-link">pilih satu</span>
                                                </div>
                                                <br/>
                                                <span>Maks 2MB || Ration 1:1 (Square)</span>
                                            </div>
                                            <progress id="edit-progressbar-<?= esc($product['id']) ?>" class="uk-progress" value="0" max="100" hidden></progress>
                                            <input id="image-<?= esc($product['id']) ?>" name="image" value="<?=$product['image']?>" hidden required />
                                            <div id="image-container-<?= esc($product['id']) ?>" class="uk-height-small uk-flex uk-flex-middle uk-flex-center">
                                                <img src="/images/menu/<?=$product['image']?>" style="max-height:100%; max-width:100%;" />
                                            </div>
                                            <script>
                                                var bar = document.getElementById('edit-progressbar-<?= esc($product['id']) ?>');
                                                UIkit.upload('.edit-upload-<?= esc($product['id']) ?>', {
                                                    url: '/office/product/upload',
                                                    multiple: false,
                                                    name: 'upload',
                                                    method: 'POST',
                                                    type: 'json',
                                                    beforeSend: function () {
                                                        console.log('beforeSend', arguments);
                                                    },
                                                    beforeAll: function () {
                                                        console.log('beforeAll', arguments);
                                                    },
                                                    load: function () {
                                                        console.log('load', arguments);
                                                    },
                                                    error: function () {
                                                        console.log('error', arguments);
                                                        var error = arguments[0].xhr.response.message.upload;
                                                        alert(error);
                                                    },
                                                    complete: function () {
                                                        console.log('complete', arguments);
                                                        var filename = arguments[0].response;
                                                        var imagecontainer = document.getElementById("image-container-<?= esc($product['id']) ?>");

                                                        imagecontainer.innerHTML = '';
                                                        document.getElementById("image-<?= esc($product['id']) ?>").value = filename;

                                                        var image = document.createElement('img');
                                                        image.setAttribute('src', '/images/menu/'+filename);
                                                        image.setAttribute('style', 'max-height:100%; max-width:100%;');

                                                        imagecontainer.appendChild(image);
                                                    },
                                                    loadStart: function (e) {
                                                        console.log('loadStart', arguments);
                                                        bar.removeAttribute('hidden');
                                                        bar.max = e.total;
                                                        bar.value = e.loaded;
                                                    },
                                                    progress: function (e) {
                                                        console.log('progress', arguments);
                                                        bar.max = e.total;
                                                        bar.value = e.loaded;
                                                    },
                                                    loadEnd: function (e) {
                                                        console.log('loadEnd', arguments);
                                                        bar.max = e.total;
                                                        bar.value = e.loaded;
                                                    },
                                                    completeAll: function () {
                                                        console.log('completeAll', arguments);
                                                        setTimeout(function () {
                                                            bar.setAttribute('hidden', 'hidden');
                                                        }, 1000);
                                                        alert('Upload Selesai');
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-modal-footer">
                                    <div class="uk-child-width-auto uk-grid-small uk-flex-center" uk-grid>
                                        <div><button class="uk-button uk-button-third" type="submit">Simpan</button></div>
                                        <div><a class="uk-button uk-button-primary uk-modal-close">Batal</a></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Delete Modal -->
                    <div id="delete-<?= esc($product['id']) ?>" class="uk-flex-top" uk-modal="bg-close:false;">
                        <div class="uk-modal-dialog uk-margin-auto-vertical">
                            <div class="uk-modal-body">
                                <div class="uk-modal-title uk-text-center">Anda yakin akan menghapus<br/><b><?=esc($product['name'])?></b>?</div>
                            </div>
                            <div class="uk-modal-footer">
                                <div class="uk-child-width-auto uk-grid-small uk-flex-center" uk-grid>
                                    <div>
                                        <form class="uk-margin uk-form-stacked" action="/office/product/delete" method="post">
                                            <?= csrf_field() ?>
                                            <input id="product-id" name="product-id" value="<?= esc($product['id']) ?>" hidden required />
                                            <button class="uk-button uk-button-primary" type="submit">Ya</button>
                                        </form>
                                    </div>
                                    <div><a class="uk-button uk-button-third uk-modal-close">Tidak</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- Pagination Bottom -->
        <div class="uk-flex uk-flex-right uk-margin">
            <?= $pager_links ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>