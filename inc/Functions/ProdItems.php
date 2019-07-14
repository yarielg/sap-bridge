<?php
namespace Inc\Functions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Class ProdItems
 * @package Inc\Functions
 * @description Clase que que recupera los Items de SAP y los Productos de WooCommerce, y despues  realiza operaciones en Woocommerce
 */
class ProdItems
{


    static function proditemIsLinked($sku){

    }

    public static function getProditemNameByID($id){
        global $wpdb;

        $results = $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM $wpdb->prefix" . "posts WHERE ID=%d", $id)
        );

        return $results[0]->post_title;
    }

    public static function getProditemPriceByID($id){
        global $wpdb;

        $results = $wpdb->get_results(
            $wpdb->prepare("SELECT * FROM $wpdb->prefix" . "postmeta WHERE post_id=%d AND meta_key=%s", $id,'_price')
        );

        return $results[0]->meta_value;
    }

    public static function countProditems(){
        global $wpdb;

        $results = $wpdb->get_results(
            $wpdb->prepare("SELECT * FROM $wpdb->prefix" . "postmeta WHERE meta_key=%s", '_sku')
        );

        return count($results);
    }

    public static function getAllProducts($limit = 25,$page = 3) {
        global $wpdb;

        $offset = $limit*($page-1);
        $results = $wpdb->get_results(
            $wpdb->prepare("SELECT * FROM $wpdb->prefix" . "postmeta WHERE meta_key=%s LIMIT %d,%d", '_sku',$offset,$limit)
        );
        return stdToArray($results,'post_id','meta_value');
    }

    static function getAllItemsByPriceList($user_price_list){

        $qsap_ip = get_option('qsap_ip');
        $qsap_port = get_option('qsap_port');
        $qsap_key = get_option('qsap_key');

        $client = new Client([
            'base_uri' => "https://$qsap_ip:$qsap_port/",
            'timeout' => 10,
            'curl' => array( CURLOPT_SSL_VERIFYPEER => false) //desactivamos el certificado SSL
        ]);

        $response =  null;

        try{
            $response = $client->request('GET', "ItemService.svc/getItems?key=$qsap_key&itemcode=ALL&cardcode=ALL&customerpricelist=$user_price_list");

            $data = $response->getBody()->getContents();
            $dataStd = (array)json_decode($data);
            $dataArray = stdToArray($dataStd, 'SKU', 'CustomerPrice'); //Obteniendo array(sku => price, ...)


            return $dataArray;
        }catch (RequestException $e){
            return null;
        }
    }

    static function mergeProductItems($products , $items){ //devuelve un arreglo solo los productos que estan en woo con sus respectivos precios
        $finalproducts = array();
        foreach ($products as $id => $sku){
            if(array_key_exists($sku, $items)){
                array_push($finalproducts, array(
                    'id' => $id,
                    'sku' => $sku,
                    'price' => $items[$sku]
                ));
            }else{
                array_push($finalproducts, array(
                    'id' => $id,
                    'sku' => $sku,
                    'price' => -6 //representa que el sku del producto no se encuentra en SAP
                ));
            }
        }

        return $finalproducts;
    }

    static function updateProducts($products,$quantity = 25){
        $countUpdated = 0;
        $updatedProducts = array();
        foreach($products as $product){
            if($countUpdated <= $quantity){
                update_post_meta($product['id'], '_regular_price', $product['price']+0.5);
                update_post_meta($product['id'], '_price', $product['price']);
                array_push($updatedProducts, $product);
                $countUpdated ++;
            }

        }
        return $updatedProducts;
    }

}