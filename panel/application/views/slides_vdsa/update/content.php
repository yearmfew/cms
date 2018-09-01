<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <?php echo "<b>$item->title</b> kaydını düzenliyorsunuz"; ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("slides/update/$item->id/$item->img_url"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" placeholder="Başlık" name="title" value="<?php echo $item->title; ?>">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"><?php echo $item->description; ?></textarea>
                    </div>

                    <div class="row mb-1">

                        <div class="col-md-3 image_upload_container">
                            <img src="<?php echo get_picture($viewFolder, $item->img_url,"1920x650"); ?>" alt="" class="img-responsive">
                        </div>

                        <div class="col-md-9 form-group image_upload_container">
                            <label>Görsel Seçiniz</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>

                    </div>


                    <div class="form-group ">
                        <label>Buton Kullanımı</label>
                        <input
                        <?php echo ($item->allowButton)  ? "checked" : ""; ?> 
                        class="form-control button_usage_btn"
                        name="allowButton"
                        type="checkbox"
                        data-switchery
                        data-size="small"
                        data-color="#10c469"
                        />
                    </div>


                    <div class="button-information-container " style=" display: <?php echo ($item->allowButton)  ? "block" : "none"; ?> ">
                     <div class="form-group">
                        <label>Button Başlığı</label>
                        <input class="form-control" value="<?php echo $item->button_caption; ?>" name="button_caption">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("button_caption"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>URL</label>
                        <input class="form-control" value="<?php echo $item->button_caption; ?>" name="button_url">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("button_url"); ?></small>
                        <?php } ?>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary btn-xs btn-outline">Güncelle</button>
                <a href="<?php echo base_url("slides"); ?>" class="btn btn-xs btn-danger btn-outline">İptal</a>
            </form>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div><!-- END column -->
</div>