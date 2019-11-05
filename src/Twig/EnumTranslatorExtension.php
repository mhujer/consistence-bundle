<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\Twig;

use Twig\TwigFilter;

class EnumTranslatorExtension extends \Twig\Extension\AbstractExtension
{

    /**
     * @return \Twig_SimpleFilter[]
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('transEnum', [EnumTranslatorRuntime::class, 'translateEnum']),
        ];
    }

}
