<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\Enum;

use Mhujer\ConsistenceBundle\Fixtures\CardColor;
use Mhujer\ConsistenceBundle\Fixtures\RolesEnum;
use Symfony\Contracts\Translation\TranslatorInterface;

class EnumTranslatorTest extends \PHPUnit\Framework\TestCase
{

    public function testTranslateEnum(): void
    {
        $mockTranslator = $this->createMock(TranslatorInterface::class);
        $mockTranslator->method('trans')
            ->willReturnArgument(0);

        $enumTranslator = new EnumTranslator($mockTranslator);

        self::assertSame(
            'Mhujer\ConsistenceBundle\Fixtures\CardColor:red',
            $enumTranslator->translateEnum(CardColor::get(CardColor::RED))
        );
        self::assertSame(
            'Mhujer\ConsistenceBundle\Fixtures\CardColor:black',
            $enumTranslator->translateEnum(CardColor::get(CardColor::BLACK))
        );
    }

    public function testTranslateEnumWithTranslationDomain(): void
    {
        $mockTranslator = $this->createMock(TranslatorInterface::class);
        $mockTranslator->expects($this->once())
            ->method('trans')
            ->with('Mhujer\ConsistenceBundle\Fixtures\CardColor:red', [], 'enums-frontend')
            ->will($this->returnValue('translated:Mhujer\ConsistenceBundle\Fixtures\CardColor:red'));

        $enumTranslator = new EnumTranslator($mockTranslator);

        self::assertSame(
            'translated:Mhujer\ConsistenceBundle\Fixtures\CardColor:red',
            $enumTranslator->translateEnum(CardColor::get(CardColor::RED), 'enums-frontend')
        );
    }

    public function testTranslateEnumWithMultiEnumThrowsException(): void
    {
        $mockTranslator = $this->createMock(TranslatorInterface::class);

        $enumTranslator = new EnumTranslator($mockTranslator);

        $this->expectException(\Throwable::class);
        $this->expectExceptionMessage('Only single enums are supported for now.');

        $enumTranslator->translateEnum(RolesEnum::getMulti(RolesEnum::USER, RolesEnum::ADMIN));
    }

}
