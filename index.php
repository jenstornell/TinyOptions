<?php
include __DIR__ . '/tinyoptions.php';

option::set('option1', 'Hello');
echo option('option1');