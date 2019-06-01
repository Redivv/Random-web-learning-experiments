<?php

 $test_arr = array(3,2,1);

 var_dump($test_arr);

 $test_arr_str = serialize($test_arr);

 echo '<br>';

 var_dump($test_arr_str);

 $test_arr_unserialized = unserialize($test_arr_str);

 echo '<br>';

 var_dump($test_arr_unserialized);

?>