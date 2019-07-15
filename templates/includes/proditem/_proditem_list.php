<table class="table ">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Sku</th>
        <th scope="col">Price SAP B1</th>
        <th scope="col">State</th>
        <th scope="col">Actions</th>

    </tr>
    </thead>
    <tbody>

    <?php
    use Inc\Functions\ProdItems;

    foreach($proditems as $proditem){
        $sku = $proditem['sku'] ?: '<span class="badge badge-danger">WO/SKU</span>';
        $proditem_id = $proditem['id'];
        $price = $proditem['price'] > 0 ? $proditem['price'] : 0;
        $name = ProdItems::getProditemNameByID($proditem['id']);
        $normal_price = ProdItems::getProditemPriceByID($proditem['id']);
        $product_link = get_permalink( $proditem_id);
        $link_flag = $normal_price == $price ? '<span class="active-state"></span>' : '<span class="inactive-state"></span>';
        $disabled_sync_btn_flag = $proditem['sku'] ? '' : 'disabled';
        $tooltip_msg = $proditem['sku'] ? 'data-toggle="tooltip" title="Sync this product with SAP"' : 'data-toggle="tooltip" title="This Product need a sku to sync"';
        echo "<tr>
                            <td>{$proditem_id} </td>
                            <td>{$name}</td>
                            <td>$sku</td>
                            <td>$ {$price}</td>
                            <td>$link_flag</td>
                            <td>
                                <form action='' method='post'>
                                    <input type='text' name='post_id' hidden value='{$proditem['id']}'>
                                    <input type='text' name='price' hidden value='{$price}'>
                                    <span class='d-inline-block' tabindex='0' {$tooltip_msg}>
                                    <input type='submit'
                                     class='btn btn-success btn_sync_sap'
                                     sku='{$proditem['sku']}'
                                      id='btn_id_{$proditem_id}'
                                      {$disabled_sync_btn_flag} 
                                      value='Sync'
                                      />
                                  </span>
                                  
                                  <a class='btn btn-info' href='{$product_link}'>View</a>
                                </form>
                            </td>
                            
                         </tr>";
    }
    ?>
    </tbody>
</table>

