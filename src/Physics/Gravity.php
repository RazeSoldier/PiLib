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

use PiLib\Math\Arithmetic;

class Gravity extends Physics
{
    protected $requireValue = [ 'm1', 'm2', 'r' ];

    public function __construct(array $cond)
    {
        parent::__construct( $cond );
    }

    public function calculate() : void
    {
        $this->result = Arithmetic::mul(
            parent::G,
            (
            Arithmetic::div(
                    Arithmetic::mul( $this->condValue['m1'], $this->condValue['m2'] ),
                    Arithmetic::pow( $this->condValue['r'], 2 )
                )
            )
        );
    }
}