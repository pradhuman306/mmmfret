<?= $this->extend($config->viewLayout ?? 'Themes/Bootstrap5/AdminLayout/authLayout') ?>
<?= $this->section('content') ?>
<div class="text-center">
    <a href="<?=base_url() ?>">
        <img class="mb-4" src="<?= base_url('assets/logo.svg') ?>" alt="logo" width="72" height="57">
    </a>
    <h1 class="h1 mb-3 fw-bold"><?= config('Basics')->appName ?></h1>
    <h2 class="h4 mb-3 fw-normal"><?= lang('Auth.register') ?></h2>
</div>
<?= $this->include('Themes/_commonPartialsBs/_alertBoxes') ?>
<div class="text-center">
    <form action="<?= base_url(route_to('register')) ?>" method="post">
        <?= csrf_field() ?>
        <div class="form-floating">
            <input type="text" name="username" id="username"
                   class="form-control first-field <?= session('errors.username') ? 'is-invalid' : '' ?>"
                   placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
            <label for="username"><?= lang('Auth.username') ?></label>
            <div class="invalid-feedback">
                <?= session('errors.username') ?>
            </div>
        </div>
        <div class="form-floating">
            <input type="email" name="email" id="email"
                   class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
                   placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
            <label for="email"><?= lang('Auth.email') ?></label>
            <div class="invalid-feedback">
                <?= session('errors.email') ?>
            </div>
        </div>
        <div class="form-floating">
            <input type="password" name="password" id="password"
                   class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
                   placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
            <label for="password"><?= lang('Auth.password') ?></label>
            <div class="invalid-feedback">
                <?= session('errors.password') ?>
            </div>
        </div>
        <div class="form-floating">
            <input type="password" name="pass_confirm" id="passConfirm"
                   class="form-control last-field <?= session('errors.pass_confirm') ? 'is-invalid' : '' ?>"
                   placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
            <label for="passConfirm"><?= lang('Auth.repeatPassword') ?></label>
            <div class="invalid-feedback">
                <?= session('errors.pass_confirm') ?>
            </div>
        </div>

        <button type="submit" class="w-100 btn btn-lg btn-primary"><?= lang('Auth.register') ?></button>

    </form>
</div>
<p class="mb-1 mt-3">
    <?= lang('Auth.alreadyRegistered') ?>
    <a href="<?= base_url(route_to('login')) ?>" class="text-center">
        <?= lang('Auth.signIn') ?>
    </a>
</p>

<?= $this->endSection() ?>
