<?php

namespace VolodymyrKlymniuk\MoneyBundle\Parser;

class MoneyParser implements ParserInterface
{
    /**
     * @var CurrenciesInterface
     */
    private $currencyRegistry;

    /**
     * MoneyParser constructor.
     *
     * @param CurrenciesInterface $currencyRegistry
     */
    public function __construct(CurrenciesInterface $currencyRegistry)
    {
        $this->currencyRegistry = $currencyRegistry;
    }

    /**
     * @inheritdoc
     *
     * @throws CurrencyNotRegisteredException
     */
    public function parse(string $amount, CurrencyInterface $currency, $delimiter = '.'): string
    {
        $rawAmount = $this->placeZerosAfterDelimiter($amount, $currency, $delimiter);
        $rawAmount = $this->addNegativeSymbol($rawAmount);
        $rawAmount = $this->removeLeadingZero($rawAmount);

        if ($rawAmount === '') {
            $rawAmount = '0';
        }

        return $rawAmount;
    }

    /**
     * Adding missing zeros in the right part of source number.
     * For example:
     *  - 100 USD will be 10000
     *  - 100.1 USD will be in 10010
     *  - 1.2 ETH will be 1200000000000000000
     *
     * @param string            $amount
     * @param CurrencyInterface $currency
     * @param string            $delimiter
     *
     * @return string
     *
     * @throws CurrencyNotRegisteredException
     */
    private function placeZerosAfterDelimiter(
        string $amount,
        CurrencyInterface $currency,
        string $delimiter
    ): string {

        $fractionalSize = $this->currencyRegistry->fractionalFor($currency);
        $fractionalSeparatorPosition = \strpos($amount, $delimiter);

        // If number have delimiter, we calculating missing zeros after last digit
        if ($fractionalSeparatorPosition !== false) {
            $amountWithZeros = \str_replace($delimiter, '', $amount);
            $amountLength = \strlen($amountWithZeros);
            $amountWithZeros .= \str_pad(
                '',
                ($amountLength - $fractionalSeparatorPosition - $fractionalSize) * -1,
                '0'
            );
        } else {
            $amountWithZeros = $amount;
            $amountWithZeros .= \str_pad('', $fractionalSize, '0');
        }

        return $amountWithZeros;
    }

    /**
     * @param string $rawAmount
     *
     * @return string
     */
    private function addNegativeSymbol(string $rawAmount): string
    {
        if ($rawAmount[0] === '-') {
            $rawAmount = '-' . \ltrim(\substr($rawAmount, 1), '0');
        }

        return $rawAmount;
    }

    /**
     * @param string $rawAmount
     *
     * @return string
     */
    private function removeLeadingZero(string $rawAmount): string
    {
        if ($rawAmount[0] !== '-') {
            $rawAmount = \ltrim($rawAmount, '0');
        }

        return $rawAmount;
    }
}