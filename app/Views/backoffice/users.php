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
                <h1 class="uk-h3 uk-heading-bullet uk-margin-remove"><?=$title;?></h1>
            </div>
            <div>
                <a class="uk-button uk-button-third" href="#new-user" uk-toggle>Tambah Pengguna</a>
            </div>
        </div>
        <!-- New User Modal -->
        <div id="new-user" class="uk-flex-top" uk-modal="bg-close:false;">
            <div class="uk-modal-dialog uk-margin-auto-vertical">
                <form class="uk-margin uk-form-stacked" action="/office/users/new" method="post">
                    <div class="uk-modal-body">
                        <?= csrf_field() ?>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="username">Username</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="username" name="username" type="text" placeholder="Username" value="<?=old('username')?>" required/>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="email">Email</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="email" name="email" type="email" placeholder="email@sample.com" value="<?=old('email')?>" required/>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="password">Password</label>
                            <div class="uk-width-1-1 uk-form-controls uk-inline">
                                <a id="password-reveal" class="uk-form-icon uk-form-icon-flip" uk-icon="eye-slash"></a>
                                <input class="uk-input" id="password" name="password" type="password" required/>
                            </div>
                            <script>
                                $("#password-reveal").click(function() {
                                    if ( $('#password').attr('type') == 'password' ) {
                                        $("#password-reveal").attr("uk-icon","eye");
                                        $("#password").attr("type","text");
                                    } else {
                                        $("#password-reveal").attr("uk-icon","eye-slash");
                                        $("#password").attr("type","password");
                                    }
                                });
                            </script>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="password-confirm">Konfirmasi Password</label>
                            <div class="uk-width-1-1 uk-form-controls uk-inline">
                            <a id="password-confirm-reveal" class="uk-form-icon uk-form-icon-flip" uk-icon="eye-slash"></a>
                                <input class="uk-input" id="password-confirm" name="password-confirm" type="password" required/>
                            </div>
                            <script>
                                $("#password-confirm-reveal").click(function() {
                                    if ( $('#password-confirm').attr('type') == 'password' ) {
                                        $("#password-confirm-reveal").attr("uk-icon","eye");
                                        $("#password-confirm").attr("type","text");
                                    } else {
                                        $("#password-confirm-reveal").attr("uk-icon","eye-slash");
                                        $("#password-confirm").attr("type","password");
                                    }
                                });
                            </script>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="role">Role</label>
                            <div class="uk-form-controls">
                                <select class="uk-select" id="role" name="role" required>
                                    <option value="user" <?= (old('role') == 'user') ? 'selected' : ''; ?>>User</option>
                                    <option value="admin" <?= (old('role') == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                    <option value="superadmin" <?= (old('role') == 'superadmin') ? 'selected' : ''; ?>>Superadmin</option>
                                </select>
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
        <!-- User Table -->
        <table class="uk-margin uk-table uk-table-divider uk-table-hover">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $list) { ?>
                    <tr>
                        <td><?=$list['username']?></td>
                        <td><?=$list['email']?></td>
                        <td><?=$list['role']?></td>
                        <td>
                            <div class="uk-child-width-auto uk-flex-center" uk-grid>
                                <div>
                                    <a href="#edit-<?= esc($list['id']) ?>" uk-toggle class="uk-icon-button uk-button-secondary" uk-tooltip="Edit" uk-icon="pencil" data-tooltip-color="secondary"></a>
                                </div>
                                <div>
                                    <a href="#delete-<?= esc($list['id']) ?>" uk-toggle class="uk-icon-button uk-button-danger" uk-tooltip="Hapus" uk-icon="trash" data-tooltip-color="primary"></a>
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
                <?php } ?>
            </tbody>
        </table>
        <!-- Edit & Delete Modal -->
        <?php foreach ($users as $list) { ?>
            <!-- Edit Modal -->
            <div id="edit-<?=$list['id']?>" class="uk-flex-top" uk-modal="bg-close:false;">
                <div class="uk-modal-dialog uk-margin-auto-vertical">
                    <form class="uk-margin uk-form-stacked" action="/office/users/edit/<?=$list['id']?>" method="post">
                        <div class="uk-modal-body">
                            <?= csrf_field() ?>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="username-<?=$list['id']?>">Username</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="username-<?=$list['id']?>" name="username" type="text" placeholder="Username" value="<?=$list['username']?>" required/>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="email-<?=$list['id']?>">Email</label>
                                <div class="uk-form-controls">
                                    <input class="uk-input" id="email-<?=$list['id']?>" name="email" type="email" placeholder="email@sample.com" value="<?=$list['email']?>" required/>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="role-<?=$list['id']?>">Role</label>
                                <div class="uk-form-controls">
                                    <select class="uk-select" id="role-<?=$list['id']?>" name="role" required>
                                        <option value="user" <?= ($list['role'] === 'user') ? 'selected' : ''; ?>>User</option>
                                        <option value="admin" <?= ($list['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                                        <option value="superadmin" <?= ($list['role'] === 'superadmin') ? 'selected' : ''; ?>>Superadmin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <a id="button-reveal-<?=$list['id']?>" class="uk-button uk-button-default" status="close">Ubah Password</a>
                            </div>
                            <div id="password-container-<?=$list['id']?>" hidden>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="password-<?=$list['id']?>">Password</label>
                                    <div class="uk-width-1-1 uk-form-controls uk-inline">
                                        <a id="password-reveal-<?=$list['id']?>" class="uk-form-icon uk-form-icon-flip" uk-icon="eye-slash"></a>
                                        <input class="uk-input" id="password-<?=$list['id']?>" name="password" type="password"/>
                                    </div>
                                    <script>
                                        $("#password-reveal-<?=$list['id']?>").click(function() {
                                            if ( $('#password-<?=$list['id']?>').attr('type') == 'password' ) {
                                                $("#password-reveal-<?=$list['id']?>").attr("uk-icon","eye");
                                                $("#password-<?=$list['id']?>").attr("type","text");
                                            } else {
                                                $("#password-reveal-<?=$list['id']?>").attr("uk-icon","eye-slash");
                                                $("#password-<?=$list['id']?>").attr("type","password");
                                            }
                                        });
                                    </script>
                                </div>
                                <div class="uk-margin">
                                    <label class="uk-form-label" for="password-confirm-<?=$list['id']?>">Konfirmasi Password</label>
                                    <div class="uk-width-1-1 uk-form-controls uk-inline">
                                    <a id="password-confirm-reveal-<?=$list['id']?>" class="uk-form-icon uk-form-icon-flip" uk-icon="eye-slash"></a>
                                        <input class="uk-input" id="password-confirm-<?=$list['id']?>" name="password-confirm" type="password"/>
                                    </div>
                                    <script>
                                        $("#password-confirm-reveal-<?=$list['id']?>").click(function() {
                                            if ( $('#password-confirm-<?=$list['id']?>').attr('type') == 'password' ) {
                                                $("#password-confirm-reveal-<?=$list['id']?>").attr("uk-icon","eye");
                                                $("#password-confirm-<?=$list['id']?>").attr("type","text");
                                            } else {
                                                $("#password-confirm-reveal-<?=$list['id']?>").attr("uk-icon","eye-slash");
                                                $("#password-confirm-<?=$list['id']?>").attr("type","password");
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                            <script>
                                $("#button-reveal-<?=$list['id']?>").click(function() {
                                    if ( $('#button-reveal-<?=$list['id']?>').attr('status') == 'close' ) {
                                        $("#button-reveal-<?=$list['id']?>").attr("status","open");
                                        $("#button-reveal-<?=$list['id']?>").text("Batal Ubah Password");
                                        $("#password-container-<?=$list['id']?>").removeAttr("hidden");
                                    } else {
                                        $("#button-reveal-<?=$list['id']?>").attr("status","close");
                                        $("#button-reveal-<?=$list['id']?>").text("Ubah Password");
                                        $("#password-container-<?=$list['id']?>").attr("hidden", "");
                                        $("#password-<?=$list['id']?>").val("");
                                        $("#password-confirm-<?=$list['id']?>").val("");
                                    }
                                });
                            </script>
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
            <!-- Delete Model -->
            <div id="delete-<?=$list['id']?>" class="uk-flex-top" uk-modal="bg-close:false;">
                <div class="uk-modal-dialog uk-margin-auto-vertical">
                    <div class="uk-modal-body">
                        <div class="uk-modal-title uk-text-center">Anda yakin akan menghapus<br/><b><?=$list['username']?></b>?</div>
                        <p class="uk-text-center">Dengan menghapus pengguna maka anda tidak dapat lagi menggunakan <b>username</b> dan <b>email</b> tersebut.</p>
                    </div>
                    <div class="uk-modal-footer">
                        <div class="uk-clild-width-auto uk-grid-small uk-flex-center" uk-grid>
                            <div>
                                <form class="uk-margin uk-form-stacked" action="/office/users/delete" method="post">
                                    <?= csrf_field() ?>
                                    <input id="user-id-<?=$list['id']?>" name="user-id" value="<?=$list['id']?>" hidden required />
                                    <button class="uk-button uk-button-primary" type="submit">Ya</button>
                                </form>
                            </div>
                            <div><a class="uk-button uk-button-third uk-modal-close">Tidak</a></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<?= $this->endSection() ?>