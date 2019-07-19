<?php
$host="172.17.0.2";
$port="3306";
$db="test";
$table="test";
$user="root";
$pwd="123456";

$dsn="mysql:host=$host;port=$port";

$pdo = new PDO($dsn, $user, $pwd );


// create db and table

$db_sql = "create database test;";

$pdo->exec($db_sql);

$dbs = $pdo->query('show databases;');

echo "Database\n";
echo "========\n";
foreach($dbs as $db){
  echo $db['Database'] . "\n";
}

echo "\n";

$pdo->exec("use test");

$tab_sql = <<<'SQL'
create table test(
   id int not null auto_increment,
   name varchar(100) not null,
   title varchar(100),
   primary key(id)
)
SQL;

$pdo->exec($tab_sql);

$tabs = $pdo->query('desc test');

echo "Field\t|Type\t|Null\n";
echo "=====\t|====\t|====\n";
foreach($tabs as $tab){
  echo $tab['Field'] . "\t";
  echo $tab['Type'] . "\t";
  echo $tab['Null'] . "\n";
}

echo "\n";


$init_data_sql = <<<'SQL'
insert into test values
  (1, 'milo', 'TH'),
  (2,'peter', 'TL');
SQL;

$pdo->exec($init_data_sql);

## query
$rs = $pdo->query("select * from test");

echo "| ID | Name | Title |\n";
echo "|----|------|-------|\n";
foreach($rs as $row){
        echo "| " . $row['id'] . " ";
        echo "| " . $row['name']. " ";
        echo "| " . $row['title']. " |\n";
}

## clear test db
$drop_db_sql = 'drop database test';

$pdo->exec($drop_db_sql);
