<?php

declare(strict_types=1);

/**
 * This file is part of vfsStream.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace org\bovigo\vfs\visitor;

use InvalidArgumentException;
use org\bovigo\vfs\vfsStreamBlock;
use org\bovigo\vfs\vfsStreamContent;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;

/**
 * Abstract base class providing an implementation for the visit() method.
 *
 * @see    https://github.com/mikey179/vfsStream/issues/10
 *
 * @since  0.10.0
 */
abstract class vfsStreamAbstractVisitor implements vfsStreamVisitor
{
    /**
     * visit a content and process it
     *
     * @throws InvalidArgumentException
     */
    public function visit(vfsStreamContent $content): vfsStreamVisitor
    {
        if ($content instanceof vfsStreamBlock) {
            $this->visitBlockDevice($content);
        } elseif ($content instanceof vfsStreamFile) {
            $this->visitFile($content);
        } elseif ($content instanceof vfsStreamDirectory) {
            if (! $content->isDot()) {
                $this->visitDirectory($content);
            }
        } else {
            throw new InvalidArgumentException(
                'Unknown content type ' . $content->getType() . ' for ' . $content->getName()
            );
        }

        return $this;
    }

    /**
     * visit a block device and process it
     */
    public function visitBlockDevice(vfsStreamBlock $block): vfsStreamVisitor
    {
        return $this->visitFile($block);
    }
}
