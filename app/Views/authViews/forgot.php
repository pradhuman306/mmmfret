<?= $this->extend($config->viewLayout ?? 'Themes/Bootstrap5/AdminLayout/authLayout') ?>
<?= $this->section('content') ?>

    <div class="text-center">
        <img class="mb-4" src="<?= base_url('assets/logo.svg') ?>" alt="logo" width="72" height="57">
        <h1 class="h1 mb-3 fw-normal"><?= config('Basics')->appName ?></h1>
        <h3 class="h4 mb-3 fw-normal"><?= lang('Auth.forgotPassword') ?></h3>
        <p class="login-box-msg"><?= lang('Auth.enterEmailForInstructions') ?></p>
    </div>
<?= $this->include('Themes/_commonPartialsBs/_alertBoxes') ?>
    <div class="text-center">
        <form action="<?= route_to('forgot') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-floating">
                <input type="email" name="email" required
                       class="form-control only-field <?= session('errors.email') ? 'is-invalid' : '' ?>"
                       placeholder="<?= lang('Auth.email') ?>">
                <label for="email"><?= lang('Auth.email') ?></label>
                <div class="invalid-feedback">
                    <?= session('errors.email') ?>
                </div>
            </div>

            <button type="submit"
                    class="w-100 btn btn-lg btn-primary"><?= lang('Auth.sendInstructions') ?></button>

        </form>
    </div>

    <p class="mt-3 mb-1">
        <a href="<?= base_url(route_to('login')) ?>"><?= lang('Auth.signIn') ?></a>
    </p>
<?php if ($config->allowRegistration) { ?>
    <p class="mb-0">
        <a href="<?= base_url(route_to('register')) ?>" class="text-center"><?= lang('Auth.needAnAccount') ?></a>
    </p>
<?php } ?>

<?= $this->endSection() ?>