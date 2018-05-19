<?php

function printName($name = null) {
  $name = $name ?: 'default';

  echo $name."\n";
}

printName();
printName('test');

/*

if( $start ) {
    $start = $start;
} else {
    $start = 1;
}

$start = $start ?: 1;

--or--

if( $valid ) {
    $x = 'yes';
} else {
    $x = 'no';
}

$x = $valid ? 'yes' : 'no';

*/