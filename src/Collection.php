<?php

namespace Thanhtaivtt\Collection;

use Thanhtaivtt\Collection\Mask\ArrayInterface;

class Collection implements ArrayInterface
{

    /**
     * init item for array
     *
     * @var array
     */
    protected $items = [];

    /**
     * filter mode
     * @var array
     */
    private $fiterMode = [
        1, //filter by both
        2, //filter by key
    ];

    /**
     * construct class
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        $this->items = $items;
    }

    /**
     * make data to collection
     *
     * @param  array $items
     * @return static
     */
    public static function init($items = [])
    {
        return new static($items);
    }

    /**
     * get all items in the collection
     *
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * get count the mumber of item in the collection
     *
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * get sum the im
     * @return int
     */
    public function sum()
    {
        return array_sum($this->items);
    }

    /**
     * chunk the items
     * @param  int $length
     * @return static
     */
    public function chunk($length)
    {
        if ($length <= 0) {
            return $this;
        }

        $chunks = [];

        foreach (array_chunk($this->items, $length, true) as $chunk) {
            $chunks[] = new static($chunk);
        }

        return new static($chunks);
    }

    /**
     * convert the items to arrays
     *
     * @return array
     */
    public function toArray()
    {
        $newItem = [];

        foreach ($this->items as $key => $val) {
            if ($val instanceof ArrayInterface) {
                $newItem[$key] = $val->items;
            } else {
                $newItem[$key] = $val;
            }
        }

        return $newItem;
    }

    /**
     * conver the items to Jsons
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     *
     * @return int|double
     */
    public function avg()
    {
        return $this->sum() / $this->count();
    }

    public function max()
    {
        return max($this->items);
    }

    public function min()
    {
        return min($this->items);
    }

    /**
     * get First value of the items
     *
     * @return mixed|null
     */
    public function first()
    {

        foreach ($this->items as $item) {
            return $item;
        }

        return null;
    }

    /**
     * get firse value of the items by where
     *
     * @param mixed $keyWhere
     * @param mixed $valueWhere
     * @return mixed|null
     */
    public function firstWhere($keyWhere, $valueWhere)
    {
        foreach ($this->items as $key => $item) {
            if ($keyWhere === $key && $valueWhere === $item) {
                return $item;
            }
        }

        return null;
    }

    /**
     * swap key to value of the item
     *
     * @return static
     */
    public function flip()
    {
        return new static(array_flip($this->items));
    }

    /**
     * forget a item of the items
     *
     * @param mixed $key
     * @return object
     */
    public function forget($key)
    {
        if (is_string($key)) {
            $this->unsetVal($key);
        } else {
            foreach ($this->items as $keys => $value) {
                if ($key === $keys) {
                    $this->unsetVal($key);
                }
            }
        }

        return $this;
    }

    /**
     * unset a item of the items
     *
     * @param string|int $key
     * @return $this
     */
    public function unsetVal($key)
    {
        unset($this->items[$key]);

        return $this;
    }

    /**
     * merge data to a collection data
     *
     * @param $items
     * @return $this
     */
    public function merge($items)
    {
        if ($items instanceof ArrayInterface) {
            $this->items = array_merge($this->items, $items->all());
        } else {
            $this->items = array_merge($this->items, $items);
        }

        return $this;
    }

    /**
     * push data to a collection
     *
     * @param mixed $item
     * @return $this
     */
    public function push($item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * put data to a collection
     *
     * @param mixed $key
     * @param mixed $value
     * @return $this
     */
    public function put($key, $value)
    {
        $this->items[$key] = $value;

        return $this;
    }

    /**
     * get the random value in the items
     *
     * @return mixed
     */
    public function random()
    {
        return $this->items[array_rand($this->items)];
    }

    /**
     * reject the item in items
     *
     * @param $value
     * @param int $mode
     * @return $this
     */
    public function reject($value, $mode = 1)
    {
        if (!in_array($mode, $this->fiterMode)) {
            throw new \UnexpectedValueException("Mode must is 1 or 2");
        }

        $this->items = array_filter($this->items, function ($item) use ($value, $mode) {
            return $item !== $value;
        }, $mode);

        return $this;
    }

    /**
     * accept the item in items
     *
     * @param $value
     * @param int $mode
     * @return $this
     */
    public function accept($value, $mode = 1)
    {
        $this->items = array_filter($this->items, function ($item) use ($value, $mode) {
            return $item === $value;
        }, $mode);

        return $this;
    }

    /**
     * convert array list to array unique
     *
     * @return $this
     */
    public function unique()
    {
        $this->items = array_unique($this->items, SORT_REGULAR);

        return $this;
    }

    /**
     * convert object to json string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
}


