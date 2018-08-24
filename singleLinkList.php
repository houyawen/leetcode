<?php
/*
单链表
*/

class Node
{
    public $data = '';
    public $next = null;

    public function __construct($data = '', $next = null)
    {
        $this->data = $data;
        $this->next = $next;
    }
}

/**
* 
*/
class SingleLinkList
{
    public $header = null;

    public function __construct($hearData)
    {
        $this->header = new Node($hearData);
    }

    public function getLinkLength()
    {
        $length = 1;
        $currentNode = $this->header;

        while (!is_null($currentNode->next)) {
            $length++;
            $currentNode = $currentNode->next;
        }

        return $length;
    }

    public function addNode($node)
    {
        $currentNode = $this->header;
        while (!is_null($currentNode->next)) {
            $currentNode = $currentNode->next;
        }

        $currentNode->next = $node;
    }

    public function showLinks()
    {
        $currentNode = $this->header;
        while (!is_null($currentNode->next)) {
            echo $currentNode->data . '->';
            $currentNode = $currentNode->next;
        }
        echo $currentNode->data;
    }

    public function addNodeAfterLocation($node, $location)
    {
        if ($location >= $this->getLinkLength()) {
            throw new Exception("插入位置不对", 1);
        }

        $currentNode = $this->header;
        $i = 1;

        while (!is_null($currentNode->next)) {
            if ($i == $location) {
                $node->next = $currentNode->next;
                $currentNode->next = $node;
                break;
            }
            $currentNode = $currentNode->next;
            $i++;
        }
    }

    public function deleteLocation($location)
    {
        if ($location > $this->getLinkLength()) {
            throw new Exception("删除的位置不对", 2);
        }

        $currentNode  = $this->header;
        $i = 1;
        while (!is_null($currentNode->next)) {
            if ($i == $location) {
                $currentNode->next = $currentNode->next->next;
                break;
            }

            $currentNode = $currentNode->next;
            $i++;
        }
    }
}

//test
$singleLinkList = new SingleLinkList('1');
$singleLinkList->addNode(new Node('2'));
$singleLinkList->addNode(new Node('3'));
$singleLinkList->addNode(new Node('4'));
$singleLinkList->addNode(new Node('5'));
$singleLinkList->addNode(new Node('6'));
// $singleLinkList->addNodeAfterLocation(new Node('testInsert'), 4);
// $singleLinkList->deleteLocation(2);

$singleLinkList->showLinks();
?>