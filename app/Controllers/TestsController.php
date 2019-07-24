<?php

require __DIR__ . "/../Models/Test.php";

/**
 * TestsController
 */
class TestsController
{
    public function test1()
    {
        $tests = Test::get();

        view('tests/test1', ['tests' => $tests, 'edo' => 15]);
    }
}
