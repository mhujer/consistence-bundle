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
        Enum|\BackedEnum $enum,
        string $translationDomain = 'enums'
    ): string
    {
        if ($enum instanceof MultiEnum) {
            throw new \Exception('Only single enums are supported for now.');
        }

        if ($enum instanceof Enum) {
            $translateKey = get_class($enum) . ':' . $enum->getValue();
        } elseif ($enum instanceof \BackedEnum) {
            $translateKey = get_class($enum) . ':' . (string) $enum->value;
        } else {
            throw new \Exception(sprintf('Unexpected enum class "%s"', get_class($enum)));
        }

        return $this->translator->trans($translateKey, [], $translationDomain);
    }

}
