<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
          Yeni Haber Ekle
      </h4>
  </div><!-- END column -->
  <div class="col-md-12">
    <div class="widget">
        <div class="widget-body">
            <form action="<?php echo base_url("news/save"); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Başlık</label>
                    <input class="form-control" placeholder="Başlık" name="title">
                    <?php if(isset($form_error)){ ?> <!--  Eğer bir hata varsa mesaj yazdırıyoruz -->
                    <small class="input-form-error"> <?php echo form_error("title"); ?></small>
                <?php } ?>
            </div>
            <div class="form-group">
                <label>Açıklama</label>
                <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
            </div>
            <div class="form-group">
                <label>Haberin Türü</label>
                <div id="control-demo-6 " >
                    <select class="form-control news_type_select" name="news_type">
                        <option value="image">Resim</option>
                        <option value="video">Video</option>
                    </select>
                </div>
            </div>
            <div class="form-group image_upload_container">
                <label>Resim Yükle</label>
                <input type="file" name="img_url" class="form-control">
            </div>

            <div class="form-group video_url_container">
                <label>Video Url</label>
                <input class="form-control" placeholder="Video linkini giriniz" name="video_url">
                <?php if(isset($form_error)){ ?> <!--  Eğer bir hata varsa mesaj yazdırıyoruz -->
                <small class="input-form-error"> <?php echo form_error("video_url"); ?></small>
            <?php } ?>
        </div>
        <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
        <a href="<?php echo base_url("news"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
    </form>
</div><!-- .widget-body -->
</div><!-- .widget -->
</div><!-- END column -->
</div>