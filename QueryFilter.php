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
   public function __construct($query, $table) {
      $this->query  = $query;
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
      $value = preg_replace("/%%/", '', trim($value));

      if(isset($value) && !empty($value)) {
         
         $hasWhere = strpos(strtoupper($this->query), 'WHERE'); 
         if($hasWhere) {
             $this->query .= " $logic $column $operator $value ";
         } else {
             $this->query .= " WHERE $logic $column $operator $value ";
         }
        

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
   public function orderBy($columns) {
      $this->query .= " order by $columns ";
      return $this;
   }

}
