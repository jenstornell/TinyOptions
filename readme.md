# TinyOptions

*Version: 1.0*

TinyOptions is perhaps the smallest PHP options library on earth. Still packed with features.

## Setup

```php
include __DIR__ . '/tinyoptions.php';
```

## Basic usage

Set the option as a string. Print the option on the screen.

```php
option::set('myoption', 'hello');
echo option('myoption'); // Says hello
```

## Set by other types

### Anonymous function

```php
option::set('myoption', function($args) {
  return 'Hello ' . $args;
});

echo option('myoption')('world'); // Says "Hello world"
```

### Static function

To call a static function you need to include the class name like below.

```php
hook::set($name, 'MyStatic::myhook');

class MyStatic {
  public static function myhook($args) {
    // Do something
  }
}
```

### Object function

To use a function in a class, you need to create an object. Then you need to send the object and the class name as an array, like below.

```php
$object = new MyClass();
class MyClass {
  function set($args) {
    return $args . 'def';
  }
}

option::set('myoption', $object);
echo option('myoption')->set('abc'); // Says "abcdef"
```

## Defaults

### By string

With the `option` function you can also send a second argument. If no value is set to this option name, this default value will be used instead.

```php
echo option('myoption', 'Hello default value');
```

### By array

To make it easier you can also set all the default values in one go with an array. If you also add a second argument, that will override the array.

```php
options::default([
  'abc' => 123,
  'def' => 456
]);

echo option('abc'); // Says 123
echo option('abc', 789); // Says 789
```

## Multiple options in one go

You can setup all your options with an array. That way it works very similar to the `option::set()` function.

```php
options::set([
  'option1' => 'A value',
  'option2' => function() {
    return 'Another value';
  }
]);

echo option('option1'); // Says "A value"
```

## Unset single option

You can unset an option. In that case it will fallback to the default value if exists.

```php
option::set('myoption', 'Bye');
option::unset('myoption');
echo option('myoption', 'Hello'); // Says "Hello"
```

## Unset multiple options

You can unset multiple options. Just send an array with option names.

```php
option::set('myoption', 'Bye');
option::set('anotheroption', 'Hi');
options::unset(['myoption', 'anotheroption']);
echo option('myoption', 'Hello'); // Says "Hello"
```

## Donate

Donate to [DevoneraAB](https://www.paypal.me/DevoneraAB) if you want.

## Additional notes

- To keep it dead simple, namespaces are not used.
- In case of collision, you can rename the `option` class and the `option` function.

## Requirements

- PHP 7

## Inspiration

- [Kirby CMS options](https://getkirby.com/docs/developer-guide/configuration/options) Expecially fallbacks to default values.

## License

MIT