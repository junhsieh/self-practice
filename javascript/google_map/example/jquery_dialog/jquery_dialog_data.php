<?php
$arr = array();

$arr[] = array('lat' => 37.4119, 'lng' => -122.1419, 'idDealer' =>  1, 'dealerName' => 'test 1', 'salesDiff' => -20, 'lastInvoiceDate' => '2015-04-08');
$arr[] = array('lat' => 37.4219, 'lng' => -122.1419, 'idDealer' =>  2, 'dealerName' => 'test 2', 'salesDiff' => -10, 'lastInvoiceDate' => '2015-04-08');
$arr[] = array('lat' => 37.4319, 'lng' => -122.1419, 'idDealer' =>  3, 'dealerName' => 'test 3', 'salesDiff' => -30, 'lastInvoiceDate' => '2015-04-08');
$arr[] = array('lat' => 37.4419, 'lng' => -122.1419, 'idDealer' =>  4, 'dealerName' => 'test 4', 'salesDiff' => -10, 'lastInvoiceDate' => '2015-04-08');
$arr[] = array('lat' => 37.4519, 'lng' => -122.1419, 'idDealer' =>  5, 'dealerName' => 'test 5', 'salesDiff' => -50, 'lastInvoiceDate' => '2015-04-08');
$arr[] = array('lat' => 37.4619, 'lng' => -122.1419, 'idDealer' =>  6, 'dealerName' => 'test 6', 'salesDiff' => -30, 'lastInvoiceDate' => '2015-04-08');
$arr[] = array('lat' => 37.4719, 'lng' => -122.1419, 'idDealer' =>  7, 'dealerName' => 'test 7', 'salesDiff' => -90, 'lastInvoiceDate' => '2015-04-08');
$arr[] = array('lat' => 37.4819, 'lng' => -122.1419, 'idDealer' =>  8, 'dealerName' => 'test 8', 'salesDiff' => 100, 'lastInvoiceDate' => '2015-04-08');
$arr[] = array('lat' => 37.4119, 'lng' => -122.1319, 'idDealer' =>  9, 'dealerName' => 'test 9', 'salesDiff' => -90, 'lastInvoiceDate' => '2015-04-08');

echo json_encode($arr);
exit;
?>


