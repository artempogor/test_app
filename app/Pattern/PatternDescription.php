<?php

namespace App\Pattern;

use Illuminate\Support\Facades\Cache;

class PatternDescription implements PatternDescriptionInterface
{
    protected string $name;
    protected string $route;
    protected string $description;
    protected string $advantages;
    protected string $disadvantages;

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
        ];

        Cache::put('patterns', $patterns);
    }
}