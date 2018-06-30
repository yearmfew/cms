<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<b>$item->title</b> fotoğraflarını düzenliyorsunuz"; ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body ">
                <form data-url="<?php echo base_url("product/refresh_image_list/$item->id"); ?> "
                      action="<?php echo base_url("product/image_upload/$item->id"); ?> "
                      class="dropzone"
                      id="dropzone"
                      data-plugin="dropzone"
                      data-options="{ url: '<?php echo base_url("product/image_upload/$item->id"); ?>'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg">Yüklemek istediğiniz resimleri buraya sürükleyiniz.</h3>
                        <p class="m-b-lg text-muted">veya sadece tıklayın ve resimlerinizi seçin</p>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body image_list_container">

<?php $this->load->view("{$viewFolder}/{$subViewFolder}/render_elements/image_list_v"); ?>


        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div><!-- END column -->
</div>

