<?php

    $errorMessage = $errorMessage ?? session('errorMessage');
    $warningMessage = session('warningMessage');

    if (session()->has('message')) {
        $successMessage = session('message');
    }
    if (session()->has('error')) {
        $errorMessage = is_array(session('error')) ? implode(session('error')) : session('error');
    } /* // Uncomment this block if you want the errors listed line by line in the alert
    elseif (session()->has('errors')) {
        $errorMessage = '<ul class="text-start">';
        foreach (session('errors') as $error) :
            $errorMessage .= '<li>' . $error . '</li>';
        endforeach;
        $errorMessage .= '</ul>';
    }
    */
?>

<?php if (isset($successMessage) && $successMessage): ?>

<div class="alert alert-success" role="alert">
    <svg class="bi mt-1 me-3 float-start" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    <div>
        <h4><?=lang('Basic.global.Success')?>!</h4>
        <?= $successMessage; ?>
    </div>
    
</div>

<?php endif; ?>

<?php if (isset($errorMessage) && $errorMessage): ?>

<div class="alert alert-danger" role="alert">
    <svg class="bi mt-1 me-3 float-start" width="24" height="24" role="img" aria-label="Error:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    <div>
        <h4><?=lang('Basic.global.Error')?>!</h4>
        <?= $errorMessage; ?>
    </div>
</div>

<?php endif; ?>

<?php if (isset($warningMessage) && $warningMessage): ?>

<div class="alert alert-warning" role="alert">
    <svg class="bi mt-1 me-3 float-start" width="24" height="24" role="img" aria-label="Error:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    <div>
        <h4 class="text-start"><?=lang('Basic.global.Warning')?></h4>
        <?= $warningMessage ?>
    </div>
</div>

<?php endif; ?>