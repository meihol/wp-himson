<?php
/**
 * Importer the demo content
 * Hooks for importer
 * @since  1.0
 * @package Makaffo
 */
function makaffo_importer() {
	return array(
		array(
			'name'       => 'Home Factory 1',
			'preview'    => 'https://ot-makaffo.s3.amazonaws.com/images/home1.jpg',
			'content'    => 'https://ot-makaffo.s3.amazonaws.com/demo-content/demo-content.xml',
			'customizer' => 'https://ot-makaffo.s3.amazonaws.com/demo-content/customizer.dat',
			'widgets'    => 'https://ot-makaffo.s3.amazonaws.com/demo-content/widgets.wie',
			'sliders'    => 'https://ot-makaffo.s3.amazonaws.com/demo-content/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 1',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
		),
		array(
			'name'       => 'Home Factory 2',
			'preview'    => 'https://ot-makaffo.s3.amazonaws.com/images/home1.jpg',
			'content'    => 'https://ot-makaffo.s3.amazonaws.com/demo-content/demo-content.xml',
			'customizer' => 'https://ot-makaffo.s3.amazonaws.com/demo-content/customizer.dat',
			'widgets'    => 'https://ot-makaffo.s3.amazonaws.com/demo-content/widgets.wie',
			'sliders'    => 'https://ot-makaffo.s3.amazonaws.com/demo-content/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 4',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
		),
		array(
			'name'       => 'Home Metallurgy',
			'preview'    => 'https://ot-makaffo.s3.amazonaws.com/images/home2.jpg',
			'content'    => 'https://ot-makaffo.s3.amazonaws.com/demo-content/demo-content.xml',
			'customizer' => 'https://ot-makaffo.s3.amazonaws.com/demo-content/customizer.dat',
			'widgets'    => 'https://ot-makaffo.s3.amazonaws.com/demo-content/widgets.wie',
			'sliders'    => 'https://ot-makaffo.s3.amazonaws.com/demo-content/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 2',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
		),
		array(
			'name'       => 'Home Renewable energy',
			'preview'    => 'https://ot-makaffo.s3.amazonaws.com/images/home3.jpg',
			'content'    => 'https://ot-makaffo.s3.amazonaws.com/demo-content/demo-content.xml',
			'customizer' => 'https://ot-makaffo.s3.amazonaws.com/demo-content/customizer.dat',
			'widgets'    => 'https://ot-makaffo.s3.amazonaws.com/demo-content/widgets.wie',
			'sliders'    => 'https://ot-makaffo.s3.amazonaws.com/demo-content/sliders.zip',
			'pages'      => array(
				'front_page' => 'Home 3',
				'blog'       => 'Blog',
				'shop'       => 'Shop',
				'cart'       => 'Cart',
				'checkout'   => 'Checkout',
				'my_account' => 'My Account',
			),
		)
	);
}

add_filter( 'soo_demo_packages', 'makaffo_importer', 30 );