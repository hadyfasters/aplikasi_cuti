<?php
    // lowest year wanted
    $cutoff = 1910;

    // current year
    $now = date('Y');

    // build years menu
    echo '<select name="year">' . PHP_EOL;
    for ($y=$now; $y>=$cutoff; $y--) {
        echo '  <option value="' . $y . '">' . $y . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;

    // build months menu
    echo '<select name="month">' . PHP_EOL;
    for ($m=1; $m<=12; $m++) {
        echo '  <option value="' . $m . '">' . date('M', mktime(0,0,0,$m)) . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;

    // build days menu
    echo '<select name="day">' . PHP_EOL;
    for ($d=1; $d<=31; $d++) {
        echo '  <option value="' . $d . '">' . $d . '</option>' . PHP_EOL;
    }
    echo '</select>' . PHP_EOL;
?>