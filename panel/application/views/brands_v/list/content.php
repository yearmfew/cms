<div class="row">
	<div class="col-md-12">
		<h4 class="m-b-lg">
			Marka Listesi
			<a href="<?php echo base_url("brands/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
		</h4>
	</div><!-- END column -->

	<div class="col-md-12 col-sm-12">
		<div class="widget p-lg">
			<?php if (empty($items)) { ?>
				<div class="alert alert-info text-center">
					<p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a href="<?php echo base_url("brands/new_form"); ?>" >tıklayınız</a></p>
				</div>
			<?php } else { ?>
				<div class="table-responsive">
					
					
					<table class="table table-hover table-striped table-bordered content-container">
						<thead>
							<th class="order"><i class="fa fa-reorder"></i></th>
							<th class="w50">#id</th>
							<th class="w150">Baslik</th>
							<th class="w50">Logo</th>						
							<th class="w50">Durumu</th>
							<th>İşlemler</th>
						</thead>
						<tbody class="sortable" data-url ="<?php echo base_url("brands/rankSetter"); ?>">
							<?php foreach ($items as $item) { ?>
								<tr id="ord-<?php echo $item->id; ?>">
									<th class="order"><i class="fa fa-reorder"></i></th>
									<td><?php echo $item->id; ?> </td>
									<td ><?php echo $item->title; ?></td>
									<td>   
										<img  src="<?php echo get_picture($viewFolder, $item->img_url, "350x168");?>"
										alt="$item->img_url"
										class=" w50 img-rounded">
									</td>
									<td class="text-center">			
										<input 
										data-url = "<?php echo base_url("brands/isActiveSetter/$item->id"); ?>"
										class="isActive"
										type="checkbox" 
										data-size="small"
										data-switchery 
										data-color="#10c469" 
										<?php echo ($item ->isActive) ? "checked" : ""; ?>
										/>
									</td>
									<td class="text-center w150">
										<button
										data-url="<?php echo base_url("brands/delete/$item->id/$item->img_url"); ?>"
										class="btn btn-xs btn-danger btn-outline remove-btn">
										<i class="fa fa-trash"></i> Sil
									</button>
									<a href="<?php echo base_url("brands/update_form/$item->id"); ?> " class="btn btn-xs btn-info btn-outline"><i class="fa fa-pencil-square-o"></i>Düzenle</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			<?php } ?>
		</div>
	</div><!-- .widget -->
</div><!-- END column -->
</div>