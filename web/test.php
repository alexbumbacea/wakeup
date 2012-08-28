<pre>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

exec('nbtscan 10.41.0.1/24 -s "|"', $output);
print_r($output);
foreach ($output as $line)
{
    $arr = explode('|', $line);
    print_r($arr);
}
?>
