<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Movie;
class MovieRatingControllerTest extends WebTestCase
{

  /**
   * @var \Doctrine\ORM\EntityManager
   */
  private $entityManager;

  private $client;

  protected function setUp(): void
  {
      $this->client = static::createClient();
      $kernel = self::bootKernel();

      $this->entityManager = $kernel->getContainer()
          ->get('doctrine')
          ->getManager();
  }

  /**
   * @dataProvider provideUrls
   */
  public function testUrls($url)
  {
    $this->client->request('GET', $url);
    $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
  }

  public function provideUrls()
  {
    return [
      ["/"],
      ['/login'],
    ];
  }

  // Test the right number of cards according to the number of movies
  public function testIndex() {
    $movies = $this->entityManager
            ->getRepository(Movie::class)
            ->findAll();
    $crawler = $this->client->request('GET', "/");
    $this->assertEquals(count($movies), $crawler->filter('article.card')->count());
    foreach ($movies as $key => $movie) {
      $title = $movie->getTitle();
      $this->assertEquals(1, $crawler->filter("h5.card-title:contains(\"$title\")")->count());
    }
  }

  // Test que tous les articles sont correctement affichés
  public function testShow() {
    $movies = $this->entityManager
            ->getRepository(Movie::class)
            ->findAll();

    foreach ($movies as $movie) {
      $id = $movie->getId();
      $crawler = $this->client->request('GET', "/single/$id");
      $this->assertSelectorTextContains('html h2', $movie->getTitle());
      $this->assertSelectorTextContains('html p#sumary', $movie->getSumary());
      $this->assertSelectorTextContains('html span#type', $movie->getType());
      $this->assertSelectorTextContains('html span#releaseYear', $movie->getReleaseYear()->format('d/m/Y'));
      $this->assertSelectorTextContains('html span#author', $movie->getAuthor());
      if($movie->getAverage()) {
        $this->assertSelectorTextContains('html span#average', $movie->getAverage());
      }
      else {
        $this->assertSelectorTextContains('html span#average', "Pas encore d'évaluation<");
      }
    }

  }

  protected function tearDown(): void
  {
    parent::tearDown();

    // doing this is recommended to avoid memory leaks
    $this->entityManager->close();
    $this->entityManager = null;
  }

}
