<?php
    $output = null;
    $retval = null;
    $command = 'statistics.exe 2>&1';
    $output = system($command, $retval);
    echo "Returned with status $retval and output:\n";
    echo "<pre>";
    print_r($output);
    echo "</pre>";
?>