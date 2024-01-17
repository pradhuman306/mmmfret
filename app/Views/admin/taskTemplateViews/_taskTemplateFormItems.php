        <div class="row">
            <div class="col-md-12 col-lg-12 px-4">
				<div class="mb-3">
					<label for="details" class="form-label">
						<?=lang('TaskTemplates.details') ?>
					</label>
							<textarea rows="3" id="details" name="details" style="height: 10em;" class="form-control"><?=old('details', $taskTemplate->details) ?></textarea>
				</div><!--//.mb-3 -->

            </div><!--//.col -->

        </div><!-- //.row -->