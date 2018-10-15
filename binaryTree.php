<?php
//Node节点
class Node{
	public $key;
	public $parent;
	public $left;
	public $right;

	public function __construct($key){
		$this->key = $key;
		$this->parent = null;
		$this->left = null;
		$this->right = null;
	}
}

//二叉树
class Bst{
	public $root;

	//初始化
	public function init($arr){
		$this->root = new Node($arr[0]);
		for ($i = 1; $i < count($arr); $i++) { 
			$this->insert($arr[$i]);
		}
	}

	public function insert($key){
		if (!is_null($this->search($key))) {
			var_dump($key);
			throw new Exception("key已存在于树中，请勿重复插入", 1);
		}

		$root = $this->root;
		$newNode = new Node($key);
		$preNode = null;
		$current = $root;

		while (!is_null($current)) {
			$preNode = $current;
			if ($newNode->key > $current->key) {
				$current = $current->right;
			} else {
				$current = $current->left;
			}
		}

		if (is_null($preNode)) {
			//树是空树
			$this->root = $newNode;
		} else {
			if ($newNode->key > $preNode->key) {
				$preNode->right = $newNode;
			} else {
				$preNode->left = $newNode;
			}
		}

		return true;
	}

	//查找一个key是否在二叉树中
	public function search($key){
		$current = $this->root;
		while (!is_null($current)) {
			if ($key == $current->key) {
				return $current;
			} elseif ($key > $current->key) {
				$current = $current->right;
			} elseif ($key < $current->key) {
				$current = $current->left;
			}
		}

		return $current;
	}
}

//test
$arr = [1,32,4,54,6,88,23,56,68,2222,71,26,90];
$tree = new Bst;
$tree->init($arr);
$tree->insert(2221);
// $tree->search(23);
if (!is_null($tree->search(22))) {
	echo "======有" . 22;
}
// var_dump($tree);

?>