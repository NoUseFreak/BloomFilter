<?php

namespace NoUseFreak\BloomFilter\Storage;

use NoUseFreak\BloomFilter\BloomFilter;
use NoUseFreak\BloomFilter\Configuration;

class RedisTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BloomFilter
     */
    private $bloomFilter;
    private $size;

    protected function setUp()
    {
        if (!extension_loaded('redis')) {
            $this->markTestSkipped(
                'The Redis extension is not available.'
            );
        }
        $this->size = getenv('BLOOM_SIZE') ?: 100;

        $client = new \Redis();
        $key = 'integrationTestRedis';
        $client->del([$key]);


        $this->bloomFilter = new BloomFilter(new Configuration(new RedisStorage($client, $key), $this->size));
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
        for ($i = 0; $i < $this->size / 20; $i++) {
            $this->bloomFilter->set((string)$i);
        }
        
        $this->assertTrue($this->bloomFilter->has('test'));
    }
}
