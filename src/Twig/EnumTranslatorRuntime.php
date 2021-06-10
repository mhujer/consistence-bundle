<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\Twig;

use Consistence\Enum\Enum;
use Mhujer\ConsistenceBundle\Enum\EnumTranslator;

class EnumTranslatorRuntime implements \Twig\Extension\RuntimeExtensionInterface
{

    /** @var \Mhujer\ConsistenceBundle\Enum\EnumTranslator */
    private $enumTranslator;

    public function __construct(
        EnumTranslator $enumTranslator
    )
    {
        $this->enumTranslator = $enumTranslator;
    }

    public function translateEnum(
        Enum $enum,
        string $translationDomain = 'enums'
    ): string
    {
        return $this->enumTranslator->translateEnum($enum, $translationDomain);
    }

}
