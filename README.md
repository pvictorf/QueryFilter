# QueryFilter
Class para ajudar a colocar filtros em suas Querys

# Como usar

//Os filtros serão aplicados somente para váriaveis que tiverem valor definido.

```php
<?php
require_once 'QueryFilter.php';

$nome = "Paulo";

$query = "SELECT * from usuarios
          inner join perfil on perfil.id = usuarios.id_perfil";
          
//Define a query que terá filtros aplicados e qual a tabela principal.          
$qf = new QueryFilter($query, 'usuarios'); 

//Aplica os filtros a query, caso haja valor na váriavel
$query = $qf->where(':nome', 'Like', $nome)
            ->where(':email', 'Like', $email)
            ->where(':id', '=', $id)
            ->orderBy('nome')
            ->getQuery();

//Retorna os binds para uso do PDO
foreach($qf->getBinds() as $bind) {
   echo "bind: {$bind->column} value: {$bind->value}";
}
```




