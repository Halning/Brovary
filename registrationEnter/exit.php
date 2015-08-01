
<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
header("content-type:text/html;charset=utf-8");

/* function clearpieces( $inKey , $inFirst ) { 
  $expire = time()-3600;

  for ( $index = $inFirst ; array_key_exists( $inKey.COOKIE_PORTIONS.$index , $_COOKIE ) ; $index += 1 ) {
  setcookie( $inKey.COOKIE_PORTIONS.$index , '' , $expire , '/' , '' , 0 );
  unset( $_COOKIE[$inKey.COOKIE_PORTIONS.$index] );
  }
  }

  function clearcookie( $inKey ) {
  clearpieces( $inKey , 1 );
  setcookie( $inKey , '' , time()-3600 , '/' , '' , 0 );
  unset( $_COOKIE[$inKey] );
  }
  //clearcookie('Login');
  //clearcookie('avatar');
  //clearcookie('username'); */

SetCookie('Login', 'true', time() - 36000, "/", '', 0, true);
SetCookie('avatar', $avatar, time() - 3600, "/", '', 0, true);
SetCookie('username', $username, time() - 3600, "/", '', 0, true);
SetCookie('id', $id, time() - 3600, "/", '', 0, true);
session_start();

if (isset($_SESSION['login'])) {
    $_SESSION = array();
    session_destroy();
}

