<?php

class PhinxHelper {

    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     * https://gist.github.com/mattstauffer/59170bc2cb6318ab6d46
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public static function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return static::value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;

            case 'false':
            case '(false)':
                return false;

            case 'empty':
            case '(empty)':
                return '';

            case 'null':
            case '(null)':
                return;
        }

        if (str::startsWith($value, '"') && str::endsWith($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }

    /**
     * Return the default value of the given value.
     * https://gist.github.com/shengyou/7ee32d24b1f0b61fe8349b41a0c22321
     *
     * @param  mixed  $value
     * @return mixed
     */
    public static function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }

};