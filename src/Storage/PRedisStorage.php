<?php
namespace NoUseFreak\BloomFilter\Storage;


use Predis\Client;

class PRedisStorage implements StorageInterface
{
    /**
     * @var \Redis
     */
    private $PRedis;
    /**
     * @var
     */
    private $keyName;

    /**
     * RedisStorage constructor.
     *
     * @param Client $PRedis
     * @param string $keyName
     */
    public function __construct(Client $PRedis, $keyName)
    {
        $this->PRedis = $PRedis;
        $this->keyName = $keyName;
    }

    public function setSize($size)
    {
        // Not required for redis
    }

    /**
     * @inheritdoc
     */
    public function set($index)
    {
        $this->PRedis->setBit($this->keyName, $index, true);
    }

    /**
     * @inheritdoc
     */
    public function get($index)
    {
        return (bool) $this->PRedis->getBit($this->keyName, $index);
    }
}