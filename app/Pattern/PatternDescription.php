<?php

namespace App\Pattern;

use App\Pattern\Enums\PatternSectionsEnum;
use Illuminate\Support\Facades\Cache;

class PatternDescription implements PatternDescriptionInterface
{
    protected string $name;
    protected string $route;
    protected string $description;
    protected string $advantages;
    protected string $disadvantages;
    protected PatternSectionsEnum $section;


    public function __construct()
    {
        $this->putInCache();
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAdvantages(): string
    {
        return $this->advantages;
    }

    public function getDisadvantages(): string
    {
        return $this->disadvantages;
    }

    public function getSection(): Enums\PatternSectionsEnum
    {
        return $this->section;
    }

    private function putInCache(): void
    {
        $patterns = Cache::get('patterns') ?? [];

        if (!empty($patterns)) {
            foreach ($patterns as $pattern) {
                if ($pattern['route'] === $this->getRoute()) {
                    return;
                }
            }
        }

        $patterns[] = [
            'route' => $this->getRoute(),
            'name' => $this->getName(),
            'section' => $this->getSection(),
        ];

        Cache::put('patterns', $patterns);
    }
}