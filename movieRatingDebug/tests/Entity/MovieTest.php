<?php
namespace App\Tests\Entity;

use App\Entity\Movie;
use App\Entity\Evaluation;
use PHPUnit\Framework\TestCase;


class MovieTest extends TestCase
{

/**
 * @dataProvider provideGradesData
 */
public function testGetAverage($grades, $expectedResult)
{
  $movie = new Movie();
  foreach ($grades as $grade) {
    $evaluation = new Evaluation();
    $evaluation->setGrade($grade);
    $movie->addEvaluation($evaluation);
  }
    $this->assertEquals($expectedResult, $movie->getAverage());
}

public function provideGradesData()
{
  return [
    [[0,0,0,0,0], 0],
    [[0], 0],
    [[5,2,4,0,0,10], 3.5],
    [[2,2,2,2,2], 2],
    [[1,9,4,4,7], 5],
    [[7,9,5,3,5,1,7], 5.29],
  ];
}

}
