        <div class="row">
            <div class="col-md-12 col-lg-12 px-4">
				<div class="mb-3">
					<label for="description" class="form-label">
						<?=lang('HarvestTemplates.description') ?>
					</label>
							<textarea rows="3" id="description" name="description" style="height: 10em;" class="form-control<?= (($ferr = session('formErrors.description')) ? ' is-invalid' : '') ?>"><?=old('description', $harvestTemplate->description) ?></textarea>
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

            </div><!--//.col -->

        </div><!-- //.row -->