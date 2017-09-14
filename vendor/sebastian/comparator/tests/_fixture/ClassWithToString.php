<?php
/*
 * This file is part of the Comparator package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please views the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\Comparator;

class ClassWithToString
{
    public function __toString()
    {
        return 'string representation';
    }
}
