<?php
namespace PHPSC\PagSeguro\Test\Customer;

use PHPSC\PagSeguro\Customer\Shipping;

class ShippingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function constructorMustRaiseExceptionWhenTypeIsInvalid()
    {
        new Shipping(-10);
    }

    /**
     * @test
     */
    public function constructorMustBeAbleToReceiveTypeOnly()
    {
        $shipping = new Shipping(Shipping::TYPE_PAC);

        $this->assertAttributeEquals(Shipping::TYPE_PAC, 'type', $shipping);
        $this->assertAttributeEquals(null, 'address', $shipping);
        $this->assertAttributeEquals(null, 'cost', $shipping);
    }

    /**
     * @test
     */
    public function constructorMustBeAbleToReceiveTypeAndCost()
    {
        $shipping = new Shipping(Shipping::TYPE_PAC, null, '10.31');

        $this->assertAttributeEquals(Shipping::TYPE_PAC, 'type', $shipping);
        $this->assertAttributeEquals(null, 'address', $shipping);
        $this->assertAttributeEquals(10.31, 'cost', $shipping);
    }

    /**
     * @test
     */
    public function constructorMustBeAbleToReceiveTypeAndAddress()
    {
        $address = $this->getMock('PHPSC\PagSeguro\Customer\Address', array(), array(), '', false);
        $shipping = new Shipping(Shipping::TYPE_PAC, $address);

        $this->assertAttributeEquals(Shipping::TYPE_PAC, 'type', $shipping);
        $this->assertAttributeSame($address, 'address', $shipping);
        $this->assertAttributeEquals(null, 'cost', $shipping);
    }

    /**
     * @test
     */
    public function constructorMustBeAbleToReceiveAllArguments()
    {
        $address = $this->getMock('PHPSC\PagSeguro\Customer\Address', array(), array(), '', false);
        $shipping = new Shipping(Shipping::TYPE_PAC, $address, '10.31');

        $this->assertAttributeEquals(Shipping::TYPE_PAC, 'type', $shipping);
        $this->assertAttributeSame($address, 'address', $shipping);
        $this->assertAttributeEquals(10.31, 'cost', $shipping);
    }

    /**
     * @test
     */
    public function getterShouldReturnConfiguredData()
    {
        $address = $this->getMock('PHPSC\PagSeguro\Customer\Address', array(), array(), '', false);
        $shipping = new Shipping(Shipping::TYPE_PAC, $address, '10.31');

        $this->assertEquals(Shipping::TYPE_PAC, $shipping->getType());
        $this->assertSame($address, $shipping->getAddress());
        $this->assertEquals(10.31, $shipping->getCost());
    }
}