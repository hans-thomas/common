<?php

namespace Epubli\Common\Tests\Basic;

use Epubli\Common\Basic\IntegerSet;
use PHPUnit_Framework_TestCase;

class IntegerSetTest extends PHPUnit_Framework_TestCase
{
    public function testDefault()
    {
        $set = new IntegerSet();
        $this->assertEquals('', $set);
        $this->assertEquals(0, $set->count());
    }

    public function testNull()
    {
        $set = new IntegerSet(null);
        $this->assertEquals('', $set);
        $this->assertEquals(0, $set->count());
    }

    public function testEmpty()
    {
        $set = new IntegerSet('');
        $this->assertEquals('0', $set);
        $this->assertEquals(1, $set->count());
    }

    public function testZero()
    {
        $set = new IntegerSet(0);
        $this->assertEquals('0', $set);
        $this->assertEquals(1, $set->count());
    }

    public function testStringZero()
    {
        $set = new IntegerSet('0');
        $this->assertEquals('0', $set);
        $this->assertEquals(1, $set->count());
    }

    public function testInteger()
    {
        $set = new IntegerSet(123);
        $this->assertEquals('123', $set);
        $this->assertEquals(1, $set->count());
    }

    public function testFloat()
    {
        $set = new IntegerSet(123.321);
        $this->assertEquals('123', $set);
        $this->assertEquals(1, $set->count());
    }

    public function testStringWithSpaces()
    {
        $set = new IntegerSet('  5 -6 ,4  ,5,80  -30,   40 - 81   ');
        $this->assertEquals('4-6,30-81', $set);
        $this->assertEquals(55, $set->count());
    }

    public function testStringWithLeadingComma()
    {
        $set = new IntegerSet(',5-6,8');
        $this->assertEquals('0,5-6,8', $set);
        $this->assertEquals(4, $set->count());
    }

    public function testStringWithTrailingComma()
    {
        $set = new IntegerSet('5-6,8,');
        $this->assertEquals('0,5-6,8', $set);
        $this->assertEquals(4, $set->count());
    }

    public function testStringWithDoubleComma()
    {
        $set = new IntegerSet('5-6,,8');
        $this->assertEquals('0,5-6,8', $set);
        $this->assertEquals(4, $set->count());
    }

    public function testInsert()
    {
        $set = new IntegerSet('1,4');
        $set->insert(2);
        $this->assertEquals('1-2,4', $set);
    }

    public function testInsertRange()
    {
        $set = new IntegerSet('1-6,9-13');
        $set->insertRange(5, 10);
        $this->assertEquals('1-13', $set);
    }

    public function testRemove()
    {
        $set = new IntegerSet('1-3');
        $set->remove(2);
        $this->assertEquals('1,3', $set);
    }

    public function testRemoveRange()
    {
        $set = new IntegerSet('1-5,7-9');
        $set->removeRange(5, 8);
        $this->assertEquals('1-4,9', $set);
    }

    public function testContains()
    {
        $set = new IntegerSet('1,2,3');
        $this->assertTrue($set->contains(2));
    }
}
