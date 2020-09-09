<?php
	declare(strict_types=1);
	namespace App\Controller;

	use App\Entity\Joke;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;

	class JokeController extends AbstractController {

		public function indexAction(Request $request): Response {
			$jokes = $this->getDoctrine()->getRepository(Joke::class)->findAll();

			return $this->json($jokes);
		}

		public function createAction(Request $request): Response {
			return $this->json('');
		}
	}
