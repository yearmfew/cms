  <section class="app-content">
    <div class="row">
     

      <div class="col-md-12">
        <div class="panel panel-default new-message">           
          <form action="<?php echo base_url("Send_email/send"); ?>" method="post" role="form" >
            <div class="panel-body">
              <div class="form-group">
                <label >Kime </label>
     
                <input type="text" class="form-control" name="to" placeholder="E-posta gönderilecek adresi giriniz...">
              </div><!-- .form-group -->

              <div class="form-group">
                <label >Konu</label>
        
                <input type="text" name="subject" class="form-control" placeholder="Mail Başlığını giriniz">
              </div><!-- .form-group -->
              <label>Mesaj</label>
              
              <textarea name="message" class="form-control full-wysiwyg" placeholder="Mailinizi yazınız..."></textarea>
            </div><!-- .panel-body -->

            <div class="panel-footer clearfix">
              <div class="pull-right">
                <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                <button type="button" class="btn btn-success"><i class="fa fa-save"></i></button>
                <button type="submit"  class="btn btn-primary">Gönder <i class="fa fa-send"></i></button>
              </div>
            </div><!-- .panel-footer -->
          </form>
        </div><!-- .panel -->
      </div><!-- END column -->
    </div><!-- .row -->
  </section><!-- .app-content -->
