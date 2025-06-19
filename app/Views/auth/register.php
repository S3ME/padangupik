<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.register') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>
    <div class="uk-width-1-1 uk-width-1-3@m">
        <div class="uk-card uk-card-default">
            <div class="uk-card-header">
                <h1 class="uk-card-title uk-text-center"><?= lang('Auth.register') ?></h1>
            </div>
            <div class="uk-card-body">
                <?php if (session('error') !== null) : ?>
                    <div class="uk-alert-danger" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p><?= session('error') ?></p>
                    </div>
                <?php elseif (session('errors') !== null) : ?>
                    <div class="uk-alert-danger" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <?php if (is_array(session('errors'))) : ?>
                            <ul class="uk-list">
                                <?php foreach (session('errors') as $error) : ?>
                                    <li><?= $error ?></li>
                                <?php endforeach ?>
                            </ul>
                        <?php else : ?>
                            <p><?= session('errors') ?></p>
                        <?php endif ?>
                    </div>
                <?php endif ?>
                <form class="uk-margin uk-form-stacked" action="<?= url_to('register') ?>" method="post">
                    <?= csrf_field() ?>

                    <!-- Email -->
                    <div class="uk-margin uk-margin-remove-top">
                        <label class="uk-form-label" for="floatingEmailInput"><?= lang('Auth.email') ?></label>
                        <div class="uk-form-controls">
                            <input type="email" class="uk-input" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                        </div>
                    </div>
                    <!-- end of Email -->
                    
                    <!-- Username -->
                    <div class="uk-margin uk-margin-large-bottom">
                        <label class="uk-form-label" for="floatingUsernameInput"><?= lang('Auth.username') ?></label>
                        <div class="uk-form-controls">
                            <input type="text" class="uk-input" id="floatingUsernameInput" name="username" inputmode="text" autocomplete="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required>
                        </div>
                    </div>
                    <!-- end of Username -->
                    
                    <!-- Password -->
                    <div class="uk-margin">
                        <label class="uk-form-label" for="floatingPasswordInput"><?= lang('Auth.password') ?></label>
                        <div class="uk-form-controls">
                            <input type="password" class="uk-input" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required>
                        </div>
                    </div>
                    <!-- end of Passwrd -->
                    
                    <!-- Password (Again) -->
                    <div class="uk-margin">
                        <label class="uk-form-label" for="floatingPasswordConfirmInput"><?= lang('Auth.passwordConfirm') ?></label>
                        <div class="uk-form-controls">
                            <input type="password" class="uk-input" id="floatingPasswordConfirmInput" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" required>
                        </div>
                    </div>
                    <!-- end of Passwrd (Again) -->

                    <!-- Submit -->
                    <div class="uk-margin uk-margin-remove-bottom uk-text-center">
                        <button type="submit" class="uk-button uk-button-secondary uk-text-uppercase"><?= lang('Auth.register') ?></button>
                    </div>
                    <!-- end of Submit -->
                </form>
            </div>
            <div class="uk-card-footer">
                <?= lang('Auth.haveAccount') ?> <a href="<?= url_to('login') ?>"><?= lang('Auth.login') ?></a>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>