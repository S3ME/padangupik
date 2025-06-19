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
                <h1 class="uk-h3 uk-heading-bullet uk-margin-remove">Kategori Menu</h1>
            </div>
            <div>
                <a class="uk-button uk-button-third uk-border-rounded" href="#new-category" uk-toggle>Tambah Kategori</a>
            </div>
        </div>
        <!-- New Category Modal -->
        <div id="new-category" class="uk-flex-top" uk-modal="bg-close:false;">
            <div class="uk-modal-dialog uk-margin-auto-vertical">
                <form class="uk-margin uk-form-stacked" action="/office/category/new" method="post">
                    <div class="uk-modal-body">
                        <?= csrf_field() ?>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="name">Nama Kategori</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="name" name="name" type="text" placeholder="Nama Kategori" required/>
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
            <?= $pager->links('categories', 'uikit_full') ?>
        </div>

        <!-- Category Table -->
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-striped uk-table-hover">
                <tbody>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th></th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($categories as $category) { ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td class="uk-table-expand"><?= esc($category['name'])?></td>
                            <td class="uk-width-small">
                                <div class="uk-child-width-auto uk-flex-center" uk-grid>
                                    <div>
                                        <a href="#edit-<?= esc($category['id']) ?>" uk-toggle class="uk-icon-button uk-button-secondary" uk-tooltip="Edit" uk-icon="pencil" data-tooltip-color="secondary"></a>
                                    </div>
                                    <div>
                                        <a href="#delete-<?= esc($category['id']) ?>" uk-toggle class="uk-icon-button uk-button-danger" uk-tooltip="Hapus" uk-icon="trash" data-tooltip-color="primary"></a>
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
                        <div id="edit-<?= esc($category['id']) ?>" class="uk-flex-top" uk-modal="bg-close:false;">
                            <div class="uk-modal-dialog uk-margin-auto-vertical">
                                <form class="uk-margin uk-form-stacked" action="/office/category/edit/<?= esc($category['id']) ?>" method="post">
                                    <div class="uk-modal-body">
                                        <?= csrf_field() ?>
                                        <div class="uk-margin">
                                            <label class="uk-form-label" for="name-<?= esc($category['id']) ?>">Nama Menu</label>
                                            <div class="uk-form-controls">
                                                <input class="uk-input" id="name-<?= esc($category['id']) ?>" name="name" type="text" placeholder="Nama Menu" value="<?=esc($category['name'])?>" required />
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
                        <div id="delete-<?= esc($category['id'])?>" class="uk-flex-top" uk-modal="bg-close:false;">
                            <div class="uk-modal-dialog uk-margin-auto-vertical">
                                <div class="uk-modal-body">
                                    <div class="uk-modal-title uk-text-center">Anda yakin akan menghapus<br/><b><?=esc($category['name'])?></b>?</div>
                                </div>
                                <div class="uk-modal-footer">
                                    <div class="uk-child-width-auto uk-grid-small uk-flex-center" uk-grid>
                                        <div>
                                            <form class="uk-form-stacked" action="/office/category/delete" method="post">
                                                <?= csrf_field() ?>
                                                <input id="category-id" name="category-id" value="<?= esc($category['id'])?>" hidden required />
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
            <?= $pager->links('categories', 'uikit_full') ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>