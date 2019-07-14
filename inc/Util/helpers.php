<?php

/**
 * @param $stds => Std Array
 * @param $key
 * @param $value
 * @return array
 * This function receive an array of std objects and return a php array. eg array($key=>$value, ...)
 */
    function stdToArray($stds,$key,$value){
        $keys = array();
        $values = array();
        foreach($stds as $std){
            $items = (array)$std;
            array_push($keys , $items[$key]);
            array_push($values , $items[$value]);
        }
        return array_combine($keys, $values);
    }

    function removeEmptySku($products){
        foreach ($products as $id => $sku){
            if($sku == ''){
                unset($products[$id]);
            }
        }
        return $products;
    }

    function bootstrap_pagination( $max_num_pages, $echo = true ) {

        $pages = paginate_links( [
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'format'       => '?paged=%#%',
                'current'      => isset( $_GET['paged'])? $_GET['paged'] : 1, //max( 1, get_query_var( 'paged' ) ) doesn't work
                'total'        => $max_num_pages,
                'type'         => 'array',
                'show_all'     => false,
                'end_size'     => 3,
                'mid_size'     => 1,
                'prev_next'    => true,
                'prev_text'    => __( '« Prev' ),
                'next_text'    => __( 'Next »' ),
                'add_args'     => false,
                'add_fragment' => ''
            ]
        );
        if ( is_array( $pages ) ) {
            //$paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
            $pagination = '<div class="pagination"><ul class="pagination">';
            foreach ($pages as $page) {
                $pagination .= '<li class="page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
            }
            $pagination .= '</ul></div>';
            if ( $echo ) {
                echo $pagination;
            } else {
                return $pagination;
            }
        }

        return null;
    }

