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

use PiLib\Physics\{
    HillSphereRadius,
    Physics
};
use PHPUnit\Framework\TestCase;

class HillSphereRadiusTest extends TestCase
{
    /**
     * Test algorithm of HillSphereRadius
     * In this case, we use Earth as a example
     */
    public function testCalculate()
    {
        $testObj = new HillSphereRadius( [ 'm' => 5.97237E24, 'e' => 0, 'M' => 1.9891E30, 'a' => Physics::AU ] );
        $testObj->calculate();
        $this->assertSame( '1496402263.4391954824733', $testObj->getResult() );
    }

    /**
     * We deliberately throw some exception to test them
     * @expectedException \DomainException
     */
    public function testDomainExceptionThrow1()
    {
        $testObj = new HillSphereRadius( [ 'M' => 13.2, 'm' => 1, 'a' => 0, 'e' => 100 ] );
        $testObj->calculate();
    }

    /**
     * We deliberately throw some exception to test them
     * @expectedException \DomainException
     */
    public function testDomainExceptionThrow2()
    {
        $testObj = new HillSphereRadius( [ 'M' => 13.2, 'm' => 1, 'a' => 2, 'e' => -1 ] );
        $testObj->calculate();
    }
}
