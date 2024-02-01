<?= $this->include("Themes/_commonPartialsBs/select2bs5") ?>
<?= $this->include("Themes/_commonPartialsBs/sweetalert") ?>
<?= $this->extend("Themes/" . config("Basics")->theme["name"] . "/AdminLayout/defaultLayout") ?>
<?= $this->section("content") ?>

<div class="col-12">
	<div class="card card-info">
			<div class="card-header">
			<h3 class="card-title"><?= $boxTitle ?? $pageTitle ?></h3>
			</div><!--//.card-header -->
			<div class="card-body">
			<form id="fertilzerForm" method="post" action="<?= $formAction ?>">
			<div class="card-body">
				<?= csrf_field() ?>
				<?= view("Themes/_commonPartialsBs/_alertBoxes") ?>
				<?= !empty($validation->getErrors()) ? $validation->listErrors("bootstrap_style") : "" ?>
				<?= view("admin/fertilzerViews/_fertilzerFormItems") ?>
			</div><!-- /.card-body -->
				<?= anchor(route_to("fertilzerList"), lang("Basic.global.Cancel"), ["class" => "btn btn-secondary float-start"]) ?>
				<input type="submit" class="btn btn-primary float-end" name="save" value="<?= lang("Basic.global.Save") ?>">
				<?= form_close() ?>
    </div><!--//.col -->
</div><!--//.row -->
<?= $this->endSection() ?>


<?= $this->section("additionalInlineJs") ?>


    $('#category').select2({
        theme: 'bootstrap-5',
        allowClear: false,
        ajax: {
            url: '<?= base_url(route_to("menuItemsOfCategories")) ?>',
            type: 'post',
            dataType: 'json',

            data: function (params) {
                return {
                    id: 'id',
                    text: 'category',
                    searchTerm: params.term,
                    <?= csrf_token() ?? "token" ?> : <?= csrf_token() ?>v
                };
            },
            delay: 60,
            processResults: function (response) {

                yeniden(response.<?= csrf_token() ?>);

                return {
                    results: response.menu
                };
            },

            cache: true
        }
    });


<?= $this->endSection() ?>

