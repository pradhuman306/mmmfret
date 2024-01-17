<style>
	.sidebar li .submenu {
		list-style: none;
		margin: 0;
		padding: 0;
		padding-left: 1rem;
		padding-right: 1rem;
	}
</style>

<!-- General Menu Items -->

</li>
	<li class="nav-item">
		<?= anchor(route_to('companyList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('Companies.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('companies') ? ' active' : '')]); ?>
	</li>
	<li class="nav-item">
		<?= anchor(route_to('fertilzerCompanyList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('FertilzerCompanies.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('fertilzer-companies') ? ' active' : '')]); ?>
	</li>
	<li class="nav-item">
		<?= anchor(route_to('priceListTemplateList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('PricelistTemplates.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('pricelist-templates') ? ' active' : '')]); ?>
	</li>
	<li class="nav-item">
		<?= anchor(route_to('soilTestLabList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('SoilTestLabs.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('soil-test-labs') ? ' active' : '')]); ?>
	</li>

<!-- Settings Menu -->	

<ul class="nav flex-column" id="nav_accordion">
	<li class="nav-item">
		<a class="nav-link" data-bs-toggle="collapse" data-bs-target="#menu_item1" href="#"> Settings <i class="bi small bi-caret-down-fill"></i> </a>
		<ul id="menu_item1" class="submenu collapse" data-bs-parent="#nav_accordion">
	</li>
		<li class="nav-item">
		<?= anchor(route_to('cationFormulaList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('CationFormulas.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('cation-formulas') ? ' active' : '')]); ?>
	</li>
	<li class="nav-item">
		<?= anchor(route_to('cropTypeList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('CropTypes.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('crop-types') ? ' active' : '')]); ?>
	</li>
	</li>
	<li class="nav-item">
		<?= anchor(route_to('postcodeAustraliaListList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('PostcodeAustraliaLists.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('postcode-australia-lists') ? ' active' : '')]); ?>
	</li>		
	<li class="nav-item">
		<?= anchor(route_to('stateList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('States.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('states') ? ' active' : '')]); ?>
	</li>		
	<li class="nav-item">
		<?= anchor(route_to('timezoneList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('Timezones.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('timezones') ? ' active' : '')]); ?>
	</li>
	<li class="nav-item">
		<?= anchor(route_to('xeroSalesGstList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('XeroSalesGsts.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('xero-sales-gsts') ? ' active' : '')]); ?>
	</li>
	</ul>

<!-- Templates Menu -->	

	</li>
	<li class="nav-item">
		<a class="nav-link" data-bs-toggle="collapse" data-bs-target="#menu_item2" href="#"> Templates <i class="bi small bi-caret-down-fill"></i> </a>
		<ul id="menu_item2" class="submenu collapse" data-bs-parent="#nav_accordion">
			<li class="nav-item">
				<?= anchor(route_to('fertilizerTemplateList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('FertilizerTemplates.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('fertilizer-templates') ? ' active' : '')]); ?>
			</li>
			<li class="nav-item">
				<?= anchor(route_to('irrigationTemplateList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('IrrigationTemplates.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('irrigation-templates') ? ' active' : '')]); ?>
			</li>
			<li class="nav-item">
				<?= anchor(route_to('pestDiseasesTemplateList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('PestDiseasesTemplates.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('pest-diseases-templates') ? ' active' : '')]); ?>
			</li>
			<li class="nav-item">
				<?= anchor(route_to('plantingTemplateList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('PlantingTemplates.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('planting-templates') ? ' active' : '')]); ?>
			</li>
			<li class="nav-item">
				<?= anchor(route_to('ppeTemplateList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('PpeTemplates.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('ppe-templates') ? ' active' : '')]); ?>
			</li>
			<li class="nav-item">
				<?= anchor(route_to('taskTemplateList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('TaskTemplates.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('task-templates') ? ' active' : '')]); ?>
			</li>
		</ul>
	</li>




	
	<li class="nav-item">
		<?= anchor(route_to('userList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('Users.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('users') ? ' active' : '')]); ?>
	</li>
	<li class="nav-item">
		<?= anchor(route_to('userGroupList'), '<svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg> ' . lang('AuthGroups.moduleTitle'), ['class' => 'nav-link' . ($currentModule == strtolower('user-groups') ? ' active' : '')]); ?>
	</li>
	</nav>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			document.querySelectorAll('.sidebar .nav-link').forEach(function(element) {

				element.addEventListener('click', function(e) {

					let nextEl = element.nextElementSibling;
					let parentEl = element.parentElement;

					if (nextEl) {
						e.preventDefault();
						let mycollapse = new bootstrap.Collapse(nextEl);

						if (nextEl.classList.contains('show')) {
							mycollapse.hide();
						} else {
							mycollapse.show();
							// find other submenus with class=show
							var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
							// if it exists, then close all of them
							if (opened_submenu) {
								new bootstrap.Collapse(opened_submenu);
							}
						}
					}
				}); // addEventListener
			}) // forEach
		});
		// DOMContentLoaded  end
	</script>