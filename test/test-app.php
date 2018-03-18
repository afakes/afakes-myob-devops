<?php
/**
 * Created by PhpStorm.
 * User: afakes
 * Date: 18/3/18
 * Time: 12:36
 */

include_once "api/app.php";

class app extends \PHPUnit\Framework\TestCase
{

    /**
     *
     */
    public function testVersion()
    {
        $testValue = getVersionNumber();
        $expectedValue = trim(file_get_contents("api/version.txt"));

        $this->assertEquals($testValue, $expectedValue, "Version number does not match");
    }

}
