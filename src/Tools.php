<?php

namespace RyanChandler\FilamentTools;

use Closure;
use Filament\Pages\Page;
use RyanChandler\FilamentTools\Exceptions\ToolsException;

class Tools extends Page
{
    protected static string $view = 'filament-tools::tools';

    /** @var array<\RyanChandler\FilamentTools\Tool> */
    protected static array $tools = [];

    /** @return array<\RyanChandler\FilamentTools\Tool> */
    public function getToolsProperty(): array
    {
        return static::$tools;
    }

    /** @param \Closure(\Filament\Pages\Page): \Filament\Pages\Page $configure */
    public static function register(Closure $configure): void
    {
        /** @var \RyanChandler\FilamentTools\Tool $tool */
        $tool = app()->call($configure, [
            'tool' => new Tool(),
        ]);

        if (! $tool instanceof Tool) {
            throw ToolsException::expectedTool(actual: $tool);
        }

        $tool->assert();

        static::$tools[] = $tool;
    }

    public static function navigationGroup(string $group): void
    {
        static::$navigationGroup = $group;
    }

    public static function navigationIcon(string $icon): void
    {
        static::$navigationIcon = $icon;
    }
}