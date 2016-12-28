<?php declare(strict_types = 1);

namespace Algatux\Tests\QueryBuilder\unit;

use Algatux\QueryBuilder\Expression;

class ExpressionTest extends \PHPUnit_Framework_TestCase
{
    public function test_and_filters()
    {
        $exp = new Expression();
        $exp->and(["testField" => 10]);

        $this->assertEquals(
            [
                '$and' => [
                    [ "testField" => 10 ]
                ]
            ],
            $exp->getExpressionFilters()
        );
    }

    public function test_and_multiple_filters()
    {
        $exp = new Expression();
        $exp->and(["testField1" => 1]);
        $exp->and(["testField2" => 2]);
        $exp->and(["testField3" => 3]);

        $this->assertEquals(
            [
                '$and' => [
                    [ "testField1" => 1 ],
                    [ "testField2" => 2 ],
                    [ "testField3" => 3 ],
                ]
            ],
            $exp->getExpressionFilters()
        );
    }

    public function test_notEqual()
    {
        $exp = new Expression();
        $exp->notEqual('testF', 10);
        $exp->notEqual('testF', 11);

        $this->assertEquals(
            [
                'testF' => [
                    ['$ne' => 10],
                    ['$ne' => 11],
                ]
            ],
            $exp->getExpressionFilters()
        );
    }

}
