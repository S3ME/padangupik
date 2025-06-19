<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.useMagicLink') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>
    <div class="uk-width-1-1 uk-width-1-3@m">
        <div class="uk-card uk-card-default">
            <div class="uk-card-header">
                <h1 class="uk-card-title uk-text-center"><?= lang('Auth.useMagicLink') ?></h1>
            </div>
            <div class="uk-card-body">
                <p><b><?= lang('Auth.checkYourEmail') ?></b></p>
                <p><?= lang('Auth.magicLinkDetails', [setting('Auth.magicLinkLifetime') / 60]) ?></p>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>