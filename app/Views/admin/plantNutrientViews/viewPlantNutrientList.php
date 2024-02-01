<?=$this->include('Themes/_commonPartialsBs/datatables') ?>
<?=$this->include('Themes/_commonPartialsBs/sweetalert') ?>
<?=$this->extend('Themes/'.config('Basics')->theme['name'].'/AdminLayout/defaultLayout') ?>
<?=$this->section('content');  ?>
<div class="row">
    <div class="col-md-12">

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><?=lang('PlantNutrients.plantNutrientList') ?></h3>
                <?=anchor(route_to('newPlantNutrient'), lang('Basic.global.addNew').' '.lang('PlantNutrients.plantNutrient'), ['class'=>'btn btn-success float-end']); ?>
           </div><!--//.card-header -->
            <div class="card-body">
				<?= view('Themes/_commonPartialsBs/_alertBoxes'); ?>

					<table id="tableOfPlantnutrients" class="table table-striped table-hover" style="width: 100%;">
						<thead>
							<tr>
								<th><?= lang('PlantNutrients.element') ?></th>
								<th><?= lang('PlantNutrients.symbol') ?></th>
								<th><?= lang('PlantNutrients.order') ?></th>
                                <th class="text-nowrap" style="width: 1%;"><?= lang('Basic.global.Action') ?></th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
            </div><!--//.card-body -->
        </div><!--//.card -->
    </div><!--//.col -->
</div><!--//.row -->

<?=$this->endSection() ?>


<?=$this->section('additionalInlineJs') ?>
    
            const lastColNr = $('#tableOfPlantnutrients').find("tr:first th").length - 1;
            const actionBtns = function(data) {
                return `<td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-sm btn-outline-success btn-edit me-1" data-id="${data.id}"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-sm btn-outline-danger btn-delete ms-1" data-id="${data.id}"><i class="bi bi-trash"></i></button>
                        </div>
                        </td>`;
            };
            theTable = $('#tableOfPlantnutrients').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: true,
                responsive: true,
                scrollX: true,
                lengthMenu: [ 5, 10, 25, 50, 75, 100, 250, 500, 1000, 2500 ],
                pageLength: 10,
                lengthChange: true,
                "dom": 'lfrtipB', // 'lfBrtip', // you can try different layout combinations by uncommenting one or the other
		// "dom": '<"top"lf><"clear">rt<"bottom"ipB><"clear">',  // remember to comment this line if you uncomment the above
        "buttons": [
    {
        extend: 'copy',
        exportOptions: {
            columns: ':not(:last-child)'
        }
    },
    {
        extend: 'csv',
        exportOptions: {
            columns: ':not(:last-child)'
        }
    },
    {
        extend: 'excel',
        exportOptions: {
            columns: ':not(:last-child)'
        }
    },
    {
        extend: 'print',
        exportOptions: {
            columns: ':not(:last-child)'
        }
    },
    {
        extend: 'pdfHtml5',
            orientation: 'landscape',
            pageSize: 'A4',
            customize: function (doc) {
                // Use the customizePdf function from pdfCustomization.js
                customizePdf(doc);
            },
            exportOptions: {
                columns: ':not(:last-child)'
            }
        }
		],
                stateSave: true,
                order: [[1, 'asc']],
                language: {
                    url: "/assets/dt/<?= config('Basics')->languages[$currentLocale] ?? config('Basics')->i18n ?>.json"
                },
                ajax : $.fn.dataTable.pipeline( {
                    url: '<?= base_url().route_to('dataTableOfPlantNutrients') ?>',
                    method: 'POST',
                    headers: {'X-Requested-With': 'XMLHttpRequest'},
                    async: true,
                }),
                columnDefs: [
                    {
                        orderable: false,
                        searchable: false,
                        targets: [0,lastColNr]
                    }
                ],
                columns : [
               		{ 'data': 'element' },
					{ 'data': 'symbol' },
					{ 'data': 'order' },
                    { 'data': actionBtns }
                ]
            });

$(document).on('click', '.btn-edit', function(e) {
        window.location.href = `<?= base_url().route_to('plantNutrientList') ?>/${$(this).attr('data-id')}/edit`;
    });
    
$(document).on('click', '.btn-delete', function(e) {
    const itemName = $(this).closest('tr').find('td:first-child').text().trim();
        Swal.fire({
            title: `Are you sure you want to delete "${itemName}"?`, // itemName is the timezone
            text: '<?= lang('Basic.global.sweet.sureToDeleteText') ?>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: '<?= lang('Basic.global.sweet.deleteConfirmationButton') ?>',
            cancelButtonText: '<?= lang('Basic.global.Cancel') ?>',
            cancelButtonColor: '#d33'
        })
        .then((result) => {
            const dataId = $(this).data('id');
            const row = $(this).closest('tr');
            if (result.value) {
                $.ajax({
                    url: `<?= base_url().route_to('plantNutrientList') ?>/${dataId}`,
                    method: 'DELETE',
                }).done((data, textStatus, jqXHR) => {
                    Toast.fire({
                        icon: 'success',
                        title: data.msg ?? jqXHR.statusText,
                    });
                    theTable.ajax.reload();
                    theTable.clearPipeline();
                    theTable.row($(row)).invalidate().draw();
                }).fail((jqXHR, textStatus, errorThrown) => {
                    Toast.fire({
                        icon: 'error',
                        title: jqXHR.responseJSON.messages.error,
                    });
                })
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
