<?php declare(strict_types = 1);

namespace Mhujer\ConsistenceBundle\FormType;

use Mhujer\ConsistenceBundle\FormType\EnumType\EnumTransformer;
use Mhujer\ConsistenceBundle\FormType\EnumType\EnumTypeChoiceLoaderFactory;
use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnumType extends \Symfony\Component\Form\AbstractType
{

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefined('enum_class');
        $resolver->setAllowedTypes('enum_class', 'string');

        $resolver->setDefaults([
            'choice_loader' => function (Options $options): ChoiceLoaderInterface {
                $enumClassName = $options['enum_class'];
                return EnumTypeChoiceLoaderFactory::createLoader($enumClassName);
            },
            'choice_translation_domain' => 'enums',
        ]);
    }

    /**
     * @param mixed[] $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(new EnumTransformer($options['enum_class']));
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

}
