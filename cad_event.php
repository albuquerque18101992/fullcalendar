<?php
session_start();

include_once 'conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Converte a data e hora do formato Brasileiro para o formato de banco de dados
$data_start = str_replace('/', '-', $dados['start']);
$data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));


$data_end = str_replace('/', '-', $dados['end']);
$data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));

$query_event = "INSERT INTO events (title, color, start, end) VALUES ('" . $dados['title'] . "', '" . $dados['color'] . "', '$data_start_conv', '$data_end_conv')";
mysqli_query($conn, $query_event);


if (mysqli_insert_id($conn)) {
    $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>'];
    $_SESSION['msg'] =  '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
} else {
    $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">ERRO: Evento não cadastrado!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>'];
}



header('Content-Type: application/json');
echo json_encode($retorna);
