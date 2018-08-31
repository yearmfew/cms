<div class="wrap">
	<section class="app-content content-container">
		<div class="row">
			<div class="col-md-12">
				<h4 class="m-b-lg">
					Slayt Listesi
					<a href="<?php echo base_url("slides/new_form"); ?>" class="btn btn-outline btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
				</h4>

			</div>
		</div>
		
		<ul  class="gallery row  sortable2" id="sortable" data-url="<?php echo base_url("slides/rankSetter"); ?>">

			<?php foreach ($items as $item) { ?> 
				<li id="ord-<?php echo $item->id; ?>" class="col-xs-12 col-sm-4 col-md-3" >
					<div class="gallery-item">
						<div class="thumb">
							<div class="caption text-center">

								<?php echo character_limiter($item->title, 10);  ?>  
								<input 
								data-url="<?php echo base_url("slides/isActiveSetter/$item->id"); ?>"
								class="isActive"
								type="checkbox"
								data-size = "small"
								data-switchery
								data-color="#10c469"
								<?php echo ($item->isActive) ? "checked" : ""; ?>
								/>

								

							</div>


							<img class="img-responsive"  src="<?php echo get_picture($viewFolder, $item->img_url, "1920x650"); ?>" alt="<?php echo $item->url; ?>">

						</div> <br>

						<button
						data-url = "<?php echo base_url("slides/update_form/$item->id"); ?>"
						class="btn btn-sm btn-info btn-outline btn-brl "
						><i class="fa fa-pencil-square-o"></i>Düzenle</button>

						<button
						data-url="<?php echo base_url("slides/delete/$item->id/$item->img_url"); ?>"
						class="btn btn-sm btn-danger btn-outline pull-right remove-btn">
						<i class="fa fa-trash"></i>Sil</button>


					</div>

				</li>
			<?php } ?>
		</ul>

	</section><!-- #dash-content -->
</div><!-- .wrap -->

