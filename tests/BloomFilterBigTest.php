<?php

namespace NoUseFreak\BloomFilter;

use NoUseFreak\BloomFilter\Storage\InMemoryStorage;

class BloomFilterBigTest extends \PHPUnit_Framework_TestCase
{
    public function testBasics()
    {
        $bloomFilter = new BloomFilter(new Configuration(new InMemoryStorage(), 10000));

        $this->assertFalse($bloomFilter->has('banana'));
        $bloomFilter->set('banana');

        for ($i = 0; $i < 9000; $i++) {
            $bloomFilter->set((string)$i);
        }

        $this->assertTrue($bloomFilter->has('banana'));
    }
}
