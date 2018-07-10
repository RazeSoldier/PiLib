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

namespace PiLib\Test\Physics;

use PiLib\Physics\Gravity;
use PHPUnit\Framework\TestCase;

class GravityTest extends TestCase
{
    /**
     * Test the algorithm for Gravity
     * In this case, we use Sun and Earth both as a example
     */
    public function testCalculate()
    {
        $testObj = new Gravity( [ 'm1' => 5.97237E24, 'm2' => 1.9891E30, 'r' => 149597870700 ] );
        $testObj->calculate();
        $this->assertSame( '35427777352739786224000', $testObj->getResult() );
    }

    /**
     * We deliberately throw some exception to test them
     * @expectedException \DomainException
     */
    public function testDomainExceptionThrow()
    {
        $testObj = new Gravity( [ 'm1' => 1, 'm2' => 1, 'r' => -1 ] );
        $testObj->calculate();
    }

    // Below we use the method to test the Physics class
    // because we can't instantiate the abstract class, all we can only do here

    /**
     * @expectedException \PiLib\Exception\MissingRequireException
     */
    public function testMissingRequireExceptionThrow()
    {
        $testObj = new Gravity( [ 'm1' => 1, 'm2' => 1 ] );
        $testObj->calculate();
    }

    /**
     * @expectedException \PiLib\Exception\InvalidArgumentException
     */
    public function testInvalidArgumentExceptionThrow()
    {
        $testObj = new Gravity( [ 'm1' => 1, 'm2' => 1, 'r' => '1test' ] );
        $testObj->calculate();
    }
}
