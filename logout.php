<?php

//清除所有的cookie
setcookie("id","",time()-1);
setcookie("username","",time()-1);
setcookie("face","",time()-1);
header("Location:index.php");