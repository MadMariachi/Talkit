<?php
include 'Header.php';
include_once 'Database.php';

$db = new Database();
$dataB = $db -> connect();
$data = json_decode(file_get_contents('php://input'), true);
$query = "SELECT id_usuario FROM public.usuario where username = '". $data['user'] ."'";
$res = pg_query($dataB, $query);
$id = pg_fetch_result($res, 0, 0 );
$query = "SELECT id_usuario_recibe, username, relacion, foto_perfil, estado from public.amigos inner join usuario on id_usuario_recibe = id_usuario where id_usuario_envia = '$id' AND id_usuario_recibe = '". $data['friendId'] ."'";
$res = pg_query($dataB, $query);
$lel = pg_fetch_all($res);
echo json_encode($lel);