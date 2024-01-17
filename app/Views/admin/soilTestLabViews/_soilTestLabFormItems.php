        <div class="row">
            <div class="col-md-12 col-lg-6 px-4">
				<div class="mb-3">
					<label for="company" class="form-label">
						<?=lang('SoilTestLabs.company') ?>
					</label>
							<textarea rows="3" id="company" name="company" style="height: 10em;" class="form-control<?= (($ferr = session('formErrors.company')) ? ' is-invalid' : '') ?>"><?=old('company', $soilTestLab->company) ?></textarea>
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="clientId" class="form-label">
						<?=lang('SoilTestLabs.clientId') ?>
					</label>
						<input type="text" id="clientId" name="client_id" maxLength="31" class="form-control<?= ($ferr = session('formErrors.client_id')) ? ' is-invalid' : '' ?>" value="<?=old('client_id', $soilTestLab->client_id) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="invoicePrefix" class="form-label">
						<?=lang('SoilTestLabs.invoicePrefix') ?>*
					</label>
						<input type="text" id="invoicePrefix" name="invoice_prefix" required maxLength="40" class="form-control<?= ($ferr = session('formErrors.invoice_prefix')) ? ' is-invalid' : '' ?>" value="<?=old('invoice_prefix', $soilTestLab->invoice_prefix) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="status" class="form-label">
						<?=lang('SoilTestLabs.status') ?>
					</label>
						<input type="text" id="status" name="status" maxLength="31" class="form-control<?= ($ferr = session('formErrors.status')) ? ' is-invalid' : '' ?>" value="<?=old('status', $soilTestLab->status) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="registrationDate" class="form-label">
						<?=lang('SoilTestLabs.registrationDate') ?>
					</label>
						<input type="text" id="registrationDate" name="registration_date" maxLength="20" class="form-control<?= ($ferr = session('formErrors.registration_date')) ? ' is-invalid' : '' ?>" value="<?=old('registration_date', $soilTestLab->registration_date) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="street" class="form-label">
						<?=lang('SoilTestLabs.street') ?>
					</label>
						<input type="text" id="street" name="street" maxLength="200" class="form-control<?= ($ferr = session('formErrors.street')) ? ' is-invalid' : '' ?>" value="<?=old('street', $soilTestLab->street) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="suburb" class="form-label">
						<?=lang('SoilTestLabs.suburb') ?>
					</label>
						<input type="text" id="suburb" name="suburb" maxLength="150" class="form-control<?= ($ferr = session('formErrors.suburb')) ? ' is-invalid' : '' ?>" value="<?=old('suburb', $soilTestLab->suburb) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="postcode" class="form-label">
						<?=lang('SoilTestLabs.postcode') ?>
					</label>
						<input type="text" id="postcode" name="postcode" maxLength="20" class="form-control<?= ($ferr = session('formErrors.postcode')) ? ' is-invalid' : '' ?>" value="<?=old('postcode', $soilTestLab->postcode) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="state" class="form-label">
						<?=lang('SoilTestLabs.state') ?>
					</label>
						<input type="text" id="state" name="state" maxLength="50" class="form-control<?= ($ferr = session('formErrors.state')) ? ' is-invalid' : '' ?>" value="<?=old('state', $soilTestLab->state) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

            </div><!--//.col -->
            <div class="col-md-12 col-lg-6 px-4">
				<div class="mb-3">
					<label for="country" class="form-label">
						<?=lang('SoilTestLabs.country') ?>
					</label>
						<input type="text" id="country" name="country" placeholder="Australia" maxLength="100" class="form-control<?= ($ferr = session('formErrors.country')) ? ' is-invalid' : '' ?>" value="<?=old('country', $soilTestLab->country) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="phoneNumber" class="form-label">
						<?=lang('SoilTestLabs.phoneNumber') ?>
					</label>
						<input type="text" id="phoneNumber" name="phone_number" maxLength="20" class="form-control<?= ($ferr = session('formErrors.phone_number')) ? ' is-invalid' : '' ?>" value="<?=old('phone_number', $soilTestLab->phone_number) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="mobileNumber" class="form-label">
						<?=lang('SoilTestLabs.mobileNumber') ?>
					</label>
						<input type="text" id="mobileNumber" name="mobile_number" maxLength="20" class="form-control<?= ($ferr = session('formErrors.mobile_number')) ? ' is-invalid' : '' ?>" value="<?=old('mobile_number', $soilTestLab->mobile_number) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="abn" class="form-label">
						<?=lang('SoilTestLabs.abn') ?>
					</label>
						<input type="text" id="abn" name="abn" maxLength="100" class="form-control<?= ($ferr = session('formErrors.abn')) ? ' is-invalid' : '' ?>" value="<?=old('abn', $soilTestLab->abn) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="division" class="form-label">
						<?=lang('SoilTestLabs.division') ?>
					</label>
						<input type="text" id="division" name="division" maxLength="100" class="form-control<?= ($ferr = session('formErrors.division')) ? ' is-invalid' : '' ?>" value="<?=old('division', $soilTestLab->division) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="lastName" class="form-label">
						<?=lang('SoilTestLabs.lastName') ?>
					</label>
						<input type="text" id="lastName" name="last_name" maxLength="211" class="form-control<?= ($ferr = session('formErrors.last_name')) ? ' is-invalid' : '' ?>" value="<?=old('last_name', $soilTestLab->last_name) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="firstName" class="form-label">
						<?=lang('SoilTestLabs.firstName') ?>
					</label>
						<input type="text" id="firstName" name="first_name" maxLength="211" class="form-control<?= ($ferr = session('formErrors.first_name')) ? ' is-invalid' : '' ?>" value="<?=old('first_name', $soilTestLab->first_name) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="emailAddress" class="form-label">
						<?=lang('SoilTestLabs.emailAddress') ?>
					</label>
						<input type="email" id="emailAddress" name="email_address" maxLength="211" class="form-control<?= ($ferr = session('formErrors.email_address')) ? ' is-invalid' : '' ?>" value="<?=old('email_address', $soilTestLab->email_address) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

            </div><!--//.col -->

        </div><!-- //.row -->