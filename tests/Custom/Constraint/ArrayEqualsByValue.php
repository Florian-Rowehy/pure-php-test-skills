<?php declare(strict_types=1);


namespace Whatafix\TextTagger\Test\Custom\Constraint;


use PHPUnit\Framework\Constraint\Constraint;

class ArrayEqualsByValue extends Constraint
{
    /**
     * @var array
     */
    private $expected;

    public function __construct(array $expected)
    {
        $this->expected = $expected;
    }

    /**
     * @inheritDoc
     */
    public function evaluate($other, string $description = '', bool $returnResult = false): ?bool
    {
        if (!$this->matches($other) || count($other) !== count($this->expected)) {
            if ($returnResult) {
                return false;
            }

            $this->fail($other, $description);
        }

        foreach ($other as $value) {
            if (!in_array($value, $this->expected)) {
                if ($returnResult) {
                    return false;
                }

                $this->fail($other, $description);
            }
        }

        return true;
    }

    protected function matches($other): bool
    {
        return is_array($other);
    }

    /**
     * @inheritDoc
     */
    public function toString(): string
    {
        return 'arrays has same values';
    }
}