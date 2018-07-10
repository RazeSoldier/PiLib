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

use PiLib\Exception\InvalidArgumentException;

class Math
{
    /**
     * Converting a float represented by a scientific notation to a string
     * @param float|string $float
     * @return string
     */
    public static function floatToString($float) : string
    {
        $pattern = '/(?<isMinus>-)?(?<significand>(?<int>[0-9]*)(\.(?<decimal>[0-9]*))?)(E|e)(?<symbol>[+|-])?(?<exponent>[0-9]*)/';
        if ( preg_match_all( $pattern, $float, $matches ) === 0 ) {
            throw new InvalidArgumentException( "Invalid float represented by a scientific notation: $float" );
        }
        $prefix = $matches['isMinus'][0];
        // Match like 1E10, 3E13, 3E-13
        if ( $matches['decimal'][0] === '0' || $matches['decimal'][0] === '' ) {
            if ( $matches['symbol'][0] === '+' || $matches['symbol'][0] === '' ) {
                $prefix .= $matches['int'][0];
                $str = $prefix . str_repeat( '0', $matches['exponent'][0] );
            } else {
                $str = $prefix . '0.' . str_repeat( '0', $matches['exponent'][0] - 1 ) . $matches['int'][0];
            }
        } else {
            if ( $matches['symbol'][0] === '+' || $matches['symbol'][0] === '' ) {
                // Match like 1.3E10, 3.141E13, 3.14E-3
                $repeatCount = $matches['exponent'][0] - strlen( $matches['decimal'][0] );
                if ( $repeatCount >= 0 ) {
                    $prefix .= $matches['int'][0] . $matches['decimal'][0];
                    $str = $prefix . str_repeat( '0', $repeatCount );
                } else {
                    $significand = str_replace('.', null, $matches['significand'][0] );
                    $leftStr = substr( $significand, 0, $matches['exponent'][0] + 1 );
                    $rightStr = substr( $significand, $repeatCount );
                    $str = "$prefix$leftStr.$rightStr";
                }
            } else {
                $significand = str_replace('.', null, $matches['significand'][0] );
                $str = $prefix . '0.' . str_repeat( '0', $matches['exponent'][0] - 1 ) . $significand;
            }
        }
        return $str;
    }

    /**
     * Batch execute Math::floatToString()
     * @param string[]|float[] $arr
     * @return array
     */
    public static function batchFloatToString(array $arr) : array
    {
        if ( empty( $arr ) ) {
            throw new InvalidArgumentException( 'Empty array' );
        }
        foreach ( $arr as $key => $value ) {
            try {
                $result[$key] = self::floatToString( $value );
            } catch ( InvalidArgumentException $e ) {
                // Avoid converting when $value is not invalid a float represented by a scientific notation
                $result[$key] = $value;
            }
        }
        if ( !isset( $result ) ) {
            throw new \RuntimeException();
        }
        return $result;
    }
}