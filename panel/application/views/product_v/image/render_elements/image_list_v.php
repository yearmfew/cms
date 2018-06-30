<?php if(empty($item_images)) { ?>

    <div class="alert alert-info text-center">
        <p>Burada herhangi bir resim bulunmamaktadır.</a></p>
    </div>

<?php } else { ?>

    <table class="table table-bordered table-striped table-hover pictures_list">
        <thead>
        <th>#id</th>
        <th>Görsel</th>
        <th>Resim Adı</th>
        <th>Durumu</th>
        <th>İşlem</th>
        </thead>
        <tbody>

        <?php foreach($item_images as $image){ ?>

            <tr>
                <td class="w100 text-center">#<?php echo $image->id; ?></td>
                <td class="w100 text-center">
                    <img width="30" src="<?php echo base_url("uploads/{$viewFolder}/$image->img_url"); ?>" alt="<?php echo $image->img_url; ?>" class="img-responsive">
                </td>
                <td><?php echo $image->img_url; ?></td>
                <td class="w100 text-center">
                    <input
                            data-url="<?php echo base_url("product/isActiveSetter/"); ?>"
                            class="isActive"
                            type="checkbox"
                            data-size ="small"
                            data-switchery
                            data-color="#10c469"
                        <?php echo ($image->id) ? "checked" : ""; ?>
                    />
                </td>
                <td class="w100 text-center">
                    <button
                            data-url="<?php echo base_url("product/delete/"); ?>"
                            class="btn btn-xs btn-danger btn-outline remove-btn btn-block">
                        <i class="fa fa-trash"></i> Sil
                    </button>
                </td>
            </tr>

        <?php } ?>

        </tbody>

    </table>
<?php } ?>