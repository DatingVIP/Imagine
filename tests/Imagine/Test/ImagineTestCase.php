<?php

/*
 * This file is part of the Imagine package.
 *
 * (c) Bulat Shakirzyanov <mallluhuct@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Imagine\Test;

use Imagine\Test\Constraint\IsBoxInRange;
use Imagine\Test\Constraint\IsColorSimilar;
use Imagine\Test\Constraint\IsImageEqual;

class ImagineTestCase extends \PHPUnit\Framework\TestCase
{
    const HTTP_IMAGE = 'http://imagine.readthedocs.org/en/latest/_static/logo.jpg';

    /**
     * Asserts that two images are equal using color histogram comparison method.
     *
     * @param \Imagine\Image\ImageInterface $expected
     * @param \Imagine\Image\ImageInterface $actual
     * @param string $message
     * @param float $delta
     * @param int $buckets
     */
    public static function assertImageEquals($expected, $actual, $message = '', $delta = 0.1, $buckets = 4)
    {
        $constraint = new IsImageEqual($expected, $delta, $buckets);

        self::assertThat($actual, $constraint, $message);
    }

    public static function assertBoxInRange($minWidth, $maxWidth, $minHeight, $maxHeight, $actual, $message = '')
    {
        $constraint = new IsBoxInRange($minWidth, $maxWidth, $minHeight, $maxHeight);

        self::assertThat($actual, $constraint, $message);
    }

    public static function assertColorSimilar($expected, $actual, $message = '', $maxDistance = 0.0, $includeAlpha = true)
    {
        $constraint = new IsColorSimilar($expected, $maxDistance, $includeAlpha);

        self::assertThat($actual, $constraint, $message);
    }

    /**
     * @param string $class
     * @param string|null $message
     */
    protected function isGoingToThrowException($class, $message = null)
    {
        if (method_exists($this, 'expectException')) {
            $this->expectException($class);
            if ($message !== null) {
                $this->expectExceptionMessage($message);
            }
        } else {
            parent::setExpectedException($class, $message);
        }
    }
}
