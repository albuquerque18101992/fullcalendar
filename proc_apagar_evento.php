<?php
session_start();

include_once 'conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {
    $query_event =  "DELETE FROM events WHERE id = $id";
    mysqli_query($conn, $query_event);
    if (mysqli_affected_rows($conn)) {
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Evento apagado com sucesso!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
        header("Location: index.php");
    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">ERRO: Evento não foi apagado!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button></div>';
        header("Location: index.php");
    }
} else {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">ERRO: Evento não foi apagado!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
    header("Location: index.php");
}
