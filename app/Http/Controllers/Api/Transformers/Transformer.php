<?php

/**
 * Created by PhpStorm.
 * User: Atallah
 * Date: 1/9/2017
 * Time: 10:07 AM
 */
abstract class Transformer
{

    /**
     * @param $item
     * @return array
     */
    public function transformCollection(array $item)
    {
        return array_map([$this, 'transform'], $item);

    }

    public abstract function transform($item);
}