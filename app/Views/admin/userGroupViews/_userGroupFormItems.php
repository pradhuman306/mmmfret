        <div class="row">
            <div class="col-md-12 col-lg-6 px-4">
				<div class="mb-3">
					<label for="name" class="form-label">
						<?=lang('AuthGroups.name') ?>*
					</label>
						<input type="text" id="name" name="name" required maxLength="255" class="form-control<?= ($ferr = session('formErrors.name')) ? ' is-invalid' : '' ?>" value="<?=old('name', $userGroup->name) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

            </div><!--//.col -->
            <div class="col-md-12 col-lg-6 px-4">
				<div class="mb-3">
					<label for="description" class="form-label">
						<?=lang('AuthGroups.description') ?>*
					</label>
							<textarea rows="3" id="description" name="description" required style="height: 10em;" class="form-control<?= (($ferr = session('formErrors.description')) ? ' is-invalid' : '') ?>"><?=old('description', $userGroup->description) ?></textarea>
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

            </div><!--//.col -->

        </div><!-- //.row -->