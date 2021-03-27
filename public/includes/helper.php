<?php 


class MyJsonObject implements JsonSerializable {
    public $bar = 'hello';
    public $baz = 'world';

    public function jsonSerialize () {
        return array(
            'bar'=>$this->bar,
            'baz'=>$this->baz
        );
    }
}