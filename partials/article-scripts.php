<?php $assetPrefix = $assetPrefix ?? "../"; ?>
        <script
            src="<?php echo $assetPrefix; ?>assets/js/prism.js"
            type="text/javascript"></script>

        <script type="text/javascript">
            piAId = "1002";
            piCId = "1003";

            (function () {
                function async_load() {
                    var s = document.createElement("script");
                    s.type = "text/javascript";
                    s.src =
                        ("https:" == document.location.protocol
                            ? "https://pi"
                            : "http://cdn") +
                        ".pardot.com/pd.js";
                    var c = document.getElementsByTagName("script")[0];
                    c.parentNode.insertBefore(s, c);
                }
                if (window.attachEvent) {
                    window.attachEvent("onload", async_load);
                } else {
                    window.addEventListener("load", async_load, false);
                }
            })();
        </script>
        <script type="text/javascript">
            sAId = "1";
            sCId = "4";

            (function () {
                function async_load() {
                    var s = document.createElement("script");
                    s.type = "text/javascript";
                    s.src =
                        ("https:" == document.location.protocol
                            ? "https://ssl"
                            : "http://cdn") +
                        ".spectate.com/s.js";
                    var c = document.getElementsByTagName("script")[0];
                    c.parentNode.insertBefore(s, c);
                }
                if (window.attachEvent) {
                    window.attachEvent("onload", async_load);
                } else {
                    window.addEventListener("load", async_load, false);
                }
            })();
        </script>

        <script
            async="true"
            src="<?php echo $assetPrefix; ?>assets/js/12"></script>
    </body>
</html>
