<?php

namespace App\Pattern\Singleton;

class Logger
{
    private const FILE = 'log.txt';
    public const ALLOWED_TYPES = [
        'file',
        'error_log'
    ];

    public ?string $prefix = null;
    public ?string $dateFormat = null;
    public ?string $logType = null;

    public function setDateFormat(string $dateFormat): static
    {
        $this->dateFormat = $dateFormat;

        return $this;
    }

    public function getDateFormat(): ?string
    {
        if (!$this->dateFormat) {
            throw new \Exception('Date format is null!');
        }

        return $this->dateFormat;
    }

    public function setLogType(string $logType): static
    {
        if (!in_array($logType, self::ALLOWED_TYPES)) {
            throw new \Exception('Type format is undefined!');
        }

        $this->logType = $logType;

        return $this;
    }

    public function getLogType(): string
    {
        if (!$this->logType) {
            throw new \Exception('Date format is null!');
        }

        return $this->logType;
    }

    public function setPrefix(string $prefix): static
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @throws \Exception
     */
    public function log(string $data): void
    {
        $prefix = $this->getPrefix() ?? ' ';
        $message = sprintf('%s: "%s" %s',
            date($this->getDateFormat()),
            $prefix,
            $data . PHP_EOL
        );
        match ($this->getLogType()) {
            'file' => file_put_contents(self::FILE, $message, FILE_APPEND),
            default => error_log($message)
        };
    }
}