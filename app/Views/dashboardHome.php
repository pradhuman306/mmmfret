<?= $this->extend('Themes/'.config('Basics')->theme['name'].'/AdminLayout/defaultLayout') ?>
<?= $this->section('content');  ?>

	<?=view('Themes/_commonPartialsBs/_alertBoxes') ?>


	<!-- Info boxes -->
	<div class="row">
		<div class="col-lg-3 col-6">

			<div class="small-box bg-info">
				<div class="inner">
					<h3><?= $totalNrOfCationFormulas; ?></h3>
					<p><?=lang('CationFormulas.cationFormulas') ?></p>
				</div>
				<div class="icon">
					<i class="bi bi-bar-chart-line"></i>
				</div>
				<?= anchor(route_to('cationFormulaList'), lang('Basic.global.MoreInfo').'  <i class="fas fa-arrow-circle-right"></i>', ['class'=>'small-box-footer']); ?>

			</div><!-- /.small-box -->


			<div class="small-box bg-success">
				<div class="inner">
					<h3><?= $totalNrOfStates; ?></h3>
					<p><?=lang('States.states') ?></p>
				</div>
				<div class="icon">
					<i class="bi bi-bar-chart-line"></i>
				</div>
				<?= anchor(route_to('stateList'), lang('Basic.global.MoreInfo').'  <i class="fas fa-arrow-circle-right"></i>', ['class'=>'small-box-footer']); ?>

			</div><!-- /.small-box -->

		</div><!-- /.col -->
		<div class="col-lg-3 col-6">

			<div class="small-box bg-success">
				<div class="inner">
					<h3><?= $totalNrOfXeroSalesGsts; ?></h3>
					<p><?=lang('XeroSalesGsts.xeroSalesGsts') ?></p>
				</div>
				<div class="icon">
					<i class="bi bi-bookmarks-fill"></i>
				</div>
				<?= anchor(route_to('xeroSalesGstList'), lang('Basic.global.MoreInfo').'  <i class="fas fa-arrow-circle-right"></i>', ['class'=>'small-box-footer']); ?>

			</div><!-- /.small-box -->


			<div class="small-box bg-secondary">
				<div class="inner">
					<h3><?= $totalNrOfCompanies; ?></h3>
					<p><?=lang('Companies.companies') ?></p>
				</div>
				<div class="icon">
					<i class="bi bi-asterisk"></i>
				</div>
				<?= anchor(route_to('companyList'), lang('Basic.global.MoreInfo').'  <i class="fas fa-arrow-circle-right"></i>', ['class'=>'small-box-footer']); ?>

			</div><!-- /.small-box -->

		</div><!-- /.col -->
		<div class="col-lg-3 col-6">

			<div class="small-box bg-warning">
				<div class="inner">
					<h3><?= $totalNrOfTimezones; ?></h3>
					<p><?=lang('Timezones.timezones') ?></p>
				</div>
				<div class="icon">
					<i class="bi bi-bar-chart-line"></i>
				</div>
				<?= anchor(route_to('timezoneList'), lang('Basic.global.MoreInfo').'  <i class="fas fa-arrow-circle-right"></i>', ['class'=>'small-box-footer']); ?>

			</div><!-- /.small-box -->


			<div class="small-box bg-warning">
				<div class="inner">
					<h3><?= $totalNrOfCropTypes; ?></h3>
					<p><?=lang('CropTypes.cropTypes') ?></p>
				</div>
				<div class="icon">
					<i class="bi bi-bookmarks-fill"></i>
				</div>
				<?= anchor(route_to('cropTypeList'), lang('Basic.global.MoreInfo').'  <i class="fas fa-arrow-circle-right"></i>', ['class'=>'small-box-footer']); ?>

			</div><!-- /.small-box -->

		</div><!-- /.col -->
		<div class="col-lg-3 col-6">

			<div class="small-box bg-danger">
				<div class="inner">
					<h3><?= $totalNrOfPostcodeAustraliaLists; ?></h3>
					<p><?=lang('PostcodeAustraliaLists.postcodeAustraliaLists') ?></p>
				</div>
				<div class="icon">
					<i class="bi bi-asterisk"></i>
				</div>
				<?= anchor(route_to('postcodeAustraliaListList'), lang('Basic.global.MoreInfo').'  <i class="fas fa-arrow-circle-right"></i>', ['class'=>'small-box-footer']); ?>

			</div><!-- /.small-box -->


			<div class="small-box bg-warning">
				<div class="inner">
					<h3><?= $totalNrOfFertilzerCompanies; ?></h3>
					<p><?=lang('FertilzerCompanies.fertilzerCompanies') ?></p>
				</div>
				<div class="icon">
					<i class="bi bi-bookmarks-fill"></i>
				</div>
				<?= anchor(route_to('fertilzerCompanyList'), lang('Basic.global.MoreInfo').'  <i class="fas fa-arrow-circle-right"></i>', ['class'=>'small-box-footer']); ?>

			</div><!-- /.small-box -->

		</div><!-- /.col -->
	</div><!-- /.row -->

<?= $this->endSection() ?>