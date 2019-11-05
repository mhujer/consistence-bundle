<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\Twig;

class EnumTranslatorExtensionTest extends \PHPUnit\Framework\TestCase
{

    public function testEnumTranslatorExtension(): void
    {
        $enumTranslatorExtension = new EnumTranslatorExtension();

        $filters = $enumTranslatorExtension->getFilters();

		self::assertCount(1, $filters);

        self::assertSame('transEnum', $filters[0]->getName());
        self::assertSame([EnumTranslatorRuntime::class, 'translateEnum'], $filters[0]->getCallable());
    }

}
