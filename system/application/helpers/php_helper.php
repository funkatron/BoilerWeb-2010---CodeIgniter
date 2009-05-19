<?php

/**
 * Convert an object to an array
 *
 * @param   object  $object  The object to convert
 * @return  array
 * @link http://www.phpro.org/examples/Convert-Object-To-Array-With-PHP.html
 */
function objectToArray( $object )
{
    if( !is_object( $object ) && !is_array( $object ) )
    {
        return $object;
    }
    if( is_object( $object ) )
    {
        $object = get_object_vars( $object );
    }
    return array_map( 'objectToArray', $object );
}

?>