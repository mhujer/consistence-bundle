<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\DependencyInjection;

use Mhujer\ConsistenceBundle\Enum\EnumTranslator;
use Mhujer\ConsistenceBundle\Twig\EnumTranslatorExtension;
use Mhujer\ConsistenceBundle\Twig\EnumTranslatorRuntime;

class MhujerConsistenceExtensionTest extends \Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase
{

    /**
     * @return \Symfony\Component\DependencyInjection\Extension\ExtensionInterface[]
     */
    protected function getContainerExtensions(): array
    {
        return [
            new MhujerConsistenceExtension(),
        ];
    }

    public function testServicesAreRegistered(): void
    {
        // workaround for https://github.com/SymfonyTest/SymfonyDependencyInjectionTest/pull/125
        $this->container->getCompilerPassConfig()->setAfterRemovingPasses([]);

        $this->load();

        $this->assertContainerBuilderHasService('mhujer_consistence.enum.enum_translator', EnumTranslator::class);
        $this->assertContainerBuilderHasService('Mhujer\ConsistenceBundle\Enum\EnumTranslator', EnumTranslator::class);

        $this->assertContainerBuilderHasService('mhujer_consistence.twig.enum_translator_extension', EnumTranslatorExtension::class);
        $this->assertContainerBuilderHasServiceDefinitionWithTag('mhujer_consistence.twig.enum_translator_extension', 'twig.extension');

        $this->assertContainerBuilderHasService('mhujer_consistence.twig.enum_translator_runtime', EnumTranslatorRuntime::class);
        $this->assertContainerBuilderHasServiceDefinitionWithTag('mhujer_consistence.twig.enum_translator_runtime', 'twig.runtime');

        $this->compile();
    }

}
