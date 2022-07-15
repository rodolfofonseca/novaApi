<?php
require_once 'Sistema/db.php';

function converts($model, $data = []) {
  foreach ($data as $field => $value) {
    if (array_key_exists($field, $model) == true) {
      $field_type = (string) gettype($model[$field]);

      if ($field_type == 'int') {
        $data[$field] = (int) $value;

      } else if ($field_type == 'double') {
        $data[$field] = (float) $value;
      }
    }
  }

  return array_merge($model, $data);
}

function insert($table, $data, $model, $id) {
  $next_id = (int) next_id($table, $id);
  $return = (bool) false;
  if($next_id != 0){
    $data[$id] = (int) intval($next_id, 10);

    $return = (bool) DB::use($table)->insert(converts($model, $data));
  }
  return (array) ['status' => (bool) $return, $id => (int) $next_id];
}

function update($table, $condition, $data) {
  return DB::use($table)->update($condition, $data);
}

function delete($table, $condition) {
  return DB::use($table)->delete($condition);
}

function find_all($table, $condition = [], $order = []) {
  return DB::use($table)->all($condition, $order);
}

function find_one($table, $condition = [], $order = []) {
  return DB::use($table)->one($condition, $order);
}

function check($table, $condition = []) {
  return (bool) DB::use($table)->one($condition);
}

function next_id($table, $field, $condition = []) {
  $next = (int) 1;
  $last = (array) DB::use($table)->one($condition, [ $field => false ]);

  if (empty($last) == false) {
    $next = (int) $last[$field] + 1;
  }

  return $next;
}