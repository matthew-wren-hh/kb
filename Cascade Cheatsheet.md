# Cheatsheet

[General](#general)

[System Tags](#system-tags)

[Code Sections (i.e. Protect Tags)](#code-sections-\(i.e.-protect-tags\))

[System Pseudo-Tags](#system-pseudo-tags)

[Metadata Tags](#metadata-tags)

[XPath](#xpath)

[Cascade](#cascade)

[Migration](#migration)

[Velocity Tools](#velocity-tools)

[List Tool](#list-tool)

[String Tool](#string-tool)

[Display Tool](#display-tool)

[Sort Tool](#sort-tool)

[Math Tool](#math-tool)

[Locator Tool](#locator-tool)

[Query Tool](#query-tool)

[Date Tool](#date-tool)

[Difference Tool](#difference-tool)

[RSS Feeds](#rss-feeds)

[Output RSS Feed](#output-rss-feed)

[Input RSS Feed](#input-rss-feed)

[Regex](#regex)

[Remote Client Connection](#remote-client-connection)

[Javascript](#javascript)

[Web Services](#web-services)

[General Notes](#general-notes)

[Error Messages](#error-messages)

[REST API](#rest-api)

[Examples](#examples)

[YouTube RSS](#youtube-rss)

[PHP Tidy Parameters to match Cascade](#php-tidy-parameters-to-match-cascade)

[Google Search](#google-search)

[Includes](#includes)

[VSCode](#vscode)

# General {#general}

### Site URL

$currentPage.site.url

### Test for empty WYSIWYG field

\#set ($wysiwyg \= $content.getChild("wysiwyg"))  
\#if (\!$\_PropertyTool.isEmpty($wysiwyg.value) || $wysiwyg.getChildren().size() \> 0\)  
    $\_SerializerTool.serialize($wysiwyg, true))  
\#end  
[http://help.hannonhill.com/kb/formats/testing-for-empty-wysiwyg-field](http://help.hannonhill.com/kb/formats/testing-for-empty-wysiwyg-field)

### Contains, Starts With & Ends With checks

$link.contains(“base assets”)  
$currentPage.link.startsWith($node.link)  
\#if ($link.endsWith("/index"))

### Lower or Uppercase something

$string.toLowerCase()  
$string.toUpperCase()  
\#\# Capitalize first letter  
${string.substring(0,1).toUpperCase()}${string.substring(1)}

### Output Link

\#macro (outputLink $page)  
    \#getAssetName($page)  
    \#set ($link \= $page.link) \#\#or \#set ($link \= $page.getChild("link").value)  
    \<li\>\<a href="$\!link" alt="$\!title" title="$\!title"\>$\!title\</a\>\</li\>  
\#end

### Sitemap

[https://github.com/hannonhill/Velocity-Cookbook/tree/master/Sitemap-SEO](https://github.com/hannonhill/Velocity-Cookbook/tree/master/Sitemap-SEO)

### System-asset

body {  
   background: url('\[system-asset\]/site/marble.png\[/system-asset\]')  
}  
Check “rewrite links in file” under system tab  
[http://www.hannonhill.com/kb/Linking](http://www.hannonhill.com/kb/Linking/)

$\_PropertyTool.outputProperties($currentPage)

### Checkboxes

\#set ($checkboxes \= $currentPage.getStructuredDataNode("override").textValues)  
\#foreach ($check in $checkboxes)  
    $check\#if($foreach.hasNext), \#end  
\#end

### Split string

\#set($courseTerms \= \[\])  
\#foreach ($course in $allCourses)  
    \#set ($terms \= "")  
    \#set ($terms \= $course.getStructuredDataNode("courseInfo/terms").textValue)  
    \#if (\!$\_PropertyTool.isEmpty($terms))  
        \#foreach ($term in $terms.split(", "))  
            \#if (\!$courseTerms.contains($term))  
                \#set ($void \= $courseTerms.add($term))  
            \#end  
        \#end  
    \#end  
\#end

 \#set ( $lastSlashInCurrentPagePath \= $\_MathTool.toInteger($currentPage.path.lastIndexOf("/")) \+ 1 )  
\#set ( $folderOfCurrentPagePath \= $currentPage.path.substring(0,$lastSlashInCurrentPagePath) )

\#set ($string \= "\#test123")  
\#set ($slice \= $string.substring(1))  
\#set ($slice \= $string.substring(1,$string.length()))

### \#foreach

* $foreach.index  
* $foreach.count  
* $foreach.hasNext  
* \#break  
* $foreach.parent.index  
* $foreach.parent.parent.count, etc  
* Range Operator  
  * \#foreach( $foo in \[1..5\] )  
    	$foo  
    \#end

### Hashmap

\#set ( $typeList \= { "Photo" : "photos", "News" : "news", "Card" : "boxes", "Mixed" : "" } )  
\#set ( $type \= $typeList\[$grid.getChild("type").value\] )  
\#set ( $\_void \= $typeList.put(“key”,”value”))  
\#foreach ($entry in $typeList.entrySet())  
    Entire entry \- $entry  
    This entries key \- $entry.key  
    This entries value \- $entry.value  
\#end

\#set ($widths \= {"1":"12", "2":"6", "3":"4", "4":"3"})  
\#set ($width \= $widths\["$positions.size()"\])

\#\# Check if a key exists in a map  
\#if ($programTypeMap.get($bType))  
\#set ($bType \= $programTypeMap\[$bType\])  
\#end

### Arrays

\#set ($people \= \[\])  
\#set ($temp \= $people.add($page))  
\#set ($temp \= $people.remove($page))

*Merge Arrays*  
\#set ($query\_items \= \[array of items\])  
\#set ($temp \= $query\_items)  
\#set ($query\_items \= \[another array of items\])  
\#foreach ($item in $temp)  
    \#set ($void \= $query\_items.add($item))  
\#end  
$query\_items now has both array of items

### \#evaluate

\#set ($type \= $row.getChild("type").textValue)  
\#evaluate("\#$type()")

\#set ( $addressList \= "\#arrToJSON($addressArr)" )

\#foreach ($row in $rows)  
    \#set ($type \= $row.getChild("type").value)  
    \#set ($macro \= "\#" \+ $type)  
    \#evaluate("$macro(\\$row)")  
\#end

### Dropdown/Multiselect Labels

\#\# All Schools sorted by Group/Type  
\#set ($activeSchools \= $\_.query().byMetadataSet("Site Setup").hasMetadata("active","yes").searchAcrossAllSites().execute())  
\#set ($groups \= {  
    "District": \[\],  
    "Elementary School": \[\],  
    "Middle School": \[\],  
    "High School": \[\],  
    "Non-Traditional School": \[\],  
    "K-8 or Traditional School": \[\]  
    })  
\#foreach ($school in $activeSchools)  
    \#set ($group \= $school.getStructuredDataNode("schoolGroup").selectedFieldItems\[0\].label)  
    \#set ($void \= $groups\[$group\].add($school))  
\#end

\#set($categories \= "")  
\#foreach ($n in \[1..10\])  
    \#foreach ($filter in $page.getStructuredDataNode("filter/filter${n}").selectedFieldItems)  
        \#if (\!$\_PropertyTool.isEmpty($categories))  
\#set($categories \= $categories \+ ",")  
        \#end  
        \#set($categories \= $categories \+ $filter.label)  
    \#end  
\#end

### Remove Whitespace

$string.trim()

### Virtual Include

\#set ($path \= "path/to/include")

\#set ($include \= '\<\!--\#include virtual="' \+ "/courses-mod/${path}.html" \+ '"--\>')  
$include

**OR**

\<\!--$\_EscapeTool.xml('\#include') virtual="/courses-mod/${path}.html"--\>

### Namespaces

[https://www.hannonhill.com/cascadecms/latest/faqs/development/working-with-namespaces-in-velocity.html](https://www.hannonhill.com/cascadecms/latest/faqs/development/working-with-namespaces-in-velocity.html) 

# System Tags {#system-tags}

## Code Sections (i.e. Protect Tags) {#code-sections-(i.e.-protect-tags)}

[https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/code-sections.html](https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/code-sections.html)

\<\!\[CDATA\[\#protect  
stuff to remain  
\#protect\]\]\>  
always wrap empty \<i\> and \<em\> tags in protect  
\<\!--\#protect...put any code here...\#protect→

### Output content with no Root element

\<\!\[CDATA\[\#protect-top  
    \#set ($test \= "hello world")  
   $test  
\<\!--\#cascade-skip--\>  
\#protect-top\]\]\>

## System Pseudo-Tags {#system-pseudo-tags}

[https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/system-pseudo-tags.html](https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/system-pseudo-tags.html)

\[system-asset:configuration=JSON\]/alerts/\_alert-data?raw\[/system-asset:configuration\]  
\[system-view:internal\]Only seen inside cascade\[/system-view:internal\]  
\[system-view:external\]Only seen on publish\[/system-view:external\]

## Metadata Tags {#metadata-tags}

[https://www.hannonhill.com/cascadecms/latest/content-authoring/pages/system-tags.html](https://www.hannonhill.com/cascadecms/latest/content-authoring/pages/system-tags.html)

| Tag | Description | Example Output |
| ----- | ----- | ----- |
| \<system-page-name/\> |  The system name of the page. | system-tags |
| \<system-page-creator/\> | The creator of the page. | Jane Doe |
| \<system-page-title/\> | The contents of the page's Title metadata field. | System Tags |
| \<system-page-summary/\> | The contents of the page's Summary metadata field. | Cascade CMS recognizes specific XML elements called system tags that are used for dynamic content insertion. |
| \<system-page-author/\> | The contents of the page's Author metadata field. | Jane Doe |
| \<system-page-teaser/\> | The contents of the page's Teaser metadata field. | Learn more about system tags in Cascade CMS. |
| \<system-page-keywords/\> | The contents of the page's Keywords metadata field. | tags, metadata, xml |
| \<system-page-description/\> | The contents of the page's Description metadata field. | A review of available system tags in Cascade CMS. |
| \<system-page-display-name/\> | The contents of the page's Display Name metadata field. | System Tags |
| \<system-page-start-date/\> | The contents of the page's Start Date metadata field, displayed in US date format MMM DD, YYYY hh:mm a. | May 1, 2021 12:00 AM |
| \<system-page-end-date/\> | The contents of the page's End Date metadata field, displayed in US date format MMM DD, YYYY hh:mm a. | May 8, 2021 12:00 AM |

| Tag | Description | Example Output |
| ----- | ----- | ----- |
| \<system-page-meta-keywords/\> | A meta element including the contents of the page's Keywords metadata field. | \<meta content="tags, metadata, xml" name="keywords" /\> |
| \<system-page-meta-description/\> | A meta element including the contents of the page's Description metadata field. | \<meta content="A review of available system tags in Cascade CMS." name="description" /\> |
| \<system-page-meta-author/\> | A meta element including the contents of the page's Author metadata field. | \<meta content="Charlie Holder" name="author" /\> |
| \<system-page-meta-date/\> | A meta element including the date and time the page was rendered. | \<meta content="Fri, 07 May 2021 13:56:22 \-0560" name="date" /\> |

# 

# XPath {#xpath}

## Cascade {#cascade}

\#set ($breadcrumbs \= $\_XPathTool.selectNodes($contentRoot, "//system-folder\[name \!= '/'\]\[not(@current and system-page\[@current and not(@reference) and name \= 'index'\])\] | //system-page\[@current and not(parent::calling-page) and not(@reference)\]"))

\#set ($news \= $\_XPathTool.selectNodes($contentRoot, "//system-page\[name\!='index'\]\[dynamic-metadata\[name='router-include' and value='Yes'\]\]\[not(contains(path, 'base assets'))\]"))

\#macro (getAssetName $asset)  
    \#set ($title \= "")  
    \#if(\!$asset.metadata.displayName.empty)  
        \#set ($title \= $\_EscapeTool.xml($asset.metadata.displayName))  
    \#elseif(\!$asset.metadata.title.empty)  
        \#set ($title \= $\_EscapeTool.xml($asset.metadata.title))  
    \#else  
        \#set ($title \= $\_EscapeTool.xml($asset.name))  
    \#end  
\#end

**OR**

\#macro (getAssetName $asset)  
    \#if ($asset.getChild("display-name"))  
        $\_EscapeTool.xml($asset.getChild("display-name").value)  
    \#elseif ($asset.getChild("title"))  
        $\_EscapeTool.xml($asset.getChild("title").value)  
    \#else  
        $asset.getChild("name").value  
    \#end  
\#end

## Migration {#migration}

//div\[@id="contentleft"\]/\*\[position() \> 2\]  
//div\[@id="contentleft"\]/\*\[not(self::h1)\]  
//div\[@id="contentleft"\]/h1/small/text()  
//div\[@id="contentleft"\]/h1/text()

# 

# Velocity Tools {#velocity-tools}

## List Tool {#list-tool}

### Combine Lists

$list.addAll($anotherList)

\#set ($allCourses \= \[\])  
\#set ($coursesFolder \= $\_.locateFolder("Programs-and-Courses-Finder/course", "Catalog"))  
\#foreach ($folder in $coursesFolder.children)  
    \#if ($folder.assetType \== "folder")  
        \#set ($courses \= $\_.query().byDataDefinition("site://${globalSite}/Pages/Course Detail").bySiteName("Catalog").byFolderPath($folder.path).preloadDynamicMetadata().preloadStructuredData().maxResults(-1).sortBy("name").sortDirection("desc").execute())  
        \#set ($void \= $allCourses.addAll($courses))  
    \#end  
\#end

### Reverse a List

$\_ListTool.reverse($array)

## String Tool {#string-tool}

\#set ( $path \= $\_StringTool.substringAfter($descrString, "src=\&quot;") )  
\#set ( $path \= $\_StringTool.substringBefore($path, "\&quot;") )  
\#set ($string \= $string.replaceAll("\&rsquo;", "'"))  
$location.replaceAll("\\n", "HELLO")

## Display Tool {#display-tool}

### Strip Tags

$\_DisplayTool.stripTags($textWithHtml)  
$\_DisplayTool.stripTags($description, "a", "img") \#\#allowed tags

### Truncate

$\_DisplayTool.truncate($longText,33,"...",true)

### Break

*New Lines to \<br\> (textarea)*  
$\_DisplayTool.br("Here is a String with  
                a line break.")  
*\#\# Expected output: Here is a string with\<br/\>a line break.*

[https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/script-formats/velocity-tools.html\#DisplayTool](https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/script-formats/velocity-tools.html#DisplayTool)

## Sort Tool {#sort-tool}

### Sort with XPath

$\_SortTool.addSortCriterion("start-date", "en", "number", "descending", "upper-first")  
$\_SortTool.sort($news)  
[KB](https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/script-formats/velocity-tools.html#_SortTool_sort)

\#set ($years \= $\_XPathTool.selectNodes($indicium, "year:asc") )  
\#set ($yearsSorted \= \[\])  
\#foreach ($year in $years)  
\#set ($temp \= $yearsSorted.add($year.value))  
\#end  
\#set ($yearsSorted \= $\_SortTool.sort($yearsSorted.toArray()) )

### Sort a List

\#set($sorted \= $\_SortTool.sort($assets, "metadata.dynamicField(myDynamicField).value"))  
\#set($sorted \= $\_SortTool.sort($pages, "structuredDataNode(myField).textValue"))

### From assets in a multiple chooser

\#set ($people       \= $row.getChildren("profilePage"))  
\#set ($peopleSort   \= \[\])  
\#foreach ($person in $people)  
  \#set ($\_void \= $peopleSort.add($person.asset))  
\#end  
\#if ($sortBy \== "firstName")  
  \#set ($peopleSort \= $\_SortTool.sort($peopleSort, "metadata.dynamicField(firstName).value"))  
\#elseif ($sortBy \== "lastName")  
  \#set ($peopleSort \= $\_SortTool.sort($peopleSort, "metadata.dynamicField(lastName).value"))  
\#end

### Sorting child nodes

By string  
\<offerings\>  
\<title\>A Title/title\>  
       	... other fields here ...  
\</offerings\>  
\<offerings\>  
	\<title\>Another Title\</title\>  
       	... other fields here ...  
\</offerings\>  
$\_SortTool.sort($offerings,"Child(title).textValue:desc")

By Date  
\<offerings\>  
\<startDate\>10-19-2020\</startDate\>  
       	... other fields here ...  
\</offerings\>  
\<offerings\>  
	\<startDate\>9-21-2020\</startDate\>  
       	... other fields here ...  
\</offerings\>  
\#set ($sortable \= \[\])  
\#foreach ($offer in $offerings)  
\#set ($date \= $\_DateTool.toDate("MM-dd-yyyy", $offer.getChild("startDate").textValue))  
       \#set ($dateTimestamp \= $date.getTime())  
       \#set ($\_void \= $sortable.add({  
                "timestamp": $dateTimestamp,  
                "offer": $offer  
            }))  
\#end  
\#set ($sorted \= $\_SortTool.sort($sortable, \["timestamp"\]))

### Hashmap sorting

\#set ($hash \= {"a" : "1", "c" : "4", "b" : "3"})  
$hash  
\#set ($sorted \= $\_SortTool.sort($hash.keySet()))  
$sorted  
\#foreach ($item in $sorted)  
    $hash\[$item\]  
\#end

### Sort Multiselect

\#macro (sortArray $referenceArray $targetArray)  
    \#set ($sortedArray \= \[\])  
    \#foreach ($item in $referenceArray)  
        \#foreach ($targetItem in $targetArray)  
            \#if ($item.label \== $targetItem.label)  
                \#set ($\_void \= $sortedArray.add($targetItem))  
            \#end  
        \#end  
    \#end  
\#end  
\#\# Example Usage  
\#set ($types \= $page.metadata.getDynamicField('type').selectedFieldItems)  
\#set ($typesOrder \= $page.metadata.getDynamicField('type').possibleFieldItems)  
\#sortArray($typesOrder $types)  
\#foreach ($item in $sortedArray)  
$item.label  
\#end

## Math Tool {#math-tool}

\#set ( $realInt \= $\_MathTool.toInteger($numText) )  \#\# Returns null if the provided parameter is not able to be converted  
\#set ( $realDouble \= $\_MathTool.toDouble($numText) )   
[http://www.hannonhill.com/kb/Script-Formats/\#math-tool](http://www.hannonhill.com/kb/Script-Formats/#math-tool)

## Locator Tool {#locator-tool}

[http://www.hannonhill.com/kb/Script-Formats/\#locator-tool](http://www.hannonhill.com/kb/Script-Formats/#locator-tool)

\#set ( $callingPage \= $\_.locate($currentPagePath, $\_FieldTool.in(“com.hannonhill.cascade.model.dom.identifier.EntityTypes”).TYPE\_PAGE, $currentPageSiteName))

* locatePage(path)  
* locatePage(path, siteName)  
* locateFile(path)  
* locateFile(path, siteName)  
* locateFolder(path)  
* locateFolder(path, siteName)  
* locateBlock(path)  
* locateBlock(path, siteName)  
* locateSymlink(path)  
* locateSymlink(path, siteName)  
* locateReference(path)  
* locateReference(path, siteName)  
* locate(path, type)  
* locate(path, type, siteName)

### Accessing fields when getting pages with locator tool

    \#set ($tags \= $feature.metadata.getDynamicField("category").values)  
    \#foreach ($tag in $tags)  
        \#if ($tag \!= "")  
            \<a href="/news/$categories\[$tag\]"\>\<p class="tag"\>$\_EscapeTool.xml($\!tag)\</p\>\</a\>  
        \#end  
    \#end

$person.getStructuredDataNode("syndication").getChild("summary").textValue

### Radio Option

\#set ( $includeFooter \= $block.getStructuredDataNode("include-footer-grid"))  
\#foreach ($i in $includeFooter.textValues)  
    \#if ( $i \== "Yes" )  
        \#set ( $outputFooterGrid \= true )  
    \#end  
\#end

**OR**

$includeFooter.textValues.contains(“Yes”)

## Query Tool {#query-tool}

\#set($query \= $\_.query())  
\#set($query \= $query.byMetadataSet("Standard"))    
\#set($query \= $query.byContentType("site://common/Standard Page"))    
\#set($query \= $query.includePages(true))    
\#set($query \= $query.includeFiles(true))    
\#set($query \= $query.includeBlocks(false))    
\#set($query \= $query.includeFolders(true))    
\#set($query \= $query.includeSymlinks(false))   
\#set($query \= $query.hasMetadata("displayName", "Index"))    
\#set ($query \= $query.hasMetadata("sitemap-include", "Yes") )

**Call $query to see all properties and their current value**  
*Assign metadataFieldName and metadataFieldValue by calling hasMetadata($name, $value)*  

* metadataFieldName \= null \[displayName | title | summary | teaser | keywords | description | author | startDate | endDate | reviewDate\]  
* metadataFieldValue \= null

*Assign contentTypeLink by calling byContentType($link) or metadataSetLink by calling byMetadataSet($link)*

* metadataSetLink \= Default  
* sortBy \= \[summary | startDate | keywords | reviewDate | endDate | modified | author | title | created | description | teaser | name | path | displayName\]  
* sortDirection \= asc \[desc|asc\]  
* maxResults \= 100 \[max 500\]  
* siteName \= www.example.edu   \[Call searchAcrossAllSites() to null out\]  
* indexableOnly \= true  
* publishableOnly \= false

    
**Call execute() to get search results**  
\#set($results \= $query.execute())  
\#foreach($page in $results)  
$page.name  
\#end

**You can set all values in one line**  
\#set($results \= $\_.query().byMetadataSet("Default").includePages(true).maxResults(10).sortBy("name").sortDirection("asc").execute())

**Structured data query**  
\<system-data-structure\>  
	\<tags\>  
		\<tags\>B\</tags\>  
		\<tags\>C\</tags\>  
	\</tags\>  
\</system-data-structure\>

\#macro (toList $node)  
    \#set ($tags \= \[\])  
    \#foreach ($item in $node)  
        \#set ($void \= $tags.add($item.textValue))  
    \#end  
\#end  
\#toList($currentPage.getStructuredDataNodes("tags/tags"))

\#set ($students \= $\_.query().byContentType("Student Success Profile").hasMetadata("type","student").hasAnyStructuredDataValues("tags/tags", $tags).execute())

## Date Tool {#date-tool}

### Turn a string into a date format

\#set ( $date \= "08-08-2013" )  
\#set ( $dateFormat \= $\_DateTool.getDateFormat("MM-dd-yyyy", $\_DateTool.getLocale(), $\_DateTool.getTimeZone()) )  
\#set ( $date \= $dateFormat.parse($date) )  
[http://help.hannonhill.com/discussions/velocity-formats/5332-formatting-dates-using-datetool](http://help.hannonhill.com/discussions/velocity-formats/5332-formatting-dates-using-datetool)

\#set ( $dateFormat \= $\_DateTool.getDateFormat("EEE, d MMM y H:m:s z", $\_DateTool.getLocale(), $\_DateTool.getTimeZone()) )  
\#set ( $date \= $dateFormat.parse($feed.getChild("pubDate").value) )  
$\_DateTool.format('EEEE, MMMM d, y', $date)

**OR**  
$\_DateTool.toDate('EE, d MMMM yyyy HH:mm:ss z', $date.value )

### Turn a date format into a string

\#set ($date \= $\_DateTool.getDate($date.value))  
\#set ($dateFormat \= $\_DateTool.format('EEEE, MMMM d, Y h:mm a', $date))  
“Thursday, January 2, 2016 12:42 PM”  
[http://www.hannonhill.com/kb/Script-Formats/\#date-tool](http://www.hannonhill.com/kb/Script-Formats/#date-tool)

### Get Current Date

\#set ($originalDate \= $\_DateTool.getDate()) 

### Get Current Year

$\_DateTool.format("yyyy", $\_DateTool.getDate())

### Use a different timezone

\#set($utc \= $\_DateTool.getTimeZone().getTimeZone("UTC"))  
\#set($dateFormat \= $\_DateTool.getDateFormat("MM-dd-yyyy", $\_DateTool.getLocale(), $utc))

### Output a date with a different timezone

\#set ($startDate  \= $performance.metadata.getDynamicField("performance-start-date").value)  
\#set ($startDate  \= $\_DateTool.getDate($startDate))  
$\_DateTool.format('EE, dd MMM yyyy HH:mm:ss z', $startDate, $\_DateTool.getLocale(), $\_DateTool.getTimeZone().getTimeZone("UTC"))

### Date Formats

| Day of Month | d: 1 | dd: 01 |
| :---- | :---- | :---- |
| Day of Week | E: Mon | EEEE: Monday |
| Name of Month | MMM: Jan | MMMM: January M: 01 |
| Year | y: 2016 | yy or YY: 16 |
| Hour (12H) | h: 1 | hh: 01 |
| Hour (24H) | H: 18 | HH: 09 |
| Minutes | m: 1 | mm: 01 |
| Seconds | s: 1 | ss: 01 |
| Milliseconds | S: 999 |  |
| Time AM/PM | a: AM |  |
| Time Zone | z: EST | zzzz: Eastern Standard Time |
| Time Offset | Z: \-0500 |  |

[https://docs.oracle.com/javase/7/docs/api/java/text/SimpleDateFormat.html](https://docs.oracle.com/javase/7/docs/api/java/text/SimpleDateFormat.html)  
[http://velocity.apache.org/tools/devel/javadoc/org/apache/velocity/tools/generic/ComparisonDateTool.html](http://velocity.apache.org/tools/devel/javadoc/org/apache/velocity/tools/generic/ComparisonDateTool.html)

## Difference Tool {#difference-tool}

\#set ($today \= $\_DateTool.getDate())  
\#set ($end \= $\_DateTool.getDate($event.getStructuredDataNode(“ends”).textValue))  
\#if ($\_DateTool.difference($today, $end).days \>= 0\)

### Days of Week

\#foreach ($date in $\_.locateBlock("test", "Pittsburgh Playhouse").getStructuredDataNodes("dateTime"))  
    \#set ($start \= $\_DateTool.toCalendar($\_DateTool.getDate($date.getChild("start").textValue)))  
    \#set ($end \= $\_DateTool.toCalendar($\_DateTool.toDate("MM-dd-yyyy", $date.getChild("end").textValue)))  
    \#\# \#set ($end \= $start)  
    \#set ($diff \= $\_DateTool.whenIs($start, $end).getDays() \+ 1\)  
    $\_DateTool.format("MMMM d", $start) \- $\_DateTool.format("d, yyyy", $end)  
    \#foreach ($d in \[0..$diff\])  
        $\_DateTool.format("EEEE, MMMM d, yyyy 'at' hh:mm a", $start)  
        $start.add(5, 1\)  
    \#end  
\#end

# RSS Feeds {#rss-feeds}

## Output RSS Feed {#output-rss-feed}

Create content type block of the pages to output  
Create RSS output format  
Create RSS template with \<system-region name="DEFAULT"/\>  
Add RSS format and content type block to default region of template  
Add RSS output to configuration set  
Template: rss, Extension: .rss, Serialization Type: XML

## Input RSS Feed {#input-rss-feed}

Create RSS Feed Block with link to RSS feed  
Add block chooser to data definition  
Set max render depth to 2 on block chooser in data definition  
In format, XPath to feed with  
\#set ($feed \= $\_XPathTool.selectNodes($page, "rss-feed/content/rss/channel/item"))

# Regex {#regex}

See [https://regex101.com/account/mine](https://regex101.com/account/mine) for examples

**Remove characters after ? (in TextWrangler)**  
((href)\\s\*=\\s\*\[\\'"’\](\[^\\'"’\]\*default\[^\\'"’\]\*))(\\?)\[^\\'"’\]\*(\[\\'"’\])  
\\1\\5

((href)\\s\*=\\s\*\[\\'"’\](?\!www\\.|http:\\/\\/|https:\\/\\/)(\[^\\'"’\]\*.html\[^\\'"’\]\*))(\\?)\[^\\'"’\]\*(\[\\'"’\])

**Remove extension from site link (in PHP)**  
$match \= '/((href|src)\\s\*=\\s\*\[\\'"\]site:\\/\\/\[^\\’"\]\*)(\\.xml)(\[\\'"\])/';  
$tmptext \= preg\_replace($match, "$1$4", $tmptext);

**Add a closing “/” to img tags**  
\#set ($text \= $text.replaceAll("(\<img\[^\>\]\*)\>", "$1/\>"))

**Get file extension**  
\#set ($extension \= $video.replaceAll("^.\*\\.(\[^\\\\\]+)$", "$1"))

**Valid Anchor Tag for Links**  
^\[A-Za-z\]\[A-Za-z0-9-\_:.\]\*$

# 

# Remote Client Connection {#remote-client-connection}

[https://sites.google.com/a/hannonhill.com/intranet/it-resources/ssh-tunnel?pli=1](https://sites.google.com/a/hannonhill.com/intranet/archive/ssh-tunnel)  
IP Address for developers.hannonhill.com: 54.243.203.126  
ssh [ec2-user@developers.hannonhill.com](mailto:ec2-users@developers.hannonhill.com) (enter password)  
ssh ec2-user@developers.hannonhill.com \-L8080:testapi.up.edu:443  
Ssh \-L 8082:clscc-devweb01.clevelandstatecc.edu:8080 ec2-user@developers.hannonhill.com

# Javascript {#javascript}

**Escape Character**  
"This is Joe's \\"favorite\\" string";

**Objects**  
var notEmptyObject \= {  
	'label' : 'value',  
	'label2' : 'value2'  
};  
notEmptyObject.label  
notEmptyObject.label \= ‘aValue’  
notEmptyObject.label3 \= ‘value3’  
delete notEmptyObject.label3

**Arrays**  
var arrayOfStuff \= \[  
	{'name' : 'value'},  
	\[1, 2, 3\],  
	true,  
	'nifty'  
\];  
arrayOfStuff\[0\]  
arrayOfStuff.length  
arrayOfStuff.push(‘item’)  
arrayOfStuff.pop()  
arrayOfStuff.splice(2,1)  
arrayOfStuff\[3\] \= false

**Comments**  
// single line comment  
/\* multi line  
comment  
\*/

**Regex**  
var string \= ‘This is the longest string ever’  
var regex \= /this$/i  
console.log(regex.test(string)):

**Equality**  
1 \=== 1;  // true  
1 \!== 1;  // false  
1 \!== 2;  // true  
1 \=== 2;  // false

1 \== 1; // true  
1 \== '1'; // true (?\!)  
1 \=== '1'; // false   
1 \!= '1'; // false

**Precendence**  
&&’s (and’s) are evaluated before ||’s (or’s)

**IF**  
var answer \= window.confirm('Click OK, get true.  Click cancel, get false.');

var answer \= window.prompt('Type YES, NO, or MAYBE.  Then click OK.');  
if (answer \=== 'YES') {  
	console.log('You said YES\!');  
} else if (answer \=== 'MAYBE') {  
	console.log("You said maybe. I don't know what to make of that."); // note the double primes  
} else if (answer \=== 'NO') {  
	console.log('You said no. :(');  
} else {  
	console.log('You rebel, you\!');

**Switch**  
var answer \= window.prompt('Type YES, NO, or MAYBE.  Then click OK.');

switch (answer) {  
	case 'YES' :  
		console.log('You said YES\!');  
		break;  
	case 'MAYBE' :  
		console.log("You said maybe. I don't know what to make of that.");  
		break;  
	case 'NO' :  
		console.log('You said no. :(');  
		break;  
	default :  
		console.log('You rebel, you\!');  
		break;  
}

**Turnary or Conditional statement**  
animal \=== 'cat' ? console.log('You will be a cat herder.') : console.log('You will be a dog catcher.');  
var job \= (animal \=== 'cat' ? 'cat herder' : 'dog catcher');

thing \= \[\];  
typeof thing;  
typeof thing \=== 'object' && thing.hasOwnProperty('length'); // true

**While**  
var myArray \= \[true, true, true, false, true, true\];  
var myItem \= null;  
while (myItem \!== false) {  
	console.log('myArray has ' \+ myArray.length \+ ' items now. This loop will go until we pop a false.');  
	myItem \= myArray.pop();  
}

**Functions**  
function speakSomething(what, howMany) {  
	// this pattern works nicely for default values:  
	// check if the argument is undefined, and if it is, provide a default value  
	var what \= (typeof what \!== 'undefined') ? what : 'Default speech';  
	var howMany \= (typeof howMany \!== 'undefined') ? howMany : 10;  
	  
	for (var i \= 0; i \< howMany; i \+= 1\) {  
		console.log(what \+ " (" \+ i \+ ")");  
	}  
}

function addingMachine() {  
	// initialize the total we'll be returning  
	var total \= 0;  
	  
	for (var i \= 0; i \< arguments.length; i \+= 1\) {  
		// grab the next number  
		var number \= arguments\[i\];  
		  
		// check if the argument is a number.  
		// if so, add it to the running total  
		if (typeof number \=== 'number') {  
			total \+= number;  
		}  
	}  
	  
	// done \- return the total  
	return total;  
}

**Date Format**  
[http://www.w3schools.com/jsref/jsref\_obj\_date.asp](http://www.w3schools.com/jsref/jsref_obj_date.asp)

# 

# 

# Web Services {#web-services}

## General Notes {#general-notes}

* SOAP WSDL: [https://services.cascadecms.com/ws/services/AssetOperationService?wsdl](https://services.cascadecms.com/ws/services/AssetOperationService?wsdl)  
* REST API: [https://services.cascadecms.com/api/v1/](https://services.cascadecms.com/api/v1/)  
* When changing system-name, use the MOVE function

## Error Messages {#error-messages}

* **No bean specified** \-  Missing something in the request such as request type (move, read, edit, etc.) or asset type (page, block, file, etc.)

## REST API {#rest-api}

Entering content for multiselects, values must be separated by: ::CONTENT-XML-SELECTOR::

### Read site by site name

read/site/%20/\[SITENAME\]

### Read root folder by path

read/folder/\[SITENAME\]/%252F

### Edit Access Rights

$accessRightsInfo \= \[  
    'accessRightsInformation' \=\> \[  
        'aclEntries' \=\> \[  
            (object) \[  
                    'level' \=\> 'write',  
                    'type' \=\> 'group',  
                    'name' \=\> $this-\>siteName  
                \]  
            \],  
            'allLevel' \=\> 'read'  
        \],  
    'applyToChildren' \=\> true  
\];  
$editAccessRights \= $this-\>post("editAccessRights/folder/$this-\>siteName/%252F", $accessRightsInfo);

Multiselect Values  
::CONTENT-XML-SELECTOR::value1::CONTENT-XML-SELECTOR::value2

Checkbox Values  
::CONTENT-XML-CHECKBOX::calendarAdd::CONTENT-XML-CHECKBOX::socialShare

# Examples {#examples}

## YouTube RSS {#youtube-rss}

**https://youtube.com/feeds/videos.xml?user=USERNAME**  
\#set ( $entries \= $\_XPathTool.selectNodes($contentRoot, "//\*\[local-name() \= 'entry'\]") )  
\#foreach($entry in $entries)  
    \#set ($link \= $\_XPathTool.selectSingleNode($entry, "\*\[local-name()='link'\]/@href").value)  
    \#set ($thumbnail \= $\_XPathTool.selectSingleNode($entry, "\*\[local-name()='group'\]/\*\[local-name()='thumbnail'\]/@url").value)  
    \<div class=""\>  
\<a href="$\!link" target="\_blank"\>\<img src="$\!thumbnail" alt="" /\>\</a\>  
    \</div\>  
\#end

## PHP Tidy Parameters to match Cascade {#php-tidy-parameters-to-match-cascade}

$config \= \[  
	'tidy-mark' \=\> false,  
	'numeric-entities' \=\> true,  
	'show-body-only' \=\> true,  
	'quote-ampersand' \=\> true,  
	'char-encoding' \=\> 'raw',  
	'word-2000' \=\> true,  
	'drop-empty-paras' \=\> true,  
	'drop-empty-elements' \=\> false,  
	'bare' \=\> true,  
	'output-xml' \=\> true,  
	'output-xhtml' \=\> true,  
	'doctype' \=\> 'omit',  
	'quiet' \=\> true,  
	'force-output' \=\> true,  
	'logical-emphasis' \=\> true,  
	'wrap' \=\> 0,  
    'indent' \=\> false  
\];  
$tidy \= new tidy;  
$tidy-\>parseString($data, $config, 'utf8');  
$tidy-\>cleanRepair();

$data \= $tidy-\>value;

## Google Search {#google-search}

**Add script to head files**  
\<script async="" src="https://cse.google.com/cse.js?cx=009943290618833343385:yi9hdw8leha"\>  
\</script\>

**Add div to search results page**  
\<div class="gcse-search"\>\</div\>

OR (if a custom search bar)

\<div class="gcse-searchresults-only"\>\</div\>

**Add hidden input to search form**  
\<input name="cx" type="hidden" value="000957631349272247652:mjsi\_yxiiao"/\>

*Note: Make sure text input field has* name="q"

# 

# Includes {#includes}

\[system-view:external\]  
	\<?php include ($\_SERVER\['DOCUMENT\_ROOT'\].'/\_includes/header.php'); ?\>  
\[/system-view:external\]

# 

# VSCode {#vscode}

Remove blank lines: Use this regex in find/replace  
^$\\n