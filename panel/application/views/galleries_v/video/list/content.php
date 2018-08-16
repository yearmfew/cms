<div class="row">
	<div class="col-md-12">
		<h4 class="m-b-lg">
			<b><?php echo $item->title; ?></b> galerisine ait videolar			
			<a href="<?php echo base_url("galleries/new_gallery_video_form/$item->id"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
		</h4>
	</div><!-- END column -->

	<div class="col-md-12 col-sm-12">
		<div class="widget p-lg">
			<?php if (empty($items)) { ?>
				<div class="alert alert-info text-center">
					<p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a href="<?php echo base_url("galleries/new_gallery_video_form/$item->id"); ?>" >tıklayınız</a></p>
				</div>
			<?php } else { ?>
				<div class="table-responsive">
					
					
					<table class="table table-hover table-striped table-bordered content-container">
						<thead>
							<th class="order"><i class="fa fa-reorder"></i></th>
							<th class="w50">#id</th>
							<th class="w150">Video Adı</th>
							<th>Url</th>
							<th class="w100">Görsel</th>						
							<th class="w50">Durumu</th>
							<th>İşlemler</th>
						</thead>
						<tbody class="sortable" data-url ="<?php echo base_url("galleries/fileRankSetter/$gallery_type"); ?>">
							<?php foreach ($items as $item) { ?>
								<tr id="ord-<?php echo $item->id; ?>">
									<th class="order"><i class="fa fa-reorder"></i></th>
									<td><?php echo $item->id; ?> </td>
									<td ><?php echo $item->title; ?></td>
									<td><?php echo $item->url; ?></td> 
									<td>   
											<iframe
											width="100"
											src="<?php echo $item->url; ?>"
											frameborder="0"
											gesture="media"
											allow="encrypted-media"
											allowfullscreen>

										</iframe>
								</td>
								<td class="text-center">			
									<input 
									data-url = "<?php echo base_url("galleries/fileIsActiveSetter/$item->id/$gallery_type"); ?>"
									class="isActive"
									type="checkbox" 
									data-size="small"
									data-switchery 
									data-color="#10c469" 
									<?php echo ($item ->isActive) ? "checked" : ""; ?>
									/>
								</td>
								<td class="text-center">
									<button
									data-url="<?php echo base_url("galleries/fileDelete/$item->id/$item->gallery_id/$gallery_type"); ?>"
									class="btn btn-xs btn-danger btn-outline remove-btn">
									<i class="fa fa-trash"></i> Sil
								</button>
								<a href="<?php echo base_url("galleries/update_gallery_video_form/$item->id"); ?> " class="btn btn-xs btn-info btn-outline"><i class="fa fa-pencil-square-o"></i>Düzenle</a>

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