<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\Twig;

use Mhujer\ConsistenceBundle\Enum\EnumTranslator;
use Mhujer\ConsistenceBundle\Fixtures\CardColor;
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

}
