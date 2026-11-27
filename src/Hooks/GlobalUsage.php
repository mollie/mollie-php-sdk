<?php

declare(strict_types=1);

namespace Mollie\Api\Hooks;

/**
 * Loads the mapping of global SDK fields (e.g. profileId, testmode) to the
 * operation IDs whose request body accepts them, used by MollieHooks to
 * decide which fields to auto-inject into a request body.
 */
class GlobalUsage
{
    /**
     * @return array<string, array<int, string>>
     */
    public static function load(): array
    {
        $path = __DIR__.'/global_usage.json';
        $contents = file_get_contents($path);

        if ($contents === false) {
            return [];
        }

        $decoded = json_decode($contents, true);

        return is_array($decoded) ? $decoded : [];
    }
}
