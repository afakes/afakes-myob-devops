<?php
/**
 * Created by PhpStorm.
 * User: afakes
 * Date: 18/3/18
 * Time: 12:36
 */

class testLINT extends \PHPUnit\Framework\TestCase
{

    public function testCodeSyntax()
    {
        $cmd = 'php -l api/*.php && echo "LINT:OK" || echo "LINT:FAILED" | tail -n1';
        $result = exec($cmd);

        $actual = (strpos($result, 'LINT:OK') !== false);
        $this->assertTrue($actual, "API code files did not passed LINT");
    }


}
