<?=$this->include('Themes/_commonPartialsBs/datatables') ?>
<?=$this->extend('Themes/'.config('Basics')->theme['name'].'/AdminLayout/defaultLayout') ?>
<?=$this->section('content');  ?>
<div class="row">
    <div class="col-md-12">

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><?=lang('TaskTemplates.taskTemplateList') ?></h3>
           </div><!--//.card-header -->
            <div class="card-body">
				<?= view('Themes/_commonPartialsBs/_alertBoxes'); ?>

					<table id="tableOfTasktemplates" class="table table-striped table-hover using-data-table" style="width: 100%;">
						<thead>
							<tr>
								<th class="text-nowrap"><?= lang('Basic.global.Action') ?></th>
								<th><?= lang('TaskTemplates.id') ?></th>
								<th><?= lang('TaskTemplates.details') ?></th>
								<th class="text-nowrap"><?= lang('Basic.global.Action') ?></th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($taskTemplateList as $item ) : ?>
							<tr>
								<td class="align-middle text-center text-nowrap">
									<?=anchor(route_to('editTaskTemplate', $item->id), '<i class="bi bi-pencil-square"></i>', ['class'=>'btn btn-sm btn-warning btn-edit me-1',  'data-id'=>$item->id,]); ?> 
									<?=anchor('#confirm2delete', '<i class="bi bi-trash"></i>', ['class'=>'btn btn-sm btn-danger btn-delete ms-1', 'data-href'=>route_to('deleteTaskTemplate', $item->id), 'data-bs-toggle'=>'modal', 'data-bs-target'=>'#confirm2delete']); ?>
								</td>
								<td class="align-middle text-center">
									<?=$item->id ?>
								</td>
								<td class="align-middle">
									<?= empty($item->details) || strlen($item->details) < 51 ? esc($item->details) : character_limiter(esc($item->details), 50)   ?>
								</td>
								<td class="align-middle text-center text-nowrap">
									<?=anchor(route_to('editTaskTemplate', $item->id), '<i class="bi bi-pencil-square"></i>', ['class'=>'btn btn-sm btn-warning btn-edit me-1',  'data-id'=>$item->id,]); ?> 
									<?=anchor('#confirm2delete', '<i class="bi bi-trash"></i>', ['class'=>'btn btn-sm btn-danger btn-delete ms-1', 'data-href'=>route_to('deleteTaskTemplate', $item->id), 'data-bs-toggle'=>'modal', 'data-bs-target'=>'#confirm2delete']); ?>
								</td>
							</tr>

						<?php endforeach; ?>
						</tbody>
					</table>
            </div><!--//.card-body -->
            <div class="card-footer">
				<?=anchor(route_to('newTaskTemplate'), lang('Basic.global.addNew').' '.lang('TaskTemplates.taskTemplate'), ['class'=>'btn btn-primary float-end']); ?>
            </div><!--//.card-footer -->
        </div><!--//.card -->
    </div><!--//.col -->
</div><!--//.row -->

<?=$this->endSection() ?>