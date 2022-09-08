<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\FormType\EnumType;

use Consistence\Enum\Enum;
use Consistence\Type\Type;

class EnumTransformer implements \Symfony\Component\Form\DataTransformerInterface
{

    /** @var string */
    private $enumClassName;

    public function __construct(string $enumClassName)
    {
        $this->enumClassName = $enumClassName;

        if (!is_subclass_of($enumClassName, Enum::class) && !is_subclass_of($enumClassName, \BackedEnum::class)) {
            throw new \Exception(sprintf(
                '"%s" is neither a subclass of "%s" or "%s"',
                $enumClassName,
                Enum::class,
                \BackedEnum::class,
            ));
        }
    }

    /**
     * @param \Consistence\Enum\Enum|\BackedEnum|null $enum
     */
    public function transform($enum): ?string // phpcs:ignore SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
    {
        Type::checkType($enum, Enum::class . '|' . \BackedEnum::class . '|null');

        if ($enum === null) {
            return null;
        }

        if ($enum instanceof Enum) {
            return (string) $enum->getValue();
        }

        return (string) $enum->value;
    }

    /**
     * @param string|null $enumValue
     */
    public function reverseTransform($enumValue): Enum|\BackedEnum|null // phpcs:ignore SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
    {
        Type::checkType($enumValue, 'string|int|null');

        if ($enumValue === null) {
            return null;
        }

        $enumClass = $this->enumClassName;

        if (is_subclass_of($enumClass, Enum::class)) {
            return $enumClass::get($enumValue);
        }

        return $enumClass::from($enumValue);
    }

}
