<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Marka Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("references/save"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" placeholder="Başlık" name="title">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group image_upload_container">
                        <label>Logo Ekleyin</label>
                        <input type="file" name="img_url" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-xs btn-outline">Kaydet</button>
                    <a href="<?php echo base_url("references"); ?>" class="btn btn-xs btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>