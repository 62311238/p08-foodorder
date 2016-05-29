<?php
 session_start();
 unset($_SESSION);
 session_destroy();
 echo "<h3>ログアウトしました！</h3>";
 echo '<a href="login.html">ログイン</a>';
?>