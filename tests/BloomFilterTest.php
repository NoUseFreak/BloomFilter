<?php

namespace NoUseFreak\BloomFilter;

use NoUseFreak\BloomFilter\Storage\InMemoryStorage;

class BloomFilterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BloomFilter
     */
    private $bloomFilter;

    protected function setUp()
    {
        $this->bloomFilter = new BloomFilter(new Configuration(new InMemoryStorage(), 100));
    }

    public function testBasics()
    {
        $this->assertFalse($this->bloomFilter->has('test'));

        $this->bloomFilter->set('test');

        $this->assertTrue($this->bloomFilter->has('test'));
    }

    public function testAlmostFullSet()
    {
        $this->assertFalse($this->bloomFilter->has('test'));

        $this->bloomFilter->set('test');
        for ($i = 0; $i < 20; $i++) {
            $this->bloomFilter->set((string)$i);
        }
        
        $this->assertTrue($this->bloomFilter->has('test'));
    }
}
