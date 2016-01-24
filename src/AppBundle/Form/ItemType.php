<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ItemType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('name', TextType::class)
				->add('price', MoneyType::class, array ('currency' => 'USD'))
				->add('unit', TextType::class)->add('save', SubmitType::class, array ('label' => 'Create Item'));
	}
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults(array (
				'data_class' => 'AppBundle\Entity\Item' 
		));
	}
}