<?php
	declare(strict_types=1);
	namespace App\Entity;

	use Doctrine\ORM\Mapping as ORM;

	/**
	 * Class Joke
	 * @ORM\Table(name="app_joke")
	 * @ORM\Entity()
	 *
	 * @package App\Entity
	 */
	class Joke {
		/**
		 * @var int $id | Joke ID
		 * @ORM\Column(name="id", type="integer")
		 * @ORM\Id()
		 * @ORM\GeneratedValue(strategy="AUTO")
		 */
		private $id;

		/**
		 * @var string $title | Title of joke
		 * @ORM\Column(name="title", type="string", length=40)
		 */
		private $title;

		/**
		 * @var string $body | Body of the joke
		 * @ORM\Column(name="body", type="string", length=1200)
		 */
		private $body;

		/**
		 * @return int
		 */
		public function getId(): int {
			return $this->id;
		}

		/**
		 * @return string
		 */
		public function getTitle(): string {
			return $this->title;
		}

		/**
		 * @param string $title
		 */
		public function setTitle(string $title): void {
			$this->title = $title;
		}

		/**
		 * @return string
		 */
		public function getBody(): string {
			return $this->body;
		}

		/**
		 * @param string $body
		 */
		public function setBody(string $body): void {
			$this->body = $body;
		}
	}
