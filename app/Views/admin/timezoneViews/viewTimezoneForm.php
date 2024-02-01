<?= $this->include("Themes/_commonPartialsBs/select2bs5") ?>
<?= $this->include("Themes/_commonPartialsBs/sweetalert") ?>
<?= $this->extend("Themes/" . config("Basics")->theme["name"] . "/AdminLayout/defaultLayout") ?>
<?= $this->section("content") ?>

<div class="row">
    <div class="col-12">
	<div class="card card-info">
			<div class="card-header">
			<h3 class="card-title"><?= $boxTitle ?? $pageTitle ?></h3>
			</div><!--//.card-header -->
			<div class="card-body">
			<?= form_open($formAction, ["id" => "timezoneForm"]) ?>
			<div class="card-body">
				<?= view("Themes/_commonPartialsBs/_alertBoxes") ?>
				<?= !empty($validation->getErrors()) ? $validation->listErrors("bootstrap_style") : "" ?>
				<?= view("admin/timezoneViews/_timezoneFormItems") ?>
			</div><!-- /.card-body -->
				<?= anchor(route_to("timezoneList"), lang("Basic.global.Cancel"), ["class" => "btn btn-secondary float-start"]) ?>
				<?= form_submit("save", lang("Basic.global.Save"), ["class" => "btn btn-primary float-end"]) ?>
			<?= form_close() ?>
    </div><!--//.col -->
</div><!--//.row -->
<?= $this->endSection() ?>