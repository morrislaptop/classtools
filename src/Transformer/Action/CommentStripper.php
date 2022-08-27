<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

declare(strict_types=1);

namespace Uzbek\ClassTools\Transformer\Action;

use PhpParser\NodeVisitorAbstract;
use PhpParser\Node;

/**
 * Strip comments
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
final class CommentStripper extends NodeVisitorAbstract
{
    public function leaveNode(Node $node): void
    {
        $node->setAttribute('comments', []);
    }
}
