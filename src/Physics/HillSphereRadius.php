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

namespace PiLib\Physics;

use PiLib\Math\Arithmetic as main;

/**
 * Require values:
 * m - the mass of the smaller body (e.g. Earth)
 * M - it orbits a heavier body (e.g. Sun) of mass
 * a - a semi-major axis
 * e - an eccentricity
 * @see https://en.wikipedia.org/wiki/Hill_sphere
 * @package PiLib\Physics
 */
class HillSphereRadius extends Physics
{
    protected $requireValue = [ 'e', 'M', 'm', 'a' ];

    public function calculate() : void
    {
        $this->result = main::mul(
            main::mul( $this->condValue['a'], main::sub( 1, $this->condValue['e'] ) ),
            main::root( main::div( $this->condValue['m'], main::mul( 3, $this->condValue['M'] ) ), 3 )
        );
    }

    protected function validate(array $needCheck, callable $funName = null)
    {
        parent::validate( $needCheck, function (array $needCheck, $require) {
            if ( $require === 'M' || $require === 'm' || $require === 'a' ) {
                if ( $needCheck[$require] <= 0 ) {
                    throw new \DomainException( "'$require' must be > 0", 8 );
                }
            } else {
                if ( $needCheck[$require] < 0 ) {
                    throw new \DomainException( "'$require' must be >= 0", 8 );
                }
            }
        } );
    }
}