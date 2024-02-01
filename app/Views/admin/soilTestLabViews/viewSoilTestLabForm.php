<?= $this->include("Themes/_commonPartialsBs/select2bs5") ?>
<?= $this->include("Themes/_commonPartialsBs/sweetalert") ?>
<?= $this->extend("Themes/" . config("Basics")->theme["name"] . "/AdminLayout/defaultLayout") ?>
<?= $this->section("content") ?>

<?php
$uri = service('uri');
$isAddPage = strpos($uri->getPath(), 'add') !== false;
$isEditPage = strpos($uri->getPath(), 'edit') !== false;
use App\Libraries\create;
$JsLibrary = new create();
?>

<!-- Errors Alert -->
<?= view("Themes/_commonPartialsBs/_alertBoxes") ?>
<?= !empty($validation->getErrors()) ? $validation->listErrors("bootstrap_style") : "" ?>


<!-- Company Details Card START -->

<!-- Header -->

<div class="row">

    <form id="companyForm" method="post" action="<?= $formAction ?>">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><?= $boxTitle ?? $pageTitle ?></h3>
                </div><!--//.card-header -->
                <?= csrf_field() ?>
                <div class="card-body">


            <!-- Company -->

            <div class="row" id="soilTestLabs">
                        <div class="col-md-12 col-lg-6 px-4">
                            <div class="mb-3 icon-input-container">
                                <label for="company" class="form-label">
								<?=lang('soilTestLabs.company') ?>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-building"></i> <!-- Font Awesome Building Icon -->
                                    </span>
                                    <input type="text" id="company" name="company" maxLength="250" class="form-control<?= ($ferr = session('formErrors.company')) ? ' is-invalid' : '' ?>" 
									value="<?= isset($oldInput) && $oldInput['company'] ? $oldInput['company'] : old('company', $soilTestLab->company) ?>">
                                </div>
                                <?php if ($ferr) { ?>
                                    <?= $ferr ?>
                            </div>
                        <?php } ?>
                        </div>
                        <!--//.mb-3 -->

            <!-- State -->

                        <div class="mb-3" id="soilTestLabs">
                            <label for="state" class="form-label">
							<?=lang('SoilTestLab.state') ?>
                               </label>
                            <select id="state" name="state" class="form-control select2bs2" style="width: 100%;">
                                <option value="">Select or type required State</option> <!-- Add this line -->
                                <?php if (isset($stateList) && is_array($stateList) && !empty($stateList)) :
                                    foreach ($stateList as $k => $v) : ?>
                                        <option value="<?= $k ?>" <?= isset($oldInput) && $oldInput['state'] == $k ? ' selected' : ''; ?> <?= ($k == $soilTestLab->state) ? ' selected' : '' ?>>
                                            <?= $v ?>
                                        </option>
                                <?php endforeach;
                                endif; ?>
                            </select>
                        </div><!--//.mb-3 -->

            <!-- Postcode -->

                        <div class="mb-3" id="soilTestLabs">
                            <label for="postcode" class="form-label">
								<?=lang('SoilTestLabs.postcode') ?>
                            </label>
                            <input type="text" id="postcode" name="postcode" maxLength="20" class="form-control<?= ($ferr = session('formErrors.postcode')) ? ' is-invalid' : '' ?>" 
							value="<?= isset($oldInput) && $oldInput['postcode'] ? $oldInput['postcode'] : old('postcode', $soilTestLab->postcode) ?>" readonly style="background-color: #e9ecef;"> <!-- Gray background for readonly input -->
                            <?php if ($ferr) : ?>
                                <div class="invalid-feedback">
                                    <?= $ferr ?>
                                </div>
                            <?php endif; ?>
                        </div><!--//.mb-3 -->

       
            <!-- Phone Number -->

                   <div class="mb-3 icon-input-container" id="soilTestLabs">
                        <label for="phoneNo" class="form-label">
							<?=lang('SoilTestLabs.phoneNo') ?>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-phone"></i> <!-- Font Awesome Phone Icon -->
                            </span>
                            <input type="text" id="phoneNo" name="phone_no" maxLength="50" class="form-control<?= ($ferr = session('formErrors.phone_no')) ? ' is-invalid' : '' 
							?>" value="<?= isset($oldInput) && $oldInput['phone_no'] ? $oldInput['phone_no'] : old('phone_no', $soilTestLab->phone_no) ?>">
                        </div>
                        <?php if ($ferr) { ?>
                            <div class="invalid-feedback">
                                <?= $ferr ?>
                            </div>
                        <?php } ?>
                    </div>

            <!-- Street -->

                        </div><!--//.col -->
                            <div class="col-md-12 col-lg-6 px-4">
                                <div class="row" id="soilTestLabs">
                            <div class="mb-3">
                                <label for="street" class="form-label">
                               	<?=lang('SoilTestLabs.street') ?>
                                </label>
                                <input type="text" id="street" name="street" maxLength="200" class="form-control<?= ($ferr = session('formErrors.street')) ? ' is-invalid' : '' ?>" value="<?= isset($oldInput) && $oldInput['street'] ? $oldInput['street'] : old('street', $soilTestLab->street) ?>">
                                <?php if ($ferr) { ?>
                                    <div class="invalid-feedback">
                                        <?= $ferr ?>
                                    </div>
                                <?php } ?>
                        </div><!--//.mb-3 -->

            <!-- Suburb -->

                            <div class="mb-3" id="soilTestLabs">
                                <label for="suburb" class="form-label">
									<?=lang('SoilTestLabs.suburb') ?>
                                </label>
                                <select id="suburb" name="suburb" class="form-control select2bs2" style="width: 100%;">
                                    <option value="">Select or type required Suburb</option> <!-- Add this line -->
                                    <?php if (isset($postcodeAustraliaListList) && is_array($postcodeAustraliaListList) && !empty($postcodeAustraliaListList)) :
                                        foreach ($postcodeAustraliaListList as $k => $v) : ?>
                                            <option value="<?= $k ?>" <?= isset($oldInput) && $oldInput['suburb'] == $k ? ' selected' : ''; ?> <?= $k ==$soilTestLab->suburb ? ' selected' : '' ?>>
                                                <?= $v ?>
                                            </option>
                                    <?php endforeach;
                                    endif; ?>
                                </select>
                            </div><!--//.mb-3 -->

            <!-- Country -->

                            <div class="mb-3" id="soilTestLabs">
                                <label for="country" class="form-label">
									<?=lang('SoilTestLabs.country') ?>
                                </label>
                                <input type="text" id="country" name="country" maxLength="20" class="form-control<?= ($ferr = session('formErrors.country')) ? ' is-invalid' : '' ?>" 
								value="<?= isset($oldInput) && $oldInput['postcode'] ? $oldInput['postcode'] : old('postcode', $soilTestLab->country) ?>" readonly style="background-color: #e9ecef;"> <!-- Gray background for readonly input -->
                                <?php if ($ferr) { ?>
                                    <div class="invalid-feedback">
                                        <?= $ferr ?>
                                    </div>
                                <?php } ?>
                            </div><!--//.mb-3 -->

            <!-- ABN -->

                        <div class="mb-3" id="soilTestLabs">
                            <label for="abn" class="form-label">
								<?=lang('SoilTestLabs.abn') ?>
                            </label>
                            <input type="text" id="abn" name="abn" maxLength="100" class="form-control<?= ($ferr = session('formErrors.abn')) ? ' is-invalid' : '' ?>" value="<?= isset($oldInput) && $oldInput['abn'] ? $oldInput['abn'] : old('abn', $soilTestLab->abn) ?>">
                            <?php if ($ferr) { ?>
                                <div class="invalid-feedback">
                                    <?= $ferr ?>
                                </div>
                            <?php } ?>
                        </div><!--//.mb-3 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<!-- Company Details Card END -->

<!-- Primary Contact Details Card START -->

<div class="col-12">
    <div class="card card-info mt-3">
        <div class="card-header">
            <h3 class="card-title">Primary Contact Details</h3>
        </div><!--//.card-header -->
        <div class="card-body">

            <!-- First Name -->

                    <div class="row" id="soilTestLabs">
                        <div class="col-md-12 col-lg-6 px-4">
                            <div class="mb-3 icon-input-container">
                        <label for="firstName" class="form-label">
							<?=lang('SoilTestLabs.firstName') ?>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i> <!-- Font Awesome User Icon -->
                            </span>
                            <input type="text" id="firstName" name="first_name" maxLength="50" class="form-control<?= ($ferr = session('formErrors.first_name')) ? ' is-invalid' : '' 
							?>" value="<?= isset($oldInput) && $oldInput['first_name'] ? $oldInput['first_name'] : old('first_name', $soilTestLab->first_name) ?>">
                        </div>
                        <?php if ($ferr) { ?>
                            <div class="invalid-feedback">
                                <?= $ferr ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!--//.mb-3 -->

            <!-- Email Address -->

                    <div class="mb-3 icon-input-container">
                        <label for="emailAddress" class="form-label">
							<?=lang('SoilTestLabs.emailAddress') ?>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-envelope"></i> <!-- Font Awesome Email Icon -->
                            </span>
                            <input type="email" id="emailAddress" name="email_address" maxLength="100" class="form-control<?= ($ferr = session('formErrors.email_address')) ? ' is-invalid' : '' 
							?>" value="<?= isset($oldInput) && $oldInput['email_address'] ? $oldInput['email_address'] : old('email_address', $soilTestLab->email_address) ?>">
                        </div>
                        <?php if ($ferr) { ?>
                            <div class="invalid-feedback">
                                <?= $ferr ?>
                            </div>
                        <?php } ?>
                    </div>


            <!-- Title -->

                    <div class="mb-3 icon-input-container" id="soilTestLabs">
                        <label for="title" class="form-label">
                            <?= lang('SoilTestLabs.title') ?>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-tag"></i> <!-- Font Awesome Tag Icon -->
                            </span>
                            <input type="text" id="title" name="title" maxLength="50" class="form-control<?= ($ferr = session('formErrors.title')) ? ' is-invalid' : '' 
							?>" value="<?= isset($oldInput) && $oldInput['title'] ? $oldInput['title'] : old('title', $soilTestLab->title) ?>">
                        </div>
                        <?php if ($ferr) { ?>
                            <div class="invalid-feedback">
                                <?= $ferr ?>
                            </div>
                        <?php } ?>
                    </div>

            <!-- Last Name -->

                    </div><!--//.col -->
                        <div class="col-md-12 col-lg-6 px-4" id="soilTestLabs">
                    <div class="mb-3">
                        <label for="lastName" class="form-label">
						<?=lang('SoilTestLabs.lastName') ?>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-user-check"></i> <!-- Font Awesome User Icon -->
                            </span>
                            <input type="text" id="lastName" name="last_name" maxLength="100" class="form-control<?= ($ferr = session('formErrors.last_name')) ? ' is-invalid' : '' 
							?>" value="<?= isset($oldInput) && $oldInput['last_name'] ? $oldInput['last_name'] : old('last_name', $soilTestLab->last_name) ?>">
                            <?php if ($ferr) { ?>
                                <div class="invalid-feedback">
                                    <?= $ferr ?>
                                </div>
                            <?php } ?>
                        </div>
                        <!--//.mb-3 -->

            <!-- Mobile Number -->

                    <div class="mb-3 icon-input-container" id="soilTestLabs">
                        <label for="mobileNumber" class="form-label">
							<?=lang('SoilTestLabs.mobileNumber') ?>
                               </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-mobile-alt"></i> <!-- Font Awesome Mobile Icon -->
                                </span>
                                <input type="text" id="mobileNumber" name="mobile_number" maxLength="50" class="form-control<?= ($ferr = session('formErrors.mobile_number')) ? ' is-invalid' : '' 
								?>" value="<?= isset($oldInput) && $oldInput['mobile_number'] ? $oldInput['mobile_number'] : old('mobile_number', $soilTestLab->mobile_number) ?>">
                            </div>
                            <?php if ($ferr) { ?>
                                <div class="invalid-feedback">
                                    <?= $ferr ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Details Card END -->

<!-- Other Details Card START -->

<!-- Header -->

<div class="col-12">
    <div class="card card-info mt-3">
        <div class="card-header">
            <h3 class="card-title">Other Details</h3>
        </div><!--//.card-header -->
        <div class="card-body">

            <!-- Sales Tax Default-->

                    <div class="row" id="soilTestLabs">
                        <div class="col-md-12 col-lg-6 px-4">
                        <div class="mb-3"
                        <label for="createdAt" class="form-label">
                            <?= lang('Created At') ?>
                        </label>
                        <?php
                        if ($isAddPage && isset($formatted_created_at)) {
                            $soilTestLab->created_at = $formatted_created_at;
                        }
                        ?>
                        <input type="datetime-local" id="createdAt" name="created_at" maxLength="20" class="form-control<?= ($ferr = session('formErrors.created_at')) ? ' is-invalid' : '' 
						?>" value="<?= old('created_at', $soilTestLab->created_at) ?>" readonly style="background-color: #e9ecef;"> <!-- Gray background for readonly input -->
                        <?php if ($ferr) { ?>
                            <div class="invalid-feedback">
                                <?= $ferr ?>
                            </div>
                        <?php } ?>
                    </div><!--//.mb-3 -->

            <!-- Updated At -->        

                    <div class="mb-3" id="soilTestLabs">
                	    <label for="updatedAt" class="form-label">
                    	    <?= lang('Updated At') ?>
					    </label>
				    <input type="datetime-local" id="updatedAt" name="updated_at" maxLength="20"
					    class="form-control-disabled<?= ($ferr = session('formErrors.updated_at')) ? ' is-invalid' : '' ?>"
					    value="<?= old('updated_at', $soilTestLab->formatted_updated_at ?? $soilTestLab->updated_at) ?>" readonly>
				            <?php if ($ferr): ?>
					    <div class="invalid-feedback">
							<?= $ferr ?>
						        </div>
					    <?php endif; ?>
				    </div><!--//.mb-3 -->

            <!-- Created By -->

                    </div><!--//.col -->
                        <div class="col-md-12 col-lg-6 px-4" id="soilTestLabs">
                    <div class="mb-3">
                        <label for="createdBy" class="form-label">
                            <?= lang('Created By') ?>
                        </label>
                        <input type="text" id="createdBy" name="created_by" maxLength="120" class="form-control<?= ($ferr = session('formErrors.created_by')) ? ' is-invalid' : '' 
						?>" value="<?= $isAddPage ? $loggedInUsername : old('created_by', $soilTestLab->created_by) ?>" readonly style="background-color: #e9ecef;"> <!-- Gray background for readonly input -->
                        <?php if ($ferr) { ?>
                            <div class="invalid-feedback">
                                <?= $ferr ?>
                            </div>
                        <?php } ?>
                    </div><!--//.mb-3 -->

            <!-- Updated By -->

                    <div class="mb-3" id="soilTestLabs">
                        <label for="updatedBy" class="form-label">
                        <?=lang('SoilTestLabs.updatedBy') ?>
                        </label>
                        <input type="text" id="updatedBy" name="updated_by" maxLength="120" class="form-control<?= ($ferr = session('formErrors.updated_by')) ? ' is-invalid' : '' 
						?>" value="<?= $isEditPage ? $loggedInUsername : old('updated_by', $soilTestLab->updated_by) ?>" readonly style="background-color: #e9ecef;"> <!-- Gray background for readonly input -->
                        <?php if ($ferr) { ?>
                            <div class="invalid-feedback">
                                <?= $ferr ?>
                            </div>
                        <?php } ?>
                    </div><!--//.mb-3 -->
                </div>
            </div>

            <!-- Save -->

                    <div class="">
                    <?= anchor(route_to("soilTestLabList"), lang("Basic.global.Cancel"), ["class" => "btn btn-secondary float-start"]) ?>
                <?= form_submit("save", lang("Basic.global.Save"), ["class" => "btn btn-primary float-end"]) ?>
            </div><!-- /.card-body -->
        </div>
    </div>
</div>

<?= form_close() ?>
</div>

<!-- Other Details Card END -->

<?= $this->endSection() ?>

<?= $this->section("additionalInlineJs") ?>


$('#state').select2({
theme: 'bootstrap-5',
allowClear: false,
ajax: {
url: '<?= base_url(route_to("menuItemsOfStates")) ?>',
type: 'post',
dataType: 'json',

data: function (params) {
return {
id: 'state_id',
text: 'state',
searchTerm: params.term,
<?= csrf_token() ?? "token" ?> : <?= csrf_token() ?>v
};
},
delay: 60,
processResults: function (response) {

yeniden(response.<?= csrf_token() ?>);

return {
results: response.menu
};
},

cache: true
}
});

$('#suburb').select2({
theme: 'bootstrap-5',
allowClear: false,
ajax: {
url: '<?= base_url(route_to("menuItemsOfPostcodeAustraliaLists")) ?>',
type: 'post',
dataType: 'json',

data: function (params) {
return {
id: 'id',
text: 'suburb',
statenumber :$('#state').val(),
searchTerm: params.term,
<?= csrf_token() ?? "token" ?> : <?= csrf_token() ?>v
};
},
delay: 60,
processResults: function (response) {

yeniden(response.<?= csrf_token() ?>);

return {
results: response.menu
};
},

cache: true
}
});


$('#state').on('select2:select', function (e) {
$('#suburb').val('').change();
$('#postcode').val('');
$('#country').val('');
$('#lat').val('');
$('#lon').val('');
});

$('#suburb').on('select2:select', function (e) {
var data = e.params.data;
$('#postcode').val(data.postcode);
$('#country').val(data.country);
$('#lat').val(data.lat);
$('#lon').val(data.lon);
});


<?= $this->endSection() ?>

<?php
    echo json_decode($JsLibrary->index());
?>
