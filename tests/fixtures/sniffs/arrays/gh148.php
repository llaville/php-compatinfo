<?php
namespace {
    function returnArray() {
        return ['one', 'two', 'three'];
    }
    echo returnArray()[0];
}

namespace N {
    function returnArray() {
        return array('1', '2', '3');
    }
    echo returnArray()[1];
}
