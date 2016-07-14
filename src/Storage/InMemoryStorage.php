<?php


namespace NoUseFreak\BloomFilter\Storage;


class InMemoryStorage implements StorageInterface
{
    /**
     * @var \SplFixedArray
     */
    private $map;

    public function setSize($size)
    {
        $this->map = new \SplFixedArray($size);
    }

    public function set($index)
    {
        $this->map[$index] = true;
    }

    public function get($index)
    {
        return isset($this->map[$index]);
    }
}