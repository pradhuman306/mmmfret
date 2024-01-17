        <div class="row">
            <div class="col-md-12 col-lg-6 px-4">
				<div class="mb-3">
					<label for="email" class="form-label">
						<?=lang('Users.email') ?>*
					</label>
						<input type="email" id="email" name="email" required maxLength="255" class="form-control<?= ($ferr = session('formErrors.email')) ? ' is-invalid' : '' ?>" value="<?=old('email', $user->email) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="firstName" class="form-label">
						<?=lang('Users.firstName') ?>
					</label>
						<input type="text" id="firstName" name="first_name" maxLength="60" class="form-control<?= ($ferr = session('formErrors.first_name')) ? ' is-invalid' : '' ?>" value="<?=old('first_name', $user->first_name) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="primaryPhone" class="form-label">
						<?=lang('Users.primaryPhone') ?>
					</label>
						<input type="text" id="primaryPhone" name="primary_phone" maxLength="17" class="form-control<?= ($ferr = session('formErrors.primary_phone')) ? ' is-invalid' : '' ?>" value="<?=old('primary_phone', $user->primary_phone) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="passwordHash" class="form-label">
						<?=lang('Users.userPassword') ?>*
					</label>
						<input type="password" id="password" name="password" maxLength="255" class="form-control<?= ($ferr = session('formErrors.password')) ? ' is-invalid' : '' ?>" value="<?=old('password', $user->password) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<div class="form-check">

					<label for="active" class="form-check-label">
					<input type="checkbox" id="active" name="active" value="1"  class="form-check-input"<?=$user->active== true ? 'checked' : ''; ?>>
						<?=lang('Users.active') ?>
					</label>
					</div><!--//.form-check -->
			</div><!--//.mb-3 -->

            </div><!--//.col -->
            <div class="col-md-12 col-lg-6 px-4">
				<div class="mb-3">
					<label for="username" class="form-label">
						<?=lang('Users.username') ?>
					</label>
						<input type="text" id="username" name="username" maxLength="30" class="form-control<?= ($ferr = session('formErrors.username')) ? ' is-invalid' : '' ?>" value="<?=old('username', $user->username) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="lastName" class="form-label">
						<?=lang('Users.lastName') ?>
					</label>
						<input type="text" id="lastName" name="last_name" maxLength="60" class="form-control<?= ($ferr = session('formErrors.last_name')) ? ' is-invalid' : '' ?>" value="<?=old('last_name', $user->last_name) ?>">
						<?php if ( $ferr ) { ?>
							<div class="invalid-feedback">
								<?= $ferr ?>
							</div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="permissions" class="form-label">
						<?=lang('Basic.global.Permissions') ?>
					</label>
							<select id="permissions" name="permissions[]" multiple="multiple" data-placeholder="Permissions"  class="form-control select2bs<?= ($ferr = session('formErrors.permissions')) ? ' is-invalid' : '' ?>" style="width: 100%;" >

						<?php foreach ($permissions as $item) : ?>
							<option value="<?=$item['id'] ?>"<?=array_key_exists( $item['id'], old('permissions', $permissionsOfUser) ) ? 'selected' : '' ?>>
								<?=$item['name'] ?>
							</option>
						<?php endforeach; ?>
						</select>
						<?php if ( $ferr ) { ?>
						    <div class="invalid-feedback">
						        <?= $ferr ?>
						    </div>
						<?php } ?>
				</div><!--//.mb-3 -->

				<div class="mb-3">
					<label for="groups" class="form-label">
						<?=lang('Basic.global.Groups') ?>
					</label>
							<select id="groups" name="groups[]" multiple="multiple" data-placeholder="Groups (Roles)"  class="form-control select2bs<?= ($ferr = session('formErrors.groups')) ? ' is-invalid' : '' ?>" style="width: 100%;" >

						<?php foreach ($groups as $item) : ?>
							<option value="<?=$item->id ?>"<?=array_key_exists( $item->id, old('groups', $groupsOfUser) ) ? 'selected' : '' ?>>
								<?=$item->name ?>
							</option>
						<?php endforeach; ?>
						</select>
						<?php if ( $ferr ) { ?>
						    <div class="invalid-feedback">
						        <?= $ferr ?>
						    </div>
						<?php } ?>
				</div><!--//.mb-3 -->

            </div><!--//.col -->

        </div><!-- //.row -->