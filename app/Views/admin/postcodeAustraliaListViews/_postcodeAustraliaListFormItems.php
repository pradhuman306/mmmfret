<?php
$uri = service('uri');
$isAddPage = strpos($uri->getPath(), 'add') !== false;
$isEditPage = strpos($uri->getPath(), 'edit') !== false;
use App\Libraries\create;
$JsLibrary = new create();
?>

<!-- Timezone -->	

				<div class="row">
            		<div class="col-md-12 col-lg-6 px-4">
				<div class="mb-3">
					<?=form_label(lang('PostcodeAustraliaLists.timezone'), 'timezone', ['class'=>'form-label']); ?>
							<?=form_dropdown('timezone', $timezoneList, $postcodeAustraliaList->timezone?$postcodeAustraliaList->timezone:($oldInput ? $oldInput['timezone']:''), ['id' => 'timezone1', 'class' => 'form-control select2bs2', 'style'=>'width: 100%;']) ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<?=form_label(lang('PostcodeAustraliaLists.suburb'), 'suburb', ['class'=>'form-label']); ?>
				<?=form_input(['name' => 'suburb', 'type' => 'text', 'id' => 'suburb', 'value' => $oldInput ? $oldInput['suburb']:($postcodeAustraliaList?$postcodeAustraliaList->suburb:'') , 'class' => 'form-control'.(($ferr = session('formErrors.suburb')) ? ' is-invalid' : ''), 'maxlength' => 100]);  ?>
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<?=form_input(['name' => 'state', 'type' => 'hidden', 'id' => 'state_id', 'value' => $oldInput ? $oldInput['state']:($postcodeAustraliaList?$postcodeAustraliaList->state:'') , 'class' => 'form-control'.(($ferr = session('formErrors.suburb')) ? ' is-invalid' : ''), 'maxlength' => 100]);  ?>
<!-- Country -->			

				<div class="mb-3">
    				<?= form_label(lang('PostcodeAustraliaLists.country'), 'country', ['class'=>'form-label']); ?>
    				<?= form_input([
        				'name' => 'country', 
        				'type' => 'text', 
        				'id' => 'country', 
        				'value' => $oldInput ? $oldInput['country'] : ($postcodeAustraliaList ? $postcodeAustraliaList->country : ''), 
        				'class' => 'form-control-disabled' . (($ferr = session('formErrors.country')) ? ' is-invalid' : ''),
        				'maxlength' => 150,
        				'readonly' => 'readonly' // Added readonly attribute
    				]); ?>
    					<?php if ($ferr): ?>
        						<div class="invalid-feedback">
            				<?= $ferr ?>
        				</div>
    				<?php endif; ?>
				</div><!--//.mb-3 -->


<!-- Longitude -->		

				<div class="mb-3">
    			<?= form_label(lang('PostcodeAustraliaLists.lon'), 'lon', ['class' => 'form-label']); ?>
					<?= form_input([
						'name' => 'lon',
						'type' => 'text',
						'id' => 'lat',
						'value' => $oldInput ? $oldInput['lat'] : ($postcodeAustraliaList ? $postcodeAustraliaList->lon : ''),
						'class' => 'form-control' . ($ferr = session('formErrors.lon') ? ' is-invalid' : ''),
						'maxlength' => 20,
						'pattern' => '-?[0-9]+(\.[0-9]+)?', // Regex allows for negative or positive doubles
						'oninput' => 'validateLatLon(this)',
						'placeholder' => 'Enter valid Longitude coordinate (numbers only)'
					]); ?>
					<?php if ($ferr) { ?>
						<div class="invalid-feedback">
							<?= $ferr ?>
						</div>
					<?php } ?>
				</div><!--//.mb-3 -->

<!-- Created At -->			

				<div class="mb-3">
					<label for="createdAt" class="form-label">
						<?= lang('Created At') ?>
                	</label>
                    <?php
                    if ($isAddPage && isset($formatted_created_at)) {
                        $postcodeAustralialist->created_at = $formatted_created_at;
                    }
                    ?>
                    <input type="datetime-local" id="createdAt" name="created_at" maxLength="20"
                        class="form-control-disabled<?= ($ferr = session('formErrors.created_at')) ? ' is-invalid' : '' ?>"
                        value="<?= old('created_at', $postcodeAustraliaList->created_at) ?>" readonly> <!-- Added readonly attribute here -->
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
					value="<?= old('updated_at', $postcodeAustraliaList->formatted_updated_at ?? $postcodeAustraliaList->updated_at) ?>">
				<?php if ($ferr): ?>
					<div class="invalid-feedback">
							<?= $ferr ?>
						</div>
					<?php endif; ?>
				</div><!--//.mb-3 -->		

<!-- State -->	

            	</div><!--//.col -->
            		<div class="col-md-12 col-lg-6 px-4">
				<div class="mb-3">
					<?=form_label(lang('PostcodeAustraliaLists.state'), 'state', ['class'=>'form-label']); ?>
				<?=form_input(['name' => 'state_id', 'type' => 'text', 'id' => 'state', 'value' => $oldInput ? $oldInput['state_id']:($postcodeAustraliaList?$postcodeAustraliaList->state_id:'') , 'class' => 'form-control'.(($ferr = session('formErrors.state')) ? ' is-invalid' : ''), 'maxlength' => 20, 'readonly' => 'readonly']);  ?>
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Postcode -->
			
				<div class="mb-3">
					<?=form_label(lang('PostcodeAustraliaLists.postcode'), 'postcode', ['class'=>'form-label']); ?>
				<?=form_input(['name' => 'postcode', 'type' => 'text', 'id' => 'postcode', 'value' => $oldInput ? $oldInput['postcode']:($postcodeAustraliaList?$postcodeAustraliaList->postcode:'') , 'class' => 'form-control'.(($ferr = session('formErrors.postcode')) ? ' is-invalid' : ''), 'maxlength' => 20]);  ?>
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

<!-- Latitude -->				

				<div class="mb-3">
    			<?= form_label(lang('PostcodeAustraliaLists.lat'), 'lat', ['class' => 'form-label']); ?>
					<?= form_input([
						'name' => 'lat',
						'type' => 'text',
						'id' => 'lat',
						'value' => $oldInput ? $oldInput['lat'] : ($postcodeAustraliaList ? $postcodeAustraliaList->lat : ''),
						'class' => 'form-control' . ($ferr = session('formErrors.lon') ? ' is-invalid' : ''),
						'maxlength' => 20,
						'pattern' => '-?[0-9]+(\.[0-9]+)?', // Regex allows for negative or positive doubles
						'oninput' => 'validateLatLon(this)',
						'placeholder' => 'Enter valid Latitude coordinate (numbers only)'
					]); ?>
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
                    value="<?= $isAddPage ? $loggedInUsername : old('created_by', $postcodeAustraliaList->created_by) ?>" readonly>
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
                    value="<?= $isEditPage ? $loggedInUsername : old('updated_by', $postcodeAustraliaList->updated_by) ?>" readonly>
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
<?=$this->section('additionalInlineJs') ?>	
	$('.select2bs2').change((e)=>{
		$.ajax({
                    url: `<?= base_url().route_to('getstate') ?>`,
                    method: 'GET',
					data: {
						id: e.target.value
					}
                }).done((data, textStatus, jqXHR) => {
					if(data){
						var result = JSON.parse(data);
						$('#state').val(result.state);
						$('#state_id').val(result.state_id);
						
						console.log(result.state);
					}
				});
		});

<?=$this->endSection() ?>

<script>
function validateLatLon(input) {
    // Match against a regex pattern that allows an optional negative sign,
    // followed by any number of digits, and optionally a decimal point and more digits
    const regex = /^-?\d*\.?\d*$/;

    // If the last character breaks the pattern, remove it
    if (!regex.test(input.value)) {
        input.value = input.value.slice(0, -1);
    }
}
</script>


