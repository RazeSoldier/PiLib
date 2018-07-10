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

namespace PiLib\Test\Math;

use PiLib\Math\Math;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testFloatToString()
    {
        $this->assertEquals( '10000', Math::floatToString( '1e4' ) );
        $this->assertEquals( '0.0001', Math::floatToString( '1e-4' ) );
        $this->assertEquals( '1542', Math::floatToString( '1.542E3' ) );
        $this->assertEquals( '154.2', Math::floatToString( '1.542E2' ) );
        $this->assertEquals( '0.01542', Math::floatToString( '1.542E-2' ) );
    }

    /**
     * @depends testFloatToString
     */
    public function testBatchFloatToString()
    {
        $this->assertSame(
            [ '10000', '0.0001', '1542', '123' ],
            Math::batchFloatToString( [ '1e4', '1e-4', '1.542E3', '123' ] )
        );
    }

    /**
     * @expectedException \PiLib\Exception\InvalidArgumentException
     */
    public function testFloatToStringExThrow()
    {
        Math::floatToString( '530826381355025518507580486907732.44001195' );
    }
}
