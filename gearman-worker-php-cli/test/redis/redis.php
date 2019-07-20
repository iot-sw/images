<?php
$data = [
  'name' => 'peter',
  'title' => 'TL',
  'age' => 18,
  'sex' => 'male'
];

$redis = new Redis();

$redis->connect('172.17.0.5');

$redis->select(1);

foreach($data as $key => $val){
  $redis->set($key, $val);
}

$keys = array_keys($data);

unset($data);


foreach($keys as $key){
  $val = $redis->get($key);
  echo "Key: $key => Value: $val \n";
}
