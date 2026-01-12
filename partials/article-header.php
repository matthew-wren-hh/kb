<?php
$pageTitle = $pageTitle ?? "";
$canonical = $canonical ?? "";
$pageId = $pageId ?? "";
$assetPrefix = $assetPrefix ?? "../";
?>
<!DOCTYPE html>
<!-- Shared article header -->
<html
    xmlns="http://www.w3.org/1999/xhtml"
    lang="en"
    style="--scroll-margin-top: 74px">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        <title><?php echo htmlspecialchars($pageTitle); ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <link
            href="<?php echo $assetPrefix; ?>assets/img/apple-touch-icon-57x57.png"
            name="favicon"
            rel="shortcut icon"
            type="image/png" />
        <link
            href="<?php echo $assetPrefix; ?>assets/css/all-min.css"
            rel="stylesheet" />
        <!-- Preload Font Awesome fonts -->
        <link
            as="font"
            crossorigin="anonymous"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/webfonts/fa-solid-900.woff2"
            rel="preload"
            type="font/woff2" />
        <link
            as="font"
            crossorigin="anonymous"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/webfonts/fa-brands-400.woff2"
            rel="preload"
            type="font/woff2" />

        <!-- Conditional comment for IE 7 -->
        <!--[if IE 7]>
            <link
                rel="stylesheet"
                href="/_files/lib/bootstrap/font-awesome-ie7.css" />
        <![endif]-->
        <script
            type="text/javascript"
            src="https://ssl.spectate.com/s.js"></script>
        <script
            type="text/javascript"
            src="<?php echo $assetPrefix; ?>assets/js/pd.js"></script>
        <script
            async=""
            src="<?php echo $assetPrefix; ?>assets/js/gtm.js"></script>
        <script
            src="<?php echo $assetPrefix; ?>assets/js/jquery.min.js"
            type="text/javascript"></script>

        <!-- Google Tag Manager -->

        <script>
            dataLayer = [];
        </script>
        <script>
            (function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    "gtm.start": new Date().getTime(),
                    event: "gtm.js",
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != "dataLayer" ? "&l=" + l : "";
                j.async = true;
                j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, "script", "dataLayer", "GTM-WQQX65");
        </script>

        <!-- End Google Tag Manager -->

        <script src="../assets/js/clipboard.min.js"></script>
        <script src="../assets/js/prettify.js" type="text/javascript"></script>
        <script src="../assets/js/lang-css.js" type="text/javascript"></script>
        <script src="../assets/js/lang-sql.js" type="text/javascript"></script>
        <script src="../assets/js/lang-yaml.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                prettyPrint();
            });
        </script>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <?php if ($canonical): ?>
        <link href="<?php echo htmlspecialchars($canonical); ?>" rel="canonical" />
        <?php endif; ?>
        <?php if ($pageId): ?>
        <meta content="<?php echo htmlspecialchars($pageId); ?>" name="id" />
        <?php endif; ?>
    </head>
    <body>
        <a class="sr-only sr-only-focusable" href="#main-content"
            >Skip to main content</a
        >
        <a class="sr-only sr-only-focusable" href="#sidebar"
            >Skip to sidebar / page navigation</a
        >
        <!-- Google Tag Manager (noscript) --><noscript
            ><iframe
                height="0"
                src="https://www.googletagmanager.com/ns.html?id=GTM-WQQX65"
                style="display: none; visibility: hidden"
                width="0"></iframe></noscript
        ><!-- End Google Tag Manager (noscript) -->

        <nav aria-labelledby="navbar-brand" class="topbar">
            <div class="container topbar-inner">
                <a
                    class="brand"
                    href="https://www.hannonhill.com/cascadecms/latest/index.html"
                    id="navbar-brand"
                    name="brand">
                    <img
                        alt="Cascade CMS Logo"
                        src="<?php echo $assetPrefix; ?>assets/img/kb-logo-new.png" />
                </a>
                <ul class="topbar-links">
                    <li>
                        <a
                            href="https://www.hannonhill.com/cascadecms/latest/releases/index.html"
                            >Release Notes</a
                        >
                    </li>
                    <li>
                        <a href="https://help.hannonhill.com/hc/en-us"
                            >Support</a
                        >
                    </li>
                </ul>
                <form class="search-bar" id="search-form-top" role="search">
                    <div class="search-box">
                        <input
                            aria-label="Search"
                            autocomplete="off"
                            class="search-input"
                            id="searchBox"
                            name="q"
                            placeholder="Search..."
                            type="search" />
                        <a
                            class="search-btn"
                            href="#"
                            id="voice-parent"
                            type="button">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>
                </form>
            </div>
        </nav>
