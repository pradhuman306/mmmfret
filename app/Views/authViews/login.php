<?= $this->extend($config->viewLayout ?? 'Themes/Bootstrap5/AdminLayout/authLayout') ?>
<?= $this->section('content') ?>
<div class="text-center">
    <a href="<?=base_url() ?>">
        <img class="mb-4" src="<?= base_url('assets/logo.svg') ?>" alt="logo" width="72" height="57">
    </a>
    <h1 class="h1 mb-3 fw-bold"><?= config('Basics')->appName ?></h1>
    <h2 class="h4 mb-3 fw-normal"><?= lang('Auth.loginTitle') ?></h2>
</div>
<?= $this->include('Themes/_commonPartialsBs/_alertBoxes') ?>
<div class="text-center">
    <form action="<?= base_url(route_to('login')) ?>" method="post">
        <?= csrf_field() ?>
        <?php if ($config->validFields === ['email']) { ?>
            <div class="form-floating">
                <input type="email" name="login" id="floatingInput"
                       class="form-control first-field <?= session('error.login') || session('errors.login') ? 'is-invalid' : '' ?>"
                       placeholder="<?= lang('Auth.email') ?>" value="<?= old('login') ?>" autocomplete="off">
                <label for="floatingInput"><?= lang('Auth.email') ?></label>
                <div class="invalid-feedback mt-1">
                    <?= session('errors.login') ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="form-floating">
                <input type="text" name="login" id="floatingInput"
                       class="form-control first-field <?= session('error.login') || session('errors.login') ? 'is-invalid' : '' ?>"
                       placeholder="<?= lang('Auth.emailOrUsername') ?>" value="<?= old('login') ?>" autocomplete="off">
                <label for="floatingInput"><?= lang('Auth.emailOrUsername') ?></label>
                <div class="invalid-feedback mt-1">
                    <?= session('errors.login') ?>
                </div>
            </div>
        <?php } ?>
        <div class="form-floating">
            <input type="password" name="password" id="floatingPassword"
                   class="form-control last-field <?= session('errors.password') ? 'is-invalid' : '' ?>"
                   placeholder="<?= lang('Auth.password') ?>">
            <label for="floatingPassword">Password</label>
            <div class="invalid-feedback mb-3" style="margin-top: -0.5em;">
                <?= session('errors.password') ?>
            </div>
        </div>

        <?php if ($config->allowRemembering) { ?>

            <div class="checkbox mb-3">
                <input type="checkbox" name="remember" id="remember" <?= old('remember') ? 'checked' : '' ?> >
                <label for="remember">
                    <?= lang('Auth.rememberMe') ?>
                </label>
            </div>

        <?php } ?>

        <button type="submit" class="w-100 btn btn-lg btn-primary"><?= lang('Auth.signIn') ?></button>

    </form>
</div>
<p class="mb-1 mt-3">
    <a href="<?= base_url(route_to('forgot')) ?>"><?= lang('Auth.forgotYourPassword') ?></a>
</p>
<?php if ($config->allowRegistration) { ?>
    <p class="mb-0">
        <a href="<?= base_url(route_to('register')) ?>" class="text-center"><?= lang('Auth.needAnAccount') ?></a>
    </p>
<?php } ?>

<?= $this->endSection() ?>
