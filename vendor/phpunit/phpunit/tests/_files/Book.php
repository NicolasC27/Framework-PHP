<?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please views the LICENSE
 * file that was distributed with this source code.
 */

/**
 * A book.
 */
class Book
{
    // the order of properties is important for testing the cycle!
    public $author = null;
}
