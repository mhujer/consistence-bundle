<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\Twig;

use Mhujer\ConsistenceBundle\Enum\EnumTranslator;
use Mhujer\ConsistenceBundle\Fixtures\CardColor;
use Mhujer\ConsistenceBundle\Fixtures\CardColorNative;
use Symfony\Contracts\Translation\TranslatorInterface;

class EnumTranslatorRuntimeTest extends \PHPUnit\Framework\TestCase
{

    public function testTranslateEnum(): void
    {
        $mockTranslator = $this->createMock(TranslatorInterface::class);
        $mockTranslator->method('trans')
            ->willReturnArgument(0);

        $enumTranslatorRuntime = new EnumTranslatorRuntime(
            new EnumTranslator($mockTranslator)
        );

        self::assertSame(
            'Mhujer\ConsistenceBundle\Fixtures\CardColor:red',
            $enumTranslatorRuntime->translateEnum(CardColor::get(CardColor::RED))
        );
    }

    public function testTranslateEnumWithTranslationDomain(): void
    {
        $mockTranslator = $this->createMock(TranslatorInterface::class);
        $mockTranslator->expects($this->once())
            ->method('trans')
            ->with('Mhujer\ConsistenceBundle\Fixtures\CardColor:red', [], 'enums-frontend')
            ->will($this->returnValue('translated:Mhujer\ConsistenceBundle\Fixtures\CardColor:red'));

        $enumTranslatorRuntime = new EnumTranslatorRuntime(
            new EnumTranslator($mockTranslator)
        );

        self::assertSame(
            'translated:Mhujer\ConsistenceBundle\Fixtures\CardColor:red',
            $enumTranslatorRuntime->translateEnum(CardColor::get(CardColor::RED), 'enums-frontend')
        );
    }

    public function testTranslateNativeEnum(): void
    {
        $mockTranslator = $this->createMock(TranslatorInterface::class);
        $mockTranslator->method('trans')
            ->willReturnArgument(0);

        $enumTranslatorRuntime = new EnumTranslatorRuntime(
            new EnumTranslator($mockTranslator)
        );

        self::assertSame(
            'Mhujer\ConsistenceBundle\Fixtures\CardColorNative:black',
            $enumTranslatorRuntime->translateEnum(CardColorNative::BLACK)
        );
    }

    public function testTranslateNativeEnumWithTranslationDomain(): void
    {
        $mockTranslator = $this->createMock(TranslatorInterface::class);
        $mockTranslator->expects($this->once())
            ->method('trans')
            ->with('Mhujer\ConsistenceBundle\Fixtures\CardColorNative:black', [], 'enums-frontend')
            ->will($this->returnValue('translated:Mhujer\ConsistenceBundle\Fixtures\CardColorNative:black'));

        $enumTranslatorRuntime = new EnumTranslatorRuntime(
            new EnumTranslator($mockTranslator)
        );

        self::assertSame(
            'translated:Mhujer\ConsistenceBundle\Fixtures\CardColorNative:black',
            $enumTranslatorRuntime->translateEnum(CardColorNative::BLACK, 'enums-frontend')
        );
    }

}
