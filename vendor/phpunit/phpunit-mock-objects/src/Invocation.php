<?php
/*
 * This file is part of the phpunit-mock-objects package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please views the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Interface for invocations.
 */
interface PHPUnit_Framework_MockObject_Invocation
{
    /**
     * @return mixed Mocked return value.
     */
    public function generateReturnValue();
}
