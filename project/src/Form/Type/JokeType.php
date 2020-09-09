<?php
	declare(strict_types=1);
	namespace App\Form\Type;

	use App\Entity\Joke;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	use Symfony\Component\Validator\Constraints\NotNull;
	use Symfony\Component\Validator\Constraints\Length;

	class JokeType extends AbstractType {
		/**
		 * @param FormBuilderInterface $builder
		 * @param array $options
		 */
		public function buildForm(FormBuilderInterface $builder, array $options) {
			$builder->add('title', TextType::class, [
				'constraints' => [
					new NotNull(),
					new Length([
						'max' => 40
					])
				]
			])->add('body', TextType::class, [
				'constraints' => [
					new NotNull(),
					new Length([
						'max' => 1200
					])
				]
			]);
		}

		/**
		 * @param OptionsResolver $resolver
		 */
		public function configureOptions(OptionsResolver $resolver) {
			$resolver->setDefaults([
				'data_class' => Joke::class
			]);
		}
	}