<?php  

/*
*
* @package Yariko
*
*/

namespace Inc\Pages;

class Pages{

	public function register(){

			$pages = array(
					new MenuPage([
							'title' => 'SAP B1 WP',
							'menu_slug' => 'main-menu',
							'callback' => array($this,'admin_index'),
							'icon_url' => 'dashicons-image-rotate-right',
							'position' => 110
					]),
					new MenuPage([
							'parent_slug' => 'main-menu',
							'title' => 'Settings',
							'menu_slug' => 'main-menu',
							'callback' => array($this,'admin_index'),
					]),
					new MenuPage([
							'parent_slug' => 'main-menu',
							'title' => 'Price List Group',
							'menu_slug' => 'price-list-menu',
							'callback' => array($this,'group_index'),
					]),
					new MenuPage([
							'parent_slug' => 'main-menu',
							'title' => 'Quest Products',
							'menu_slug' => 'products-menu',
							'callback' => array($this,'product_index'),
					])
			);

			foreach ($pages as $menu) {
				$menu->addMenuElement();
			}

	}

	function admin_index(){
		require_once PLUGIN_PATH . 'templates/admin.php';
	}

	function group_index(){
		require_once PLUGIN_PATH . 'templates/group-list.php';
	}

	function product_index(){
		require_once PLUGIN_PATH . 'templates/quest-products.php';
	}

}