<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\FormType\EnumType;

use Consistence\Enum\Enum;
use Consistence\Type\ArrayType\ArrayType;
use Consistence\Type\ArrayType\KeyValuePair;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;

class EnumTypeChoiceLoaderFactory
{

    /**
     * @phpstan-param class-string $enumClassName
     */
    public static function createLoader(string $enumClassName): ChoiceLoaderInterface
    {
        if (!is_subclass_of($enumClassName, Enum::class)) {
            throw new \Exception(sprintf(
                '"%s" is not a subclass of "%s"',
                $enumClassName,
                Enum::class
            ));
        }

        /** @var mixed[] $values */
        $values = $enumClassName::getAvailableValues();

        $values = ArrayType::mapByCallback($values, function (KeyValuePair $keyValuePair) use ($enumClassName) {
            return new KeyValuePair(
                $enumClassName . ':' . $keyValuePair->getValue(),
                $keyValuePair->getValue()
            );
        });

        return new CallbackChoiceLoader(function () use ($values) {
            return $values;
        });
    }

}
