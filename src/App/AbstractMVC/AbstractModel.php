<?php

namespace App\App\AbstractMVC;

abstract class AbstractModel implements \ArrayAccess {

    public function offsetExists($offset): bool {
        return isset($this->$offset);
    }

    public function offsetGet($offset): mixed {
        return $this->$offset;
    }

    public function offsetSet($offset, $value): void {
        $this->$offset = $value;
    }

    public function offsetUnset($offset): void {
        unset($this->$offset);
    }
    public function getStrlen($value) {
        return strlen($value);
    }

}