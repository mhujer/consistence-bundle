<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\Enum;

use Mhujer\ConsistenceBundle\Fixtures\CardColor;
use Mhujer\ConsistenceBundle\Fixtures\RolesEnum;
use Symfony\Component\Translation\Translator;

class EnumTranslatorTest extends \PHPUnit\Framework\TestCase
{

    public function testTranslateEnum(): void
    {
        $dummyTranslator = new Translator(null);
        $enumTranslator = new EnumTranslator($dummyTranslator);

        self::assertSame(
            'Mhujer\ConsistenceBundle\Fixtures\CardColor:red',
            $enumTranslator->translateEnum(CardColor::get(CardColor::RED))
        );
        self::assertSame(
            'Mhujer\ConsistenceBundle\Fixtures\CardColor:black',
            $enumTranslator->translateEnum(CardColor::get(CardColor::BLACK))
        );
    }

    public function testTranslateEnumWithMultiEnumThrowsException(): void
    {
        $enumTranslator = new EnumTranslator(new Translator(null));

        $this->expectException(\Throwable::class);
        $this->expectExceptionMessage('Only single enums are supported for now.');

        $enumTranslator->translateEnum(RolesEnum::getMulti(RolesEnum::USER, RolesEnum::ADMIN));
    }

}
