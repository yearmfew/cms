<?php $settings = get_settings(); ?>

<div class="header-container">
    <!-- header-top start -->
    <!-- classes:  -->
    <!-- "dark": dark version of header top e.g. class="header-top dark" -->
    <!-- "colored": colored version of header top e.g. class="header-top colored" -->
    <!-- ================ -->
    <div class="header-top colored">
        <div class="container">
            <div class="row">
                <div class="col-2 col-md-5">
                    <!-- header-top-first start -->
                    <!-- ================ -->
                    <div class="header-top-first clearfix">
                        <ul class="social-links circle small clearfix hidden-sm-down">
                            <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                            <li class="skype"><a target="_blank" href="http://www.skype.com"><i class="fa fa-skype"></i></a></li>
                            <li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                            <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
                            <li class="youtube"><a target="_blank" href="http://www.youtube.com"><i class="fa fa-youtube-play"></i></a></li>
                            <li class="flickr"><a target="_blank" href="http://www.flickr.com"><i class="fa fa-flickr"></i></a></li>
                            <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                            <li class="pinterest"><a target="_blank" href="http://www.pinterest.com"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                        <div class="social-links hidden-md-up circle small">
                            <div class="btn-group dropdown">
                                <button id="header-top-drop-1" type="button" class="btn dropdown-toggle dropdown-toggle--no-caret" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-share-alt"></i></button>
                                <ul class="dropdown-menu dropdown-animation" aria-labelledby="header-top-drop-1">
                                    <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                                    <li class="skype"><a target="_blank" href="http://www.skype.com"><i class="fa fa-skype"></i></a></li>
                                    <li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                                    <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i class="fa fa-google-plus"></i></a></li>
                                    <li class="youtube"><a target="_blank" href="http://www.youtube.com"><i class="fa fa-youtube-play"></i></a></li>
                                    <li class="flickr"><a target="_blank" href="http://www.flickr.com"><i class="fa fa-flickr"></i></a></li>
                                    <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                                    <li class="pinterest"><a target="_blank" href="http://www.pinterest.com"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- header-top-first end -->
                </div>
                <div class="col-10 col-md-7">

                    <!-- header-top-second start -->
                    <!-- ================ -->
                    <div id="header-top-second"  class="clearfix text-right">
                        <ul class="list-inline">
                            <li class="list-inline-item"><i class="fa fa-phone pr-1 pl-10"></i>+12 123 123 123</li>
                            <li class="list-inline-item"><i class="fa fa-envelope-o pr-1 pl-10"></i> theproject@mail.com</li>
                        </ul>
                    </div>
                    <!-- header-top-second end -->

                </div>
            </div>
        </div>
    </div>
    <!-- header-top end -->

    <!-- header start -->
    <!-- classes:  -->
    <!-- "fixed": enables fixed navigation mode (sticky menu) e.g. class="header fixed clearfix" -->
    <!-- "fixed-desktop": enables fixed navigation only for desktop devices e.g. class="header fixed fixed-desktop clearfix" -->
    <!-- "fixed-all": enables fixed navigation only for all devices desktop and mobile e.g. class="header fixed fixed-desktop clearfix" -->
    <!-- "dark": dark version of header e.g. class="header dark clearfix" -->
    <!-- "centered": mandatory class for the centered logo layout -->
    <!-- ================ -->
    <header class="header fixed fixed-desktop clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-auto hidden-md-down pl-3">
                    <!-- header-first start -->
                    <!-- ================ -->
                    <div class="header-first clearfix">

                        <!-- logo -->
                        <div id="logo" class="logo">
                            <a href="<?php echo base_url(); ?>"><img id="logo_img" src="<?php echo base_url("assets/images");?>/logo_blue.png" alt="The Project"></a>
                        </div>

                        <!-- name-and-slogan -->
                        <div class="site-slogan">
                            <?php echo $settings->slogan; ?>
                        </div>

                    </div>
                    <!-- header-first end -->

                </div>
                <div class="col-lg-8 ml-lg-auto">

                    <!-- header-second start -->
                    <!-- ================ -->
                    <div class="header-second clearfix">

                        <!-- main-navigation start -->
                        <!-- classes: -->
                        <!-- "onclick": Makes the dropdowns open on click, this the default bootstrap behavior e.g. class="main-navigation onclick" -->
                        <!-- "animated": Enables animations on dropdowns opening e.g. class="main-navigation animated" -->
                        <!-- ================ -->
                        <div class="main-navigation main-navigation--mega-menu  animated">
                            <nav class="navbar navbar-expand-lg navbar-light p-0">
                                <div class="navbar-brand clearfix hidden-lg-up">

                                    <!-- logo -->
                                    <div id="logo-mobile" class="logo">
                                        <a href="<?php echo base_url(); ?>"><img id="logo-img-mobile" src="<?php echo base_url("assets/images");?>/logo_blue.png" alt="<?php echo $settings->company_name; ?>"></a>
                                    </div>

                                    <!-- name-and-slogan -->
                                    <div class="site-slogan">
                                        <?php echo $settings->slogan; ?>
                                    </div>

                                </div>

                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-1" aria-controls="navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                                    <!-- main-menu -->

                                    <ul class="navbar-nav ml-xl-auto">

                                        <li class="nav-item ">
                                            <a href="<?php echo base_url(); ?>" class="nav-link">Anasayfa</a>
                                        </li>

                                        <li class="nav-item dropdown ">
                                            <a href="#" class="nav-link dropdown-toggle" id="third-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hakkımızda</a>
                                            <ul class="dropdown-menu" aria-labelledby="third-dropdown">
                                                <li ><a href="<?php echo base_url("hakkimizda"); ?>">Hakkımızda</a></li>
                                                <li ><a href="<?php echo base_url("haberler"); ?>">Haberler</a></li>
                                                <li ><a href="<?php echo base_url("portfolyo-listesi"); ?>">Portfolyo</a></li>
                                                <li ><a href="<?php echo base_url("referanslar"); ?>">Referanslar</a></li>
                                                <li ><a href="<?php echo base_url("hizmetlerimiz"); ?>">Hizmetlerimiz</a></li>
                                            </ul>
                                        </li>

                                        <li class="nav-item dropdown ">
                                            <a href="#" class="nav-link dropdown-toggle" id="third-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Galeriler</a>
                                            <ul class="dropdown-menu" aria-labelledby="third-dropdown">
                                                <li ><a href="<?php echo base_url(); ?>">Resim Galerisi</a></li>
                                                <li ><a href="<?php echo base_url(); ?>">Video Galerisi</a></li>
                                                <li ><a href="<?php echo base_url(); ?>">Dosya Galerisi</a></li>
                                            </ul>
                                        </li>


                                        <li class="nav-item ">
                                            <a href="<?php echo base_url("urun-listesi"); ?>" class="nav-link">Ürünlerimiz</a>
                                        </li>

                                        <li class="nav-item ">
                                            <a href="<?php echo base_url("egitim-listesi"); ?>" class="nav-link">Eğitimlerimiz</a>
                                        </li>

                                        <li class="nav-item ">
                                            <a href="<?php echo base_url("markalar"); ?>" class="nav-link">Markalar</a>
                                        </li>

                                    </ul>
                                    <!-- main-menu end -->
                                </div>
                            </nav>
                        </div>
                        <!-- main-navigation end -->
                    </div>
                    <!-- header-second end -->

                </div>
                <div class="col-auto hidden-md-down pl-0 pl-md-1">
                    <!-- header dropdown buttons -->
                    <div class="header-dropdown-buttons">
                        <a href="<?php echo base_url("iletisim"); ?>" class="btn btn-sm btn-default">İletişim <i class="fa fa-envelope-o pl-1"></i></a>
                    </div>
                    <!-- header dropdown buttons end-->
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->
</div>

