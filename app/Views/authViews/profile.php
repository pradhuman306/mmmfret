<?= $this->extend($config->viewLayout ?? 'Themes/Bootstrap5/AdminLayout/defaultLayout') ?>
<?= $this->section('content') ?>

    <div class="card card-outline card-primary">

        <div class="card-header text-center">
            <h2 class="h3"><?=lang('Basic.global.UserProfile') ?></h2>
        </div>

        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid rounded-circle img-thumbnail"
                     src="<?= $userPic ?>"
                     alt="<?=lang('Basic.global.UserProfile').' '.lang('Users.picture') ?>">
            </div>

            <h3 class="h4 profile-username text-center"><?= $userName ?></h3>
            <p class="text-muted text-center"><?= lang('Basic.global.MemberSince') ?> <?= $joinDate ?></p>

            <?= !empty($validation->getErrors()) ? $validation->listErrors("bootstrap_style") : view("Themes/_commonPartialsBs/_alertBoxes") ?>

            <form action="<?= base_url(route_to('user-profile')) ?>" method="post">

                <div class="row g-3">
                    <div class="col-md">

                        <div class="form-floating mb-3">
                            <input type="text" id="userName" name="username"
                                   class="form-control <?= session('error.username') ? 'is-invalid' : '' ?>"
                                   value="<?= user()->username ?>" placeholder="<?= lang('users.username') ?>">
                            <label for="userName"><?= lang('Users.username') ?></label>
                            <div class="invalid-feedback">
                                <?= session('error.username') ?>
                            </div>
                        </div><!-- //.form-floating -->

                        <div class="form-floating mb-3">
                            <input type="text" id="firstName" name="first_name"
                                   class="form-control <?= session('error.first_name') ? 'is-invalid' : '' ?>"
                                   placeholder="<?= lang('Users.firstName') ?>" value="<?= $firstName ?>">
                            <label for="firstName"><?= lang('Users.firstName') ?></label>
                            <div class="invalid-feedback">
                                <?= session('error.first_name') ?>
                            </div>
                        </div><!-- //.form-floating -->

                    </div><!-- //.col-md -->

                    <div class="col-md">

                        <div class="form-floating mb-3">
                            <input type="email" id="email" name="email"
                                   class="form-control <?= session('error.email') ? 'is-invalid' : '' ?>"
                                   value="<?= user()->email ?>" placeholder="<?= lang('Auth.email') ?>">
                            <label for="email"><?= lang('Auth.email') ?></label>
                            <div class="invalid-feedback">
                                <?= session('error.email') ?>
                            </div>
                        </div><!-- //.form-floating -->

                        <div class="form-floating mb-3">
                            <input type="text" id="lastName" name="last_name"
                                   class="form-control <?= session('error.first_name') ? 'is-invalid' : '' ?>"
                                   placeholder="Last name" value="<?= $lastName ?>">
                            <label for="lastName"><?= lang('Users.lastName') ?></label>
                            <div class="invalid-feedback">
                                <?= session('error.last_name') ?>
                            </div>
                        </div><!-- //.form-floating -->

                        <div class="form-floating mb-3">
                        </div><!-- //.form-floating -->

                    </div><!-- //.col-md -->
                </div><!-- //.row -->

                <?= csrf_field() ?>

                <div class="accordion mb-4" id="changePasswordAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <?= lang('Basic.global.ChangePassword') ?>?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#changePasswordAccordion">
                            <div class="accordion-body">
                                <div class="row g-3">
                                    <div class="col-md">
                                        <div class="form-floating mb-3">
                                            <input type="password" name="password"
                                                   class="form-control <?= session('error.password') ? 'is-invalid' : '' ?>"
                                                   placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                                            <label for="password"><?= lang('Auth.password') ?></label>
                                            <div class="invalid-feedback">
                                                <?= session('error.password') ?>
                                            </div>
                                        </div><!-- //.form-floating -->
                                    </div><!-- //.col-md -->

                                    <div class="col-md">
                                        <div class="form-floating mb-3">
                                            <input type="password" id="confirmPassword" name="pass_confirm"
                                                   class="form-control <?= session('error.pass_confirm') ? 'is-invalid' : '' ?>"
                                                   placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                                            <label for="confirmPassword"><?= lang('Auth.repeatPassword') ?></label>
                                            <div class="invalid-feedback">
                                                <?= session('error.pass_confirm') ?>
                                            </div>
                                        </div><!-- //.form-floating -->
                                    </div><!-- //.col-md -->
                                </div><!-- //.row -->
                            </div><!-- //.accordion-body -->
                        </div><!-- //.accordion-collapse -->
                    </div><!-- //.accordion-item -->
                </div><!-- //.accordion -->

                <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" class="btn btn-primary btn-lg"><?= lang('Basic.global.Save') ?></button>
                        <?php /*
                        <a href="javascript:history.back()"
                           class="btn btn-default btn-block"><?= lang('Basic.global.Cancel') ?></a>
                        */ ?>
                </div><!-- //.d-grid gap-2 col-6  -->
            </form>

        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->

<?= $this->endSection() ?>