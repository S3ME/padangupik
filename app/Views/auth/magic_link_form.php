<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.useMagicLink') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>
    <div class="uk-width-1-1 uk-width-1-3@m">
        <div class="uk-card uk-card-default">
            <div class="uk-card-header">
                <h1 class="uk-card-title uk-text-center"><?= lang('Auth.useMagicLink') ?></h1>
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
                <form class="uk-margin uk-form-stacked" action="<?= url_to('magic-link') ?>" method="post">
                    <?= csrf_field() ?>

                    <!-- Email -->
                    <div class="uk-margin uk-margin-remove-top">
                        <label class="uk-form-label" for="floatingEmailInput"><?= lang('Auth.email') ?></label>
                        <div class="uk-form-controls">
                            <input type="email" class="uk-input" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email', auth()->user()->email ?? null) ?>" required>
                        </div>
                    </div>
                    <!-- end of Email -->

                    <!-- Submit -->
                    <div class="uk-margin uk-margin-remove-bottom uk-text-center">
                        <button type="submit" class="uk-button uk-button-secondary uk-text-uppercase"><?= lang('Auth.send') ?></button>
                    </div>
                    <!-- end of Submit -->
                </form>
            </div>
            <div class="uk-card-footer">
                <a href="<?= url_to('login') ?>"><?= lang('Auth.backToLogin') ?></a>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>