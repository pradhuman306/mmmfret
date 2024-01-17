<?= $this->include("Themes/_commonPartialsBs/select2bs5") ?>
<?= $this->extend("Themes/" . config("Basics")->theme["name"] . "/AdminLayout/defaultLayout") ?>
<?= $this->section("content") ?>
<div class="row">
    <div class="col-12">
		<div class="card card-info">
			<div class="card-header">
        		<h3 class="card-title"><?= $boxTitle ?? $pageTitle ?></h3>
			</div><!--//.card-header -->
			<form id="taskTemplateForm" method="post" action="<?= $formAction ?>">
				<?= csrf_field() ?>
			<div class="card-body">
				<?= view("Themes/_commonPartialsBs/_alertBoxes") ?>
				<?= !empty($validation->getErrors()) ? $validation->listErrors("bootstrap_style") : "" ?>
				<?= view("admin/taskTemplateViews/_taskTemplateFormItems") ?>
			</div><!-- /.card-body -->
			<div class="card-footer">
				<?= anchor(route_to("taskTemplateIndex"), lang("Basic.global.Cancel"), ["class" => "btn btn-secondary float-start"]) ?>
				<input type="submit" class="btn btn-primary float-end" name="save" value="<?= lang("Basic.global.Save") ?>">
			</div><!-- /.card-footer -->
			</form>
    </div><!-- //.card -->
    </div><!--//.col -->
</div><!--//.row -->
<?= $this->endSection() ?>