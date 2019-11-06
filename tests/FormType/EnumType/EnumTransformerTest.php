<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\FormType\EnumType;

use Mhujer\ConsistenceBundle\Fixtures\CardColor;
use stdClass;

class EnumTransformerTest extends \PHPUnit\Framework\TestCase
{

    public function testTransform(): void
    {
        $enumTransformer = new EnumTransformer(CardColor::class);

        self::assertSame('black', $enumTransformer->transform(CardColor::get(CardColor::BLACK)));
        self::assertNull($enumTransformer->transform(null));
    }

    public function testReverseTransform(): void
    {
        $enumTransformer = new EnumTransformer(CardColor::class);

        self::assertSame(CardColor::get(CardColor::RED), $enumTransformer->reverseTransform('red'));
        self::assertNull($enumTransformer->reverseTransform(null));
    }

    public function testInvalidEnumClass(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessage('"stdClass" is not a subclass of "Consistence\Enum\Enum"');

        new EnumTransformer(stdClass::class);
    }

}
