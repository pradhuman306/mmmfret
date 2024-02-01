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
			<?= form_open($formAction, ["id" => "postcodeAustraliaListForm"]) ?>
            <div class="card-body">
				<?= csrf_field() ?>
				<?= !empty($validation->getErrors()) ? $validation->listErrors("bootstrap_style") : "" ?>
				<?= view("admin/postcodeAustraliaListViews/_postcodeAustraliaListFormItems") ?>
				<?= anchor(route_to("postcodeAustraliaListList"), lang("Basic.global.Cancel"), ["class" => "btn btn-secondary float-start",]) ?>
				<?= form_submit("save", lang("Basic.global.Save"), ["class" => "btn btn-primary float-end"]) ?>
			</div><!-- /.card-footer -->
			<?= form_close() ?>
    </div><!-- //.card -->
    </div><!--//.col -->
</div><!--//.row -->
<?= $this->endSection() ?>


<?= $this->section("additionalInlineJs") ?>


    $('#timezone').select2({
        theme: 'bootstrap-5',
        allowClear: false,
        ajax: {
            url: '<?= base_url(route_to("menuItemsOfTimezones")) ?>',
            type: 'post',
            dataType: 'json',

            data: function (params) {
                return {
                    id: 'id',
                    text: 'timezone',
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

    $('#timezone1').select2({
        theme: 'bootstrap-5',
        allowClear: false,
    });


<?= $this->endSection() ?>
