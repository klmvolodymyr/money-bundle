<?php

namespace VolodymyrKlymniuk\MoneyBundle\Traits;

use VolodymyrKlymniuk\MoneyBundle\Exception\EmptyPriceException;
use VolodymyrKlymniuk\MoneyBundle\Exception\IncorrectAmountTypeException;
use VolodymyrKlymniuk\MoneyBundle\Money\Money;
use VolodymyrKlymniuk\MoneyBundle\Money\MoneyInterface;

trait OrmEntityMoneyTrait
{
    /**
     * @ORM\Column(type="decimal", precision=36, scale=0)
     *
     * @var string
     */
    protected $amount;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $currency;

    /**
     * @var MoneyInterface
     */
    protected $price;

    /**
     * @throws EmptyPriceException
     * @throws IncorrectAmountTypeException
     *
     * @return MoneyInterface
     */
    public function getPrice(): MoneyInterface
    {
        if (!$this->price) {
            if (empty($this->amount) || empty($this->currency)) {
                throw new EmptyPriceException();
            }

            $this->price = Money::createFromRaw($this->amount, $this->currency);
        }

        return $this->price;
    }

    /**
     * @param MoneyInterface $money
     *
     * @return self
     */
    public function setPrice(MoneyInterface $money): self
    {
        $this->price = $money;
        $this->amount = $money->getAmount();
        $this->currency = $money->getCurrency()->getCode();

        return $this;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }
}