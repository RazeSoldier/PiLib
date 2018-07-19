<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @copyright
 */

namespace PiLib\Math;

class Arithmetic
{
    /**
     * Multiply two arbitrary precision numbers
     * @param $a float|string
     * @param $b float|string
     * @return string
     */
    public static function mul($a, $b) : string
    {
        $arr = Math::batchFloatToString( [ $a, $b ] );
        $a = $arr[0];
        $b = $arr[1];
        return self::rtrim( bcmul( $a, $b ) );
    }

    /**
     * Raise an arbitrary precision number to another
     * @param float|string $a
     * @param float|string $b
     * @return string
     */
    public static function pow($a, $b) : string
    {
        $arr = Math::batchFloatToString( [ $a, $b ] );
        $a = $arr[0];
        $b = $arr[1];
        return self::rtrim( bcpow( $a, $b ) );
    }

    /**
     * Divide two arbitrary precision numbers
     * @param float|string $a
     * @param float|string $b
     * @return string
     */
    public static function div($a, $b) : string
    {
        $arr = Math::batchFloatToString( [ $a, $b ] );
        $a = $arr[0];
        $b = $arr[1];
        return self::rtrim( bcdiv( $a, $b ) );
    }

    /**
     * Get any root of a number (Non-precision operation)
     * @param float|string $a A number
     * @param float|string $b
     * @return string
     */
    public static function root($a, $b) : string
    {
        return self::rtrim( pow( $a, 1 / $b ) );
    }

    /**
     * Subtract one arbitrary precision number from another
     * @param float|string $a
     * @param float|string $b
     * @return string
     */
    public static function sub($a, $b) : string
    {
        $arr = Math::batchFloatToString( [ $a, $b ] );
        $a = $arr[0];
        $b = $arr[1];
        return self::rtrim( bcsub( $a, $b ) );
    }

    /**
     * Add two arbitrary precision numbers
     * @param float|string $a
     * @param float|string $b
     * @return string
     */
    public static function add($a, $b) : string
    {
        $arr = Math::batchFloatToString( [ $a, $b ] );
        $a = $arr[0];
        $b = $arr[1];
        return self::rtrim( bcadd( $a, $b ) );
    }

    /**
     * Clear up output
     * Remove extra 0
     * @param string $str
     * @return string
     */
    private static function rtrim(string $str) : string
    {
        $pattern[1] = '/\.0*$/';
        $pattern[2] = '/\.[0-9]*0*$/';
        if ( preg_match( $pattern[1], $str ) === 1 ) {
            $str = preg_replace( $pattern[1], null, $str );
        } elseif ( preg_match( $pattern[2], $str ) === 1 ) {
            $str = rtrim( $str, '0' );
        }
        return $str;
    }
}