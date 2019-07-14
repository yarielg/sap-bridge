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
        $price = $proditem['price'] > 0 ? $proditem['price'] : 0;
        $name = ProdItems::getProditemNameByID($proditem['id']);
        $normal_price = ProdItems::getProditemPriceByID($proditem['id']);
        $link_flag = $normal_price == $price ? '<span class="active-state"></span>' : '<span class="inactive-state"></span>';
        echo "<tr>
                            <td>{$proditem['id']} </td>
                            <td>{$name}</td>
                            <td>$sku</td>
                            <td>$ {$price}</td>
                            <td>$link_flag</td>
                            <td>
                               <!-- <form action=''>
                                    <input type='text' name='page' value='products-menu' hidden>
                                    <input type='text' name='syncSAP' value='{$proditem['id']}' hidden>
                                    <button type='submit' class='btn btn-success'>Sync</button>
                                </form> -->
                            </td>
                            
                         </tr>";
    }
    ?>
    </tbody>
</table>
