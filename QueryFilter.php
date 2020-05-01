<?php
class QueryFilter {
   public $query;
   public $binds;
   

   /**
    * __construct
    *
    * @param  String $query
    * @param  String $table
    * @param  String $primary_key
    * @return void
    */
   public function __construct($query, $table, $primary_key = 'id') {
      $this->query  = $query;
      $this->query .= " where {$table}.{$primary_key} is not null ";
      $this->binds  = [];
   }
   

   /**
    * getQuery
    *
    * @return String
    */
   public function getQuery() {
      return ($this->query) ? $this->query : '';
   }
   

   /**
    * where
    *
    * @param  String $column
    * @param  String $operator
    * @param  mixed $value
    * @param  String $logic
    * @return self
    */
   public function where($column, $operator, $value, $logic = 'AND') {
      $value = trim($value);

      if(isset($value) && !empty($value)) {

         $this->query .= $logic . " $column $operator $value ";

         $this->bind($column, $value);

      }

      return $this;
   }
   

   /**
    * getBinds
    *
    * @return array
    */
   public function getBinds() {
      return $this->binds;
   }
   

   /**
    * bind
    *
    * @param  String $column
    * @param  mixed $value
    * @return self
    */
   public function bind($column, $value) {
      $this->binds[] = (object) array(
         'column' => $column,
         'value' => $value
      );

      return $this;
   }
   

   /**
    * limit
    *
    * @param  int $number
    * @return self
    */
   public function limit($number) {
      $this->query .= " limit $number ";
      return $this;
   }


   /**
    * orderBy
    *
    * @param  String $column
    * @param  String $order
    * @return self
    */
   public function orderBy($column, $order = 'ASC') {
      $this->query .= " order by $column $order";
      return $this;
   }

}
