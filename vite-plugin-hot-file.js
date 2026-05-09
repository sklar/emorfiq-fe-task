import { writeFileSync, rmSync } from 'node:fs';
import { resolve } from 'node:path';

// Where the app is actually served. Vite's :5173 only handles HMR/asset
// requests; the user opens this URL in their browser. Keep in sync with
// the host port mapping in docker-compose.yml.
const APP_URL = 'http://localhost:8080';

/**
 * Writes a `public/hot` marker file while the Vite dev server is running.
 *
 * The PHP `vite_assets()` helper (templates/vite.php) checks for this file:
 *   - present  → emit `<script src="$URL/@vite/client">` + entry tags pointing at the dev server
 *   - missing  → fall back to `dist/.vite/manifest.json` and emit hashed prod tags
 *
 * The file contains a single line: the resolved dev server origin
 * (e.g. `http://localhost:5173`). We compute it from the actual bound
 * address so it works whether Vite picks an alternative port (5174…) or
 * binds to a non-localhost host.
 *
 * Cleanup runs on SIGINT/SIGTERM/exit. SIGKILL leaves the file behind;
 * the next `pnpm dev` overwrites it, so the only failure mode is "dev tags
 * served while no dev server is up" between a kill -9 and the next start.
 *
 * Side effect: appends an `App: <APP_URL>` line to Vite's startup banner so
 * the user sees the real page URL (compose Apache), not just Vite's :5173.
 */
export function hotFile() {
    const HOT_FILE = resolve(import.meta.dirname, 'public/hot');

    const cleanup = () => rmSync(HOT_FILE, { force: true });

    return {
        name: 'hot-file',
        apply: 'serve', // dev-server only; never runs during `vite build`
        configureServer(server) {
            server.httpServer?.once('listening', () => {
                const addr = server.httpServer.address();
                // address() returns null for unix sockets, a string for IPC, or
                // { address, port, family } for TCP. We only handle the TCP case;
                // anything else means the dev workflow isn't supported.
                if (!addr || typeof addr === 'string') return;

                // Resolve to `localhost` for the URL we hand to PHP:
                //   - wildcard binds (`::`, `0.0.0.0`) aren't reachable from a browser
                //   - IPv6 addresses (`::1`, fe80::…) would need [bracket] wrapping in
                //     URLs and just break string concatenation otherwise
                // The browser in this workflow is always on the same host, so
                // `localhost` is always correct; we only keep the raw IPv4 address
                // for the rare LAN-share dev case.
                const host =
                    !addr.address || addr.address === '0.0.0.0' || addr.family === 'IPv6'
                        ? 'localhost'
                        : addr.address;

                writeFileSync(HOT_FILE, `http://${host}:${addr.port}`);
            });

            // Append an extra "App:" line to Vite's startup URL banner.
            // ANSI: \x1b[32m green, \x1b[1m bold, \x1b[0m reset. Avoids
            // pulling in picocolors/colorette for three escape codes.
            const _printUrls = server.printUrls;
            server.printUrls = () => {
                _printUrls();
                console.log(`  \x1b[32m➜\x1b[0m  \x1b[1mApp\x1b[0m:     ${APP_URL}/`);
            };

            process.once('SIGINT', () => {
                cleanup();
                process.exit();
            });
            process.once('SIGTERM', () => {
                cleanup();
                process.exit();
            });
            process.once('exit', cleanup);
        },
    };
}
