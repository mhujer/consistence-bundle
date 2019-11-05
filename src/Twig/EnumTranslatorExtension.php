<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\Twig;

use Consistence\Enum\Enum;
use Mhujer\ConsistenceBundle\Enum\EnumTranslator;
use Twig\TwigFilter;

class EnumTranslatorExtension extends \Twig\Extension\AbstractExtension
{

    /** @var \Mhujer\ConsistenceBundle\Enum\EnumTranslator */
    private $enumTranslator;

    public function __construct(
        EnumTranslator $enumTranslator
    )
    {
        $this->enumTranslator = $enumTranslator;
    }

    /**
     * @return \Twig_SimpleFilter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('transEnum', [$this, 'translateEnum']),
        ];
    }

    public function translateEnum(Enum $enum): ?string
    {
        return $this->enumTranslator->translateEnum($enum);
    }

    public function getName(): string
    {
        return 'enum_translator_extension';
    }

}
