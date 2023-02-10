<?php

namespace Tests\TestCase\Functional;

use VolodymyrKlymniuk\MoneyBundle\Exception\IncorrectAmountTypeException;
use VolodymyrKlymniuk\MoneyBundle\Money\Currency;
use VolodymyrKlymniuk\MoneyBundle\Money\Money;
use VolodymyrKlymniuk\SfFunctionalTest\TestCase\AppTestCase;

/**
 * Class MoneyTest
 */
class MoneyTest extends AppTestCase
{
    public function setUp(): void
    {
        $this->bootKernel();
    }

    public function testEquals()
    {
        $money = new Money('42', new Currency('USD'));
        $moneyToCompare = new Money('42', new Currency('USD'));

        $this->assertEquals(true, $money->equals($moneyToCompare));
    }

    public function testNotEqualsAmount()
    {
        $money = new Money('42', new Currency('USD'));
        $moneyToCompare = new Money('322', new Currency('USD'));

        $this->assertNotEquals(true, $money->equals($moneyToCompare));
    }

    public function testNotEqualsCurrency()
    {
        $money = new Money('42', new Currency('USD'));
        $moneyToCompare = new Money('42', new Currency('ETH'));

        $this->assertNotEquals(true, $money->equals($moneyToCompare));
    }

    public function testCreateFromRaw()
    {
        $expectedObject = new Money('100500', new Currency('USD'));
        $createdObject = Money::createFromRaw('100500', 'USD');

        $this->assertEquals($expectedObject, $createdObject);
    }

    public function testCreateFromRawException()
    {
        $this->expectException(IncorrectAmountTypeException::class);

        Money::createFromRaw('100.2', 'USD');
    }

    public function testCreate()
    {
        $expectedObject = new Money('10050', new Currency('USD'));
        $createdObject = Money::create('100.50', 'USD');

        $this->assertEquals($expectedObject, $createdObject);
    }

    public function testCreateException()
    {
        $this->expectException(IncorrectAmountTypeException::class);

        Money::create('fdsaf32', 'USD');
    }

    public function testFormat()
    {
        $money = new Money('10050', new Currency('USD'));

        $this->assertEquals('100.50', $money->format());
    }
}