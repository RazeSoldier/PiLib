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

use PiLib\{
    Exception\MissingRequireException,
    Exception\InvalidArgumentException
};

/**
 * Class Core
 * @package PiLib
 */
abstract class Core implements IPi
{
    /**
     * @var array The condition value required, used to Physics::validate()
     */
    protected $requireValue = [];

    /**
     * @var array The condition value
     */
    protected $condValue = [];

    /**
     * @var string
     */
    protected $result;

    public function __construct(array $cond)
    {
        bcscale( 100 );
        $this->validate( $cond );
    }

    protected function validate(array $needCheck, callable $funName = null)
    {
        if ( empty( $needCheck ) ) {
            throw new \InvalidArgumentException( 'Empty condition' );
        }

        if ( $this->requireValue !== [] ) {
            foreach ( $this->requireValue as $require ) {
                if ( !isset( $needCheck[$require] ) ) {
                    throw new MissingRequireException( $require );
                }
                if ( !is_numeric( $needCheck[$require] ) ) {
                    throw new InvalidArgumentException( "'$require' must be a number" );
                }
                // This is a Hook
                if ( $funName !== null ) {
                    call_user_func( $funName, $needCheck, $require );
                }
                $this->condValue[$require] = $needCheck[$require];
            }
        }
    }

    /**
     * Get calculation result
     * @return string
     */
    public function getResult() : string
    {
        return $this->result;
    }
}