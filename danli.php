<?php
/**
* 单例模式
*/
class ClassName
{
	private static $instance = null;

	public function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct()
	{
	}

	private function __clone()
	{
	}
}
?>
