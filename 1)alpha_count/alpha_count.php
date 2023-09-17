#!/usr/bin/env php
<?php

if ($argc !== 2) {
  echo "Usage: php alphacount.php 'Your sentence here'\n";
  exit(1);
}

$sentence   = $argv[1];
$alphaCount = 0;

foreach (str_split($sentence) as $char) {
  if (ctype_alpha($char)) {
    $alphaCount++;
  }
}

echo $alphaCount . "\n";