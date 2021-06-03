<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\Enum;

use Consistence\Enum\Enum;
use Consistence\Enum\MultiEnum;
use Symfony\Contracts\Translation\TranslatorInterface;

class EnumTranslator
{

    /** @var \Symfony\Contracts\Translation\TranslatorInterface */
    private $translator;

    public function __construct(
        TranslatorInterface $translator
    )
    {
        $this->translator = $translator;
    }

    public function translateEnum(
        Enum $enum,
        ?string $enumNamespace = null
    ): string
    {
        if ($enum instanceof MultiEnum) {
            throw new \Exception('Only single enums are supported for now.');
        }

        $translateKey = get_class($enum) . ($enumNamespace !== null ? ':' . $enumNamespace : '') . ':' . $enum->getValue();

        return $this->translator->trans($translateKey, [], 'enums');
    }

}
