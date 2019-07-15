<?php
use Inc\Functions\ProdItems;
//BULK OPERATIONS
if(isset($_POST['apply_bulks']) && isset($_POST['checkbox_posts'])){

    foreach ($_POST['checkbox_posts'] as $proditem_id) {
        $id_price = explode('_',$proditem_id);
        $id = (int)$id_price[0];
        $price = (float)$id_price[1];
        if($price > 0){
            switch ($_POST['bulk_operation']) {
                case 'sync':

                    ProdItems::syncProditem($id, $price);
                    break;

                default:
                    echo "You need to choose something";
                    break;
            }
        }
    }
    //var_dump($_POST['checkbox_posts']);exit;
}
?>

<form action="" method="post" class="form-inline">
    <div class="form-group" >
        <select class="form-control mr-2" name="bulk_operation" id="">
            <option value="default">Select Option</option>
            <option value="sync">Sync</option>
            <!--<option value="delete">Delete</option>-->
        </select>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary btn-sm" name="apply_bulks" value="Apply">
    </div>
