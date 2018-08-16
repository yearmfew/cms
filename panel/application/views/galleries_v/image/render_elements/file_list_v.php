<?php if(empty($items)) { ?>

    <div class="alert alert-info text-center">
        <p>Burada herhangi bir veri bulunmamaktadır.</a></p>
    </div>

<?php } else { ?>


<?php switch ($gallery_type) {
    case 'image':
         $title = "Resim Adı";
        break;
    case 'file':
         $title = "Dosya Adı";
        break;
    default:
        # code...
        break;
} ?>


    <table class="table table-bordered table-striped table-hover pictures_list">
        <thead>
            <th class="order"><i class="fa fa-reorder"></i></th>
            <th class="w50">#id</th>
            <th>Görsel</th>
            <th><?php echo $title; ?></th>
            <th>Durumu</th>
            
            <th >İşlem</th>
        </thead>
        <tbody class="sortable" data-url="<?php echo base_url("galleries/fileRankSetter/$gallery_type"); ?>">

            <?php foreach($items as $item){ ?>

                <tr id="ord-<?php echo $item->id; ?>">
                    <td class="order"><i class="fa fa-reorder"></i></td>
                    <td class="w50 text-center">#<?php echo $item->id; ?></td>
                    <td class="w100 text-center">

                        <?php if ($gallery_type=="image"){ ?>
                            <img width="30" src="<?php echo base_url("$item->url"); ?>" alt="<?php echo $item->url; ?>" class="img-responsive"> 
                        <?php } else if( $gallery_type=="file" ){ ?>

                            <i class="fa fa-folder fa-2x"></i>
                        <?php } ?>
                    </td>
                    <td><?php echo $item->title; ?></td>
                    <td class="w50 text-center">
                        <input
                        data-url="<?php echo base_url("galleries/fileIsActiveSetter/$item->id/$gallery_type"); ?>"
                        class="isActive"
                        type="checkbox"
                        data-size ="small"
                        data-switchery
                        data-color="#10c469"
                        <?php echo ($item->isActive) ? "checked" : ""; ?>
                        />
                    </td>

                    <td class="w100 text-center">
                        <button
                        data-url="<?php echo base_url("galleries/fileDelete/$item->id/$item->gallery_id/$gallery_type"); ?>"
                        class="btn btn-xs btn-danger btn-outline remove-btn btn-block">
                        <i class="fa fa-trash"></i> Sil
                    </button>
                </td>
            </tr>

        <?php } ?>

    </tbody>

</table>
<?php } ?>