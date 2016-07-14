<?php


namespace NoUseFreak\BloomFilter\HashFunction;


class CrcHash implements HashFunction
{
    /**
     * @var string
     */
    private $seed;
    /**
     * @var
     */
    private $size;

    public function __construct($seed, $size)
    {
        $this->seed = $seed;
        $this->size = $size;
    }

    public function hash($string)
    {
        return abs(crc32(md5($this->seed . strval($string)))) % $this->size;
    }
}