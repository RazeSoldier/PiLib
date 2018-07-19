<?php
/**
 * Created by PhpStorm.
 * User: Raze Soldier
 * Date: 2018/7/19
 * Time: 23:12
 */

namespace PiLib\Test\Physics;

use PiLib\Physics\SchwarzschildRadius;
use PHPUnit\Framework\TestCase;

class SchwarzschildRadiusTest extends TestCase
{
    /**
     * Test algorithm of SchwarzschildRadius
     * In this case, we use Earth as a example
     */
    public function testCalculate()
    {
        $testObj = new SchwarzschildRadius( [ 'm' => 5.97237E24 ] );
        $testObj->calculate();
        $this->assertSame( '0.0088700629743514', $testObj->getResult() );
    }
}
