<?php
// Recebendo os dados por método POST.
  $dados = $_POST['envio'];

// Conversão de array de objetos json para array de objetos php.
  $pessoas = array();
  foreach ($dados as $value){
    array_push($pessoas, json_decode($value));
  }

// Filtrando apenas quem mora na china para dentro do array de chineses.
  $chineses = array_filter($pessoas, function ($p) {
    return $p->pais == 'China'; 
  });

// Filtrando apenas as mulheres chinesas.
  $mulheres = array_filter($chineses, function ($m) {
    return $m->genero == 'F'; 
  });

// Mapeando apenas o salário das mulheres chinesas para um novo array.
  $salariosMulheresChinesas = array_map(function ($x) { return $x->salario; }, $mulheres);

// Filtrando o menor salário das mulheres chinesas.
  $menorSalario = array();
  foreach ($mulheres as $value) {
    if ($value->salario == min($salariosMulheresChinesas)) {
        array_push($menorSalario, $value);
    }
  }

// Retornando os dados para o ajax.
  $retorno = json_encode($menorSalario);
  print $retorno;
 ?>