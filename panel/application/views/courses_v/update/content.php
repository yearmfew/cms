<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <?php echo "<b>$item->title</b> kaydını düzenliyorsunuz"; ?>
    </h4>
  </div><!-- END column -->
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?php echo base_url("courses/update/$item->id"); ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Başlık</label>
            <input class="form-control" placeholder="Başlık" name="title" value="<?php echo $item->title; ?>">
            <?php if(isset($form_error)){ ?>
              <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
            <?php } ?>
          </div>
          <div class="form-group">
            <label>Açıklama</label>
            <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}">
             <?php echo $item->description; ?>
           </textarea>
         </div>

         <div class="row">
           <div class="form-group col-md-4"  style="position: relative;">
            <label for="datetimepicker5">Tarih seçin</label>
            <input type="text" name="event_date" value="<?php echo $item->event_date; ?> " id="datetimepicker5" class="form-control" data-plugin="datetimepicker" data-options="{ defaultDate: '3/27/2016', format:'YYYY-MM-DD HH:mm:ss' }">
             <?php if(isset($form_error)){ ?>
              <small class="pull-right input-form-error"> <?php echo form_error("event_date"); ?></small>
            <?php } ?>

          </div><!-- .form-group -->
    

          <div class="col-md-4 col-md-offset-1 form-group image_upload_container" ">
            <label>Görsel Seçiniz</label>
            <input type="file" name="img_url" class="form-control">
          </div>

          <div class="col-md-3 image_upload_container">
            <img src="<?php echo base_url("uploads/$viewFolder/$item->img_url"); ?> " alt="">
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-xs btn-outline">Güncelle</button>
        <a href="<?php echo base_url("courses"); ?>" class="btn btn-xs btn-danger btn-outline">İptal</a>
      </form>
    </div><!-- .widget-body -->
  </div><!-- .widget -->
</div><!-- END column -->
</div>