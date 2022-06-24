<?php
require_once '../classes/dbconnect.class.php';
require_once '../classes/client.class.php';

$client = new Client();
// $_REQUEST['mode'] = 'loadOne';
// $_REQUEST['id'] = 1;

if ($_REQUEST['mode'] == 'load') {
    $ListClt = $client->readAllClients();
    $row = $ListClt->fetchAll();
    echo json_encode($row);
} else if ($_REQUEST['mode'] == 'loadOne') {
    $client = $client->readSpecificClient($_REQUEST['id']);
    $row = $client->fetch();
    echo json_encode($row);
} else if ($_REQUEST['mode'] == 'insert') {
    $client->createClient($_REQUEST['nomor_plat'], $_REQUEST['merek_kendaraan'], $_REQUEST['tipe_kendaraan'], $_REQUEST['tanggal_keluar']);
} else if ($_REQUEST['mode'] == 'update') {
    $client->createClient($_REQUEST['nomor_plat'], $_REQUEST['merek_kendaraan'], $_REQUEST['tipe_kendaraan'], $_REQUEST['tanggal_keluar']);
} else if ($_REQUEST['mode'] == 'delete') {
    $client->deleteClient($_REQUEST['id']);
}