# php-linkedlist
![Build Status](https://github.com/blister/php-linkedlist/actions/workflows/php.yml/badge.svg)
A speedy LinkedList and DoubleLinkedList data structure implementation in PHP.

## Installation
```console
composer require blister/linkedlist
```

## Usage
```php
$list = new Blister\LinkedList();

// Add to the end of the LinkedList
$list->push('Hello!');
$list->push('World!');
$list->push(array('key' => 'val'));
$list->push(true);
$list->push('Last!');

// Add to the front of the LinkedList
$list->unshift('New First!');


// Get the length of the LinkedList
$len = $list->length; // 6

// Searching inside the list
$found_index = $list->index('World!'); // 2
$found = $list->find('World');         // true
$found = $list->find('Missing');       // false

// removing elements
$last   = $list->pop();            // 'Last!' 
$first  = $list->shift();          // 'First!'
$middle = $list->remove('World!'); // 'World!'
$third  = $list->removeAt(1);      // array('key' => 'val')
```

## Tests
This LinkedList implementation comes with a full suite of PHPUnit tests.
```console
composer run-script test
```

## Future
- [ ] `toArray():array`
- [ ] `findAll(mixed $needle):array`
- [ ] `fill(int $count, mixed $value):bool`
- [ ] `findFromTail(mixed $needle):mixed`
- [ ] `indexFromTail(mixed $needle):int`
- [ ] `print():void` 

## Author
Eric Ryan Harrison, [@blister](https://twitter.com/blister)
