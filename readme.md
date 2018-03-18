# Array Collection for PHP

## Install

```sybase
composer require thanhtaivtt/collection
```

## Usage

```php
use thanhtaivtt\Collection\Collection;

//init
$collection = new Collection([1,2,3,4,5,6]);

//or
Collection::init([1,2,3,6,4]);

```
## Suport Methods
### sum
- The `sum` method returns the sum of all items in the collection:
```php
    Collection::init([1, 2, 3])->sum();
    // 6
```
### sum
- The `avg` method returns the average of all items in the collection:
```php
    Collection::init([1, 2, 3])->avg();
    // 2
```
### min
- The `min` method returns the min of all items in the collection:
```php
    Collection::init([1, 2, 3])->min();
    // 1

```
### max
- The `max` method returns the max of all items in the collection:
```php
    Collection::init([1, 2, 3])->max();
    // 1

```

### all
- The `all` method returns the all items in the collection:
```php
    Collection::init([1, 2, 3])->all();
    // [1,2,3]

```
### chunk
- The `chunk` method breaks the collection into multiple, smaller collections of a given length:
```php
    $chunk = Collection::init([1, 2, 3])->chunk(2);
    $chunk->toArray();
    // [[1, 2], [3]]

```
### toArray
- The `toArray` method converts all items in Object to Array:
```php
    $chunk = Collection::init([1, 2, 3])->toArray();
    // [1, 2, 3]

```
....