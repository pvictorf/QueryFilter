# QueryFilter
Class para ajudar a colocar filtros em suas Querys

# Como usar

Os filtros serão aplicados somente para váriaveis que tiverem valor definido.

```php
<?php
require_once 'QueryFilter.php';

$nome = "Paulo";
          
//Define a query que terá filtros aplicados e qual a tabela principal.          
$qf = new QueryFilter(
          "SELECT * from usuarios
          inner join perfil on perfil.id = usuarios.id_perfil ",
          'usuarios'
); 

//Aplica os filtros a query, caso haja valor na váriavel
$query = $qf->where(':nome', 'like', "%{$nome}%")
            ->where(':email', 'like', "%{$email}%")
            ->where(':id', '=', $id)
            ->orderBy('nome ASC')
            ->getQuery();

//Retorna os binds para uso do PDO
foreach($qf->getBinds() as $bind) {
   echo "\n bind: {$bind->column} value: {$bind->value}";
}
```

Como somente "nome" tem valor definido a query será:

```sql
SELECT * from usuarios
          inner join perfil on perfil.id = usuarios.id_perfil 
          where :nome like %Paulo% order by nome ASC 
```




