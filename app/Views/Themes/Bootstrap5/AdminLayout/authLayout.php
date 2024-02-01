<?php
?>
<!DOCTYPE html>
<html lang="<?= config('App')->defaultLocale ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
    <meta http-equiv="refresh" content="<?= config('Security')->expires ?>">

    <title><?= isset($pageTitle) ? $pageTitle . ' | ' : '' ?><?= config('Basics')->appName ?></title>

    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/bs5/signin.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Render additional css -->
    <?= $this->renderSection('css') ?>
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">

        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>

        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
    <main class="auth-form">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="col-left">
                    <?= $this->renderSection('content') ?>

                    <p class="mt-3 mb-3 text-muted text-center" style="font-size: small;">
                        &copy; <?= date('Y') ?> <a href="<?= config('Basics')->theme['footer']['orglink'] ?>">
                            <?= config('Basics')->theme['footer']['organization'] ?></a>. All rights reserved.
                        <!-- <br>
                        <?//= config('Basics')->appName ?> <?//= lang('Basic.global.createdWith') ?> -->
                    </p>
                </div>
            </div>
            <div class="col-md-9"></div>
        </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer></script>

    <?= $this->renderSection('additionalExternalJs') ?>

    <script type="module">
        var <?= csrf_token() ?? 'token' ?>v = '<?= csrf_hash() ?>';

        function yeniden(andac = null) {
            if (andac == null) {
                andac = <?= csrf_token() ?>v;
            } else {
                <?= csrf_token() ?>v = andac;
            }
            $('input[name="<?= csrf_token() ?>"]').val(andac);
            $('meta[name="<?= config('Security')->tokenName ?>"]').attr('content', andac)
            $.ajaxSetup({
                headers: {
                    '<?= config('Security')->headerName ?>': andac,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                <?= csrf_token() ?>: andac
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            <?= $this->renderSection('additionalInlineJs') ?>
        });
    </script>

</body>

</html>