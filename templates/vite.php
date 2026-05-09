<?php

declare(strict_types=1);

/**
 * Emit script/link tags for a Vite entry.
 * Dev: reads public/hot for the dev server URL (written by the hot-file plugin).
 * Prod: reads dist/.vite/manifest.json and emits hashed asset tags.
 */
function vite_assets(string $entry): void
{
    $root = __DIR__ . '/..';
    $hot = $root . '/public/hot';

    if (is_file($hot)) {
        $url = rtrim((string) file_get_contents($hot));
        echo '<script type="module" src="' . htmlspecialchars($url . '/@vite/client', ENT_QUOTES) . '"></script>' . "\n";
        echo '<script type="module" src="' . htmlspecialchars($url . '/' . $entry, ENT_QUOTES) . '"></script>' . "\n";
        return;
    }

    $manifestPath = $root . '/dist/.vite/manifest.json';
    if (!is_file($manifestPath)) {
        throw new RuntimeException("Vite manifest not found at {$manifestPath}. Run `pnpm build` first.");
    }
    $manifest = json_decode((string) file_get_contents($manifestPath), true, flags: JSON_THROW_ON_ERROR);

    if (!isset($manifest[$entry])) {
        throw new RuntimeException("Entry `{$entry}` not in Vite manifest.");
    }
    $chunk = $manifest[$entry];

    foreach ($chunk['css'] ?? [] as $css) {
        echo '<link rel="stylesheet" href="/dist/' . htmlspecialchars($css, ENT_QUOTES) . '">' . "\n";
    }
    if (!empty($chunk['file']) && str_ends_with($chunk['file'], '.js')) {
        echo '<script type="module" src="/dist/' . htmlspecialchars($chunk['file'], ENT_QUOTES) . '"></script>' . "\n";
    } elseif (!empty($chunk['file']) && str_ends_with($chunk['file'], '.css')) {
        echo '<link rel="stylesheet" href="/dist/' . htmlspecialchars($chunk['file'], ENT_QUOTES) . '">' . "\n";
    }
}
