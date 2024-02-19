<?php

namespace App\Pattern;

/**
 * @property string $description
 * @property string $name
 * @property string $advantages
 * @property string $disadvantages
 */
interface PatternDescriptionInterface
{
    public function getRoute(): string;

    public function getName(): string;

    public function getDescription(): string;

    public function getAdvantages(): string;

    public function getDisadvantages(): string;
}