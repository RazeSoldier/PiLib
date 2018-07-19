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

use PiLib\Math\Arithmetic;
use PHPUnit\Framework\TestCase;

class ArithmeticTest extends TestCase
{
    public function testMul()
    {
        $this->assertEquals( '3.95', Arithmetic::mul( 0.5, 7.9 ) );
        $this->assertEquals( 1.1879641167E55, Arithmetic::mul( 5.97237E24, 1.9891E30 ) );
        $this->assertSame( '35427777352739487125610.72776061158923234955256',
            Arithmetic::mul( 6.67408E-11, '530826381355025518507580486907732.44001195' ) );
    }

    public function testPow()
    {
        $this->assertEquals( '357.21', Arithmetic::pow( 18.9, 2 ) );
        $this->assertEquals( '22379522917973918490000', Arithmetic::pow( 149597870700, 2 ) );
    }

    public function testDiv()
    {
        $this->assertEquals( '9.45', Arithmetic::div( 18.9, 2 ) );
        $this->assertEquals( 0, strpos( Arithmetic::div( 1.1879641167E55, '22379522917973918490000' ),
            '530826381355025518507580486907732.44001195' ) );
    }

    public function testRoot()
    {
        $this->assertEquals( 2, Arithmetic::root( 8, 3 ) );
    }

    public function testSub()
    {
        $this->assertSame( '5', Arithmetic::sub( 8, 3 ) );
        $this->assertSame( '11879641166999999999999999999999999999999999999999999999',
            Arithmetic::sub( 1.1879641167E55, 1 ) );
    }

    public function testAdd()
    {
        $this->assertSame( '11', Arithmetic::add( 8, 3 ) );
        $this->assertSame( '11879641167000000000000000000000000000000000000000000000',
            Arithmetic::add( '11879641166999999999999999999999999999999999999999999999', 1 ) );
    }
}
