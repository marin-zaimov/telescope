<?php
  
  $names = array('john doe', 'jane doe');
  $ids = array('123', '223');

  $data['names'] = $names;
  $data['ids'] = $ids;
  //var_dump($data);

  echo json_encode($data);

?>
