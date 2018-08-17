<section class="main-container">
    <div class="container">
        <h1 class="page-title">Ürün Listesi</h1>
        <p>Kullandığımız ürünlerin listesini aşağıda görebilirsiniz</p>
        <div class="separator-2"></div>


        <!-- isotope filters start -->
              <!-- <div class="filters">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#" data-filter="*">All</a></li>
                  <li class="nav-item"><a class="nav-link" href="#" data-filter=".web-design">Web design</a></li>
                  <li class="nav-item"><a class="nav-link" href="#" data-filter=".app-development">App development</a></li>
                  <li class="nav-item"><a class="nav-link" href="#" data-filter=".site-building">Site building</a></li>
                </ul>
            </div> -->
            <!-- isotope filters end -->

<!-- 
    <div class="row isotope-container grid-space-10"> -->
        <div class="row">
            <!--         <div class="col-sm-4 isotope-item web-design"> -->

                <?php foreach ($products as $product) {
                    ?>

                    <div class="col-sm-4" >
                        <div class=" image-box style-2 mb-20 bordered light-gray-bg">
                            <div class="overlay-container overlay-visible">


                                <?php $image = get_product_cover_image($product->id);

                                $image =  ($image) ? base_url("uploads/product_v/$image") : base_url("assets/images/portfolio-1.jpg"); 
                                ?>

                                <img style="height:250px;" src="<?php echo $image;?>" alt="">
                                <div class="overlay-bottom text-left">
                                    <p class="lead margin-clear"><?php echo $product->title;  ?></p>
                                </div>
                            </div>
                            <div class="body">
                                <p class="small mb-10 text-muted"><i class="icon-calendar"></i> <?php echo get_readable_date($product->createdAt); ?> <i class="pl-10 icon-tag-1"></i> Web Design</p>
                                <p><?php echo character_limiter(strip_tags($product->description), 40); ?></p>
                                <a href="<?php echo base_url("urun-detay/$product->url"); ?>" class="btn btn-default btn-sm btn-hvr hvr-sweep-to-right margin-clear">Read More<i class="fa fa-arrow-right pl-10"></i></a>
                            </div>
                        </div>
                    </div>


                <?php } ?>

            </div>
        </div>
    </section>