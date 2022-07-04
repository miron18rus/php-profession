<?php

function add($x, $y) {
    return $x + $y;
}

if (add(3, 3) === 6) {
    echo "add is ok";
} else {
    echo "add error";
}