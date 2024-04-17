<?php

namespace App\Form;

use App\Entity\Categorias;
use App\Entity\Producto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'attr'=> [
                    'placeholder' => 'Intruce el nombre del producto'
                ],
                'label'=>'Nombre del producto'
            ])
            ->add('Descripcion', TextType::class,[
                'attr'=> [
                    'placeholder' => 'Escribe la descripcion del producto'
                ],
                'label'=>'Descrpcion del producto'
            ])
            ->add('Imagen')
            ->add('Precio')
            ->add('categorias', EntityType::class, [
                'class' => Categorias::class,
                'choice_label' => 'nombre',
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('enviar', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Producto::class,
        ]);
    }
}
