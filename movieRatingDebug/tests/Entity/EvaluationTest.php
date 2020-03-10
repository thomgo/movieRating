<?php
namespace App\Tests\Entity;

use App\Entity\Evaluation;
use PHPUnit\Framework\TestCase;


class EvaluationTest extends TestCase
{

/**
 * @dataProvider provideGradesData
 */
public function testGrade($grade, $expectedResult)
{
  $evaluation = new Evaluation();
  $evaluation->setGrade($grade);
  $this->assertEquals($expectedResult, $evaluation->getGrade());
}

public function provideGradesData()
{
  return [
    [2, 2],
    [5.5, 5],
    [14, null],
    [-1, null],
  ];
}

}
