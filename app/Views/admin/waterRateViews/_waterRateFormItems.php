<?php
$uri = service('uri');
$isAddPage = strpos($uri->getPath(), 'add') !== false;
$isEditPage = strpos($uri->getPath(), 'edit') !== false;
use App\Libraries\create;
$JsLibrary = new create();
?>         

<!-- Rate --> 

		<div class="row">
            <div class="col-md-12 col-lg-6 px-4">
				<div class="mb-3">
					<label for="rate" class="form-label">
						<?=lang('WaterRates.rate') ?>
					</label>
						<input type="text" id="rate" name="rate" maxLength="31" 
						class="form-control<?= ($ferr = session('formErrors.rate')) ? ' is-invalid' : '' 
						?>" value="<?=old('rate', $waterRate->rate) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Created By --> 	

				<div class="mb-3">
                	<label for="createdBy" class="form-label">
					<?=lang('WaterRates.createdBy') ?>
                	</label>
                <input type="text" id="createdBy" name="created_by" maxLength="120"
                    class="form-control-disabled<?= ($ferr = session('formErrors.created_by')) ? ' is-invalid' : '' ?>"
                    value="<?= $isAddPage ? $loggedInUsername : old('created_by', $waterRate->created_by) ?>" readonly>
                <?php if ($ferr) { ?>
                    <div class="invalid-feedback">
                        <?= $ferr ?>
                    	</div>
                	<?php } ?>
            	</div><!--//.mb-3 -->

<!-- Updated By -->					

				<div class="mb-3">
                        <label for="updatedBy" class="form-label">
						<?=lang('WaterRates.updatedBy') ?>
	                        </label>
                        <input type="text" id="updatedBy" name="updated_by" maxLength="120" 
						class="form-control-disabled<?= ($ferr = session('formErrors.updated_by')) ? ' is-invalid' : '' 
                        ?>" value="<?= $isEditPage ? $loggedInUsername : old('updated_by', $waterRate->updated_by) ?>" readonly>
                        <?php if ($ferr) { ?>
                            <div class="invalid-feedback">
                                <?= $ferr ?>
                            </div>
                        <?php } ?>
                </div><!--//.mb-3 -->	

<!-- Created At --> 	

            	</div><!--//.col -->
            		<div class="col-md-12 col-lg-6 px-4">
				<div class="mb-3">
                        <label for="createdAt" class="form-label">
						<?=lang('WaterRates.createdAt') ?>
                        </label>
                        <?php
                        if ($isAddPage && isset($formatted_created_at)) {
                            $category->created_at = $formatted_created_at;
                        }
                        ?>
                        <input type="datetime-local" id="createdAt" name="created_at" maxLength="20" 
						class="form-control-disabled<?= ($ferr = session('formErrors.created_at')) ? ' is-invalid' : ''
                        ?>" value="<?= old('created_at', $waterRate->created_at) ?>" readonly>
                        <?php if ($ferr) { ?>
                            <div class="invalid-feedback">
                                <?= $ferr ?>
                            </div>
                        <?php } ?>
                </div><!--//.mb-3 -->

<!-- Updated At -->

				<div class="mb-3">
                	<label for="updatedAt" class="form-label">
					<?=lang('WaterRates.updatedAt') ?>
                	</label>
                <input type="datetime-local" id="updatedAt" name="updated_at" maxLength="20"
                    class="form-control-disabled<?= ($ferr = session('formErrors.updated_at')) ? ' is-invalid' : '' ?>"
                    value="<?= old('updated_at', $category->formatted_updated_at ?? $waterRate->updated_at) ?>" readonly>
                <?php if ($ferr): ?>
                    <div class="invalid-feedback">
                        <?= $ferr ?>
                    </div>
                <?php endif; ?>
            	</div><!--//.mb-3 -->

            </div><!--//.col -->
        </div><!-- //.row -->

	<?php 
		echo json_decode($JsLibrary->index());
	?>			