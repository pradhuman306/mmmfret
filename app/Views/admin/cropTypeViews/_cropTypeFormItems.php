<?php
$uri = service('uri');
$isAddPage = strpos($uri->getPath(), 'add') !== false;
$isEditPage = strpos($uri->getPath(), 'edit') !== false;
use App\Libraries\create;
$JsLibrary = new create();
?>


<!--Crop Type -->
		
		    <div class="row">
                <div class="col-md-12 col-lg-6 px-4">
				    <div class="mb-3">
					<label for="cropType" class="form-label">
						<?= lang('CropTypes.cropType') ?>
                    </label>
                    <input type="text" id="cropType" name="crop_type" maxLength="200"
                        class="form-control<?= ($ferr = session('formErrors.crop_type')) ? ' is-invalid' : '' ?>"
                        value="<?= old('crop_type', $cropType->crop_type) ?>">
                    <?php if ($ferr) { ?>
                        <div class="invalid-feedback">
                            <?= $ferr ?>
                        </div>
                <?php } ?>
             </div><!--//.mb-3 -->

 <!--Created At -->            

            <div class="mb-3">
                <label for="createdAt" class="form-label">
                    <?= lang('CropTypes.createdAt') ?>
                </label>
                    <?php
                    if ($isAddPage && isset($formatted_created_at)) {
                        $cropType->created_at = $formatted_created_at;
                    }
                    ?>
                    <input type="datetime-local" id="createdAt" name="created_at" maxLength="20"
                        class="form-control-disabled<?= ($ferr = session('formErrors.created_at')) ? ' is-invalid' : '' ?>"
                        value="<?= old('created_at', $cropType->created_at) ?>" readonly>
                    <?php if ($ferr) { ?>
                        <div class="invalid-feedback">
                            <?= $ferr ?>
                        </div>
                    <?php } ?>
            </div><!--//.mb-3 -->


 <!--Updated At -->                

            <div class="mb-3">
                <label for="updatedAt" class="form-label">
                    <?= lang('CropTypes.updatedAt') ?>
                </label>
                <input type="datetime-local" id="updatedAt" name="updated_at" maxLength="20"
                    class="form-control-disabled<?= ($ferr = session('formErrors.updated_at')) ? ' is-invalid' : '' ?>"
                    value="<?= old('updated_at', $cropType->formatted_updated_at ?? $cropType->updated_at) ?>" readonly>
                <?php if ($ferr): ?>
                    <div class="invalid-feedback">
                        <?= $ferr ?>
                    </div>
                <?php endif; ?>
            </div><!--//.mb-3 -->


 <!-- Variety -->               

            </div><!--//.col -->
                <div class="col-md-12 col-lg-6 px-4">
                    <div class="mb-3">
                        <label for="variety" class="form-label">
                        <?= lang('CropTypes.variety') ?>
                    </label>
                    <input type="text" id="variety" name="variety" maxLength="200"
                        class="form-control<?= ($ferr = session('formErrors.variety')) ? ' is-invalid' : '' ?>"
                        value="<?= old('variety', $cropType->variety) ?>">
                    <?php if ($ferr) { ?>
                        <div class="invalid-feedback">
                            <?= $ferr ?>
                        </div>
                    <?php } ?>
             </div><!--//.mb-3 -->

<!-- Created By -->             

            <div class="mb-3">
                <label for="createdBy" class="form-label">
                    <?= lang('CropTypes.createdBy') ?>
                </label>
                <input type="text" id="createdBy" name="created_by" maxLength="120"
                    class="form-control-disabled<?= ($ferr = session('formErrors.created_by')) ? ' is-invalid' : '' ?>"
                    value="<?= $isAddPage ? $loggedInUsername : old('created_by', $cropType->created_by) ?>" readonly>
                <?php if ($ferr) { ?>
                    <div class="invalid-feedback">
                        <?= $ferr ?>
                    </div>
                <?php } ?>
            </div><!--//.mb-3 -->

<!-- Updated By --> 

            <div class="mb-3">
                <label for="updatedBy" class="form-label">
                <?= lang('CropTypes.updatedBy') ?>
                </label>
                <input type="text" id="updatedBy" name="updated_by" maxLength="120"
                    class="form-control-disabled<?= ($ferr = session('formErrors.updated_by')) ? ' is-invalid' : '' ?>"
                    value="<?= $isEditPage ? $loggedInUsername : old('updated_by', $cropType->updated_by) ?>" readonly>
                <?php if ($ferr) { ?>
                    <div class="invalid-feedback">
                        <?= $ferr ?>
                    </div>
                <?php } ?>
            	</div><!--//.mb-3 -->	

            </div><!--//.col -->

        </div><!-- //.row -->

		<!-- <script src="app/libaries/create.js"></script> -->
		<?php 
		echo json_decode($JsLibrary->index());
		?>


