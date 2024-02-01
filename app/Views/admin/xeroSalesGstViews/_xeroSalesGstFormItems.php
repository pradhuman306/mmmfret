<?php
$uri = service('uri');
$isAddPage = strpos($uri->getPath(), 'add') !== false;
$isEditPage = strpos($uri->getPath(), 'edit') !== false;
use App\Libraries\create;
$JsLibrary = new create();
?>

<!-- Type -->

 			<div class="row">
            	<div class="col-md-12 col-lg-6 px-4">
					<div class="mb-3">
					<?= form_label(lang('XeroSalesGsts.type'), 'type', ['class' => 'form-label']); ?>
				<?= form_input(['name' => 'type', 'type' => 'text', 'id' => 'type', 'value' => $oldInput ? $oldInput['type']:($xeroSalesGst ? $xeroSalesGst->type:""), 'class' => 'form-control' . (($ferr = session('formErrors.type')) ? ' is-invalid' : ''), 'maxlength' => 120]); ?>
			<?php if ($ferr) { ?>
				<div class="invalid-feedback">
						<?= $ferr ?>
					</div>
				<?php } ?>
			</div><!--//.mb-3 -->

<!--Created  At -->	

			<div class="mb-3">
				<label for="createdAt" class="form-label">
						<?= lang('Created At') ?>
                	</label>
                    <?php
                    if ($isAddPage && isset($formatted_created_at)) {
                        $xeroSalesGst->created_at = $formatted_created_at;
                    }
                    ?>
                    <input type="datetime-local" id="createdAt" name="created_at" maxLength="20"
                        class="form-control-disabled<?= ($ferr = session('formErrors.created_at')) ? ' is-invalid' : '' ?>"
                        value="<?= old('created_at', $xeroSalesGst->created_at) ?>" readonly> 
                    <?php if ($ferr) { ?>
                        <div class="invalid-feedback">
                            <?= $ferr ?>
                        </div>
                    <?php } ?>
            </div><!--//.mb-3 -->				

<!-- Updated At -->                

			<div class="mb-3">
                <label for="updatedAt" class="form-label">
                    <?= lang('Updated At') ?>
				</label>
				<input type="datetime-local" id="updatedAt" name="updated_at" maxLength="20"
					class="form-control-disabled<?= ($ferr = session('formErrors.updated_at')) ? ' is-invalid' : '' ?>"
					value="<?= old('updated_at', $xeroSalesGst->formatted_updated_at ?? $xeroSalesGst->updated_at) ?>" readonly>
				<?php if ($ferr): ?>
					<div class="invalid-feedback">
						<?= $ferr ?>
					</div>
				<?php endif; ?>
			</div><!--//.mb-3 -->

<!-- Xero Code --> 

            </div><!--//.col -->
            	<div class="col-md-12 col-lg-6 px-4">
				<div class="mb-3">
					<?= form_label(lang('Xero Code'), 'xeroCode', ['class' => 'form-label']); ?>
					<?= form_input(['name' => 'xero_code', 'type' => 'text', 'id' => 'xeroCode', 'value' => $oldInput ? $oldInput['xero_code']:($xeroSalesGst ? $xeroSalesGst->xero_code:""), 'class' => 'form-control' . (($ferr = session('formErrors.xero_code')) ? ' is-invalid' : ''), 'maxlength' => 150]); ?>
					<?php if ($ferr) { ?>
						<div class="invalid-feedback">
							<?= $ferr ?>
					</div>
				<?php } ?>
			</div><!--//.mb-3 -->

<!-- Created By -->             

			<div class="mb-3">
                <label for="createdBy" class="form-label">
                    <?= lang('Created By') ?>
                </label>
                <input type="text" id="createdBy" name="created_by" maxLength="120"
                    class="form-control-disabled<?= ($ferr = session('formErrors.created_by')) ? ' is-invalid' : '' ?>"
                    value="<?= $isAddPage ? $loggedInUsername : old('created_by', $xeroSalesGst->created_by) ?>" readonly>
                <?php if ($ferr) { ?>
                    <div class="invalid-feedback">
                        <?= $ferr ?>
                    </div>
                <?php } ?>
            </div><!--//.mb-3 -->

<!-- Updated By --> 

			<div class="mb-3">
                	<label for="updatedBy" class="form-label">
                		<?= lang('Updated By') ?>
                	</label>
                <input type="text" id="updatedBy" name="updated_by" maxLength="120"
                    class="form-control-disabled<?= ($ferr = session('formErrors.updated_by')) ? ' is-invalid' : '' ?>"
                    value="<?= $isEditPage ? $loggedInUsername : old('updated_by', $xeroSalesGst->updated_by) ?>" readonly>
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
