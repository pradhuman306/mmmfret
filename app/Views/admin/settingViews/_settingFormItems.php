        <div class="row">
            <div class="col-md-12 col-lg-6 px-4">
				<div class="mb-3">
					<label for="description" class="form-label">
						<?=lang('Settings.description') ?>
					</label>
						<input type="text" id="description" name="description" maxLength="150" class="form-control<?= ($ferr = session('formErrors.description')) ? ' is-invalid' : '' ?>" value="<?=old('description', $setting->description) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

            </div><!--//.col -->
            <div class="col-md-12 col-lg-6 px-4">
				<div class="mb-3">
					<label for="companyId" class="form-label">
						<?=lang('Settings.companyId') ?>*
					</label>
						<input type="text" id="companyId" name="company_id" required maxLength="31" class="form-control<?= ($ferr = session('formErrors.company_id')) ? ' is-invalid' : '' ?>" value="<?=old('company_id', $setting->company_id) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

            </div><!--//.col -->

        </div><!-- //.row -->