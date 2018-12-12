<?php
include __DIR__ . '/../tinyoptions.php';

$issues = [];

option::default([
  'string' => 'my_defalt',
  'notset' => 'whatever',
  'banana' => 'apple'
]);

// String
option::set('string', "my_string");
if(option('string') != 'my_string') $issues[] = 'string';

// Default array
if(option('notset') != 'whatever') $issues[] = 'default array';

// Default string
if(option('banana', 'orange') != 'orange') $issues[] = 'default string';

// Array
option::set('array', ['my' => 'array']);
if(option('array')['my'] != 'array') $issues[] = 'array';

// Anonymous
option::set('anonymous', function($args) {
  return 'abc' . $args['test'];
});
if(option('anonymous')(['test' => '123']) != 'abc123') $issues[] = 'anonymous';

// Object
$object = new MyObject();
class MyObject {
  function set($args) {
    return $args . 'def';
  }
}
option::set('object', $object);
if(option('object')->set('abc') != 'abcdef') $issues[] = 'object';

option::default([
  'novalue' => 12
]);

option::set([
  'novalue',
  'option1' => 'first',
  'option2' => 'second'
]);

// Options defaults
if(option('novalue') != 12) $issues[] = 'options defaults';

// Options
if(option('option1') != 'first') $issues[] = 'options';

print_r($GLOBALS);


option::unset('option1');
if(option('option1') == 'first') $issues[] = 'unset string';

option::unset(['option1', 'option2']);
if(option('option2') == 'second' && option('option2', 'hello') != 'hello') $issues[] = 'unset array';

print_r($issues);