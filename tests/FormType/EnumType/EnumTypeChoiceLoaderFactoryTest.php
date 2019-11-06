<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\FormType\EnumType;

use Mhujer\ConsistenceBundle\Fixtures\CardColor;
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

    public function testInvalidEnumClass(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessage('"stdClass" is not a subclass of "Consistence\Enum\Enum"');

        EnumTypeChoiceLoaderFactory::createLoader(
            stdClass::class
        );
    }

}
