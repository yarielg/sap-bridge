<?php

use Inc\Functions\ProdItems;

include 'includes/_sap_settings.php'; //Including the sap settings fields fir use in javascript

//Controller Actions
if(isset($_POST['post_id'])){
    ProdItems::syncProditem($_POST['post_id'],$_POST['price']);
    echo '<div class="alert alert-success" role="alert">' .
        'Product updated' .
        '</div>';
}
$user = wp_get_current_user();
$user_price_list = esc_attr(get_the_author_meta( 'price_list', $user->id ));
$page = isset( $_GET['paged'])? $_GET['paged'] : 1;
$limit = 20;


$items = ProdItems::getAllItemsByPriceList($user_price_list);
$products = ProdItems::getAllProducts($limit,$page);

$proditems = ProdItems::mergeProductItems($products, $items);

?>

<div class="container">
    <div class="row"></div>
        <h3 class="text-center mb-2">List of Products</h3>
<?php
        include 'includes/proditem/_action_header.php';
        include 'includes/proditem/_proditem_list.php';

        include 'includes/proditem/_product_pagination.php';

?>
    </div>
<div>
