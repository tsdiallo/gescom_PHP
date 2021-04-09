<?php

interface DaoInterface{
     public function insert();
     public function update();
     public function delete();
     public function findById();
     public function findAll();
     public function getTableName();

}