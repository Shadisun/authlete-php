<?php
//
// Copyright (C) 2018 Authlete, Inc.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing,
// software distributed under the License is distributed on an
// "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
// either express or implied. See the License for the specific
// language governing permissions and limitations under the
// License.
//


/**
 * File containing the definition of ValidationUtility class.
 */


namespace Authlete\Util;


/**
 * Validation utility.
 */
class ValidationUtility
{
    /**
     * Ensure that the type of the given object is `boolean`.
     *
     * @param string $name
     *     Name of a parameter.
     *
     * @param mixed $value
     *     Value of a parameter.
     *
     * @throws \InvalidArgumentException
     *     The type of `$value` is not `boolean`.
     */
    public static function ensureBoolean($name, $value)
    {
        if (is_bool($value))
        {
            return;
        }

        throw new \InvalidArgumentException("'$name' must be a boolean value.");
    }


    /**
     * Ensure that the type of the given object is `integer`.
     *
     * @param string $name
     *     Name of a parameter.
     *
     * @param mixed $value
     *     Value of a parameter.
     *
     * @throws \InvalidArgumentException
     *     The type of `$value` is not `integer`.
     */
    public static function ensureInteger($name, $value)
    {
        if (is_integer($value))
        {
            return;
        }

        throw new \InvalidArgumentException("'$name' must be an integer.");
    }


    /**
     * Ensure that the type of the given object is `string`.
     *
     * @param string $name
     *     Name of a parameter.
     *
     * @param mixed $value
     *     Value of a parameter.
     *
     * @throws \InvalidArgumentException
     *     The type of `$value` is not `string`.
     *
     * @since 1.3
     */
    public static function ensureString($name, $value)
    {
        if (is_string($value))
        {
            return;
        }

        throw new \InvalidArgumentException("'$name' must be a string.");
    }


    /**
     * Ensure that the given object is not `null`.
     *
     * @param string $name
     *     Name of a parameter.
     *
     * @param mixed $value
     *     Value of a parameter.
     *
     * @throws \InvalidArgumentException
     *     `$value` is `null`.
     */
    public static function ensureNotNull($name, $value)
    {
        if (!is_null($value))
        {
            return;
        }

        throw new \InvalidArgumentException("'$name' must not be null.");
    }


    /**
     * Ensure that the given object is not less than 0.
     *
     * @param string $name
     *     Name of a parameter.
     *
     * @param integer $value
     *     Value of a parameter.
     *
     * @throws \InvalidArgumentException
     *     `$value` is less than 0.
     */
    public static function ensureNotNegative($name, $value)
    {
        if (0 <= $value)
        {
            return;
        }

        throw new \InvalidArgumentException("'$name' must not be negative.");
    }


    /**
     * Ensure that the type of the given object is either `string` or `integer`.
     *
     * @param string $name
     *     Name of a parameter.
     *
     * @param integer $value
     *     Value of a parameter.
     *
     * @throws \InvalidArgumentException
     *     The type of `$value` is neither `string` nor `integer`.
     */
    public static function ensureStringOrInteger($name, $value)
    {
        if (is_string($value) || is_integer($value))
        {
            return;
        }

        throw new \InvalidArgumentException("'$name' must be a string or an integer.");
    }


    /**
     * Ensure that the given object is `null` or a `string` instance.
     *
     * @param string $name
     *     Name of a parameter.
     *
     * @param integer $value
     *     Value of a parameter.
     *
     * @throws \InvalidArgumentException
     *     `$value` is neither `null` nor a `string` instance.
     */
    public static function ensureNullOrString($name, $value)
    {
        if (is_null($value) || is_string($value))
        {
            return;
        }

        throw new \InvalidArgumentException("'$name' must be null or a string.");
    }


    /**
     * Ensure that the given object is `null` or an instance of the specified type.
     *
     * @param string $name
     *     Name of a parameter.
     *
     * @param integer $value
     *     Value of a parameter.
     *
     * @param string $type
     *     The expected type of the value.
     *
     * @throws \InvalidArgumentException
     *     `$value` is neither `null` nor an instance of the specified type.
     *
     * @since 1.2
     */
    public static function ensureNullOrType($name, $value, $type)
    {
        if (is_null($value) || ($value instanceof $type))
        {
            return;
        }

        throw new \InvalidArgumentException("'$name' must be null or an instance of $type.");
    }


    /**
     * Ensure that the given object is `null`, a `string` instance,
     * or an `integer` instance.
     *
     * @param string $name
     *     Name of a parameter.
     *
     * @param integer $value
     *     Value of a parameter.
     *
     * @throws \InvalidArgumentException
     *     `$value` is not `null`, a `string` instance or an `integer` instance.
     */
    public static function ensureNullOrStringOrInteger($name, $value)
    {
        if (is_null($value) || is_string($value) || is_integer($value))
        {
            return;
        }

        throw new \InvalidArgumentException("'$name' must be null, a string or an integer.");
    }


    /**
     * Ensure that the given object is null or an array of string.
     *
     * @param string $name
     *     Name of a parameter.
     *
     * @param array $array
     *     Value of a parameter.
     *
     * @throws \InvalidArgumentException
     *     `$array` is neither `null` nor a reference of an array.
     *     Or the array has one or more non `string` elements.
     */
    public static function ensureNullOrArrayOfString($name, array &$array = null)
    {
        if (is_null($array))
        {
            return;
        }

        foreach ($array as $element)
        {
            if (!is_string($element))
            {
                throw new \InvalidArgumentException("'$name' must be null or an array of string.");
            }
        }
    }


    /**
     * Ensure that the given object is null or an array whose elements
     * are of the specified type.
     *
     * @param string $name
     *     Name of a parameter.
     *
     * @param array $array
     *     Value of a parameter.
     *
     * @param string $type
     *     The expected type of the elements in the given array.
     *
     * @throws \InvalidArgumentException
     *     `$array` is neither `null` nor a reference of an array.
     *     Or the array has one or more elements whose type is not
     *     the specified type.
     */
    public static function ensureNullOrArrayOfType($name, array &$array = null, $type)
    {
        if (is_null($array))
        {
            return;
        }

        foreach ($array as $element)
        {
            if (!($element instanceof $type))
            {
                throw new \InvalidArgumentException("'$name' must be null or an array of $type.");
            }
        }
    }
}
?>
