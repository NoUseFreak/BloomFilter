<?php


namespace NoUseFreak\BloomFilter\Storage;


class RedisStorage implements StorageInterface
{
    /**
     * @var \Redis
     */
    private $redis;
    /**
     * @var
     */
    private $keyName;

    /**
     * RedisStorage constructor.
     *
     * @param \Redis $redis
     * @param string $keyName
     */
    public function __construct(\Redis $redis, $keyName)
    {
        $this->redis = $redis;
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
        $this->redis->setBit($this->keyName, $index, true);
    }

    /**
     * @inheritdoc
     */
    public function get($index)
    {
        return (bool) $this->redis->getBit($this->keyName, $index);
    }
}