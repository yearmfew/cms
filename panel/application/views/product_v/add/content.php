<div class="row">
	<div class="col-md-12">
		<h4 class="m-b-lg">
			Yeni Ürün Ekle
		</h4>
	</div><!-- END column -->

	<div class="col-md-12">
		<div class="widget">
			
					<div class="widget-body">
						<form action = "<?php echo base_url("product/save"); ?>" method = "post" >
							<div class="form-group">
								<label for="exampleInputEmail1">Başlık</label>
								<input name="title" class="form-control"  placeholder="Başlık" >
							</div>
							<div class="form-group">
								<label>Açıklama</label>
							<textarea name ="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
				
							</div>
							
							
							<button type="submit" class="btn btn-primary btn-sm btn-outline">Kaydet</button>
							<a href="<?php echo base_url("product"); ?> " class="btn btn-danger btn-sm  btn-outline">İptal Et</a>
						</form>
					</div><!-- .widget-body -->
				</div>
	</div><!-- END column -->
</div>