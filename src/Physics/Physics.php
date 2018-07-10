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

use PiLib\Core;

abstract class Physics extends Core
{
    /**
     * @var float Gravitational constant, 6.674×10−11 N·kg–2·m2
     */
    const G = 6.67408E-11;

    protected function validate(array $needCheck, callable $funName = null)
    {
        parent::validate( $needCheck, function (array $needCheck, $require) {
            if ( $needCheck[$require] <= 0 ) {
                throw new \DomainException( "'$require' must be > 0", 8 );
            }
        } );
    }
}