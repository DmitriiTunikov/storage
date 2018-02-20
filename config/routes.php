<?php
return array(
//main page
'main/change_base/([0-9]+)' => 'main/changeBase/$1',
'main/pay/([0-9]+)'=>'main/pay/$1',
'main' => 'main/mainPage',
//Users
	'users/login' => 'users/login',
	'users/enter' => 'users/enter',
	'users/exit' => 'users/exit',
//archive
    'archive/search_order' => 'archive/searchOrder',
    'archive' => 'archive/showArchive',
//storage
    'storage/search_product' => 'storage/searchProduct',
    'storage/add_product_to_base' => 'storage/addProductToBase',
    'storage/change_product_to_base' => 'storage/changeProductToBase',
    'storage/add_product' => 'storage/addProduct',
    'storage/change_product/([0-9]+)' => 'storage/changeProduct/$1',
    'storage/([0-9]+)' => 'storage/showStorage/$1',
//orders
    'orders/save_order' => 'orders/saveOrder',
	'orders/add_product/([0-9]+)' => 'orders/addProduct/$1',
	'orders/add' => 'orders/addOrder',
	'orders/back_to_order' => 'orders/backToOrder',
	'orders/score_order' => 'orders/scoreOrder',
	'orders/changeOrder' => 'orders/changeOrder',
	'orders/deleteProduct/([0-9]+)' => 'orders/deleteProduct/$1',
	'orders/delete' => 'orders/deleteOrder',
//products
    'products/search_product' => 'products/searchProduct',
    'products/showProducts/([0-9]+)' => 'products/showProducts/$1',
	);