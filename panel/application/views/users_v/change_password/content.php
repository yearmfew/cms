<div class="simple-page-wrap">
    <div class="simple-page-logo animated swing">
        <a href="index.html">
            <span><i class="fa fa-gg"></i></span>
            <span>CMS</span>
        </a>
    </div><!-- logo -->
    <div class="simple-page-form animated flipInY" id="login-form">
        <h4 class="form-title m-b-xl text-center">Cms için yeni şifre girin</h4>
        <form action="<?php echo base_url("change_pass/update_forgatten_password/$item->id"); ?>" method="post">
          

            <div class="form-group">
                <label>Yeni Şifrenizi Giriniz:

                <input id="sign-in-password" type="password" class="form-control" placeholder="Şifre" name="password">
                </label>
                <?php if(isset($form_error)){ ?>
                    <small class="pull-right input-form-error"> <?php echo form_error("password"); ?></small>
                <?php } ?>
            </div>

            <div class="form-group">
                <label>Şifrenizi Tekrar Giriniz:
                
                <input id="sign-in-password" type="password" class="form-control" placeholder="Şifre" name="re_password">
                </label>
                <?php if(isset($form_error)){ ?>
                    <small class="pull-right input-form-error"> <?php echo form_error("re_password"); ?></small>
                <?php } ?>
            </div>

            <button type="submit" class="btn btn-primary">Şifremi Değiştir</button>
        </form>
    </div><!-- #login-form -->


</div><!-- .simple-page-wrap -->