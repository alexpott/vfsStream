<?php

declare(strict_types=1);

/**
 * This file is part of vfsStream.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace org\bovigo\vfs;

use PHPUnit\Framework\TestCase;
use const GLOB_MARK;
use function bovigo\assert\assertEmpty;
use function glob;
use function mkdir;

/**
 * Test for org\bovigo\vfs\vfsStream.
 *
 * @since       0.9.0
 * @group       issue_2
 */
class vfsStreamGlobTestCase extends TestCase
{
    /**
     * @test
     */
    public function globDoesNotWorkWithVfsStreamUrls(): void
    {
        $root = vfsStream::setup('example');
        mkdir(vfsStream::url('example/test/'), 0777, true);
        assertEmpty(glob(vfsStream::url('example'), GLOB_MARK));
    }
}
