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
        <div class="uk-child-width-auto uk-flex-between uk-margin" uk-grid>
            <div>
                <h1 class="uk-h3 uk-heading-bullet uk-margin-remove">Daftar Outlet</h1>
            </div>
            <div>
                <a class="uk-button uk-button-third uk-border-rounded" href="#new-outlet" uk-toggle>Tambah Outlet</a>
            </div>
        </div>
        <!-- New Outlet Modal -->
        <div id="new-outlet" class="uk-flex-top" uk-modal="bg-close:false;">
            <div class="uk-modal-dialog uk-margin-auto-vertical">
                <form class="uk-margin uk-form-stacked" action="/office/outlet/new" method="post">
                    <div class="uk-modal-body">
                        <?= csrf_field() ?>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="name">Nama Outlet</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="name" name="name" type="text" placeholder="Contoh: Warung Padang Upik MT Haryono" required/>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="address">Alamat</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="address" name="address" type="text" placeholder="Contoh: Jl. MT Haryono No.68, Damai...." required/>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="phone">Nomor Telepon</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="phone" name="phone" type="tel" placeholder="Contoh: 081234567890" pattern="[0-9]{8,}" required/>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="operational_hours">Jam Operasional</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="operational_hours" name="operational_hours" type="text" placeholder="Contoh: 08:00 - 20:00" pattern="^([01][0-9]|2[0-3]):[0-5][0-9] - ([01][0-9]|2[0-3]):[0-5][0-9]$" required/>
                                <small class="uk-text-meta">Gunakan format 24 jam, contoh: 08:00 - 20:00</small>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="category">Kota</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="category" name="category" type="text" placeholder="Contoh: Yogyakarta" pattern="^[A-Z][a-zA-Z\s]+$" required/>
                                <small class="uk-text-meta">Gunakan huruf kapital di awal dan pastikan nama kota valid</small>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="maps">Embed Maps</label>
                            <div class="uk-form-controls">
                                <code>&lt;iframe src="https://www.google.com/maps/embed?pb=</code></br>
                                <input class="uk-input uk-width-expand uk-margin-small-horizontal" id="maps" name="maps" type="text" placeholder="!1m18!1m12!1m3!1d..." required />
                                </br><code>!5m2!1sen!2sid" ...&gt;&lt;/iframe&gt;</code>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="image">Foto Outlet</label>
                            <div class="uk-form-controls">
                                <div class="new-upload uk-placeholder uk-text-center">
                                    <span uk-icon="icon:move; ratio:2;"></span><br/>
                                    <span class="uk-text-middle">Tarik dan lepas file di sini atau</span>
                                    <div uk-form-custom>
                                        <input type="file" accept="image/*">
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
                                        url: '/office/outlet/upload',
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
                                            image.setAttribute('src', '/images/outlet/'+filename);
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
        
        <!-- Pagination Top -->
        <div class="uk-flex uk-flex-right uk-margin">
            <?= $pager->links('outlets', 'uikit_full') ?>
        </div>

        <!-- Outlet Table -->
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-striped uk-table-hover">
                <tbody>
                    <tr>
                        <th>No</th>
                        <th>Nama Outlet</th>
                        <th>Alamat</th>
                        <th>Nomor Telpon</th>
                        <th>Jam Operasional</th>
                        <th>Kota</th>
                        <th></th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($outlets as $outlet) { ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td class="uk-table-expand"><?= esc($outlet['name'])?></td>
                            <td class="uk-table-expand"><?= esc($outlet['address'])?></td>
                            <td class="uk-table-expand"><?= esc($outlet['phone'])?></td>
                            <td class="uk-table-expand"><?= esc($outlet['operational_hours'])?></td>
                            <td class="uk-table-expand"><?= esc($outlet['category'])?></td>
                            <td class="uk-width-small">
                                <div class="uk-child-width-auto uk-flex-center" uk-grid>
                                    <div>
                                        <a href="#edit-<?= esc($outlet['id']) ?>" uk-toggle class="uk-icon-button uk-button-secondary" uk-tooltip="Edit" uk-icon="pencil" data-tooltip-color="secondary"></a>
                                    </div>
                                    <div>
                                        <a href="#delete-<?= esc($outlet['id']) ?>" uk-toggle class="uk-icon-button uk-button-danger" uk-tooltip="Hapus" uk-icon="trash" data-tooltip-color="primary"></a>
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
                            </td>
                        </tr>
                        <!-- Edit Modal -->
                        <div id="edit-<?= esc($outlet['id']) ?>" class="uk-flex-top" uk-modal="bg-close:false;">
                            <div class="uk-modal-dialog uk-margin-auto-vertical">
                                <form class="uk-margin uk-form-stacked" action="/office/outlet/edit/<?= esc($outlet['id']) ?>" method="post">
                                    <div class="uk-modal-body">
                                        <?= csrf_field() ?>
                                        <div class="uk-margin">
                                            <label class="uk-form-label" for="name-<?= esc($outlet['id']) ?>">Nama Outlet</label>
                                            <div class="uk-form-controls">
                                                <input class="uk-input" id="name-<?= esc($outlet['id']) ?>" name="name" type="text" placeholder="Nama Outlet" value="<?=esc($outlet['name'])?>" required />
                                            </div>
                                        </div>
                                        <div class="uk-margin">
                                            <label class="uk-form-label" for="address-<?= esc($outlet['id']) ?>">Alamat</label>
                                            <div class="uk-form-controls">
                                                <input class="uk-input" id="address-<?= esc($outlet['id']) ?>" name="address" type="text" placeholder="Contoh: Jl. MT Haryono No.68, Damai...." value="<?=esc($outlet['address'])?>" required/>
                                            </div>
                                        </div>
                                        <div class="uk-margin">
                                            <label class="uk-form-label" for="phone-<?= esc($outlet['id']) ?>">Nomor Telepon</label>
                                            <div class="uk-form-controls">
                                                <input class="uk-input" id="phone-<?= esc($outlet['id']) ?>" name="phone" type="tel" placeholder="Contoh: 081234567890" pattern="[0-9]{8,}" value="<?=esc($outlet['phone'])?>" required/>
                                            </div>
                                        </div>
                                        <div class="uk-margin">
                                            <label class="uk-form-label" for="operational_hours-<?= esc($outlet['id']) ?>">Jam Operasional</label>
                                            <div class="uk-form-controls">
                                                <input class="uk-input" id="operational_hours-<?= esc($outlet['id']) ?>" name="operational_hours" type="text" placeholder="Contoh: 08:00 - 20:00" pattern="^([01][0-9]|2[0-3]):[0-5][0-9] - ([01][0-9]|2[0-3]):[0-5][0-9]$" value="<?=esc($outlet['operational_hours'])?>" required/>
                                                <small class="uk-text-meta">Gunakan format 24 jam, contoh: 08:00 - 20:00</small>
                                            </div>
                                        </div>
                                        <div class="uk-margin">
                                            <label class="uk-form-label" for="category-<?= esc($outlet['id']) ?>">Kota</label>
                                            <div class="uk-form-controls">
                                                <input class="uk-input" id="category-<?= esc($outlet['id']) ?>" name="category" type="text" placeholder="Contoh: Yogyakarta" pattern="^[A-Z][a-zA-Z\s]+$" value="<?=esc($outlet['category'])?>" required/>
                                                <small class="uk-text-meta">Gunakan huruf kapital di awal dan pastikan nama kota valid</small>
                                            </div>
                                        </div>
                                        <div class="uk-margin">
                                            <label class="uk-form-label" for="maps-<?= esc($outlet['id']) ?>">Embed Maps</label>
                                            <div class="uk-form-controls">
                                                <code>&lt;iframe src="https://www.google.com/maps/embed?pb=</code></br>
                                                <input class="uk-input uk-width-expand uk-margin-small-horizontal" id="maps-<?= esc($outlet['id']) ?>" name="maps" type="text" placeholder="!1m18!1m12!1m3!1d..." value="<?=esc($outlet['maps'])?>" required />
                                                </br><code>!5m2!1sen!2sid" ...&gt;&lt;/iframe&gt;</code>
                                            </div>
                                        </div>
                                        <div class="uk-margin">
                                            <label class="uk-form-label" for="new-image-<?= esc($outlet['id']) ?>">Foto Outlet</label>
                                            <div class="uk-form-controls">
                                                <div class="edit-upload-<?= esc($outlet['id']) ?> uk-placeholder uk-text-center">
                                                    <span uk-icon="icon:move; ratio:2;"></span><br/>
                                                    <span class="uk-text-middle">Tarik dan lepas file di sini atau</span>
                                                    <div uk-form-custom>
                                                        <input type="file" multiple>
                                                        <span class="uk-link">pilih satu</span>
                                                    </div>
                                                    <br/>
                                                    <span>Maks 2MB || Ration 1:1 (Square)</span>
                                                </div>
                                                <progress id="edit-progressbar-<?= esc($outlet['id']) ?>" class="uk-progress" value="0" max="100" hidden></progress>
                                                <input id="image-<?= esc($outlet['id']) ?>" name="image" value="<?=$outlet['image']?>" hidden required />
                                                <div id="image-container-<?= esc($outlet['id']) ?>" class="uk-height-small uk-flex uk-flex-middle uk-flex-center">
                                                    <img src="/images/outlet/<?=$outlet['image']?>" style="max-height:100%; max-width:100%;" />
                                                </div>
                                                <script>
                                                    var bar = document.getElementById('edit-progressbar-<?= esc($outlet['id']) ?>');
                                                    UIkit.upload('.edit-upload-<?= esc($outlet['id']) ?>', {
                                                        url: '/office/outlet/upload',
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
                                                            var imagecontainer = document.getElementById("image-container-<?= esc($outlet['id']) ?>");

                                                            imagecontainer.innerHTML = '';
                                                            document.getElementById("image-<?= esc($outlet['id']) ?>").value = filename;

                                                            var image = document.createElement('img');
                                                            image.setAttribute('src', '/images/outlet/'+filename);
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
                        <div id="delete-<?= esc($outlet['id'])?>" class="uk-flex-top" uk-modal="bg-close:false;">
                            <div class="uk-modal-dialog uk-margin-auto-vertical">
                                <div class="uk-modal-body">
                                    <div class="uk-modal-title uk-text-center">Anda yakin akan menghapus<br/><b><?=esc($outlet['name'])?></b>?</div>
                                </div>
                                <div class="uk-modal-footer">
                                    <div class="uk-child-width-auto uk-grid-small uk-flex-center" uk-grid>
                                        <div>
                                            <form class="uk-form-stacked" action="/office/outlet/delete" method="post">
                                                <?= csrf_field() ?>
                                                <input id="outlet-id" name="outlet-id" value="<?= esc($outlet['id'])?>" hidden required />
                                                <button class="uk-button uk-button-primary" type="submit">Ya</button>
                                            </form>
                                        </div>
                                        <div><a class="uk-button uk-button-third uk-modal-close">Tidak</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Bottom -->
        <div class="uk-flex uk-flex-right uk-margin">
            <?= $pager->links('outlets', 'uikit_full') ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>