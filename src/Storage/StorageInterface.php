<?php


namespace NoUseFreak\BloomFilter\Storage;


interface StorageInterface
{
    /**
     * @param int $size
     */
    public function setSize($size);

    /**
     * @param int $index
     */
    public function set($index);

    /**
     * @param int $index
     *
     * @return bool
     */
    public function get($index);
}