<?php
  // This is used to connect to database. Required anytime we wish to use database.
  $dbhost = 'localhost';
  $dbuser = 'jtaylor32';
  $dbpass = '123456';
  $dbname = 'jtaylor32';

  require_once( 'DB.php' );

  $db = DB::connect( "mysql://$dbuser:$dbpass@$dbhost/$dbname" );

  $db->setFetchMode(DB_FETCHMODE_ASSOC);
?>