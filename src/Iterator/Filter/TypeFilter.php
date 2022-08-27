<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

declare(strict_types=1);

namespace Uzbek\ClassTools\Iterator\Filter;

use Uzbek\ClassTools\Iterator\ClassIterator;
use Uzbek\ClassTools\Iterator\Filter;
use ReflectionException;

/**
 * Filter classes of a spefcified type
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
final class TypeFilter extends ClassIterator implements Filter
{
    use FilterTrait;

    public function __construct(private readonly string $typename)
    {
        parent::__construct();
    }

    public function getIterator(): \Traversable
    {
        foreach ($this->getBoundIterator() as $className => $reflectedClass) {
            try {
                if ($reflectedClass->implementsInterface($this->typename)) {
                    yield $className => $reflectedClass;
                }
            } catch (\ReflectionException) {
                try {
                    if (
                        $reflectedClass->isSubclassOf($this->typename)
                        || $reflectedClass->getName() == $this->typename
                    ) {
                        yield $className => $reflectedClass;
                    }
                } catch (\ReflectionException) {
                    // Nope
                }
            }
        }
    }
}
