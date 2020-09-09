<?php
	declare(strict_types=1);
	namespace App\Controller;

	use App\Entity\Joke;
	use App\Form\Type\JokeType;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

	class JokeController extends AbstractApiController {

		public function listAction(Request $request): Response {
			$page = $request->get('page');
			$limit = $request->get('perPage');
			$offset = $limit * ($page - 1);

			if (!$page || !$limit) {
				$jokes = $this->getDoctrine()->getRepository(Joke::class)->findAll();
			} else {
				$jokes = $this->getDoctrine()->getRepository(Joke::class)->findBy([], null, $limit, $offset);
			}

			$data = [
				'count' => sizeof($jokes),
				'jokes' => $jokes
			];
			return $this->respond($data);
		}

		public function fetchAction(Request $request): Response {
			$jokeId = $request->get('id');
			if (empty($jokeId)) {
				$pathParts = explode('/', $request->getPathInfo());
				if (array_search('random', $pathParts) !== false) {
					$count = $this->getDoctrine()->getRepository(Joke::class)->count([]);
					$offset = mt_rand(1, $count);
					$joke = $this->getDoctrine()->getRepository(Joke::class)->findBy([], null, 1, $offset);
					$data = [
						'count' => sizeof($joke),
						'jokes' => $joke
					];
					return $this->respond($data);
				}
				throw new NotFoundHttpException('Invalid ID');
			}

			$joke = $this->getDoctrine()->getRepository(Joke::class)->findOneBy([
				'id' => $jokeId
			]);

			if (empty($joke)) {
				throw new NotFoundHttpException('Resource not found');
			}

			return $this->respond($joke);
		}

		public function createAction(Request $request): Response {
			$form = $this->buildForm(JokeType::class);
			$form->handleRequest($request);

			if (!$form->isSubmitted() || !$form->isValid()) {
				return $this->respond($form, Response::HTTP_BAD_REQUEST);
			}

			$joke = $form->getData();
			$this->getDoctrine()->getManager()->persist($joke);
			$this->getDoctrine()->getManager()->flush();

			return $this->respond($joke);
		}

		public function deleteAction(Request $request): Response {
			$jokeId = $request->get('id');
			if (empty($jokeId)) {
				throw new NotFoundHttpException('Invalid ID');
			}

			$joke = $this->getDoctrine()->getRepository(Joke::class)->findOneBy([
				'id' => $jokeId
			]);

			if (empty($joke)) {
				throw new NotFoundHttpException('Resource not found');
			}

			$this->getDoctrine()->getManager()->remove($joke);
			$this->getDoctrine()->getManager()->flush();

			$data = [
				'status' => "Item by id $jokeId, removed"
			];

			return $this->respond($data);
		}
	}
