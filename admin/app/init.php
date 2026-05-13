<?php
if (!defined("APP_ROOT")) {
    define("APP_ROOT", dirname(__DIR__));
    define("LAYOUT_PATH", APP_ROOT . "/layout");
    define("FILES_PATH", APP_ROOT . "/files");
    define("ASSETS_PATH", APP_ROOT . "/assets");

    // Resolve document root; CLI may leave it empty.
    $docRoot = isset($_SERVER["DOCUMENT_ROOT"])
        ? realpath($_SERVER["DOCUMENT_ROOT"])
        : "";
    if ($docRoot === "" && preg_match("#^(.*?/htdocs)(/|$)#", APP_ROOT, $m)) {
        $docRoot = $m[1];
    }
    $docRoot = $docRoot ? str_replace("\\", "/", $docRoot) : "";
    $appPath = str_replace("\\", "/", APP_ROOT);

    $relativePath = "";
    if ($docRoot !== "" && strpos($appPath, $docRoot) === 0) {
        $relativePath = substr($appPath, strlen($docRoot)) ?: "";
    }

    $htdocsRelative = "";
    if (preg_match("#/htdocs(.*)$#", $appPath, $m)) {
        $htdocsRelative = $m[1];
    }

    $candidates = array_values(
        array_filter([$relativePath, $htdocsRelative], function ($p) {
            return trim($p, "/") !== "";
        }),
    );
    usort($candidates, function ($a, $b) {
        return strlen($b) <=> strlen($a); // prefer longer (more specific) path
    });

    $baseCandidate = $candidates !== [] ? "/" . trim($candidates[0], "/") : "/";

    // If the computed base path doesn't actually contain the app (common in XAMPP sub-folder setups),
    // try a one-level "/sash/..." fallback so generated asset/file URLs resolve correctly.
    $needsFallback =
        $docRoot !== "" &&
        !is_dir(rtrim($docRoot, "/") . $baseCandidate . "/files") &&
        is_dir(rtrim($docRoot, "/") . "/sash" . $baseCandidate . "/files");
    if ($needsFallback) {
        $baseCandidate = "/sash" . $baseCandidate;
    }

    define("BASE_URL", $baseCandidate);

    if (!function_exists("app_url_join")) {
        function app_url_join(string $base, string $path): string
        {
            $path = trim($path, "/");
            if ($path === "") {
                return $base === "/" ? "/" : rtrim($base, "/");
            }
            if ($base === "/" || $base === "") {
                return "/" . $path;
            }
            return rtrim($base, "/") . "/" . $path;
        }
    }

    if (!function_exists("asset_url")) {
        function asset_url(string $path): string
        {
            return app_url_join(BASE_URL, "assets/" . ltrim($path, "/"));
        }
    }

    if (!function_exists("file_url")) {
        function file_url(string $path): string
        {
            return app_url_join(BASE_URL, "files/" . ltrim($path, "/"));
        }
    }

    // Simple site settings helpers (meta + branding) stored in assets/uploads/site-settings.json.
    if (!function_exists("site_settings_path")) {
        function site_settings_path(): string
        {
            return ASSETS_PATH . "/uploads/site-settings.json";
        }
    }

    if (!function_exists("load_site_settings")) {
        function load_site_settings(): array
        {
            $defaults = [
                "title" => "Sash Admin Panel",
                "description" =>
                    "Sash – Bootstrap 5 Admin & Dashboard Template",
                "keywords" =>
                    "admin,dashboard,bootstrap,sash,template,responsive",
                "logo" => "",
            ];

            $path = site_settings_path();
            if (is_file($path)) {
                $json = file_get_contents($path);
                $decoded = json_decode($json, true);
                if (is_array($decoded)) {
                    $defaults = array_merge(
                        $defaults,
                        array_intersect_key($decoded, $defaults),
                    );
                }
            }

            return $defaults;
        }
    }

    if (!function_exists("save_site_settings")) {
        function save_site_settings(array $settings): bool
        {
            $path = site_settings_path();
            $dir = dirname($path);
            if (!is_dir($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)) {
                return false;
            }

            $allowed = ["title", "description", "keywords", "logo"];
            $payload = array_intersect_key($settings, array_flip($allowed));

            $json = json_encode(
                $payload,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES,
            );
            return $json !== false && file_put_contents($path, $json) !== false;
        }
    }

    if (!function_exists("site_logo_url")) {
        function site_logo_url(?array $settings = null): string
        {
            $settings = $settings ?? load_site_settings();
            if (!empty($settings["logo"])) {
                return asset_url($settings["logo"]);
            }
            return asset_url("images/brand/aurra Residence.png");
        }
    }

    if (!function_exists("site_logo_href")) {
        /**
         * Returns the logo URL, optionally cache-busted when the file exists locally.
         */
        function site_logo_href(
            bool $cacheBuster = false,
            ?array $settings = null,
        ): string {
            $settings = $settings ?? load_site_settings();
            $logoRel = ltrim($settings["logo"] ?? "", "/");
            $relPath =
                $logoRel !== "" ? $logoRel : "images/brand/aurra Residence.png";
            $url = asset_url($relPath);

            if (!$cacheBuster) {
                return $url;
            }

            $fullPath = ASSETS_PATH . "/" . $relPath;
            if (is_file($fullPath)) {
                $mtime = filemtime($fullPath);
                if ($mtime !== false) {
                    $sep = strpos($url, "?") === false ? "?" : "&";
                    return $url . $sep . "v=" . $mtime;
                }
            }
            return $url;
        }
    }

    if (!function_exists("media_url")) {
        /**
         * Resolve an uploaded media path from assets/uploads (preferred) or files/uploads (legacy).
         */
        function media_url(string $path): string
        {
            $clean = ltrim($path, "/");
            if ($clean === "") {
                return asset_url("images/users/21.jpg");
            }

            $assetPath = ASSETS_PATH . "/" . $clean;
            if (is_file($assetPath)) {
                return asset_url($clean);
            }

            $filePath = FILES_PATH . "/" . $clean;
            if (is_file($filePath)) {
                return file_url($clean);
            }

            // Default to assets path so missing files don't break page layout.
            return asset_url($clean);
        }
    }
}
