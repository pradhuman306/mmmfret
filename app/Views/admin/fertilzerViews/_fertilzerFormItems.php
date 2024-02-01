<?php
$uri = service('uri');
$isAddPage = strpos($uri->getPath(), 'add') !== false;
$isEditPage = strpos($uri->getPath(), 'edit') !== false;

use App\Libraries\create;

$JsLibrary = new create();
?>		
		
<!-- Fertilzers --> 

		<div class="row">
            <div class="col-md-12 col-lg-6 px-4">
			<div class="mb-3">
					<label for="Product" class="form-label">
						<?=lang('Product') ?>
					</label>
						<input type="text" id="fertilzer" name="fertilzer" maxLength="250" 
						class="form-control<?= ($ferr = session('formErrors.fertilzer')) ? ' is-invalid' : '' ?>" 
						value="<?=old('fertilzer', $fertilzer->fertilzer) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Cost Per Unit Default -->	

				<div class="mb-3">
    				<label for="costUnitDefault" class="form-label">
        				<?= lang('Fertilzers.costUnitDefault') ?>
    				</label>
					<div class="input-group">
                        <span class="input-group-text">
                        <i class="fa fa-dollar-sign"></i> <!-- Font Awesome User Icon -->
                    </span>
    					<input type="number" id="costUnitDefault" name="cost_unit_default" step="0.01" 
						class="form-control<?= (session('formErrors.cost_unit_default') ? ' is-invalid' : '') ?>" 
						value="<?= number_format(old('cost_unit_default', $fertilzer->cost_unit_default), 2, '.', '') ?>">
					</div>
    					<?php if (session('formErrors.cost_unit_default')) { ?>
        					<div class="invalid-feedback">
            			<?= session('formErrors.cost_unit_default') ?>
        			</div>
    				<?php } ?>
				</div><!--//.mb-3 -->



<!-- Rate Per Litre -->

				<div class="mb-3">
					<label for="ratePerLitre" class="form-label">
						<?=lang('Fertilzers.ratePerLitre') ?>
					</label>
						<div class="input-group">
						<span class="input-group-text" style="background-color: #4c4cff; color: #ffffff;">L</span>
    					</span>
						<input type="number" id="ratePerLitre" name="rate_per_litre" maxLength="10" step="0.01" 
						class="form-control<?= ($ferr = session('formErrors.rate_per_litre')) ? ' is-invalid' : '' ?>" 
						value="<?=old('rate_per_litre', $fertilzer->rate_per_litre) ?>">
						</div>
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Units -->				

				<div class="mb-3">
					<label for="units" class="form-label">
						<?=lang('Fertilzers.units') ?>
					</label>
					<div class="input-group">
						<span class="input-group-text" style="background-color: #FFA500; color: #000000;">Qty</span>
    					</span>
						<input type="number" id="units" name="units" maxLength="10" step="0.01" 
						class="form-control<?= ($ferr = session('formErrors.units')) ? ' is-invalid' : '' ?>" 
						value="<?=old('units', $fertilzer->units) ?>">
						</div>
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Calcium -->				

				<div class="mb-3">
                    <label for="calcium" class="form-label">
                        <?=lang('Fertilzers.calcium') ?>
                    </label>
					<div class="input-group">
						<span class="input-group-text" style="background-color: #3DFF00; color: #ffffff;">CA</span>
    					</span>
                        <input type="number" id="calcium" name="calcium" maxLength="10" step="0.01" 
                        class="form-control<?= ($ferr = session('formErrors.calcium')) ? ' is-invalid' : '' ?>" 
                        value="<?=old('calcium', $fertilzer->calcium) ?>" placeholder="Please enter numbers and points only">
						</div>
                        <?php if ( $ferr ) { ?>
                            <div class="invalid-feedback">
                                <?= $ferr ?>
                            </div>
                        <?php } ?>
                </div><!--//.mb-3 -->

<!-- Nitrogen -->					

				<div class="mb-3">
					<label for="nitrogen" class="form-label">
						<?=lang('Fertilzers.nitrogen') ?>
					</label>
					<div class="input-group">
							<span class="input-group-text" style="background-color: #3050F8; color: #ffffff;">N</span>
    					</span>
							<input type="number" id="nitrogen" name="nitrogen" maxLength="10" step="0.01" 
							class="form-control<?= ($ferr = session('formErrors.nitrogen')) ? ' is-invalid' : '' ?>" 
							value="<?=old('nitrogen', $fertilzer->nitrogen) ?>" placeholder="Please enter numbers and points only">
						</div>
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Phosphorus -->				

				<div class="mb-3">
					<label for="phosphorus" class="form-label">
						<?=lang('Fertilzers.phosphorus') ?>
					</label>
					<div class="input-group">
						<span class="input-group-text" style="background-color: #FF8000; color: #ffffff;">P</span>
    					</span>
						<input type="number" id="phosphorus" name="phosphorus" maxLength="10" step="0.01" 
						class="form-control<?= ($ferr = session('formErrors.phosphorus')) ? ' is-invalid' : '' ?>" 
						value="<?=old('phosphorus', $fertilzer->phosphorus) ?>" placeholder="Please enter numbers and points only">
						</div>
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Potassium -->				

				<div class="mb-3">
					<label for="potassium" class="form-label">
						<?=lang('Fertilzers.potassium') ?>
					</label>
					<div class="input-group">
						<span class="input-group-text" style="background-color: #8F40D4; color: #000000;">K</span>
    					</span>
						<input type="number" id="potassium" name="potassium" maxLength="10" step="0.01" 
						class="form-control<?= ($ferr = session('formErrors.potassium')) ? ' is-invalid' : '' ?>" 
						value="<?=old('potassium', $fertilzer->potassium) ?>" placeholder="Please enter numbers and points only">
						</div>
						<?php if ( $ferr ) { ?>
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
                        $fertilzer->created_at = $formatted_created_at;
                    }
                    ?>
                    <input type="datetime-local" id="createdAt" name="created_at" maxLength="20"
                        class="form-control-disabled<?= ($ferr = session('formErrors.created_at')) ? ' is-invalid' : '' ?>"
                        value="<?= old('created_at', $fertilzer->created_at) ?>" readonly> <!-- Added readonly attribute here -->
                    <?php if ($ferr) { ?>
                        <div class="invalid-feedback">
                            <?= $ferr ?>
                        		</div>
                    	<?php } ?>
            	</div><!--//.mb-3 -->

<!-- Updated By -->					

					<div class="mb-3">
                	<label for="updatedBy" class="form-label">
						<?=lang('Fertilzers.updatedBy') ?>
                	</label>
                		<input type="text" id="updatedBy" name="updated_by" maxLength="120"
                    class="form-control-disabled<?= ($ferr = session('formErrors.updated_by')) ? ' is-invalid' : '' ?>"
                    value="<?= $isEditPage ? $loggedInUsername : old('updated_by', $fertilzer->updated_by) ?>" readonly>
                		<?php if ($ferr) { ?>
                    <div class="invalid-feedback">
                        <?= $ferr ?>
                    	</div>
                	<?php } ?>
	            	</div><!--//.mb-3 -->

<!-- Symbol -->				

            	</div><!--//.col -->
            		<div class="col-md-12 col-lg-6 px-4">
					<div class="mb-3">
					<label for="symbol" class="form-label">
						<?=lang('Fertilzers.symbol') ?>
					</label>
						<input type="text" id="symbol" name="symbol" maxLength="20" 
						class="form-control<?= ($ferr = session('formErrors.symbol')) ? ' is-invalid' : '' ?>" 
						value="<?=old('symbol', $fertilzer->symbol) ?>"> 
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Category -->				

				<div class="mb-3">
					<label for="category" class="form-label">
						<?=lang('Fertilzers.category') ?>
					</label>
							<select id="category" name="category" class="form-control select2bs2" style="width: 100%;" >

					<?php if ( isset($categoryList) && is_array($categoryList) && !empty($categoryList) ) :
						foreach ($categoryList as $k => $v) : ?>
							<option value="<?=$k ?>"<?=$k==$fertilzer->category ? ' selected':'' ?>>
								<?=$v ?>
							</option>
						<?php endforeach;
					endif; ?>
						</select>
				</div><!--//.mb-3 -->

<!-- Rate Per KG -->
				
				<div class="mb-3">
					<label for="ratePerKg" class="form-label">
						<?=lang('Fertilzers.ratePerKg') ?>
					</label>
						<div class="input-group">
							<span class="input-group-text" style="background-color: #ff0000; color: #ffffff;">KG</span>
    					</span>
						<input type="number" id="ratePerKg" name="rate_per_kg" maxLength="10" step="0.01" 
						class="form-control<?= ($ferr = session('formErrors.rate_per_kg')) ? ' is-invalid' : '' ?>" 
						value="<?=old('rate_per_kg', $fertilzer->rate_per_kg) ?>">
						</div>
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Sulfur -->				

				<div class="mb-3">
					<label for="sulfur" class="form-label">
						<?=lang('Fertilzers.sulfur') ?>
					</label>
					<div class="input-group">
						<span class="input-group-text" style="background-color: #FFFF30; color: #000000;">S</span>
    					</span>
						<input type="number" id="sulfur" name="sulfur" maxLength="10" step="0.01" 
						class="form-control<?= ($ferr = session('formErrors.sulfur')) ? ' is-invalid' : '' ?>" 
						value="<?=old('sulfur', $fertilzer->sulfur) ?>" placeholder="Please enter numbers and point only">
						</div>
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Magnesium -->				

				<div class="mb-3">
					<label for="magnesium" class="form-label">
						<?=lang('Fertilzers.magnesium') ?>
					</label>
					<div class="input-group">
						<span class="input-group-text" style="background-color: #8AFF00; color: #000000;">MG</span>
    					</span>
						<input type="number" id="magnesium" name="magnesium" maxLength="10" step="0.01" 
						class="form-control<?= ($ferr = session('formErrors.magnesium')) ? ' is-invalid' : '' ?>" 
						value="<?=old('magnesium', $fertilzer->magnesium) ?>" placeholder="Please enter numbers and points only">
						</div>
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Maganense -->				

				<div class="mb-3">
					<label for="maganense" class="form-label">
						<?=lang('Fertilzers.maganense') ?>
					</label>
					<div class="input-group">
						<span class="input-group-text" style="background-color: #9C7AC7; color: #ffffff;">MN</span>
    					</span>
						<input type="number" id="maganense" name="maganense" maxLength="10" step="0.01" 
						class="form-control<?= ($ferr = session('formErrors.maganense')) ? ' is-invalid' : '' ?>" 
						value="<?=old('maganense', $fertilzer->maganense) ?>" placeholder="Please enter numbers and points only">
						</div>
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Boron -->				

				<div class="mb-3">
					<label for="boron" class="form-label">
						<?=lang('Fertilzers.boron') ?>
					</label>
					<div class="input-group">
						<span class="input-group-text" style="background-color:  #FFB5B5; color: #000000;">B</span>
    					</span>
						<input type="number" id="boron" name="boron" maxLength="10" step="0.01" 
						class="form-control<?= ($ferr = session('formErrors.boron')) ? ' is-invalid' : '' ?>" 
						value="<?=old('boron', $fertilzer->boron) ?>" placeholder="Please enter numbers and points only">
						</div>
						<?php if ( $ferr ) { ?>
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
                    value="<?= $isAddPage ? $loggedInUsername : old('created_by', $fertilzer->created_by) ?>" readonly>
                <?php if ($ferr) { ?>
                    <div class="invalid-feedback">
                        <?= $ferr ?>
                        </div>
                    <?php } ?>
                </div><!--//.mb-3 -->

<!-- Updated At --> 					

				<div class="mb-3">
                	<label for="updatedAt" class="form-label">
						<?=lang('Fertilzers.updatedAt') ?>
					</label>
				<input type="datetime-local" id="updatedAt" name="updated_at" maxLength="20"
					class="form-control-disabled<?= ($ferr = session('formErrors.updated_at')) ? ' is-invalid' : '' ?>"
					value="<?= old('updated_at', $fertilzer->formatted_updated_at ?? $fertilzer->updated_at) ?>" readonly>
				<?php if ($ferr): ?>
					<div class="invalid-feedback">
							<?= $ferr ?>
						</div>
					<?php endif; ?>
				</div><!--//.mb-3 -->	
            		</div><!--//.col -->
        		</div><!-- //.row -->

<!-- <script src="app/libaries/create.js"></script> -->
	<?php 
		echo json_decode($JsLibrary->index());
	?>