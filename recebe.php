<?php
  $dados = $_POST['envio'];
// conversão de array de objetos json para array de objetos php.

  $pessoas = array();
  foreach ($dados as $value){
    array_push($pessoas, json_decode($value));
  }

// filtrando apenas quem mora na china para dentro do array de chineses.
  $chineses = array_filter($pessoas, function ($p) {
    return $p->pais == 'China'; 
  });

// filtrando apenas as mulheres chinesas
  $mulheres = array_filter($chineses, function ($m) {
    return $m->genero == 'F'; 
  });

// filtrando o salário das mulheres chinesas
  $salariosMulheresChinesas = array_map(function ($x) { return $x->salario; }, $mulheres);

// Filtrando o menor salário das mulheres chinesas
  $menorSalario = array();
  foreach ($mulheres as $value) {
    if ($value->salario == min($salariosMulheresChinesas))
      array_push($menorSalario, $value);
  }
// retornando os dados para o ajax.
  $retorno = json_encode($menorSalario);
  print $retorno;
 ?>