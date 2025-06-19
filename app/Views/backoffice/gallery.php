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
        <div class="uk-child-width-auto uk-flex-between" uk-grid>
            <div>
                <h1 class="uk-h3 uk-heading-bullet uk-margin-remove">Galeri Foto</h1>
            </div>
            <div>
                <a class="uk-button uk-button-third uk-border-rounded" href="#new-photo" uk-toggle>Tambah Foto</a>
            </div>
        </div>
        <!-- Pagination Top -->
        <div class="uk-flex uk-flex-right uk-margin">
            <?= $pager->links('galleries', 'uikit_full') ?>
        </div>
        <!-- Gallery Grid -->
        <div id="gallery-container" class="uk-child-width-1-2 uk-child-width-1-4@m uk-grid-small" uk-grid>
            <?php foreach ($galleries as $gallery) { ?>
                <div>
                    <div class="uk-width-1-1 uk-card uk-card-default uk-card-hover uk-card-body uk-inline">
                        <div uk-lightbox>
                            <a class="uk-height-medium uk-flex uk-flex-middle uk-flex-center" href="/images/gallery/<?=$gallery['image']?>">
                                <img src="/images/gallery/<?=$gallery['image']?>" style="max-height:100%; max-width:100%" />
                            </a>
                        </div>
                        <div class="uk-position-medium uk-position-top-right">
                            <form action="/office/gallery/delete" method="post">
                                <?= csrf_field() ?>
                                <input name="id" value="<?=$gallery['id']?>" hidden />
                                <button class="uk-icon-button uk-button-danger" type="submit" uk-icon="trash"></button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- Pagination Bottom -->
        <div class="uk-flex uk-flex-right uk-margin">
            <?= $pager->links('galleries', 'uikit_full') ?>
        </div>
        <!-- New Photo Modal -->
        <div id="new-photo" class="uk-flex-top" uk-modal="bg-close:false;">
            <div class="uk-modal-dialog uk-margin-auto-vertical">
                <button class="uk-modal-close-outside uk-icon-button uk-button-primary" type="button" uk-close></button>
                <div class="uk-modal-body">
                    <div class="new-upload uk-placeholder uk-text-center">
                        <span uk-icon="icon:move; ratio:2;"></span><br/>
                        <span class="uk-text-middle">Tarik dan lepas file di sini atau</span>
                        <div uk-form-custom>
                            <input type="file" multiple>
                            <span class="uk-link">pilih satu/lebih</span>
                        </div>
                        <br/>
                        <span>Maks 1mb/file</span>
                    </div>
                    <progress id="new-progressbar" class="uk-progress" value="0" max="100" hidden></progress>                    
                </div>
            </div>
        </div>
        <script>
            var bar = document.getElementById('new-progressbar');
            UIkit.upload('.new-upload', {
                url: '/office/gallery/upload',
                multiple: true,
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
                    var filename = arguments[0].response.filename;
                    var id = arguments[0].response.id;
                    var imagecontainer = document.getElementById("gallery-container");

                    var grid = document.createElement('div');

                    var card = document.createElement('div');
                    card.setAttribute('class', 'uk-width-1-1 uk-card uk-card-default uk-card-hover uk-card-body uk-inline');

                    var lightbox = document.createElement('div');
                    lightbox.setAttribute('uk-lightbox', '');

                    var imagelink = document.createElement('a');
                    imagelink.setAttribute('class', 'uk-height-medium uk-flex uk-flex-middle uk-flex-center');
                    imagelink.setAttribute('href', '/images/gallery/'+filename);

                    var image = document.createElement('img');
                    image.setAttribute('src', '/images/gallery/'+filename);
                    image.setAttribute('style', 'max-height:100%; max-width:100%');

                    imagelink.appendChild(image);
                    lightbox.appendChild(imagelink);

                    var deletecontainer = document.createElement('div');
                    deletecontainer.setAttribute('class', 'uk-position-medium uk-position-top-right');

                    var deleteform = document.createElement('form');
                    deleteform.setAttribute('action', '/office/gallery/delete');
                    deleteform.setAttribute('method', 'post');

                    var csrf = document.createElement('input');
                    csrf.setAttribute('name', '<?= csrf_token() ?>');
                    csrf.setAttribute('value', '<?= csrf_hash() ?>');
                    csrf.setAttribute('hidden', '');

                    var inputid = document.createElement('input');
                    inputid.setAttribute('name', 'id');
                    inputid.setAttribute('value', id);
                    inputid.setAttribute('hidden', '');

                    var deletebutton = document.createElement('button');
                    deletebutton.setAttribute('type', 'submit');
                    deletebutton.setAttribute('class', 'uk-icon-button uk-button-danger');
                    deletebutton.setAttribute('uk-icon', 'trash');

                    deleteform.appendChild(csrf);
                    deleteform.appendChild(inputid);
                    deleteform.appendChild(deletebutton);

                    deletecontainer.appendChild(deleteform);

                    card.appendChild(lightbox);
                    card.appendChild(deletecontainer);

                    grid.appendChild(card);

                    imagecontainer.prepend(grid);
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
                    UIkit.modal('#new-photo').hide();
                }
            });
        </script>
    </div>
</section>
<?= $this->endSection() ?>