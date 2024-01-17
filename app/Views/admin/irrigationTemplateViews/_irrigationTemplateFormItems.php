        <div class="row">
            <div class="col-md-12 col-lg-12 px-4">
				<div class="mb-3">
					<label for="details" class="form-label">
						<?=lang('IrrigationTemplates.details') ?>
					</label>
							<textarea rows="3" id="details" name="details" style="height: 10em;" class="form-control<?= (($ferr = session('formErrors.details')) ? ' is-invalid' : '') ?>"><?=old('details', $irrigationTemplate->details) ?></textarea>
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

            </div><!--//.col -->

        </div><!-- //.row -->