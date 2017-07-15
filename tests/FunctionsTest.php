<?php
/*
 * This file is part of the Deploy.
 *
 * (c) Dmitry Averbakh <adm@ruhub.com>
 */

namespace Deploy\Tests;

use PHPUnit\Framework\TestCase;

/**
 * FunctionsTest
 *
 * Author: Dmitry Averbakh <adm@ruhub.com>
 */
class FunctionsTest extends TestCase
{
    /**
     * @test
     */
    public function getAppVersion()
    {
        $this->assertRegExp('/\d+\.\d+\.\d+/', getAppVersion(realpath(__DIR__ . '/../composer.json')));
        $this->assertEquals('unknown', getAppVersion('/not_a_correct_composer.json'));
    }
}
