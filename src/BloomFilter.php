<?php
namespace NoUseFreak\BloomFilter;


use NoUseFreak\BloomFilter\HashFunction\CrcHash;
use NoUseFreak\BloomFilter\HashFunction\HashFunction;
use NoUseFreak\BloomFilter\Storage\StorageInterface;

class BloomFilter
{
    /**
     * @var StorageInterface
     */
    private $storage;

    /**
     * @var HashFunction[]
     */
    private $hashFunctions;

    /**
     * @var int
     */
    private $maxSize;

    /**
     * BloomFilter constructor.
     *
     * @param StorageInterface $storage
     * @param int $maxSize
     * @param HashFunction[] $hashFunctions
     */
    public function __construct(Configuration $configuration)
    {
        $size = -round(($configuration->getMaxEntries() * log($configuration->getErrorChance())) / pow(log(2), 2));
        $hashCount = round($size * log(2) / $configuration->getMaxEntries());

        $this->storage = $configuration->getStorage();
        $this->storage->setSize($size);

        $this->hashFunctions = $this->buildHashFunctions($configuration->getHashFunction(), $hashCount, $size);
    }

    /**
     * @param string $hashFunction
     * @param int $count
     *
     * @return array
     */
    private function buildHashFunctions($hashFunction, $count, $size)
    {
        $hashFunctions = [];

        for ($i = 0; $i < $count; $i++) {
            $seed = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
            $hashFunctions[] = new $hashFunction($seed, $size);
        }

        return $hashFunctions;
    }

    /**
     * @param string $string
     */
    public function set($string)
    {
        foreach ($this->hashFunctions as $hashFunction) {
            $this->storage->set($hashFunction->hash($string));
        }
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    public function has($string)
    {
        foreach ($this->hashFunctions as $hashFunction) {
            if ($this->storage->get($hashFunction->hash($string, $this->maxSize))) {
                return true;
            }
        }

        return false;
    }
}