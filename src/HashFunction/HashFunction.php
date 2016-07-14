<?php


namespace NoUseFreak\BloomFilter\HashFunction;


interface HashFunction
{
    /**
     * @param string $string
     *
     * @return int
     */
    public function hash($string);
}