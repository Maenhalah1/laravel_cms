<?php

function inputTextValue($key, $object = null, $attribute = null){
    return request()->old($key) !== null ? request()->old($key) :
        ( is_object($object) ? ( $object->$key ? $object->$key : ( $attribute !== null ? ( $object->$attribute ? $object->$attribute : null ) : null )) : null);
}
