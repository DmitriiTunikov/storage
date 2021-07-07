<?php

//include_once ROOT. '/models/Main.php';

class MainController {

	public function actionMainPage()
	{
		$db = Db::getConnection();

		require_once(ROOT . '/views/main/index.php');
		return true;
    }
}
?>