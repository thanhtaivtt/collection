<?php
/**
 * Created by PhpStorm.
 * User: thanhtai
 * Date: 11/03/2018
 * Time: 21:13
 */

use PHPUnit\Framework\TestCase;
use Thanhtaivtt\Collection\Collection;

class CollectionTest extends TestCase
{

    public function testConstruct()
    {
        $this->assertEquals(1, 1);
    }

    public function testInit()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 6, 6, 6, 6]);

        $this->assertEquals(property_exists($collection, 'items'), true);
    }

    public function testAll()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 6, 6, 6, 6]);

        $this->assertEquals($collection->all(), [1, 2, 3, 4, 5, 6, 6, 6, 6, 6]);
    }

    public function testCount()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 6, 6, 6, 6]);

        $this->assertEquals($collection->count(), 10);
    }

    public function testSum()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 6, 6, 6, 6]);

        $this->assertEquals($collection->sum(), 45);
    }

    public function testChunk()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 6, 6, 6, 6]);

        $this->assertEquals($collection->chunk(5)->toArray(), [[1, 2, 3, 4, 5], [5 => 6, 6 => 6, 7 => 6, 8 => 6, 9 => 6]]);
    }

    public function testToArray()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 6, 6, 6, 6]);

        $this->assertEquals($collection->chunk(3)->toArray(), [[1, 2, 3], [3 => 4, 4 => 5, 5 => 6], [6 => 6, 7 => 6, 8 => 6], [9 => 6]]);
    }


    public function testToJson()
    {
        $collection = new Collection(["name" => "Taivt", "age" => 22]);

        $this->assertEquals($this->isJson($collection->toJson())->toString(), "is valid JSON");
    }

    public function testAvg()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 6, 6, 6, 6]);

        $this->assertEquals($collection->avg(), 4.5);
    }

    public function testMax()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 6, 6, 6, 6]);

        $this->assertEquals($collection->max(), 6);
    }

    public function testMin()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 6, 6, 6, 6]);

        $this->assertEquals($collection->min(), 1);
    }

    public function testFirst()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 6, 6, 6, 6]);

        $this->assertEquals($collection->first(), 1);
    }

    public function testFirstWhere()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 6, 6, 6, 6]);

        $this->assertEquals($collection->firstWhere('0', 3), null);
    }

    public function testFlip()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 6]);

        $this->assertEquals($collection->flip() instanceof Collection, true);
    }

    public function testForget()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 6]);

        $this->assertEquals($collection->flip() instanceof Collection, true);
    }

    public function testUnsetVal()
    {
        $collection = new Collection([1, 2, 3, 4, 5, 6, 6]);

        $this->assertEquals($collection->unsetVal(0)->toArray(), [1 => 2, 2 => 3, 3 => 4, 4 => 5, 5 => 6, 6 => 6]);
    }

    public function testMerge()
    {
        $collection = new Collection([1, 2, 3]);

        $this->assertEquals($collection->merge([4, 5, 6, 6])->toArray(), [1, 2, 3, 4, 5, 6, 6]);
    }

    public function testPush()
    {
        $collection = new Collection([1, 2, 3]);

        $this->assertEquals($collection->push('tai')->toArray(), [1, 2, 3, 'tai']);
    }

    public function testPut()
    {
        $collection = new Collection([1, 2, 3]);

        $this->assertEquals($collection->put('tai', 5)->toArray(), [1, 2, 3, 'tai' => 5]);
    }

    public function testRandom()
    {
        $collection = new Collection([1, 2, 3]);

        $this->assertEquals(is_numeric($collection->random()), true);
    }

    public function testReject()
    {
        $collection = new Collection([1, 2, 3, 7, 7]);

        $this->assertEquals($collection->reject(7)->toArray(), [1, 2, 3]);
    }

    public function testAccept()
    {
        $collection = new Collection([1, 2, 3, 7, 7]);

        $this->assertEquals($collection->accept(1)->toArray(), [1]);
    }

    public function testUnique()
    {
        $collection = new Collection([1, 2, 3, 7, 7]);

        $this->assertEquals($collection->unique(7)->toArray(), [1, 2, 3, 7]);
    }

    public function testTostring()
    {
        $collection = new Collection([1, 2, 3, 7, 7]);

        $this->assertEquals($this->isType('string')->toString(), 'is of type "string"');
    }
}
