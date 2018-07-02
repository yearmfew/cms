<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Kullanıcı Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("users/save"); ?>" method="post" >
                    <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input class="form-control" placeholder="Kullanıcı Adınızı Giriniz" name="user_name" 
                        value="<?php echo isset($form_error) ? set_value("user_name") : ""; ?>" >
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("user_name"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Ad Soyad </label>
                        <input class="form-control" placeholder="Adınızı ve Soyadınızı giriniz" 
                        value="<?php echo isset($form_error) ? set_value("full_name") : ""; ?>"
                        name="full_name">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"
                            > <?php echo form_error("full_name"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>E-mail Adresi</label>
                        <input class="form-control"    value="<?php echo isset($form_error) ? set_value("email") : ""; ?>" type="email" placeholder="E-mail Adresinizi Giriniz" name="email">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("email"); ?></small>
                        <?php } ?>
                    </div>
                    
                    <div class="form-group">
                        <label>Şifre</label>
                        <input class="form-control" type="password" placeholder="Şifrenizi giriniz" name="password">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("password"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Şifre Tekrar</label>
                        <input class="form-control" type="password" placeholder="Şifrenizi giriniz" name="re_password">
                        <?php if(isset($form_error)){ ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("re_password"); ?></small>
                        <?php } ?>
                    </div>


                    <button type="submit" class="btn btn-primary btn-xs btn-outline">Kaydet</button>
                    <a href="<?php echo base_url("users"); ?>" class="btn btn-xs btn-danger btn-outline">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>