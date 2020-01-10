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

        if (!is_subclass_of($enumClassName, Enum::class)) {
            throw new \Exception(sprintf(
                '"%s" is not a subclass of "%s"',
                $enumClassName,
                Enum::class
            ));
        }
    }

    /**
     * @param \Consistence\Enum\Enum|null $enum
     */
    public function transform($enum): ?string // phpcs:ignore SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
    {
        Type::checkType($enum, Enum::class . '|null');

        if ($enum === null) {
            return null;
        }

        return (string) $enum->getValue();
    }

    /**
     * @param string|null $enumValue
     */
    public function reverseTransform($enumValue): ?Enum // phpcs:ignore SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
    {
        Type::checkType($enumValue, 'string|int|null');

        if ($enumValue === null) {
            return null;
        }

        $enumClass = $this->enumClassName;

        return $enumClass::get($enumValue);
    }

}
