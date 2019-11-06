<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\FormType;

use Mhujer\ConsistenceBundle\Fixtures\CardColor;

class EnumTypeTest extends \Symfony\Component\Form\Test\TypeTestCase
{

    public function testSubmitValidData(): void
    {
        $formElement = $this->factory->create(EnumType::class, null, [
            'enum_class' => CardColor::class,
        ]);

        $formElement->submit('red');

        $this->assertTrue($formElement->isSynchronized());

        /** @var \Mhujer\ConsistenceBundle\Fixtures\CardColor $enumFromForm */
        $enumFromForm = $formElement->getData();
        self::assertInstanceOf(CardColor::class, $enumFromForm);
        self::assertSame(CardColor::RED, $enumFromForm->getValue());
    }

    public function testUpdateWithData(): void
    {
        $formElement = $this->factory->create(EnumType::class, CardColor::get(CardColor::BLACK), [
            'enum_class' => CardColor::class,
        ]);

        /** @var \Mhujer\ConsistenceBundle\Fixtures\CardColor $enumFromForm */
        $enumFromForm = $formElement->getData();
        self::assertInstanceOf(CardColor::class, $enumFromForm);
        self::assertSame(CardColor::BLACK, $enumFromForm->getValue());

        // submit form
        $formElement->submit('red');

        $this->assertTrue($formElement->isSynchronized());

        /** @var \Mhujer\ConsistenceBundle\Fixtures\CardColor $enumFromForm */
        $enumFromForm = $formElement->getData();
        self::assertInstanceOf(CardColor::class, $enumFromForm);
        self::assertSame(CardColor::RED, $enumFromForm->getValue());
    }

}
