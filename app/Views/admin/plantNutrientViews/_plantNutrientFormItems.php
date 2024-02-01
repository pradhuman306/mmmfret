<?php
$uri = service('uri');
$isAddPage = strpos($uri->getPath(), 'add') !== false;
$isEditPage = strpos($uri->getPath(), 'edit') !== false;
use App\Libraries\create;
$JsLibrary = new create();
?>         

<!-- Element --> 	
		
		<div class="row">
            <div class="col-md-12 col-lg-6 px-4">
				<div class="mb-3">
					<label for="element" class="form-label">
						<?=lang('PlantNutrients.element') ?>
					</label>
						<input type="text" id="element" name="element" maxLength="300" 
						class="form-control<?= ($ferr = session('formErrors.element')) ? ' is-invalid' : '' ?>" 
						value="<?=old('element', $plantNutrient->element) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Order --> 				

				<div class="mb-3">
					<label for="order" class="form-label">
						<?=lang('PlantNutrients.order') ?>
					</label>
						<input type="text" id="order" name="order" maxLength="31" 
						class="form-control<?= ($ferr = session('formErrors.order')) ? ' is-invalid' : '' ?>" 
						value="<?=old('order', $plantNutrient->order) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Text Color --> 				

				<div class="mb-3">
					<label for="textColor" class="form-label">
						<?=lang('PlantNutrients.textColor') ?>
					</label>
						<input type="color" id="textColor" name="text_color" maxLength="7"
						class="form-control<?= ($ferr = session('formErrors.text_color')) ? ' is-invalid' : '' ?>" 
						value="<?=old('text_color', $plantNutrient->text_color) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Created By --> 		

				<div class="mb-3">
                	<label for="createdBy" class="form-label">
						<?=lang('PlantNutrients.createdBy') ?>
                	</label>
                <input type="text" id="createdBy" name="created_by" maxLength="120"
                    class="form-control-disabled<?= ($ferr = session('formErrors.created_by')) ? ' is-invalid' : '' ?>"
                    value="<?= $isAddPage ? $loggedInUsername : old('created_by', $plantNutrient->created_by) ?>" readonly>
                <?php if ($ferr) { ?>
                    <div class="invalid-feedback">
                        <?= $ferr ?>
                    	</div>
                	<?php } ?>
            	</div><!--//.mb-3 -->	

<!-- Updated At -->

				<div class="mb-3">
                <label for="updatedAt" class="form-label">
					<?=lang('PlantNutrients.updatedAt') ?>
                </label>
                <input type="datetime-local" id="updatedAt" name="updated_at" maxLength="20"
                    class="form-control-disabled<?= ($ferr = session('formErrors.updated_at')) ? ' is-invalid' : '' ?>"
                    value="<?= old('updated_at', $category->formatted_updated_at ?? $plantNutrient->updated_at) ?>" readonly>
                <?php if ($ferr): ?>
                    <div class="invalid-feedback">
                        <?= $ferr ?>
                    </div>
                <?php endif; ?>
            </div><!--//.mb-3 -->

<!-- Symbol --> 				

	            </div><!--//.col -->
    		        <div class="col-md-12 col-lg-6 px-4">
				<div class="mb-3">
					<label for="symbol" class="form-label">
						<?=lang('PlantNutrients.symbol') ?>
					</label>
						<input type="text" id="symbol" name="symbol" maxLength="20" 
						class="form-control<?= ($ferr = session('formErrors.symbol')) ? ' is-invalid' : '' ?>" 
						value="<?=old('symbol', $plantNutrient->symbol) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Background Color --> 

				<div class="mb-3">
					<label for="backgroundColor" class="form-label">
						<?=lang('PlantNutrients.backgroundColor') ?>
					</label>
						<input type="color" id="backgroundColor" name="background_color" maxLength="7"
						class="form-control<?= ($ferr = session('formErrors.background_color')) ? ' is-invalid' : '' ?>" 
						value="<?=old('background_color', $plantNutrient->background_color) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Created At --> 		

				<div class="mb-3">
                        <label for="createdAt" class="form-label">
						<?=lang('PlantNutrients.createdAt') ?>
                        </label>
                        <?php
                        if ($isAddPage && isset($formatted_created_at)) {
                            $category->created_at = $formatted_created_at;
                        }
                        ?>
                        <input type="datetime-local" id="createdAt" name="created_at" maxLength="20" 
						class="form-control-disabled<?= ($ferr = session('formErrors.created_at')) ? ' is-invalid' : ''
                        ?>" value="<?= old('created_at', $plantNutrient->created_at) ?>" readonly>
                        <?php if ($ferr) { ?>
                            <div class="invalid-feedback">
                                <?= $ferr ?>
                            </div>
                        <?php } ?>
                </div><!--//.mb-3 -->

<!-- Updated By --> 					

				<div class="mb-3">
                        <label for="updatedBy" class="form-label">
						<?=lang('PlantNutrients.updatedBy') ?>
	                        </label>
                        <input type="text" id="updatedBy" name="updated_by" maxLength="120" 
						class="form-control-disabled<?= ($ferr = session('formErrors.updated_by')) ? ' is-invalid' : '' 
                        ?>" value="<?= $isEditPage ? $loggedInUsername : old('updated_by', $plantNutrient->updated_by) ?>" readonly>
                        <?php if ($ferr) { ?>
                            <div class="invalid-feedback">
                                <?= $ferr ?>
                            </div>
                        <?php } ?>
                </div><!--//.mb-3 -->				
            </div><!--//.col -->
        </div><!-- //.row -->

	<?php 
		echo json_decode($JsLibrary->index());
	?>		