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

namespace PiLib\Test;

use PiLib\Pi;
use PHPUnit\Framework\TestCase;

class PiTest extends TestCase
{
    public function testGravity()
    {
        $obj = new Pi( 'Physics.Gravity', [ 'm1' => 5.97237E24, 'm2' => 1.9891E30, 'r' => 149597870700 ] );
        $expected = '35427777352739616159555.8483042664125773794213052446915057408353138135424238647114954938849385670732873736449196104068885543';
        $this->assertSame( $expected, $obj->calculate() );
        $this->assertSame( $expected, $obj->getResult() );
    }

    /**
     * @expectedException \PiLib\Exception\UnknownMethodException
     */
    public function testUnknownMethodExceptionThrow()
    {
        $obj = new Pi( 'Physics.Gravit', [ 'm1' => 5.97237E24, 'm2' => 1.9891E30, 'r' => 149597870700 ] );
        $this->assertSame( '35427777352739786224000', $obj->calculate() );
        $this->assertSame( '35427777352739786224000', $obj->getResult() );
    }
}