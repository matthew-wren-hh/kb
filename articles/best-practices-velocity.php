<?php
$pageTitle =
    "Best practices for performance - Cascade CMS Knowledge Base";
$canonical =
    "https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/script-formats/velocity-best-practices.html";
$pageId = "9290e3bac0a8002b3249e88a9b8fb375";
$assetPrefix = "../";
require __DIR__ . "/../partials/article-header.php";
?>
        <div class="container">
            <div class="content-wrapper">
                <nav class="breadcrumbs" aria-label="breadcrumb">
                    <ol>
                        <li>
                            <a
                                href="https://www.hannonhill.com/cascadecms/latest/index.html">
                                Home
                            </a>
                        </li>

                        <li>
                            <a
                                href="https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/index.html">
                                Developing in Cascade
                            </a>
                        </li>

                        <li>
                            <a
                                href="https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/script-formats/index.html">
                                Formats
                            </a>
                        </li>
                        <li aria-current="page">
                            Best practices for performance
                        </li>
                    </ol>
                </nav>
                <div class="layout">
                    <aside class="sidebar">
                        <details class="side-nav" open>
                            <summary>
                                Sections
                                <span aria-hidden="true">▾</span>
                            </summary>
                            <nav id="sidebar">
                                <ul>
                                    <li class="parent-folder">
                                        <a
                                            href="#main-content"
                                            aria-label="Section Topic">
                                            Best practices for performance
                                        </a>
                                        <ul>
                                            <li>
                                                <a
                                                    aria-label="Skip to Working with choosers"
                                                    href="#Workingwithchoosers"
                                                    >Working with choosers</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    aria-label="Skip to Using the Query API"
                                                    href="#UsingtheQueryAPI"
                                                    >Using the Query API</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    aria-label="Skip to Importing Formats"
                                                    href="#ImportingFormats"
                                                    >Importing Formats</a
                                                >
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <a
                                            href="https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/index.html">
                                            Developing in Cascade
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/script-formats/velocity-tools.html">
                                            Velocity Tools
                                        </a>
                                    </li>
                                    <li>
                                        <a
                                            href="https://github.com/hannonhill/Velocity-Cookbook"
                                            ><i class="fas fa-external-link-alt"
                                                >&nbsp;</i
                                            >
                                            Cascade CMS Velocity Examples</a
                                        >
                                    </li>
                                    <li>
                                        <a href="best-practices-velocity.php"
                                            >Best practices for performance</a
                                        >
                                    </li>
                                </ul>
                            </nav>
                        </details>
                    </aside>
                    <main id="main-content" role="main">
                        <div class="page-shell">
                            <div class="content width">
                                <div class="flex">
                                    <span class="badge badge-danger">Formats</span>
                                </div>
                                <header>
                                    <h1>Best practices for performance</h1>
                                </header>
                                <a name="Best+practices+for+performance"></a>

                                <section
                                    aria-label="Working with choosers"
                                    class="anchor-heading"
                                    id="Workingwithchoosers">
                                    <h2>
                                        Working with choosers
                                        <a
                                            aria-label="Skip to Working with choosers"
                                            href="#Workingwithchoosers"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <p>
                                        When working with choosers, it is
                                        important to save repeated
                                        <code>.asset</code> calls to a variable
                                        and then access that variable's methods
                                        directly. Failure to do so will result
                                        in multiple round trips to the database
                                        when only a single round trip is
                                        necessary.
                                    </p>
                                    <p>
                                        Consider the following Velocity code
                                        which accesses an image file that has
                                        been selected in a chooser:
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity"><span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$image</span> <span class="token operator">=</span> <span class="token variable">$currentPage</span><span class="token punctuation">.</span>getStructuredDataNode<span class="token punctuation">(</span><span class="token string">"image"</span><span class="token punctuation">)</span><span class="token punctuation">)</span></span>
<span class="token velocity-comment comment">## one database round trip</span>
<span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$imageLink</span> <span class="token operator">=</span> <span class="token variable">$image</span><span class="token punctuation">.</span>asset<span class="token punctuation">.</span>link<span class="token punctuation">)</span></span>
<span class="token velocity-comment comment">## another database round trip</span>
<span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$imageFileSize</span> <span class="token operator">=</span> <span class="token variable">$image</span><span class="token punctuation">.</span>asset<span class="token punctuation">.</span>fileSize<span class="token punctuation">)</span></span> 
<span class="token velocity-comment comment">## another database round trip</span>
<span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$imageWidth</span> <span class="token operator">=</span> <span class="token variable">$image</span><span class="token punctuation">.</span>asset<span class="token punctuation">.</span>dimensions<span class="token punctuation">.</span>width<span class="token punctuation">)</span></span>
<span class="token velocity-comment comment">## another database round trip</span>
<span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$imageHeight</span> <span class="token operator">=</span> <span class="token variable">$image</span><span class="token punctuation">.</span>asset<span class="token punctuation">.</span>dimensions<span class="token punctuation">.</span>height<span class="token punctuation">)</span></span> </code></pre>
                                    <p>
                                        As indicated by the comments, each line
                                        with <code>.asset</code> is having to
                                        fetch the image from the database
                                        (forcing a round trip from the app to
                                        the database and back).
                                    </p>
                                    <p>
                                        Rather than doing this, the code can be
                                        simplified by saving the chosen asset to
                                        a variable and then accessing methods of
                                        that variable:
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity"><span class="token velocity-comment comment">## one database round trip</span>
<span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$selectedImage</span> <span class="token operator">=</span> <span class="token variable">$currentPage</span><span class="token punctuation">.</span>getStructuredDataNode<span class="token punctuation">(</span><span class="token string">"image"</span><span class="token punctuation">)</span><span class="token punctuation">.</span>asset<span class="token punctuation">)</span></span> 
<span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$imageLink</span> <span class="token operator">=</span><span class="token variable">$selectedImage</span><span class="token punctuation">.</span>link<span class="token punctuation">)</span></span> 
<span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$imageFileSize</span> <span class="token operator">=</span> <span class="token variable">$selectedImage</span><span class="token punctuation">.</span>fileSize<span class="token punctuation">)</span></span>
<span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$imageWidth</span> <span class="token operator">=</span> <span class="token variable">$selectedImage</span><span class="token punctuation">.</span>dimensions<span class="token punctuation">.</span>width<span class="token punctuation">)</span></span>
<span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$imageHeight</span> <span class="token operator">=</span> <span class="token variable">$selectedImage</span><span class="token punctuation">.</span>dimensions<span class="token punctuation">.</span>height<span class="token punctuation">)</span></span></code></pre>
                                </section>

                                <section
                                    aria-label="Using the Query API"
                                    class="anchor-heading"
                                    id="UsingtheQueryAPI">
                                    <h2>
                                        Using the Query API
                                        <a
                                            aria-label="Skip to Using the Query API"
                                            href="#UsingtheQueryAPI"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <p>
                                        When working with the Query API, if
                                        you're accessing Structured Data or
                                        Dynamic Metadata fields for the queried
                                        assets, you should utilize the
                                        corresponding
                                        <code>$_.query().preloadStructuredData</code>
                                        and/or
                                        <code>$_.query().preloadDynamicMetadata</code>
                                        methods for a performance boost.
                                    </p>
                                    <h3>Preloading Structured Data</h3>
                                    <p>
                                        Consider the following code which loads
                                        500 "events":
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity"><span class="token directive"><span class="token keyword">#set</span></span> (<span class="token variable">$events</span> = <span class="token query global">$_.query</span>().byContentType("event").execute())
<span class="token directive"><span class="token keyword">#foreach</span> <span class="token punctuation">(</span><span class="token variable">$event</span> <span class="token keyword">in</span> <span class="token variable">$events</span><span class="token punctuation">)</span></span>
 <span class="token velocity-comment comment">## database round trip (x 500)</span>
 <span class="token directive"><span class="token keyword">#set</span><span class="token punctuation">(</span><span class="token variable">$start</span> <span class="token operator">=</span> <span class="token variable">$event</span><span class="token punctuation">.</span>getStructuredDataNode<span class="token punctuation">(</span><span class="token string">"startDateTime"</span><span class="token punctuation">)</span><span class="token punctuation">.</span>textValue<span class="token punctuation">)</span></span>
 <span class="token directive"><span class="token keyword">#set</span><span class="token punctuation">(</span><span class="token variable">$end</span> <span class="token operator">=</span> <span class="token variable">$event</span><span class="token punctuation">.</span>getStructuredDataNode<span class="token punctuation">(</span><span class="token string">"endDateTime"</span><span class="token punctuation">)</span><span class="token punctuation">.</span>textValue<span class="token punctuation">)</span></span>
 <span class="token directive"><span class="token keyword">#set</span><span class="token punctuation">(</span><span class="token variable">$details</span> <span class="token operator">=</span> <span class="token variable">$event</span><span class="token punctuation">.</span>getStructuredDataNode<span class="token punctuation">(</span><span class="token string">"details"</span><span class="token punctuation">)</span><span class="token punctuation">.</span>textValue<span class="token punctuation">)</span></span>
 <span class="token directive"><span class="token keyword">#set</span><span class="token punctuation">(</span><span class="token variable">$link</span> <span class="token operator">=</span> <span class="token variable">$event</span><span class="token punctuation">.</span>getStructuredDataNode<span class="token punctuation">(</span><span class="token string">"additional"</span><span class="token punctuation">)</span><span class="token punctuation">.</span>getChild<span class="token punctuation">(</span><span class="token string">"link"</span><span class="token punctuation">)</span><span class="token punctuation">.</span>textValue<span class="token punctuation">)</span></span>
<span class="token velocity-comment comment">## additional logic here</span>
<span class="token directive"><span class="token keyword">#end</span></span></code></pre>
                                    <p>
                                        In the <code>foreach</code> loop here,
                                        the application will be required to make
                                        a database round trip for each of the
                                        500 results in order to gather each
                                        asset's Structured Data.
                                    </p>
                                    <p>
                                        By adding the "preload" method to the
                                        query as seen below:
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity"><span class="token directive"><span class="token keyword">#set</span></span> (<span class="token variable">$events</span> = <span class="token query global">$_.query</span>().byContentType("event").preloadStructuredData().execute())</code></pre>
                                    <p>
                                        The initial query execution will take
                                        longer (since the application is
                                        gathering the related Structured Data
                                        for all 500 results upfront), but
                                        accessing this data in the
                                        <code>foreach</code> loop for each asset
                                        will be exponentially faster as the data
                                        is already in memory.
                                    </p>
                                    <h3>Preloading Dynamic Metadata</h3>
                                    <p>
                                        Similar to above, you can preload
                                        dynamic metadata as well. Consider the
                                        following code in a scenario where the
                                        query is returning 500 assets:
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity"><span class="token directive"><span class="token keyword">#set</span></span> (<span class="token variable">$events</span> = <span class="token query global">$_.query</span>().byContentType("event").execute())
<span class="token directive"><span class="token keyword">#foreach</span> <span class="token punctuation">(</span><span class="token variable">$event</span> <span class="token keyword">in</span> <span class="token variable">$events</span><span class="token punctuation">)</span></span>
 <span class="token velocity-comment comment">## database round trip (x 500)</span>
 <span class="token directive"><span class="token keyword">#set</span><span class="token punctuation">(</span><span class="token variable">$showInNavMenu</span> <span class="token operator">=</span> <span class="token variable">$event</span><span class="token punctuation">.</span>metadata<span class="token punctuation">.</span>getDynamicField<span class="token punctuation">(</span><span class="token string">"display-in-nav"</span><span class="token punctuation">)</span><span class="token punctuation">.</span>value<span class="token punctuation">)</span></span>
 <span class="token directive"><span class="token keyword">#set</span><span class="token punctuation">(</span><span class="token variable">$alternateTitle</span> <span class="token operator">=</span> <span class="token variable">$event</span><span class="token punctuation">.</span>metadata<span class="token punctuation">.</span>getDynamicField<span class="token punctuation">(</span><span class="token string">"alternate title"</span><span class="token punctuation">)</span><span class="token punctuation">.</span>value<span class="token punctuation">)</span></span>
<span class="token velocity-comment comment">## additional logic here </span>
<span class="token directive"><span class="token keyword">#end</span></span></code></pre>
                                    <p>
                                        In order to increase performance, we can
                                        change the query line as follows which
                                        will preload the necessary dynamic
                                        metadata fields:
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity"><span class="token directive"><span class="token keyword">#set</span></span> (<span class="token variable">$events</span> = <span class="token query global">$_.query</span>().byContentType("event").preloadDynamicMetadata().execute())</code></pre>
                                    <p>
                                        This will force the app to load all of
                                        the metadata fields upfront which
                                        prevents the repeated database round
                                        trips within the <code>foreach</code>
                                        loop.
                                    </p>
                                </section>

                                <section
                                    aria-label="Importing Formats"
                                    class="anchor-heading"
                                    id="ImportingFormats">
                                    <h2>
                                        Importing Formats
                                        <a
                                            aria-label="Skip to Importing Formats"
                                            href="#ImportingFormats"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <p>
                                        <code>#import</code> directives in
                                        Formats require a round trip from the
                                        app to the database and back again. This
                                        is necessary in order for the app to
                                        retrieve the contents of the Format
                                        being imported at runtime. Due to this
                                        fact, it is important to limit the
                                        number of <code>#import</code>
                                        directives as much as possible in order
                                        to keep transformation times
                                        performant.
                                    </p>
                                    <p>
                                        Consider the following sample code
                                        snippet below which imports 3 Formats.
                                        Each of the imported Formats contains a
                                        single macro.
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-none"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-none">## one database round trip
#import ("_cms/formats/shared/macros/stripTags")
## another database round trip
#import ("_cms/formats/shared/macros/escapeAll")
## another database round trip
#import ("_cms/formats/shared/macros/makeAccessible")</code></pre>
                                    <p>
                                        While this type of setup is clean and
                                        makes things very straightforward to
                                        manage (a single Format contains a
                                        single macro with a corresponding name),
                                        it requires 3 round trips to the
                                        database during the transformation of
                                        any Page on which the main Format is
                                        attached.
                                    </p>
                                    <p>
                                        In order to prevent repeated
                                        <code>#import</code> calls like this,
                                        macros should instead be combined into
                                        fewer Formats so that fewer
                                        <code>#import</code> directives are
                                        needed.
                                    </p>
                                    <p>
                                        Continuing the example from above, the
                                        macros from the 3 separate Formats
                                        indicated above can be combined into a
                                        single Format (we'll name it
                                        <code>utility</code> for the purposes of
                                        this sample). Then, rather than importing
                                        3 separate Formats to get access to the 3
                                        individual macros, a single line will do
                                        the trick:
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-none"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-none">## one database round trip
#import ("_cms/formats/shared/macros/utility")</code></pre>
                                    <p>
                                        Now, rather than making multiple trips
                                        back and forth to the database (adding
                                        to overall render times), only one trip
                                        is required and the main Format
                                        automatically has access to all of the
                                        macros needed for the transformation.
                                    </p>
                                </section>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
<?php require __DIR__ . "/../partials/article-footer.php"; ?>
<?php require __DIR__ . "/../partials/article-scripts.php"; ?>
