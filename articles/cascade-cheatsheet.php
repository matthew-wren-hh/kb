<?php
$pageTitle =
    "Cascade CMS Cheatsheet - Complete Reference Guide";
$canonical =
    "https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/cascade-cheatsheet.html";
$pageId = "cascade-cheatsheet";
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
                        <li aria-current="page">Cascade CMS Cheatsheet</li>
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
                                            href="cascade-cheatsheet.php"
                                            >Cascade CMS Cheatsheet</a
                                        >
                                        <ul>
                                            <li><a href="#general">General</a></li>
                                            <li><a href="#system-tags">System Tags</a></li>
                                            <li><a href="#xpath">XPath</a></li>
                                            <li><a href="#velocity-tools">Velocity Tools</a>
                                                <ul>
                                                    <li><a href="#list-tool">List Tool</a></li>
                                                    <li><a href="#string-tool">String Tool</a></li>
                                                    <li><a href="#display-tool">Display Tool</a></li>
                                                    <li><a href="#sort-tool">Sort Tool</a></li>
                                                    <li><a href="#math-tool">Math Tool</a></li>
                                                    <li><a href="#locator-tool">Locator Tool</a></li>
                                                    <li><a href="#query-tool">Query Tool</a></li>
                                                    <li><a href="#date-tool">Date Tool</a></li>
                                                    <li><a href="#difference-tool">Difference Tool</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#rss-feeds">RSS Feeds</a></li>
                                            <li><a href="#regex">Regex</a></li>
                                            <li><a href="#javascript">Javascript</a></li>
                                            <li><a href="#web-services">Web Services</a></li>
                                            <li><a href="#examples">Examples</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <a
                                            href="https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/index.html"
                                            >Developing in Cascade</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            href="https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/script-formats/velocity-tools.html"
                                            >Velocity Tools</a
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
                                <h1>Cascade CMS Cheatsheet</h1>
                                <p class="lead">A comprehensive reference guide for Cascade CMS development, including Velocity, XPath, system tags, and web services.</p>
                            </header>

                            <section
                                aria-label="General"
                                class="anchor-heading"
                                id="general">
                                <h2>
                                    General
                                    <a
                                        aria-label="Skip to General"
                                        href="#general"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>

                                <h3>Site URL</h3>
                                <pre><code>$currentPage.site.url</code></pre>

                                <h3>Test for empty WYSIWYG field</h3>
                                <pre><code>#set ($wysiwyg = $content.getChild("wysiwyg"))
#if (!$_PropertyTool.isEmpty($wysiwyg.value) || $wysiwyg.getChildren().size() > 0)
    $_SerializerTool.serialize($wysiwyg, true))
#end</code></pre>
                                <p><a href="http://help.hannonhill.com/kb/formats/testing-for-empty-wysiwyg-field">Learn more</a></p>

                                <h3>Contains, Starts With & Ends With checks</h3>
                                <pre><code>$link.contains("base assets")
$currentPage.link.startsWith($node.link)
#if ($link.endsWith("/index"))</code></pre>

                                <h3>Lower or Uppercase something</h3>
                                <pre><code>$string.toLowerCase()
$string.toUpperCase()
## Capitalize first letter
${string.substring(0,1).toUpperCase()}${string.substring(1)}</code></pre>

                                <h3>Output Link</h3>
                                <pre><code>#macro (outputLink $page)
    #getAssetName($page)
    #set ($link = $page.link) ## or #set ($link = $page.getChild("link").value)
    &lt;li&gt;&lt;a href="$!link" alt="$!title" title="$!title"&gt;$!title&lt;/a&gt;&lt;/li&gt;
#end</code></pre>

                                <h3>Sitemap</h3>
                                <p><a href="https://github.com/hannonhill/Velocity-Cookbook/tree/master/Sitemap-SEO">View on GitHub</a></p>

                                <h3>System-asset</h3>
                                <pre><code>body {
   background: url('[system-asset]/site/marble.png[/system-asset]')
}</code></pre>
                                <p>Check "rewrite links in file" under system tab. <a href="http://www.hannonhill.com/kb/Linking/">Learn more about linking</a></p>
                                <pre><code>$_PropertyTool.outputProperties($currentPage)</code></pre>

                                <h3>Checkboxes</h3>
                                <pre><code>#set ($checkboxes = $currentPage.getStructuredDataNode("override").textValues)
#foreach ($check in $checkboxes)
    $check#if($foreach.hasNext), #end
#end</code></pre>

                                <h3>Split string</h3>
                                <pre><code>#set($courseTerms = [])
#foreach ($course in $allCourses)
    #set ($terms = "")
    #set ($terms = $course.getStructuredDataNode("courseInfo/terms").textValue)
    #if (!$_PropertyTool.isEmpty($terms))
        #foreach ($term in $terms.split(", "))
            #if (!$courseTerms.contains($term))
                #set ($void = $courseTerms.add($term))
            #end
        #end
    #end
#end

#set ( $lastSlashInCurrentPagePath = $_MathTool.toInteger($currentPage.path.lastIndexOf("/")) + 1 )
#set ( $folderOfCurrentPagePath = $currentPage.path.substring(0,$lastSlashInCurrentPagePath) )

#set ($string = "#test123")
#set ($slice = $string.substring(1))
#set ($slice = $string.substring(1,$string.length()))</code></pre>

                                <h3>#foreach</h3>
                                <ul>
                                    <li><code>$foreach.index</code></li>
                                    <li><code>$foreach.count</code></li>
                                    <li><code>$foreach.hasNext</code></li>
                                    <li><code>#break</code></li>
                                    <li><code>$foreach.parent.index</code></li>
                                    <li><code>$foreach.parent.parent.count</code>, etc</li>
                                    <li>Range Operator
                                        <pre><code>#foreach( $foo in [1..5] )
    $foo
#end</code></pre>
                                    </li>
                                </ul>

                                <h3>Hashmap</h3>
                                <pre><code>#set ( $typeList = { "Photo" : "photos", "News" : "news", "Card" : "boxes", "Mixed" : "" } )
#set ( $type = $typeList[$grid.getChild("type").value] )
#set ( $_void = $typeList.put("key","value"))
#foreach ($entry in $typeList.entrySet())
    Entire entry - $entry
    This entries key - $entry.key
    This entries value - $entry.value
#end

#set ($widths = {"1":"12", "2":"6", "3":"4", "4":"3"})
#set ($width = $widths["$positions.size()"])

## Check if a key exists in a map
#if ($programTypeMap.get($bType))
#set ($bType = $programTypeMap[$bType])
#end</code></pre>

                                <h3>Arrays</h3>
                                <pre><code>#set ($people = [])
#set ($temp = $people.add($page))
#set ($temp = $people.remove($page))

## Merge Arrays
#set ($query_items = [array of items])
#set ($temp = $query_items)
#set ($query_items = [another array of items])
#foreach ($item in $temp)
    #set ($void = $query_items.add($item))
#end
## $query_items now has both array of items</code></pre>

                                <h3>#evaluate</h3>
                                <pre><code>#set ($type = $row.getChild("type").textValue)
#evaluate("#$type()")

#set ( $addressList = "#arrToJSON($addressArr)" )

#foreach ($row in $rows)
    #set ($type = $row.getChild("type").value)
    #set ($macro = "#" + $type)
    #evaluate("$macro(\\$row)")
#end</code></pre>

                                <h3>Dropdown/Multiselect Labels</h3>
                                <pre><code>## All Schools sorted by Group/Type
#set ($activeSchools = $_.query().byMetadataSet("Site Setup").hasMetadata("active","yes").searchAcrossAllSites().execute())
#set ($groups = {
    "District": [],
    "Elementary School": [],
    "Middle School": [],
    "High School": [],
    "Non-Traditional School": [],
    "K-8 or Traditional School": []
    })
#foreach ($school in $activeSchools)
    #set ($group = $school.getStructuredDataNode("schoolGroup").selectedFieldItems[0].label)
    #set ($void = $groups[$group].add($school))
#end

#set($categories = "")
#foreach ($n in [1..10])
    #foreach ($filter in $page.getStructuredDataNode("filter/filter${n}").selectedFieldItems)
        #if (!$_PropertyTool.isEmpty($categories))
#set($categories = $categories + ",")
        #end
        #set($categories = $categories + $filter.label)
    #end
#end</code></pre>

                                <h3>Remove Whitespace</h3>
                                <pre><code>$string.trim()</code></pre>

                                <h3>Virtual Include</h3>
                                <pre><code>#set ($path = "path/to/include")

#set ($include = '&lt;!--#include virtual="' + "/courses-mod/${path}.html" + '"--&gt;')
$include

## OR

&lt;!--$_EscapeTool.xml('#include') virtual="/courses-mod/${path}.html"--&gt;</code></pre>

                                <h3>Namespaces</h3>
                                <p><a href="https://www.hannonhill.com/cascadecms/latest/faqs/development/working-with-namespaces-in-velocity.html">Working with Namespaces in Velocity</a></p>
                            </section>

                            <section
                                aria-label="System Tags"
                                class="anchor-heading"
                                id="system-tags">
                                <h2>
                                    System Tags
                                    <a
                                        aria-label="Skip to System Tags"
                                        href="#system-tags"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>

                                <h3>Code Sections (i.e. Protect Tags)</h3>
                                <p><a href="https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/code-sections.html">Code Sections Documentation</a></p>
                                <pre><code>&lt;![CDATA[#protect
stuff to remain
#protect]]&gt;

## always wrap empty &lt;i&gt; and &lt;em&gt; tags in protect
&lt;!--#protect...put any code here...#protect--&gt;</code></pre>

                                <h4>Output content with no Root element</h4>
                                <pre><code>&lt;![CDATA[#protect-top
    #set ($test = "hello world")
   $test
&lt;!--#cascade-skip--&gt;
#protect-top]]&gt;</code></pre>

                                <h3>System Pseudo-Tags</h3>
                                <p><a href="https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/system-pseudo-tags.html">System Pseudo-Tags Documentation</a></p>
                                <pre><code>[system-asset:configuration=JSON]/alerts/_alert-data?raw[/system-asset:configuration]
[system-view:internal]Only seen inside cascade[/system-view:internal]
[system-view:external]Only seen on publish[/system-view:external]</code></pre>

                                <h3>Metadata Tags</h3>
                                <p><a href="https://www.hannonhill.com/cascadecms/latest/content-authoring/pages/system-tags.html">System Tags Documentation</a></p>

                                <table class="table table-bordered table-hover">
                                    <caption>Page Metadata Tags</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">Tag</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Example Output</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>&lt;system-page-name/&gt;</code></td>
                                            <td>The system name of the page.</td>
                                            <td>system-tags</td>
                                        </tr>
                                        <tr>
                                            <td><code>&lt;system-page-creator/&gt;</code></td>
                                            <td>The creator of the page.</td>
                                            <td>Jane Doe</td>
                                        </tr>
                                        <tr>
                                            <td><code>&lt;system-page-title/&gt;</code></td>
                                            <td>The contents of the page's Title metadata field.</td>
                                            <td>System Tags</td>
                                        </tr>
                                        <tr>
                                            <td><code>&lt;system-page-summary/&gt;</code></td>
                                            <td>The contents of the page's Summary metadata field.</td>
                                            <td>Cascade CMS recognizes specific XML elements...</td>
                                        </tr>
                                        <tr>
                                            <td><code>&lt;system-page-author/&gt;</code></td>
                                            <td>The contents of the page's Author metadata field.</td>
                                            <td>Jane Doe</td>
                                        </tr>
                                        <tr>
                                            <td><code>&lt;system-page-teaser/&gt;</code></td>
                                            <td>The contents of the page's Teaser metadata field.</td>
                                            <td>Learn more about system tags...</td>
                                        </tr>
                                        <tr>
                                            <td><code>&lt;system-page-keywords/&gt;</code></td>
                                            <td>The contents of the page's Keywords metadata field.</td>
                                            <td>tags, metadata, xml</td>
                                        </tr>
                                        <tr>
                                            <td><code>&lt;system-page-description/&gt;</code></td>
                                            <td>The contents of the page's Description metadata field.</td>
                                            <td>A review of available system tags...</td>
                                        </tr>
                                        <tr>
                                            <td><code>&lt;system-page-display-name/&gt;</code></td>
                                            <td>The contents of the page's Display Name metadata field.</td>
                                            <td>System Tags</td>
                                        </tr>
                                        <tr>
                                            <td><code>&lt;system-page-start-date/&gt;</code></td>
                                            <td>The contents of the page's Start Date metadata field.</td>
                                            <td>May 1, 2021 12:00 AM</td>
                                        </tr>
                                        <tr>
                                            <td><code>&lt;system-page-end-date/&gt;</code></td>
                                            <td>The contents of the page's End Date metadata field.</td>
                                            <td>May 8, 2021 12:00 AM</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered table-hover">
                                    <caption>Meta Element Tags</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">Tag</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Example Output</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>&lt;system-page-meta-keywords/&gt;</code></td>
                                            <td>A meta element including the contents of the Keywords field.</td>
                                            <td><code>&lt;meta content="tags, metadata, xml" name="keywords" /&gt;</code></td>
                                        </tr>
                                        <tr>
                                            <td><code>&lt;system-page-meta-description/&gt;</code></td>
                                            <td>A meta element including the contents of the Description field.</td>
                                            <td><code>&lt;meta content="A review..." name="description" /&gt;</code></td>
                                        </tr>
                                        <tr>
                                            <td><code>&lt;system-page-meta-author/&gt;</code></td>
                                            <td>A meta element including the contents of the Author field.</td>
                                            <td><code>&lt;meta content="Charlie Holder" name="author" /&gt;</code></td>
                                        </tr>
                                        <tr>
                                            <td><code>&lt;system-page-meta-date/&gt;</code></td>
                                            <td>A meta element including the date and time the page was rendered.</td>
                                            <td><code>&lt;meta content="Fri, 07 May 2021..." name="date" /&gt;</code></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </section>

                            <section
                                aria-label="XPath"
                                class="anchor-heading"
                                id="xpath">
                                <h2>
                                    XPath
                                    <a
                                        aria-label="Skip to XPath"
                                        href="#xpath"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>

                                <h3>Cascade Examples</h3>
                                <pre><code>#set ($breadcrumbs = $_XPathTool.selectNodes($contentRoot, "//system-folder[name != '/'][not(@current and system-page[@current and not(@reference) and name = 'index'])] | //system-page[@current and not(parent::calling-page) and not(@reference)]"))

#set ($news = $_XPathTool.selectNodes($contentRoot, "//system-page[name!='index'][dynamic-metadata[name='router-include' and value='Yes']][not(contains(path, 'base assets'))]"))</code></pre>

                                <h3>Get Asset Name Macro</h3>
                                <pre><code>#macro (getAssetName $asset)
    #set ($title = "")
    #if(!$asset.metadata.displayName.empty)
        #set ($title = $_EscapeTool.xml($asset.metadata.displayName))
    #elseif(!$asset.metadata.title.empty)
        #set ($title = $_EscapeTool.xml($asset.metadata.title))
    #else
        #set ($title = $_EscapeTool.xml($asset.name))
    #end
#end

## OR

#macro (getAssetName $asset)
    #if ($asset.getChild("display-name"))
        $_EscapeTool.xml($asset.getChild("display-name").value)
    #elseif ($asset.getChild("title"))
        $_EscapeTool.xml($asset.getChild("title").value)
    #else
        $asset.getChild("name").value
    #end
#end</code></pre>

                                <h3>Migration XPath Examples</h3>
                                <pre><code>//div[@id="contentleft"]/*[position() > 2]
//div[@id="contentleft"]/*[not(self::h1)]
//div[@id="contentleft"]/h1/small/text()
//div[@id="contentleft"]/h1/text()</code></pre>
                            </section>

                            <section
                                aria-label="Velocity Tools"
                                class="anchor-heading"
                                id="velocity-tools">
                                <h2>
                                    Velocity Tools
                                    <a
                                        aria-label="Skip to Velocity Tools"
                                        href="#velocity-tools"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>

                                <section id="list-tool">
                                    <h3>List Tool</h3>
                                    <h4>Combine Lists</h4>
                                    <pre><code>$list.addAll($anotherList)

#set ($allCourses = [])
#set ($coursesFolder = $_.locateFolder("Programs-and-Courses-Finder/course", "Catalog"))
#foreach ($folder in $coursesFolder.children)
    #if ($folder.assetType == "folder")
        #set ($courses = $_.query().byDataDefinition("site://${globalSite}/Pages/Course Detail").bySiteName("Catalog").byFolderPath($folder.path).preloadDynamicMetadata().preloadStructuredData().maxResults(-1).sortBy("name").sortDirection("desc").execute())
        #set ($void = $allCourses.addAll($courses))
    #end
#end</code></pre>

                                    <h4>Reverse a List</h4>
                                    <pre><code>$_ListTool.reverse($array)</code></pre>
                                </section>

                                <section id="string-tool">
                                    <h3>String Tool</h3>
                                    <pre><code>#set ( $path = $_StringTool.substringAfter($descrString, "src=&quot;") )
#set ( $path = $_StringTool.substringBefore($path, "&quot;") )
#set ($string = $string.replaceAll("&rsquo;", "'"))
$location.replaceAll("\\n", "HELLO")</code></pre>
                                </section>

                                <section id="display-tool">
                                    <h3>Display Tool</h3>
                                    <h4>Strip Tags</h4>
                                    <pre><code>$_DisplayTool.stripTags($textWithHtml)
$_DisplayTool.stripTags($description, "a", "img") ## allowed tags</code></pre>

                                    <h4>Truncate</h4>
                                    <pre><code>$_DisplayTool.truncate($longText,33,"...",true)</code></pre>

                                    <h4>Break</h4>
                                    <p>New Lines to &lt;br&gt; (textarea)</p>
                                    <pre><code>$_DisplayTool.br("Here is a String with
                a line break.")
## Expected output: Here is a string with&lt;br/&gt;a line break.</code></pre>
                                    <p><a href="https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/script-formats/velocity-tools.html#DisplayTool">Display Tool Documentation</a></p>
                                </section>

                                <section id="sort-tool">
                                    <h3>Sort Tool</h3>
                                    <h4>Sort with XPath</h4>
                                    <pre><code>$_SortTool.addSortCriterion("start-date", "en", "number", "descending", "upper-first")
$_SortTool.sort($news)

#set ($years = $_XPathTool.selectNodes($indicium, "year:asc") )
#set ($yearsSorted = [])
#foreach ($year in $years)
#set ($temp = $yearsSorted.add($year.value))
#end
#set ($yearsSorted = $_SortTool.sort($yearsSorted.toArray()) )</code></pre>
                                    <p><a href="https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/script-formats/velocity-tools.html#_SortTool_sort">Sort Tool Documentation</a></p>

                                    <h4>Sort a List</h4>
                                    <pre><code>#set($sorted = $_SortTool.sort($assets, "metadata.dynamicField(myDynamicField).value"))
#set($sorted = $_SortTool.sort($pages, "structuredDataNode(myField).textValue"))</code></pre>

                                    <h4>From assets in a multiple chooser</h4>
                                    <pre><code>#set ($people       = $row.getChildren("profilePage"))
#set ($peopleSort   = [])
#foreach ($person in $people)
  #set ($_void = $peopleSort.add($person.asset))
#end
#if ($sortBy == "firstName")
  #set ($peopleSort = $_SortTool.sort($peopleSort, "metadata.dynamicField(firstName).value"))
#elseif ($sortBy == "lastName")
  #set ($peopleSort = $_SortTool.sort($peopleSort, "metadata.dynamicField(lastName).value"))
#end</code></pre>

                                    <h4>Sorting child nodes</h4>
                                    <p><strong>By string:</strong></p>
                                    <pre><code>## Structure:
## &lt;offerings&gt;
##   &lt;title&gt;A Title&lt;/title&gt;
## &lt;/offerings&gt;

$_SortTool.sort($offerings,"Child(title).textValue:desc")</code></pre>

                                    <p><strong>By Date:</strong></p>
                                    <pre><code>## Structure:
## &lt;offerings&gt;
##   &lt;startDate&gt;10-19-2020&lt;/startDate&gt;
## &lt;/offerings&gt;

#set ($sortable = [])
#foreach ($offer in $offerings)
#set ($date = $_DateTool.toDate("MM-dd-yyyy", $offer.getChild("startDate").textValue))
       #set ($dateTimestamp = $date.getTime())
       #set ($_void = $sortable.add({
                "timestamp": $dateTimestamp,
                "offer": $offer
            }))
#end
#set ($sorted = $_SortTool.sort($sortable, ["timestamp"]))</code></pre>

                                    <h4>Hashmap sorting</h4>
                                    <pre><code>#set ($hash = {"a" : "1", "c" : "4", "b" : "3"})
$hash
#set ($sorted = $_SortTool.sort($hash.keySet()))
$sorted
#foreach ($item in $sorted)
    $hash[$item]
#end</code></pre>

                                    <h4>Sort Multiselect</h4>
                                    <pre><code>#macro (sortArray $referenceArray $targetArray)
    #set ($sortedArray = [])
    #foreach ($item in $referenceArray)
        #foreach ($targetItem in $targetArray)
            #if ($item.label == $targetItem.label)
                #set ($_void = $sortedArray.add($targetItem))
            #end
        #end
    #end
#end
## Example Usage
#set ($types = $page.metadata.getDynamicField('type').selectedFieldItems)
#set ($typesOrder = $page.metadata.getDynamicField('type').possibleFieldItems)
#sortArray($typesOrder $types)
#foreach ($item in $sortedArray)
$item.label
#end</code></pre>
                                </section>

                                <section id="math-tool">
                                    <h3>Math Tool</h3>
                                    <pre><code>#set ( $realInt = $_MathTool.toInteger($numText) )  ## Returns null if not able to be converted
#set ( $realDouble = $_MathTool.toDouble($numText) )</code></pre>
                                    <p><a href="http://www.hannonhill.com/kb/Script-Formats/#math-tool">Math Tool Documentation</a></p>
                                </section>

                                <section id="locator-tool">
                                    <h3>Locator Tool</h3>
                                    <p><a href="http://www.hannonhill.com/kb/Script-Formats/#locator-tool">Locator Tool Documentation</a></p>
                                    <pre><code>#set ( $callingPage = $_.locate($currentPagePath, $_FieldTool.in("com.hannonhill.cascade.model.dom.identifier.EntityTypes").TYPE_PAGE, $currentPageSiteName))</code></pre>

                                    <h4>Available methods:</h4>
                                    <ul>
                                        <li><code>locatePage(path)</code></li>
                                        <li><code>locatePage(path, siteName)</code></li>
                                        <li><code>locateFile(path)</code></li>
                                        <li><code>locateFile(path, siteName)</code></li>
                                        <li><code>locateFolder(path)</code></li>
                                        <li><code>locateFolder(path, siteName)</code></li>
                                        <li><code>locateBlock(path)</code></li>
                                        <li><code>locateBlock(path, siteName)</code></li>
                                        <li><code>locateSymlink(path)</code></li>
                                        <li><code>locateSymlink(path, siteName)</code></li>
                                        <li><code>locateReference(path)</code></li>
                                        <li><code>locateReference(path, siteName)</code></li>
                                        <li><code>locate(path, type)</code></li>
                                        <li><code>locate(path, type, siteName)</code></li>
                                    </ul>

                                    <h4>Accessing fields when getting pages with locator tool</h4>
                                    <pre><code>    #set ($tags = $feature.metadata.getDynamicField("category").values)
    #foreach ($tag in $tags)
        #if ($tag != "")
            &lt;a href="/news/$categories[$tag]"&gt;&lt;p class="tag"&gt;$_EscapeTool.xml($!tag)&lt;/p&gt;&lt;/a&gt;
        #end
    #end

$person.getStructuredDataNode("syndication").getChild("summary").textValue</code></pre>

                                    <h4>Radio Option</h4>
                                    <pre><code>#set ( $includeFooter = $block.getStructuredDataNode("include-footer-grid"))
#foreach ($i in $includeFooter.textValues)
    #if ( $i == "Yes" )
        #set ( $outputFooterGrid = true )
    #end
#end

## OR

$includeFooter.textValues.contains("Yes")</code></pre>
                                </section>

                                <section id="query-tool">
                                    <h3>Query Tool</h3>
                                    <pre><code>#set($query = $_.query())
#set($query = $query.byMetadataSet("Standard"))
#set($query = $query.byContentType("site://common/Standard Page"))
#set($query = $query.includePages(true))
#set($query = $query.includeFiles(true))
#set($query = $query.includeBlocks(false))
#set($query = $query.includeFolders(true))
#set($query = $query.includeSymlinks(false))
#set($query = $query.hasMetadata("displayName", "Index"))
#set ($query = $query.hasMetadata("sitemap-include", "Yes") )</code></pre>

                                    <p><strong>Call $query to see all properties and their current value</strong></p>
                                    <ul>
                                        <li>metadataFieldName = null [displayName | title | summary | teaser | keywords | description | author | startDate | endDate | reviewDate]</li>
                                        <li>metadataFieldValue = null</li>
                                        <li>metadataSetLink = Default</li>
                                        <li>sortBy = [summary | startDate | keywords | reviewDate | endDate | modified | author | title | created | description | teaser | name | path | displayName]</li>
                                        <li>sortDirection = asc [desc|asc]</li>
                                        <li>maxResults = 100 [max 500]</li>
                                        <li>siteName = www.example.edu [Call searchAcrossAllSites() to null out]</li>
                                        <li>indexableOnly = true</li>
                                        <li>publishableOnly = false</li>
                                    </ul>

                                    <p><strong>Call execute() to get search results</strong></p>
                                    <pre><code>#set($results = $query.execute())
#foreach($page in $results)
$page.name
#end

## You can set all values in one line
#set($results = $_.query().byMetadataSet("Default").includePages(true).maxResults(10).sortBy("name").sortDirection("asc").execute())</code></pre>

                                    <h4>Structured data query</h4>
                                    <pre><code>## Structure:
## &lt;system-data-structure&gt;
##   &lt;tags&gt;
##     &lt;tags&gt;B&lt;/tags&gt;
##     &lt;tags&gt;C&lt;/tags&gt;
##   &lt;/tags&gt;
## &lt;/system-data-structure&gt;

#macro (toList $node)
    #set ($tags = [])
    #foreach ($item in $node)
        #set ($void = $tags.add($item.textValue))
    #end
#end
#toList($currentPage.getStructuredDataNodes("tags/tags"))

#set ($students = $_.query().byContentType("Student Success Profile").hasMetadata("type","student").hasAnyStructuredDataValues("tags/tags", $tags).execute())</code></pre>
                                </section>

                                <section id="date-tool">
                                    <h3>Date Tool</h3>
                                    <p>For comprehensive Date Tool documentation, see the <a href="date-tool-essentials.php">Date Tool Essentials</a> page.</p>

                                    <h4>Turn a string into a date format</h4>
                                    <pre><code>#set ( $date = "08-08-2013" )
#set ( $dateFormat = $_DateTool.getDateFormat("MM-dd-yyyy", $_DateTool.getLocale(), $_DateTool.getTimeZone()) )
#set ( $date = $dateFormat.parse($date) )

#set ( $dateFormat = $_DateTool.getDateFormat("EEE, d MMM y H:m:s z", $_DateTool.getLocale(), $_DateTool.getTimeZone()) )
#set ( $date = $dateFormat.parse($feed.getChild("pubDate").value) )
$_DateTool.format('EEEE, MMMM d, y', $date)

## OR
$_DateTool.toDate('EE, d MMMM yyyy HH:mm:ss z', $date.value )</code></pre>
                                    <p><a href="http://help.hannonhill.com/discussions/velocity-formats/5332-formatting-dates-using-datetool">Formatting Dates using DateTool</a></p>

                                    <h4>Turn a date format into a string</h4>
                                    <pre><code>#set ($date = $_DateTool.getDate($date.value))
#set ($dateFormat = $_DateTool.format('EEEE, MMMM d, Y h:mm a', $date))
## "Thursday, January 2, 2016 12:42 PM"</code></pre>
                                    <p><a href="http://www.hannonhill.com/kb/Script-Formats/#date-tool">Date Tool Documentation</a></p>

                                    <h4>Get Current Date</h4>
                                    <pre><code>#set ($originalDate = $_DateTool.getDate())</code></pre>

                                    <h4>Get Current Year</h4>
                                    <pre><code>$_DateTool.format("yyyy", $_DateTool.getDate())</code></pre>

                                    <h4>Use a different timezone</h4>
                                    <pre><code>#set($utc = $_DateTool.getTimeZone().getTimeZone("UTC"))
#set($dateFormat = $_DateTool.getDateFormat("MM-dd-yyyy", $_DateTool.getLocale(), $utc))</code></pre>

                                    <h4>Output a date with a different timezone</h4>
                                    <pre><code>#set ($startDate  = $performance.metadata.getDynamicField("performance-start-date").value)
#set ($startDate  = $_DateTool.getDate($startDate))
$_DateTool.format('EE, dd MMM yyyy HH:mm:ss z', $startDate, $_DateTool.getLocale(), $_DateTool.getTimeZone().getTimeZone("UTC"))</code></pre>

                                    <h4>Date Formats</h4>
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Component</th>
                                                <th>Single</th>
                                                <th>Double</th>
                                                <th>Triple/Full</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Day of Month</td>
                                                <td>d: 1</td>
                                                <td>dd: 01</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Day of Week</td>
                                                <td>E: Mon</td>
                                                <td></td>
                                                <td>EEEE: Monday</td>
                                            </tr>
                                            <tr>
                                                <td>Name of Month</td>
                                                <td>M: 01</td>
                                                <td></td>
                                                <td>MMM: Jan, MMMM: January</td>
                                            </tr>
                                            <tr>
                                                <td>Year</td>
                                                <td>y: 2016</td>
                                                <td>yy or YY: 16</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Hour (12H)</td>
                                                <td>h: 1</td>
                                                <td>hh: 01</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Hour (24H)</td>
                                                <td>H: 18</td>
                                                <td>HH: 09</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Minutes</td>
                                                <td>m: 1</td>
                                                <td>mm: 01</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Seconds</td>
                                                <td>s: 1</td>
                                                <td>ss: 01</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Milliseconds</td>
                                                <td>S: 999</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Time AM/PM</td>
                                                <td>a: AM</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Time Zone</td>
                                                <td>z: EST</td>
                                                <td></td>
                                                <td>zzzz: Eastern Standard Time</td>
                                            </tr>
                                            <tr>
                                                <td>Time Offset</td>
                                                <td>Z: -0500</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>
                                        <a href="https://docs.oracle.com/javase/7/docs/api/java/text/SimpleDateFormat.html">SimpleDateFormat Documentation</a><br>
                                        <a href="http://velocity.apache.org/tools/devel/javadoc/org/apache/velocity/tools/generic/ComparisonDateTool.html">ComparisonDateTool Documentation</a>
                                    </p>
                                </section>

                                <section id="difference-tool">
                                    <h3>Difference Tool</h3>
                                    <pre><code>#set ($today = $_DateTool.getDate())
#set ($end = $_DateTool.getDate($event.getStructuredDataNode("ends").textValue))
#if ($_DateTool.difference($today, $end).days >= 0)</code></pre>

                                    <h4>Days of Week</h4>
                                    <pre><code>#foreach ($date in $_.locateBlock("test", "Pittsburgh Playhouse").getStructuredDataNodes("dateTime"))
    #set ($start = $_DateTool.toCalendar($_DateTool.getDate($date.getChild("start").textValue)))
    #set ($end = $_DateTool.toCalendar($_DateTool.toDate("MM-dd-yyyy", $date.getChild("end").textValue)))
    ## #set ($end = $start)
    #set ($diff = $_DateTool.whenIs($start, $end).getDays() + 1)
    $_DateTool.format("MMMM d", $start) - $_DateTool.format("d, yyyy", $end)
    #foreach ($d in [0..$diff])
        $_DateTool.format("EEEE, MMMM d, yyyy 'at' hh:mm a", $start)
        $start.add(5, 1)
    #end
#end</code></pre>
                                </section>
                            </section>

                            <section
                                aria-label="RSS Feeds"
                                class="anchor-heading"
                                id="rss-feeds">
                                <h2>
                                    RSS Feeds
                                    <a
                                        aria-label="Skip to RSS Feeds"
                                        href="#rss-feeds"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>

                                <h3>Output RSS Feed</h3>
                                <ol>
                                    <li>Create content type block of the pages to output</li>
                                    <li>Create RSS output format</li>
                                    <li>Create RSS template with <code>&lt;system-region name="DEFAULT"/&gt;</code></li>
                                    <li>Add RSS format and content type block to default region of template</li>
                                    <li>Add RSS output to configuration set</li>
                                    <li>Template: rss, Extension: .rss, Serialization Type: XML</li>
                                </ol>

                                <h3>Input RSS Feed</h3>
                                <ol>
                                    <li>Create RSS Feed Block with link to RSS feed</li>
                                    <li>Add block chooser to data definition</li>
                                    <li>Set max render depth to 2 on block chooser in data definition</li>
                                    <li>In format, XPath to feed with:
                                        <pre><code>#set ($feed = $_XPathTool.selectNodes($page, "rss-feed/content/rss/channel/item"))</code></pre>
                                    </li>
                                </ol>
                            </section>

                            <section
                                aria-label="Regex"
                                class="anchor-heading"
                                id="regex">
                                <h2>
                                    Regex
                                    <a
                                        aria-label="Skip to Regex"
                                        href="#regex"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>
                                <p>See <a href="https://regex101.com/">regex101.com</a> for examples and testing.</p>

                                <h3>Remove characters after ? (in TextWrangler)</h3>
                                <pre><code>((href)\s*=\s*['"]([^'"]*default[^'"]*))(\\?)[^'"]*(['"])
\\1\\5</code></pre>

                                <h3>Remove extension from site link (in PHP)</h3>
                                <pre><code>$match = '/((href|src)\s*=\s*[\'"]site:\/\/[^\'"]*)(\.xml)([\'"])/';
$tmptext = preg_replace($match, "$1$4", $tmptext);</code></pre>

                                <h3>Add a closing "/" to img tags</h3>
                                <pre><code>#set ($text = $text.replaceAll("(&lt;img[^&gt;]*)&gt;", "$1/&gt;"))</code></pre>

                                <h3>Get file extension</h3>
                                <pre><code>#set ($extension = $video.replaceAll("^.*\\.([^\\\\]+)$", "$1"))</code></pre>

                                <h3>Valid Anchor Tag for Links</h3>
                                <pre><code>^[A-Za-z][A-Za-z0-9-_:.]*$</code></pre>
                            </section>

                            <section
                                aria-label="Remote Client Connection"
                                class="anchor-heading"
                                id="remote-client-connection">
                                <h2>
                                    Remote Client Connection
                                    <a
                                        aria-label="Skip to Remote Client Connection"
                                        href="#remote-client-connection"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>
                                <p>IP Address for developers.hannonhill.com: 54.243.203.126</p>
                                <pre><code>ssh ec2-user@developers.hannonhill.com
ssh ec2-user@developers.hannonhill.com -L8080:testapi.up.edu:443
Ssh -L 8082:clscc-devweb01.clevelandstatecc.edu:8080 ec2-user@developers.hannonhill.com</code></pre>
                            </section>

                            <section
                                aria-label="Javascript"
                                class="anchor-heading"
                                id="javascript">
                                <h2>
                                    Javascript
                                    <a
                                        aria-label="Skip to Javascript"
                                        href="#javascript"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>

                                <h3>Escape Character</h3>
                                <pre><code>"This is Joe's \"favorite\" string";</code></pre>

                                <h3>Objects</h3>
                                <pre><code>var notEmptyObject = {
    'label' : 'value',
    'label2' : 'value2'
};
notEmptyObject.label
notEmptyObject.label = 'aValue'
notEmptyObject.label3 = 'value3'
delete notEmptyObject.label3</code></pre>

                                <h3>Arrays</h3>
                                <pre><code>var arrayOfStuff = [
    {'name' : 'value'},
    [1, 2, 3],
    true,
    'nifty'
];
arrayOfStuff[0]
arrayOfStuff.length
arrayOfStuff.push('item')
arrayOfStuff.pop()
arrayOfStuff.splice(2,1)
arrayOfStuff[3] = false</code></pre>

                                <h3>Comments</h3>
                                <pre><code>// single line comment
/* multi line
comment
*/</code></pre>

                                <h3>Regex</h3>
                                <pre><code>var string = 'This is the longest string ever'
var regex = /this$/i
console.log(regex.test(string)):</code></pre>

                                <h3>Equality</h3>
                                <pre><code>1 === 1;  // true
1 !== 1;  // false
1 !== 2;  // true
1 === 2;  // false

1 == 1; // true
1 == '1'; // true (?!)
1 === '1'; // false
1 != '1'; // false</code></pre>

                                <h3>Precedence</h3>
                                <p>&amp;&amp;'s (and's) are evaluated before ||'s (or's)</p>

                                <h3>IF Statement</h3>
                                <pre><code>var answer = window.confirm('Click OK, get true.  Click cancel, get false.');

var answer = window.prompt('Type YES, NO, or MAYBE.  Then click OK.');
if (answer === 'YES') {
    console.log('You said YES!');
} else if (answer === 'MAYBE') {
    console.log("You said maybe. I don't know what to make of that.");
} else if (answer === 'NO') {
    console.log('You said no. :(');
} else {
    console.log('You rebel, you!');
}</code></pre>

                                <h3>Switch Statement</h3>
                                <pre><code>var answer = window.prompt('Type YES, NO, or MAYBE.  Then click OK.');

switch (answer) {
    case 'YES' :
        console.log('You said YES!');
        break;
    case 'MAYBE' :
        console.log("You said maybe. I don't know what to make of that.");
        break;
    case 'NO' :
        console.log('You said no. :(');
        break;
    default :
        console.log('You rebel, you!');
        break;
}</code></pre>

                                <h3>Ternary or Conditional statement</h3>
                                <pre><code>animal === 'cat' ? console.log('You will be a cat herder.') : console.log('You will be a dog catcher.');
var job = (animal === 'cat' ? 'cat herder' : 'dog catcher');

thing = [];
typeof thing;
typeof thing === 'object' && thing.hasOwnProperty('length'); // true</code></pre>

                                <h3>While Loop</h3>
                                <pre><code>var myArray = [true, true, true, false, true, true];
var myItem = null;
while (myItem !== false) {
    console.log('myArray has ' + myArray.length + ' items now. This loop will go until we pop a false.');
    myItem = myArray.pop();
}</code></pre>

                                <h3>Functions</h3>
                                <pre><code>function speakSomething(what, howMany) {
    // this pattern works nicely for default values:
    var what = (typeof what !== 'undefined') ? what : 'Default speech';
    var howMany = (typeof howMany !== 'undefined') ? howMany : 10;

    for (var i = 0; i < howMany; i += 1) {
        console.log(what + " (" + i + ")");
    }
}

function addingMachine() {
    // initialize the total we'll be returning
    var total = 0;

    for (var i = 0; i < arguments.length; i += 1) {
        var number = arguments[i];

        if (typeof number === 'number') {
            total += number;
        }
    }

    return total;
}</code></pre>

                                <h3>Date Format</h3>
                                <p><a href="http://www.w3schools.com/jsref/jsref_obj_date.asp">W3Schools JavaScript Date Reference</a></p>
                            </section>

                            <section
                                aria-label="Web Services"
                                class="anchor-heading"
                                id="web-services">
                                <h2>
                                    Web Services
                                    <a
                                        aria-label="Skip to Web Services"
                                        href="#web-services"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>

                                <h3>General Notes</h3>
                                <ul>
                                    <li>SOAP WSDL: <a href="https://services.cascadecms.com/ws/services/AssetOperationService?wsdl">AssetOperationService WSDL</a></li>
                                    <li>REST API: <a href="https://services.cascadecms.com/api/v1/">https://services.cascadecms.com/api/v1/</a></li>
                                    <li>When changing system-name, use the MOVE function</li>
                                </ul>

                                <h3>Error Messages</h3>
                                <ul>
                                    <li><strong>No bean specified</strong> - Missing something in the request such as request type (move, read, edit, etc.) or asset type (page, block, file, etc.)</li>
                                </ul>

                                <h3>REST API</h3>
                                <p>Entering content for multiselects, values must be separated by: <code>::CONTENT-XML-SELECTOR::</code></p>

                                <h4>Read site by site name</h4>
                                <pre><code>read/site/%20/[SITENAME]</code></pre>

                                <h4>Read root folder by path</h4>
                                <pre><code>read/folder/[SITENAME]/%252F</code></pre>

                                <h4>Edit Access Rights</h4>
                                <pre><code>$accessRightsInfo = [
    'accessRightsInformation' => [
        'aclEntries' => [
            (object) [
                    'level' => 'write',
                    'type' => 'group',
                    'name' => $this->siteName
                ]
            ],
            'allLevel' => 'read'
        ],
    'applyToChildren' => true
];
$editAccessRights = $this->post("editAccessRights/folder/$this->siteName/%252F", $accessRightsInfo);</code></pre>

                                <h4>Field Values</h4>
                                <p><strong>Multiselect Values:</strong></p>
                                <pre><code>::CONTENT-XML-SELECTOR::value1::CONTENT-XML-SELECTOR::value2</code></pre>

                                <p><strong>Checkbox Values:</strong></p>
                                <pre><code>::CONTENT-XML-CHECKBOX::calendarAdd::CONTENT-XML-CHECKBOX::socialShare</code></pre>
                            </section>

                            <section
                                aria-label="Examples"
                                class="anchor-heading"
                                id="examples">
                                <h2>
                                    Examples
                                    <a
                                        aria-label="Skip to Examples"
                                        href="#examples"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>

                                <h3>YouTube RSS</h3>
                                <p><strong>Feed URL:</strong> https://youtube.com/feeds/videos.xml?user=USERNAME</p>
                                <pre><code>#set ( $entries = $_XPathTool.selectNodes($contentRoot, "//*[local-name() = 'entry']") )
#foreach($entry in $entries)
    #set ($link = $_XPathTool.selectSingleNode($entry, "*[local-name()='link']/@href").value)
    #set ($thumbnail = $_XPathTool.selectSingleNode($entry, "*[local-name()='group']/*[local-name()='thumbnail']/@url").value)
    &lt;div class=""&gt;
&lt;a href="$!link" target="_blank"&gt;&lt;img src="$!thumbnail" alt="" /&gt;&lt;/a&gt;
    &lt;/div&gt;
#end</code></pre>

                                <h3>PHP Tidy Parameters to match Cascade</h3>
                                <pre><code>$config = [
    'tidy-mark' => false,
    'numeric-entities' => true,
    'show-body-only' => true,
    'quote-ampersand' => true,
    'char-encoding' => 'raw',
    'word-2000' => true,
    'drop-empty-paras' => true,
    'drop-empty-elements' => false,
    'bare' => true,
    'output-xml' => true,
    'output-xhtml' => true,
    'doctype' => 'omit',
    'quiet' => true,
    'force-output' => true,
    'logical-emphasis' => true,
    'wrap' => 0,
    'indent' => false
];
$tidy = new tidy;
$tidy->parseString($data, $config, 'utf8');
$tidy->cleanRepair();

$data = $tidy->value;</code></pre>

                                <h3>Google Search</h3>
                                <h4>Add script to head files</h4>
                                <pre><code>&lt;script async src="https://cse.google.com/cse.js?cx=009943290618833343385:yi9hdw8leha"&gt;
&lt;/script&gt;</code></pre>

                                <h4>Add div to search results page</h4>
                                <pre><code>&lt;div class="gcse-search"&gt;&lt;/div&gt;

## OR (if a custom search bar)

&lt;div class="gcse-searchresults-only"&gt;&lt;/div&gt;</code></pre>

                                <h4>Add hidden input to search form</h4>
                                <pre><code>&lt;input name="cx" type="hidden" value="000957631349272247652:mjsi_yxiiao"/&gt;</code></pre>
                                <p><em>Note: Make sure text input field has</em> <code>name="q"</code></p>

                                <h3>Includes</h3>
                                <pre><code>[system-view:external]
    &lt;?php include ($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?&gt;
[/system-view:external]</code></pre>

                                <h3>VSCode</h3>
                                <h4>Remove blank lines</h4>
                                <p>Use this regex in find/replace:</p>
                                <pre><code>^$\n</code></pre>
                            </section>

                            <a
                                aria-label="Back to top"
                                class="scroll-container"
                                href="#top">
                                <span class="scroll-container__icon">↑</span>
                            </a>
                        </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
<?php require __DIR__ . "/../partials/article-footer.php"; ?>
<?php require __DIR__ . "/../partials/article-scripts.php"; ?>
