<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>
    <div class="uk-width-1-1 uk-width-1-3@m">
        <div class="uk-card uk-card-default">
            <div class="uk-card-header">
                <h1 class="uk-card-title uk-text-center"><?= lang('Auth.login') ?></h1>
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
                <?php if (session('message') !== null) : ?>
                    <div class="uk-alert-success" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p><?= session('message') ?></p>
                    </div>
                <?php endif ?>
                <form class="uk-margin uk-form-stacked" action="<?= url_to('login') ?>" method="post">
                    <?= csrf_field() ?>
                    <!-- Email -->
                    <div class="uk-margin uk-margin-remove-top">
                        <label class="uk-form-label" for="floatingEmailInput"><?= lang('Auth.email') ?></label>
                        <div class="uk-form-controls">
                            <input type="email" class="uk-input" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                        </div>
                    </div>
                    <!-- end of Email -->
                    
                    <!-- Password -->
                    <div class="uk-margin">
                        <label class="uk-form-label" for="floatingPasswordInput"><?= lang('Auth.password') ?></label>
                        <div class="uk-form-controls">
                        <input type="password" class="uk-input" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>
                        </div>
                    </div>
                    <!-- end of Password -->

                    <!-- Remembering -->
                    <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                        <div class="uk-margin">
                            <label><input class="uk-checkbox" type="checkbox" name="remember" <?php if (old('remember')): ?> checked<?php endif ?>> <?= lang('Auth.rememberMe') ?></label>
                        </div>
                    <?php endif; ?>
                    <!-- end of Remembering -->

                    <!-- Submit -->
                    <div class="uk-margin uk-margin-remove-bottom uk-text-center">
                        <button type="submit" class="uk-button uk-button-primary uk-text-uppercase"><?= lang('Auth.login') ?></button>
                    </div>
                    <!-- end of Submit -->
                </form>
            </div>
            <?php if (setting('Auth.allowMagicLinkLogins') | setting('Auth.allowRegistration')) : ?>
                <div class="uk-card-footer">
                    <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                        <div class="uk-margin">
                            <?= lang('Auth.forgotPassword') ?> <a href="<?= url_to('magic-link') ?>"><?= lang('Auth.useMagicLink') ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if (setting('Auth.allowRegistration')) : ?>
                        <div class="uk-margin">
                            <?= lang('Auth.needAccount') ?> <a href="<?= url_to('register') ?>"><?= lang('Auth.register') ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?= $this->endSection() ?>