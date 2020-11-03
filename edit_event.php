<?php
session_start();

include_once 'conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Converte a data e hora do formato Brasileiro para o formato de banco de dados
$data_start = str_replace('/', '-', $dados['start']);
$data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));


$data_end = str_replace('/', '-', $dados['end']);
$data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));

$query_event = "UPDATE events SET title = '" . $dados['title'] . "', color ='" . $dados['color'] . "', start =  '$data_start_conv', end = '$data_end_conv' WHERE id = '" . $dados['id'] . "'";
mysqli_query($conn, $query_event);


if (mysqli_affected_rows($conn)) {
    $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Evento editado com sucesso!</div>'];
    $_SESSION['msg'] =  '<div class="alert alert-success" role="alert">Evento editado com sucesso!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
} else {
    $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">ERRO: Evento não editado!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>'];
}

header('Content-Type: application/json');
echo json_encode($retorna);