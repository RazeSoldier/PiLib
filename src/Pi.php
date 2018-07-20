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

namespace PiLib;

use PiLib\Exception\UnknownMethodException;

/**
 * Helper class of PiLib
 * @package PiLib
 */
final class Pi
{
    /**
     * @var string
     */
    private $result;

    /**
     * @var array
     */
    private $conds = [];

    /**
     * @var IPi
     */
    private $unit;

    public function __construct(string $method, array $conds, int $scale = 10)
    {
        $this->unit = $this->factory( $method, $conds );
        $this->conds = $conds;
        bcscale( $scale );
    }

    public function calculate() : string
    {
        $this->unit->calculate();
        $this->result = $this->unit->getResult();
        return $this->result;
    }

    private function factory(string $method, array $conds) : IPi
    {
        $prefix = '\PiLib\\';
        $className = $prefix . str_replace( '.', '\\', $method );
        if ( !class_exists( $className ) ) {
            throw new UnknownMethodException( $method );
        }
        return new $className( $conds );
    }

    /**
     * @return string
     */
    public function getResult() : string
    {
        return $this->result;
    }
}