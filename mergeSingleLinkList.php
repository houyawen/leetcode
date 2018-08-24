<?php
/*
单链表的合并
*/
include './singleLinkList.php';

//merge两个单链表
function mergeSingleLinkList
(
    singleLinkListInterface $singleLinkList1,
    singleLinkListInterface $singleLinkList2
) 
{
    $header1 = $singleLinkList1->header;
    $header2 = $singleLinkList2->header;

    $reheader = $header1->data < $header2->data ? $header1 : $header2;

    if ($header1->data < $header2->data) {
        $headerData = $header1->data;
        $header1 = $header1->next;
    } else {
        $headerData = $header2->data;
        $header2 = $header2->next;
    }

    $returnLink = new SingleLinkList($headerData);
    $currentNode = $returnLink->header;

    while ($header1 && $header2) {
        if ($header1->data <= $header2->data) {
            $currentNode->next = $header1;
            $header1 = $header1->next;
        } else {
            $currentNode->next = $header2;
            $header2 = $header2->next;
        }

        $currentNode = $currentNode->next;
    }

    if (!is_null($header1)) {
        $currentNode->next = $header1;
    }
    if (!is_null($header2)) {
        $currentNode->next = $header2;
    }

    return $returnLink;
}

//test
$singleLinkList1 = new SingleLinkList('1');
$singleLinkList1->addNode(new Node('2'));
$singleLinkList1->addNode(new Node('5'));
$singleLinkList1->addNode(new Node('9'));
$singleLinkList1->addNode(new Node('10'));
$singleLinkList1->addNode(new Node('13'));

$singleLinkList2 = new SingleLinkList('3');
$singleLinkList2->addNode(new Node('7'));
$singleLinkList2->addNode(new Node('8'));
$singleLinkList2->addNode(new Node('11'));
$singleLinkList2->addNode(new Node('20'));
$singleLinkList2->addNode(new Node('30'));

$mergeRes = mergeSingleLinkList($singleLinkList1, $singleLinkList2);
$mergeRes->showLinks();
?>