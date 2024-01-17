<?=$this->include('Themes/_commonPartialsBs/datatables') ?>
<?=$this->include('Themes/_commonPartialsBs/sweetalert') ?>
<?=$this->extend('Themes/'.config('Basics')->theme['name'].'/AdminLayout/defaultLayout') ?>
<?=$this->section('content');  ?>
<div class="row">
    <div class="col-md-12">

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><?=lang('SoilTestLabs.soilTestLabList') ?></h3>
           </div><!--//.card-header -->
            <div class="card-body">
				<?= view('Themes/_commonPartialsBs/_alertBoxes'); ?>

					<table id="tableOfSoiltestlabs" class="table table-striped table-hover using-exportable-data-table" style="width: 100%;">
						<thead>
							<tr>
								<th class="text-nowrap"><?= lang('Basic.global.Action') ?></th>
								<th><?= lang('SoilTestLabs.company') ?></th>
								<th><?= lang('SoilTestLabs.clientId') ?></th>
								<th><?= lang('SoilTestLabs.invoicePrefix') ?></th>
								<th><?= lang('SoilTestLabs.status') ?></th>
								<th><?= lang('SoilTestLabs.registrationDate') ?></th>
								<th><?= lang('SoilTestLabs.street') ?></th>
								<th><?= lang('SoilTestLabs.suburb') ?></th>
								<th><?= lang('SoilTestLabs.postcode') ?></th>
								<th><?= lang('SoilTestLabs.state') ?></th>
								<th><?= lang('SoilTestLabs.country') ?></th>
								<th><?= lang('SoilTestLabs.phoneNumber') ?></th>
								<th><?= lang('SoilTestLabs.mobileNumber') ?></th>
								<th><?= lang('SoilTestLabs.abn') ?></th>
								<th><?= lang('SoilTestLabs.division') ?></th>
								<th><?= lang('SoilTestLabs.lastName') ?></th>
								<th><?= lang('SoilTestLabs.firstName') ?></th>
								<th><?= lang('SoilTestLabs.emailAddress') ?></th>
								<th class="text-nowrap"><?= lang('Basic.global.Action') ?></th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($soilTestLabList as $item ) : ?>
							<tr>
								<td class="align-middle text-center text-nowrap">
									<?=anchor(route_to('editSoilTestLab', $item->id), '<i class="bi bi-pencil-square"></i>', ['class'=>'btn btn-sm btn-warning btn-edit me-1',  'data-id'=>$item->id,]); ?> 
									<?=anchor('#confirm2delete', '<i class="bi bi-trash"></i>', ['class'=>'btn btn-sm btn-danger btn-delete ms-1', 'data-href'=>route_to('deleteSoilTestLab', $item->id)]); ?>
								</td>
								<td class="align-middle">
									<?= empty($item->company) || strlen($item->company) < 51 ? esc($item->company) : character_limiter(esc($item->company), 50)   ?>
								</td>
								<td class="align-middle">
									<?= esc($item->client_id) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->invoice_prefix) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->status) ?>
								</td>
								<td class="align-middle text-nowrap">
									<?= empty($item->registration_date) ? '' : date('d/m/Y H:i', strtotime($item->registration_date))  ?>
								</td>
								<td class="align-middle">
									<?= empty($item->street) || strlen($item->street) < 51 ? esc($item->street) : character_limiter(esc($item->street), 50)   ?>
								</td>
								<td class="align-middle">
									<?= empty($item->suburb) || strlen($item->suburb) < 51 ? esc($item->suburb) : character_limiter(esc($item->suburb), 50)   ?>
								</td>
								<td class="align-middle">
									<?= esc($item->postcode) ?>
								</td>
								<td class="align-middle">
									<?= empty($item->state) || strlen($item->state) < 51 ? esc($item->state) : character_limiter(esc($item->state), 50)   ?>
								</td>
								<td class="align-middle">
									<?= empty($item->country) || strlen($item->country) < 51 ? esc($item->country) : character_limiter(esc($item->country), 50)   ?>
								</td>
								<td class="align-middle">
									<?= esc($item->phone_number) ?>
								</td>
								<td class="align-middle">
									<?= esc($item->mobile_number) ?>
								</td>
								<td class="align-middle">
									<?= empty($item->abn) || strlen($item->abn) < 51 ? esc($item->abn) : character_limiter(esc($item->abn), 50)   ?>
								</td>
								<td class="align-middle">
									<?= empty($item->division) || strlen($item->division) < 51 ? esc($item->division) : character_limiter(esc($item->division), 50)   ?>
								</td>
								<td class="align-middle">
									<?= empty($item->last_name) || strlen($item->last_name) < 51 ? esc($item->last_name) : character_limiter(esc($item->last_name), 50)   ?>
								</td>
								<td class="align-middle">
									<?= empty($item->first_name) || strlen($item->first_name) < 51 ? esc($item->first_name) : character_limiter(esc($item->first_name), 50)   ?>
								</td>
								<td class="align-middle">
									<?= esc($item->email_address) ?>
								</td>
								<td class="align-middle text-center text-nowrap">
									<?=anchor(route_to('editSoilTestLab', $item->id), '<i class="bi bi-pencil-square"></i>', ['class'=>'btn btn-sm btn-warning btn-edit me-1',  'data-id'=>$item->id,]); ?> 
									<?=anchor('#confirm2delete', '<i class="bi bi-trash"></i>', ['class'=>'btn btn-sm btn-danger btn-delete ms-1', 'data-href'=>route_to('deleteSoilTestLab', $item->id)]); ?>
								</td>
							</tr>

						<?php endforeach; ?>
						</tbody>
					</table>
            </div><!--//.card-body -->
            <div class="card-footer">
				<?=anchor(route_to('newSoilTestLab'), lang('Basic.global.addNew').' '.lang('SoilTestLabs.soilTestLab'), ['class'=>'btn btn-primary float-end']); ?>
            </div><!--//.card-footer -->
        </div><!--//.card -->
    </div><!--//.col -->
</div><!--//.row -->

<?=$this->endSection() ?>


<?=$this->section('additionalInlineJs') ?>

    const lastColNr2 = $(".using-exportable-data-table").find("tr:first th").length - 1;
    theTable = $('.using-exportable-data-table').DataTable({
        "responsive": true,
        "paging": true,
        "lengthMenu": [ 5, 10, 25, 50, 75, 100, 250, 500, 1000, 2500 ],
        "pageLength": 10,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "dom": 'lfrtipB', // 'lfBrtip', // you can try different layout combinations by uncommenting one or the other
		// "dom": '<"top"lf><"clear">rt<"bottom"ipB><"clear">',  // remember to comment this line if you uncomment the above
		"buttons": [
			'copy', 'csv', 'excel', 'print', {
				extend: 'pdfHtml5',
				orientation: 'landscape',
				pageSize: 'A4'
			}
		],
        "autoWidth": true,
        "scrollX": true,
        "stateSave": true,
        "language": {
            url: "/assets/dt/<?= config('Basics')->languages[$currentLocale] ?? config('Basics')->i18n ?>.json"
        },
        "columnDefs": [
            {
                orderable: false,
                searchable: false,
                targets: [0,lastColNr2]
            }
        ]
    });

    

    
    $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            const dataHref = $(this).data('href');
            Swal.fire({
                title: "<?= lang('Basic.global.sweet.sureToDeleteTitle', [lang('SoilTestLabs.soil test lab')]) ?>",
                text: "<?= lang('Basic.global.sweet.sureToDeleteText') ?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: '<?= lang('Basic.global.sweet.deleteConfirmationButton') ?>',
                cancelButtonText: '<?= lang('Basic.global.Cancel') ?>',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.value) {
                    window.location.href = `<?= base_url()?>${dataHref}`;
                }
            });
        });
    
    
<?=$this->endSection() ?>


<?=$this->section('css') ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.<?=config('Basics')->theme['name'] == 'Bootstrap5' ? 'bootstrap5' : 'bootstrap4' ?>.min.css">
<?=$this->endSection() ?>


<?= $this->section('additionalExternalJs') ?>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.<?=config('Basics')->theme['name'] == 'Bootstrap5' ? 'bootstrap5' : 'bootstrap4' ?>.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.0/jszip.min.js" integrity="sha512-xcHCGC5tQ0SHlRX8Anbz6oy/OullASJkEhb4gjkneVpGE3/QGYejf14CUO5n5q5paiHfRFTa9HKgByxzidw2Bw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/pdfmake.min.js" integrity="sha512-rDbVu5s98lzXZsmJoMa0DjHNE+RwPJACogUCLyq3Xxm2kJO6qsQwjbE5NDk2DqmlKcxDirCnU1wAzVLe12IM3w==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/vfs_fonts.js" integrity="sha512-cktKDgjEiIkPVHYbn8bh/FEyYxmt4JDJJjOCu5/FQAkW4bc911XtKYValiyzBiJigjVEvrIAyQFEbRJZyDA1wQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

<?=$this->endSection() ?>

