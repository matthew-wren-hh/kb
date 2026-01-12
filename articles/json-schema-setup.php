<?php
$pageTitle =
    "How to set up JSON Schema - Cascade CMS Knowledge Base";
$canonical =
    "https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/script-formats/json-schema-setup.html";
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
                            How to set up JSON Schema
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
                                    <li>
                                        <a
                                            aria-label="Section Topic"
                                            href="#main-content">
                                            How to set up JSON Schema
                                        </a>
                                        <ul>
                                            <li>
                                                <a
                                                    aria-label="Skip to Overview"
                                                    href="#JsonSchemaOverview"
                                                    >Overview</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    aria-label="Skip to Choosing placement"
                                                    href="#SchemaPlacement"
                                                    >Choosing placement</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    aria-label="Skip to Create a macro"
                                                    href="#SchemaMacro"
                                                    >Create a macro</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    aria-label="Skip to Provide page data"
                                                    href="#SchemaData"
                                                    >Provide page data</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    aria-label="Skip to Render JSON-LD"
                                                    href="#SchemaRender"
                                                    >Render JSON-LD</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    aria-label="Skip to Validation tips"
                                                    href="#SchemaValidation"
                                                    >Validation tips</a
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
                                        <a href="date-tool-essentials.php"
                                            >Date tool essentials</a
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
                                    <h1>How to set up JSON Schema</h1>
                                </header>
                                <a name="How+to+set+up+JSON+Schema"></a>

                                <section
                                    aria-label="Overview"
                                    class="anchor-heading"
                                    id="JsonSchemaOverview">
                                    <h2>
                                        Overview
                                        <a
                                            aria-label="Skip to Overview"
                                            href="#JsonSchemaOverview"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <p>
                                        A small, reusable Velocity macro in your
                                        head format is a reliable way to add
                                        JSON-LD structured data to every page.
                                        Start with a simple WebPage schema and
                                        grow it as you add fields like images or
                                        authors.
                                    </p>
                                    <ul>
                                        <li>
                                            Keep the script inside a head
                                            format or another format that prints
                                            in the <code>&lt;head&gt;</code>.
                                        </li>
                                        <li>
                                            Use built-in variables for titles,
                                            links, and descriptions to avoid
                                            duplication.
                                        </li>
                                        <li>
                                            Escape values so JSON stays valid
                                            even when content includes quotes.
                                        </li>
                                    </ul>
                                </section>

                                <section
                                    aria-label="Choosing placement"
                                    class="anchor-heading"
                                    id="SchemaPlacement">
                                    <h2>
                                        Choosing placement
                                        <a
                                            aria-label="Skip to Choosing placement"
                                            href="#SchemaPlacement"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <p>
                                        Add the macro to a Head format (or
                                        another format that outputs within
                                        <code>&lt;head&gt;</code>) so every
                                        configuration set or template that uses
                                        that format inherits the JSON-LD. This
                                        keeps structured data consistent without
                                        touching every page.
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-markup"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-markup">&lt;head&gt;
    #renderJsonSchema()
&lt;/head&gt;</code></pre>
                                    <p>
                                        If your template already parses a shared
                                        Head format, add the macro definition
                                        there and call it where you output other
                                        metadata.
                                    </p>
                                </section>

                                <section
                                    aria-label="Create a macro"
                                    class="anchor-heading"
                                    id="SchemaMacro">
                                    <h2>
                                        Create a macro
                                        <a
                                            aria-label="Skip to Create a macro"
                                            href="#SchemaMacro"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <p>
                                        The macro below outputs a minimal
                                        WebPage schema. It accepts a few values
                                        so you can reuse it across content
                                        types. Add optional arguments (author,
                                        publish date, image) as you refine your
                                        schema.
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity"><span class="token directive"><span class="token keyword">#macro</span> <span class="token function">renderJsonSchema</span><span class="token punctuation">(</span><span class="token variable">$title</span> <span class="token variable">$url</span> <span class="token variable">$description</span> <span class="token variable">$image</span><span class="token punctuation">)</span></span>
<span class="token tag">&lt;<span class="token tag">script</span> <span class="token attr-name">type</span><span class="token attr-value">="application/ld+json"</span>&gt;</span>
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "$!title",
  "url": "$!url"<span class="token comment">#if</span><span class="token punctuation">(</span><span class="token variable">$description</span> <span class="token operator">!=</span> <span class="token string">""</span><span class="token punctuation">)</span><span class="token comment">,#end</span>
  <span class="token comment">#if</span><span class="token punctuation">(</span><span class="token variable">$description</span> <span class="token operator">!=</span> <span class="token string">""</span><span class="token punctuation">)</span>
  "description": "$!description"<span class="token comment">#if</span><span class="token punctuation">(</span><span class="token variable">$image</span> <span class="token operator">!=</span> <span class="token string">""</span><span class="token punctuation">)</span><span class="token comment">,#end</span>
  <span class="token comment">#end</span>
  <span class="token comment">#if</span><span class="token punctuation">(</span><span class="token variable">$image</span> <span class="token operator">!=</span> <span class="token string">""</span><span class="token punctuation">)</span>
  "image": "$!image"
  <span class="token comment">#end</span>
}
<span class="token tag">&lt;/<span class="token tag">script</span>&gt;</span>
<span class="token directive"><span class="token keyword">#end</span></span></code></pre>
                                    <p>
                                        The macro keeps commas under control
                                        when optional fields are empty. You can
                                        add new keys inside the JSON with the
                                        same conditional pattern.
                                    </p>
                                </section>

                                <section
                                    aria-label="Provide page data"
                                    class="anchor-heading"
                                    id="SchemaData">
                                    <h2>
                                        Provide page data
                                        <a
                                            aria-label="Skip to Provide page data"
                                            href="#SchemaData"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <p>
                                        Pull the core values from built-in
                                        variables so the schema always matches
                                        what a visitor sees. Escape text values
                                        before they enter JSON to handle quotes
                                        and special characters safely.
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity"><span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$schemaTitle</span> <span class="token operator">=</span> <span class="token variable">$_EscapeTool</span><span class="token punctuation">.</span>json<span class="token punctuation">(</span><span class="token variable">$currentPage</span><span class="token punctuation">.</span>label<span class="token punctuation">)</span><span class="token punctuation">)</span></span>
<span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$schemaUrl</span> <span class="token operator">=</span> <span class="token variable">$currentPage</span><span class="token punctuation">.</span>link<span class="token punctuation">)</span></span>
<span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$schemaDescription</span> <span class="token operator">=</span> <span class="token variable">$_EscapeTool</span><span class="token punctuation">.</span>json<span class="token punctuation">(</span><span class="token variable">$currentPage</span><span class="token punctuation">.</span>metadata<span class="token punctuation">.</span>description<span class="token punctuation">)</span><span class="token punctuation">)</span></span>
<span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$schemaImage</span> <span class="token operator">=</span> <span class="token string">""</span><span class="token punctuation">)</span></span> <span class="token comment">## Optional: path to a hero image or social card</span>

<span class="token directive"><span class="token keyword">#if</span> <span class="token punctuation">(</span><span class="token variable">$schemaDescription</span> <span class="token operator">==</span> <span class="token string">""</span> <span class="token operator">||</span> <span class="token variable">$schemaDescription</span> <span class="token operator">==</span> <span class="token boolean">false</span><span class="token punctuation">)</span></span>
    <span class="token comment">## Fallback to a concise summary if description is empty</span>
    <span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$schemaDescription</span> <span class="token operator">=</span> <span class="token variable">$_EscapeTool</span><span class="token punctuation">.</span>json<span class="token punctuation">(</span><span class="token variable">$currentPage</span><span class="token punctuation">.</span>summary<span class="token punctuation">)</span><span class="token punctuation">)</span></span>
<span class="token directive"><span class="token keyword">#end</span></span></code></pre>
                                    <p>
                                        Keep the macro arguments small: title,
                                        URL, description, and one optional image
                                        cover the common WebPage schema.
                                        Additional fields can be added later
                                        without changing the call sites.
                                    </p>
                                    <p>
                                        If your EscapeTool version does not
                                        include <code>json()</code>, use
                                        <code>xml()</code> for HTML escaping and
                                        keep values free of unescaped quotes, or
                                        handle JSON escaping in a helper before
                                        passing values into the macro.
                                    </p>
                                </section>

                                <section
                                    aria-label="Render JSON-LD"
                                    class="anchor-heading"
                                    id="SchemaRender">
                                    <h2>
                                        Render JSON-LD
                                        <a
                                            aria-label="Skip to Render JSON-LD"
                                            href="#SchemaRender"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <p>
                                        Once the macro and page variables are in
                                        place, call the macro from your head
                                        format. This keeps schema generation in
                                        one location while letting every page
                                        supply its own values.
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity"><span class="token directive"><span class="token keyword">#renderJsonSchema</span><span class="token punctuation">(</span><span class="token variable">$schemaTitle</span> <span class="token variable">$schemaUrl</span> <span class="token variable">$schemaDescription</span> <span class="token variable">$schemaImage</span><span class="token punctuation">)</span></span></code></pre>
                                    <p>
                                        View the published HTML and confirm the
                                        JSON is in the head, properly escaped,
                                        and free of trailing commas. If you need
                                        different schema types for events or
                                        articles, add new optional fields to the
                                        macro and pass them only where needed.
                                    </p>
                                </section>

                                <section
                                    aria-label="Validation tips"
                                    class="anchor-heading"
                                    id="SchemaValidation">
                                    <h2>
                                        Validation tips
                                        <a
                                            aria-label="Skip to Validation tips"
                                            href="#SchemaValidation"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <ul>
                                        <li>
                                            Use a JSON linter or browser dev
                                            tools to confirm the script parses
                                            without errors.
                                        </li>
                                        <li>
                                            Test a published URL in Google's
                                            Rich Results Test or Schema Markup
                                            Validator to verify the output.
                                        </li>
                                        <li>
                                            Keep required fields populated with
                                            fallbacks so search engines always
                                            receive valid data.
                                        </li>
                                        <li>
                                            If your macro grows, consider moving
                                            it into a separate format and
                                            <code>#parse</code> it into your
                                            Head format for reuse.
                                        </li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
<?php require __DIR__ . "/../partials/article-footer.php"; ?>
<?php require __DIR__ . "/../partials/article-scripts.php"; ?>
