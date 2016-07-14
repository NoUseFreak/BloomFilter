<?php


namespace NoUseFreak\BloomFilter;


use NoUseFreak\BloomFilter\HashFunction\CrcHash;
use NoUseFreak\BloomFilter\Storage\StorageInterface;

class Configuration
{
    /**
     * @var StorageInterface
     */
    private $storage;

    /**
     * @var int
     */
    private $maxEntries = 100;

    /**
     * @var float
     */
    private $errorChance = 0.001;

    /**
     * @var string
     */
    private $hashFunction = CrcHash::class;

    /**
     * Configuration constructor.
     *
     * @param StorageInterface $storage
     */
    public function __construct(StorageInterface $storage, $maxEntries)
    {
        $this->storage = $storage;
        $this->maxEntries = $maxEntries;
    }

    /**
     * @return int
     */
    public function getMaxEntries()
    {
        return $this->maxEntries;
    }

    /**
     * @return float
     */
    public function getErrorChance()
    {
        return $this->errorChance;
    }

    /**
     * @param float $errorChance
     */
    public function setErrorChance($errorChance)
    {
        $this->errorChance = $errorChance;
    }

    /**
     * @return string
     */
    public function getHashFunction()
    {
        return $this->hashFunction;
    }

    /**
     * @param string $hashFunction
     */
    public function setHashFunction($hashFunction)
    {
        $this->hashFunction = $hashFunction;
    }

    /**
     * @return StorageInterface
     */
    public function getStorage()
    {
        return $this->storage;
    }
}