<?php

declare(strict_types=1);

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('vendor');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PER-CS2x0' => true,
        '@PHP8x3Migration' => true,
        'declare_strict_types' => true,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,
        'void_return' => true,
        'strict_comparison' => true,
        'strict_param' => true,
        'modernize_types_casting' => true,
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true);
