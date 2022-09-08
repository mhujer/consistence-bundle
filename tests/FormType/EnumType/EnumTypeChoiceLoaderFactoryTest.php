<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\FormType\EnumType;

use Mhujer\ConsistenceBundle\Fixtures\CardColor;
use Mhujer\ConsistenceBundle\Fixtures\CardColorNative;
use stdClass;

class EnumTypeChoiceLoaderFactoryTest extends \PHPUnit\Framework\TestCase
{

    public function testLoaderLoadsChoiceList(): void
    {
        $choiceLoader = EnumTypeChoiceLoaderFactory::createLoader(
            CardColor::class
        );

        $choiceList = $choiceLoader->loadChoiceList();

        self::assertSame([
            'Mhujer\ConsistenceBundle\Fixtures\CardColor:black' => 'black',
            'Mhujer\ConsistenceBundle\Fixtures\CardColor:red' => 'red',
        ], $choiceList->getStructuredValues());
    }

    public function testLoaderLoadsChoiceListForNativeEnum(): void
    {
        $choiceLoader = EnumTypeChoiceLoaderFactory::createLoader(
            CardColorNative::class
        );

        $choiceList = $choiceLoader->loadChoiceList();

        self::assertSame([
            'Mhujer\ConsistenceBundle\Fixtures\CardColorNative:black' => 'black',
            'Mhujer\ConsistenceBundle\Fixtures\CardColorNative:red' => 'red',
        ], $choiceList->getStructuredValues());
    }

    public function testInvalidEnumClass(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessage('"stdClass" is neither a subclass of "Consistence\Enum\Enum" or "BackedEnum"');

        EnumTypeChoiceLoaderFactory::createLoader(
            stdClass::class
        );
    }

}
