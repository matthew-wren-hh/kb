# Cascade CMS Master Cheatsheet

*Comprehensive reference for Hannon Hill Support and Development teams*

Generated: 2026-02-05

Total KB Articles: 309

---

## Table of Contents

### Quick Reference
- [Part 1: Velocity & Development Quick Reference](#part-1-velocity--development-quick-reference)
- [Part 2: REST API Quick Reference](#part-2-rest-api-quick-reference)

### Knowledge Base Articles
- [Administration](#administration) (35 articles)
- [Content Management](#content-management) (69 articles)
- [Development](#development) (14 articles)
- [Configuration](#configuration) (14 articles)
- [Publishing](#publishing) (31 articles)
- [REST API](#rest-api) (3 articles)
- [Workflows](#workflows) (8 articles)
- [Search](#search) (5 articles)
- [Linking](#linking) (7 articles)
- [Integration](#integration) (8 articles)
- [Troubleshooting](#troubleshooting) (13 articles)
- [Other](#other) (102 articles)


---

# Part 1: Velocity & Development Quick Reference

*Quick reference guide for Velocity templating, XPath, system tags, and development tools*

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

---

# Part 2: REST API Quick Reference

*Quick reference for Cascade CMS REST API operations*

# Operations

Cascade CMS REST API Operations

## Read [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Read>)

`/api/v1/read/{identifier}?{auth}`

You can structure your URL in multiple ways. A few examples are below:

##### Path (`/api/v1/read/{siteName}/{path}/{to}/{asset}`)
    
    
    http://localhost:8080/api/v1/read/page/www.example.com/news/2003/best-of-show
    

##### Asset `identifier` (`/api/v1/read/{identifier})`
    
    
    http://localhost:8080/api/v1/read/page/e9f2f9a1c1a8003a2dba29096e32b2ee
    

## Delete [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Delete>)

`/api/v1/delete/{identifier}?{auth} `

  * Include “deleteParameters” in message body based on {wsdl}
  * Optionally include “workflowConfiguration” in message body based on {wsdl}

example:
    
    
    http://localhost:8080/api/v1/delete/page/www.example.com/news/2003/best-of-show?u=hill&p=hill

## Create [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Create>)

`/api/v1/create?{auth} `

  * Include “asset” in message body based on {wsdl}

    
    
    http://localhost:8080/api/v1/create?u=hill&p=hill
    {
      "asset": {
        "page": {
          "name": "test",
          "parentFolderPath": "/",
          "siteName": "www.example.com",
          "contentTypeId": "b9bc37270a00016b00899e533ba18fe5",
          "xhtml": "<div>Content</div>",
          "metadata": {
            "title": "Page title"
          }
        }
      }  
    }

## Edit [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Edit>)

`/api/v1/edit?{auth} `

  * Include “asset” in message body based on {wsdl}

example:
    
    
    http://localhost:8080/api/v1/edit?u=hill&p=hill 
    {
      "asset": {
        "page": {
          "id": "b9b0a96c0a00016b00899e5325baab29",
          "contentTypeId": "b9bc37270a00016b00899e533ba18fe5",
          "xhtml": "<div>Content</div>",
          "metadata": {
            "title": "Page title"
          }
        }
      }  
    }

## Copy [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Copy>)

`/api/v1/copy/{identifier}?{auth}`

  * Include “copyParameters” in message body based on {wsdl}
  * Optionally include “workflowConfiguration” in message body based on {wsdl}

example:
    
    
    http://localhost:8080/api/v1/copy/page/www.example.com/page-to-copy?u=hill&p=hill
    {
      "copyParameters": {
        "newName": "copied-page",
          "destinationContainerIdentifier": { 
            "type": "folder",
            "path": {
              "siteName": "site-name",
              "path": "/"
          }
        }
      }
    }

## Move [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Move>)

`/api/v1/move/{identifier}?{auth}`

  * Include “moveParameters” in message body based on {wsdl}
  * Optionally include “workflowConfiguration” in message body based on {wsdl}

example:
    
    
    {
      "identifier": {
        "id": "ba1d843cac1e00593e785d893ce8cd11",
        "type": "file"
      },
      "moveParameters": {
        "destinationContainerIdentifier": {
          "id": "d8174b287f0000011bd202d182d826d4",
          "type": "folder"
        },
        "doWorkflow": false,
        "unpublish": true
      }
    }

## Publish [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Publish>)

`/api/v1/publish/{identifier}?{auth}`

  * Optionally include “publishInformation” in message body based on {wsdl}. Its “identifier” property is not necessary if it was provided in URL.

example:
    
    
    http://localhost:8080/api/v1/publish/page/www.example.com/news/2003/best-of-show?u=hill&p=hill

**Note** : The response `success: true` in this case means that the asset has been successfully added to the publish queue. It does _not_ indicate that the asset has actually been published yet to the corresponding Destinations in the request.

**Tip** : To _unpublish_ , you can include the following in your POST request: 
    
    
    {
      "publishInformation": {
        "unpublish": true
      }
    }

## Search [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Search>)

`/api/v1/search?{auth}`

  * Include “searchInformation” in message body based on {wsdl}

example:
    
    
    http://localhost:8080/api/v1/search?u=hill&p=hill
    {
      "searchInformation": {
        "searchTerms":"https://www.hannonhill.com",
        "searchFields": ["xml"],
        "searchTypes": ["page"]
      }
    }
    

**Note** : The `searchFields` and `searchTypes` parameters must be included as arrays as seen above.

## ReadAccessRights [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ReadAccessRights>)

`/api/v1/readAccessRights/{identifier}?{auth}`

example:
    
    
    http://localhost:8080/api/v1/readAccessRights/page/www.example.com/news/2003/best-of-show?u=hill&p=hill

## EditAccessRights [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#EditAccessRights>)

### EditAccessRights

`/api/v1/editAccessRights/{identifier}?{auth}`

  * Include “accessRightsInformation” in message body based on {wsdl}. Its “identifier” property is not necessary if it was provided in URL.

## ReadWorkflowSettings [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ReadWorkflowSettings>)

### ReadWorkflowSettings

`/api/v1/readWorkflowSettings/{identifier}?{auth}`

example:
    
    
    http://localhost:8080/api/v1/readWorkflowSettings/folder/www.example.com/news?u=hill&p=hill

## EditWorkflowSettings [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#EditWorkflowSettings>)

`/api/v1/editWorkflowSettings/{identifier}?{auth}`

  * Optionally include “workflowSettings” in message body based on {wsdl}. Its “identifier” property is not necessary if it was provided in URL. If “workflowSettings” is not provided, the folder will have all workflow definitions removed and workflow will not be required or inherited.
  * Optionally include “applyInheritWorkflowsToChildren” with “true” or “false” value (false by default)
  * Optionally include “applyRequireWorkflowToChildren” with “true” or “false” value (false by default)

example:
    
    
    http://localhost:8080/api/v1/editWorkflowSettings/folder/www.example.com/news?u=hill&p=hill

## ListSubscribers [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ListSubscribers>)

### ListSubscribers

`/api/v1/listSubscribers/{identifier}?{auth}`

example:
    
    
    http://localhost:8080/api/v1/listSubscribers/page/www.example.com/news/2003/best-of-show?u=hill&p=hill

### 

## ListMessages [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ListMessages>)

### ListMessages

`/api/v1/listMessages?{auth}`

example:
    
    
    http://localhost:8080/api/v1/listMessages?u=hill&p=hill

## MarkMessage [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#MarkMessage>)

`/api/v1/markMessage/{identifier}?{auth}`

  * Include “markType” in message body with value “read” or “unread”

example:
    
    
    http://localhost:8080/api/v1/markMessage/message/21903a3d7f000001554c369f276691eb?u=hill&p=hill
    {
      "markType": "read"
    }

## DeleteMessage [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#DeleteMessage>)

`/api/v1/deleteMessage/{identifier}?{auth}`

example:
    
    
    http://localhost:8080/api/v1/deleteMessage/message/21903a3d7f000001554c369f276691eb?u=hill&p=hill

## CheckOut [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#CheckOut>)

`/api/v1/checkOut/{identifier}?{auth}`

example:
    
    
    http://localhost:8080/api/v1/checkOut/page/www.example.com/news/2003/best-of-show?u=hill&p=hill

## CheckIn [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#CheckIn>)

`/api/v1/checkIn/{identifier}?{auth}`

  * Optionally include string “comments” in message body

example:
    
    
    http://localhost:8080/api/v1/checkIn/page/www.example.com/news/2003/best-of-show?u=hill&p=hill
    {
      "comments": "Here are some comments."
    }

## SiteCopy [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#SiteCopy>)

`/api/v1/siteCopy?{auth}`

  * Include string “originalSiteId” or “originalSiteName” in message body
  * Include string “newSiteName” in message Body

example:
    
    
    http://localhost:8080/api/v1/siteCopy?u=hill&p=hill
    {
      originalSiteName: "www.example.com",
      newSiteName: "new-site"
    }

## ListSites [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ListSites>)

`/api/v1/listSites?{auth}`

example:
    
    
    http://localhost:8080/api/v1/listSites?u=hill&p=hill

## ReadAudits [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ReadAudits>)

`/api/v1/readAudits/{identifier}?{auth}`

  * Optionally include “auditParameters” in message body based on {wsdl}. Its “identifier” property is not necessary if it was provided in URL.
  * Date behavior: 
    * no dates: last week"s audits, based on current date
    * start date only: all audits after start date
    * end date only: one week’s worth of audits, based on end date
    * start and end date: all audits between dates

example:
    
    
    http://localhost:8080/api/v1/readAudits/user/hill?u=hill&p=hill
    {
       "auditParameters": {
       "startDate": "May 12, 2023 12:00:00 AM",
       "endDate": "Aug 12, 2023 11:59:00 PM"
       }
    }

## ReadWorkflowInformation [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ReadWorkflowInformation>)

`/api/v1/readWorkflowInformation/{identifier}?{auth}`

example:
    
    
    http://localhost:8080/api/v1/readWorkflowInformation/page/www.example.com/news/2003/best-of-show?u=hill&p=hill

## PerformWorkflowTransition [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#PerformWorkflowTransition>)

`/api/v1/performWorkflowTransition?{auth}`

  * Include “workflowTransitionInformation” in message body based on {wsdl}

## ReadPreferences [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ReadPreferences>)

`/api/v1/readPreferences?{auth}`

example:
    
    
    http://localhost:8080/api/v1/readPreferences?u=hill&p=hill

## EditPreference [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#EditPreference>)

`/api/v1/editPreference?{auth}`

  * Include “preference” in message body based on {wsdl}

example:
    
    
    http://localhost:8080/api/v1/editPreference?u=hill&p=hill
    {
      "preference": {
        "name": "system_pref_global_area_external_link_check_on_publish",
        "value": "on"
      }
    }

[ ↑ ](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#top>)


---

# Part 3: Knowledge Base Articles

*Complete documentation from the Cascade CMS Knowledge Base*


## Administration

*35 articles in this category*

### Access Rights

## Access
You can control Read/Write access to Site assets with Access Rights. Access Rights control which Users and/or Groups can view or edit assets.

To update Access Rights for an asset:
1. When viewing an asset click **More** > **Access**.
2. Choose the access level for all Users. This will be the level assigned to all Users and Groups that do not have explicit Access Rights specified. A more detailed explanation of the behavior can be found below the field.
3. Grant Access Rights to specific Users and/or Groups by selecting an access level from the drop-down menu and clicking **Choose Users and Groups**. Explicitly assigned Access Rights with a higher access level will take precedence over the access level for all users as defined above. Assigning Write level access automatically grants Read privileges as well.
4. Add more Users or Groups with their own levels as necessary.
5. If you would like to remove Access Rights from a User or Group, click on the X beside it.
6. Click **Update**.
## Access for Contents
Folder and Container assets have an additional feature called **Access for Contents** which allows update the access rights for the contents of that Folder/Container. Updating the access rights on the contents of a Folder/Container can be performed using two different strategies:
- **Merge Access Rights:** Merging will add new assignments to all contained assets where the User or Group specified is not already assigned. If the User or Group is already assigned to an asset, then the access level (Read or Write) will be updated with the new value specified. All other existing User and Group assignments will not be changed.
- **Overwrite Access Rights: **Overwriting will remove all existing User and Group assignments on all assets within a Folder and apply only those specified. Be cautious with this option. In most cases, you will want to Merge Access Rights as opposed to overwriting them.
To update Access for Contents:
1. While viewing a Folder click **More** > **Access for Contents**.
2. If you would like to assign the current Folder or Container's Access Rights to its contents, click **Copy user and group access rights from current folder**.
3. To overwrite the existing Access Rights on all contents, check the **Overwrite existing access rights on contained assets** checkbox. To merge the permissions you specify into the existing Access Rights of the Folder contents, leave this option unchecked.
4. If overwriting, choose the access level for all Users. This will be the level assigned to all Users and Groups that do not have explicit Access Rights specified. A more detailed explanation of the behavior can be found below the field. If merging, this setting will be untouched.
5. Grant Access Rights to specific Users and/or Groups by selecting an access level from the drop-down menu and clicking **Choose Users and Groups**. Explicitly assigned Access Rights with a higher access level will take precedence over the access level for all users as defined above. Assigning Write level access automatically grants Read privileges as well.
6. Add more Users or Groups with their own levels as necessary.
7. If you would like to remove Access Rights from a User or Group, click on the X beside it.
8. Click **Update**.

---

### Active Users Report

## Overview

The Active Users report provides a list of users logged into the system. The report will display the following information for all users logged in over the past 24 hours:
- **Name** - the username and full name of the user.
- **Last Viewed** - the last asset viewed by the user.
- **Last Action Time** - the time the user last performed an action. Hover over this entry in this column for an exact date/time.
- **Login Time** - the time the user last logged in. Hover over this entry in this column for an exact date/time.
## Logging Out Users
If necessary, users with **Force logout of users** enabled in their System Role can force a logout of other Cascade CMS users. Forced logouts may prove useful when clearing out users in advance of downtime or a system upgrade, during routine maintenance, or to prevent unauthorized activity, among other examples.
To force a logout:
1. Select a user or users from the list.
2. Click the **Force Logout** button at the top of the list.
If the user uses Normal or LDAP authentication, using Force Logout you will also invalidate that user's "Remember me" functionality across all browsers.

---

### Assign Step If User Trigger

## Overview
This workflow trigger is an example of a conditional workflow trigger. It examines the step that just occurred, and if it was done by the specified username, it advances the workflow to the step specified by the second parameter instead of the standard workflow step progression path.
## Declaration
```
<trigger class="com.cms.workflow.function.AssignStepIfUser" name="AssignStepIfUser"/>
```
## Usage
```
<trigger name="AssignStepIfUser"> <parameter> <name>username</name> <value>user1</value> </parameter> <parameter> <name>nextstep</name> <value>step1</value> </parameter> </trigger>
```
## Parameters
##### Username
```
<parameter> <name>username</name> <value>user1</value> </parameter>
```
##### Next Step
```
<parameter> <name>nextstep</name> <value>step1</value> </parameter>
```

---

### Assign to Specified Group Trigger

## Overview
This trigger is used to assign a workflow to a group. This trigger extends the existing group assignment functionality by allowing more control over when group assignments are made. For example, if a certain step is reachable by several other steps, and it is desired that different groups be assigned depending on which step they came from, this trigger should be used.
## Declaration
```
<trigger class="com.cms.workflow.function.AssignToSpecifiedGroup" name="AssignToSpecifiedGroup"/>
```
## Usage
```
<trigger name="AssignToSpecifiedGroup"> <parameter> <name>group</name> <value>groupname</value> </parameter> </trigger>
```
## Parameters
##### Group Assigned Parameter
```
<parameter> <name>group</name> <value>groupname</value> </parameter>
```
This is a required parameter which specifies the group that the workflow should be assigned to.
The name parameter has to be the string "group" while the value parameter can be any group name. If a specified group doesn't exist, the workflow will still be assigned to a group with that name. If such a group is created in the future, the workflow will be available for the users in that group.

---

### Audits

## Overview
Audits allow administrators to see a summary of activities performed in Cascade CMS by a particular User, Group, or Role or on a particular asset. Start/End Date and Audit Type filters are provided to help refine the audit trail.
The record for each event in the audit trail includes:
- **User** - the username of the user who performed the activity.
- **Time** - the time of the activity. Hover over this entry in this column for an exact date/time.
- **Action** - the type of action performed (login, edit, publish, etc.).
- **Information** - the information about that action such as whether the asset was edited or published, the IP address of the computer from which the user logged in, and/or a link to the location of the particular asset.
**Note** - Audits will default to displaying the past week's worth of records, this includes when no Start Date or End Date are provided. When an End Date is provided without a Start Date, one week of records prior the End Date will be displayed. Otherwise, all audits within the provided date range or between the Start Date and the current date will be returned.
## Auditing Users, Group, and Roles
To view the audit trail for a User, Group, or Role:
1. Click the system menu button ( * *) > **Administration** > **Users**, **Groups**, or **Roles**.
2. Click on the item you wish to audit and then click **More** > **Audits**.
Viewing an audit trail for a Group or Role will display the actions performed by all Users belonging to that Group or Role.
Audit Type filters for Users, Groups, and Roles include:
- Login
- Failed Login
- Logout
- Assume another User’s identity
- Resume normal identity
- User’s identity assumed by another User
- User’s identity unassumed by another User
- Started Workflow
- Advanced Workflow
- Edit
- Start Edit
- Copy
- Create
- Reference
- Delete
- Restore
- Recycle
- Delete and Unpublish
- Check-in
- Check-out
- Version Activation
- Publish
- Unpublish
- Move/Rename
## Auditing Assets
To view the audit trail for an asset:
1. While viewing an asset, click **More** > **Audits**.
Audit Type filters for assets include:
- Started WorkflowNote: Workflow actions are available in the audit trail for the User who performed the action.
Advanced Workflow
- Note: Workflow actions are available in the audit trail for the User who performed the action.
EditStart EditCopyCreateReferenceDeleteRestoreRecycleDelete and UnpublishCheck-inCheck-outVersion ActivationPublishUnpublishMove/Rename

---

### Configuring outbound proxy support for system-generated emails

## Overview
If you use a proxy for outbound connections with Cascade CMS, you may encounter error messages like the one seen below for any system-generated emails (such as workflow notification emails):
```
2020-06-24 16:01:31,504 ERROR [SendGridEmail] {User: ..., id: not specified, type: not specified} Could not send mail Workflow: ... to ... : org.apache.http.conn.HttpHostConnectException: Connect to api.sendgrid.com:443 [api.sendgrid.com...] failed: Connection refused (Connection refused)
```
As of Cascade CMS version 8.16, system-generated emails sent via SendGrid can support outbound proxies so long as your proxy host and port settings are properly configured in your `JAVA_OPTS:`
- For Linux/*nix admins, the `JAVA_OPTS` line will be located in the ``*cascade.sh* file at the root of your Cascade CMS installation.
- For Windows admins running Cascade CMS with the Windows Service, `JAVA_OPTS` can be found using the steps below:In Windows Explorer, right-click on the file *tomcat/bin/CascadeCMSw.exe*.
- Select **Run as Administrator**.
- Switch to the **Java** tab and locate the **Java Options** field.
For Windows admins running Cascade CMS via the command line, the `JAVA_OPTS` line will be located in the *cascade.bat* file at the root of your Cascade CMS installation.
Using the corresponding steps for your O/S vendor above, add the following parameters to your `JAVA_OPTS`, substituting the correct values for your outbound proxy host and port:
```
-Dhttp.proxyHost=example.com -Dhttp.proxyPort=8080 -Dhttps.proxyHost=example.com -Dhttps.proxyPort=8080
```

## Related Links
- Firewall Considerations

---

### Creating a Sitemap in Cascade CMS

## Why Create a Sitemap?
A sitemap helps search engines crawl your site more efficiently. It provides a structured list of pages, improving SEO and ensuring updates are picked up faster. Sitemaps are especially important for large sites or those with complex folder structures.
Each site in Cascade should typically have its own sitemap. If you manage multiple sites, you can also create a **sitemap index** to link to each individual sitemap, following the standard XML Sitemap Index protocol.
## Setting up the Sitemap Page
To create a sitemap, you first need a **dedicated page** with:
- A **Content Type** designed for a sitemap.
- A **Template** with a single region (usually called something like `DEFAULT` or `XML`).
- A **Configuration Set** ensuring the page publishes with a `.xml` extension.
**Key setup notes:**
- **Root Placement:** The sitemap page should live at the root of the site (`/sitemap.xml` or `/index.xml` depending on preference).
- **Template Region:** The format or block you attach will generate the entire XML output within this region.
>
**Tip:** Disable WYSIWYG fields in your sitemap content type; the output should be fully controlled by the attached Format or Block.
## Methods for Building the Sitemap
A sitemap helps search engines crawl your site more efficiently. It provides a structured list of pages, improving SEO and ensuring updates are picked up faster. Sitemaps are especially important for large sites or those with complex folder structures.
Each site in Cascade should typically have its own sitemap. If you manage multiple sites, you can also create a **sitemap index** to link to each individual sitemap, following the standard XML Sitemap Index protocol.
There are a few common methods to generate sitemap content in Cascade CMS. Each has tradeoffs between speed, flexibility, and scalability.
### 1. Using an Index Block
**Overview:**
You attach an **Index Block** to the region, with a simple **XML Format** to loop through and output links to your pages.
**Pros:**
- Very easy to set up.
- Good if you need to respect folder-level Index/Publish settings.
**Cons:**
- Slow on large sites.
- Index Blocks retrieve assets recursively at render time, so performance degrades with thousands of pages.
```
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">#foreach ($page in $indexPageList) <url> <loc>https://yoursite.com${page.path}.html</loc> </url>#end</urlset>
```
### 2. Using Cascade API Queries ( `$_.query()`)
**Overview:**
Write a **Velocity Format** that queries pages via the internal Cascade API.
**Pros:**
- Faster than Index Blocks.
- Up to **2,000** assets per query.
- Better control over fields to preload (performance boost).
**Cons:**
- Only returns assets individually set to Index/Publish.
- Ignores folder-level publish settings unless you filter manually.
- Cannot recurse folder structures like Index Blocks.
```
#set ($pages = $_.query().byContentType("Default-Page").indexableOnly(true).preloadDynamicMetadata().maxResults(-1).execute())<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">#foreach ($page in $pages) <url> <loc>https://yoursite.com${page.path}.html</loc> </url>#end</urlset>
```
### 3. Using Query Directives ( `#queryexecute`)
**Overview:**
A newer, more scalable approach that uses **directives** instead of `.execute()`. Supports **up to 100,000** results.
**Pros:**
- Massive scalability (10x higher limits than `.execute()`).
- Still relatively fast compared to Index Blocks.
**Cons:**
- Same limitations as Cascade API: doesn't "see" folder-level index/publish settings properly.
- Slightly more complex to maintain.
Example:
```
#set ($query = $_.query().byContentType("Default-Page").indexableOnly(true).preloadDynamicMetadata()) <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"> #queryexecute($query, $page) <url> <loc>https://yoursite.com${page.path}.html</loc> </url> #end </urlset>
```
## Configuration Tips for Sitemap Pages
When setting up the sitemap's **Configuration Set**, make sure to:
- Set the **Output Extension** to `.xml`.
- Enable **"Include XML Declaration in Published Files"**.
Enabling the XML Declaration ensures that your sitemap starts with:
`<?xml version="1.0" encoding="UTF-8"?>` 
This line is required for strict XML parsers and helps search engines properly validate your sitemap files.
**How to enable it:**
- Edit the Configuration Set attached to your sitemap page.
- Under **Publishing Settings**, check **Include XML Declaration in Published Files**.
- Save and republish the sitemap.
## Final Notes
- Always validate your sitemap using a [Sitemap Validator](https://www.xml-sitemaps.com/validate-xml-sitemap.html) before submitting to search engines.
- Consider setting a regular publish schedule for sitemap pages, especially for dynamic sites where URLs change often.
- Keep sitemap sizes below 50,000 URLs per file (Google’s limit) — although Cascade query size limits will usually keep you well below that.
---

---

### Display to System Name Plug-in

## Overview
This plug-in ensures that newly-created assets are given search engine friendly system names.
When using an Asset Factory with this plug-in assigned, the system name field is hidden. On submit, the plug-in takes the value in the Display Name metadata field, makes it search engine friendly, and this becomes the system name of the new asset. Making the name search engine friendly involves converting spaces to hyphens and removing any characters that are not A-Z, a-z, 0-9, hyphen, plus symbol, comma, or period.
If used with a File Asset Factory, the plug-in will also preserve the file extension, which will be appended to the system name. If no file is uploaded and the Asset Factory being used has a base asset assigned to it, then the base asset's file extension will be used. When neither a file is uploaded nor a base asset is assigned to the Asset Factory, no file extension will be preserved.
**Note** - Asset naming rules will override the system name conversion done by the plug-in if the rules conflict.
## Examples
- If a user uploads a file called *DSCN0009.jpg* and populates the Display Name field with "My House", this plug-in will set the name of the file asset to *my-house.jpg*.
- If a user creates a new file asset using an Asset Factory with a base asset named *template.html* and populates the Display Name field with "Contact Us", this plug-in will set the name of the created file asset to *contact-us.html*.
**Tip** - This plug-in and the Title to System Name Plug-in behave the same way with the exception of the metadata field used to generate the system name.

---

### External Link Checking Preferences

## Overview
External Link Checking preferences allow administrators to configure system-wide external link checking behavior and functionality. These preferences impact areas of the application such as Broken Link Report, on-submit content checks for broken links and broken link checking during the publishing process.
External Link Checking preferences are available to users who have access to the Administration Area and the ability to edit system preferences enabled in their System Role.
To edit the External Link Checking preferences, click the system menu button ( * *) > **Administration** > **External Link Checking**.
## Preferences
- **Check External Links** - Determines whether external links are checked during on-submit content checks, publishing, and the Broken Link Report generation.
- **External Link Check Timeout** - The duration (in milliseconds) the system will wait for a response for external links. The default value is 2 seconds with a maximum limit of 10 seconds.
## Valid Response Codes
Valid Response Codes can be used to exclude external links which return a non-successful response code from the remote server during on-submit content checks and publishing. The Broken Link Report will also exclude these links by default, but they can be displayed using a filter. For example, add `429` to the valid response codes if you wish to exclude all external links that returen a `429` response code. [View common HTTP response codes](https://developer.mozilla.org/en-US/docs/Web/HTTP/Status).
## Allowed URLs
Links starting with Allowed URLs will not be checked or reported by the Broken Link Report, Publish Reports, or on-submit content check for broken links. Allowed URLs can be used to permanently exclude websites which require login or otherwise block the Cascade CMS link checker from results. These URLs apply across the entire system.
- **URL** - Links starting with the given URL will not be checked or reported. If the URL uses the `https` protocol, matching links with `http` will also match.
- **Include Subdomain** - When checked, any sub-domain within the URL's hostname will match.
**Note:** adding an Allowed URL will not immediately change results of a Broken Link Report. The Allowed URL will be used during the next report generation.
## Related Links
- Broken Link Report
- Content Checks
- Publishing

---

### Groups

## Overview
A group is made up of one or more users with common permissions. Each user in the system must be given membership in at least one group, and can be given membership in multiple groups. Group role membership is passed on to the user, meaning that the user is assigned any roles that are assigned to the group(s) that the user belongs to. This is a convenient and often preferred way to easily change role memberships across groups of users.
Groups are created and populated by administrators or via a third-party authorization system (e.g. LDAP authentication). Because a group is made up of one or more users with common permissions, placing multiple users into groups is a great way to customize permissions settings. If your organization is a university, for example, as an administrator it's your job to identify groups of users who should all have similar access rights and permissions based on your content contribution and management scheme. Let’s say you have 40 professors using Cascade CMS only for managing course catalogs. These users should more than likely be placed in the same group. In addition to providing a way of assigning roles to multiple users, the group also can be specified in the folder access rights interface, giving multiple users read and/or write access to folders and folder-contained assets.
You can access the Groups menu by clicking the system menu button ( * *) > **Administration** > **Groups**. The following information will be displayed for all groups:
- **Name**
- **Number of Users**
Click on any group in the list to view its Users and Roles. Additional options are available in the **More** menu while viewing a group:
- **Workflows** - A list of the group's members' owned workflows and waiting workflows (workflows assigned to the group).
- **Locked Assets** - A list of assets currently checked out by members of the group. You can select one or more assets in the list and click the Break Lock button to discard the user's changes to the selected assets.
- **Audits** - A summary of activities performed in the system by the members of the group.
- **Delete**
## Adding a Group
To add a group to the system:
1. Click the system menu button ( * *) > **Administration** > **Groups** and click **Add Group**.
2. Enter the following:**Group Name**
3. **Users** (optional) - Select the users that should belong to the new group. Users may also be added to a group on the user level.
4. **Roles** - Select the desired System Role of the group. This role governs the group's members' access to administrative, non-content areas. The user's actual role abilities are determined by the highest overall permissions when taking into account the user's role(s) AND the roles of the group(s) the user belongs to.
Click **Submit**.**Note**: It is not possible to modify the **Group Name **for a Group after it has been created.
## Related Links
- How do I give a User or Group access to a Site?

---

### How can I check what a User can do in a specific Site?

## Overview
A user’s abilities in a Site will be determined by the Site Role that they are assigned to for that Site. There are a couple of very handy tools that you can use to quickly identify how your Users are configured.
## Effective Abilities Tool
The Effective Abilities tool allows you to get an overview of the abilities a User will inherit for a specific Site based on their Site Role. To use the tool:
1. Click **Administration**.
2. Click **Users**.
3. Click the User in question.
4. Click **More > Effective Abilities**.
5. Select the Site in question.
Once a Site is selected, you'll be presented with a list of Site Role Abilities along with whether or not those abilities are enabled for the user in that Site.
## Assume Identity Tool
This tool can be used not only to get a quick visual representation of what a user sees in the system, but also what they can do in different Sites. To use the tool:
1. Click **Administration**.
2. Click **Users**.
3. Click the User in question.
4. Click **More > Assume Identity**.
After assuming a user’s identity, you'll see what the user sees when they're logged into the system. You can switch back to your identity by clicking on your user avatar or letter in the top-right hand corner of the interface and then clicking **Resume normal identity**.

## Related Links
- Users

---

### How can I redesign a site using our existing content?

The following setup allows you to develop a new site design, using current site content, alongside your current design:
- Edit your site's Configurations and add a new Output. This Output will use your new Templates, Blocks, and/or Formats.
- Edit your site's Content Types and configure the Publish Options so that the new Output publishes to your test or development Destination(s).
When it comes time to make your new design live:
- Edit your site's Configurations and make the new Output the default, and disable the previous Output.
- Edit your site's Content Types and configure the Publish Options so that the new Output publishes to your production Destination(s).

---

### How do I change the name or URL of my site?

To change the name and/or URL of your Site:
1. Access your Site from the **Sites** system menu, the Site drop-down menu, or the **My Sites** widget on your dashboard.
2. Once inside your Site, click **Manage Site > Site Settings**.
3. Update the **Name** and/or **URL** field in the **Properties** tab.
4. Click **Submit**.

## Related Links
- Sites

---

### How do I give a User or Group access to a Site?

In order to access a Site via the Site drop down menu, a User must have a Site Role assigned to them at the Site level (either directly or via their Group membership).
To see which Users/Groups have Site Roles assigned to them for a specific Site:
- Navigate to **Manage Site > Site Settings**.
- Click the **Roles** tab.
To assign a User/Group to a Site Role:
- If the Site Role has already been added to the Site, click the **Choose Users/Groups** button to assign the User or Group to that Site Role.
- If the Site Role has not been added to the Site yet, add it by clicking the **Choose Roles** button, then click the **Choose Users/Groups** button to assign the User or Group to that Site Role.
**Tip**: If your User(s) still can't browse to a Site despite having a Site Role assigned to them, make sure that they have at least **Read** access to the Base Folder of the Site in question. See Access Rights for more information.
## Related Links
- Permissions
- Access Rights

---

### How do I make an XML sitemap?

An XML sitemap can help inform search engines about pages in your site that are available to crawl and the date they were last modified. We have an example [SEO Sitemap * *](https://github.com/hannonhill/Velocity-Cookbook/tree/master/Sitemap-SEO) Velocity Format which can be applied to an Index Block configured to index your site.
Here are the steps to create a basic XML sitemap:
1. Create a Velocity Format containing the following, replacing `"https://www.example.com"` with the URL of your site and `".html"` with the file extension of your pages, if not HTML: ``` ## Root domain where website is hosted#set ($websiteURL = "https://www.example.com")## Page extension#set ($extension = ".html")#set ($pages = $_XPathTool.selectNodes($contentRoot, "//system-page[is-published][last-published-on]"))<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">#foreach ($p in $pages) #set ($path = $p.getChild("path").value) #set ($last = $p.getChild("last-modified")) <url> <loc>${websiteURL}${path}${extension}</loc> <lastmod>#showDate($last.value, 'yyyy-MM-dd')</lastmod> </url>#end</urlset>#macro (showDate $dateValue $formatString) #if ($dateValue != "") #set ($dateObject = $_DateTool.getDate($dateValue)) #else #set ($dateObject = $_DateTool.getDate()) #end #set ($dateString = $_DateTool.format($formatString, $dateObject)) ${dateString}#end ```
2. Create a Template containing a single `DEFAULT` region: ``` <system-region name="DEFAULT"/> ```
3. Create an Index Block with the following settings: - **Index type** - "Folder Index" - **Index folder** - Select the base folder of your site. - **Rendering behavior** - "Render normally, starting at the indexed folder" - **Depth of index** - Set as needed to index the pages in your site. - **Max rendered assets** - Set as needed to index the pages in your site. - **Indexed asset content** - Select "Regular Content" and "System Metadata". - **Indexed asset types** - "Pages" - **Page XML** - "Do not render page XML inline" - **Sort method** - URLs can be in any order in a sitemap, so choose the order that works best for you.
4. Create a Configuration and an Output with the following settings:** - **Type of data** - "XML" - **File extension** - ".xml" - **Template** - Choose the Template you created earlier. - Check the **Publishable** setting. - Check the **Include XML Declaration in Published Files** setting. - In the **Regions** area, assign the sitemap Index Block and Format to the `DEFAULT` region.
5. Create a Content Type and select the sitemap Configuration and Metadata Set of your choice. - A Data Definition/WYSIWYG isn't used for this application.
6. Create a new page in the base folder of your site using the sitemap Content Type.
Note** - Index Blocks won't pick up pages that are non-indexable (have **Include when indexing** unchecked) or whose folder hierarchy prevents them from being indexed.**Tip** - You can add additional `url` tags to your sitemap such as `changefreq` or `priority` by using custom metadata fields in your pages, just make sure that your sitemap Index Block also indexes "User Metadata".
## Related Links
- Index Blocks

---

### Permissions

Permissions in Cascade CMS consist of roles, which govern a user's abilities and access to sites or the administration area, and access rights, which allow users to view or edit assets.

---

### Preserve Current User Trigger

## Overview
This trigger acts as a solution for an issue that sometimes arises when you submit a workflow to a group instead of a user.
Typically, if you choose Assign to Me when receiving that group workflow step, the system will only temporarily give you ownership of the step. If you choose Edit, the system will return ownership of the asset back to the group; that will allow it to be picked up by another user in the group who would then be routed to the edit screen.
This trigger is used to keep the user who originally clicked Assign to Me in memory for the duration of the workflow. This way when a user makes changes and submits the asset back to the original user, who then reviews it, the asset will not go back to the group but to the user (who selected Assign to Me) for publishing.
## Declaration
```
<trigger class="com.cms.workflow.function.PreserveCurrentUser" name="PreserveCurrentUser"/>
```
## Usage
```
<trigger name="PreserveCurrentUser"/>
```
For example, if you have a step assigned to a group and one of the options was to "Edit" as well as a separate option to "Approve", you would put the Preserve Current User Trigger as a trigger for both steps, assuming you want the user preserved instead of the group assignment.
## Parameters
None.

---

### Role Abilities

## Overview
Abilities are individual actions that Cascade CMS users are capable of making. Some actions are very basic, like being able to view the Publish Queue. Others - like being able to change the LDAP setup - are a bit more important, but both are controlled by role abilities.
Roles and their abilities apply in two contexts: **System** and **Site**. A System Role primarily governs access to administrative, non-content areas of Cascade CMS. For example, the ability to create new sites and groups, users, and roles will fall within the control of a System Role. Essentially, if it doesn't have to do with a Site, it will be a System ability.
A Site Role is assigned specifically to a site and applies to a site only. For example, the ability to publish content or to bypass workflow within a site are only going to apply when the Site Role is assigned to a specific site.
The permissions tables below outline the available System and Site Role abilities.
**Note** - Abilities are cumulative. When assigning multiple roles to a user, they will inherit all overlapping abilities between those roles.
## System Role Abilities
#### System Abilities
| Ability | Required Abilities | Description |
| --- | --- | --- |
| Bypass all permissions checks |   | Gives read and write access to all assets. |
#### Site Management Abilities
| Ability | Required Abilities | Description |
| --- | --- | --- |
| Access the Site Management Area |   | Ability to access the Site Management area to create edit or delete sites. |
| Access All Sites |   | Ability to access the Home area of all sites. |
| Create Sites |   | Ability to create new sites. |
#### Administration Area Abilities
| Ability | Required Abilities | Description |
| --- | --- | --- |
| Access the Administration Area |   | Controls who can navigate to the Administration Area.  |
| Access Users, Groups, and Roles | Access the Administration Area | *Gives the ability to access Users, Groups, and Roles. |
| View Information and Logs and Send Support Request in Administration Area | Access the Administration Area | Gives the ability to view and download system information and logs. |
| Force logout of users | Access the Administration Area | Gives the ability to log out other users from the system. |
| Access/Modify Default WYSIWYG Editor Configuration | Access the Administration Area | Allows users to access and update WYSIWYG editor configurations in the Manage Site area for the site. Because there are no individual permissions or containers for editor configurations, users with this ability will have access to all of the site’s editor configurations.All users who have access to update the site’s settings can choose a default editor configuration, regardless of this ability. |
| Modify Dictionary | Access the Administration Area or Access the Manage Site Area (Site Role) | Allows users to access and edit the System Dictionary. |
* *Having the ability to access a particular administration area asset does not circumvent access rights applied to assets of that type.

#### Home Area Abilities
| Ability | Required Abilities | Description |
| --- | --- | --- |
| Edit Access Rights |   | Ability to change access rights to the assets to which the user has write permission by assigning the groups and users that the user has abilities to view. |
| View the Audits Tab |   | Ability to view the audits of assets to which the user has read permission. |
#### Tools Abilities
| Ability | Required Abilities | Description |
| --- | --- | --- |
| Optimize Database |   | Ability to use the Database Optimizer tool. |
| Sync LDAP |   | Ability to trigger an LDAP synchronization. |
| Modify Logging |   | Ability to choose different classes/packages that should be outputting logging information. |
| Search and Indexing |   | Ability to access the Searching and Indexing tool. |
| Modify Configuration Files |   | Ability to access Custom Authentication Configuration, Image Editor Configuration, Image Editor Licence, LDAP Configuration, Product License and Publish Trigger Configuration. |
| Announcements |   | Ability to create and send system-wide announcements. |
| Database Export Tool |   | Ability to use the Database Export Tool. |
| Edit System Preferences |   | Ability to access and change General, Email, and Content Preferences. |
#### Security Area Abilities
| Ability | Required Abilities | Description |
| --- | --- | --- |
| View users that share groups with current user | Access Users, Groups and Roles | Ability to view users of the same group as the current user. |
| View all users | Access Users, Groups and Roles | Ability to view all users. |
| Create users | Access Users, Groups and Roles, either View all users or View users that share groups with current user | Ability to create new users. |
| Delete users that share groups with current user | Access Users, Groups and Roles, either Edit all users or Edit users that share groups with current user | Ability to delete users of the same group as the current user and at the same time the current user must be able to edit the user. |
| Delete all users | Access Users, Groups and Roles, either Edit all users or Edit users that share groups with current user | Ability to delete any users that the current user is able to edit. |
| Edit all users | Access Users, Groups and Roles, either View all users or View users that share groups with current user | Ability to edit any users. |
| Edit users that share groups with current user | Access Users, Groups and Roles, either View all users or View users that share groups with current user | Ability to edit users of the same group as the current user. |
| View groups to which current user belongs | Access Users, Groups and Roles | Ability to view the current user's groups. |
| View all groups | Access Users, Groups and Roles | Ability to view all groups. |
| Create groups | Access Users, Groups and Roles, either View all groups or  View groups to which current user belongs | Ability to create new groups. |
| Delete groups to which current user belongs | Access Users, Groups and Roles, either Edit all groups or  Edit groups to which the current user belongs | Ability to delete the current user's groups that the current user can edit. |
| Delete all groups | Access Users, Groups and Roles, either Edit all groups or  Edit groups to which the current user belongs | Ability to delete any groups that the current user can edit. |
| Edit all groups | Access Users, Groups and Roles, either View all groups or  View groups to which current user belongs | Ability to edit any groups. |
| Edit groups to which the current user belongs | Access Users, Groups and Roles, either View all groups or  View groups to which current user belongs | Ability to edit the current user's groups. |
| Access Roles | Access Users, Groups and Roles | *Ability to view all roles in the system. |
| Create Roles | Access Users, Groups and Roles | *Ability to create roles in the system. |
* *Having the ability to access a particular administration area asset does not circumvent access rights applied to assets of that type.*
## Site Role Abilities
#### System Abilities
| Ability | Required Abilities | Description |
| --- | --- | --- |
| Bypass all permissions checks |   | Gives read and write access to all assets in the site. |
#### Administration Area Abilities
| Ability | Required Abilities | Description |
| --- | --- | --- |
| Access the Manage Site Area |   | Ability to access the Manage Site area.  |
| Access Asset Factories | Access the Manage Site Area | *Gives the ability to access Asset Factories. |
| Access Configurations | Access the Manage Site Area | *Gives the ability to access Configurations. |
| Access Connectors | Access the Manage Site Area | *Gives the ability to access Connectors |
| Access Content Types | Access the Manage Site Area | *Gives the ability to access Content Types. |
| Access Data Definitions | Access the Manage Site Area | *Gives the ability to access Data Definitions. |
| Access Shared Fields | Access the Manage Site Area | *Gives the ability to access Shared Fields. |
| Access Metadata Sets | Access the Manage Site Area | *Gives the ability to access Metadata Sets. |
| Access Publish Sets | Access the Manage Site Area | *Gives the ability to access Publish Sets. |
| Access Destinations | Access the Manage Site Area | *Gives the ability to access Destinations. |
| Access Transports | Access the Manage Site Area | *Gives the ability to access Transports. |
| Access Workflow Definitions | Access the Manage Site Area | *Gives the ability to access Workflow Definitions. |
| Run Transports and Destination Diagnostic Tests | Access the Manage Site Area and access to at least one of these: Transports, Destinations | Gives the ability to test Transports and Destinations. |
| Access/Modify Site's WYSIWYG Editor Configurations | Access the Manage Site Area |   |
| Publish Readable Administration Area Assets | Access the Manage Site Area and access to at least one of these: Publish Sets, Destinations | Ability to publish Administration Area assets (Publish Sets and Destinations) to which the user has read permission. |
| Publish Writeable Administration Area Assets | Access the Manage Site Area and access to at least one of these: Publish Sets, Destinations | Ability to publish Administration Area assets (Publish Sets and Destinations) to which the user has write permission. |
* *Having the ability to access a particular administration asset does not circumvent access rights applied to assets of that type.

#### Home Area Abilities
| Ability | Required Abilities | Description |
| --- | --- | --- |
| Bypass workflow |   | Ability to bypass workflow when creating, editing, copying and deleting assets. |
| Assign to self and approve steps in a workflow |   | Ability to assign workflow steps to the current user and to be assigned to transition steps in a workflow. |
| Delete workflows |   | Ability to delete workflow. |
| Assign workflows to folders |   | When user has edit access to a folder, they can also assign workflows to that folder. |
| Upload images in file chooser |   | When editing an XHTML block or a page with a WYSIWYG editor, ability to upload images through that editor. Ability to upload images through File choosers. Folders restricted by workflow can not be selected. |
| Multi-select copy | Bypass workflow | Ability to copy several assets at the same time. |
| Multi-select publish | Publish either readable or writeable Home Area assets | Ability to publish several assets at the same time. |
| Multi-select move | Bypass workflow | Ability to move several assets at the same time. |
| Multi-select delete | Bypass workflow | Ability to delete several assets at the same time. |
| Modify outputs on pages |   | Ability to assign different blocks and formats at the page level when editing a page. |
| Modify the Content Type of pages |   | Ability to assign a different Content Type to a page when editing it. |
| Bypass WYSIWYG editor restrictions |   | Ability to access restricted elements in the WYSIWYG editor configuration. |
| Bypass Accessibility, Link and Spell Checks when submitting content changes |   | Ability to bypass content checks enabled at the system or site level. |
| Modify Data Definitions of Pages and Blocks |   | Ability to assign or update a Data Definition assignment in pages and Data Definition blocks. |
| Move or Rename assets |   | Ability to move or rename assets. |
| Publish readable Home area assets |   | Ability to publish Home area assets to which the user has read permission. |
| Publish writeable Home area assets |   | Ability to publish Home area assets to which the user has write permission. |
| View the publish queue |   | Ability to view the Publish Queue in a particular site. |
| Reorder the publish queue | View the publish queue | Ability to reorder jobs in a site's publish queue. |
| Cancel publish jobs | View the publish queue | Ability to cancel jobs in a site's publish queue. |
| Edit access rights |   | Ability to change access rights to the assets to which the user has write permission by assigning the groups and users that the user has abilities to view. |
| View the Versions tab |   | Ability to view previous versions of assets to which the user has read permissions. |
| Activate or delete previous asset versions |   | Ability to activate or delete previous versions of assets to which the user has write permission. |
| View the Audits tab |   | Ability to view the audits of assets to which the user has read permission. |
| Break locks on assets |   | Ability to break a lock on assets so that the users who were editing the asset previously won't be able to submit their edits and the asset will become available for another user to edit it. |
| View Asset Factories in New menu even if user does not belong to any of their applicable groups |   | Ability to see all the site's Asset Factories in the new menu. |
| Choose Destinations to publish to even if user does not belong to any of their applicable groups | Publish either readable or writeable Home area assets | Ability to choose any destinations that are applicable for publishing. |
| Be assigned to and use Workflow Definitions even if user does not belong to any of their applicable groups |   | Ability to start any workflows that are applicable for the asset. |
| Notify users by email about stale content |   | Ability to send email notifications from the Stale Content Report. |
| Access site-wide broken link report |   | Ability to access the Broken Links Report. |
| Mark broken links as fixed on the site-wide broken link report |   | Ability to mark links as fixed in the Broken Links Report. |
#### Tools Abilities
| Ability | Required Abilities | Description |
| --- | --- | --- |
| Zip Archive |   | Ability to upload and unpack a zip archive. |
| Bulk Change | Bypass workflow | Ability to use the Bulk Change tool. |
| View and Restore only assets the current user deleted |   | Ability to view and restore assets in the Trash that have been deleted by the current user. |
| View and Restore all assets in the Trash |   | Ability to view and restore assets in the Trash that have been deleted by the current user or any other user. |
| Permanently remove assets from the Trash |   | Ability to remove assets from the Trash which permanently removes them from the system. |
#### Integrations Abilities
| Ability | Required Abilities | Description |
| --- | --- | --- |
| Access Siteimprove integration |   | Ability to access the Siteimprove integration when viewing folders and pages. |

---

### Roles

## Overview
A role is a set of a abilities that governs a user's access to a number of different areas in Cascade CMS. They can be assigned to a user directly, to any of the user's groups, or to a site to which the user requires access. Roles are not to be confused with Access Rights which control read and write access to specific assets.
There are two types of roles in the system: **System Roles** and **Site Roles**. These two role types have many abilities in common, but they apply within different contexts. System Roles are applicable in the Administration Area and cannot be assigned to sites. Site Roles, as you may have guessed, are applicable to sites. Site Roles, however, do not control access to tools and areas of the system that are not specific to a particular site. For example, access to the Sites menu is governed by a user's System Role because the Sites menu can be accessed from anywhere in the system and is not specific to any particular site.
You can access the Roles menu by clicking the system menu button ( * *) > **Administration** > **Roles**. The following information will be displayed for all roles:
- **Name**
- **Type** - You can filter roles by their type (System or Site) using the filter button.
Click on any role in the list to view its:
- **Abilities** - A list of role abilities and whether they are enabled or disabled for this role.
- **Users** - A list of users to which the role is assigned either directly or through one or more of their groups. For Site Roles, a list of sites in which the user is assigned the role either directly or through one of their groups will be provided.
- **Groups** - A list of groups to which the role is assigned. For Site Roles, a list of sites in which the group is assigned the role will be provided.
- **Sites** (for Site Roles) - A list of sites to which the role is assigned.
Additional options are available in the **More** menu while viewing a role:
- **Relationships** - A list of assets to which the role is linked. For System Roles, this will be users and groups to which the role is directly assigned. For Site Roles, this will be sites to which the role is assigned.
- **Audits** - A summary of activities performed in the system by all users who are assigned this role.
- **Access** - The read/write permissions for the role asset itself.
- **Delete**
## Effective Roles
In order to figure out whether or not a user has access to an area in the system, Cascade CMS must first determine the user's effective role which includes all of that user's abilities across all of his or her roles in a particular context. The context being either a Site or a System area.
A user's effective System Role is determined by taking all of the roles assigned to the user's groups and all of the roles assigned to the user directly and "summing" them. For example, if a user is assigned a contributor role and the user's group is assigned a manager role, then the user effectively has all of the abilities in the contributor role as well as all of the abilities in the manager role when in the System area.
A user's effective Site Role is determined a little differently, because Site Roles are assigned to sites directly. The effective Site Role is also only applicable when in a particular Site. Nevertheless, the same principle of summing the abilities for all of a user's Site Roles still applies (including those roles that are assigned to the user's groups).
Be aware that while in a site, System Roles will still apply for abilities not contained in Site Roles. As mentioned earlier, access to the publish queue is controlled by System Roles; therefore, a user's effective System Role still applies for this ability when inside a Site.
To see what effective abilities a user has in a particular Site, click **More** > **Effective Abilities** while viewing a user and select a site from the drop-down menu.
## Adding a Role
To add a role to the system:
1. Click the system menu button ( * *) > **Administration** > **Roles** and click **Add Role**.
2. Choose **System** or **Site** role.
3. All role abilities for a new role are disabled by default. Enable the abilities you want users assigned this role to inherit by clicking the checkbox next to the applicable role. You can also select a role to use as a template for the new role from the **Based on original role** drop-down.
4. Click **Submit**.
## Assigning System Roles
To assign a System Role to a User or Group:
1. Click the system menu button ( * *) > **Administration** > **Users** or **Groups**.
2. Select the user or group and click **Edit**.
3. In the **Membership and Roles** tab, click **Choose Roles** and select one or more System Roles to assign to the user or group. Any System Roles that have already been assigned to the user or group will be checked. Click **Choose**, and notice that the newly assigned roles are now displayed in the Membership and Roles tab.
4. Click **Submit**.
## Assigning Site Roles
See article "How do I give a User or Group access to a Site?"

---

### Site Import and Export

## Overview
Cascade CMS supports the transfer of content and administrative properties from one Cascade CMS environment to another by way of exporting and importing Sites.
Site Export allows you to take all of the content in a particular Site and generate an export file that can be transferred to and imported into another Cascade instance.
Site Import allows users to import a Site export file back into Cascade.
## Site Export
To export a Site:
1. Click **Manage Site** > **More** > **Export Site**.
2. Click **Export**.
This will generate a zipped Site export file with the Site name as the filename with the extension `.csse`. The export can be imported as a new Site into any Cascade CMS instance of the same version.
After the export is started, *it can take several minutes to several hours* to prepare the export file (depending on the size of the Site). Once the file is ready, the download will start.
What's included?
- Current versions of assets. Previous versions of assets are not included in the export.
- Asset permissions. The same Users and Groups need to exist in the system where the export is imported in order for the permissions to be mapped correctly.
**Note** - Do not navigate away from the Export page until the download begins. Please limit any changes made to the contents of the Site being exported until the export has completed, this will ensure a consistent export.
## Site Import

To import a Site using an Site export file:
1. Click the system menu button (  *) > **Sites**.
2. Click **Import Site**.
3. Enter a name for the Site and drag and drop or choose the export file from your local file system (alternatively, the export file can be hosted on a web server and referenced via URL).
4. Click the **Import** button to begin the import process.
**Note** - Site export files larger than 2 GB cannot be imported via the file chooser. Please host the export file on a server and use the URL import method.
## Site Import Report
Once the import has finished, a report is sent via an internal message to the user who initiated the import. This report will contain information about any issues that may have come up during the import and is broken down into Miscellaneous Problems, Errors, Warnings, and Suggestions.
- **Miscellaneous Problems** are problems that do not correspond to specific assets and are therefore listed separately.  In general these are issues that result in some or all assets not being imported.
- **Errors** are listed by asset and indicate that a particular asset in the export file could not be imported properly.
- **Warnings** are also listed by asset and indicate that an asset could be imported but it may be missing some information.
- **Suggestions** are tips for resolving issues that might have occurred during the import
**Note** - Cascade CMS does not officially support the import of sites from newer environments to older environments (running Cascade Server, for example). You can, however, import content from older environments into newer environments.

---

### Siteimprove Integration

## Overview
Cascade CMS's Siteimprove plugin allows existing Siteimprove customers to access data from the [Siteimprove Intelligence Platform ](https://siteimprove.com) from within the CMS. It enables you and your team to review the quality of your content and correct content quality issues related to accessibility, broken links, SEO, and more within your CMS authoring environment.

The plugin overlays data whenever you visit a Page within a Site where the integration is enabled. It is made up of three areas:
- A Live page score and lists of issues with content quality
- A Prepublish view with the ability to check content before it goes live and highlight relevant issues on the page(**additional subscription** required)
- Unpublish risks to assess the risk of unpublishing or removing a page from your site when it comes to SEO and broken links.
The Siteimprove integration provides insights into:
- Accessibility issues
- Misspellings and broken links
- Readability levels
- Policies - how well the content adheres to any organization specified policies
- SEO: technical, content, UX, and mobile
- Page visits and page views
- The impact of unpublishing a specific page
The exact layout depends on which modules you have enabled in Siteimprove.
**Note** - The Siteimprove service is separate from Cascade CMS and is not included with the cost of your Cascade CMS subscription.
## Enabling the Siteimprove Integration
#### At the System Level
To enable the Siteimprove integration for your environment:
1. Click the system menu button ( * *) > **Administration** > **Preferences **>** Integrations & Plugins**.
2. Under **Siteimprove Settings** enable the **Enable Siteimprove Plugin** option.
3. Optionally, enable **Do not include "index" in Siteimprove URLs**. - Select this option if the index pages for your site appear as *https://www.example.com/about/* in Siteimprove as opposed to *https://www.example.com/about/index.html.*
4. **Submit** your changes.
**Note** - This plugin requires a secure HTTPS connection to connect and exchange information with the Siteimprove service. Please ensure SSL is configured for your instance before enabling it.
#### At the Site Level
To enable the Siteimprove integration for a site:
1. Ensure the Siteimprove integration is enabled at the system level (see above).
2. Navigate to **Manage Site** > **Site Settings**.
3. Toggle the **Enable Siteimprove Integration** option.
4. **Submit** your changes.
#### At the Site Role Level
To enable User/Group access to the Siteimprove overlay:
1. Ensure the Siteimprove integration is enabled at the system and site levels (see above).
2. Review the Site Roles assigned to your site under **Manage Site** > **Site Settings** > **Roles**.
3. Edit the appropriate Site Role under **Administration** > **Roles**.
4. Toggle the **Access the Siteimprove integration** ability.
5. **Submit** your changes.
## Logging into the Siteimprove Integration
If you have a user account in Siteimprove, you can log into the Siteimprove overlay with your credentials after it has been enabled. Your user role and permissions in Siteimprove will determine which sites you can see data for in the overlay.
To log in to the Siteimprove integration, navigate to an enabled site and you'll see the Siteimprove badge on the right-hand side of the interface:

After clicking here, you'll be prompted to enter your Siteimprove credentials.
**Note** - The first login will need to be by a Siteimprove Account Owner who can accept the plugin’s Terms and Conditions. Afterwards, each Siteimprove user will be able to login with their own credentials.
## Viewing Siteimprove Data
To view Siteimprove data for a page, navigate to the page within Cascade CMS and open the overlay by clicking on the Siteimprove badge. 
If you're not seeing data for your page in the overlay, ensure that:
- Your site has been imported into your Siteimprove account.
- The **Site URL** for your site in Cascade CMS is the same as the URL that appears in your Siteimprove inventory. If not, set the [Siteimprove URL](#SettingtheSiteimproveURL) in Site Settings.
- Your page has been published.
- Your page has been crawled by Siteimprove and appears in your inventory.
## Sending Re-Check Requests to Siteimprove
Publishing a page will send a recheck request for the page to Siteimprove. You can also use the **Recheck published page** button at the bottom of the Live page tab of the plugin to send a manual request for Siteimprove to recheck the content on the live site.
Publishing a Folder, Site, or Destination will send a recheck request for all successfully-published pages contained in the publish job.
**Note** - Only publishes by a user will send a recheck request to Siteimprove. Scheduled publishes will not trigger a recheck request.
## Configuring your Siteimprove URL
If the URL of your site in Siteimprove is different than the **Site URL** of your site in Cascade CMS, specify your Siteimprove URL under **Manage Site** > **Site Settings** > **Siteimprove URL**.
## Deep Linking in Siteimprove
To make correcting issues in your content easier, Siteimprove offers "[CMS Deeplinking](https://help.siteimprove.com/support/solutions/articles/80000448272-what-is-cms-deeplinking)". Deeplinking creates links to your page assets in Cascade CMS from within reports in your Siteimprove account. To do this, the Cascade CMS ID of your page assets needs to be included in the page's published source.
You can include a page's ID in your Template(s) with a simple region and Velocity format:
1. Create a Velocity Format containing the following: ``` <meta name="id" content="${currentPage.identifier.id}"/> ```
2. Create a new region within the `<head>` tags of your Template(s). Example: ``` <!-- Page ID for Siteimprove deep linking. --><system-region name="PAGE_ID"/> ```
3. Attach your Format to this new region in your Template(s).
4. Publish all pages that use the Template(s) to ensure that your page ID `<meta>` tag gets included the pages on your web server.
## Local Plugin Settings
To adjust your personal plugin settings, click the Settings icon in the top right corner of the plugin frame. Here you can choose whether to have the overlay displayed on the right or the left side of the content window.

## Siteimprove Prepublish functionality
Siteimprove is capable of checking content before it is published using its Prepublish feature. This feature is a separate paid service. Contact your Siteimprove customer success representative to find out more.
To enable this functionality for accounts with a valid Prepublish subscription:
1. In Siteimprove: - Ensure that your account has the Prepublish functionality enabled. - Locate/Create a Siteimprove API user with the "admin" or "owner" role. - Create API credentials for that user (*Main Menu > Integrations > API*).
2. In Cascade CMS: - In the Siteimprove Settings, check **Allow for Siteimprove Prepublish checks** (as seen in the image below). - Provide the API user credentials for the Siteimprove API user. - Click the **Verify** button to verify the Siteimprove account. - Click **Submit**. (Note: errors usually indicate that the Prepublish feature is not enabled or that the wrong API key was input)
Once the Siteimprove Prepublish functionality is verified and submitted, you can perform Prepublish checks by clicking the **Prepublish view **tab within the plugin overlay. If you don't currently see any prepublish results listed, click the **Run content check** button at the bottom to generate results for the Page. For Pages with results already listed, you can click **Recheck draft** to update those results.
For issues listed, you can use the plugin to highlight where in the page content the issue appears and explore remediation guidance.
This option is available not only while viewing the current version of a Page, but also for previous Versions, Drafts, and Working Copies.

---

### Sites

Sites are containers for organizing all content and administrative assets and properties for a website in Cascade CMS.

---

### System Dictionary

## Overview
The system dictionary is a centrally-managed collection of words that is used when performing spelling content checks or when using the spellcheck feature in the WYSIWYG.
You can access the system dictionary by clicking the system menu button (  ) > **Administration** > **System Dictionary**.
There are two types of system dictionary words:
- **Custom** - Words that have been manually added to the dictionary; these words are editable.
- **Internal** - A pre-populated collection of common words in English; these words are not editable.
## Adding Words
To add words to the dictionary from the System Dictionary screen:
- Click the system menu button (  ) > **Administration** > **System Dictionary**.
- Click **Add**.
- Enter one or more words in the text area, separating each word with a new line. Words with spaces between them will be separated into multiple words on submit.
- Alternately, drag and drop a newline-separated, plain-text file containing your words into the text area.
- Click **Submit**.
To add words to the dictionary during a spelling content check:
- Ensure the spelling content check is enabled for your site.
- After editing an asset, click **Check Content & Submit**.
- Click **Add** next to one or more flagged words.
- Click submit (  ).
To add words to the dictionary in the WYSIWYG:
- In the WYSIWYG, click **Tools** > **Spellcheck**.
- Misspelled words will be underlined in red.
- Click the flagged word(s) and select **Add to Dictionary**.
**Note** - Only users with the **Modify Dictionary** ability enabled in their System Role can add words to the system dictionary.
## Exporting the Dictionary
To export the dictionary (for example, to import into another instance of Cascade CMS):
1. Click the system menu button (  ) > **Administration** > **System Dictionary**.
2. Click **More** > **Export**.
3. A newline-separated, plain-text file containing your custom dictionary words will be downloaded.
## Copying a User Dictionary (Legacy)
In previous versions of Cascade CMS, users could add words only to their own private dictionary. The system dictionary is now centrally-managed so all users are presented with the same set of words during spell checks. To avoid manually re-entering custom words in the system dictionary, you may wish to import words from one or more users' legacy dictionaries.
To copy words from a user's dictionary:
1. Click the system menu button (  ) > **Administration** > **System Dictionary**.
2. Click **More** > **Copy Words From User**.
3. Unique words (those not already in the system dictionary) from the user's legacy dictionary will be appended to the system dictionary.

---

### System Preferences

## Overview
System preferences allow administrators to configure system-wide properties such as email, link checking, and content settings.
System preferences are available to users who have access to the Administration Area and the ability to edit system preferences enabled in their System Role.
To edit the system preferences, click the system menu button ( * *) > **Administration** > **Preferences**.
## System
The options within the System tab allow you to customize basic system-wide preferences.
##### General
- **System Name** - This name appears on the login screen and at the bottom of the system menu flyout panel.
- **System URL** - The address used when accessing the system; this is required for links in email notifications sent by the system.
- **System Label Color** - This option configures the color of the top menu bar in the interface and can be used to distinguish production instances from test or development instances, for example.
##### SSL/TLS Key Store
- **Key Store Path** - Specifies the location of the SSL key store on the application server.
- **Key Store Password** - Specifies the password to the key store on the application server.
Note: changes to either Key Store preference requires a restart of the application in order for the changes to take effect.
##### Other
- **Session Timeout** - The duration (in minutes) that a user's session can remain inactive before being automatically logged out by the system. Any value less than 0 will be interpreted as 60 minutes.
- If a user logs out manually their session will be ended.
**License Expiration Notification** - The number of days ahead of the instance's licence expiration date that an expiration warning message should appear in the interface.
## Email
Email options allow configuration of an SMTP server to send email for certain system-generated notifications including LDAP synchronization notifications and Task assignment notifications.
- **SMTP Host** - SMTP server hostname or IP address.
- **SMTP Port** - SMTP server port.
- **Secure SMTP** - Enable to use secure SMTP.
- **SMTP Username** - Username to authenticate against the SMTP server.
- **SMTP Password** - Password to authenticate with the specified username against the SMTP server.
- **SMTP From Address** - The email address the system will send emails from.
- **Max Wait Time** - The maximum duration (in seconds) to wait before attempting to send the next batch of emails. Use this to minimize frequency of emails sent to the SMTP server.
- **Max Queued Emails** - The maximum number of emails to be queued before system will empty the queue. Use this to minimize frequency of emails sent to the SMTP server.
- **Email Test** - Test the email settings by sending a test message to the address specified.
**Note**: Workflow notifications, Daily Content Reports, and Review Date notifications are sent via a built-in email service and those emails will come from *noreply@cascadecms.com*.
## Content
Content options provide more detailed customization for how the system handles various types of content.
##### General
- **Maximum File Upload Size** - Determines the maximum size for any uploaded files, including file assets and site imports.This can be used to restrict the upload of large images and video files, for example, and can be restricted further at the Asset Factory level with a plugin for more specific size limitations.
- This value is limited by the database, which is based on the maximum BLOB size allowed (`max_packet_size` and 10% of `innodb_log_file_size` for MySQL). The maximum value allowed is 512MB (524288KB) to help prevent system instability.
- Site imports via file upload and uploading zip files for unpacking are not restricted to this preference, instead, they are limited to 2GB based on browser limitations.
**Content Checks** - Configure the default content checks that will be run when assets are submitted if the site has **Inherit from system preferences** selected in its Site Settings.
##### Assets
- **Appearance of Asset Links** - Determines whether assets are displayed by their Title / Display Name or their system name for users who have not already saved this preference in their user settings.
- **Max Asset Versions** - Determines the maximum number of versions that will be stored for any given asset. Once the maximum number of versions is reached, the oldest version is removed.
- **Editable Text File Extensions** - Determines the types of text files that are editable in the system's code editor.
- **Editable Image File Extensions** - Determines the types of image files that are editable in the system's image editor.
- **Expiration Warning** - Determines how soon in advance of an asset's expiration a user will be notified via an internal notification.
##### Asset Naming Rules
- **Asset Naming Rules** - Asset naming rules configured at the system level will be enforced for Sites which have the **Inherit from system preferences** selected in its Site Settings. Note that changes to asset naming rules are *not* retroactive and will apply only to new assets.
##### Index Blocks
- **Max Assets in Index Blocks** - Determines the maximum number of assets that may be returned by an index block.
- **Maximum Rendered Size of an Index Block** - This preference puts a cap on the amount of content that can be generated by an index block before an error is generated and the block rendering is aborted.Using this preference will help prevent OutOfMemory errors that can occur when index blocks get too large.
**Note**: We recommend keeping this setting under **15MB** if at all possible. Values larger than this may cause Index Blocks to grow to sizes which can result in performance degradation. The maximum value allowed is **40MB**.
- **Index Block Rendering Cache****Enabled** - If the rendering of an index block is not being refreshed (the cache isn't being discarded) or you've changed the **Maximum Rendered Size of an Index Block** setting, you can clear the rendering cache by disabling this option, selecting **Submit**, and immediately reenabling it after the cache is cleared.
- **Use legacy caching strategy** - In some limited cases, improvements to caching in later versions of Cascade CMS will cause problems for index blocks that were incorrectly showing less assets in 6.10 and earlier. You can enable a legacy caching strategy which will cause the system to render and cache assets as it did in versions prior to 7 meaning that asset content is not cached between asset renderings. This option is only meant to allow instances with this issue to continue to operate while the problem is investigated; it should not be used as a long term fix - instead the index block implementations should be corrected.
##### Feed Blocks
- **Request Timeout** - The amount of time to allow before the system times out when requesting a particular Feed Block. The default timeout is 10 seconds with a maximum allowed value of 20 seconds.
##### Publishing
- **Smart Publishing** - If this option is enabled, files that haven't been modified in the system since the last publish to a specific Destination won't be republished. Also, files which have been altered or removed on the destination server will be republished. This feature applies only to files larger than 10MB that do not have **Rewrite links in file** enabled.
- **Report relative links as broken when publishing** - Determines whether relative links are reported or ignored upon publishing.
- **Publish Job Timeout** - The duration (in milliseconds) before the system times out the transmission of a particular asset when publishing.
##### Other
- **XSLT Formats****Enable Xalan JavaScript extensions** - Controls whether Xalan JavaScript extensions can be used when transforming pages with XSLT Formats.
- **Enable Xalan Java extensions** - Controls whether Xalan Java extensions can be used when transforming pages with XSLT Formats.
- In most cases, you will want to disable Java extensions because they allow users to run arbitrary Java code inside the system which poses a large security risk. JavaScript extensions can be used to write utility functions for date formatting and other things that are difficult to do in XSLT alone. EXSLT extensions are not affected by either of these preferences as they are a set of known functionality that cannot be used in a malicious fashion. If an implementation is not using Xalan extensions, these options should be disabled to minimize the security risk.
## Reports
##### Link Checker Configuration
- **Run Scheduled Link Checker** - Enable and configure this option to scan links in content at regular intervals and populate the Broken Links Report.Only links in sites that have **Scheduled Link Checker** enabled in their Site Settings will be checked.
- Depending on the amount of links to be checked, this can be a resource-intensive process. To avoid impacting system performance for users or scheduled publish jobs, we recommend configuring the link check to run on a weekly basis, during off-peak hours.
##### Daily Content Report
- **Send Daily Content Report to Subscribers** - Enable and configure this option to generate the Daily Content Report for users who are subscribed to receive it.
- **Run at** - Determines when the Daily Content Report should be sent
## Integrations & Plugins
#####  Siteimprove Settings
- **Enable Siteimprove Plugin** - Enabling this option will provide access to your [Siteimprove](https://siteimprove.com/) data within the Cascade CMS interface. After logging in, the plugin will overlay quality assurance, analytics, and accessibility data when viewing relevant pages.
- **Do not include "index" in Siteimprove URLs** - Enable this option if the index pages for your site appear as *https://www.example.com/about/* in Siteimprove as opposed to *https://www.example.com/about/index.html.*
##### Digital Asset Management
- **Widen Collective API Key** - Provide your Widen Collective API key to enable Widen integration for your system.
- **Webdam Domain** - Provide your organization's Webdam domain to enable Webdam integration for your system.

---

### System Pseudo-Tags

## Overview
System pseudo-tags are special system tags that instruct Cascade CMS to act on the content contained within them. System pseudo-tags are not XML elements but instead use a square bracket notation.
## System View Internal
This tag surrounds content to be displayed inside the system only. It can be used for paths or blocks of code that need to be present upon rendering within the system, but not necessarily when published out of Cascade CMS.
[system-view:internal

---

### System Tags

## Overview
Cascade CMS recognizes specific XML elements called system tags that are used for dynamic content insertion. System tags are XML elements whose names begin with `system-`.
System tags may be used as content region tags, which are regions within Templates where content can be inserted as static or dynamic content blocks, or as the result of a Format acting on a block.
System tags may also be used as metadata tags, where page information (title, author, publish date, etc.) can be used as shorthand on a page.
## System Region Tags
System region tags are self-closing tags with a single attribute `name` that is used to specify the name of the region. This region name is used when viewing Templates, Configurations, and Pages.
```
...	<div class="section section-white">			<div class="container">				<div class="row">					<div class="col-md-6">						<system-region name="DEFAULT"/>					</div>					<div class="col-md-6">						<system-region name="SLIDER"/>					</div>				</div>			</div>		</div>		<system-region name="SPOTLIGHTS"/>		<system-region name="FOOTER"/>		<system-region name="FOOTER JS"/>	</body></html>
```
**Note** - A system-region named `DEFAULT` should be the region that contains the main content of a page. Other region names can be used to create as many additional content regions as necessary. If no region exists when the Template is created or edited, a `DEFAULT` region will automatically be added immediately after the opening `<body>` tag.**Note** - Renaming a system region will cause any Block/Format assignments to be removed from that region. Make sure to take note of any region assignments prior to renaming so that you can assign the corresponding Block/Format back as needed.
## Metadata Tags
Metadata tags allow you to include metadata from the current page directly in your Template or page source code.
| Tag | Description | Example Output |
| --- | --- | --- |
| ` <system-page-name/> ` |  The system name of the page. | system-tags |
| ` <system-page-creator/> ` | The creator of the page. | Charlie Holder |
| ` <system-page-title/> ` | The contents of the page's Title metadata field. | System Tags |
| ` <system-page-summary/> ` | The contents of the page's Summary metadata field. | Cascade CMS recognizes specific XML elements called system tags that are used for dynamic content insertion. |
| ` <system-page-author/> ` | The contents of the page's Author metadata field. | Charlie Holder |
| ` <system-page-teaser/> ` | The contents of the page's Teaser metadata field. | Learn more about system tags in Cascade CMS. |
| ` <system-page-keywords/> ` | The contents of the page's Keywords metadata field. | tags, metadata, xml |
| ` <system-page-description/> ` | The contents of the page's Description metadata field. | A review of available system tags in Cascade CMS. |
| ` <system-page-display-name/> ` | The contents of the page's Display Name metadata field. | System Tags |
| ` <system-page-start-date/> ` | The contents of the page's Start Date metadata field, displayed in US date format `MMM DD, YYYY hh:mm a`. | May 1, 2021 12:00 AM |
| ` <system-page-end-date/> ` | The contents of the page's End Date metadata field, displayed in US date format `MMM DD, YYYY hh:mm a`. | May 8, 2021 12:00 AM |
Additional tags can be used to generate entire metadata elements.
| Tag | Description | Example Output |
| --- | --- | --- |
| ` <system-page-meta-keywords/> ` | A meta element including the contents of the page's Keywords metadata field. | `<meta content="tags, metadata, xml" name="keywords" />` |
| ` <system-page-meta-description/> ` | A meta element including the contents of the page's Description metadata field. | `<meta content="A review of available system tags in Cascade CMS." name="description" />` |
| ` <system-page-meta-author/> ` | A meta element including the contents of the page's Author metadata field. | `<meta content="Charlie Holder" name="author" />` |
| ` <system-page-meta-date/> ` | A meta element including the date and time the page was rendered. | `<meta content="Fri, 07 May 2021 13:56:22 -0560" name="date" />` |
**Note:** Because system tags are XML elements, they may not be used within XML attributes. ``

---

### Title to System Name Plug-in

## Overview
This plug-in ensures that newly-created assets are given search engine friendly system names.
When using an Asset Factory with this plug-in assigned, the system name field is hidden. On submit, the plug-in takes the value in the Title metadata field, makes it search engine friendly, and this becomes the system name of the new asset. Making the name search engine friendly involves converting spaces to hyphens and removing any characters that are not A-Z, a-z, 0-9, hyphen, plus symbol, comma, or period.
If used with a File Asset Factory, the plug-in will also preserve the file extension, which will be appended to the system name. If no file is uploaded and the Asset Factory being used has a base asset assigned to it, then the base asset's file extension will be used. When neither a file is uploaded nor a base asset is assigned to the Asset Factory, no file extension will be preserved.
**Note** - Asset naming rules will override the system name conversion done by the plug-in if the rules conflict.
## Examples
- If a user uploads a file called *DSCN0009.jpg* and populates the title field with "My House", this plug-in will set the name of the file asset to *my-house.jpg*.
- If a user creates a new file asset using an Asset Factory with a base asset named *template.html* and populates the Title field with "Contact Us", this plug-in will set the name of the created file asset to *contact-us.html*.
**Tip** - This plug-in and the Display to System Name Plug-in behave the same way with the exception of the metadata field used to generate the system name.

---

### Updating the license key

## Overview
1. Go to **Administration > ****Product License**.
2. Enter the license key code into the **License Text field** - or - browse to the license file by clicking the **Choose File** button.
3. Click **Submit**.
**Note**: License keys are valid immediately upon receiving them and you can plug them in at any time before your existing license key expires. Updating the license key does not require a system restart.

---

### User Activity Report

## Overview
The User Activity report provides usage statistics for common actions users take in the system, including:
- Creates
- Edits
- Publishes
- Deletes
- Logins
**Tip** - Click any non-zero number in the report to view an audit pre-filtered for that user and action.**Note** - To view the User Activity report, you'll require the **Access Administration Area** and **Access Users, Groups and Roles** abilities enabled in one or more of your System Roles.
## Filtering the Report
The following filters are available under **Filter Settings** to refine the results of the report:
- **Start Date** - actions initiated after the selected date/time.
- **End Date** - actions completed before the selected date/time.
- **Enabled Users Only** - check this option to filter out user accounts that have been disabled in the system.
## Exporting the Report
The report can be exported as a .csv file by clicking the **Export CSV** link.

---

### User Menu and Account Settings

## Overview

Your account settings are accessible when viewing any area in Cascade CMS. To access them, click on the letter representing your name (or your profile picture if you have one set) in the upper-right corner.
- **Starred** - View your starred assets in the My Content area.
- **History** - View your recently-visited assets in the My Content area.
- **Notifications** - View your notifications such as workflow notifications, publish reports, and user mentions.
- **Tasks** - View tasks that are assigned to you.
- **Settings** - Configure some basic preferences for how you interact with Cascade CMS (see Account Settings).
- **API Key** - Manage your API Key used to authenticate with scripts and applications (see User API Key).
- **Sign Out** - Log out of Cascade CMS. After a period of inactivity set by your CMS administrator, you'll be logged out automatically.
## Account Settings
To access your account settings, click on the user menu button and then click **Settings**. The following settings are available to configure:
- **Appearance of Asset Links** - View assets by either their Title/Display Name or their system name in Cascade CMS. For more information, see Asset Display Options.
- **Daily Content Report** - Subscribe or unsubscribe from the Daily Content Report if it's enabled for your system.
- **Default Site** - Choose your default site here to pre-filter new dashboard widgets and reports to display data from this site.
- **Notification Duration** - Adjust the duration of notifications displayed within the interface.
- **Change Password** - If your organization uses Active Directory, LDAP, or something similar for logging in users, you won't see this option.
- **Change Profile Photo** - Drag and drop an image file or choose one from your computer to create a profile image. This image will be displayed next to your username in Cascade CMS.
**Notes
**The maximum size for profile images is 1.04MB.
Changing password will invalidate "Remember me" functionality across all browsers. You will need to log in again in order to use the "Remember me" feature for future sessions.
## API Key
Your API Key is unique to your user account and can be used to authenticate with Web Services scripts and applications in place of a traditional username and password.
- **Generate a new key** to open a dialog which displays a new, unique API Key. This key is only shown once and can't be retrieved again, so be sure to store it somewhere safe.
- If you lose your API Key, you can **Regenerate** it. Again, the generated key will only be shown once.
- If you no longer need your API Key, you can **Revoke** it entirely. Once revoked, scripts and applications must authenticate using a traditional username and password.
Once an API Key is generated, the following information will be provided on the API Key screen:
- **Preview** - a preview of the beginning of your API Key.
- **Generated at** - the date that your current API Key was generated. For security purposes, you may wish to periodically regenerate your API Key.

---

### Users

## Overview
Cascade CMS requires individuals using the system to authenticate upon login for security, logging, and resource management purposes. Each user has a user account with a Username, password, and optional full name and email. Group and Role memberships must be assigned to each user to determine which tasks that user may perform and their access to various system resources.
You can access the Users menu by clicking the system menu button ( * *) > **Administration** > **Users**. The following information will be displayed for all users:
- **Username**
- **Full Name**
- **Email**
- **Login Time** - Hover over this entry in this column for an exact date/time.
From this screen you may also filter by:
- Users who are** Enabled** and/or **Disabled** in the system.
- Users who have logged in **At least once** and/or **Never**.
Click on any user in the list to view their Settings, Groups, and Roles. Additional options are available in the **More** menu while viewing a user:
- **Workflows** - A list of the user's owned workflows and waiting workflows (workflows assigned directly to the user or their group).
- **Locked Assets** - A list of assets currently checked out by the user. You can select one or more assets in the list and click the **Break Lock** button to discard the user's changes to the selected assets.
- **Drafts** - A list of the user's unsubmitted drafts. You can select one or more assets in the list and click the **Delete** button to discard the user's changes to the selected assets.
- **Audits** - A summary of activities performed in the system by the user.
- **Delete**
- **Effective Abilities** - An overview of the abilities the user will inherit for a specific site based on their Site Role.
- **Assume Identity** - Allows you to assume the user's identity and view Cascade CMS as the user sees it.
## Adding a User
To add a user to the system:
1. Click the system menu button ( * *) > **Administration** > **Users** and click **Add User**.
2. In the **User Settings** tab enter the following:**Enabled** - This setting allows you to activate and deactivate the user without deleting the account. It's checked by default when creating a new user.
3. **Username** - A unique name the user will be known by in the system.
4. **Full Name** (optional) - The full name of the user.
5. **Email** (optional) - The email address to which messages such as workflow notifications and the Daily Content Report will be sent.
6. **Authentication** - Determines whether **Normal** (password) or **Custom** (single sign-on solution via a custom plugin) authentication is required for this user.
7. **Password** - see [password policies](#password-policies)
In the **Membership and Roles** tab enter the following:
1. **Groups** - Select the group(s) to which the user should belong. Assigning multiple groups to each user is an easy way to customize the permissions options for each user.
2. **Default Site** (optional) - This option will filter the user's dashboard widgets to reflect data from the site selected.
3. **Role** - Select the desired System Role of the user. This role governs the user's access to administrative, non-content areas. The user's actual role abilities are determined by the highest overall permissions when taking into account the user's role(s) AND the roles of the group(s) the user belongs to.
Click **Submit**.**Note**: Usernames and Passwords are case-sensitive. For example, if a user is created with the username "person123", that user must log in by typing their username "person123" and *not* "Person123".**Note**: It is not possible to modify the **Username** for a User after their account has been created.
### Password Policies
Users of authentication type **Normal** must have passwords that meet the following policies:
- At least 12 characters when using alphanumeric, or 8 characters if using special characters
- Can not include 4 consecutive characters from username, full name, or organization name (i.e. System Name)
- Can not include 4 consecutive numbers or letters (e.g. "defg", "3456", etc.)
- Can not include 3 consecutive characters that are the same (e.g. "aaa", "111", etc.)
- Should not contain common weak passwords
## Checking a User's Effective Abilities
The Effective Abilities tool allows administrators to get an overview of the abilities a user will inherit for a specific site based on their Site Role. To check a user's Effective Abilities, click **More** > **Effective Abilities** while viewing a user and select a site from the drop-down menu.
Once a site is selected, you'll be presented with a list of role abilities along with whether or not those abilities are enabled for the user in the selected site.
## Assuming a User's Identity
Users with the **Assume another User's identity** ability enabled in their System Role can assume the identity of any other user. This tool can be used not only to get a quick visual representation of what a user sees but also what they can access in different sites.
To assume another user's identity, either select the user from the user list and click the **Assume this user's identity** button at the top of the list or click **More** > **Assume Identity** while viewing a user.
After assuming a user’s identity, you'll see exactly what that user will see when they're logged into the system. You can switch back to your own identity by clicking **Resume normal identity** under the User Menu.

## Related Links
- How do I give a User or Group access to a Site?

---

### Why are my changes not appearing on the web site?

If you're seeing discrepancies between your asset in Cascade CMS and on your live website, see the steps below for possible resolutions.
### Verify that you've submitted the job for publishing
After creating or editing an existing asset in Cascade CMS, you must publish your asset in order to see your changes on the live website.
Your organization may have the system configured to send you through a Workflow may automatically publish your changes. If it does not; however, you will need to publish the asset to one or more Destinations manually.
If you don't see the Publish option screen while viewing your asset:
- You may be viewing a Draft of your asset, in which case you'll first need to Submit your changes)
- Your Site Role may not allow for you to publish assets, in which case you'll need to contact your Cascade CMS administrator for assistance.
- You may be viewing an asset that is not publishable, such as a Block, in which case you'll need to publish assets that are including the asset. For starters, you could check out this article on Publishing Changes to a Block.
### Verify that the job has been processed
The next step in determining what might be happening with a publish job is to see if it has been processed. When publishing an asset (or assets), the job is sent to the Publish Queue prior to being physically transferred to your web server(s). Your Site Role will determine if you can view the Publish Queue.
If your publish job is still in the queue behind other assets waiting to be published, you'll need to wait for those jobs to be processed before your changes will appear on the web server.
If you do not have the ability to view the queue, you will need to contact your Cascade CMS administrator to have them check the queue for you or to give you the ability to view the queue yourself.
If you don't see your publish job in the Publish Queue, there is a chance it may have been processed already. In the event that a publish job has been processed, it will trigger a publish message that will be sent to your Notifications, at which point, you can see if it resulted in any errors.
### Check your publish Notifications
Once your publish completes, you will receive a Notification containing more information regarding the status of that job. You can view your Notifications by following the steps outlined on this page.
Clicking on the Notification will show you more details including the number of successful jobs, errors, and skipped jobs pertaining to your publish. You'll also be able to see to which Destinations (web servers) your publish job was transmitted.
### If you've received a publish message showing that there were no successful jobs and no errors...
#### Verify that your page has publishable Outputs
While previewing your page, click **Details > Design > Content Type** to view the page's Content Type.
Under **Publish Options**, ensure that your page Outputs are publishable, and that they are publishable to Destinations in the current site or "All Destinations".
### If you've received a publish message showing that your job was successful, but still don't see the changes on your website...
#### Verify that you've published to the correct Destination (web server).
The publish message you received in your Notifications will outline to which Destination(s) your files and/or pages were published. Under Successful Jobs, you'll see the Destination listed first for each item that was published. For example:
```
[Destination: My Web Server] Main Website: files/images/banner.png
```
If you don't see the Destination listed to which you intended to publish, you'll want to try publishing your asset(s) once again and be sure to select the proper Destination(s). If you don't see the Destination available when you click to publish it, you may not have access to it. In this case, you'll need to contact your Cascade CMS administrator to have them include you in one of the Applicable Groups for that Destination.
#### Clear your browser cache and/or try a different browser.
Occasionally, your browser will load a cached version of the page or file that you're attempting to access on your web server(s). To verify whether or not this may be the case, try clearing your browser cache or use a different browser (one you don't normally use) to see if the problem persists.
### If you've received a successful publish message, cleared your browser cache, tried a different browser, but still don't see the changes on your website...
#### Check the timestamp of the file on the web server's file system.
Unless you happen to have direct access to the web server, this step will require that you contact your web server administrator for assistance. The goal here is to see if the timestamp (last modified date) of the file in question matches the approximate time when you attempted to publish from Cascade CMS.
If the timestamp of the file in question does not match the approximate time of the publish window, the file is either never reaching this web server or it is ending up in a location that you're not expecting (in which case a search of the file system for the name of the file you're publishing may point you to the location of the published file).
#### Verify that your Transport/Destination are publishing to the proper location on your web server.
Depending on your role, this step may require that you contact your Cascade CMS administrator as well as your web server administrator for assistance.
See how Transports and Destinations work in conjunction with one another to publish to a particular location on your web server.
#### Find out if your web server is caching.
Some web servers are configured to cache files. You'll need to reach out to your web server administrator to see if the web server in question has this setting enabled. In the event that it does, you may notice that the changes eventually show up (after a particular interval of time). Your web server may also have an option to bypass the server cache by appending certain characters to the target URL (e.g. `?resetcache=1`), but your web server administrator should be able to confirm the proper parameters for your organization.
### If you're still having trouble...
In the event that you're still having trouble or you're seeing an error message somewhere that you need assistance with, reach out to our support team here and we'll be happy to help troubleshoot further!

## Related Links
- Publishing

---

### Why can't my users access the full search feature?

If your users see the following error message when attempting to access Full Search:
```
Your role does not authorize you to view this resource.
```
you may need to adjust their System Role(s). Because the Full Search and Replace feature resides in the Administration area, you will need to enable access to it by doing the following:
- Navigate to the User in question under **Administration** > **Users**.
- Click on the User account and note the **System Roles** assigned to the User.
- Select the Role that is most appropriate for enabling this Full Search capability (keeping in mind that all other Users who inherit this System Role will be granted the enabled abilities) and click **Edit.**
- Under **Administration Area Abilities**, enable **Access Administration Area** and click **Submit**.
**Note** - It's important to check your users' System and Site Role(s) after making this change to ensure no unintended access or abilities in other Administration areas was given.
## Related Links
- Roles
- Search

---

### Why can't my users see anything in the Add Content menu?

In order to see a particular item in this menu, a User must be part of a Group that is configured in the **Applicable Groups** field *for both the Asset Factory and the Asset Factory's Container*. 
Steps for configuring both can be found below:
1.  Add **Applicable Groups** to the Container (if applicable): - Go to **Manage Site **> ** Asset Factories**. - Either right-click and select **Edit** on the Container or click on the Container and click the **Edit **button. - In the **Applicable Groups** field, click the **Choose Groups** button and add any Group(s) that should have the ability to see this Container in their Add Content menu. - Click **Submit**.**
2. Add **Applicable Groups** to each individual Asset Factory(s): - Go to Manage Site **> ** Asset Factories** - Either right-click and select **Edit** on the Asset Factory or click on the Asset Factory and click the **Edit **button. - In the **Applicable Groups** field, click the **Choose Groups** button and add any Group(s) that should have the ability to see this Asset Factory in their Add Content menu. - Click **Submit**.

## Related Links
- Asset Factories

---

### Your roles do not allow you to advance workflow

This error indicates that the user's Site Role doesn't allow them to assign a Workflow to themselves or approve steps in a Workflow. To solve this, follow the steps below:
1. Navigate to **Menu -> Administration -> Roles**.
2. Edit the user's Site Role (the one they are inheriting for the Site in question).
3. Enable the ability **Assign to self and approve steps in a workflow.**
4. Click **Submit**.

## Related Links
- Workflows
- Roles
- How do I give a User or Group access to a Site?
- How can I check what a User can do in a specific Site?

---

## Content Management

*69 articles in this category*

### Add or remove the Windows service

## Installing the Windows service
The Cascade CMS Windows service can be installed by following these steps:
1. Open a command prompt using the **Run as Administrator** option.
2. Change into to the Cascade CMS installation folder.
3. Enter: `installcascadeservice.bat`
A Windows service with the name `Cascade CMS` will be installed.
## Removing the Windows service
The Cascade CMS Windows service can be removed by following these steps:
1. Open a command prompt using the **Run as Administrator** option.
2. Change into to the Cascade CMS installation folder.
3. Enter: `removecascadeservice.bat`
The Windows service with the name `Cascade CMS` will be removed.

---

### Adding a PDF to a page

If you're working in a WYSIWYG editor, you can add a link to a file such as a PDF by uploading your file to Cascade CMS, then linking to it in the WYSIWYG.
1. Upload your file by clicking the **Add Content** menu and use the appropriate file option available to you. - These options are set up by your CMS administrator so it may be named something like "File", "PDF" etc. - If you don't see any file options available to you in the **Add Content** menu, you'll want to contact your CMS administrator or web team for further assistance.
2. Add a link to your file in the WYSIWYG by clicking the **Insert/Edit link** button, choose "Internal" for the link type, and browse for the file you just created.

---

### Adding an image to a page

If you're working in a WYSIWYG editor, you can add an image by uploading your image to Cascade CMS, then browsing for it in the WYSIWYG.
1. Upload your image by clicking the **Add Content** button and using an appropriate file option available to you. - These options are set up by your CMS administrator so they might be named something like "File", "Image" etc. - If you don't see any file options available to you in the **Add Content** menu, you'll want to contact your CMS administrator or web team for further assistance.
2. Add your image in the WYSIWYG by clicking the **Insert/Edit image** button, browsing for the file you just created, and adding description alternative text for your image.
3. Change your image alignment and text wrapping (optional) by selecting clicking on your image to select it, then click any of the alignment buttons in the toolbar to apply a float to your image.

---

### Advanced Code Editor

The Advanced Code Editor (ACE) is Cascade CMS' built-in syntax-highlighting editor.

---

### Asset Display Options

## Overview
Cascade CMS provides two options to display asset links: by their system name (as in previous Cascade CMS versions) or by their Title or Display Name.
By default, if a folder, page, or file has a Title or Display Name metadata field filled out, it will appear on all asset links throughout your Cascade CMS environment. It is important to note that the formal paths and published filenames are different from what is shown in Cascade CMS with this display method.
In the example below, both sets of folders have the same contents. When this site is published, users will see a web URL of http://www.example.edu/*about* or http://www.example.edu/*gallery *instead of the the corresponding Title/Display Name fields "About Hannon Hill University" or "Photo Gallery".
*Asset links as they appear with Show Asset's Title/Display Name enabled.
Asset links as they appear with Show Asset's Title/Display Name disabled.
**Tip** - Mouse over any asset name in the Site Content display area to see its full path (system name and path relative to the site's root directory).
## Toggling Asset Display Options
Asset links are displayed by their Title or Display Name by default, but this can be toggled in favor of displaying the asset's system name.

#### At the User Level
- Click on your **User** icon in the upper right-hand corner and then click **Settings**.
- Under **Appearance of Asset Links**, toggle the **Show asset's Title or Display Name if available** option.** **
#### At the System Level
- Click the system menu button (  *) > **Administration** > **Preferences** > **Content** > **Assets**.
- Under **Appearance of Asset Links**, toggle the **Show asset's Title or Display Name if available** option.
Disabling the Title/Display Name option at the system level will override the existing user preference for displaying asset links if a user has not saved that preference.

---

### Asset Factories

Asset Factories allow users to rubber stamp new assets with certain configurations and content already in place. Asset Factories can be used to create assets from scratch or be based on an existing pre-configured base asset.

---

### Asset Factory Plugins

## Available Plugins
Create Resized Images Plug-in
This plug-in allows an administrator to specify that multiple resized images will be created when a user uploads a single image.
Image Resizer Plug-in
This plug-in allows an administrator to specify that an uploaded image be resized to particular dimensions.
Display to System Name Plug-in
This plug-in ensures that newly-created assets are given search engine friendly system names.
File Limit Plug-in
This plug-in allows administrators to place restrictions on the size and type of file created using a specific asset factory.
Set Start Date Plug-in
This plug-in sets the metadata field "start date" to the current time for newly created assets, with an optional configurable offset.
Data Definition Field to System Name Plug-in
This plug-in takes the value from a specified structured data field, makes it "safe" by removing non-SEO characters, and then turns that into the system name for the new asset.
Data Definition Fields to System Name Plug-in
This plug-in takes the value from multiple specified structured data fields, concatenates them together, and turns that into the system name for the new asset.
Friendly Page Name Plug-in
This plugin limits the system name of new page assets to configurable regular expression.
Title to System Name Plug-in
This plug-in ensures that newly-created assets are given search engine friendly system names
## Creating New Plugins
#### Prerequisites
This article assumes you have moderate Java programming knowledge, as well as a Java Runtime Environment (JRE) installed on your machine (required by Eclipse). Your JRE should match (or be backwards compatible) with the version of Java required by your version of Cascade CMS.
#### Collecting the tools
Before you get started, Cascade 7+ users should download the following:
- [Eclipse IDE](https://www.eclipse.org/)
- [Asset Factory Plugin SDK](https://github.com/hannonhill/Cascade-Server-Asset-Factory-Plugin-SDK/raw/master/dist/CascadeAssetFactoryPluginSDK.zip)
If you wish to use a different IDE to write your plug-in, you can develop against the *standalone assetfactory-plugin-{VERSION}.jar* and the *cascade-api-{VERSION}.jar* files that come in the SDK.
#### Installing Eclipse and Opening the SDK
Once you download Eclipse you will want to unzip it to a directory of your choosing. Suggestions:
- *C:\java\eclipse* or *C:\Program Files\Eclipse* on Windows
- */usr/local/eclipse* on Linux
- *~/java/eclipse* on OS X
Start Eclipse and you will be prompted to choose a workspace location - the default location should suffice. Make note of it as this is where we will unzip the SDK to. Next, you will unzip the Plugin SDK to your workspace directory. The zip should create its own directory inside your workspace directory.
Finally, we will bring in the Plugin SDK (which is really just an Eclipse project) into Eclipse. To do this:
- Right-click in the package explorer view on the left-hand side and select "Import...".
- Then, select "Existing Projects into Workspace" under "General" and click "Next".
- Select "Browse" next to "Select root directory:" and browse to the directory created when you unzipped the SDK. You should then see "Asset Factory Plugin" under "Projects".
- Click "Finish".
You should now see the project in your Package Explorer. The project has two packages:
- The resources package - this is where your "resource bundles" will live. A "resource bundle" is a set of localized strings describing various aspects of your Asset Factory plugin, such as the name, description, and the names and descriptions of any parameters your Asset Factory plugin may utilize. Note that the name of this package must be "resources" and must live off the root of the project.
- The "com.mycompany.cascade.plugin" package - this package can be renamed to whatever you desire - this is where your Plugin class will reside.
#### Writing the Plugin Class
A plug-in is a Java class that implements the AssetFactoryPlugin interface. It is strongly recommended that you extend the BaseAssetFactoryPlugin class because it contains the implementation of helper methods that the framework relies on.
The plug-in writer will need to implement the following methods:
`public void doPluginActionPre(AssetFactory, FolderContainedAsset)`
This method is called before the user has performed the initial edit. The FolderContainedAsset passed as a parameter will contain the data from the asset factory's default asset, if one is set. At this stage, the asset has not yet been created.
`public void doPluginActionPost(AssetFactory, FolderContainedAsset)`
This method is called after the user has performed the initial edit. The FolderContainedAsset passed as a parameter will contain the data from the asset factory's default asset, if one is set. At this stage, the asset has not yet been created.
`public void setAllowCreation(boolean flag, String reason)`
This method allows plugin authors to allow/disallow creation of a new asset from an AssetFactory based on logic they describe. Calling this method with the parameter `false` will prevent the asset from being created and display the given reason to the user as an error message.
`public Map<String, String> getAvailableParameterDescriptions()`
This method shall return a map where the keys are the names of the parameters (keys into the resource bundle) and the values are the descriptions of the parameters (keys into the resource bundle). This method must return a non-null Map object.
`public String[] getAvailableParameterNames()`
This method returns a non-null array of strings which are keys into the resource bundle, each of which is the name of a parameter this plug-in can take.
`public String getDescription()`` `
This method returns a key into the resource bundle which is the description of the plug-in.
`public String getName()`
This method returns a key into the resource bundle which is the name of the plug-in. 
#### What is a "key into the resource bundle"?
The resource bundle is a file that allows internationalization of your plug-in. This file is formatted with key/value pairs, one on each line. The key is generally a dotted string (example: "name.of.my.plugin") and the value is a human-readable string (example: "This is the name of my plug-in"). The key/value pairs are separated by an equals ("=") sign. You can find two sample resource bundles in the Asset Factory Plug-in SDK.
#### Disallowing asset creation
A powerful aspect of Asset Factory plug-ins is their ability to determine which assets are allowed to be created and which aren't. By default, assets are always allowed to be created. However, if a plug-in writer deems that due to some conditions an asset is not to be created, that plug-in writer can throw a new FatalPluginException that contains the reason why the asset cannot be created. The plug-in writer can also call the function `setAllowCreation()` with the first boolean parameter set to false and the second String parameter explaining why the asset was not allowed to be created. The framework will then check this and pass the specified message up to the user.
Note: By default, a plug-in is set to allow assets to be created, so if your plug-in is not intended to restrict creation, you will not need to add any additional code.
#### Exceptions
Asset Factory Plug-ins may use two types of exceptions: a PluginException or a FatalPluginException. A PluginException is a general exception that will NOT stop other plug-ins from executing, but it will halt the execution of the current plug-in. A FatalPluginException stops other plugins from executing AND tells the plug-in framework to not allow the asset to be finalized and put into the system.
#### What to do with your plug-in
First, create a JAR file containing your plug-in file and the resource bundle(s) it references. To do this:
- Right click on your project in the Package Explorer (left hand side) in Eclipse and select "Export...".
- Under the "Java" section, select *JAR file* and click "Next".
- Next you will be prompted as to which files to include. Ensure the checkboxes for your plug-in package and resources package are selected. If you click on your project, you will see that the ".classpath" and ".project" files are included, which are unnecessary and should be unchecked so they are not included in the JAR. The rest of the default options should be fine (only things checked are "Export generated class files and resources" and "Compress the contents of the JAR file").
- Under "Select the export destination:", select where the JAR file will be temporarily placed before deployment to Cascade CMS.
- Click Finish.
To deploy the plug-in JAR:
- First you must shut down Cascade CMS.
- Next, locate the JAR file and place this file in *<Tomcat_Installation_Location>/webapps/ROOT/WEB-INF/lib* under the Tomcat Deployment directory. JAR files placed in this location are automatically loaded along with other libraries needed by Cascade CMS.
- Once you have done this, start Cascade CMS and go to the Asset Factory section in the **Administration** area and select **Manage Plugins**.
- In the "Add a Plugin" text field, enter the fully qualified Java class name of your plug-in (for instance, "com.mycompany.cascade.MyPlugin") and click **Submit**. The plug-in will then be added and will be accessible in the "Plug-ins" tab when editing an Asset Factory.
#### What can go wrong
If you loaded your plug-in and now you can't edit any of your Asset Factories (blank screen), the most likely cause is Cascade CMS is being told to look for a key which does not exist in the resource bundle you have supplied. If you can examine the logs, you will more than likely see a message about "Could not locate key for this.is.the.missing.key". You will need to ensure that all the keys that you return in your `getAvailableParameterDescriptions()`, `getAvailableParameterNames()`, `getDescription()`, and `getName()` functions point to valid keys in your resource bundle for all locales.
#### Other Resources
The [Asset Factory Plugins](https://github.com/hannonhill/Asset-Factory-Plugins) Github project is another great resource for developing your own custom Asset Factory Plugins.

---

### Asset Naming Rules

## Overview

Asset naming rules allow you to enforce a consistent format for system names in Cascade CMS. When creating an asset, you'll be provided with help text to remind you of the site's naming rules. If the name you enter doesn't meet the site's requirements, you'll be prompted to change it or use the suggested name.
The following rules are available to configure:
1. **Capitalization** - **Any** - Any combination of uppercase and lowercase characters are permitted. Example: Contact Us - **Lowercase only** - Only lowercase characters are permitted. Example: contact us - **Uppercase only** - Only uppercase characters are permitted. Example: CONTACT US
2. **Spaces between words** - **Allowed** - Spaces between words are permitted. Example: Contact Us - **Not allowed** - Spaces between words are not permitted. Example: ContactUs - **Replace with hyphen** - Spaces between words should be replaced with hyphens. Example: contact-us - **Replace with underscore** - Spaced between words should be replaced with underscores. Example: contact_us
3. **Apply rules to these asset types** - You can choose which types of assets these rules apply to. For example, you may only want to apply naming rules to pages and files to ensure their names are search engine friendly.
## Setting Asset Naming Rules
### At the System Level
1. Click the system menu button ( * *) > **Administration** > **Preferences** > **Content**.
2. Under **Asset Naming Rules**, configure the asset naming rules and select which asset types the rules will apply to. These rules will be enforced for sites that have **Inherit from system preferences** selected in their Site Settings.
3. Click **Submit**.
### At the Site Level
1. Navigate to **Manage Site** > **Site Settings** > **Asset Naming Rules**.
2. Configure the asset naming rules and select which asset types the rules will apply to.
3. Alternatively, select **Inherit from system preferences** to enforce the rules set in System Preferences.
4. Click **Submit**.
## Viewing Naming Issues
Changes to asset naming rules will be enforced for new assets only. To see a list of existing assets that don't meet the site's system name requirements, navigate to **Manage Site** > **More** > **Naming Issues**.
When renaming publishable assets to comply with the site's naming rules, remember to select **Unpublish Content** when submitting your changes to prevent orphaned files on your web server.
**Note**: In order to view **Naming Issues** for a Site, Users must have at least READ access to the Site object itself (under **Manage Site ->  More -> Access**).
## Asset Factory Plug-ins and Asset Naming Rules
Asset naming rules will override the system name conversion done by certain Asset Factory Plug-ins if the rules conflict. These plug-ins include:
- Data Definition Field(s) to System Name Plug-in
- Display to System Name Plug-in
- Title to System Name Plug-in
For example: the Title to System Name Plug-in will lowercase and hyphenate the value of the Title metadata field to generate an asset's system name, *unless* uppercase letters and spaces are allowed in your site's asset naming rules.
If you have this plug-in enabled for one or more Asset Factories, your asset naming rules should be set to allow lowercase letters and hyphens only and apply to the asset types corresponding to your Asset Factory types.
In addition, if you have either of the following Asset Factory plug-ins that use regular expressions to validate system names enabled, it's recommended that your regular expression comply with your site's asset naming rules to prevent confusion:
- File Limit Plug-in
- Friendly Page Name Plug-in

---

### Assets are not appearing in Index Blocks

If your Index Blocks aren't rendering assets that you feel should be included, be sure to verify whether or not you may be running into one of the following scenarios:
### The 'Include when indexing' setting is disabled
Edit the asset in question and click the **Configure **pane. Verify that the *Include when indexing* option is checked. Keep in kind that in some cases, you will also need to make sure that the parent Folder of the asset in question has the same option checked.
### The asset has not reached its Start Date
Edit the asset in question and click the **Metadata** pane. In the *Start Date* field, verify that the value (if filled in) contains a date that has passed. Assets who have not reached their Start Date will not be eligible for indexing or publishing until that date/time has been reached.
### The asset has reached its End Date (expired)
Edit the asset in question and click the **Metadata** pane. In the **End Date** field, verify that the value (if filled in) contains a date that has not passed. Assets who have reached their End Date will no longer be eligible for indexing or publishing once that date/time has been reached.
### The Index Block Depth is too shallow
Edit the Index Block and check the value for the **Depth of Index** field. Verify that this value is high enough to go the necessary number of levels deep within the folder hierarchy to reach the asset.
### The Index Block 'Max Rendered Assets' value has been reached
Edit the Index Block and check the value for the **Max Rendered Assets** field. Once the Index Block renders this number of assets, it will no longer add any additional assets. To rule this out as a potential cause, try temporarily increasing this value and then check to see if the missing asset is rendered as expected.
**Note** - There is a system preference that will override this value, so it is important to verify that it is not limiting the number of rendered assets as well. See the next item in this list for information on that setting.
### The 'Max Assets in Index Blocks' setting in Content Preferences is too low
Navigate to **Administration > Preferences > Content > Index Blocks **and check the value for the **Max Assets in Index Blocks** field. Verify that this number is higher than the **Max Rendered Assets** setting at the Index Block level. If needed, try increasing this value to see if the missing asset is then included in the Index Block.
### The Index Block 'Indexed Asset Types' setting does not include the asset
Edit the Index Block and make sure that the **Indexed Asset Types** field is configured to include the type of asset in question.
### The application is load balanced across one or more nodes and the cache is not synchronized
If the application is running in a load balanced environment, verify that your cache settings are configured properly as indicated on this page.
### The Index Block Rendering Cache is not discarding properly
If none of the scenarios above allow for the asset to appear in your Index Block, you can try discarding the Index Block Rendering Cache to force a new rendering. The following steps will discard the cache:
- Navigate to ** Administration > Preferences > Content > Index Blocks**
- In the **Index Block Rendering Cache** field, un-check the *Enabled* check box
- Click **Submit**
- Immediately go back into the Preferences and re-check the *Enabled* check box
- Click **Submit**
**Note** - On systems with extremely large Index Blocks, discarding the cache can temporarily affect performance as Index Blocks throughout the system are rendered again for the first time.
If discarding the cache allows for the asset to appear in your Index Block, contact the Hannon Hill Support Team (support at hannonhill.com) so that we can troubleshoot further.

---

### Assign To Content Owner of Asset Trigger

## Overview
This trigger assigns the following step (the step that will occur as a result of this action) to the content owner of the asset in workflow. This can be used to create a workflow that dynamically assigns a step, such as an approval step, to the content owner of the asset in workflow as opposed to a specific group or group with write access to the asset's parent folder (in case you have multiple).
## Declaration
```
<trigger class="com.cms.workflow.function.AssignToContentOwnerOfAsset" name="AssignToContentOwnerOfAsset"/>
```
## Usage
```
<trigger name="AssignToContentOwnerOfAsset"/>
```
## Parameters
None.
## Related Links
- Content Ownership Report
- My Content

---

### Assign To Group Owning Asset Trigger

## Overview
This trigger is used to assign the following workflow step to the group with write access to the parent folder of the asset in workflow.
- If there is no group with write access to the asset's parent folder, it assigns the following step to the owner of the current (source) step.
- If there is more than one group with write access to the asset's parent folder, it assigns the following step to only one of those groups. If your setup requires having more than one group with write access per folder, you may wish to use the AssignToContentOwnerOfAsset trigger.
## Declaration
```
<trigger class="com.cms.workflow.function.AssignToGroupOwningAsset" name="AssignToGroupOwningAsset"/>
```
## Usage
```
<trigger name="AssignToGroupOwningAsset"/>
```
## Parameters
None.

---

### Blocks

A block is a piece of content that can be inserted (with or without styling) into any page region.

---

### Copy Folder Trigger

## Overview
The Copy Folder Trigger copies the parent folder of an asset in workflow to a location designated by a parameter passed to the trigger. It also realigns structured data asset choosers for assets contained in the folder being copied so that the user does not have to realign the asset choosers manually.
Example: There exists a page 'p1' in folder 'a' that has a page chooser that points to a page 'p2' residing in folder 'a/b' (a child folder of 'a'). If folder 'a' is put into workflow and the Copy Folder Trigger is invoked, the page chooser in the copied 'p1' page will point to the page 'p2' in the new 'a/b' folder, rather than the page 'p2' contained in the original 'a/b' folder.
## Declaration
```
<trigger class="com.cms.workflow.function.CopyFolder" name="CopyFolder"/>
```
## Usage
```
<trigger name="CopyFolder"> <parameter> <name>destPath</name> <value>/CopyFolder/locale2</value> </parameter> </trigger>
```
## Parameters
##### destPath
```
<parameter> <name>destPath</name> <value>/CopyFolder/locale2</value> </parameter>
```
The destPath parameter is used to determine where the parent folder should publish to. If more than one location is required, these can be delimited by commas (",") within the same parameter.
##### basePath
```
<parameter> <name>basePath</name> <value>/CopyFolder/original</value> </parameter>
```
The basePath parameter is used when the folder to be copied should be copied into a sub-folder of the folder designated by the destPath parameter. By default, this parameter is given the value of the path of the parent folder of the folder being copied. This default ensures that any folders copied with the trigger will be created as a direct descendant of the destination folder.
Setting this parameter to a value that is higher in the folder hierarchy than the parent of the folder being copied makes it possible to use the Copy Folder Trigger to copy folders at any level deep below the folder corresponding to basePath to an analogous folder found in the destination folder.
For example, say there exists a folder '/base' (a direct child of the system base folder) which contains a folder 'a' which contains a folder 'b'; and the destPath has been specified as '/dest' (also a direct child of the system base folder).  Assume the basePath has been set to '/base'. Starting a workflow that uses the Copy Folder Trigger on an asset inside folder 'b' would cause the folder 'b' to be copied into the folder with path '/dest/a' (resulting in a folder with path '/dest/a/b'), because folder 'a' was below the folder designated as the basePath folder. Note that folder '/dest/a' has to exist before folder 'b' can be copied into it. The trigger will not automatically create a sub-tree of folders. The idea is that one would first use the Copy Folder Trigger to copy folder 'a' to all destPaths, and then folder 'b' would be created so that it could be copied after 'a' had been copied. If the goal is simply to copy an entire folder tree to another location, then this would not be necessary; a single folder copy would do the job. If, however, the goal is to incrementally copy folders and subfolders inside a particular 'base' folder to another specified location, you would use this parameter.
##### includeAssetInWorkflow
```
<parameter> <name>includeAssetInWorkflow</name> <value>true</value> </parameter>
```
This parameter indicates whether or not the asset originally put into workflow will be copied to the new location. It defaults to false.
It does not make sense to set this parameter to true if the asset is in a create workflow and has not been merged (using the Merge workflow trigger), because the asset is still a working copy and cannot be copied to a new location.
## Required Intermediate Step
The Copy Folder Trigger requires an intermediate transition step assigned to a default user that cannot be touched by any regular users. This intermediate step prevents users from clicking through the workflow before the Copy Folder Trigger has finished its copy. The intermediate step requires one action that moves to the next desired step after the copy is complete.
Example:
```
<step default-user="admin" identifier="copying" type="transition"> <actions> <action identifier="proceed" move="forward" type="auto"/> </actions> </step>
```

---

### Could not create index writer

Error messages similar to the following may appear in the *tomcat/logs/**cascade.log* file:
`Could not create index writer: `
`org.apache.lucene.store.LockObtainFailedException:`
`Lock obtain timed out: `
`@/usr/local/Cascade_Server/tomcat/indexes/write.lock`
To correct this problem, the following steps should be taken:
1. Stop Cascade CMS.
2. Remove the file *write.lock* from the location specified in the error message.
3. Start Cascade CMS.

---

### Could not get file content for lucene indexing

Users may see an error similar to the following when viewing the *tomcat/logs/**cascade.log* file:
`ERROR [SearchWorkerImpl] : Could not get file content for lucene indexing:
com.hannonhill.cascade.model.render.file.FileRenderException:
Could not fetch contents of file (id='97e7a2f60a000182011a542b7e51160d'): null`
This message indicates that the file with this particular id is corrupt. To clear the log file of this error, follow these steps:
1. Execute (or have your DBA execute) the following SQL query: ``` SELECT name, cachePath FROM cxml_foldercontent WHERE id = 'idFromErrorMessage'; ``` making sure to replace `idFromErrorMessage` with the 32-digit id seen in the log file.
2. Using the result from the query above, browse to the asset inside of Cascade CMS by using a direct link of the form: ``` https://{hostname}/entity/open.act?id={id}&type=page ``` where `{id}` is the id from the error message and `{hostname}` is the name of the application server.
3. Delete the asset by clicking **More > Delete**.

---

### Could not put file with path '&lt;path&gt;' onto server: Failure

When attempting to publish to an FTPS server, users may encounter messages like the following:
```
Could not put file with path '<path>' onto server: Failure
```
The most common cause for this error is that the target web server has run out of disk space. It is recommended to check (or have your web server administrator check) the available storage on the web server and ensure that there is plenty of space available.
If plenty of disk space is available on the target web server, check (or have your web server administrator check) the FTPS server logs on the web server for more details surrounding this error.

---

### Could not put file with path 'FILE_PATH' onto server: Permission denied

When publishing, users may see the following error message in their publish notifications:
```
Error occurred during SFTP transport: Could not put file with path 'FILE_PATH' onto server: Permission denied
```
This error indicates that the SFTP account being used to connect to the target server does not have write permissions to the directory specified in the message (FILE_PATH).
To resolve this issue, administrators should take the following steps:
- In the CMS, switch into the Site in question.
- Click **Manage Site.**
- Click **Destinations.**
- Locate the Destination in question (the one for which the error appeared) and click it.
- While viewing the Destination, click the link to the **Transport.**
- While viewing the Transport, make a note of value specified for the **Username** field.
- On the web server's filesystem, navigate to the directory indicated in the error message and ensure that the SFTP account (the Username from above) has Write permissions to that directory. 
**Note**: If you don't have direct access to the web server's filesystem, you will need to contact your web server administrator to have them ensure that the SFTP account in question has the necessary privileges to be able to Write to the directory (or directories) seen in the error(s). 
## Related Links
- Destinations
- Transports

---

### Create New Workflow Trigger

## Overview
This workflow trigger instantiates workflows for analogous assets to support translation capabilites or cross-site content synchronization.
This workflow trigger works on the premise that a client has their content set up in the following structure:
- en
- de
- fr
Assume the internet folder has a target named internet with base folder internet. Assume each of the subfolders has an asset "page" in them. These are the "analogous assets". Analagous assets must have the same name for this plugin to work.
Whenever one of these analogous assets is edited and placed into a workflow containing this trigger, this trigger will start corresponding edit workflows for the other two analogous assets. For example if /internet/en/page was edited, /internet/de/page and /internet/fr/page would be put into an edit workflow of the user's specification (denoted by the invoked-workflow-definition-path parameter).
## Declaration
```
<trigger class="com.cms.workflow.function.CreateNewWorkflowsTrigger" name="CreateNewWorkflow"/>
```
## Usage
```
<trigger name="CreateNewWorkflow"> <parameter> <name>target</name> <value>/internet/de</value> </parameter> <parameter> <name>base-folder</name> <value>/internet/en</value> </parameter> <parameter> <name>invoked-workflow-definition-path</name> <value>/translate_de</value> </parameter> <parameter> <name>owner</name> <value>some_user_with_write_access_to_de</value> </parameter> <parameter> <name>target</name> <value>/internet/fr</value> </parameter> <parameter> <name>base-folder</name> <value>/internet/en</value> </parameter> <parameter> <name>invoked-workflow-definition-path</name> <value>/translate_fr</value> </parameter> <parameter> <name>owner</name> <value>some_user_with_write_access_to_fr</value> </parameter> </trigger>
```
## Parameters
The trigger is capable of taking multiple parameters of the same name.
##### Invoked-Workflow-Destination-Path Parameter
The path of the Workflow Definition to be used by the trigger (e.g. Internet/1-Step-Edit-WF). 
##### Invoked-Workflow-Definition-Site-Name Parameter
Site name where the Workflow Definition is located. If no explicit Site is specified, the Workflow Definition is assumed to be in same Site as the asset in workflow.
##### Target Parameter
The target parameter specifies a target path that will be used to calculate the analogous asset paths. For this trigger to work properly, the target structure should mirror the folder structure, such that each individual folder (en, de, fr) has its own target (en, de, fr). In this example, a workflow is started on /internet/en/page, with additional workflows created for /internet/de/page and /internet/fr/page. The target parameter is set based on the workflows to be started - /internet/de, with the /internet/de folder as its base folder and /internet/fr, with the /interent/fr folder as its base folder.
##### Folder-Path Parameter
Alternatively, the folder-path parameter can be used which explicitly specifies the analogous assets’ base folders explained above.
##### Base-Folder Parameter
The base-folder parameter should specify base folder for current asset, meaning the asset on which this workflow is being executed on. In the example above it would be /internet/en.
In this example the relative folder path would be /fr for the French site and /de for the German site. Then the trigger will attempt to locate the analogous asset by building a path of the form $COMMON + $RELATIVE + $ASSET_NAME, which would yield /internet/fr/page and /internet/de/page for French and German sites, respectively. It then instantiates those assets into the edit workflow specified by invoked-workflow-definition-path whose owner will be specified by the owner parameter.
This trigger also handles creates and copies. For creates, when an asset is created a new additional asset with the same name and same data should be created in the folders where the other analogous assets live. The same goes for copies.
In total, the user will need to set up two workflow definitions (create, edit, copy) on each analogous folder. One workflow definition will be the workflow definition containing this trigger, which will spawn the workflows for the analogous assets. The other workflow definitions are the ones that will be spawned when an asset in some other analogous folder is created, edited, or copied.
In this example the administrator would set up the trigger in the workflow on the "en" folder to have the triggers set as such:
```
<parameter> <name>target</name> <value>/internet/de</value> </parameter> <parameter> <name>base-folder</name> <value>/internet/en</value> </parameter> <parameter> <name>invoked-workflow-definition-path</name> <value>/translate_de</value> </parameter> <parameter> <name>owner</name> <value>some_user_with_write_access_to_de</value> </parameter>
```
to handle "de" and
```
<parameter> <name>target</name> <value>/internet/fr</value> </parameter> <parameter> <name>base-folder</name> <value>/internet/fr</value> </parameter> <parameter> <name>invoked-workflow-definition-path</name> <value>/translate_fr</value> </parameter> <parameter> <name>owner</name> <value>some_user_with_write_access_to_fr</value> </parameter>
```
to handle "fr".

---

### Create Resized Images Plug-in

## Overview
This plug-in will create resized copies of the original image.
For example, this plug-in can be configured to create a 75x75-pixel thumbnail in addition to the 400x400-pixel image uploaded.
**Note** - This plug-in is applicable to Asset Factories for files only.**Note** - This plug-in relies on the Java Imaging API and is only able to work with freely-licensed image formats. This means this plug-in can work with JPEG, JPEG2000, BMP, PNG, and GIF images.
## Parameters
- **Number of additional images** - The number of images the plug-in will create in addition to the original.
- **Image widths/heights** - A comma-delimited list of widths/heights for the additional images. Example: 450,20%To use a pixel value, simply enter the number of pixels.
- To use a percentage, enter the percentage followed by the percent sign.
- A blank space character could be used as well as one of the values. This will cause the plug-in to calculate the width/height of the resized image so that the original aspect ratio is kept. Leaving both width and height values blank for the same image is not allowed.
Both the width and height comma-delimited lists must be specified and must contain an amount of comma-delimited values equal to the number of additional images.
## Examples
The following parameters will create one additional image that is 15% of the size of the original image. For example: If the original image is 1000x1000 pixels, the plug-in will create an additional 150x150-pixel copy.
- Number of Additional Images: 1
- Widths: 15%
- Height: 15%
The following parameters will create one additional image that is 200 pixels wide and 100 pixels tall. Note that because the width and height are both specified, the aspect ratio of the original image won't be maintained.
- Number of Additional Images: 1
- Widths: 200
- Height: 100
The following parameters will create one additional image that is 150 pixels tall, and the image's width will be calculated so that the original aspect ratio is maintained. For example: If the original image is 2000x1500 pixels, the plug-in will create an additional 200x150 pixel copy.
- Number of Additional Images: 1
- Widths:
- Height: 150
The following parameters will create two additional images. The first image will be 150 pixels wide, and the image's height will be calculated so that the original aspect ratio is maintained. The second image will be 300 pixels wide and 200 pixels tall, and the original aspect ratio will *not* be maintained.
- Number of Additional Images: 2
- Widths: 150,300
- Height: ,200
The following parameters will create two additional images, one 150 pixels tall and one 300 pixels tall, and the images' widths will be calculated so that the original aspect ratio is maintained.
- Number of Additional Images: 2
- Widths: ,
- Height: 150,300
**Note** - When using this plug-in, if you specify that a workflow should not be used, the plug-in will bypass any create workflow in place for the placement folder, regardless of whether the user has the rights to do so or not.

---

### CSS Editor Snippets

**.** - ${1} {, ${2}, }
**!** - !important
**bdi:m+** - -moz-border-image: url(${1}) ${2:0} ${3:0} ${4:0} ${5:0} ${6:stretch} ${7:stretch};
**bdi:m** - -moz-border-image: ${1};
**bdrz:m** - -moz-border-radius: ${1};
**bxsh:m+** - -moz-box-shadow: ${1:0} ${2:0} ${3:0} #${4:000};
**bxsh:m** - -moz-box-shadow: ${1};
**bdi:w+** - -webkit-border-image: url(${1}) ${2:0} ${3:0} ${4:0} ${5:0} ${6:stretch} ${7:stretch};
**bdi:w** - -webkit-border-image: ${1};
**bdrz:w** - -webkit-border-radius: ${1};
**bxsh:w+** - -webkit-box-shadow: ${1:0} ${2:0} ${3:0} #${4:000};
**bxsh:w** - -webkit-box-shadow: ${1};
**@f** - @font-face {, font-family: ${1};, src: url(${2});, }
**@i** - @import url(${1});
**@m** - @media ${1:print} {, ${2}, }
**bg+** - background: #${1:FFF} url(${2}) ${3:0} ${4:0} ${5:no-repeat};
**bga** - background-attachment: ${1};
**bga:f** - background-attachment: fixed;
**bga:s** - background-attachment: scroll;
**bgbk** - background-break: ${1};
**bgbk:bb** - background-break: bounding-box;
**bgbk:c** - background-break: continuous;
**bgbk:eb** - background-break: each-box;
**bgcp** - background-clip: ${1};
**bgcp:bb** - background-clip: border-box;
**bgcp:cb** - background-clip: content-box;
**bgcp:nc** - background-clip: no-clip;
**bgcp:pb** - background-clip: padding-box;
**bgc** - background-color: #${1:FFF};
**bgc:t** - background-color: transparent;
**bgi** - background-image: url(${1});
**bgi:n** - background-image: none;
**bgo** - background-origin: ${1};
**bgo:bb** - background-origin: border-box;
**bgo:cb** - background-origin: content-box;
**bgo:pb** - background-origin: padding-box;
**bgpx** - background-position-x: ${1};
**bgpy** - background-position-y: ${1};
**bgp** - background-position: ${1:0} ${2:0};
**bgr** - background-repeat: ${1};
**bgr:n** - background-repeat: no-repeat;
**bgr:x** - background-repeat: repeat-x;
**bgr:y** - background-repeat: repeat-y;
**bgr:r** - background-repeat: repeat;
**bgz** - background-size: ${1};
**bgz:a** - background-size: auto;
**bgz:ct** - background-size: contain;
**bgz:cv** - background-size: cover;
**bg** - background: ${1};
**bg:ie** - filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='${1}', sizingMethod='${2:crop}');
**bg:n** - background: none;
**bd+** - border: ${1:1px} ${2:solid} #${3:000};
**bdb+** - border-bottom: ${1:1px} ${2:solid} #${3:000};
**bdbc** - border-bottom-color: #${1:000};
**bdbi** - border-bottom-image: url(${1});
**bdbi:n** - border-bottom-image: none;
**bdbli** - border-bottom-left-image: url(${1});
**bdbli:c** - border-bottom-left-image: continue;
**bdbli:n** - border-bottom-left-image: none;
**bdblrz** - border-bottom-left-radius: ${1};
**bdbri** - border-bottom-right-image: url(${1});
**bdbri:c** - border-bottom-right-image: continue;
**bdbri:n** - border-bottom-right-image: none;
**bdbrrz** - border-bottom-right-radius: ${1};
**bdbs** - border-bottom-style: ${1};
**bdbs:n** - border-bottom-style: none;
**bdbw** - border-bottom-width: ${1};
**bdb** - border-bottom: ${1};
**bdb:n** - border-bottom: none;
**bdbk** - border-break: ${1};
**bdbk:c** - border-break: close;
**bdcl** - border-collapse: ${1};
**bdcl:c** - border-collapse: collapse;
**bdcl:s** - border-collapse: separate;
**bdc** - border-color: #${1:000};
**bdci** - border-corner-image: url(${1});
**bdci:c** - border-corner-image: continue;
**bdci:n** - border-corner-image: none;
**bdf** - border-fit: ${1};
**bdf:c** - border-fit: clip;
**bdf:of** - border-fit: overwrite;
**bdf:ow** - border-fit: overwrite;
**bdf:r** - border-fit: repeat;
**bdf:sc** - border-fit: scale;
**bdf:sp** - border-fit: space;
**bdf:st** - border-fit: stretch;
**bdi** - border-image: url(${1}) ${2:0} ${3:0} ${4:0} ${5:0} ${6:stretch} ${7:stretch};
**bdi:n** - border-image: none;
**bdl+** - border-left: ${1:1px} ${2:solid} #${3:000};
**bdlc** - border-left-color: #${1:000};
**bdli** - border-left-image: url(${1});
**bdli:n** - border-left-image: none;
**bdls** - border-left-style: ${1};
**bdls:n** - border-left-style: none;
**bdlw** - border-left-width: ${1};
**bdl** - border-left: ${1};
**bdl:n** - border-left: none;
**bdlt** - border-length: ${1};
**bdlt:a** - border-length: auto;
**bdrz** - border-radius: ${1};
**bdr+** - border-right: ${1:1px} ${2:solid} #${3:000};
**bdrc** - border-right-color: #${1:000};
**bdri** - border-right-image: url(${1});
**bdri:n** - border-right-image: none;
**bdrs** - border-right-style: ${1};
**bdrs:n** - border-right-style: none;
**bdrw** - border-right-width: ${1};
**bdr** - border-right: ${1};
**bdr:n** - border-right: none;
**bdsp** - border-spacing: ${1};
**bds** - border-style: ${1};
**bds:ds** - border-style: dashed;
**bds:dtds** - border-style: dot-dash;
**bds:dtdtds** - border-style: dot-dot-dash;
**bds:dt** - border-style: dotted;
**bds:db** - border-style: double;
**bds:g** - border-style: groove;
**bds:h** - border-style: hidden;
**bds:i** - border-style: inset;
**bds:n** - border-style: none;
**bds:o** - border-style: outset;
**bds:r** - border-style: ridge;
**bds:s** - border-style: solid;
**bds:w** - border-style: wave;
**bdt+** - border-top: ${1:1px} ${2:solid} #${3:000};
**bdtc** - border-top-color: #${1:000};
**bdti** - border-top-image: url(${1});
**bdti:n** - border-top-image: none;
**bdtli** - border-top-left-image: url(${1});
**bdtli:c** - border-corner-image: continue;
**bdtli:n** - border-corner-image: none;
**bdtlrz** - border-top-left-radius: ${1};
**bdtri** - border-top-right-image: url(${1});
**bdtri:c** - border-top-right-image: continue;
**bdtri:n** - border-top-right-image: none;
**bdtrrz** - border-top-right-radius: ${1};
**bdts** - border-top-style: ${1};
**bdts:n** - border-top-style: none;
**bdtw** - border-top-width: ${1};
**bdt** - border-top: ${1};
**bdt:n** - border-top: none;
**bdw** - border-width: ${1};
**bd** - border: ${1};
**bd:n** - border: none;
**b** - bottom: ${1};
**b:a** - bottom: auto;
**bxsh+** - box-shadow: ${1:0} ${2:0} ${3:0} #${4:000};
**bxsh** - box-shadow: ${1};
**bxsh:n** - box-shadow: none;
**bxz** - box-sizing: ${1};
**bxz:bb** - box-sizing: border-box;
**bxz:cb** - box-sizing: content-box;
**cps** - caption-side: ${1};
**cps:b** - caption-side: bottom;
**cps:t** - caption-side: top;
**cl** - clear: ${1};
**cl:b** - clear: both;
**cl:l** - clear: left;
**cl:n** - clear: none;
**cl:r** - clear: right;
**cp** - clip: ${1};
**cp:a** - clip: auto;
**cp:r** - clip: rect(${1:0} ${2:0} ${3:0} ${4:0});
**c** - color: #${1:000};
**ct** - content: ${1};
**ct:a** - content: attr(${1});
**ct:cq** - content: close-quote;
**ct:c** - content: counter(${1});
**ct:cs** - content: counters(${1});
**ct:ncq** - content: no-close-quote;
**ct:noq** - content: no-open-quote;
**ct:n** - content: normal;
**ct:oq** - content: open-quote;
**coi** - counter-increment: ${1};
**cor** - counter-reset: ${1};
**cur** - cursor: ${1};
**cur:a** - cursor: auto;
**cur:c** - cursor: crosshair;
**cur:d** - cursor: default;
**cur:ha** - cursor: hand;
**cur:he** - cursor: help;
**cur:m** - cursor: move;
**cur:p** - cursor: pointer;
**cur:t** - cursor: text;
**d** - display: ${1};
**d:mib** - display: -moz-inline-box;
**d:mis** - display: -moz-inline-stack;
**d:b** - display: block;
**d:cp** - display: compact;
**d:ib** - display: inline-block;
**d:itb** - display: inline-table;
**d:i** - display: inline;
**d:li** - display: list-item;
**d:n** - display: none;
**d:ri** - display: run-in;
**d:tbcp** - display: table-caption;
**d:tbc** - display: table-cell;
**d:tbclg** - display: table-column-group;
**d:tbcl** - display: table-column;
**d:tbfg** - display: table-footer-group;
**d:tbhg** - display: table-header-group;
**d:tbrg** - display: table-row-group;
**d:tbr** - display: table-row;
**d:tb** - display: table;
**ec** - empty-cells: ${1};
**ec:h** - empty-cells: hide;
**ec:s** - empty-cells: show;
**exp** - expression()
**fl** - float: ${1};
**fl:l** - float: left;
**fl:n** - float: none;
**fl:r** - float: right;
**f+** - font: ${1:1em} ${2:Arial}, ${3:sans-serif};
**fef** - font-effect: ${1};
**fef:eb** - font-effect: emboss;
**fef:eg** - font-effect: engrave;
**fef:n** - font-effect: none;
**fef:o** - font-effect: outline;
**femp** - font-emphasize-position: ${1};
**femp:a** - font-emphasize-position: after;
**femp:b** - font-emphasize-position: before;
**fems** - font-emphasize-style: ${1};
**fems:ac** - font-emphasize-style: accent;
**fems:c** - font-emphasize-style: circle;
**fems:ds** - font-emphasize-style: disc;
**fems:dt** - font-emphasize-style: dot;
**fems:n** - font-emphasize-style: none;
**fem** - font-emphasize: ${1};
**ff** - font-family: ${1};
**ff:c** - font-family: ${1:'Monotype Corsiva','Comic Sans MS'}, cursive;
**ff:f** - font-family: ${1:Capitals - Impact}, fantasy;
**ff:m** - font-family: ${1:Monaco - 'Courier New'}, monospace;
**ff:ss** - font-family: ${1:Helvetica - Arial}, sans-serif;
**ff:s** - font-family: ${1:Georgia - 'Times New Roman'}, serif;
**fza** - font-size-adjust: ${1};
**fza:n** - font-size-adjust: none;
**fz** - font-size: ${1};
**fsm** - font-smooth: ${1};
**fsm:aw** - font-smooth: always;
**fsm:a** - font-smooth: auto;
**fsm:n** - font-smooth: never;
**fst** - font-stretch: ${1};
**fst:c** - font-stretch: condensed;
**fst:e** - font-stretch: expanded;
**fst:ec** - font-stretch: extra-condensed;
**fst:ee** - font-stretch: extra-expanded;
**fst:n** - font-stretch: normal;
**fst:sc** - font-stretch: semi-condensed;
**fst:se** - font-stretch: semi-expanded;
**fst:uc** - font-stretch: ultra-condensed;
**fst:ue** - font-stretch: ultra-expanded;
**fs** - font-style: ${1};
**fs:i** - font-style: italic;
**fs:n** - font-style: normal;
**fs:o** - font-style: oblique;
**fv** - font-variant: ${1};
**fv:n** - font-variant: normal;
**fv:sc** - font-variant: small-caps;
**fw** - font-weight: ${1};
**fw:b** - font-weight: bold;
**fw:br** - font-weight: bolder;
**fw:lr** - font-weight: lighter;
**fw:n** - font-weight: normal;
**f** - font: ${1};
**h** - height: ${1};
**h:a** - height: auto;
**l** - left: ${1};
**l:a** - left: auto;
**lts** - letter-spacing: ${1};
**lh** - line-height: ${1};
**lisi** - list-style-image: url(${1});
**lisi:n** - list-style-image: none;
**lisp** - list-style-position: ${1};
**lisp:i** - list-style-position: inside;
**lisp:o** - list-style-position: outside;
**list** - list-style-type: ${1};
**list:c** - list-style-type: circle;
**list:dclz** - list-style-type: decimal-leading-zero;
**list:dc** - list-style-type: decimal;
**list:d** - list-style-type: disc;
**list:lr** - list-style-type: lower-roman;
**list:n** - list-style-type: none;
**list:s** - list-style-type: square;
**list:ur** - list-style-type: upper-roman;
**lis** - list-style: ${1};
**lis:n** - list-style: none;
**mb** - margin-bottom: ${1};
**mb:a** - margin-bottom: auto;
**ml** - margin-left: ${1};
**ml:a** - margin-left: auto;
**mr** - margin-right: ${1};
**mr:a** - margin-right: auto;
**mt** - margin-top: ${1};
**mt:a** - margin-top: auto;
**m** - margin: ${1};
**m:4** - margin: ${1:0} ${2:0} ${3:0} ${4:0};
**m:3** - margin: ${1:0} ${2:0} ${3:0};
**m:2** - margin: ${1:0} ${2:0};
**m:0** - margin: 0;
**m:a** - margin: auto;
**mah** - max-height: ${1};
**mah:n** - max-height: none;
**maw** - max-width: ${1};
**maw:n** - max-width: none;
**mih** - min-height: ${1};
**miw** - min-width: ${1};
**op** - opacity: ${1};
**op:ie** - filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=${1:100});
**op:ms** - -ms-filter: 'progid:DXImageTransform.Microsoft.Alpha(Opacity=${1:100})';
**orp** - orphans: ${1};
**o+** - outline: ${1:1px} ${2:solid} #${3:000};
**oc** - outline-color: ${1:#000};
**oc:i** - outline-color: invert;
**oo** - outline-offset: ${1};
**os** - outline-style: ${1};
**ow** - outline-width: ${1};
**o** - outline: ${1};
**o:n** - outline: none;
**ovs** - overflow-style: ${1};
**ovs:a** - overflow-style: auto;
**ovs:mq** - overflow-style: marquee;
**ovs:mv** - overflow-style: move;
**ovs:p** - overflow-style: panner;
**ovs:s** - overflow-style: scrollbar;
**ovx** - overflow-x: ${1};
**ovx:a** - overflow-x: auto;
**ovx:h** - overflow-x: hidden;
**ovx:s** - overflow-x: scroll;
**ovx:v** - overflow-x: visible;
**ovy** - overflow-y: ${1};
**ovy:a** - overflow-y: auto;
**ovy:h** - overflow-y: hidden;
**ovy:s** - overflow-y: scroll;
**ovy:v** - overflow-y: visible;
**ov** - overflow: ${1};
**ov:a** - overflow: auto;
**ov:h** - overflow: hidden;
**ov:s** - overflow: scroll;
**ov:v** - overflow: visible;
**pb** - padding-bottom: ${1};
**pl** - padding-left: ${1};
**pr** - padding-right: ${1};
**pt** - padding-top: ${1};
**p** - padding: ${1};
**p:4** - padding: ${1:0} ${2:0} ${3:0} ${4:0};
**p:3** - padding: ${1:0} ${2:0} ${3:0};
**p:2** - padding: ${1:0} ${2:0};
**p:0** - padding: 0;
**pgba** - page-break-after: ${1};
**pgba:aw** - page-break-after: always;
**pgba:a** - page-break-after: auto;
**pgba:l** - page-break-after: left;
**pgba:r** - page-break-after: right;
**pgbb** - page-break-before: ${1};
**pgbb:aw** - page-break-before: always;
**pgbb:a** - page-break-before: auto;
**pgbb:l** - page-break-before: left;
**pgbb:r** - page-break-before: right;
**pgbi** - page-break-inside: ${1};
**pgbi:a** - page-break-inside: auto;
**pgbi:av** - page-break-inside: avoid;
**pos** - position: ${1};
**pos:a** - position: absolute;
**pos:f** - position: fixed;
**pos:r** - position: relative;
**pos:s** - position: static;
**q** - quotes: ${1};
**q:en** - quotes: '\201C' '\201D' '\2018' '\2019';
**q:n** - quotes: none;
**q:ru** - quotes: '\00AB' '\00BB' '\201E' '\201C';
**rz** - resize: ${1};
**rz:b** - resize: both;
**rz:h** - resize: horizontal;
**rz:n** - resize: none;
**rz:v** - resize: vertical;
**r** - right: ${1};
**r:a** - right: auto;
**tbl** - table-layout: ${1};
**tbl:a** - table-layout: auto;
**tbl:f** - table-layout: fixed;
**tal** - text-align-last: ${1};
**tal:a** - text-align-last: auto;
**tal:c** - text-align-last: center;
**tal:l** - text-align-last: left;
**tal:r** - text-align-last: right;
**ta** - text-align: ${1};
**ta:c** - text-align: center;
**ta:l** - text-align: left;
**ta:r** - text-align: right;
**td** - text-decoration: ${1};
**td:l** - text-decoration: line-through;
**td:n** - text-decoration: none;
**td:o** - text-decoration: overline;
**td:u** - text-decoration: underline;
**te** - text-emphasis: ${1};
**te:ac** - text-emphasis: accent;
**te:a** - text-emphasis: after;
**te:b** - text-emphasis: before;
**te:c** - text-emphasis: circle;
**te:ds** - text-emphasis: disc;
**te:dt** - text-emphasis: dot;
**te:n** - text-emphasis: none;
**th** - text-height: ${1};
**th:a** - text-height: auto;
**th:f** - text-height: font-size;
**th:m** - text-height: max-size;
**th:t** - text-height: text-size;
**ti** - text-indent: ${1};
**ti:-** - text-indent: -9999px;
**tj** - text-justify: ${1};
**tj:a** - text-justify: auto;
**tj:d** - text-justify: distribute;
**tj:ic** - text-justify: inter-cluster;
**tj:ii** - text-justify: inter-ideograph;
**tj:iw** - text-justify: inter-word;
**tj:k** - text-justify: kashida;
**tj:t** - text-justify: tibetan;
**to+** - text-outline: ${1:0} ${2:0} #${3:000};
**to** - text-outline: ${1};
**to:n** - text-outline: none;
**tr** - text-replace: ${1};
**tr:n** - text-replace: none;
**tsh+** - text-shadow: ${1:0} ${2:0} ${3:0} #${4:000};
**tsh** - text-shadow: ${1};
**tsh:n** - text-shadow: none;
**tt** - text-transform: ${1};
**tt:c** - text-transform: capitalize;
**tt:l** - text-transform: lowercase;
**tt:n** - text-transform: none;
**tt:u** - text-transform: uppercase;
**tw** - text-wrap: ${1};
**tw:no** - text-wrap: none;
**tw:n** - text-wrap: normal;
**tw:s** - text-wrap: suppress;
**tw:u** - text-wrap: unrestricted;
**t** - top: ${1};
**t:a** - top: auto;
**va** - vertical-align: ${1};
**va:bl** - vertical-align: baseline;
**va:b** - vertical-align: bottom;
**va:m** - vertical-align: middle;
**va:sub** - vertical-align: sub;
**va:sup** - vertical-align: super;
**va:tb** - vertical-align: text-bottom;
**va:tt** - vertical-align: text-top;
**va:t** - vertical-align: top;
**v** - visibility: ${1};
**v:c** - visibility: collapse;
**v:h** - visibility: hidden;
**v:v** - visibility: visible;
**whsc** - white-space-collapse: ${1};
**whsc:ba** - white-space-collapse: break-all;
**whsc:bs** - white-space-collapse: break-strict;
**whsc:k** - white-space-collapse: keep-all;
**whsc:l** - white-space-collapse: loose;
**whsc:n** - white-space-collapse: normal;
**whs** - white-space: ${1};
**whs:n** - white-space: normal;
**whs:nw** - white-space: nowrap;
**whs:pl** - white-space: pre-line;
**whs:pw** - white-space: pre-wrap;
**whs:p** - white-space: pre;
**wid** - widows: ${1};
**w** - width: ${1};
**w:a** - width: auto;
**wob** - word-break: ${1};
**wob:ba** - word-break: break-all;
**wob:bs** - word-break: break-strict;
**wob:k** - word-break: keep-all;
**wob:l** - word-break: loose;
**wob:n** - word-break: normal;
**wos** - word-spacing: ${1};
**wow** - word-wrap: ${1};
**wow:no** - word-wrap: none;
**wow:n** - word-wrap: normal;
**wow:s** - word-wrap: suppress;
**wow:u** - word-wrap: unrestricted;
**z** - z-index: ${1};
**z:a** - z-index: auto;
**zoo** - zoom: 1;

---

### Delete Parent Folder Trigger

## Overview
This trigger deletes the parent folder of the asset in workflow as well as all contents of that folder. It should be called after all approvals are complete.
## Declaration
```
<trigger class="com.cms.workflow.function.DeleteParentFolderTrigger" name="DeleteParentFolder"/>
```
## Usage
```
<trigger name="DeleteParentFolder"/>
```
## Parameters
None.

---

### Delete Trigger

## Overview
This trigger deletes the asset in workflow and should be called after all approvals are complete.
**Note** - For publishable assets, we recommend using the UnpublishAndDelete trigger. This ensures the asset is unpublished before being deleted and avoids leaving files orphaned on the web server.**Note** - After the Delete trigger is called, there is no longer an asset in workflow and the workflow is effectively over. Any asset-based triggers called after this will be ignored.
## Declaration
```
<trigger class="com.cms.workflow.function.Delete" name="Delete"/>
```
## Usage
```
<trigger name="Delete"/>
```
## Parameters
None.

---

### Drafts and Working Copies

## Drafts
When you edit an asset, Cascade CMS automatically saves a Draft of your changes. Drafts allow you to preview your changes as you make them without having to manually save a new version of the asset each time. This is especially useful for assets which require workflow, because you can edit and preview the asset as many times as needed before submitting it into workflow. You can preview those changes before submitting them by clicking **Show Edit Preview** (for page assets) or **Preview Draft**.
When viewing an asset you have a Draft for, you'll be shown your Draft first if it's newer than the Current Version. You can switch to the Current Version using the dropdown next to the title. You'll also be reminded if you start to edit an asset you already have an existing Draft for.
You can see all of your existing Drafts in the My Content menu or dashboard widget under **Drafts**.
**Note** - Drafts can't be shared with other users and aren't visible to others viewing the same page. To create a shareable Working Copy which also prevents users from editing the same asset you're working on, you need to Check-out/Lock the asset instead (see below).
## Checking Out / Locking Assets
You can exclusively check-out / lock any asset you have write access to by clicking **More** > **Check-out/Lock**.
Locking an asset creates a Working Copy, with which you can:
- **Commit Changes** - finalize and submit the changes or send them into workflow.
- **Break Lock** - discard your changes.
- **Reassign lock to another user** - transfer the lock and working copy ownership (they must also have write access).
When previewing a locked asset, you'll be shown the Working Copy first. You can switch to the Current Version using the dropdown next to the title.
You can see all of your existing Working Copies in the My Content menu or dashboard widget under **Locked Assets**.

---

### Editable Fields

## Overview

When viewing a page in Cascade CMS, every region will contain content. Some of it is static content, but some of it makes up the most important material you'll want to change on a page. All page-related content, particularly the most important content on a page, can be made editable while viewing the page and not only from the page's Edit screen.
Regions with editable fields will be highlighted when hovering over them. Click the **Edit Content **link to view a smaller, more focused dialog with editable content from that region. Make any necessary changes and click **Preview Draft** to see them updated on the page.
## Enabling In-Context Editing
To enable in-context editing for page fields, configure the Editable Fields in its Content Type.

---

### Enabling or Disabling TLS Versions

To allow (or restrict) specific TLS protocols for the application to use:
1. Stop Cascade CMS.
2. Edit the file `tomcat/conf/server.xml`.
3. Locate your existing SSL/TLS Connector.
4. Add the `sslEnabledProtocols` attribute along with TLS protocols that you wish to allow/restrict. For example: - `sslEnabledProtocols="TLSv1.2"` - to force TLSv1.2 only - `sslEnabledProtocols="TLSv1.2+TLSv1.3"` - to allow both TLSv1.2 and TLSv1.3
5. Save the file
6. Start Cascade CMS
A sample Connector that allows for TLSv1.2 and TLSv1.3 can be seen below:
```
<Connector port="8443" protocol="org.apache.coyote.http11.Http11NioProtocol" keystorePass="keystorePass" keystoreFile="pathToKeystore" maxThreads="256" maxPostSize="40000000" maxParameterCount="1000000" connectionTimeout="20000" maxSwallowSize="-1" SSLEnabled="true" sslEnabledProtocols="TLSv1.2+TLSv1.3" scheme="https" secure="true" clientAuth="false" sslProtocol="TLS" compression="on" compressionMinSize="1024" noCompressionUserAgents="gozilla, traviata" compressibleMimeType="application/javascript,application/json,application/rss+xml,application/vnd.ms-fontobject,application/font-sfnt,application/font-woff,font/opentype,font/woff2,application/x-javascript,application/xhtml+xml,application/xml,font/eot,font/opentype,image/svg+xml,image/vnd.microsoft.icon,image/x-icon,text/css,text/html,text/javascript,text/plain,text/xml" />
```
See the official [Apache Tomcat documentation](https://tomcat.apache.org/tomcat-9.0-doc/config/http.html#SSL_Support) for additional information. 
**Tip**: Be sure to document any changes you make to the `server.xml` file so that you can put them back in place after any future upgrades to the application.
``

## Related Links
- SSL/TLS Configuration

---

### Error executing SQL DELETE FROM `cxml_history_item`

The following error message may appear when upgrading to Cascade 8 against a version of MySQL 5.7 prior to release 5.7.11:
```
Migration failed for change set com/hannonhill/cascade/model/database/updater/updates/8_0/8_0_006.xml::8_0_006::artur.tomusiak: Reason: liquibase.exception.JDBCException: Error executing SQL DELETE FROM `cxml_history_item` WHERE id in (select hi.id from cxml_foldercontent fc left join (select * from cxml_history_item) hi on fc.id=hi.entityId where hi.entityId isnot null and fc.siteId is null): Caused By: Error executing SQL DELETE FROM `cxml_history_item` WHERE id in (select hi.id from cxml_foldercontent fc left join (select * from cxml_history_item) hi on fc.id=hi.entityId where hi.entityId isnot null and fc.siteId is null): Caused By: You can't specify target table 'cxml_history_item' for update in FROM clause
```
The underlying issue is related to [this MySQL bug](https://bugs.mysql.com/bug.php?id=79333) which has been corrected in MySQL 5.7.11. To resolve the issue, upgrade your MySQL instance to 5.7.11 or above.

---

### Feed Blocks

## Overview
XML feed blocks pull their XML content from a web location. This can be useful when aggregating outside RSS links or receiving output from dynamic scripts or web applications that produce XML.
XML feed blocks have one parameter, the feed URL, which is the location that will respond with an XML document. Cascade CMS then takes that XML content and populates the block with it. The block can then be styled using an format and included in a page region just like any other block in the system.
## Creating a Feed Block
To create a feed block:
1. Click **Add Content** > **Default** > **Block.**
2. Select **Feed** and click **Choose**.
3. In the **Name** field, enter a name for your block.
4. In the **Placement Folder** field, choose the folder where the block should be created.
5. In the **Feed URL** field, enter the fully-qualified URL of a valid XML feed.
6. Click **Preview Draft** and **Submit**.
**Note:** Unless otherwise noted by Hannon Hill Support, Feed Block responses are cached for 5 minutes.

---

### File Limit Plug-in

## Overview
This plugin limits file assets to a specific size and/or system name.
For example, this plug-in can be configured to limit file extensions to .jpg or .png and the file size to <10MB. If either of those conditions are not satisfied, the asset won't be created and a message will be displayed to the user explaining why.
## Parameters
- **Size** – Files created by this Asset Factory may not be larger than this size (in kilobytes).
- **Filename Regex** – The system name of files created by this Asset Factory must match this regular expression. This is useful for restricting file extensions for documents and images. 
**Note** - This plug-in is applicable to Asset Factories for files only.**Note** - This plug-in will supercede asset naming rules for file assets. To prevent confusion, it's recommended that your regular expression comply with the site's asset naming rules for file assets.**Note** - The regex must be PCRE (Perl-compatible regular expressions).

---

### Files

Files are content typically created by external programs and imported for use in Cascade CMS.

---

### Folders

You can use folders and subfolders to contain and organize your Site Content assets.

---

### Friendly Page Name Plug-in

## Overview
This plug-in validates the system name of new page assets against a configurable regular expression.
**Note** - This plug-in is applicable to Asset Factories for pages only.**Note** - This plug-in will supercede asset naming rules for page assets. To prevent confusion, it's recommended that your regular expression comply with the site's asset naming rules.
## Parameters
- **Name Regex** - The system name of pages created by this Asset Factory must match this regular expression.

---

### Generate a HAR file

The Hannon Hill Support Team may request that you generate a HAR file as part of a support investigation. Below we'll outline the steps to do this in Firefox, although the steps are very similar in other browsers:
- Navigate to the area of the CMS where the problem is occurring
- Open the Firefox Application Menu (top right of the browser)
- Click **More Tools -> Web Developer Tools **(or right-click anywhere in the page and click **Inspect**)
- Once the developer tools appear, switch to the **Network** tab
- In the developer tools area, click the **Clear** icon (the trash can icon) to remove any network requests currently listed
- Perform the action in the CMS that is resulting in an error or otherwise causing problems
At this point, the **Network** area will be populated with a number of requests as a result of the action.
- Right-click anywhere in the Network area (on any request) and select **Save all as HAR**
- Give the file a name that makes sense and Save
**CAUTION**: HAR files may contain sensitive data including passwords, keys, and other items. We recommend taking additional steps before making HAR files available to others:
- Open the HAR file in a text editor on your machine
- Review the contents for any sensitive information and remove/redact as needed
- Save the file

---

### Granting Access to Specific Folders for Users/Groups

Since Sites typically consist of multiple Folders, there may be scenarios where you're looking to 'hide' many of those from particular Users and/or Groups.
Take the following Folder structure into consideration:
- `<Base Folder of Site>```FolderAPageA
- PageB
FolderBFolderC
Now, consider a use case where you'd like to allow *GroupA* to only see `FolderA`* *(and not see `FolderB` or `FolderC`).
To do this, we must first ensure that *GroupA* has at least Read access to `<Base Folder of Site>`:
- Navigate to `<Base Folder of Site>`
- Click **More -> Access**
- Verify that at least one of the following is true:The **Access level for all users** is set to at least **Read**
- *GroupA* has been granted explicit **Read** (or Write) access under the **Grant access rights for specific users and/or groups **section
This is what allows *GroupA* to see the root folder of the Site (which is necessary in order to be able to see anything underneath it).
Now, we need to configure the sub-Folders underneath `<Base Folder of Site>` so that nobody can see them by default.
- Navigate to `FolderA`
- Click **More -> Access**
- Under **Access level for all users**, select **None**
- Click **Update**
- Repeat the steps above for `FolderB` and `FolderC`
At this point, we've revoked/removed the ability for anyone to see any of the Folders in the Site (aside from Users with an Administrator Role). Now, to allow *GroupA* to see `FolderA`:
- Navigate to `FolderA`
- Click **More -> Access**
- Under the **Grant access rights for specific users and/or groups **field:In the **Access level** dropdown, select **Read**
- Click **Choose Users and Groups**, then select *GroupA*
- Click **Update**
Finally, while *GroupA *can now see `FolderA`, let's ensure that they can edit all of the Pages underneath that Folder:
- Navigate to `FolderA```
- Click **More -> Access for Contents**
- Under **Grant access rights for specific users and/or groups**, click the link to **Copy user and group access rights from current folder**
- At the very bottom of the screen, click the **Access level** dropdown shown next to *GroupA *and change it to **Write**
- Click **Merge Access Rights**
**Note: **The steps in this article describe the most basic method for configuring Access Rights in such a way that assets can be hidden from Users/Groups who do not have explicit access granted to them. Depending on the existing Access Rights implementation in your Site(s), there may be certain challenges to overcome when you're looking to apply the strategy mentioned here. If you aren't quite sure how to accomplish what you're looking to do, feel free to reach out to our Support team with details on your setup and we'll be happy to provide recommendations as needed.**Tip**: This walkthrough focuses on assigning access rights to a Group of Users as opposed to individual User accounts. While the same steps can be used to assign access rights to individual Users, it is always recommended to assign Group access wherever possible as this makes managing/maintaining the environment much simpler moving forward.

---

### How can I view the largest binary files within my database?

The following SQL queries will list files from your database from largest to smallest.
**SQL Server**
```
SELECT s.name as site_name, f.cachePath, b.id, datalength(data) FROM cxml_blob b join cxml_foldercontent f on b.id=f.fileBlobId join cxml_site s on s.id = f.siteid order by datalength(data) DESC;
```
**Oracle**
```
SELECT f.cachePath, b.id, dbms_lob.getLength(data) FROM dbNameHere.cxml_blob b join dbNameHere.cxml_foldercontent f on b.id=f.fileBlobId order by dbms_lob.getLength(data) DESC nulls last;
```
Note: Replace `dbNameHere` with your actual database name.
**MySQL**
```
SELECT s.name as site_name, f.cachePath, b.id, OCTET_LENGTH(data) FROM cxml_blob b join cxml_foldercontent f on b.id=f.fileBlobId join cxml_site s on s.id = f.siteid order by OCTET_LENGTH(data) DESC;
```

## Related Links
- Database Size Management Tips

---

### How do I access a chooser field's chosen asset?

## Cascade API
When working with the Cascade API and choosers, there is an `asset` property which will be set to the chosen asset's API Object if an asset is chosen, or `null` if no asset is chosen.
Because the `asset` property will be `null` if no asset is chosen , it is advised to ensure an asset is chosen before attempting to access it's properties.
Consider the following example:
```
#set ($thumbnailImage = $currentPage.getStructuredDataNode("thumbnail-image")) #if (!$_PropertyTool.isNull($thumbnailImage.asset)) <img src="${thumbnailImage.asset.link}" />#end
```
## Index Block and XPath Tool
When working with Index Blocks and choosers, the chooser field will contain a number of XML elements which provide information about the given asset, such as: name, path, link, site, etc. If no asset is chosen, a `path` of `/` will be present and no additional XML elements.
Much like accessing chosen assets using the Cascade API, it is advised to first check if an asset is chosen before attempting to access more information about the chosen asset.
Consider the following example:
```
#set ($thumbnailImage = $_XPathTool.selectSingleNode($contentRoot, "/system-index-block/calling-page/system-page/system-data-structure/thumbnail-image[path != '/']"))#if ($thumbnailImage.size() > 0) <img src="${thumbnailImage.getChild("link").value}" />#end
```
### Not seeing the contents of the chosen asset?
By default, the structured data content for a chosen asset will not be present within an Index Block rendering, or through the generated `system-data-structure` within the DEFAULT region if no Index Block is assigned. Instead you will see an empty `<content/>` element.
In order to include this content, edit the Data Definition containing the chooser field, open the chooser field's settings and set the **Render Content Depth** field to a value of at least `2`.
**Note:** Depending on the structure of the chosen asset, a higher value may be required.

---

### How do I add a "title" tag to my page?

To add a title metadata tag and other metadata tags directly to your Template(s)
1. Navigate to your Template and click **Edit**.
2. Place the `<system-page-title/>` tag inside the `<title></title>` tags of your Templates and click **Submit**.
When the page is rendered, Cascade pulls in the Title as defined in the page's metadata.
Example:
```
<title><system-page-title/></title>
```

## Related Links
- System Tags

---

### How do I control User access to Folders and assets?

You can control Read/Write access to Site assets through Access rights. Access rights, or permissions, control which Users or Groups can view or edit assets. While viewing an asset (such as a Folder):
1. Click **More > Access**.
2. Select the Access level for all users. (Selecting **None** here will hide the asset from all users except Administrators and specific Users/Groups granted access in the next step.)
3. Grant Read/Write access to specific Users/Groups using the chooser.
4. Click **Update**.
Folder and Container assets have an additional feature called **Access for Contents** which allows update the access rights for the contents of that Folder/Container. While viewing a Folder, click **More > Access for Contents**.
Updating the access rights on the contents of a Folder/Container can be performed using two different strategies:
- **Merge Access Rights**: Merging will add new assignments to all contained assets where the User or Group specified is not already assigned. If the User or Group is already assigned to an asset, then the Access level (Read or Write) will be updated with the new value specified. All other existing User and Group assignments will not be changed.
- **Overwrite Access Rights**: Overwriting will remove all existing User and Group assignments on all assets within a Folder and apply only those specified. **Warning**: Be cautious with this option. In most cases, you will want to Merge Access Rights as opposed to overwriting them. This operation can not be undone.

## Related Links
- Access Rights

---

### How do I create a "calling page" Index Block?

This Index Block, which is usually referred to as a calling page or current page Index Block, is one of the most used Blocks in Cascade CMS.
## Creating an Index Block
- Select **Add Content > Block > Index**.
- Choose a system name (e.g. "calling-page").
- For the **Index Type** field choose "Folder Index".
- For the **Rendering Behavior** field select "Render normally, starting at the indexed folder".
- For the **Depth of Index** field type "0".
- For the **Indexed Asset Content** field check:Append Calling Page Data
- Regular Content
- User Metadata
For the **Indexed Asset Types** field check "Pages"".For the **Page XML** field select "Render page XML inline".
Click **Submit**.
## Previewing an Index Block
Because this type of Index Block requires a context page to render, previewing the Index Block will show:
```
<page-required-to-render-this-index-block />
```
To preview the generated XML structure, you can to use the **Preview Format** options when creating/editing a Format:
- Select Block for asset type.
- Choose your newly created Index Block.
- Choose your desired context page.

## Related Links
- Blocks

---

### How do I create an XML output for a page?

To create an XML Output for a page:
- Create a new Template with only the following content: `<system-region name="DEFAULT"/>`
- Navigate to **Manage Site** > **Configuration**.
- Select your existing Configuration and edit it.
- Click **Add new Output**.
- For the **Name** field, enter "XML".
- For the **Template** field, browse to the Template that was created in the first step.
- For the **File Extension** field, enter ".xml".
- For the **Type of Data** field, select "XML".
- Leave the **Publishable** field unchecked for now.
- Click **Submit**.
Now, navigate to a Page asset which is using the Configuration that was just modified. While viewing the Page, click the **Output** drop down menu and select "XML". Clicking on this output will display the system generated XML for that Page.
In some cases, viewing the XML content of a page will result in the following error message:
```
Could not convert JDOM document into string: Exception outputting Document: Root element not set
```
To resolve this, try changing the Template content from:
```
<system-region name="DEFAULT"/>
```
to:
```
<xml> <system-region name="DEFAULT"/></xml>
```
This will ensure that the content within the DEFAULT region always has a root element.
It's often helpful to use the XML configuration's DEFAULT region for plugging in context-sensitive Index Blocks. For example, any Index Block with **Rendering Behavior** set to "Start at the current page..." will mean that the Block must be plugged into a Page region before it will generate any XML. To see the XML output for a given page that uses a context-sensitive Index Block:
- Click **Edit** on the Page.
- Click the **Configure** pane.
- Click the XML Configuration
- In the DEFAULT region, click the Block chooser and select the Index Block.
- Click **Submit**.
Now, return to the Page view and select the XML output. It will display the XML generated by the Index Block as it pertains to the Page.

---

### How do I delete a site?

To delete a site in Cascade CMS:
1. Click the menu button (* *) in the upper-right corner of the interface.
2. Click **Sites**.
3. Select the site from the Sites list by checking the checkbox next to it.
4. Click the **Delete** icon at the top of the list.
**Note**: You can only delete one site at a time.**Warning**: Deleted sites cannot be restored. This action cannot be undone.

---

### How do I delete a Workflow?

To delete a Workflow:
- Navigate to your workflow
- Click the **Delete Workflow** button in the top right of your screen
**Tip: **Having trouble locating your Workflow? Here are a few ways to get back to it:
- Navigate to the asset in Workflow and click the corresponding link to the workflow in the top right corner  
- Check the *My Workflows* widget on your Dashboard
- Check your email for related Workflow notifications which will contain a link to the Workflow in question
**Note:** If you don't see the option to **Delete Workflow** at the top right of your screen, reach out to your CMS or Site Administrator and request that they enable the *Delete Workflows* ability to your Site Role.
## Related Links
- Workflows

---

### How do I edit content or find out where to edit a certain region?

You may be able to edit your page content by simply clicking **Edit** at the top of the page, making any changes, submitting and then publishing.
However, if you don't see the content you want to edit when editing the page, that content could be contained elsewhere. The content may be located in a Block and/or output by a Format attached to a particular region contained within the page’s Template.
You can find out what Block and/or Format is responsible for the content by clicking **More > Show Regions**, which reveals the Regions in the sidebar.
You can then hover over each Region in the sidebar until you see your content area highlighted on the page. From the Show Regions sidebar, you can click on the Block or Format name to make changes.
If you can't locate the Region where your content is located or don't have access to edit the responsible Block and/or Format, we recommend contacting your Cascade CMS Administrator or web team as they should be familiar with your site's design and can provide additional assistance.

---

### How do I include a page's ID in its contents?

Each asset in Cascade CMS has an unique ID, visible in the URL when viewing the asset in the interface. Including a page's ID in the published page source can be useful for things like deep linking to Cascade CMS from [Siteimprove](https://siteimprove.com/), [DubBot](https://dubbot.com/), or other third-party reporting platforms.
You can include page IDs in your templates with a system-region and the `$currentPage.identifier.id` Velocity method.
For example:
1. Create a Velocity Format containing the following: ``` <meta name="id" content="${currentPage.identifier.id}"/> ```
2. Create a new region within the `<head>` tags of your Template(s). Example: ``` <!-- Page ID for deeplinking. --><system-region name="PAGE_ID"/> ```
3. Attach your Format to this new region in your Template(s).
4. Publish all pages that use the Template(s) to ensure that your page ID `<meta>` tag gets included the pages on your web server.

## Related Links
- Siteimprove Integration
- DubBot Integration

---

### How do I include Open Graph or Twitter card meta tags in my page?

[Open Graph](https://developers.facebook.com/docs/sharing/webmasters/) meta tags and [Twitter Card](https://developer.twitter.com/en/docs/twitter-for-websites/cards/guides/getting-started) meta tags allow you to control what your pages look like when shared on social media sites such as Facebook and Twitter.
To add these tags to your published pages, create a new system region within the `<head>` tags of your Template(s). For example:
```
<system-region name="SOCIAL_META"/>
```
Then, attach a Format to that region that dynamically generates the tag markup based on the current page. Here is an example Format that generates a number of Open Graph meta tags:
#set ($image = $currentPage.getStructuredDataNode("path/to/image"))
[system-view:external

---

### How do I rename an asset?

To rename an asset:
- While viewing the asset, click **More -> Rename **(you can also do this via the context menu)
- In the **New "asset" Name** field, enter the new name
- Click **Rename**
**Warning**: Renaming an asset will result in the asset being unpublished from all enabled Destinations and Outputs (where applicable). Once the asset has been renamed, we recommend immediately publishing it along with any other sections of your Site(s) that link to it.**Note**: Not seeing the option to Rename? You'll need to contact your CMS or Site Administrator to have them adjust your Site Role abilities. Moving/Renaming assets requires that the ability to *Move/Rename assets* is enabled.
## Related Links
- Context Menu
- Role Abilities

---

### How do I restore something I deleted from the trash / recycle bin?

The Trash bin is located above the left-hand folder tree when you're in the Site Content area. To restore one or more items from the Trash, select the checkbox next to the items and click the **Restore** button at the top of the list.
**Note for users** - If you don't see the the Trash bin, please contact your CMS administrator for assistance.**Note for administrators** - Users require at least one of the following Site Role abilities to access the Trash bin:
- View and Restore only assets the current user deleted
- View and Restore all assets in the Trash

## Related Links
- Trash

---

### How do I unlock a page or asset?

First, make sure you're looking at the working copy. Look for the drop-down to the left of the title. If it says **Current**, click it and select **Working Copy**.
## If you're the lock owner:
You should now see options to either **Commit Changes** you've made, or **Break Lock** and discard those changes. You also continue to edit and save changes to the Working Copy.
## If someone else is the lock owner:
The lock owner will be listed in the message bar at the top. You can reach out to the lock owner and collaborate on changes or have them reassign the lock to you. If you have the correct permissions, you can also either **Break Lock** (changes will be lost!) or reassign the lock to yourself.

---

### How do I upload a folder?

In addition to uploading individual files, Cascade CMS also supports the ability to upload an entire folder. To do this, you must first zip up the folder in question along with its contents.
Once you have a zip file containing your folder(s), upload it by following the steps below:
1. Click **Add Content > Default > File**. **Note**: if you don't see this menu option in your CMS environment, contact your CMS or Site administrator as they may need to adjust your permissions.
2. Select a zip archive to upload by clicking the **Choose** link or by dragging and dropping it from your computer into the dotted drop zone. You'll be prompted to either unpack the files (Yes) or to upload the zip archive as is (No).
3. If uploading the zip archive as is, enter a name for your file in the **Name** field.
4. In the **Placement Folder** field, choose the folder where the file(s) should be uploaded.
5. If unpacking the zip archive, choose the Metadata Set that the files should use in the **Metadata Set** field.
6. Click **Preview Draft** or **Unpack** to begin the upload/unzipping process. After uploading/unzipping is complete, you'll be presented with a report of all files uploaded and any that were skipped.

---

### How does the Max Asset Versions setting affect existing versions?

If you adjust the **Max Asset Versions** setting under **Administration > Preferences > Content** and the new value causes a given asset to have more than the allowed number of Versions, the Version chain will be trimmed for this asset the next time it's edited and submitted. For example, consider the following scenario:
- ** Max Asset Versions** had previously been set to **0 (unlimited)**.
- Page A has 35 versions.
- The **Max Asset Versions** is changed to **20**.
- Page A is edited and submitted.
- The oldest 15 Versions for Page A are deleted, leaving the 20 most recent Versions including the current version of the page.

## Related Links
- Versions

---

### Index Blocks

## Overview
An index block is a special type of block that returns a listing of assets from the CMS directory structure in the form of XML data. Assets like pages, files, folders, external links, and even other blocks can be returned as XML content. An index block can even return the data content of multiple pages within a directory for use on other pages within the system.
Index blocks may also be used to return a listing of all pages of a particular content type. For example, all news articles found in a particular site may be lumped into a "news articles" index block.
In Cascade CMS, index blocks are typically used for creating dynamic navigation menus, site maps, indices, etc.
Because index blocks can be configured to index an entire site or a specific folder, the way you configure index blocks in your system will vary depending on your needs and specifications. You can choose to create index blocks that are limited by either the number of assets in a given folder, or by the number/depth of folders to index. To ensure dynamic and consistent content across your site, any time content relevant to that index block in the system changes (a page is added, deleted, renamed, moved, etc.), the index block automatically updates, and all pages using the index block are also updated.
## Creating an Index Block
To create an index block:
1. Click **Add Content** > **Default** > **Block**.
2. Select **Index** and click **Choose**.
3. In the **Name** field, enter a name for your block.
4. In the **Placement Folder** field, choose the folder where the block should be created.
5. Under **Index Block Settings**, configure the following options: - **Folder Index** - Choosing this option will generate block contents based on the contents of the specified folder. If you want the block to index nested folders, simply select the highest folder.**Rendering Behavior** - This field has a great deal of impact on the structure of the rendered XML. It is important to choose a type of rendering behavior that is best suited to the purpose of a particular index block.**Render normally, starting at the indexed folder** - This is the most common option and allows one to preview the rendered block XML in most cases when viewing the index block itself. This option renders data starting at the "Index Folder", and renders its children forward at a depth specified in the "Depth of Index" field. Subfolders will be included in the render, along with their children, to the extent to which the depth of index will allow. - **Start at the current page and include its folder hierarchy** - One may think of this as a backwards render. This rendering option depends on a current page context. That is, that this option requires that the index block be rendered in a region of a page (it is for this reason that you may not see XML in the "view" of an index block asset in Cascade CMS). The rendering will start at the current page, render it, and then proceed to render each parent folder until the base folder is rendered. These index blocks tend to be rather small, and are well-suited for breadcrumb navigation generation. - **Start at the current page with folder hierarchy, and also include sibling**s - This option is like the "Start at the current page and include its folder hierarchy" option, except that for each parent folder asset rendered, it will also render that folder's children as well. For example, when rendering with his option, the renderer will start at the current page and render all of the siblings of that page, including the page itself. It will then render the parent folder and all of its siblings, repeating until the base folder is rendered. Note that this option will not continue to render sibling folders as the parent folder hierarchy is traversed. - **Start at the current page with folder hierarchy, siblings, and also render forward** - This option expands on the "Start at the current page with folder hierarchy, and also include siblings" rendering option, but also includes rendering the siblings of the current page, exactly the same way that the normal rendering option would render the current page's parent folder. This option is in effect, a combination of the "Render normally, starting at the indexed folder" and the "Start at the current page with folder hierarchy, and also include siblings" options.
6. **Depth of Index** - If you only want one folder indexed, type in 1. If there are nested (or child) folders that you wish to include, type in the number of levels you want. If you are indexing all levels, but aren't sure how many there are, it is ok to overshoot (i.e. 100).
7. **Content Type Index** - Choosing this option will generate block contents based on pages that share the specified Content Type.
8. **Max Rendered Assets** - Determine how many assets you wish to be rendered. Limiting this number is useful when you want to return only the most recent pages, for example.
9. **Indexed Asset Content** - This allows you to determine what information is included in results. These results may be styled or filtered via an accompanying script format. - **Append Calling Page Data** - Appends data from the page which includes this index block. - **Regular Content** - Includes content visible to users when editing. - **System Metadata** - Includes system information such as when the asset was created and last updated, and by whom. - **User Metadata** - Includes metadata the user can change. - **Tags** - Includes tags assigned to the asset. - **Folder Access Rights** - Includes permission information such as user and group names and their level of access. - **User Information** - Includes information about the current user. - **Workflow Information** - Includes the asset's workflow information, if applicable.
10. **Indexed Asset Types** - This allows you to limit the types of assets. For most navigation features, only pages and links need to be indexed.
11. **Page XML** - This field controls how page XML is rendered inline during an index block render. Note that Regular Content must be indexed in order to render page XML. - **Do not render page XML inline** - This option will not include any XHTML or Data Definition content for any page that is included in the index block render. - **Render page XML inline** - Default region content will be included for any page that is included in the index block render. For XHTML pages, it will be the XHTML/WYSIWYG content that one typically edits in the page. For pages with a Data Definition, it will be the rendered as XML. Note that for pages with a Data Definition, this XML will not have any XSLT applied to it. - **Render page XML inline only for current page** - This is exactly like the "Render page XML inline" option, but only the current page is rendered in this manner. All other pages that are included in the index block render will not have the default page content included for those pages in the resulting document.
12. **Block XML** - This field controls how block XML is rendered inline during an index block render. Note that Regular Content must be indexed in order to render block XML. - **Do not render block XML inline** - This is the default and does not render any block content inline. - **Render XHTML/Data Definition block, XML block, and Text block XML inline** - This option will render inline the contents of any block in the overall document.
13. **Sort Method** - This determines the order in which assets are rendered. "Folder Order" refers to ordering content via the drag-and-drop folder view and can be useful in setting up custom navigation.
14. **Sort Order** - This determines whether the assets are sorted in ascending or descending order.
15. Click **Preview Draft** and **Submit**.
**Note** - In general, rendering inline page and block content will increase the size of the index block and will increase the amount of time needed to render the index block. Because this could slow down page load times in Cascade CMS, it's recommended that this option only be used if necessary.
## Indexed Asset Content
#### Regular Content
| **<path>** | The path from the root of the site. |
| --- | --- |
| **<site>** | The site-link notation of the asset (only available in a site). |
| **<link>** | The site-link notation of the asset (only available in a site). |
| **<display-name>** | The "Display Name" metadata field. |
| **<file-size>** | The size (in bytes) of a file (only available for files).  |
| **<height>** | The height (in pixels) of an image file (if present).  |
| **<width>** | The width (in pixels) of an image file (if present).  |
#### System Metadata
*Metadata populated by Cascade CMS automatically.*
| **<is-published>** | Returns "true" if the asset has *Include when publishing* checked or "false" if the asset does not have *Include when publishing* checked. |
| --- | --- |
| **<created-by>** | The username of the user who created the asset. |
| **<created-on>** | Timestamp of when the asset was created. |
| **<last-modified-by>** | The username of the user who last modified the asset. |
| **<last-modified>** | Timestamp of when the asset was last modified. |
#### User Metadata
*Any metadata populated by a user (except Display Name, which is rendered in Regular Content).*
| **<title>** |   |
| --- | --- |
| **<summary>** |   |
| **<author>** |   |
| **<teaser>** |   |
| **<keywords>** |   |
| **<description>** |   |
| **<start-date>** | UNIX timestamp of the start-date. |
| **<end-date>** | UNIX timestamp of the end-date. |
| **<dynamic-metadata>** | The element that holds <name> and <value> for dynamic metadata fields.  |
| **<name>** | The name of the dynamic metadata field.  Child element of <dynamic-metadata>. |
| **<value>** | The value of the dynamic metadata field.  There can be multiple <value> nodes for checkbox field types. |
#### Folder Access Rights
*Information about the access rights of the assets.*
| **<access-rights>** | All the access rights information is contained in this element. |
| --- | --- |
| **<user>** | Each user's permissions are in this element. If a user does not have *read* or *write* permissions to the asset, the <user> node is not rendered.  <user> has <name> and <permssion> as children elements. |
| **<name>** | Username |
| **<permission>** | The values *read* or *write*. |
| **<group>** | Each group's permissions are in this element. If a group does not have *read* or *write* permissions to the asset, the <user> node is not rendered.  <group> has <name> and <permssion> as children elements. |
| **<name>** | The name of the group. |
| **<permission>** | The values *read* or *write*. |
#### User Information
*Adds an element after rendering the assets (i.e. towards the bottom of the index block) with information about the user accessing the page inside Cascade CMS. This information can be helpful for generating pages for view inside of Cascade CMS specific to the user.*
| **<user-information>** | The element that contains all the user information nodes. |
| --- | --- |
| **<username>** | The username of the user currently accessing the index block (i.e. *your* username when viewing the index block). |
| **<full-name>** | The current user's full name. |
| **<groups>** | Contains <group> nodes for each group for the user. |
| **<group>** | The group's name. |
#### Workflow Information
*Contains any workflow information about the asset.*
| **<workflow>** | The element that contains all the workflow information. |
| --- | --- |
| **<initialized>** | If the workflow has started: *true* or *false* are the values. |
| **<name>** | The name of the workflow. |
| **<owner>** | The username of the workflow's owner (i.e. the user who started the workflow). |
| **<related-entity-id>** | The unique Cascade CMS identifier of the asset in workflow. |
| **<related-entity-type>** | The entity type of the asset in workflow: *page*, *block*, *file* or *symlink*. |
| **<start-date>** | The date the workflow began (in the format: *MMM DD, YYYY hh:mm a*). |
| **<end-date>** | The date the workflow expires (in the format: *MMM DD, YYYY hh:mm a*). |
| **<status>** | The workflow's status: *In Progress* or *Completed*. |
| **<current-step>** | If <status> is *In Progress*, information about the step the workflow is in currently. |
| **<step>** | Element that contains all the information about the current step. |
| **<identifier>** | The step's unique name. |
| **<name>** | The name of the step. |
| **<type>** | The type of step: *edit*, *transition*, or *system*. |
| **<owner>** | The user or group the step is assigned. |
| **<owner-type>** | Either *user* or *group*. |
| **<started-one>** | The date the step was started (in the format: *MMM DD, YYYY hh:mm a*). |
| **<actions>** | Element that contains <action> elements with the information about each action this step contains. |
| **<action>** | Element that contains information about the action. |
| **<identifier>** | The action's unique identifier. |
| **<name>** | The name of the action. |
| **<action-type>** | The type of action: *forward*, *reverse*, or *explicit*. |
| **<entity-information>** | Contains additional information about the entity attached to this workflow. |
| **<id>** | The entity's unique Cascade CMS identifier. |
| **<cache-path>** | The path of the entity from the root of the site. |
| **<name>** | The name of the entity. |
| **<type>** | The entity type: *page*, *file*, *block* or *symlink*. |
| **<lock-information>** | Contains information who has the entity locked with the element <lock-owner>. |
| **<lock-owner>** | The name of the user who has locked the entity. |
| **<steps>** | Contains <step> elements for each ordered step in the Workflow Definition.  (See <step> above). |
| **<unordered-steps>** | Contains <step> elements for each unordered step in the Workflow Definition (See <step> above). |
| **<histories>** | Contains <history> elements for each change in the workflow. |
| **<history>** | Element that represents an update to the workflow. |
| **<who>** | Username of who updated the workflow. |
| **<timestamp>** | The date the update occurred (in the format: *MMM DD, YYYY hh:mm a*). |
| **<action-name>** | The name of the action used to update the workflow. |
| **<comments>** | Any user comments entered after the action was taken. |
| **<source-step-name>** | The name of the step where this update occurred. |
| **<dest-step-name>** | The name of the step where the update takes the workflow. |
#### Append Calling Page Data
*Adds all information about the current page using this index block.*
**<calling-page>** - Contains all information about the current page in a <system-page> element.
## Examples of Index Block XML
The examples below show a portion of an index block for each of the four types of indexed assets: folder, page, file, and external link.
All index blocks begin with the following XML document element:
```
<system-index-block name="index-block" type="folder" current-time="1245954924080">
```
In this example, `index-block` is the system name of the block asset, and the index block is a folder index block. The `current-time` attribute is the Cascade CMS server's local time at which the index block was rendered represented as a Unix timestamp in milliseconds.
A Content Type index block would start with the following:
```
<system-index-block name="index-block" type="content_type" current-time="1245954924080">
```
Note that Content Type index blocks do not display folder structure using `<system-folder>` elements. They inherently only contain `<system-page>` elements, because Content Types can only be assigned to pages.
The following sections demonstrate index block XML for a page without a Data Definition, a page with a Data Definition, a folder containing a single page, a file, and an external link, an index or feed block, and an XHTML, XML, or text block.
#### Page without a Data Definition
```
<system-page id="ef81d1c90a00016b00659a66bcacb166"> <name>page</name> <is-published>true</is-published> <title>Lorem Ipsum Dolor Sit Amet</title> <summary>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</summary> <author>Author Name</author> <teaser>Teaser</teaser> <keywords>Comma, Separated, Keywords</keywords> <description>Description</description> <display-name>Lorem Ipsum</display-name> <path>/index-block-example/page</path> <created-by>admin</created-by> <created-on>1245263810949</created-on> <last-modified-by>admin</last-modified-by> <last-modified>1245954849582</last-modified> <page-xhtml> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> </page-xhtml> </system-page>
```
#### Page with a Data Definition
```
<system-page id="ef8c30b10a00016b00659a66495b1501"> <name>structured-data-page</name> <is-published>true</is-published> <title>Online Marketing Intern</title> <author>Author Name</author> <teaser>Teaser</teaser> <keywords>Comma, Separated, Keywords</keywords> <description>Description</description> <display-name>Marketing Intern</display-name> <path>/index-block-example/structured-data-page</path> <created-by>admin</created-by> <created-on>1245264490577</created-on> <last-modified-by>admin</last-modified-by> <last-modified>1245954890668</last-modified> <system-data-structure definition-path="Job Posting"> <opening> <job-title>Lorem ipsum</job-title> <summary>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</summary> </opening> <responsibilities> <bullet-point>Help manage our search engine optimization (SEO) &amp; pay-per-click (PPC) campaigns</bullet-point> <bullet-point>Help plan annual conference event and customer communications</bullet-point> <bullet-point>Write marketing copy</bullet-point> </responsibilities> <requirements> <bullet-point>Strong interpersonal skills</bullet-point> <bullet-point>Located in the Atlanta metropolitan area</bullet-point> </requirements> <closing> <notes>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</notes> <contact-email>careers@example.com</contact-email> </closing> </system-data-structure> </system-page>
```
#### Folder
```
<system-folder id="ef85ff080a00016b00659a6696c43ceb"> <name>folder</name> <is-published>true</is-published> <title>CHANGE ME</title> <summary>CHANGE ME</summary> <display-name>CHANGE ME</display-name> <path>/index-block-example/folder</path> <created-by>admin</created-by> <created-on>1245264084723</created-on> <last-modified-by>admin</last-modified-by> <last-modified>1245264084723</last-modified> <system-page id="18a659150a00016b01958816fa2e34a7"> <name>page</name> <is-published>true</is-published> <title>CHANGE ME</title> <summary>CHANGE ME</summary> <author>Author Name</author> <teaser>Teaser</teaser> <keywords>Comma, Separated, Keywords</keywords> <description>Description</description> <display-name>CHANGE ME</display-name> <path>/index-block-example/folder/page</path> <created-by>admin</created-by> <created-on>1245954070774</created-on> <last-modified-by>admin</last-modified-by> <last-modified>1245954070774</last-modified> <page-xhtml> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> </page-xhtml> </system-page> </system-folder>
```
#### File
```
<system-file id="ef8505950a00016b00659a666df25e7d"> <name>file.txt</name> <is-published>true</is-published> <path>/index-block-example/file.txt</path> <created-by>admin</created-by> <created-on>1245264020863</created-on> <last-modified-by>admin</last-modified-by> <last-modified>1245954823105</last-modified> <file-size>13</file-size> </system-file>
```
#### External Link
```
<system-symlink id="ef85a0af0a00016b00659a66a30910aa"> <name>external-link</name> <display-name>An External Link</display-name> <path>/index-block-example/external-link</path> <created-by>admin</created-by> <created-on>1245264060581</created-on> <last-modified-by>admin</last-modified-by> <last-modified>1245954788677</last-modified> <link>http://www.hannonhill.com/</link> </system-symlink>
```
#### Index or Feed Block
```
<system-block id="18a828040a00016b01958816156e0c63"> <name>index-or-feed-block</name> <path>/index-block-example/index-or-feed-block</path> <created-by>admin</created-by> <created-on>1245954189294</created-on> <last-modified-by>admin</last-modified-by> <last-modified>1245954273235</last-modified> </system-block>
```
#### XHTML, XML, or Text Block
```
<system-block id="ef826bc40a00016b00659a66c30019d5"> <name>xhtml-block</name> <title>CHANGE ME</title> <summary>CHANGE ME</summary> <display-name>CHANGE ME</display-name> <path>/index-block-example/xhtml-block</path> <created-by>admin</created-by> <created-on>1245263850415</created-on> <last-modified-by>admin</last-modified-by> <last-modified>1245263862596</last-modified> <!-- XHTML --> <block-xhtml> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> </block-xhtml> <!-- XML --> <block-xhtml> <xml>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</xml> </block-xhtml> <!-- Text --> <block-xhtml>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</block-xhtml> </system-block>
```

---

### Native On-Page Accessibility Checker

## Overview
The Native On-Page Accessibility Checker is an on-demand page-level tool for checking page content for WCAG 2.0, 2.1, 2.2 compliance (Level A, AA, and AAA). The checker leverages the [Axe® accessibility checker](https://www.deque.com/axe/) and supports the following accessibility standards:
- WCAG 2.0, 2.1, 2.2 (A, AA, AAA),
- [Revised Section 508 Rules (2017)](https://www.access-board.gov/ict/) and [Trusted Tester v5 (TTv5)](https://www.dhs.gov/trusted-tester)
- [EN 301 549](https://www.deque.com/en-301-549-compliance/) (European Union standard)
- [Best Practices](https://docs.deque.com/devtools-for-web/4/en/rulesets#experimental) and [Newer Experimental Rules](https://docs.deque.com/devtools-for-web/4/en/rulesets#best-practices)
A list of issues is provided with links to relevant areas on the page and details about the violation, remediation steps, and the specific WCAG guidelines in violation. It will also analyze the page in a headless browser allowing it to discover issues with color contrast and others that can only be found when loading the page with its CSS and Javascript in a browser.
This feature is available for Cascade Cloud clients only.

## Checking Page Content
To check a page's content for accessibility issues:
1. While viewing a page click **More** > **Check Page Accessibility**. 
2. Optionally, use the **Filter by Standard** dropdown to filter by a particular accessibility standard. Available options are as follows: - *All* - *Old Section 508 rules* - *WCAG 2.0 (A), WCAG 2.1 (A), WCAG 2.2 (A)* - *WCAG 2.0 (AA), WCAG 2.1 (AA), WCAG 2.2 (AA)* - *WCAG 2.0 (AAA), WCAG 2.1 (AAA), WCAG 2.2 (AAA)* - *WCAG 2.1 (A), WCAG 2.2 (A)* - *WCAG 2.1 (AA), WCAG 2.2 (AA)* - *WCAG 2.2 (AA)* - *Common accessibility best practices *

---

### Page: Administration Menus

Output:  update
*>*
- data-confid="48581cc63211e3713b681ac5153cbd4e"> HTML
- data-confid="3d1dd96fc0a8002b1841ecec1dcc2a48"> update
- data-confid="c6415bd50a894fa568b1ecd426ebab5f"> XML
- Cascade CMS KB
- /
- cascade-administration
- /
- administration-menus
* Region Assignments data-dismiss="modal"> >* Editable Regions data-regionname="DEFAULT"> DEFAULT data-regionname="DEFAULT" data-url="/regionInlineEdit.act?id=336d82640a894fa50d32c7bffe86fa87&configurationName=HTML&regionName=DEFAULT&blockId=ba1c7af80a894fa568b1ecd4a0bc2232"> *>* **current-page **topic-default-content Read Only
ANALYTICS - GOOGLE
ANALYTICS CLIVE
- **Clive tracking code
ANALYTICS SPECTATE
- **PI tracking code
AT A GLANCE
BODY-SCRIPTS
- **site-gtm-body-js
BREADCRUMB-NEW
CANONICAL
- **canonical
CUSTOM CSS
- **site-css
CUSTOM CSS 2
CUSTOM JS
- **site-js
CUSTOM JS 2
CUSTOM JS FOOT
- **site-js-foot-update
CUSTOM JS FOOT 2
DEFAULT ABOVE
DEFAULT ASIDE
- **article-sidebar
DEFAULT ASIDE ABOVE
- **clive-ctas
DEFAULT ASIDE BELOW
DEFAULT BELOW
ID
- **deep-link-id
SITE BREADCRUMB
- **folder-hierarchy
- **site-breadcrumb
SITE COPYRIGHT
- **copyright
SITE NAVIGATION BAR
- **site-navigation-kb
- **navigation-bar
SKIP-LINKS
- **site-skip-links
- Read Only
- data-regionname="ANALYTICS - GOOGLE"> ANALYTICS - GOOGLE
- data-regionname="ANALYTICS CLIVE"> ANALYTICS CLIVE **Clive tracking code
ANALYTICS SPECTATE
- **PI tracking code
AT A GLANCE
BODY-SCRIPTS
- **site-gtm-body-js
BREADCRUMB-NEW
CANONICAL
- **canonical
CUSTOM CSS
- **updated-site-css
CUSTOM CSS 2
CUSTOM JS
- **site-js-update
CUSTOM JS 2
CUSTOM JS FOOT
- **site-js-foot-update
CUSTOM JS FOOT 2
DEFAULT
- **current-page
- **topic-default-content
DEFAULT ABOVE
DEFAULT ASIDE
- **article-sidebar
DEFAULT ASIDE ABOVE
- **clive-ctas
DEFAULT ASIDE BELOW
DEFAULT BELOW
ID
- **deep-link-id
SITE BREADCRUMB
- **folder-hierarchy
- **site-breadcrumb
SITE COPYRIGHT
- **copyright
SITE NAVIGATION BAR
- **site-navigation-kb
- **navigation-bar-update
SKIP-LINKS
- **site-skip-links
- Read Only
- data-regionname="DEFAULT"> DEFAULT **calling-page
[ data-toggle="dropdown" aria-expanded="false" aria-haspopup="true"> *>* Filter *>* > WCAG Level * /> A /> A and AA /> A, AA and AAA > WCAG Version > >WCAG 2.0 >WCAG 2.0 and 2.1 >WCAG 2.0, 2.1 and 2.2 > Other /> Old Section 508 rules /> Common accessibility best practices > Show issues > Reset Filter data-dismiss="modal"> >*
## Issues Ranked by Priority
> Powered by Axe by Deque Systems *>* ](https://www.deque.com/axe/) Language Consistency Issues
*>*
**This Site's language intent
Edit
** The intent of this site is to inform, support, and engage a broad audience by clearly communicating the organization’s purpose, offerings, and values. The language is professional, inclusive, and accessible, balancing clarity and credibility with a welcoming, approachable tone. Content is written to be easy to understand while maintaining appropriate industry terminology where needed. The primary goals of the site are to build awareness and trust, guide users to relevant information and services, highlight strengths and accomplishments, and reinforce the organization’s brand, mission, and commitment to serving its audience. *
The intent of this site is to inform, support, and engage a broad audience by clearly communicating the organization’s purpose, offerings, and values. The language is professional, inclusive, and accessible, balancing clarity and credibility with a welcoming, approachable tone. Content is written to be easy to understand while maintaining appropriate industry terminology where needed. The primary goals of the site are to build awareness and trust, guide users to relevant information and services, highlight strengths and accomplishments, and reinforce the organization’s brand, mission, and commitment to serving its audience.
Save
* Check Language Consistency
Checking language consistency, please wait. This may take a minute... **Fit Level: **
Opens in a new window Opens an external site in a new window Loading...

---

### Page: Could not reset lucene directory

Output:  update
*>*
- data-confid="51285924c0a80079701c396216850b18"> HTML
- data-confid="40d82727c0a8002b1841ececb4fd5fd2"> update
- data-confid="51285924c0a80079701c396280068a72"> XML
- Cascade CMS KB
- /
- faqs
- /
- common-errors
- /
- could-not-reset-lucene-directory
* Region Assignments data-dismiss="modal"> >* Read Only data-regionname="ANALYTICS - GOOGLE"> ANALYTICS - GOOGLE data-regionname="ANALYTICS CLIVE"> ANALYTICS CLIVE **Clive tracking code
ANALYTICS SPECTATE
- **PI tracking code
BODY-SCRIPTS
- **site-gtm-body-js
CANONICAL
- **canonical
CUSTOM CSS
- **site-css
CUSTOM JS
- **site-js
CUSTOM JS FOOT
- **site-js-foot-update
DEFAULT
- **current-page
- **topic-default-content
DEFAULT ABOVE
DEFAULT BELOW
ID
- **deep-link-id
SITE BREADCRUMB
- **folder-hierarchy
- **site-breadcrumb
SITE COPYRIGHT
- **copyright
SITE NAVIGATION BAR
- **site-navigation-kb
- **navigation-bar
SKIP-LINKS
- **site-skip-links
- Read Only
- data-regionname="ANALYTICS - GOOGLE"> ANALYTICS - GOOGLE
- data-regionname="ANALYTICS CLIVE"> ANALYTICS CLIVE **Clive tracking code
ANALYTICS SPECTATE
- **PI tracking code
BODY-SCRIPTS
- **site-gtm-body-js
CANONICAL
- **canonical
CUSTOM CSS
- **updated-site-css
CUSTOM JS
- **site-js-update
CUSTOM JS FOOT
- **site-js-foot-update
DEFAULT
- **current-page
- **topic-default-content
DEFAULT ABOVE
DEFAULT BELOW
ID
- **deep-link-id
SITE BREADCRUMB
- **folder-hierarchy
- **site-breadcrumb
SITE COPYRIGHT
- **copyright
SITE NAVIGATION BAR
- **site-navigation-kb
- **navigation-bar-update
SKIP-LINKS
- **site-skip-links
- Read Only
- data-regionname="DEFAULT"> DEFAULT **calling-page
[ data-toggle="dropdown" aria-expanded="false" aria-haspopup="true"> *>* Filter *>* > WCAG Level * /> A /> A and AA /> A, AA and AAA > WCAG Version > >WCAG 2.0 >WCAG 2.0 and 2.1 >WCAG 2.0, 2.1 and 2.2 > Other /> Old Section 508 rules /> Common accessibility best practices > Show issues > Reset Filter data-dismiss="modal"> >*
## Issues Ranked by Priority
> Powered by Axe by Deque Systems *>* ](https://www.deque.com/axe/) Language Consistency Issues
*>*
**This Site's language intent
Edit
** The intent of this site is to inform, support, and engage a broad audience by clearly communicating the organization’s purpose, offerings, and values. The language is professional, inclusive, and accessible, balancing clarity and credibility with a welcoming, approachable tone. Content is written to be easy to understand while maintaining appropriate industry terminology where needed. The primary goals of the site are to build awareness and trust, guide users to relevant information and services, highlight strengths and accomplishments, and reinforce the organization’s brand, mission, and commitment to serving its audience. *
The intent of this site is to inform, support, and engage a broad audience by clearly communicating the organization’s purpose, offerings, and values. The language is professional, inclusive, and accessible, balancing clarity and credibility with a welcoming, approachable tone. Content is written to be easy to understand while maintaining appropriate industry terminology where needed. The primary goals of the site are to build awareness and trust, guide users to relevant information and services, highlight strengths and accomplishments, and reinforce the organization’s brand, mission, and commitment to serving its audience.
Save
* Check Language Consistency
Checking language consistency, please wait. This may take a minute... **Fit Level: **
Opens in a new window Opens an external site in a new window Loading...

---

### Pages

Page assets represent the combination of Template, content, scripts, and/or Formats to produce one or more rendered outputs for publishing.

---

### Recycle Bin Checker

## Overview
The Recycle Bin Checker is a system tool used to correct data inconsistencies that may occur where the children of recycled assets are not marked as recycled. Situations that can cause this problem are corrected as they are found, but in the case that the database is already in this state this tool is available. Diagnosing this situation, however, is not possible through the Cascade CMS interface so the tool should only be done under the explicit direction of Hannon Hill Support.
**Warning** - Before running any optimization tool, please backup your database to protect against data loss.
## Running the Recycle Bin Checker
To run the Recycle Bin Checker:
1. Click the system menu button ( * *) > **Administration** > **Optimize Database**.
2. Select **Recycle Bin Checker**.
3. Click **Submit**.
## Recycle Bin Checker Report
After running the Recycle Bin Checker, a report is given detailing the status of the repair.
The **Properties** section gives the timestamp of when the tool was started and the status of the attempt (whether any inconsistent items were found and if they were updated successfully).
The section labeled **Successfully Repaired** lists all of the assets which were found to be inconsistent and were repaired without problems, along with the site to which they belonged.
The **Errors** section lists any assets which were not able to be repaired. Each item also includes the error which was encountered during the repair.

---

### Search failed: no segments file found

Users attempting to perform a search within Cascade CMS may run into an error similar to the one below:
`Search failed: no segments* file found in org.apache.lucene.store.FSDirectory`
To correct this problem, an Administrator should log into the system and follow the steps outlined here to rebuild the search indexes.

## Related Links
- How do I rebuild my search indexes?
- Search

---

### Styles not loading for 404 pages

If you're managing a `404` page in the CMS and find that it doesn't display properly on your live site in certain scenarios, the issue is likely due to how CSS file(s) in the page are being referenced. To fix this, we'll want to change the link rewriting for the asset at the page level. 
By default, links within Page assets in the CMS will be relative. With `404` pages specifically, this can cause behavior where browsing to a non-existent page on the live website at certain depths in the directory structure will cause relative links to CSS files for the `404` page to point to invalid resources.
To address that behavior, the following steps should be taken:
- Edit the `404` Page in your CMS (note: this Page may not actually be named `404`, but that is the most common practice)
- Click the **Configure** tab
- Check the box to **Override the current Site's asset link rewriting behavior for this asset**
At this point, you'll see different link rewriting options appear that you can set explicitly just for this Page.
- Select **Absolute**
- Click to Submit the Page
- Publish the `404` Page
Now, the CSS resources for the Page should load regardless of the location from which the `404` page is requested.

---

### Suggested Unused Assets Report

## Overview
The Suggested Unused Assets report displays a list of assets that are not explicitly linked to or chosen by other assets in Cascade CMS. This report runs **daily at 4:30am** for all Sites in the environment and that schedule can not be modified at this time.
The asset list provides the following information:
- **Name** - The name of the asset and a link to the asset.
- **Last modified** - The date the asset was last modified. Hover the value for an exact date and time.
- **Last published** - The date the asset was last published. Hover the value for an exact date and time.
- **Owned by** - The name of the user that owns the asset.
## Filtering the Report
The following filters are available for filtering the report:
- **Site** - Display assets within specified site(s).
- **Asset types** - Choose one or more types of assets to display (Pages, Files, Blocks, and External Links).
- **Show only assets that are not indexable** - Display only assets which do not have "Include when indexing" enabled.
- **Show only assets that were previously published** - Display only assets which have a "Last published" date.
## Unpublishing assets
To unpublish one or more assets in the report:
1. Select one or more assets from the list.
2. Click the **Unpublish** (* *) icon at the top of the list.
**Note** - Assets listed in the Suggested Unused Assets report have no linked or manual Relationships with other assets in Cascade CMS; however, they may still be in use and/or linked indirectly via Format.
## Deleting assets
To delete one or more assets in the report:
1. Select one or more assets from the list.
2. Click the **Delete** (* *) icon at the top of the list.
**Note** - Assets listed in the Suggested Unused Assets report have no linked or manual Relationships with other assets in Cascade CMS; however, they may still be in use and/or linked indirectly via Format.
## Creating manual relationship to an asset
Assets listed in the Suggested Unused Assets report have no linked or manual Relationships with other assets in Cascade CMS; however, they may still be in use and/or linked indirectly via Format. For example, a news listing may link to news articles via the Query API, but the individual article pages may not have any Relationships.
If there are assets in the report that you know are in use but have no Relationships, you have the option to create a manual Relationship to an appropriate asset.
To create a manual relationship for an asset in the report:
1. Select an asset from the list.
2. Click the **Create a manual relationship** button at the top of the list.
3. Click **Choose publishable site content** and select the asset(s) you wish to manually link to the current asset.
## Export results as a CSV file
Information visible in the Suggested Unused Assets report can be exported as a CSV file using the **Export CSV** link in the top right corner.

---

### Text Blocks

## Overview
Text blocks are basic blocks of content that can be reused throughout a site much like an XHTML block. Text blocks are not as widely used as their XHTML counterpart is, because text blocks lack the standard WYSIWYG editor contained inside of XHTML blocks that allow for the creation of rich content with images, links, and standard text formatting options.
More often an XHTML block will be the desired solution; however, there are appropriate times to make use of a text block instead of an XHTML block. For example, where an administrator desires the user to enter plain text only, without any formatting or images. In this case, a text block is the appropriate solution for the content region. The administrator can then style the text block with a format. Like all blocks, a text block may be attached to a template, Configuration Set, or page, and may be reused across multiple pages. A single change to the text block will be present across all pages of the site that make use of the block.
## Creating a Text Block
To create a text block:
1. Click **Add Content** > **Default** > **Block**.
2. Select **Text** and click **Choose**.
3. In the **Name** field, enter a name for your block.
4. In the **Placement Folder** field, choose the folder where the block should be created.
5. You can add text to the block either by uploading a plain text file or by entering text directly into the code editor.
6. Click **Preview Draft** and **Submit**.

---

### The index block with path {path} renders too much data

This message is displayed when an Index Block in the system renders a large amount of data and reaches the limit configured in the system Preferences. The size at which the application will stop rendering an Index Block can be configured by doing the following:
1. Navigate to **Administration > Preferences > Content**.
2. Under **Index Blocks**, locate the field **Maximum Rendered Size of an Index Block (MB)**.
**Note**: We recommend keeping this setting under **15MB** if at all possible. Values larger than this may cause Index Blocks to grow to sizes which can result in performance degradation.
## Related Links
- Index Blocks
- System Preferences

---

### Version Trigger

## Overview
This trigger creates a version of the asset that will be stored in its version history. This trigger should be called after approvals are finished but before the working copy is merged into the current version.
**Note** - When adding the Version Trigger, Merge Trigger, and any publish trigger, they **must appear in this order** to properly perform all these actions in the database.
## Declaration
```
<trigger class="com.cms.workflow.function.Version" name="Version"/>
```
## Usage
```
<trigger name="Version"/>
```
## Parameters
None.

---

### Versions

## Overview
Cascade CMS maintains a version history for Site Content and Manage Site assets. As changes are made to assets, Cascade CMS keeps track of the changes in separate copies of the asset called versions.
Each version has a timestamp that allows you to see when the change was made, optional version comments describing the change, and previous versions of an asset can be restored or compared to the current version.

## Viewing Versions
To view asset versions, click **More** > **Versions** while viewing an asset. The details of the current version of the asset will appear at the top of the window. Past versions will be listed below with the following details:
- **Name** - The version number (automatically generated) and asset link for that version. Hover over the name to view the asset path.
- **Last Modified** - The time that this version was last modified and the user who last edited the asset. Hover over the time to get the exact date and time.
- **Comments** (for Site Content assets)** **- Any comments relevant to a particular version. Some version comments will be automatically generated.
To view a previous version of an asset, click the asset link for that version in the Name column to open it in the main content area. From this view you can click **More** to access additional actions such as restore, delete, view an older or newer version, and view the current version.
## Restoring a Version
To restore a version, select it from the versions list and click the **Restore this version** icon at the top of the list.
When previewing the version you wish to restore, click **More** > **Restore this version**.
**Tip** - Restoring a version does not wipe out the current version for an asset. The current version becomes versioned as well, allowing you to effectively "undo" the restoration.
## Comparing with Current
The version comparison screen will render both versions of the page and highlight any differences *within the **DEFAULT** region* using the following rules:
- Text that has been added is highlighted in green
- Text that has been removed is highlighted in pink and is struck-through
- Modifying text is considered as old text removed and new text added
- Changes and updates to style (i.e. change from bold to italic) is highlighted in purple
To compare a version of a Page asset with the current version, select it and click the **Compare with current** icon at the top of the list.
When previewing the version you wish to compare to the current version, click **More** > **Compare with current**.

## Related Links
- How does the Max Asset Versions setting affect existing versions?

---

### Where can I find the Cascade CMS log files?

The log files for the application can be found in the following areas:
## From within the Cascade CMS interface
Users with access to the Administration area can obtain log files from the application by doing the following:
1. Click **Administration**.
2. In the **Tools** section, click **Logs and System Information**.
**Note**: The log file for the current day will be named *cascade.log*. You can sort by the **Name** column to bring the *cascade.log* file to the top of the list.
Logs from previous days include the dates within their names. Example: *cascade.log.2017-01-01*
## On the machine where Cascade CMS is installed
Administrators with access to the machine on which Cascade CMS is installed can find the log files in the *tomcat/logs* directory (within the Cascade CMS installation directory). Example:
- Windows: *C:\Program Files\Cascade CMS\tomcat\logs*
- Linux: */home/cascade/tomcat/logs*

---

### Why are "g" tags appearing in the WYSIWYG editor?

If you notice that `<g>` tags are being inserted into your WYSIWYG's source code, for example:
```
<g class="gr_ gr_00 gr_alert gr_gramm gr_spell" data_gr_id="00" id="00">Here is some content.</g>
```
The likely culprit is the Grammarly browser extension. You can remove those tags from the WYSIWYG and temporarily disable the Grammarly extension in your browser to ensure they're not re-inserted.

---

### Why can't my user upload images in the WYSIWYG or file chooser?

If your users don't see the **Upload** tab when inserting images in the WYSIWYG or browsing for files in a file chooser, you may need to adjust some Site Role abilities. Users need these two Site Role abilities enabled in order to upload files via the file chooser:
- **Workflow: Bypass workflow* ******
- **Upload: Upload images in file chooser**
You can check out a User's effective abilities for a Site by following these steps.
If you don't wish a User to be able to bypass workflow, they'll need to upload Files beforehand using an Asset Factory and browse for them in the file chooser.
***Note: **The `Bypass workflow` ability is no longer required in order to be able to upload images in file choosers as of Cascade CMS v8.22; however, the Folder selected to upload into must not require Workflow.

## Related Links
- Roles

---

### Why does my Index Block stop indexing assets at a certain point?

There are two different settings which control the number of assets that will be indexed in an Index Block:
- **Max Rendered Assets** - this option is found in the **Edit** interface for Index Blocks
- **Max Assets in Index Blocks** - this option is found in **Administration > Preferences > Content > Index Blocks**
When an Index Block stops indexing assets, one of these limits has likely been reached.
If the **Max Rendered Assets** option is already set to **0** (unlimited), the **Max Assets in Index Blocks** setting (which is global) could be set to a value which is lower than the **Max Rendered Assets** setting in the Index Block.
To see if this is the case, temporarily change the **Max Assets in Index Blocks** field to **0** (which indicates 'unlimited'). Then, check to see whether or not the remaining assets appear in the Index Block output.
**Note** - It is recommended that both of the settings mentioned above are set to a finite number. Having an unlimited number of assets returned in Index Blocks can decrease performance in systems with a very large number of assets.

---

### Working with a collection of assets

There are many scenarios where you'll need to be able to iterate over a collection of assets within the CMS. For example, you may require the ability to generate links to several items within a Folder as part of a navigation menu. Another common scenario includes being able to list something like the top most recent news articles on a page.
Whatever the use case is, there are a number of different ways in which you could approach this. In the sections that follow, we'll cover some different methods you can use to ultimately retrieve and output the same information from a collection of Page assets.
For the samples that follow, consider the existing folder/asset hierarchy:
- folderApage1
- page2
- page3
The idea here is that given a setup as described above, we want to:
1. Iterate over all of the Page assets in the Folder
2. For each Page we encounter, output a link to it
3. Use each Page's Display Name for the link text
4. Make the links part of an unordered list
For the final output, the goal will be to produce the following HTML:
```
<ul> <li> <a href="site://siteName/folderA/page1">Display Name for page1</a> </li> <li> <a href="site://siteName/folderA/page2">Display Name for page2</a> </li> <li> <a href="site://siteName/folderA/page3">Display Name for page3</a> </li></ul>
```
## Using the Locator Tool (Velocity)
If the items you want to access are all contained within a particular Folder, you can use the Locator Tool to access that Folder and then iterate over the child assets within it.
```
#set ($folder = $_.locateFolder("folderA", "siteName"))<ul>#foreach ($child in $folder.children) <li> <a href="${child.link}">${child.metadata.displayName}</a> </li>#end</ul>
```
## Using the Query API (Velocity)
The Query API is another option which will enable you to query for assets having a particular property associated with them. Given the example from above, let's say we know each of those Pages that we're after use a given Content Type called `standard-page`. We can query for that Content Type and output the information we need using something like this:
```
#set ($query = $_.query())#set ($query = $query.byContentType("standard page"))#set ($query = $query.maxResults(10))#set ($query = $query.sortDirection("desc"))#set ($results = $query.execute())<ul>#foreach ($child in $results) <li> <a href="${child.link}">${child.metadata.displayName}</a> </li>#end</ul>
```
**Tip**: Querying by Content Type will return all assets using that Content Type regardless of whether they are in a particular Folder or not. You can limit to a particular Folder using the `byFolderPath` option of the tool. Example:
`#set ($query = $query.byFolderPath("folderA"))`
## Using an Index Block and Format
To target items within a particular parent Folder, a combination of an Index Block and Format can also be used to produce the needed HTML output. For the purposes of this example, we'll use a **Folder Index Block** to target `folderA` (but know that it is also possible to create a **Content Type Index Block** as an alternative here depending on your setup).
### Creating/configuring the Index Block
Create a new Index Block with the following settings (at a minimum).
| **Field** | **Value** | **Notes** |
| --- | --- | --- |
| Index Type | Folder Index |   |
| Index Folder | folderA | Choose the Folder containing the assets you need. |
| Depth of Index | 1 | Depth is 1 here as all of our assets are directly underneath the Folder. You can bump this number if you have assets within subfolders of the main Folder. |
| Max Rendered Assets | 50 | This should be set to a realistic maximum based on how many assets you expect to be retrieving. |
| Indexed Asset Types | Pages |   |
| Page XML | Do not render page XML inline |   |
| Indexed Asset Content | Regular Content | This option includes everything we need for what we're looking to produce in the final HTML. |
These settings in the Index Block will produce XML like the following:
```
<system-index-block name="index" type="folder" current-time="1711644535471"> <system-page id="857629d2c0a8003d7e9bd9ccf9169379"> <name>page3</name> <display-name>Display Name for page3</display-name> <path>/folderA/page3</path> <site>siteName</site> <link>site://siteName/folderA/page3</link> </system-page> <system-page id="857508eac0a8003d7e9bd9ccd887e114"> <name>page2</name> <display-name>Display Name for page2</display-name> <path>/folderA/page2</path> <site>siteName</site> <link>site://siteName/folderA/page2</link> </system-page> <system-page id="85735ac3c0a8003d7e9bd9cc76e1d3de"> <name>page1</name> <display-name>Display Name for page1</display-name> <path>/folderA/page1</path> <site>siteName</site> <link>site://siteName/folderA/page1</link> </system-page></system-index-block>
```
Now, we can target the information from the XML using the XPathTool in Velocity or in an XSLT Format. Examples of both options can be found below:
### Velocity
```
#set ($pages = $_XPathTool.selectNodes($contentRoot, "system-page"))<ul>#foreach ($page in $pages) <li> <a href="${page.getChild('link').value}">${page.getChild('display-name').value}</a> </li>#end</ul>
```
### XSLT
```
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0"> <xsl:template match="system-index-block"> <ul> <xsl:apply-templates select="system-page" /> </ul> </xsl:template> <xsl:template match="system-page"> <li> <a> <xsl:attribute name="href"><xsl:value-of select="link" /></xsl:attribute> <xsl:value-of select="display-name" /> </a> </li> </xsl:template></xsl:stylesheet>
```

## Related Links
- Velocity Tools
- Formats
- Index Blocks

---

### WYSIWYG Editor Configurations

WYSIWYG Editor Configurations allow you to customize which features of the WYSIWYG rich-text editor are available to content creators.

---

### XML Blocks

## Overview
XML Blocks are reusable pieces of content stored as well-formed, static XML or XHTML. These blocks are particularly useful when there is content/data which must be included on one or more pages of a website.
Dealing with XHTML in particular, when the presentation layer is less of a consideration these blocks make managing the content much easier. For example, when wanting to manage links to CSS and/or Javascript files in one location, this type of content is not well-suited for managing in the WYSIWYG of an HTML Block.
## Creating an XML Block
To create an index block:
1. Click **Add Content** > **Default** > **Block**.
2. Select **XML** and click **Choose**.
3. In the **Name** field, enter a name for your block.
4. In the **Placement Folder** field, choose the folder where the block should be created.
5. You can add XML content to the block either by uploading an XML file or by entering content directly into the code editor.
6. Click **Preview Draft** and **Submit**.

---

## Development

*14 articles in this category*

### Code Sections

## Passthrough Code Sections
Passthrough code sections instruct the interpreter to exclude the enclosed code when the page is being previewed internally. Upon publishing, the contents of these tags will be uncommented and included in the final page.
The passthrough code section is delimited as follows:
```
<!--#passthrough...put any code here...#passthrough-->
```
This deprecated way is also allowed:
```
<!--#START-CODE...put any code here...#END-CODE-->
```
When viewing a file or page containing these types of blocks within the CMS, these sections are left untouched unless the asset is a page with serialization type of PDF or RTF (as determined by the Target associated with the page's Template). If the serialization type is PDF or RTF the section is simply stripped from the code.
When publishing a file or page containing these blocks to a location outside the CMS, these sections are rewritten so that the enclosing comments and #passthrough strings are removed. However, when publishing a page with PDF or RTF serialization type, these sections are once again completely removed rather than rewritten.
For example, suppose we wanted to embed the following PHP code in a page:
```
<?php echo "<Hello World>" ?>
```
Wrapping the passthrough code comment tags allows the page to validate as XML:
```
<!--#passthrough<?php echo "<Hello World>" ?>#passthrough-->
```
When viewing this page in the system, this code would remain inside of the comments untouched; and the PHP code will not render (unless a PDF or RTF configuration of a page is viewed, in which case the comments and the code would be removed).
However, upon publishing to a file with serialization type of HTML or XML, the comment tags are stripped out leaving only the valid PHP code.
When publishing to a PDF or RTF file, or viewing a PDF or RTF configuration of the page within the system, the comments and the code would both be stripped out.
## Passthrough-Top Code Sections Tags
The second type of code section currently supported in the system is the passthrough-top code section, which is delimited as follows:
```
<!--#passthrough-top … put any code here… #passthrough-top-->
```
This deprecated way is also allowed:
```
<!--#START-ROOT-CODE … put any code here… #END-ROOT-CODE-->
```
The passthrough-top code section is used to support code that must be placed at the very beginning of a document (file or page) – for example, an ASP page that requires a processing instruction before the page's DOCTYPE. Because the system does not allow for XML comments before the root element or DOCTYPE in a template, such code must be placed inside of a root code section.
The rules for rendering these code sections both inside and outside of the CMS are the same as for the passthrough code section with one notable difference - when publishing to a file or page with serialization type HTML or XML, the comment tags are removed, but the code inside the comments is actually moved to the beginning of the document. This can be useful if, for example, you need to include a page redirect at the top of the page, but you are using a template that does not have a content region defined at the very top.
For example, suppose you have the following .NET template:
```
<%@ Page Language="C#" AutoEventWireup="true" CodeFile="Default.aspx.cs" Inherits="_Default" %> <%@ Page Language="C#" AutoEventWireup="true" CodeFile="control.aspx.cs" Inherits="_Default" %> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> <html xmlns="http://www.w3.org/1999/xhtml">  <head runat="server">  <title>  <system-page-title />  </title>  </head>  <body>  <system-region name="DEFAULT" />  </body> </html>
```
Therefore, when a page using this template was published, the ASP instructions would appear before the page's DOCTYPE.
The following root code section tags could be used to create this template in the CMS:
```
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> <html xmlns="http://www.w3.org/1999/xhtml"> <!--#passthrough-top <%@ Page Language="C#" AutoEventWireup="true" CodeFile="Default.aspx.cs" Inherits="_Default" %> <%@ Page Language="C#" AutoEventWireup="true" CodeFile="control.aspx.cs" Inherits="_Default" %> #passthrough-top-->  <head runat="server">  <title>  <system-page-title/>  </title>  </head>  <body>  <system-region name="DEFAULT"/>  </body> </html>
```
If there were multiple passthrough-top code sections in a page or file, they would be placed sequentially at the top of the document in the relative order that they appeared.
## Protect Code Sections Tags
These code sections work the same as passthrough code sections with the exception that protect code sections are also rendered inside of Cascade CMS. Because of that, the purpose of these code sections is shifted from outputting server side code to client side code such as Javascript. This also allows outputting unbalanced XML for old browser support.
Protect code sections are delimited as follows:
```
<!--#protect...put any code here...#protect-->
```
or
```
<![CDATA[#protect...put any code here …#protect]]>
```
Using the CDATA format allows for special sequences of characters to be entered, such as `--` which is commonly used in JavaScript as a decrement operation. During the last stage of rendering a Page, the special wrapping tags are stripped leaving the text `...put any code here...` in the example above.
Below you will find an example that outputs unbalanced XML that could be used to aid the support of older web browsers.
```
<![CDATA[#protect <!--[if IE 7]> <body lang=”en”> <![endif]--> <!--[if !(IE 7)]> <body> <![endif]--> #protect]]> … <![CDATA[#protect </body> #protect]]>
```
This will result in following code which normally (without use of code sections) would not be allowed by Cascade CMS:
```
<!--[if IE 7]>  <body lang=”en”> <![endif]--> <!--[if !(IE 7)]>  <body> <![endif]-->  … </body>
```
## Protect-Top Code Sections Tags
These code sections work just as passthrough-top code sections but again with the exception that protect-top code sections are also rendered inside of Cascade CMS. You can use these code sections to output a non-standard doctype, use Cascade CMS pages to dynamically render non XML content such as JavaScript, CSS or JSON, or output the HTML 5 Boilerplate code.
The syntax for client root code section is delimited as follows:
```
<!--#protect-top...put any code here...#protect-top-->
```
or
```
<![CDATA[#protect-top...put any code here ...#protect-top]]>
```
During the last stage of rendering the page, the special syntax is stripped leaving the text `...put any code here...` in the example above and that text is then being moved above the XML document.
The following code can be used to output the HTML 5 Boilerplate (h5bp) code:
```
<html class="no-js"><!--<![endif]--> <![CDATA[#protect-top <!DOCTYPE html> <!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]--> <!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]--> <!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]--> <!--[if gt IE 8]><!--> #protect-top]]>
```
The result of this code will be:
```
<!DOCTYPE html> <!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]--> <!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]--> <!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]--> <!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
```
## Cascade Skip Tags
In some situations it is useful to completely remove part of the code. This is possible through outputting #cascade-skip tag inside of HTML comments. For example, the code below:
```
<xml><!--#cascade-skip--><unnecessary-tag/><!--#cascade-skip--></xml>
```
will result with the `<unnecessary-tag/>` being removed after the page finishes rendering, right before it is published out or outputted to the screen:
```
<xml/>
```
Placing only one `<!--#cascade-skip-->` tag results with the remaining contents being fully stripped. This is especially useful together with the #protect-top tag. For example, this valid XML document:
```
<xml><![CDATA[#protect-top <!--#cascade-skip--> #protect-top]]> </xml>
```
will result with a pure JavaScript code completely stripped of XML tags:
```
```
A practical real life scenario would involve constructing an XSLT or Velocity format that dynamically renders contents inside of the protect-top code section in example above to get a result with dynamically generated JavaScript code.

---

### Data Definition Field(s) to System Name Plug-in

## Overview
These plug-ins generate search engine friendly system names from one or more Data Definition fields.
**Note** - Asset naming rules will override the system name conversion done by the plug-in if the rules conflict.
## Multiple Data Definition Fields
This Data Definition Fields to System Name Plug-in runs after the user submits the new page. First, it checks the system name of the new asset; if the new asset's name has not been changed, the plug-in takes the value of the Data Definition text fields specified by the "field identifiers" parameter, concatenates them together using the "concatenation token" parameter, makes the resulting string lower-case and then replaces all spaces with the "space token" string. It then sets the result to be the system name of the new asset.
**Field Identifiers** - A comma-separated list of the identifiers of Data Definition text nodes to pull the new name's segments from. These are the values that will be concatenated together. Each Data Definition node listed can be of the form `/group-identifier/.../node-identifier` where `...` represents any number of group identifiers separated by `/` characters. In the case where a Data Definition has multiple fields with the same identifier, this path can be used to specify which field should be used by the plugin.
**Concatenation Token** - The string that will be introduced between each "segment" taken from the Data Definition text nodes. If left blank or omitted, each "segment" will be concatenated together with nothing in between.
**Space Token** - The string that will replace spaces inside each "segment" if it contains spaces. If omitted, whitespace will be preserved. If specified but left blank, all whitespace will be removed.

---

### Data Definition XML Schema Reference

## Group
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| **group** | {group} | Used to group collections of fields together. Groups are collapsible and can be nested inside of other groups. | No |
#### Attribute(s)
| Attribute Name | Values | Description | Req. |
| --- | --- | --- | --- |
| **identifier** | [alphanumeric] | The name of the resultant XML tag upon outputting the Data Definition. | Yes |
| **label** | [string] | The text displayed on the screen as the title of the grouping. | No |
| **multiple** | true, false | Whether or not this group of items can be repeated by the user. | No |
| **maximum-number** | [numeric] | The maximum number of times this group can be repeated (only applicable if multiple="true"). | No |
| **minimum-number** | [numeric] | The minimum number of times this group should be repeated (only applicable if multiple="true"). | No |
| **restrict-to-groups** | [groups] | A comma separated list of groups that his field is restricted to for access purposes. If the user is not a member of one of the groups, the field does not appear. | No |
| **collapsed** | true, false | States whether or not the group should be collapsed upon the form load. The user can always manually collapse and expand groups after the form loads. Default: false. | No |
---
## Shared Field
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| **shared-field** |  {group} | Used to embed a Shared Field, a centrally-managed and shareable field or field group. | Yes |
#### Attribute(s)
| Attribute Name | Values | Description | Req. |
| --- | --- | --- | --- |
| identifier | [alphanumeric] | The name of the resultant XML tag upon outputting the Data Definition. | Yes |
| field-id | [string] | Unique identifier automatically generated by Cascade CMS which associates the field with the persisted structured data content. If this value is changed, existing content will no longer be associated with this field and future Data Definition versions. | No |
| path | [string] | The path to the Shared Field asset within the CMS. |  Yes |
| **label** | [string] | The text displayed on the screen as the label of the field. | No |
| **required** | true, false | Whether or not this field is required. | No |
| **default** | [string] | The default value of the field. | No |
| **maximum-number** | [numeric] | The maximum number of additional fields allowed (only applicable if multiple="true"). | No |
| **minimum-number** | [numeric] | The minimum number of additional fields (only applicable if multiple="true"). | No |
**Note** - Some of the attributes listed above may not be applicable to your Shared Field type. Please reference the section corresponding to the appropriate field type for applicable attributes.
---
## Asset
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| **asset** | {group} | Used to allow the user to choose an existing asset within the CMS (limited to pages, files, blocks, and symlinks). | No |
#### Attribute(s)
| Attribute Name | Values | Description | Req. |
| --- | --- | --- | --- |
| **identifier** | [alphanumeric] | The name of the resultant XML tag upon outputting the Data Definition. | Yes |
| **field-id** |  [string] | Unique identifier automatically generated by Cascade CMS which associates the field with the persisted structured data content. If this value is changed, existing content will no longer be associated with this field and future Data Definition versions. | No |
| **label** | [string] | The text displayed on the screen as the label of the asset chooser. | No |
| **multiple** | true, false | Whether or not the user is allowed to create additional assets. | No |
| **required** | true, false | Whether or not this field is required. | No |
| **help-text** | [string] | Help information that is specific to the field. | No |
| **maximum-number** | [numeric] | The maximum number of additional fields allowed (only applicable if multiple="true"). | No |
| **minimum-number** | [numeric] | The minimum number of times this asset should be repeated (only applicable if multiple="true"). | No |
| **type** | "page", "file", "block", "symlink", or "page,file,symlink" | The type of asset chooser used to filter the available choices. A value of "page,file,symlink" will allow any of those three asset types to be selected in a single chooser. | Yes |
| **render-content-depth** | 1-231, unlimited | This specifies how many levels deep content of nested asset choosers should be rendered, including the current asset. For example, "1" means only content of current asset should be rendered and content of selected asset should not be rendered; "2" means that content of current and selected asset should be rendered, but if selected asset contains any asset choosers, then contents of selected assets for those choosers should not be rendered. If this attribute is not specified, or an invalid value is present, a value of "1" is assumed. | No |
| **restrict-to-groups** | [groups] | A comma separated list of groups that his field is restricted to for access purposes. If the user is not a member of one of the groups, the field does not appear. | No |
| **restrict-to-folder** |  [string] | A path to a folder to which asset selection or uploads will be restricted (ex. "/_files/images" or "site://Site Name/_files/images"). |  No |
---
## Text
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| **text** | {group} | Used for manual input from the user resulting in a text valued stored for the XML. | No |
#### Attribute(s)
| Attribute Name | Values | Description | Req. |
| --- | --- | --- | --- |
| **identifier** | [alphanumeric] | The name of the resultant XML tag upon outputting the Data Definition. | Yes |
| **field-id** | [string] | Unique identifier automatically generated by Cascade CMS which associates the field with the persisted structured data content. If this value is changed, existing content will no longer be associated with this field and future Data Definition versions. | No |
| **label** | [string] | The text displayed on the screen as the label of the text field. | No |
| **multiple** | true, false | Whether or not the user is allowed to create additional text fields. | No |
| **required** | true, false | Whether or not this field is required. | No |
| **default** | [string] | The default value of the text field. | No |
| **multi-line** | true, false | For text input fields, whether or not it should have multiple input lines. | No |
| **maximum-number** | [numeric] | The maximum number of additional fields allowed (only applicable if multiple="true"). | No |
| **minimum-number** | [numeric] | The minimum number of additional fields (only applicable if multiple="true"). | No |
| **regular-expression** | [JavaScript regular expression] | A JavaScript regular expression with which to match the data inputted by the user. If the regular expression provided is invalid, it will be ignored. Non-required fields that are left empty will not be validated against the regular expression. | No |
| **input-data-format** | [string] | The value to display to the user if the regular expression doesn't match. | No |
| **wysiwyg** | true, false | Whether or not the text field should be a visual word processor. | No |
| **wysiwyg-toolbar-remove **(deprecated) | font formatting, font assignment, text formatting, insert image, insert table, html view | Elements of the WYSIWYG that can be removed from the toolbar.Only valid when wysiwyg="true". (Deprecated in favor of **configuration**.) | No |
| **configuration** | [string] | The name of a same-site WYSIWYG Editor Configuration or path to a cross-site configuration (ex. "site://Site Name/Configuration Name").Only valid when wysiwyg="true". | No |
| **rows** | [numeric] | Number of rows when multi-line=”true”. | No |
| **cols** | [numeric] | Number of columns when multi-line=”true”. | No |
| **maxlength** | [numeric] | The maximum number of characters in a standard text field. | No |
| **size** | [numeric] | The width of a standard text field. | No |
| **help-text** | [string] | Help information that is specific to the field. | No |
| **type** | checkbox, dropdown, radiobutton, multi-selector, datetime | The type of text input field. Leave attribute out for a standard text input box. Please note that the value "calendar" is deprecated in favor of "datetime." | No |
| **restrict-to-groups** | [groups] | A comma separated list of groups that his field is restricted to for access purposes. If the user is not a member of one of the groups, the field does not appear. | No |
| **allow-custom-values** | true, false | For dropdown fields only; specifies whether or not a user can enter a custom value into the field. | No |
| restrict-to-folder | [string] | A path to a folder to which image and file/link selection or uploads will be restricted (ex. "/_files/images" or "site://Site Name/_files/images"). Only valid when wysiwyg="true". |  No |
---
## Checkbox
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| **checkbox-item** | text | Available items only used with text type of checkbox. | Yes |
#### Attribute(s)
| Attribute Name | Values | Description | Req. |
| --- | --- | --- | --- |
| **value** | [string] | The value displayed on screen if no label is provided and in the resulting XML. | Yes |
| **label** | [string] | The text displayed on screen as the label of the value. | No |
| **checked** | true, false | Whether or not this item is currently checked. | No |
| **show-fields** | [string] | Contains paths to fields that should appear when this checkbox is checked. These fields will be hidden by default. Field paths should be comma separated. The field path should include the field's ancestor group identifiers and the field's identifier. Each section of the path should be separated by "/" character, for example: "fieldIdentifier, groupIdentifier/fieldIdentifier, group1Id/group2Id/fieldId". | No |
---
## Dropdown
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| **dropdown-item** | text | Available items only used with text type of drop down. | Yes |
#### Attribute(s)
| Attribute Name | Values | Description | Req. |
| --- | --- | --- | --- |
| **value** | [string] | The value displayed on screen if no label is provided and in the resulting XML. | Yes |
| **label** | [string] | The text displayed on screen as the label of the value. | No |
| **show-fields** | [string] | Contains paths to fields that should appear when this dropdown item is selected. These fields will be hidden by default. Field paths should be comma separated. The field path should include the field's ancestor group identifiers and the field's identifier. Each section of the path should be separated by "/" character, for example: "fieldIdentifier, groupIdentifier/fieldIdentifier, group1Id/group2Id/fieldId". | No |
---
## Selector
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| **selector-item** | text | Available items only used with text type of multi-selector. | Yes |
#### Attribute(s)
| Attribute Name | Values | Description | Req. |
| --- | --- | --- | --- |
| **value** | [string] | The value displayed on screen if no label is provided and in the resulting XML. | Yes |
| label | [string] | The text displayed on screen as the label of the value. | No |
| **selected** | true, false | Whether or not this item is currently selected. | No |
| **show-fields** | [string] | Contains paths to fields that should appear when this item is selected. These fields will be hidden by default. Field paths should be comma separated. The field path should include the field's ancestor group identifiers and the field's identifier. Each section of the path should be separated by "/" character, for example: "fieldIdentifier, groupIdentifier/fieldIdentifier, group1Id/group2Id/fieldId". | No |
---
## Radio
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| **radio-item** | text | Available items only used with text type of radio button. | Yes |
#### Attribute(s)
| Attribute Name | Values | Description | Req. |
| --- | --- | --- | --- |
| **value** | [string] | The value displayed on screen if no label is provided and in the resulting XML. | Yes |
| **label** | [string] | The text displayed on screen as the label of the value. | No |
| **show-fields** | [string] | Contains paths to fields that should appear when this radiobutton is selected. These fields will be hidden by default. Field paths should be comma separated. The field path should include the field's ancestor group identifiers and the field's identifier. Each section of the path should be separated by "/" character, for example: "fieldIdentifier, groupIdentifier/fieldIdentifier, group1Id/group2Id/fieldId". | No |
---

---

### Data Definitions

A Data Definition is a collection of fields used in the creation and editing of page and block content.

---

### How do I access Dynamic / Custom Metadata Fields in Velocity?

## With the XPath Tool
If you're using an Index Block and the XPath Tool, you can target the name of your Custom Metadata Field in your [XPath Syntax](https://www.w3schools.com/xml/xpath_syntax.asp). Example:
```
#set ($category = $_XPathTool.selectSingleNode($contentRoot, "//calling-page/system-page/dynamic-metadata[name='category']/value"))#if (!$_PropertyTool.isNull($category)) $category.value#end
```
or for multiple values:
```
#set ($categories = $_XPathTool.selectNodes($contentRoot, "//calling-page/system-page/dynamic-metadata[name='categories']/value"))#if (!$_PropertyTool.isNull($categories) && $categories.size() > 0) #foreach($category in $categories) $category.value #end#end
```
## With our API
If you're using our API, you can use `.getDynamicField()` to set your variables. Example:
```
#set ($category = $currentPage.metadata.getDynamicField('category'))#if (!$_PropertyTool.isNull($category)) $category.value#end
```
or for multiple values:
```
#set ($categories = $currentPage.metadata.getDynamicField('categories'))#if (!$_PropertyTool.isNull($categories) && $categories.values.size() > 0) #foreach($category in $categories.values) $category #end#end
```
It's also possible to access both the possible field items and selected field items of a multi-value field in order to access both their `label` and `value` properties. Referencing the `label` property is useful when you need to change the representation of a field item without affecting selected values in existing content:
```
#set ($possibleCategories = $currentPage.metadata.getDynamicField('categories').getPossibleFieldItems())#set ($selectedCategories = $currentPage.metadata.getDynamicField('categories').getSelectedFieldItems())Possible categories:#if (!$_PropertyTool.isNull($possibleCategories)) #foreach($category in $possibleCategories) $category.label - $category.value #end#endSelected categories:#if (!$_PropertyTool.isNull($selectedCategories)) #foreach($category in $selectedCategories) $category.label - $category.value #end#end
```

---

### How do I make CSS classes available in the WYSIWYG formats drop-down menu?

To allow users to apply styles to their content within the WYSIWYG editor:
**1a. At the Site Level:**
1. Click **Manage Site** > **WYSIWYG Editor Configurations**.
2. Select your configuration or click **Create** to add one.
3. In the CSS File field click **Choose File **and select the CSS file containing the classes you wish to make available and click **Choose**.
**1b. Or at the System Level** (the System Default configuration will be used for Sites without a configuration selected):
1. Click ** Menu **> ** Administration**.
2. Under Preferences click **System Default WYSIWYG Editor Configuration**.
3. Click **Edit**.
4. In the CSS File field click **Choose File **and select the CSS file containing the classes you wish to make available and click **Choose**.
**2. Custom Styles:** Once a CSS file is chosen, you will see an additional Custom Styles field appear. This field gives you the option to limit the classes from the CSS file which will be visible to users by listing specific classes you wish to make available. For example, if the CSS file contains the classes:
```
.red { color: red;}.blue { color: blue;}.yellow { color: yellow;}
```
but you only wish to allow for users to select `blue` and `red`, list these two class names in the Custom Styles field (comma-delimited) as follows: `blue, red`.
Now users should see the `blue` and `red` styles available in the Formats drop-down menu of the WYSIWYG editor.
For more granularity, WYSIWYG Editor Configurations can also be assigned at the Data Definition or Content Type level.
**At the Data Definition Level:**
1. Click **Manage Site** > **Data Definitions**
2. Select your Data Definition and click **Edit**.
3. Click the pencil icon to edit your WYSIWYG field and click **Show Advanced Settings **> ** Choose WYSIWYG Editor Configuration **and choose your desired configuration.
**At the Content Type Level:**
1. Click **Manage Site** > **Content Types**
2. Select your Content Type and click **Edit**.
3. Under Type of Content select **No Data Definition (WYSIWYG Only)**.
4. Click **Choose WYSIWYG Editor Configuration **and choose your desired configuration.
**Tip** - You can check which Editor Configuration is being used by a WYSIWYG by clicking **Tools** > **Info**.
## Related Links
- WYSIWYG Editor Configurations

---

### How do I view sample XML when editing a Format?

Often times, when coding (or debugging) a Format, it is important to be able to view sample XML that may be applied to a Format. Or, if you are working with a Velocity Format, you may need to specify a context page in order to test the built in `$currentPage` and `$currentPageSiteName` variables.
To do so:
- Edit the Format.
- Above the code for the Format, on the right-hand side of the screen, open the **Preview Options** dropdown.
- Select the **Block** or the **Block+Page** that this Format will be transforming.
- After you select those options, the read-only editor to the right of the Format's code will be populated with the rendered XML based on the selected options within the dropdown.

---

### How to update deprecated Velocity code

## $_FieldTool.in("com.hannonhill.cascade.model.dom.identifier.EntityTypes")
The `$_FieldTool.in(String)` method was used to obtain reference to entity types in order to locate assets using the Locator Tool. New methods added to the Locator Tool allow for locating each type of asset.
### Examples
```
$_.locate($currentPagePath, $_FieldTool.in("com.hannonhill.cascade.model.dom.identifier.EntityTypes").TYPE_PAGE, $currentPageSiteName)
```
```
$_.locate("path/to/format", $_FieldTool.in("com.hannonhill.cascade.model.dom.identifier.EntityTypes").TYPE_FORMAT, $currentPageSiteName)
```
```
$endCal.add( $_FieldTool.in("java.util.Calendar").YEAR, $numberOfYearsToDisplay )
```
```
#set ( $System = $String.class.forName('java.lang.System') )#set ( $newLine = $System.getProperty('line.separator')#set ( $title = $title.replaceAll($newLine, '') )
```
### Replacements
```
$currentPage
```
```
$_.locateFormat("path/to/format")
```
```
$endCal.add( $_FieldTool.in($endCal).YEAR, $numberOfYearsToDisplay )
```
```
#set ( $title = $title.replaceAll($_EscapeTool.n, '') )
```
## Generating a random content
The `java.util.UUID` , `org.apache.commons.codec.digest.DigestUtils` and `java.util.Random` classes were often used to generate random strings or UUIDs. A common use case is to generate unique DOM element identifiers.
A new method, generateUUID(), added to the String Tool generates random UUID strings and there is an existing Math Tool method, random(), that can generate random numbers.
### Examples
```
#set($id = "video-${class.forName('java.util.UUID').randomUUID().toString()}")...<div id="${id}">...</div>
```
```
$class.forName('java.util.Random').newInstance().nextInt(9999999)
```
### Replacements
```
<div id="video-${_StringTool.generateUUID()}">...</div>
```
```
$_MathTool.random(0, 9999999)
```
## Unescaping content
The `org.apache.commons.lang.StringEscapeUtils` class was used as a way to unescape content that was previously escaped, such as HTML, XML, JavaScript, etc. New methods added to the Escape Tool provide ways to unescape content.
### Example
```
$class.forName('org.apache.commons.lang.StringEscapeUtils').unescapeHtml("&lt;br/&gt;")## <br/>
```
### Replacement
```
$_EscapeTool.unescapeHtml("&lt;br/&gt;")## <br/>
```
## Regular expressions and pattern matching
The `java.util.regex.Pattern` class was used to compile regular expressions for complex regular expression testing and group matching. A new Regex Tool provides a way to generate these pattern objects.
### Example
```
#set($_pattern = $class.forName("java.util.regex.Pattern"))#set( $_ids = $_pattern.compile("#([\w_-]+)").matcher($_s) )
```
### Replacement
```
#set( $_ids = $_RegexTool.compile("#([\w_-]+)").matcher($_s) )
```
## Concatenate strings using StringBuilder
The ` java.lang.StringBuilder` class was used as a way to concatenate strings together for outputting later, without introducing adding extra whitespace into the output. A new String Tool method provides access to a `														[StringBuilder](https://docs.oracle.com/en/java/javase/11/docs/api/java.base/java/lang/StringBuilder.html)													` instance.
### Example
```
#set($sb = $class.forName('java.lang.StringBuilder').newInstance())#set ($sb = $sb.append('foo'))... ${sb}
```
### Replacement
```
#set($sb = $_StringTool.getStringBuilder())#set ($sb = $sb.append('foo'))... ${sb}
```
## Checking Cascade asset type using getClass()
The `getClass()` method was used as a way to access the underlying class of a given Cascade API object, such as combining with `getSimpleName()`. The Cascade API provides a way to access the asset type using `getAssetType()`.
### Example
```
#set ($chosenAsset = $currentPage.getStructuredDataNode("assetchooser").asset)#if ($chosenAsset.class.simpleName == "PageAPIAdapter")...#end
```
### Replacement
```
#set ($chosenAsset = $currentPage.getStructuredDataNode("assetchooser").asset)#if ($chosenAsset.assetType == "page")...#end
```
## Checking data structure type using getClass()
The `getClass()` method was used as a way to access the underlying class of a given object, such as combining with `getSimpleName()`. Various methods have been added to the Property Tool to check data structure types: `isString`, `isMap`, `isList`, `isSet`, and `isIterable`.
### Example
```
#set($map = {})#if ($map.class.simpleName.contains("Map"))...#end
```
### Replacement
```
#set($map = {})#if ($_PropertyTool.isMap($map))...#end
```
## Checking if an object is numeric using getClass()
The `getClass()` method was used as a way to check if a given object is numeric. A method has been added to the Number Tool to check if a given object is numeric.
### Example
```
#set($number = 3)#if ($number.class.forName('java.lang.Number'))...#end
```
### Replacement
```
#set($number = 3)#if ($_NumberTool.isNumeric($number))...#end
```
## Converting a map to JSON string
A new $_StringTool.toJson method was added to allow for easily outputting a Map as a JSON string.
### Example
```
#set($map = {"test": "testing", "array": [1, 2, 3]})#foreach ($key in $map.keys) #set ($value = $map.get($key)) ...#end
```
### Replacement
```
#set($map = {"test": "testing", "array": [1, 2, 3]})$_SerializerTool.toJson($map)
```

## Related Links
- Velocity Tools

---

### Logs and System Information

## Overview
This area of the system allows system administrators to download log files and view other information related to the application's environment (memory, JVM settings, O/S version, etc). You can access it by clicking the system menu button ( * *) > **Administration** > **Logs and System Information**.
## System Information
The **System Information** tab contains information related to the application's environment including:
- System time
- Memory allocation/usage
- License details
- Java/JVM details
- Application server O/S vendor/version
- Database vendor/version
- Web application server vendor/version
## Logs
The **Logs** tab will present you with a listing of `cascade.log` files available in your instance of Cascade CMS. From this interface, you can search log files by date and download them in **txt** or **zip** format by clicking on the corresponding buttons in the **Download** column of the table listing.
This interface can be useful for CMS administrators who need to retrieve log files but who may not have direct access to the application server where the log files are stored on disk.
**Tip** - The log file containing the latest information will always be named `cascade.log` until it rolls over and a datestamp is appended.

---

### PageRenderException: Could not transform with Script format

When previewing a page, you may see a full-page error of the type `Could not transform with Script format...` . This indicates that a Format responsible for rendering part of the page's content is encountering an error.
The path to the Format in question will be included in the first half of the error. The second half of the error lets you know what type of error is being encountered. Here are some common Format error types:
## Element type "img" must be followed by either attribute specifications, ">" or "/>".
Example:
`An error occurred: com.hannonhill.cascade.model.render.page.PageRenderException: Could not transform with Script format "path/to/format": Error on line #: Element type "img" must be followed by either attribute specifications, ">" or "/>".`
This indicates that an image tag in a format is being interrupted from closing by an unescaped character such as a quotation mark. This can often happen in alternative text attributes.
To address this, navigate to the Format specified in the error message, and escape any variables that may contain problematic content such as titles or alternative text. For example, if you're outputting an image tag with:
```
<img src="${path}" alt="${alt}"/>
```
You can escape your alternative text attribute using the `$_EscapeTool`:
```
<img src="${path}" alt="${_EscapeTool.xml($alt)}"/>
```
This will ensure any problematic characters like `&` are escaped as `&amp;`.
## The entity name must immediately follow the '&' in the entity reference. / The reference to entity "..." must end with the ';' delimiter.
Examples:
`An error occurred: com.hannonhill.cascade.model.render.page.PageRenderException: Could not transform with Script format "path/to/format": Error on line ##: The entity name must immediately follow the '&' in the entity reference.`
```An error occurred: com.hannonhill.cascade.model.render.page.PageRenderException: Could not transform with Script format "path/to/format": Error on line ##: The reference to entity "..." must end with the ';' delimiter.`
These usually indicate that an ampersand (`&`) character in a variable isn't being properly escaped in the Format listed in the error message.
To address this, navigate to the Format specified in the error message, and escape any variables that may contain non-XML-friendly content such as titles, descriptions, or links that may contain URL parameters.
For example, if you're outputting a title variable with:
```
<h1>$title</h1>
```
Escape the content using something like the `$_EscapeTool`:
```
<h1>${_EscapeTool.xml($title)}</h1>
```
This will ensure any invalid characters such as `&` are escaped as `&amp;`.
## The requested asset does not exist: Format #import with path 'path/to/imported/format'
Example:
`An error occurred: com.hannonhill.cascade.model.render.page.PageRenderException: Could not transform with Script format "path/to/format": com.hannonhill.cascade.exception.AssetNotFoundException: The requested asset does not exist: Format #import with path 'path/to/imported/format'`
This indicates that the Format specified in the first half of the error message is importing another Format that doesn't exist at the path listed in the second half of the message.
Check the Format specified in the error message to ensure that the imported Format exists and that the path called out (ex. `#import 'path/to/format'`) is correct.

## Related Links
- Velocity Tools

---

### Templates

Templates are XHTML documents that provide the structure of page assets. Templates typically contain the HTML scaffolding and necessary scripts and CSS files to produce the desired "look and feel" of a page.

---

### Velocity Cheat Sheet

## Basic Velocity Code
All statements in Velocity start with a `#` symbol; all variables start with a `$` sign.
### Variable naming conventions
All variables must start with a letter, either lowercase or uppercase. Otherwise they can contain numbers, and/or underscores.`      `
`		` `$abc, $ABC, $a12, $oneTwo, $one_two`
Variables are duck-typed dynamically. Use `.class` to determine the type of variable.
`$string.class ……… class java.lang.String
`
`$number.class ……… class java.lang.Integer or class java.lang.Double	 `
`$array.class ……… class java.util.ArrayList	 `
`$hash.class ……… class java.util.LinkedHashMap`
When a variable is used inside quote marks, we add curly braces: `${var}	`
### Comments
`## This is a Velocity comment. `
`#* This is a	`
`multi-line comment *#`
### Assignment
`#set($var = )`
`#set ($dir = "www" )`
`#set ($page = "index.html" )`
####   Interpolation:
`  #set ($path = "/$dir/$page" )																																			`
`  $path ……… /www/index.html`
####   Concatenation:
`  #set($path = “/” + $dir + “/” + $page)`
`  $path ……… /www/index. html`
### Directives  (Loops and Macros are discussed below)
####    Break, Stop
`   #foreach($num in [1..4]) `
`       #if($num == 3) `
`          #break ## breaks the loop but executes any subsequent code in the file `
`          #stop ## terminates execution entirely `
`       #end `
`       $num `
`    #end
`
####    Evaluate (This Directive takes a string and evaluates it as code!)
`   #set($var1 = "peaches")
````#set($num = "1")`
`   #set($dynamicVar = "$var$num")`
`      ## $dynamicVar is now the string '$var1'. Check with:`
`      Var1: $var1`
`      DynamicVar: $dynamicVar`
`      Variable Class: $dynamicVar.class`
`   #evaluate($dynamicVar) ## evaluates the string as a variable!`
`   #macro(Greetings)`
`      Hello, Earthling!`
`   #end`
`   #set($macro = "#" + "Greetings")`
`   #evaluate($macro) ……… Hello, Earthling!`
### Logic Operators
And:   `&&`   
Or:   `||`
### Math Operations ( `+ - * / % > < ==` )
`   #set ($value = $foo + 1) ## Spacing around math operators is required. `
`   #set ($value = $foo / $bar) ## If $foo and $bar are integers, the result is an integer. `
`   ## If not integers, the result is a rational number. `
`   #set ($foo = $bar % 5) ## Modulus operator.`
### If Statements
`   #if ($foo) #end      ## True if $foo is defined. `
`   #if (!$foo) #end      ## True if $foo is not defined; False if defined. `
`   #if ($foo && $foo.value) #end      ## False as $foo.value cannot be evaluated. `
`   #if ($foo && $bar) #end      ## True if both $foo AND $bar are defined. `
`   #if ($foo || $bar) #end      ## True if either $foo OR $bar are defined.`
### String Manipulation
####    Change case
`#set($name = "SPONGE BOB")
#set($name = $name.toLowerCase())
$name ……… sponge bob
$name.toUpperCase() ……… SPONGE BOB
$name ……… sponge bob
`
####    Contains
`   #set($fruits = "Apple, Banana, Cherry")
#if( $fruits.contains( "ry")) Fruit found! #end ……… Fruit found!
`
####    Equals (Generally we use “==” instead.)
`   #set($countryCode = 'ja')
#set($Europe = ['ee', 'ja', 'ku', 'aa'])
#foreach ($eu in $Europe)
#if($eu.equals($countryCode)) (Alt: ($eu == $countryCode)
I found the country code "$countryCode" in $Europe!
#end
#end
`
####    Replace All
`   #set($phrase = “must eat cake”)
$phrase.replaceAll("\s|\/", "_")) ……… must_eat_cake
`
####    Starts with, Ends with
`   #set($images = ["a.png", "b.jpeg", "c.gif"])
#foreach($image in $images)
#if($image.endsWith(".png")) $image #end ……… a.png
#if($image.startsWith("c")) $image #end ……… c.gif
#end
`
####    Split
`   #set($path = "www/news/article.html")
#set($paths = $path.split("/"))
$paths.class ……… class [Ljava.lang.String;
#foreach($path in $paths) $path #end ……… www
news
article.html
`
####    Miscellaneous
`   #set($x = "")
#if($x.isEmpty()) EMPTY #end ……… EMPTY
`
####    Node from an XML file listing pages & folders:
`   <system-page id="d1e60d90ac1e000a7a9bed9f37008fb1" current="true">
$page.getName() ……… system-page
$page.getAttribute("current").value ……… true`
``
### Arrays
`   #set($array = ['abracadabra', 45, 'pig', 'Banana']) `
`   $array.size() ……… 4
`
####    Find a given item:
`   $array[0] or $array.get(0) ……… abracadabra `
`   $array[-3] ……… 45
`
####    Add a new item:
`   #set ($x = $array.add(23)) ## Unless wrapped in the set directive, this returns ”true”. `
`   $array ……… [abracadabra, 45, pig, Banana, 23]
`
####    Insert at a specific location:
`   $array.add(1, ‘test’) `
`   $array ……… [abracadabra, test, 45, pig, Banana, 23] `
####    Change at a specific location:
`    $array.set(1, 'bubble')
``$array ……… [abracadabra, bubble, 45, pig, Banana, 23]
`
####    Remove an item:
`   $array.remove() Strings can be removed by identifying the string (.remove(“string”));
## integers are removed by identifying the position in the array.
`
####    Add all items of one array to another:
`   #set($dummy = $array1.addAll($array2))
`
### Looping Statements
`   <ul>
#foreach ($item in $list) ## generate a set of list elements -->
<li>$item </li>
#end
</ul>`
####     Foreach methods:
`$foreach.index (starts at 0)
$foreach.count (starts at 1)
$foreach.hasNext (boolean)
#foreach($number in [0..5])
$number #if($foreach.hasNext).#end ……… 0, 1, 2, 3, 4, 5
#end #set ($range = [$start..$end]) ## Range endpoints can be set as integer variables.
```
### Hashmaps
`#set($hashmap = {}) #set($whats_for_breakfast = { `
`"eggs":"blah", `
`"english muffin":"carbs but love", `
`"cereal":"should have bought milk!" `
`    }) `
`  #foreach($key in $whats_for_breakfast.keySet()) `
` $key: $whats_for_breakfast.get($key) ……… ## The key, value pairs. `
`  #end`
####    Hashmap:
`   $whats_for_breakfast ……… {eggs=blah, english muffin=carbs but love, cereal=should have bought milk!}.`
####    Keyset:
`   $whats_for_breakfast.keySet() ……… [eggs, english muffin, cereal]`
####    Values:
`   $whats_for_breakfast.values() ……… [blah, carbs but love, should have bought milk!]`
####    Specific Value:
`   $whats_for_breakfast.get("cereal") ……… should have bought milk! `
`   $whats_for_breakfast.eggs ……… blah`
`   #set($var = "english muffin") `
`   $whats_for_breakfast[$var] ……… carbs but love
`
####    Booleans:
`   $whats_for_breakfast.containsKey("eggs") ……… true `
`   $whats_for_breakfast.containsValue("blah") ……… true
`
####    Add a Key:Value Pair
`   #set($item = "toast") `
`   #set($comment = "only with jam!") `
`   #set($dummy = $whats_for_breakfast.put($item, $comment))`
`   $whats_for_breakfast ……… {eggs=blah, english muffin=carbs but love, `
`   cereal=should have bought milk!, toast=only with jam!}
`
### Macros
`#macro( macroName $n1 $n2 $n3) `
`## macro code `
`#end`
####    To import a macro:
`#import(path to macro file)` 
####    To call a macro:
`#macroName($v1 $v2 $v3)`     
A macro can call other macros and/or itself.
## Basic Velocity Tools
### **Select List of Older Cascade-Specific, Velocity-Based, Tools**
| Velocity-Based Tool | Methods | Snippet |
| --- | --- | --- |
| XPath Tool (2 methods) | `$_XPathTool.selectSingleNode``$_XPathTool.selectNodes` | xp |
| Escape Tool (15 methods) | `$_EscapeTool.xml($string)``$_EscapeTool.html($string)``$_EscapeTool.javascript($string)` | esc |
|  Serializer Tool (2 methods) | `$_SerializerTool.serialize($collection, true)``$_SerializerTool.toJson($collection, true) ` |  ser |
| Date Tool (18 methods)   | `$_DateTool.getDate($date)``$_DateTool.format(“format”, $date)`1 |  date |
| Display Tool (11 methods)   | `$_DisplayTool.list( [“a”, “b”], “,” )``$_DisplayTool.plural( $a.size(), “set”, “sets” ) ` |  --- |
| Field Tool (1 method)   | `$_FieldTool.in() ` |  --- |
|  List Tool (4 methods)  | `$_ListTool.removeNull()``$_ListTool.reverse()``$_ListTool.toList() ` | lis  |
| Math Tool (19 methods)   | `$_MathTool.mod()``$_MathTool.toInteger()``$_MathTool.toNumber() ` | mat  |
| Number Tool (7 methods)  | ` $_NumberTool.currency()``$_NumberTool.percent()` | ---  |
| Regex Tool (1 method) | `$_RegexTool.compile()` | reg |
| Sort Tool (2 methods)2 | `$_SortTool.sort($collection)``$_SortToo.addSortCriterion(“selector”,``“language”, “text | number | QName”, “ascending``| descending”, “lowerfirst | upperfirst”)` | sor |
| String Tool (4 methods) | `$_StringTool.generateUUID()``$_StringTool.substringAfter()``$_StringTool.substringBefore()` | str |
*   1 Friendly date formats (such as MM/DD/YYYY) are available here.*
*   2 Invoking the .sort method alone automatically includes .addSortCriterion. Criteria not needed can be left as empty quotation marks*

---

### Working with namespaces in Velocity

Consider the sample snippet below:
```
<info xmlns:d="https://www.hannonhill.com"> <d:Title>Hannon Hill - Cascade CMS</d:Title></info>
```
In order to access the `<d:Title>` element here using a Velocity Format, the following methods can be used:
## Method 1:
```
#set ($dNs = $contentRoot.addNamespace("d", "https://www.hannonhill.com"))#set ($title = $contentRoot.getChild("Title", $dNs).value)<h2>$title</h2>
```
This approach uses an `addNamespace` method available to `$contentRoot` which allows you to save a reference to a namespace object. From there, that namespace object is passed as a second parameter to the `getChild` method when accessing the corresponding elements using that namespace.
## Method 2:
```
#set ($title = $_XPathTool.selectSingleNode($contentRoot, "d:Title").value)<h2>$title</h2>
```
This approach uses the XPathTool to select the node and output its value.
## Method 3:
```
#set ($title = $_XPathTool.selectSingleNode($contentRoot, "//node()[local-name() = 'Title']").value)<h2>$title</h2>
```
This approach is similar to Method 2 above, but can be especially useful for XML documents or RSS Feeds that contain hidden namespaces. Using XPath's `local-name()` function essentially ignores any namespaces and treats elements as if they are in the default namespace.

---

### XHTML/Data Definition Blocks

## Overview
An XHTML/Data Definition block is a reusable block of content that provides a rich word processing (WYSIWYG) interface or Data Definition form fields for editing content. Unlike a text block, an XHTML block allows for a wide range of HTML elements to be created inside of its editing environment extending to items such as images, links, tables, and bullet points in addition to other standard text formatting.
XHTML/Data Definition blocks are particularly useful for fixed regions of content such as headers and footers that need to stay constant among all pages within the site. A single change to one of these blocks will be present across all pages of the site that make use of the block.
## Creating an XHTML/Data Definition Block
To create an XHTML/Data Definition block:
1. Click **Add Content** > **Default** > **Block**.
2. Select **XHTML/Data Definition** and click **Choose**.
3. In the **Name** field, enter a name for your block.
4. In the **Placement Folder** field, choose the folder where the block should be created.
5. Enter content into the WYSIWYG field, or add a Data Definition if desired.
6. Click **Preview Draft** and **Submit**.
## Adding a Data Definition
Data Definitions can be added to XHTML blocks to provide a standardized structure to content added to a Cascade CMS page. For example, a contact section with a phone number field, address field, and an email address field could be built as part of a Data Definition and those fields could be reused across pages as a block.
To add a Data Definition to an XHTML/Data Definition block:
1. Select the **Properties** tab.
2. With the **Data Definition** chooser, select a Data Definition and click **Choose**.
3. Select the **Content** tab to resume editing within the Data Definition structure.
4. Click **Preview Draft** and **Submit**.
**Note** - If content has been entered in the WYSIWYG prior to applying a Data Definition to the block, that content will be transferred to the first available WYSIWYG field defined in the Data Definition. If the Data Definition does not have any WYSIWYG fields, the content will not be transferred.

---

## Configuration

*14 articles in this category*

### Configurations

Configurations are collections of one or more outputs that are used to display page content.

---

### Content Types

Content Types combine the look and feel of a page (Configurations) with the editable content fields of a page (Metadata Sets and Data Definitions) so that non-technical users can easily create and edit pages.

---

### Linking to Specific Outputs

## Overview
Once you've created outputs for your content, you'll need a way to allow site visitors to browse to them (to subscribe to an RSS feed, access the printer-friendly version of a page, etc.). To do this, Cascade CMS has special `system-page-output` attributes that can be added to links to create links to specific outputs. On publish, the system will automatically remove this attribute and insert the correct `href` attribute in its place.
```
<p> <a system-page-output=“pdf”>PDF</a><br/><a system-page-output="printer">Printer Friendly</a><br/><a system-page-output="xml">XML</a><br/></p>
```

---

### Logging Configuration

## Overview
This section of the Administration area provides system administrators with the ability to configure additional logging for troubleshooting purposes.
**Note** - In general, you should not change the default logging configuration unless troubleshooting a problem with the help of the Hannon Hill support team. Increasing logging may impact the performance of the system and should only be done for a limited time.
## Configuring Additional Logging
To configure additional logging for various areas of the system:
1. Click the system menu button (  ) > **Administration** > **Logging Configuration.**
2. Under the **Add Log Category or Package **section, click the first dropdown menu to display a list of available categories for logging. Alternatively, specific class names (provided to you by Hannon Hill) may be entered into this field.
3. After selecting a category/package, use the dropdown menu below that field to select the type of logging to enable for the selected category (`Fatal`, `Error`, `Warn`, `Info`, `Debug`).
4. Click **Add Category**.
5. Repeat steps 2-4 above to add logging for additional categories or classes if needed.
## Reset Logging
To reset all logging back to the default configuration:
1. Click the system menu button (  ) > **Administration** > **Logging Configuration**.
2. Click **Reset to Default**.
3. Click **OK** on the confirmation screen that appears.
## Performance Logging
Whenever DEBUG level logging is enabled for a particular class, performance information for that class will also be logged. Performance logging statements are written to a separate file named `cascade-performance.log`. This log contains information about how long it took to execute specific parts of the class being logged.
It is also possible to enable performance logging for all classes in the system by selecting the `Performance` category and enabling the DEBUG logging level for it.
**Warning** - enabling Performance Logging should only be done at the request of the Hannon Hill support team.
## Slow Execution Logging
Whenever DEBUG level logging is enabled for a particular class, information about operations that take an excessive amount of time will also be logged to a separate slow execution log. This log file is named `cascade-slow-execution.log`.
In addition to the information included in the Performance log, the Slow Execution log also includes a full stack trace for slow operations.
It is also possible to enable Slow Execution log for all classes in the system by selecting the `Slow Execution` category and enabling the DEBUG logging level for it.

---

### Metadata Fields in Cascade

## Built-in Metadata Fields
Metadata fields are the default fields that are included with Cascade. They include:
- **Display Name** - Commonly the short name of the asset title. Similar to a breadcrumb link or site map reference.
- **Title** - The title of the asset.
- **Summary** - The synopsis of the asset.
- **Teaser** - A short enticing phrase about the asset.
- **Keywords** - Words or phrases about the asset.
- **Description** - The description of the asset.
- **Author** - The person or organization responsible for the asset.
- **Review Date** - An optional date/time chooser; this field specifies when the asset's content should be reviewed.
- **Start Date** - An optional date/time chooser; this field specifies the date and time the asset should "go live".Until the Start Date the asset will not be eligible for indexing or publishing.
- If the asset is enabled for publishing, it will be published at the Start Date to all Destinations that are both enabled and configured to be checked by default.
**End Date** - An optional date/time chooser; this field specifies the date and time the content should no longer be public.
- At the End Date, the asset is moved to an Expiration Folder, if specified, and **Include when publishing** and **Include when indexing** options are turned off for publishable assets.
- If system email is configured, expiration warning notices will be sent to the user that last modified the asset.
- If that user no longer exists, the expiration notice will be sent to the user that created the asset.
- If neither user can be found, no expiration notice is sent.
- You can specify how many days prior to an asset's expiration a first and second warning email should be sent in your System Preferences.
**Expiration Folder** - An optional folder chooser; this field specifies which folder the content should be moved to upon reaching the End Date.
- Assets which have an Expiration Folder can be automatically unpublished from all applicable Destinations if the site has the **Unpublish assets when they are moved to an expiration folder** option enabled in its Site Settings.
Display Name, Title, Summary, Teaser, Keywords, Description, and Author are all free-form text fields.
## Custom (or Dynamic) Metadata
Custom (or dynamic) metadata fields can include:
- Custom **Text** fields.
- Custom **Date-time** fields.
- Custom **Dropdown** boxes with an optional preset default value.
- Custom **Radio** button options with an optional preset default value.
- Custom **Checkbox** options with an optional preset default value.
- Custom **Multiselect** options with optional preset default values.
Custom Metadata fields are especially effective in allowing users to set categories for content (news, course catalogs, and departments, for example). They are also useful in creating filters for the use and display of content (e.g. creating a toggle for displaying or hiding content on a navigation menu).

---

### Metadata Sets

Metadata is data within the CMS that describes an asset. A Metadata Set represents a curated collection of metadata fields used to describe content.

---

### Modifying the Database Configuration

## Overview
1. Edit the *tomcat/conf/context.xml* file.
2. Locate the Configuration template for the database vendor to which Cascade CMS will be connecting.
3. In the `<Resource>` element, update the following attributes: - `username` - the username needed to connect to the database - `password` - the password needed to connect to the database - `url` - the host, port, and database name (following one of the formats below depending on your database vendor)
## MySQL
`url="jdbc:mysql://mysql:3306/cascade?useUnicode=true&amp;characterEncoding=UTF-8"`
The connection URL above will attempt to connect to a database named `cascade` running at hostname `mysql` over port `3306`.
## SQL Server
Cascade CMS version 8.17 and earlier:
`url="jdbc:jtds:sqlserver://sqlserver:1433/cascade;SelectMethod=cursor"`
Cascade CMS version 8.17.1 and later:
`url="jdbc:sqlserver://sqlserver:1433;databaseName=cascade;SelectMethod=cursor"`
**Note: **The default connection string seen directly above is intended to work for databases using **SQL Server authentication**. If you are using **Windows authentication**, you will need to add the following parameters to the connection string (at a minimum):
`url="jdbc:sqlserver://sqlserver:1433;databaseName=cascade;SelectMethod=cursor;**integratedSecurity=true;authenticationScheme=NTLM**"
`
For more information, see this article on [Building the connection url * *](https://docs.microsoft.com/en-us/sql/connect/jdbc/building-the-connection-url?view=sql-server-ver15) from Microsoft's documentation.
The connection URLs above will attempt to connect to a database named `cascade` running on a server with hostname `sqlserver` on port `1433`.
## Oracle
`url="jdbc:oracle:thin:@huxley:1521:orcl"`
The connection URL above will attempt to connect to an Oracle SID `orcl` on a server with hostname `huxley` running on port `1521` using the thin driver. With Oracle, the database schema is specified using the `cascadeSchemaName` resource.
Ensure that the following line in ``*tomcat/conf/context.xml* is uncommented:
`<ResourceLink name='schemaName' type='java.lang.String' global='cascadeSchemaName'/>`
and then un-comment and update the `cascadeSchemaName` environment variable to have the value for your database's schema in the *tomcat/conf/server.xml*`` file:
`<Environment name="cascadeSchemaName" type="java.lang.String" value="my_cascade_db"/>`
**Important**: With Oracle, it is required that the connecting username matches the name of the database schema.

---

### Output content as JSON

With a combination of Template, Format, and Output, you can publish your page content as a JSON file.
## Template
Create a Template using skip tags and a "dummy" surrounding element:
```
<!--#cascade-skip--><pass-through><system-region name="DEFAULT"/></pass-through>
```
## Format
Generate valid JSON content and surround that content with a `#protect-top` code section. In Velocity, the SerializerTool.toJson method can be used to convert an XML string or JDOM Element to JSON.
Velocity example:
```
#set ($callingPage = $_XPathTool.selectSingleNode($contentRoot, "//calling-page/system-page"))<!--#protect-top$_SerializerTool.toJson($callingPage, true)#protect-top-->
```
XSLT example:
```
<xsl:comment>#protect-top...JSON content here...#protect-top</xsl:comment>
```
## Output
Create a new Output in your page Configuration with the following settings:
- Type of Data: JSON
- File Extension: .json
- Template: choose the Template you created earlier.
- Regions: apply the Format you created earlier and a calling page Index Block to the `DEFAULT` region.

---

### Setting up a test environment

## Prepare the test server
1. Install the latest version of Cascade CMS.
2. Stop Cascade CMS (if it's running).
3. Create a backup of your production database and import it as a new database. - Note: Organizations using MySQL should verify that the collation of the new database is configured properly according to these instructions.
4. Configure the test environment to point to the test database.
## Disable publishing to Destinations
Run the following query on your test database to prevent assets from the test environment from being published to your production web server(s):
```
UPDATE cxml_destination SET isEnabled=0;
```
If you're testing the application using your production database and testing publishing, we recommend setting up a test Destination that points to a test/staging server.
## Disable SMTP server emails
Run the following query on your test database to prevent emails that use the SMTP configuration (such as LDAP sync emails) from being generated by the test server:
```
DELETE FROM cxml_preferences WHERE fieldName LIKE '%smtp%';
```
## Disable connectors
Run the following query on your test database to disable connections to connectors such as Google Analytics:
```
UPDATE cxml_connector SET isVerified =0;
```
You can selectively re-enable connectors under **Manage Site > Connectors** in each site.
## Disable the Siteimprove integration
Run the following query on your test database to prevent the Siteimprove integration from running checks on pages in the test environment:
```
UPDATE cxml_preferences SET fieldValue = 'off' WHERE fieldName = 'system_pref_siteimprove_enabled';UPDATE cxml_preferences SET fieldValue = null WHERE fieldName = 'system_pref_siteimprove_token';
```
## Wrapping up
1. Start Cascade CMS.
2. Enter a valid license for your test server. - Note: Because the database was copied from production, the license for the production machine is stored in this database. - If this is your first time setting up a test environment and you need a license, contact Hannon Hill Product Support and be sure to provide us with the internal hostname of the test server (which can be retrieved by entering the command `hostname` at the command prompt/terminal).
3. Navigate to **Administration > Preferences > System > General** - Change the **System URL** to reflect the URL of your test environment. - Change the **System Name** to indicate that the instance is a Test or Development instance. - (Optional) Select a **System Label Color** for to visually distinguish your test environment from your production environment.

---

### Setting up the database (MySQL)

## Step 1: Download and install MySQL
If you have an existing MySQL instance that you wish to use, skip ahead to Step 2.
Download and install a supported version of [MySQL](http://dev.mysql.com/downloads/). To verify that MySQL is running, type `mysql -u root` at a command line. You should see something like this:
```
Welcome to the MySQL monitor. Commands end with ; or \g.Your MySQL connection id is 5Server version: 8.0.30 MySQL Community Server - GPL
```
If the command is not recognized, either navigate to the MySQL bin directory and try again or add the MySQL bin directory to your [$PATH](https://en.wikipedia.org/wiki/PATH_(variable))).
## Step 2: Edit your MySQL configuration file
**IMPORTANT:** Make sure that your database is configured to use the [InnoDB](https://dev.mysql.com/doc/refman/8.0/en/innodb-storage-engine.html) storage engine.
Edit the `my.ini` (Windows) or `my.cnf` (Linux/*nix) file located in your MySQL environment and change or add the following variables under the `[mysqld]` section:
```
max_allowed_packet=16Mkey_buffer_size=16M
```
**Note:** these are the minimum required settings. If they are already set to something higher, you can keep the original values.
For additional information regarding these configuration files, please reference [MySQL's documentation](https://dev.mysql.com/doc/refman/8.0/en/option-files.html).
After these changes have been made, **you must restart MySQL** in order for them to take effect.
## Step 3: Import the Cascade CMS database
From a command line, open a MySQL prompt and execute the following commands (replacing 'cascade' with the database name of your choice):
```
CREATE DATABASE `cascade`;ALTER DATABASE `cascade` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci; exit
```
Exit the MySQL prompt.
Download and unzip the default [Cascade CMS database](http://github.com/hannonhill/Cascade-Server-Default-Database/raw/master/cascade_database_mysql.zip).
Import the database by executing a command like the following:
```
mysql -u root -p --default-character-set=utf8mb3 cascade < \path\to\file\cascade.sql
```
where 'cascade' is the name of your new database and '``\path\to\file\cascade.sql' is the full directory path to the Cascade CMS database file.
Your MySQL database is now configured and ready to be used by Cascade CMS.
**Note**: Support for default Cascade CMS databases has ended. To upgrade to **Cascade CMS 2026.1** or newer, an intermediate step is required. You must first start **Cascade 2025.2.2** against the imported database and ensure the login screen loads without errors. Only after this verification should you proceed with the upgrade to version 2026.1 or later.

---

### Setting up the database (Oracle)

## Step 1: Download the Cascade CMS database
Download the [ Cascade CMS database](http://github.com/hannonhill/Cascade-Server-Default-Database/raw/master/cascade_database_oracle.zip).
We strongly recommend using an existing database with a UTF-8 enabled character set. This is necessary to take advantage of Cascade CMS's multi-lingual support.
Also, we recommend creating a separate tablespace for the Cascade CMS database. See below for more information on creating the tablespace.
## Step 2: Create a new Tablespace
Using Oracle Enterprise Manager:
- Go to **Administration -> Tablespaces**, then click **Create**.
- For the **Name** field, enter `CASCADE_DEFAULT` 
- Under **Datafiles**, click **Add** (As an alternative, one can avoid adding a datafile by checking the **Use bigfile tablespace** check box. However, creating a separate file is highly recommended)
- At the **Add** Datafile screen, type `CASCADE_DEFAULT.DBF`  in the **File Name** field
- Point the **File Directory** field to the desired location
- For the **File Size** field, type `30 MB` 
- Under **Storage**, check the option to "*Automatically extend datafile when full (AUTOEXTEND)"*
- For the **Increment** field, type `2 MB` . Click **Continue**
- Click **OK** to create the tablespace. The generated SQL should look like this:
```
CREATE SMALLFILE TABLESPACE "CASCADE_DEFAULT" DATAFILE'/u01/app/oracle/oracle/product/12.1.0.2/db_1/oradata/orcl/CASCADE_DEFAULT.DBF'SIZE 30M AUTOEXTEND ON NEXT 2M MAXSIZE UNLIMITEDLOGGING EXTENT MANAGEMENT LOCAL SEGMENT SPACEMANAGEMENT AUTO
```
## Step 3: Import the Cascade CMS database
Using Oracle Enterprise Manager:
- Click **Maintenance -> Import from Export Files**
- For the **Directory Object** field, select the directory where the Cascade CMS import script resides. For the **File Name** field, type `CASCADE_DEFAULT.DMP`
- Under **Import Type** select **Entire Files**
- Under **Host Credentials** fill in the OS Username and Password for the Oracle account, then click **Continue**
- On the next screen (Import: Re-Mapping) - unless a tablespace and/or user other than CASCADE_DEFAULT has been created, simply click **Next**
- Under **Import: Options** it is recommended to create a log file of the import. Select a **Directory Object** and under **Log File** type the name of the file (e.g. CASCADE_DEFAULT.LOG) and click **Next**
- For the **Job Name** field, type the desired name (e.g. cascade_import - note that the name has to be unique). Type an optional description in the **Description** field and click **Next**
- Under **Import: Review**, review the import information and verify that everything is correct. Click **Submit Job**
Your Oracle database is now configured and ready to be used by Cascade CMS.
**Note**: Support for default Cascade CMS databases has ended. To upgrade to **Cascade CMS 2026.1** or newer, an intermediate step is required. You must first start **Cascade 2025.2.2** against the imported database and ensure the login screen loads without errors. Only after this verification should you proceed with the upgrade to version 2026.1 or later.

---

### Setting up the database (SQL Server)

## Step 1: Download Cascade CMS database
- Download the [ Cascade CMS database](http://github.com/hannonhill/Cascade-Server-Default-Database/raw/master/cascade_database_sqlserver.zip).
- Unzip the database and place the `cascade.mdf` and `cascade_log.ldf` files in your SQL Server data folder (e.g. `C:\Program Files\Microsoft SQL Server\MSSQL\DATA` )
## Step 2: Attach the Cascade CMS database to SQL Server
- Open SQL Server Management Studio. In SQL Server Management Studio Object Explorer, connect to an instance of the Microsoft SQL Server Database Engine and then expand that instance.
- Right-click **Databases**, and select **Attach**. The **Attach Databases** dialog box appears.
- To specify the database to be attached, click **Add**. In the **Locate Database Files** dialog box, navigate to the SQL Server data folder into which you just dropped the database files, select `cascade.mdf`, and click **OK**.
- (Optional) To specify a different name for the database to attach as, enter the name in the **Attach as** column of the **Attach database** dialog box.
- (Optional)To change the owner of the database, select a different entry in the **Owner** column.
- Click **OK** to complete the database attachment.
## Step 3: Set the Database Isolation Level to snapshot
Setting the isolation level to 'snapshot' increases performance with Cascade CMS.
Execute the following queries while Cascade CMS is not running and no other connections to the database are open:
```
ALTER DATABASE [databaseName] SET ALLOW_SNAPSHOT_ISOLATION ON  
```
```
ALTER DATABASE [databaseName] SET READ_COMMITTED_SNAPSHOT ON
```
where `[databaseName]`  is the name of your Cascade CMS database.
Your SQL Server database is now configured and ready to be used by Cascade CMS.
**Note**: Support for default Cascade CMS databases has ended. To upgrade to **Cascade CMS 2026.1** or newer, an intermediate step is required. You must first start **Cascade 2025.2.2** against the imported database and ensure the login screen loads without errors. Only after this verification should you proceed with the upgrade to version 2026.1 or later.

---

### SSL/TLS Configuration

## Overview
Configuring SSL/TLS for the application requires two steps (as described in the [official Tomcat documentation](https://tomcat.apache.org/tomcat-9.0-doc/ssl-howto.html)):
1. Creating/preparing the Java keystore.
2. Configuring the *server.xml* file to point to the keystore.
See this article and the official Tomcat documentation for more details.
## Preparing the keystore (self-signed certificate)
**Note**: The following command will create a new keystore containing the server's private key and a self-signed certificate which is not recommended for production use (test/development only). To import an existing server certificate from a Certificate Authority (CA) instead, skip to the next section.
Create a keystore by executing the following command:
```
$JAVA_HOME/bin/keytool -genkey -alias tomcat -keyalg RSA
```
Once created, the ``*.keystore* file can typically be found in the home directory of the user who created it, ex. */home/user* in Linux/*nix or ``*C:\Documents and Settings\Administrator* in Windows.
## Preparing the keystore (with an existing certificate))
**Import the certificate and private key
**
1. Enter the following command from the terminal: ``` openssl pkcs12 -export -in <path/to/cert>.crt -inkey <path/to/key>.key -out <keystore-name> -name <alias> ``` where:` <path/to/cert>` is the full path to the location of your certificate.` <path/to/key>` is the full path to the location of your private key` <alias>` is the name you wish to use to identify this keystore entry` <keystore-name>` is the name you wish to use for your new keystore
2. When prompted, enter the passphrase for your key (if you have one)
3. When prompted, provide a password to use for the keystore
**Import the root certificates**
**Note**: this step may or may not be necessary for your certificate
1. Change into the `jre/bin` directory of your Java installation
2. Enter the following command: ``` keytool -import -alias root -keystore <your_keystore_filename> -trustcacerts -file <filename_of_the_chain_certificate> ``` where: `<your_keystore_filename>` is the full path to the location of your keystore `<filename_of_the_chain_certificate>` is the full path to your chain certificate
3. When prompted, enter the password for your keystore in order to import the chain certificate
## Configuring SSL/TLS in the Connector
1. Edit the *tomcat/conf/server.xml *file.
2. Uncomment the area for SSL/TLS Connector configuration: ``` <!-- Define a SSL HTTP/1.1 Connector on port 8443 This connector uses the JSSE configuration, when using APR, the connector should be using the OpenSSL style configuration described in the APR documentation --> <Connector port="8443" protocol="HTTP/1.1" SSLEnabled="true" maxThreads="150" scheme="https" secure="true" clientAuth="false" sslProtocol="TLS" /></pre>Add the keystoreFile, keystorePass, and keystoreAlias (optional) attributes to the <Connector> element:<!-- Define a SSL HTTP/1.1 Connector on port 8443 This connector uses the JSSE configuration, when using APR, the connector should be using the OpenSSL style configuration described in the APR documentation --> ``` ``` <Connector port="8443" protocol="org.apache.coyote.http11.Http11NioProtocol"      maxThreads="150" SSLEnabled="true" scheme="https" secure="true"      clientAuth="false" sslProtocol="TLS"      keystoreFile="<path/to/keystore>" keystorePass="<keystore_pass_from_above>"       keystoreAlias="<alias>" keystoreType="PKCS12" /> ``` where: `<alias>` is the name you chose to use to identify your keystore entry above `<path/to/keystore>` is the full path to the location of the keystore you created above `<keystore_pass_from_above>` is the keystore password you had set above**Note**: To prevent issues, we recommend that you avoid using any of the following characters in your keystore password: `& < > " '`
3. Start Cascade CMS.
The application should now be accessible at `https://{host}:8443`. See this article for instructions on forcing connections to use SSL.

## Related Links
- Forcing connections to use SSL/TLS

---

### Testing for an empty WYSIWYG field

Testing to see if a WYSIWYG field can be tricky since the field could either contain plain text or HTML elements.
One solution is to test if the value of an XML Element is not empty, or if the Element contains children (ie the HTML elements).
## Using Velocity
### With the Cascade API
```
## Record the WYSIWYG field#set ($wysiwygField = $callingPage.getStructuredDataNode("wysiwyg-field")) 				## Test to see if the field's value is not empty#if (!$_PropertyTool.isEmpty($wysiwygField.textValue)) $wysiwygField.textValue#end
```
### With an Index Block
```
## Record the WYSIWYG field#set ($wysiwygField = $_XPathTool.selectSingleNode($contentRoot, "//wysiwyg-field")) ## Test to see if the Element's value is not empty, or if the Element has children#if ($wysiwygField.value != "" || $wysiwygField.getChildren().size() > 0) $_SerializerTool.serialize($wysiwygField, true)#end
```
## Using XSLT
```
<xsl:if test="wysiwygField/node()"> <!-- use xsl:copy-of here to make sure that all child nodes and attributes are copied as well --> <xsl:copy-of select="wysiwygField/node()"/></xsl:if>
```

---

## Publishing

*31 articles in this category*

### Asset is not set to publish. Please enable publishing for this asset and try again.

This error message indicates that the asset you're attempting to publish is not enabled for publishing. To enable the asset for publishing:
1. Edit the asset.
2. Select the **Configure** tab.
3. Enable the **Include when publishing** option.
4. **Submit** your changes.

## Related Links
- The folder hierarchy does not allow this asset to be published

---

### Configure a web server for publishing

While there are a few different options for publishing content to a web server (as described in Transports), the most common method is to utilize FTP, FTPS, or SFTP. In order to publish from Cascade CMS to a server using one of these protocols, we recommend following the general steps below (we'll use SFTP as an example, but the steps are similar for FTP and FTPS as well):
- Install an SFTP server on the web server
- Create an SFTP account for Cascade CMS to use in order to connect and send files
- Configure the SFTP account's home directory to something appropriate (in most cases, this will be your web root)
- Ensure that the SFTP account has full permissions to the account's home directory and all of its subfolders (this is necessary so that the CMS can create, update, and remove files from the website)
- Configure the firewall to allow traffic from the Cascade CMS server over port 22 
**Note**: Port 22 is the default for SFTP, but if you are listening on a non-standard port, you'd want to make sure that you allow traffic over that port for Cascade CMS to connect. If using FTP or FTPS, you would typically need to make exceptions for port 21 or 990 respectively.
Once the SFTP server has been configured as described above, you'll want to verify that you can connect to it from the application server (where Cascade CMS is installed).
We recommend using a 3rd party SFTP client (like WinSCP or Filezilla, for example) for this purpose as it will also allow for you to verify that connecting with the account places you in the expected directory on the web server's filesystem (the home directory of the SFTP account).
After verifying that you can successfully connect using a 3rd party client:
- Log into Cascade CMS and switch into the Site you wish to publish
- Create a new Transport using the SFTP account credentials that were verified above
- Create a new Destination and when configuring it, select the Transport that was created in the step prior to this
The combination of the Transport and Destination are what determine how and where the CMS will publish. More information on that can be found in Determining Where Assets Will Be Published.
**Tip**: You can run general connectivity tests for both Transports and Destinations by clicking **More -> Test Connectivity **while viewing them. When testing Destinations, you can optionally choose to send 'dummy' files of 100kb or 1000kb in size. These tests can help to quickly determine if there is some sort of problem when the system attempts to connect using the information provided in the Transport/Destination (related to authentication or firewalls, for example). 
## Related Links
- Transports
- Destinations
- How do I determine where assets will be published?

---

### Destinations

## Overview
Destinations define the link between site content and the location to which site content can be published. Destinations allow for publishing content on a schedule, and specifies encoding (UTF-8 or ASCII) for the published content. A Destination is associated with a single transport that defines the protocol and location of a remote server to use when publishing content out of the system. In other words, whereas a destination defines the link between a site and transport, a transport represents the physical location of a server which can be used for any number of sites.
## Creating a Destination
To create a Destination:
1. Navigate to **Manage Site** > **Destination****s **and click **Add**.
2. From here you can either create a Container to group related Destinations or a Destination.
3. Configure the following fields in the **General** tab:**Name** - How the system identifies the Destination.
4. **Parent Container **- The main storage folder for the Destination.****
5. **Enable destination** - Allows users to temporarily deactivate certain Destinations. For example, downtime or a content freeze could merit temporarily disabling a Destination.
6. **Directory** - Generally, this value is inherited from the Transport. - If the directory field is empty, the Transport directory will be used to determine where content is published. - If the directory contains an absolute path, the Transport directory will not be used. The Destination directory will be used as the exact path where content is published. - If the directory contains a folder name, then the folder supplied in that field is appended to the end of the Transport directory where content will then be published. For example, if the Transport Directory points to the "test/main" folder on the server and "new/destination" is filled into the Destination Directory field, content will be published to the "test/main/new/destination" folder.
7. **Transport** - Selects the Transport upon which the Destination will be based.
8. **Applicable Groups** - Determines which groups may publish to the Destination. Unless a group is defined here, this Destination will not show up on an asset's list of available Destinations on the publish screen for that group.
9. **Web URL** - A base URL used for linking to specific Configuration Outputs. For more information see "Link Rewriting Using Destination URLs".
10. **Extensions to Strip** - A comma-separated list of extensions (such as .html, .php). Links pointing to assets published to this Destination will have these extensions stripped. - To strip extensions from cross-site links pointing to assets in the current site, add the same extensions to the **Extensions to Strip** field in Site Settings. - The web server will need to be configured to map the extensionless links to the appropriate files (for example, with an .htaccess file).
11. **Publish to this Destination by default** - If this Destination is optional and should not be used every time an asset is published, the checkbox should be unchecked. This way users would need to manually select that Destination when sending an asset to the publish queue.
12. **Publish ASCII characters instead of Unicode** - Cascade CMS publishes content in Unicode by default; this may be overridden by selecting the ASCII checkbox.
In the** Scheduled Publishing** tab,** **content can be set to publish automatically on a schedule.Click **Submit** to save the new Destination.
## Testing Destination Connectivity
The Destination test utility allows users to test Destination connectivity without invoking a publish. To run a Destination test:
1. Navigate to **Manage Site** > **Destinations**.
2. Select the Destination you wish to test.
3. Click **More** > **Test Connectivity**.
4. Optionally: Select the number of files and size of files to test.
5. Click **Start Test**. If there are no errors, the screen will indicate "Test Successful". If errors are found, the screen will identify the problem that occurred.

---

### Enabling HTTP Strict Transport Security (HSTS)

## Overview
To enable HTTP Strict Transport Security (HSTS):
1. Stop Cascade CMS.
2. Edit the file `tomcat/conf/web.xml`.
3. Add the following just before the closing `</web-app>` tag: ``` <filter> <filter-name>httpHeaderSecurity</filter-name> <filter-class>org.apache.catalina.filters.HttpHeaderSecurityFilter</filter-class> <async-supported>true</async-supported> <init-param> <param-name>hstsEnabled</param-name> <param-value>true</param-value> </init-param> <init-param> <param-name>hstsMaxAgeSeconds</param-name> <param-value>31536000</param-value> </init-param> <init-param> <param-name>hstsIncludeSubDomains</param-name> <param-value>true</param-value> </init-param> <init-param> <param-name>antiClickJackingOption</param-name> <param-value>SAMEORIGIN</param-value> </init-param> </filter> <filter-mapping> <filter-name>httpHeaderSecurity</filter-name> <url-pattern>/*</url-pattern> <dispatcher>REQUEST</dispatcher> </filter-mapping> ```
4. Save the file
5. Start Cascade CMS
See the official [Apache Tomcat documentation](https://tomcat.apache.org/tomcat-9.0-doc/config/filter.html#HTTP_Header_Security_Filter) for additional information. 
**Tip**: Be sure to document any changes you make to the `web.xml` file so that you can put them back in place after any future upgrades to the application.

---

### Error occurred during FTP transport: Accept timed out

Users may see the following error message when attempting to publish to a FTP server:
```
Error occurred during FTP transport: Accept timed out
```
This error is typically caused by the connection attempting to use Active mode as opposed to Passive mode when connecting to the target web server. To force Passive mode, edit the corresponding FTP Transport in question and check the option **Use Passive FTP (PASV)**. 

## Related Links
- Transports

---

### How can I generate a cron expression for my scheduled publishes?

When working with scheduled publishes in the CMS, one option for scheduling is to provide a cron expression.
Since Cascade CMS uses Quartz for scheduling, the syntax for cron expressions may be slightly different from other applications where you've set up cron tasks. In order to generate compatible cron expressions, we recommend using one of the sites listed below:
[FreeFormatter](https://www.freeformatter.com/cron-expression-generator-quartz.html)
[CronMaker](http://www.cronmaker.com/)
**Sample expressions:**
| Publish time | Cron expression |
| --- | --- |
| Every 2 hours | `0 0/10 * 1/1 * ? *` |
| Weekly on Tuesdays at 10am | `0 0 10 ? * TUE *` |
| Once on Feb. 1, 2024 | `0 0 0 1 FEB ? 2024` |
``

---

### How can I tell who edited or published a page?

Audit trails provide a list of activities by users in Cascade CMS which can be handy when tracking down a particular event.
## Viewing an asset's audit trail
While viewing an asset (such as a page or file) click **More > Audits**. You can filter the audit trail by timeframe or type of action.
If you need to restore a previous version of an asset, click **More > Versions** to view available versions.
## What if I don't know where the asset is?
If an asset has been moved, renamed, or deleted, it may not be available for you to audit. If you can't locate the asset:
1. First, check the site's **Trash** in case the asset was recycled.
2. Note which groups have permission to edit assets in the missing asset's site or parent folder.
3. Go to **Administration > Groups** and click one of those groups.
4. While viewing the group, click **More > Audits**. - A group's audit trail provides a chronological list of activities by all members of that group. - You can filter the audit trail for **Recycle** or **Move/Rename** actions.

## Related Links
- Audits

---

### How do I determine where assets will be published?

Cascade CMS determines where to place files using a combination of the following values:
- The Transport **Server Directory** (if blank, the FTP/FTPS/SFTP user’s home directory).
- The Destination **Directory***.*
- The folder path of your asset in your Site.
For example, consider the following setup:
- DestinationA has a **Directory** value of `www.example.com` and is using TransportA.
- TransportA has a **Server Directory** value of `/var/web`.
- A file in the same Site as DestinationA is located in `/about/our-team.png`.
By combining the Transport’s Server Directory ( `/var/web`) with the Destination’s Directory ( `www.example.com`), we end up with the path `/var/web/www.example.com` as the Site’s root directory. Then, we append the location of the file itself as it resides in the Site. The final publish path of this sample file will be `/var/web/www.example.com/about/our-team.png`.
Using this logic, you can figure out the location on the web server file system to which your file(s) should be publishing.
**Warning** - Changing Transport and/or Destination directories can have serious consequences for your live web sites. **DO NOT **make any changes to these areas of the system without consulting with your CMS and web server administrators.

---

### How do I publish changes to a block?

Blocks, such as XHTML/Data Definition blocks, aren't publishable by themselves. If you've made changes to a block, such as a navigation block, and you're not seeing your changes on your live site, you'll need to publish any pages that use that block.
For blocks used on all or most every page in a site, this may require a full site publish.
##### Relationships
To find out which pages use the block, you can look at its relationships by clicking **More > Relationships**.
If the block is assigned to a Template or Configuration, you'll need to click through to view their relationships until you find the Content Types that use the block. Relationships of Content Types are pages, so they're publishable.
The block may also have manual relationships to pages or folders assigned that you can publish directly from its **Relationships** screen.

## Related Links
- Publishing Related Content

---

### Invalid privatekey error when publishing via SFTP

When using SSH Key authentication for SFTP Transports, you may see the following errors when testing the Transport or when publishing to a Destination using the Transport:
```
SFTP error occurred during SFTP Shuttle initialization: invalid privatekey: [x@xxxxxxx
```
To resolve the issue, upload your SSH key in PEM format. For example, a command like the following should produce a valid key pair in this format:
```
ssh-keygen -t rsa -m PEM
```
For more information on the `ssh-keygen` command, see [this page](https://www.ssh.com/academy/ssh/keygen).`
```

## Related Links
- Transports

---

### No Destinations or WordPress Connectors available

When attempting to publish a page, the following message may appear in the interface:
```
You cannot publish (or unpublish) this asset because there are no Destinations or WordPress Connectors available.
```
The following scenarios could be the cause of the message:
- There are Destinations available, but those Destinations are disabled (ie, the **Enable destination** check box is not checked)Resolution: edit the desired Destination and confirm **Enable destination** is checked.
There are no Destinations or WordPress Connectors available in the Site
- Resolution: configure a Destination or configure a WordPress Connector
The user doesn't belong to a group selected in the existing Destination's **Applicable Groups** field
- Resolution: edit the destination and confirm at least one group the user belongs to is selected under **Applicable Groups**, or add the user to one of the selected groups.****

## Related Links
- Destinations
- WordPress Connector
- Groups

---

### Permissions issues when publishing to Filesystem Transports

To correct permission issues when using Filesystem Transports, you'll need to make sure that the boot script is updated accordingly. By default, the Tomcat container which Cascade CMS runs on will use a UMASK of `0027` which can lead to permission issues when trying to serve those files via a web server.
To overwrite the default UMASK setting:
1. Stop Cascade CMS.
2. Edit the file *cascade.sh *(located in the root directory of the Cascade CMS installation).
3. Below the line with `export JAVA_OPTS=...` add the following: `export UMASK='0022'` (or the desired UMASK value)
4. Start Cascade CMS.

## Related Links
- Transports

---

### Publish Containing Publish Set Trigger

## Overview
This trigger is used to publish out publish sets that the asset in workflow is a member of. The trigger can be used in two ways:
- Publish out all publish sets in a specified container that contains the asset attached to the workflow.
- Publish out one particular publish set if it contains the asset in workflow. The trigger will look for the publish set container or publish set by path inside of the same Site to which the asset in the workflow belongs.
**Note** - When adding the Version Trigger, Merge Trigger, and any publish trigger, they **must execute in this order** to properly perform all these actions in the database.
## Declaration
```
<trigger class="com.cms.workflow.function.PublishContainingPublishSetTrigger" name="PublishContainingPublishSet"/>
```
## Parameters
```
<parameter> <name>container-path</name> <value>/site</value> </parameter>
```
**Publish Set Container Path Parameter**
This parameter is used to identify a publish set container by its path. Note: the name parameter must be the string 'container-path'.
```
<parameter> <name>container-id</name> <value> c3e953120a00018200437b9a9e69f612 </value> </parameter>
```
**Publish Set Container Id Parameter**
This parameter is used to identify a publish set container by its id. Note: the name parameter must be the string 'container-id'.
```
<parameter> <name>path</name> <value>/site/publishset</value> </parameter>
```
**Publish Set Path Parameter**
This parameter is used to identify a specific publish set by its path. Note: the name parameter must be the string 'path'.
```
<parameter> <name>id</name> <value>e7b599550a000182012f15b045877174</value> </parameter>
```
**Publish Set Id Parameter**
This parameter is used to identify a specific publish set by its id. Note: the name parameter must be the string 'id'.
```
<parameter> <name>authorizing-type</name> <value>user</value> </parameter>
```
**Authorizing-Type Parameter**
The authorizing-type parameter is set when calling the trigger on an action. The authorizing-type parameter is used in any trigger that executes to a publish and is used to specify which user is "authorizing" the publish in this step. This will affect permissions/roles checks performed during publish and also to whom the publish report is delivered to. The "system" user is basically a way to bypass any permissions/roles checks but results in the publish report not being sent to anyone.
Authorizing-type can take the following values:
- current-step-owner - the user assigned to the step that calls the trigger
- system - the reserved "system" user
- user - a specified user
```
<parameter> <name>authorizing-user</name> <value>johndoe</value> </parameter>
```
**Authorizing-User Parameter**
This parameter is used if 'user' is selected as the value for the authorizing-type parameter. This parameter's value can be any valid user name.

---

### Publish Parent Folder Trigger

## Overview
The Publish Parent Folder Trigger publishes the parent folder of the asset in workflow.
**Note** - When adding the Version Trigger, Merge Trigger, and any publish trigger, they **must execute in this order** to properly perform all these actions in the database.
## Declaration
```
<trigger class="com.cms.workflow.function.PublishParentFolderTrigger" name="PublishParentFolder"/>
```
## Usage
```
<trigger name="PublishParentFolder"> <parameter> <name>destination</name> <value>/path/to/destination</value> </parameter> </trigger>
```
## Parameters
##### Destination Parameter
```
<parameter> <name>destination</name> <value>/path/to/destination</value> </parameter>
```
The Destination parameter is used to determine which destination the parent folder should publish to.  If more than one destination is required, these can be delimited by commas (",") within the same parameter.
At least one Destination parameter is required so this trigger knows where to publish the parent Folder to. If providing multiple Destinations using a comma-delimited list, do not add a space between the comma and subsequent Destinations unless the Destination's name leads with a space.
Please note that the path to the destination is case sensitive.
##### Authorizing-Type Parameter
```
<parameter> <name>authorizing-type</name> <value>user</value> </parameter>
```
The authorizing-type parameter is set when calling the trigger on an action. The authorizing-type parameter is used in any trigger that executes to a publish and is used to specify which user is "authorizing" the publish in this step. This will affect permissions/roles checks performed during publish and also to whom the publish report is delivered to. The "system" user is basically a way to bypass any permissions/roles checks but results in the publish report not being sent to anyone.
Authorizing-type can take the following values:
- current-step-owner - the user assigned to the step that calls the trigger
- system - the reserved "system" user
- user - a specified user
##### Authorizing-User Parameter
```
<parameter> <name>authorizing-user</name> <value>johndoe</value> </parameter>
```
This parameter is used if 'user' is selected as the value for the authorizing-type parameter. This parameter's value can be any valid user name.

---

### Publish Set Trigger

## Overview
This trigger publishes all assets in a designated Publish Set, as defined in its parameter. This is helpful when want to publish multiple items after a single asset is created or is changed. A common example is publishing an RSS feed, archives page, front page, and site map or index when publishing a press release.
**Note** - When adding the Version Trigger, Merge Trigger, and any publish trigger, they **must execute in this order** to properly perform all these actions in the database.
## Declaration
```
<trigger class="com.cms.workflow.function.PublishSetTrigger" name="PublishSet"/>
```
## Usage
```
<trigger name="PublishSet"> <parameter> <name>name</name> <value>/Intranet/Press Releases</value> </parameter> </trigger>
```
## Parameters
##### Name Parameter
```
<parameter> <name>name</name> <value>/Intranet/Press Releases</value> </parameter>
```
The name of the Publish Set, as defined by the path in the system, is used to determine which Publish Set to publish. When the Name parameter is specified, the trigger will look for the Publish Set in the same Site to which the asset in the workflow belongs.
##### ID Parameter
```
<parameter> <name>id</name> <value>f7b3d10a0a00019500d15e7a4a6208f3</value> </parameter>
```
The ID of the Publish Set is used to determine which Publish Set to publish. Note that the ID parameter takes a higher priority than Name parameter. For example, if you were to provide both parameters and each pointed to a different asset, the Publish Set specified in the ID parameter would be used.
##### Authorizing-Type Parameter
```
<parameter> <name>authorizing-type</name> <value>user</value> </parameter>
```
The authorizing-type parameter is set when calling the trigger on an action. The authorizing-type parameter is used in any trigger that executes to a publish and is used to specify which user is "authorizing" the publish in this step. This will affect permissions/roles checks performed during publish and also to whom the publish report is delivered to. The "system" user is basically a way to bypass any permissions/roles checks but results in the publish report not being sent to anyone.
Authorizing-type can take the following values:
- current-step-owner - the user assigned to the step that calls the trigger
- system - the reserved "system" user
- user - a specified user
##### Authorizing-User Parameter
```
<parameter> <name>authorizing-user</name> <value>johndoe</value> </parameter>
```
This parameter is used if 'user' is selected as the value for the authorizing-type parameter. This parameter's value can be any valid user name.

---

### Publish Sets

## Overview
A Publish Set is a group of publishable assets that can be published on-demand, on a schedule, as a result of a workflow trigger, or optionally as a part of publishing a page with an associated Content Type. They may contain files, folders, and/or pages.
## Creating a Publish Set
To create a Publish Set:
1. Navigate to **Manage Site** > **Publish Sets**.
2. Navigate to the container in which the new **Publish Set** will be stored, or create a new container using **Add** > **Container**.
3. Click **Add** > **Publish Set**.
4. In the **Name** field, enter the name for your Publish Set.
5. In the **Parent Container** field, select a container for the Publish Set, if desired.
6. Under **Files**, **Folders**, and/or **Pages** add assets to be included in the set.
7. Optionally, enable **Publish on a schedule** under the **Scheduled Publishing** tab.
8. Click **Submit**.

## Related Links
- Publishing Related Content

---

### Publish Trigger

## Overview
This trigger publishes or unpublishes the current asset in workflow (if publishable) to all enabled Destinations available to the user authorizing the publish.
When using the Publish trigger, the system differentiates between Transition steps and System steps. System steps that call the Publish trigger will authorize the publish as the system user (which operates as an administrator-level user), whereas Transition steps consider the Site Role and permissions of the current user who has ownership of the step.
**Note -** When adding the Version Trigger, Merge Trigger, and any publish trigger, they **must execute in this order** to properly perform all these actions in the database.
## Declaration
```
<trigger class="com.cms.workflow.function.Publisher" name="Publish"/>
```
## Usage
```
<trigger name="Publish"/>
```
## Parameters
The following parameters can be used within the invocation of the Publish Trigger to change the behavior in which the asset is (un)published.
### Destination
By default, the system will publish to all applicable Destinations. You can publish to specific Destination(s) by using the `destination` parameter.
```
<parameter> <name>destination</name> <value>/path/to/destination</value> </parameter>
```
To use the parameter, simply replace `/path/to/destination` with the full path to the Destination in the **Manage Site** area of your Site.
For example, if your Destination is in the root Destination Container and named `WWW Production`, you would replace `/path/to/destination` with `WWW Production`. If `WWW Production` happens to be within a Container named `Primary`, you would replace `/path/to/destination` with `Primary/WWW Production`.
**Note -** the path to the Destination is case sensitive.
You can specify multiple destinations by putting in multiple parameter nodes, each containing a name and value tag, such as:
```
<parameter> <name>destination</name> <value>/path/to/destination</value> </parameter><parameter> <name>destination</name> <value>/path/to/another/destination</value> </parameter>
```
### Publish Working Copy
It is also possible to publish the working copy of a page in workflow for staging purposes. This can be accomplished by adding a `publish-working-copy` parameter to the invocation of the Publish Trigger in a Workflow Definition with a value of `true`. By default (without this parameter) only the non-working copy version of the asset in workflow is published.
```
<parameter> <name>publish-working-copy</name> <value>true</value> </parameter>
```
### Unpublish
If the asset is meant to be unpublished, the `unpublish` parameter can be used, which accepts boolean values `true` or `false` (default).
This parameter works together with other parameters in this trigger so that it is possible to unpublish an asset using a given authorizing user, to unpublish a working copy, and to unpublish only from specified Destinations. This trigger can be useful when moving or renaming an asset through Workflow.
```
<parameter> <name>unpublish</name> <value>true</value> </parameter>
```
### Authorizing Type
The `authorizing-type` parameter is used to specify which user is "authorizing" the publish in this step. This will affect permissions/roles checks performed during publish and also to whom the publish report is delivered to.
Authorizing-type can take the following values:
- `current-step-owner` - the user assigned to the step that calls the trigger
- `system` - the reserved "system" user, which can be used to bypass all permission and role ability checks and results in the publish report not being sent to anyone.
- `user` - a specified user
```
<parameter> <name>authorizing-type</name> <value>user</value> </parameter>
```
**Note -** To specify a user, leave the authorizing-type set to the string literal 'user'. Then, provide the specific username you wish to use in the corresponding `authorizing-user` parameter (see the section below titled **Authorizing User**).
### Authorizing User
The `authorizing-user` parameter is used in conjunction with the *user* authorizing-type. This parameter's value should be any valid username in the system.
```
<parameter> <name>authorizing-user</name> <value>johndoe</value> </parameter>
```
**Note -** the username value is case sensitive.
### Publish Related Assets
The `publish-related-assets` parameter can be used to ensure that the asset's publishable relationships are also published.
```
<parameter> <name>publish-related-assets</name> <value>true</value> </parameter>
```
### Publish Related Publish Set
The `publish-related-publishset` parameter can be used to ensure that the page's Content Type Publish Set is also published.
```
<parameter> <name>publish-related-publishset</name> <value>true</value> </parameter>
```

---

### Publish Triggers

## Overview
Publish Triggers are plug-ins that can be utilized during the publishing process. They allow developers to execute custom logic each time an asset (page, file, or other content item) is published.
For example, a publish trigger may be set up so that each time a particular page is edited and published, an e-mail is sent to notify users (or even non-Cascade users) that may be interested in that page's publication.
## Publish Trigger Pre-Requisites
Use of the Publish Trigger SDK requires that you have moderate knowledge of Java programming.
1. Ensure you have version 6 or later of the Java Development Kit (JDK) installed on your computer.
2. Ensure you are running Cascade 8.0.x or later.
3. Download the [Eclipse IDE](https://www.eclipse.org/).
4. Clone the repository and checkout the [8.0.x branch](https://github.com/hannonhill/Cascade-Server-Publish-Trigger-SDK/tree/8.0.x) or [download the SDK](https://github.com/hannonhill/Cascade-Server-Publish-Trigger-SDK/archive/8.0.x.zip) from the [Hannon Hill GitHub repository](http://github.com/hannonhill/Cascade-Server-Publish-Trigger-SDK/).
If you do not want to use Eclipse, you can develop against the [publish trigger API JAR](https://github.com/hannonhill/Cascade-Server-Publish-Trigger-SDK/blob/master/lib/publishtrigger-8.17.jar) and the [general Cascade API JAR](https://github.com/hannonhill/Cascade-Server-Publish-Trigger-SDK/blob/master/lib/cascade-api-8.17.jar) to access other assets from Publish Triggers.
## Installing Eclipse and Opening the SDK
1. Once Eclipse is downloaded, it needs to be unzipped to a directory of your choosing (suggestions: c:\java\eclipse or c:\Program Files\Eclipse on Windows, /usr/local/eclipse on Linux, or ~/java/eclipse on OS X).
2. Start Eclipse and you will be prompted to choose a workspace location – the default location should suffice.  Make note of this location, as it is where the SDK will also be unzipped.
3. Unzip the SDK plug-in to your workspace directory. The zip should create its own directory inside your workspace directory.
4. Load the SDK (which is actually just an Eclipse project) into Eclipse.  To do so, right-click in the Package Explorer view on the left-hand side, and select "Import...".  Then select "Existing Projects Into Workspace" under ‘General’ and click Next.  Select "Browse" (next to "Select root directory:") and navigate to the directory created when you unzipped the SDK.  You should then see "Cascade Publish Trigger" under ‘Projects’.  Click Finish.
You should now see the project in your Package Explorer.  The project already has a pre-created package and starter plug-in named `com.mycompany.cascade.plugin.SimplePublishTrigger`. Feel free to delete/rename/move this plug-in to suit your needs.
## Writing the Publish Trigger Plug-In Class
A plug-in is a Java class that implements the PublishTrigger interface. The plug-in writer will need to implement the following methods defined on this interface:
```
setPublishInformation (PublishTriggerInformation information)
```
This method provides the PublishTrigger implementation with an information object, which is a simple JavaBean containing information about the asset currently being published. This is called before invoke(), and generally, the PublishTrigger implementation will simply store this for use during the invoke() method, in which the PublishTrigger implementation will perform its actual logic. This method is called once per item published.
```
setParameter (String name, String value)
```
This method provides the PublishTrigger implementation with parameters as set in the PublishTrigger XML configuration file. This method is called once per parameter listed in the Publish Trigger configuration XML file, immediately after the PublishTrigger implementation is constructed.
```
invoke() throws PublishTriggerException
```
This method is where the core logic of the PublishTrigger implementation should be written. It is called once per item published, immediately after setPublishInformation is called. Note that the PublishTrigger implementation provided must provide a default, no-args constructor.
## Publish Trigger Lifecycle
PublishTrigger implementations are constructed once per logical publish. Once a PublishTrigger implementation is constructed, it is initialized once by passing in all of the parameters defined for that trigger from the Publish Trigger configuration XML file. Then, it’s setPublishInformation and invoke methods will be called once per asset published. Once the logical publish ends, the PublishTriggers are discarded and garbage collected.
## Deploying the Publish Trigger
Once the custom code is written, package your code into a JAR, including any custom helper classes.  If your PublishTrigger implementation relies on any other outside libraries, these libraries will be copied to the same place as the JAR containing the custom code.
Place these JAR file(s) in the following directory: <Cascade Installation Directory>/webapps/ROOT/WEB-INF/lib. For advanced users that do not have their Cascade CMS deployed as the root web application (non-standard configuration), these files will need to be placed in the corresponding context directory inside of the webapps directory. For example, if Cascade CMS is deployed at the "cms" context, the files would be placed at <Cascade Installation Directory>/webapps/cms/WEB-INF/lib.
Restart Cascade CMS.
**Note** - It's good practice to store any custom code developed for Cascade CMS in the base of the Cascade CMS installation directory as well. This is because these custom files, once deployed, may be overwritten each time the Cascade CMS software is upgraded. For instance, storing a backup of these files inside of <Cascade Installation Directory>/cascade-custom-code is strongly suggested.
## Publish Trigger Configuration
To manage Publish Triggers, click the system menu button ( * *) > **Administration** > **Publish Triggers**. Only users with the **Modify Configuration Files** ability enabled in their System Role can configure Publish Triggers.
A trigger is comprised of a package-qualified Java classname and any associated parameters. Click **Add Trigger** to add additional triggers and **Add Trigger Parameters** to add additional parameters.
Multiple triggers can be defined. In fact, the same trigger class could be defined multiple times with different parameters.
For backwards compatibility and to allow easy copying of trigger configurations from one instance of Cascade CMS to another, there is an XML pane that contains the complete configuration.
**Note** - A JAR file containing the trigger classes must be deployed before startup when attempting to add them to the configuration. Trigger classnames are validated on submission. If the class cannot be found, submission will fail.
## Sample Publish Trigger
This sample publish trigger is included in the SDK, and reproduced below:
```
/* * Created on Jan 17, 2008 by Zach Bailey * * This software is offered as-is with no license and is free to reproduce or use as anyone sees fit. */ package com.mycompany.cascade.plugin; import java.util.HashMap; import java.util.Map; import com.cms.publish.PublishTrigger; import com.cms.publish.PublishTriggerEntityTypes; import com.cms.publish.PublishTriggerException; import com.cms.publish.PublishTriggerInformation; /** * This plug-in does some really neat stuff! * @author <Your Name Here> */ public class SimplePublishTrigger implements PublishTrigger { private Map<String, String> parameters = new HashMap<String, String>(); private PublishTriggerInformation information; /* (non-Javadoc) * @see com.cms.publish.PublishTrigger#invoke() */ public void invoke() throws PublishTriggerException { // this is where the logic for the trigger lives. // we switch on the entity type and this allows us to determine if a page or file is being published switch (information.getEntityType()) { case PublishTriggerEntityTypes.TYPE_FILE: System.out.println("Publishing file with path " + information.getEntityPath() + " and id " + information.getEntityId()); break; case PublishTriggerEntityTypes.TYPE_PAGE: System.out.println("Publishing page with path " + information.getEntityPath() + " and id " + information.getEntityId()); break; } } /* (non-Javadoc) * @see com.cms.publish.PublishTrigger#setParameter(java.lang.String, java.lang.String) */ public void setParameter(String name, String value) { // let's just store our parameters in a Map for access later parameters.put(name, value); } /* (non-Javadoc) * @see com.cms.publish.PublishTrigger#setPublishInformation(com.cms.publish.PublishTriggerInformation) */ public void setPublishInformation(PublishTriggerInformation information) { // store this in an instance member so invoke() has access to it this.information = information; } }
```

---

### Publishing

Cascade CMS features a robust publishing engine designed to render and publish content to one or more environments. Once content is published, it's completely decoupled from the CMS, allowing it to operate independently in any standard environment.

---

### Publishing Related Content

## Overview

Often times, content you're working on will affect other pages in your site, and you may like to publish that related content along with it.
For instance, if you edit a contact information block, you may want to publish all pages that use that block. Or you may want to publish your site's homepage when you create a news item, so that the homepage news feed pulls in the new story.
Cascade CMS offers a couple ways to achieve this:
- **Publishable Relationships** - When publishing, selecting the **View and Publish Related Content** option prompts you to view the asset's Relationships and opt to publish them. Relationships are created automatically when assets link to each other in their content, but can also be manually created to establish relationships between assets that aren't directly linked.
- **Content Type Publish Sets** - The **Include Publish Set** option allows you publish the Publish Set associated with the page’s Content Type. Associating a Publish Set with a Content Type is a great way to ensure that related content is published when new pages of that page type are created and published.
## Publishable Relationships
Relationships are assets that are related, either directly or manually, to another asset. For example, Pages or Blocks that link to the page you're viewing will be listed as Relationships for that page.
Publishable Relationships are related assets that can be published: Folders, Pages, and Files.
You can view an asset's relationships by selecting **More** > **Relationships**.

From this menu you can select publishable assets from the list to publish or click **Publish All** to publish all publishable relationships.
If related content doesn't directly link to your asset, you can also manually associate Folders, Pages, or Files with an asset:
1. Click **More** > **Relationships**.
2. Under **Create a manual relationship** click **Choose Publishable Site Content**.
3. Select a folder, page, or file asset and click **Choose**.
4. Click **Close** when you've finished adding or removing relationships.
**Note** - Only manually-added relationships can be removed from the Relationships menu. To remove a linked relationship, you must edit the related asset directly to remove the link.**Tip** - Ensure that related assets are published along with an asset in workflow by adding a **publish-related-assets** parameter to your Publish trigger.
## Content Type Publish Sets
If you have content you'd like to publish each time a new page of a given type is published, such as publishing a blog landing page or RSS feed whenever a new blog page is published, you can achieve this by associating a Publish Set with the appropriate Content Type.
To add a Publish Set to a Content Type:
1. Navigate to the Content Type and click **Edit** > **Publish Options**.
2. Under **Publish Set**, click **Choose Publish Set**.
3. Select the appropriate Publish Set and click **Choose**.
4. Click **Submit**.
**Note** - If you would like contributors to be able to publish Content Type Publish Sets along with a page, ensure they have the following Site Role abilities enabled:
- Access the Manage Site area
- Access Publish Sets
- Publish readable Administration area assets
as well as read access to the Publish Set itself.**Tip** - Ensure that the associated Publish Set is published along with an asset in workflow by adding a **publish-related-publishset** parameter to the Publish trigger in your Workflow Definition.

---

### Scheduled publishing for individual assets

Both the **Start Date** field (in an asset's Metadata) and the **Optionally Publish Later** option provide a way to schedule an asset to publish at a future date/time.
See below for notes on when to use one versus the other:
## Start Date
The **Start Date** field, which is part of an asset's Metadata, allows for configuring a specific date and time for when an asset should "go live".
**Tip**: This is the preferred method to *use for brand new pages/files* as they will not be indexed in the system or be eligible for publishing until the Start Date has been reached. 
## Optionally Publish Later
The **Optionally Publish Later** option, which can be found after clicking to Publish an asset, also allows for scheduling an asset to be published at a later date/time. The main difference between using this option as opposed to the Start Date option mentioned above is that this option will keep the asset eligible for indexing  before the configured date/time is reached.
**Tip**: This is the recommended strategy for scheduling *updates to an existing page* since the asset is likely already being referenced from various locations throughout the site(s).**Note**: This option should **not** be used for brand new pages/files as it can result in invalid links to the asset from throughout the site(s).
## Related Links
- Publishing
- Metadata Fields in Cascade

---

### The folder hierarchy does not allow this asset to be published

This error message indicates that one or more of the parent folders of the asset you're attempting to publish is not enabled for publishing. Assets contained in folders not enabled for publishing are not publishable, even if they're set to publish at an individual level.
To enable a folder for publishing:
1. Edit the folder.
2. Select the **Properties** tab.
3. Enable the **Include when publishing** option.
4. **Submit** your changes.

## Related Links
- Asset is not set to publish. Please enable publishing for this asset and try again.

---

### This asset cannot be published because there are no publishable configurations

When attempting to publish a page, the following message may appear in the interface:
```
This asset cannot be published because there are no publishable configurations
```
To resolve this, you must enable publishing for at least one of the Outputs for the page:
1. While previewing the page, click **Details** > **Design**.
2. Click the link to the **Configuration**.
3. Click **Edit**.
4. Check the box labeled **Publishable** for one or more Outputs that should be publishable.
5. Click **Submit**.

## Related Links
- Configurations

---

### Transports

## Overview
A Transport represents a server to which content can be published. Transports can be used by one or more Destinations.  Destinations provide an extra layer of abstraction on top of Transports that allow users to publish content to different locations on the same Transport. Basically, a Transport is "how" the content gets there and Destination is "where" it goes.
## Filesystem Transports
Filesystem Transports can push out content to a location on the CMS server’s hard drive or to a mapped network location.  In order to successfully publish using a Transport that points to a mapped network location, the operating system level user executing the Cascade CMS system process must have the appropriate privileges to write to and create new files in the network publish location.
**Note** - Filesystem Transports are applicable to legacy on-premise environments only.
To create a Filesystem Transport:
1. Navigate to **Manage Site** > **Transports**.
2. Navigate to the container in which the new Transport will be stored, or create a new container using **Add** > **Container**.
3. Click **Add** > **Transport**.
4. Select **Filesystem** and click** Choose**.
5. In the **Name** field, enter the name for your Transport.
6. In the **Parent Container** field, select a container for the Transport, if desired.
7. In the **Server Directory** field, enter a directory path. This path will be prepended to an optional non-absolute Destination Directory path when determining the full published path of an asset. This combined path is then prepended to asset paths when publishing. For example, if a Transport has a Server Directory of '/www/publish root', the Destination using the Transport has a Directory of 'mysite' and the asset being published has a system path of '/content/my press release'; then the asset will be published to the '/www/publish root/mysite/content' directory in the filesystem. If, however, the Destination being used contains an absolute path, then the Server Directory field on the Transport will be ignored.
8. Click **Submit**.
#### Filesystem Access Rights and Permissions
Filesystem Transports are restricted by filesystem level access rights and permissions. In order to successfully publish, the user who owns the Cascade CMS process must have write access to the directory specified in the Transport. Otherwise, the publish report will contain access rights violations.
#### Mapped Network Locations
It is possible to publish to a mapped network drive using a Filesystem Transport. The directory used as the mount point for a network-mapped drive should be treated like any other directory in the filesystem. Note, however, that because Cascade CMS is treating the drive like a directory; the mechanism by which the drive is being shared (NFS, FTP, etc.) cannot be managed by Cascade CMS. An alternative would be to set up an FTP/FTPS/SFTP server and a corresponding FTP/FTPS/SFTP Transport that can be managed from within Cascade CMS.
## FTP/FTPS/SFTP Transports
FTP/FTPS/SFTP Transports push content to a remote server via the FTP, FTPS (FTP over SSL/TLS), or SFTP (Secure FTP) protocols. The account specified in the Transport's settings must have appropriate privileges on the remote server to navigate through the folder structure, write, and create to ensure that publish operations do not encounter errors.
To create a FTP/FTPS/SFTP Transport:
1. Navigate to **Manage Site** > **Transports**.
2. Navigate to the container in which the new Transport will be stored, or create a new container using **Add** > **Container**.
3. Click **Add** > **Transport**.
4. Select **FTP/FTPS/SFTP** and click **Choose**.
5. In the **Name** field, enter a name for your Transport.
6. In the **Parent Container** field, select a container for the Transport, if desired.
7. Under **Transport Settings**, configure the following fields: - **Server Name** - The hostname of the server to which Cascade will connect. - **Server Port** - The port over which Cascade will communicate with the FTP/FTPS/SFTP server. Note that the default port for each protocol selected below is preselected. - **Server Directory** - An optional directory path that is prepended to a non-absolute Destination Directory path when determining the full published path of an asset. This combined path is then prepended to asset paths when publishing. For example, if a Transport has a Server Directory of '/www/publish root', the Destination using the Transport has a Directory of 'mysite' and the asset being published has a system path of '/content/my press release'; then the asset will be published to the '/www/publish root/mysite/content' directory on the FTP/FTPS/SFTP server. If, however, the Destination being used contains an absolute path, then the Server Directory field on the Transport will be ignored.
8. Under **Protocol**, select one the following: - **FTP** - With option to **Use Passive FTP (PASV)**. - **FTPS** - FTP over SSL/TLS. - **SFTP** - Secure FTP.
9. Under **Authentication Settings**, configure the following fields: - **Username** - The username used when authenticating with the FTP/FTPS/SFTP server. - **Authentication Type****Password** - The password to be used in combination with Username to authenticate with the FTP/FTPS/SFTP server. - **SSH Key** - Allows you to upload a Private Key file and an optional Private Key Passphrase to authenticate with an SFTP server.
10. Click **Submit**.
## Database Publishing
Database publishing allows publishable assets (pages, files, and folders) to be published to an external MySQL database. This gives developers of third-party applications a way to access the content in Cascade CMS in a structured, tabular format. Database publishing requires a Database Transport and a Destination that uses the Transport. Content published to this Destination will end up as records in the remote database.
To create a Database Transport:
1. Navigate to **Manage Site** > **Transports**.
2. Navigate to the container in which the new Transport will be stored, or create a new container using **Add** > **Container**.
3. Click **Add** > **Transport**.
4. Select **Database** and click **Choose**.
5. In the **Name** field, enter the name for your Transport.
6. In the **Parent Container** field, select a container for the Transport, if desired.
7. Under **Database Transport Settings**, configure the following fields: - **Site Id** - An identifier that is attached to each item published using this Transport that is used to differentiate between publishes from different Database Transports. - **Server Name **- The hostname of the server to which Cascade will connect. - **Server Port** - The port over which Cascade will communicate with MySQL. - **Database Name** - The name of the database into which data will be inserted. - **Username** - The username used when authenticating with MySQL. - **Password** - The password to be used in combination with Username to authenticate with MySQL.
8. Click **Submit**.
#### Requirements for Database Publishing
- Database publishing requires MySQL 5+.
- The default character set on the external database and all its tables and text columns must be set to *utf8,* and the collation must be *utf8_unicode_ci*.
**Note** - SSL is not currently supported for Database Transports. Because MySQL 8 defaults to SSL for connections, if you are using MySQL 8 on your target database, you may need to add `ssl=0` to the target database's configuration file and restart it to disable SSL entirely.
#### Types of Content being Published
- Files - Published files include the name, location, path, and metadata of the associated asset in the CMS; the published version, however, does not include the byte content of the file.
- Folders - Published folders include the name, location, path, and metadata of the associated asset in the CMS; they serve as containers for collections of other files, pages, and folders.
- Pages - Published pages include the name, location, path, and metadata of the associated asset in the CMS; also includes the rendered content of the DEFAULT region (i.e. page specific content with any default region transformations applied). Works with both Structured Data and WYSIWYG Pages.
#### External Database
Database publishing creates records in an external database that containing five tables: file, folder, page, metadata, and metadata_custom.  The file, folder and page tables contain records that are mapped from the corresponding assets managed in Cascade.  The metadata and custom_metadata tables contain the wired and dynamic metadata for the page, file and folder assets represented in the file, folder, and page tables.  A few notes on some of the above fields:
- account_id - should always be 1
- site_id - is an arbitrary value that reflects a particular site to which the record belongs, and is set on the transport
- folder_id - corresponds to the *cms­­_id* of a folder, and not its *id* field in the remote database
The default database schema for database publishing can be [downloaded here](http://github.com/hannonhill/Cascade-Server-Default-Database/raw/master/cascade_db_publishing_schema.zip).
#### Site IDs
As mentioned above, a site id is an arbitrary number set on a Database Transport to reflect the 'site' to which a record belongs. The site id should be unique for each of the multiple Database Transports using the same external MySQL database to effectively distinguish the content.
#### Troubleshooting Database Transports
If Cascade is unable to publish to an external database, make sure these guidelines are being followed:
- The server name and port are correct (usually 3306 for MySQL).
- A firewall is not blocking access on the above port.
- The host that is trying to connect has granted access to the database transport user.
- The bind-address parameter in the MySQL configuration is not set to localhost or the loopback address.
Useful information in solving these problems can be garnered from the output of a Transport or Destination connectivity test.
#### Other Notes
Until now, publishing has consisted of moving files to a local or remote file system. Database publishing is more along the lines of synchronizing some portion of the asset hierarchy within Cascade to representative records in an external database. When using database publishing, keep in mind a few of these important items :
- Records inserted during a database publish do *not* represent the assets in the state in which they would have been published to a file system by simply publishing them. This is particularly true if options are set on relevant targets and destinations that relate to publish-time directory and link manipulation (i.e. remove base folder path, include target path, destination path, etc.).
- Links in page content are not rewritten during database publishing, and should reflect the in-CMS path of the entities the records represent.
- After particular sequences of publishes, deletes, and unpublishes (or lack thereof), the state of the external database should be considered.
For example, a folder containing two pages:
- FolderPage 1
- Page 2
The folder, its pages, and their associated metadata would be written to the external database if a user were to publish this folder to a destination backed by a database transport. Page 1 is then deleted and the folder is republished. If the external database was examined, it would be discovered that Page 1 still has records therein. In database publishing as in normal publishing, it is assumed that users will indicate exactly which assets they want unpublished from their destination.  
If the same asset is published to destinations using different database transports, this may result in several files, pages, and folders in the external database with the same cms_id. It is important to know what criteria to include in SQL queries to ensure that the correct records are being operated on. The *cms_id*, *the account_id*, and the *site_id* of the assets being operated on should match those on which the user intends to operate. The *folder_id* of records in the remote database corresponds to the *cms_id* of its parent folder, and not to the *folder_id*.
If a user was dealing with a site with id=5 and an account with id=1, and wanted to get the parent folder of a file named ‘koko.png’ in the external database, the file record would appear in the external database like so:
| id | account_id | site_id | cms_id | folder_id | metadata_id | name | path |
| --- | --- | --- | --- | --- | --- | --- | --- |
| 9 | 1 | 5 | 92436e0a7f00010100b2eca959237ccd | 92436dc67f00010100b2eca953a7298f | 10 | koko.png | site5/images/koko.pn |
The desired folder record would appear like so:
| id | account_id | site_id | cms_id | folder_id | metadata_id | name | path |
| --- | --- | --- | --- | --- | --- | --- | --- |
| 3 | 1 | 5 | 92434dc67f00010100b2eca953a7298f | 9a436dc67f00010100b2eca234526666 | 10 | images | site5/image |
In order to select this record, the correct query would be:
`SELECT * FROM folder WHERE cms_id='92436dc67f00010100b2eca953a7298f' AND site_id=5 AND account_id=1;`
It is possible that there is another record corresponding to the images folder in the external database with the same *cms_id*, but with a different *account_id*, *site_id*, or both. If the expressions restricting the *site_id* and *account_id* were omitted from the query above, multiple folders would be returned in the result.
## Amazon S3 Transports
Amazon's Simple Storage Service (S3) can be used for hosting static resources such as images, PDFs, CSS, or JS. You can also publish and host entire sites, including page content, on S3 and serve them through a custom domain on CloudFront.
To publish using an S3 Transport, you'll need an Access Key, which allows a program, script, or developer to have full programmatic access to the resources on your account. A sample S3 JSON Policy with the minimum required privileges can be found below (replace *bucketName* with the name of your bucket):``
```
{ "Version": "2012-10-17", "Statement": [ { "Effect": "Allow", "Action": [ "s3:DeleteObject", "s3:GetObject", "s3:PutObject", "s3:PutObjectAcl", "s3:ListBucket" ], "Resource": [ "arn:aws:s3:::bucketName/*", "arn:aws:s3:::bucketName" ] } ]}
```
### On-premise Customers Older pre-v8.22.1
```
{ "Version": "2012-10-17", "Statement": [ { "Effect": "Allow", "Action": [ "s3:ListAllMyBuckets" ], "Resource": [ "arn:aws:s3:::*" ] }, { "Effect": "Allow", "Action": [ "s3:DeleteObject", "s3:GetObject", "s3:PutObject", "s3:PutObjectAcl" ], "Resource": [ "arn:aws:s3:::bucketName/*" ] } ]}
```
``
**On-premise customers pre-v8.22.1:** the Permissions tab for your S3 bucket must have the **Block new public ACLs and uploading public objects **option *disabled*. Without that setting disabled, you may encounter **Access Denied** errors when attempting to publish to your S3 bucket. Other causes for this error and steps to resolve them can be found on [the Amazon S3 Troubleshooting page](https://aws.amazon.com/premiumsupport/knowledge-center/s3-troubleshoot-403/).
To create an Amazon S3 Transport:
1. Navigate to **Manage Site** > **Transports**.
2. Navigate to the container in which the new Transport will be stored, or create a new container using **Add** > **Container**.
3. Click **Add** > **Transport**.
4. Select **Amazon S3** and click **Choose**.
5. In the **Name** field, enter the name for your Transport.
6. In the **Parent Container** field, select a container for the Transport, if desired.
7. Under **Amazon S3 Transport Settings**, configure the following fields: - **AWS User Access Key ID** - **AWS User Secret Key** - **S3 Bucket Name **- Name of an S3 bucket to which the AWS Access Key user above has write access. - **Base Path **- Optional, assets will be published in this folder within your S3 bucket.
8. Click **Submit**.
#### Linking
To ensure links to assets published to S3, either on their own or as part of a CloudFront distribution, from assets that aren't published there are valid, be sure to use the S3 bucket's URL (including the Base Path) or the CloudFront distribution's URL (including the Base Path) as the site URL or Destination's Web URL.
As a best practice, you'll want to manage your S3 published assets in a separate site so the system can easily tell which URL to use when generating links.
## Testing Transport Connectivity
The Transport test utility allows users to test Transport connectivity without invoking a publish. To run a Transport test:
1. Navigate to **Manage Site** > **Transports**.
2. Select the Transport you wish to test.
3. Click **More** > **Test Connectivity**.
4. Click **Start Test**. If there are no errors, the screen will indicate "Test Successful!" If errors are found, the screen will identify the problem that occurred.

## Related Links
- Which algorithms are supported for SFTP?

---

### Unpublish and Delete Trigger

## Overview
This trigger will unpublish the asset in workflow before deleting it. This ensures that an orphaned file is not left on the web server.
If the asset in the workflow is not a publishable asset (such as a Template or External Link), this trigger performs a standard delete. If the asset is a publishable asset (File or Page), the trigger attempts to unpublish the asset from all enabled Destinations prior to deleting it.
**Note** - After the UnpublishAndDelete trigger is called, there is no longer an asset in workflow and the workflow is effectively over. Any asset-based triggers called after this will be ignored.
## Declaration
```
<trigger class="com.cms.workflow.function.DeleteAndUnpublish" name="UnpublishAndDelete"/>
```
## Usage
```
<trigger name="UnpublishAndDelete"/>
```
## Parameters
##### Authorizing-Type Parameter
```
<parameter> <name>authorizing-type</name> <value>user</value> </parameter>
```
The authorizing-type parameter is set when calling the trigger on an action. The authorizing-type parameter is used in any trigger that executes to a publish and is used to specify which user is "authorizing" the publish in this step. This will affect permissions/roles checks performed during publish and also to whom the publish report is delivered to. The "system" user is basically a way to bypass any permissions/roles checks but results in the publish report not being sent to anyone.
Authorizing-type can take the following values:
- current-step-owner - the user assigned to the step that calls the trigger
- user - a specified user
Note - The Unpublish and Delete trigger cannot use the "system" authorizing-type value, as the trigger requires a real username to be used to authorize deletion that occurs before unpublish.
##### Authorizing-User Parameter
```
<parameter> <name>authorizing-user</name> <value>johndoe</value> </parameter>
```
This parameter is used if 'user' is selected as the value for the authorizing-type parameter. This parameter's value can be any valid username.

---

### Unpublishing vs. Deleting Content - Which is best?

## Overview
Cascade CMS pushes web content (files, pages, and folders) to your public-facing webserver. Beyond this, it boils down to what you want to do with your content. If you want to temporarily pull your content off your server (maybe for maintenance or time-sensitive reasons) with the possibility of adding it back later, you'll want to unpublish your content.
On the other hand, if you want to remove content from Cascade CMS altogether, use the delete function. Deleting content will unpublish it (with an option to confirm if previously published) and move it to the Trash bin, where it will remain for an administrator-designated amount of time before being purged from the CMS.
Deleted content can be recalled from the Trash as long as the user has access to see it and as long as it has not been purged.
## Preventing Publishing
Additionally, you'll be able to prevent content from being published using a publishing preference. For example, if you have a page in development but not quite ready for "prime time", it can be hidden from Cascade CMS publishing hooks.
To keep content from being published, locate the **Configure** tab while editing an asset. The Configure tab will show checkboxes for indexing ("Include when indexing") and publishing ("Include when publishing"). Disable the "Include when publishing" option and click **Submit**. Note: doing so will essentially "freeze" any content you already have on your webserver, so you may want to unpublish your content before disabling publishing for the asset in question.
Disabling "Include when indexing" will prevent Cascade CMS from indexing the asset (or its contents if the asset is a folder) internally. It will not affect publishing.

---

### Where can I find publish notifications?

## For publish jobs that you initiated
To locate publish notifications for assets that you have published:
- Click your User profile picture or letter in the top-right corner of the screen.
- In the dropdown menu that appears, select **Notifications**.
The subject line for a publish notification will look something like the following:
```
Publish of <asset> "<asset-name>" completed (# issue(s))
```
## For scheduled publish jobs
**Note:  **The steps for viewing scheduled publish notifications require certain permissions and role abilities that your User account may or may not have. These include the ability to access the scheduled job(s) in question as well as the ability to assume User identities in the CMS. If you don't have these abilities, you will need to contact your CMS administrator to retrieve a publish notification for you or to grant you the appropriate abilities to do so.
To locate publish notifications for a scheduled job:
- For Publish Sets or Destinations:Navigate to the Publish Set or Destination in question.
- Click **Edit**.
- Click the **Scheduled Publishing** tab.
- Scroll down to the **Notifications** section.
For Sites:
- Switch into the Site in question.
- Go to **Manage Site** > **Site Settings**.
- Scroll down to the **Publishing/Unpublishing** > **Notifications** section (assuming that the Site is configured to **Publish on a schedule**).
The **Notifications** section in both of these areas contains the following two settings:
- **Send Report to** - If Users and/or Groups have been selected to receive notifications for the publish job, you'll see those Users/Groups listed here.
- **Only send report when errors are present** - If this option is selected, a publish notification will only be sent if errors are present during the publish job.
If your role abilities allow it, you can assume the identity of one of the Users listed here and then follow the steps at the top of this article to view the related publish notification(s) that they received.

---

### Why am I seeing &lt;system-region&gt; tags around my published content?

System region tags are automatically added to rendered and published content that doesn't contain valid XML. Specifically, due to a lack of a root element when Cascade CMS attempts to validate the content as XML during the rendering and publishing process.
To generate non-XML compliant content, surround your Template region(s) with a "dummy" tag that is wrapped in a `#cascade-skip` code section. Cascade CMS will skip this "dummy" tag on render and publish, resulting in only the content being displayed.
## Method #1
Use this method if your Template resides in the same site as your content.
### Template
```
<!--#cascade-skip--><removed><!--#cascade-skip--><system-region name="DEFAULT" /><!--#cascade-skip--></removed><!--#cascade-skip-->
```
## Method #2
Use this method if your Template will be shared across sites.
### Template
```
<!--#cascade-skip--><removed> <system-region name="DEFAULT"/></removed>
```
### Format
```
<!--#protect-top...Format here...#protect-top-->
```
### Browser Errors
Because the content is no longer valid XML, you may encounter an error similar to the following when the browser attempts to render the content within Cascade CMS:
```
This page contains the following errors:error on line 2 at column 1: Document is emptyBelow is a rendering of the page up to the first error.
```
This is due to Cascade CMS telling the browser to render the content as XML, when in fact it is not. The error can be disregarded.

---

### Why am I seeing 'Asset does not exist' message in my Publish Notification?

This particular message indicates that the asset being published contains a link to another asset that the system is unable to locate. Refer to the following output from the Broken Links section of a sample Publish Notification:
```
[Destination: Production Web Site] about/staff/directoryLink: /about/staff/john.html Reason: Asset does not exist.
```
In this case, the *about/staff/directory* page being published contains a link to */about/staff/john.html*:
```
<a href="/about/staff/john.html">John Smith</a>
```
which does not exist in the system.
The solution here is to verify that the link is pointing to an asset that is managed within the system. It's important to note that file extensions for page assets are not added until the final steps of the publishing process. This means that while the page asset */about/staff/john* may exist, you should not include the file extension when referencing it, since that is added automatically during the publishing process. The link should be written as:
```
<a href="/about/staff/john">John Smith</a>
```
Notice that the file extension has been removed from the link's href attribute.
Similarly, when creating a link to a folder, be sure to link to the folder's index or default page, and not the folder itself. For example, a link to the */about/contact-us* folder should be written:
```
<a href="/about/contact-us/index">Contact Us</a>
```

## Related Links
- Linking

---

### You are not authorized to schedule future publish dates

As of Cascade CMS v8.2 the **Start Date** field publishes the asset at the selected date. If a user receives the following error during submission, that means their Site Role does not allow them to Publish:
```
You are not authorized to schedule future publish dates. Please contact an administrator for assistance regarding your publishing rights or send the changes to an applicable Workflow.
```
You can verify by checking out the user's Effective Abilities under the **Publishing **section. In order to set a Start Date in the future, the user's Site Role will need to have the ability to **Publish writeable Home area assets** enabled OR be assigned another Site Role with that ability.
Keep in mind that enabling this ability will allow Users with that Site Role to publish any assets to which they have write access.

## Related Links
- Roles
- How can I check what a User can do in a specific Site?

---

### You cannot publish (or unpublish) this asset because there are no Destinations or WordPress Connectors available.

This error message means that the User trying to publish (or unpublish) does not belong to an applicable group in any of the Site's Destination settings. 
## To solve:
1. Click **Manage Site** and then select **Destinations.**
2. Edit the Destination or Destinations to which the User needs to publish.
3. Verify that the User belongs to a Group in the Destination's **Applicable Groups field** (and if they do not, add their Group to this field).

## Related Links
- Destinations
- Groups

---

## REST API

*3 articles in this category*

### SOAP Web Services

Web services provide Cascade CMS users with a powerful way to work with the system by providing a powerful back-end interface with which to interact.

---

### SOAP Web Services Changelog

## Cascade CMS 8.19
- New property added to `publishInformation` complexType:`scheduledDate` (dateTime)
## Cascade CMS 8.17
- New property added to `site` complexType:`siteLinkRewriting` (string)`absolute`
- `relative`
- `site-relative`
New property added to `page` and `file` complexTypes:
- `linkRewriting` (string)`inherit`
- `absolute`
- `relative`
- `site-relative`
Property removed from `page` and `file` complexTypes:
- `maintainAbsoluteLinks`
## Cascade CMS 8.16
- New property added to `authentication`:`apiKey` (string)
- Either `username` *and* `password` or `apiKey` are required when authenticating requests
New properties added to `moveParameters`:
- `unpublish` (boolean)
- `destinations` (array of identifiers)
New properties added to `delete` operation:
- `deleteParameters``doWorkflow` (require; boolean)
- `unpublish` (boolean)
- `destinations` (array of identifiers)
New complexTypes `deleteParameters` and `unpublish-parameters`:
```
<complexType name="deleteParameters"> <complexContent> <extension base="impl:unpublish-parameters"> <sequence> <element name="doWorkflow" minOccurs="1" maxOccurs="1" type="xsd:boolean"/> </sequence> </extension> </complexContent></complexType><complexType name="unpublish-parameters"> <sequence> <!-- NOT REQUIRED: when true, the asset will be unpublished. Default: false --> <element name="unpublish" minOccurs="0" maxOccurs="1" nillable="true" type="xsd:boolean"/> <!-- NOT REQUIRED: unpublishes the asset from the given destinations. Default: all enabled destinations in the asset's site --> <element name="destinations" minOccurs="0" maxOccurs="1" nillable="true" type="impl:assetIdentifiers"/> </sequence></complexType>
```
## Cascade CMS 8.15
- The `siteImproveIntegrationEnabled`* *property has been added to the `site` complexType which can be used to enable or disable the Siteimprove Integration for the site.
- The `accessSiteImproveIntegration` ability has been added to the `site-abilities`* *complexType which can be used to restrict user/group access to the Siteimprove Integration when viewing folders and pages.
## Cascade CMS 8.14
- Results from the `readAudits` operation will now default to one week's worth of audits in the cases where: 1) no `startDate` or `endDate` are provided, or 2) an `endDate` is provided *without* a `startDate`. Otherwise, all audits within the provided date range will be returned.
- New `entityTypeString` enumeration values: `workflowemail` and `workflowemailcontainer`
- New properties added to `workflow`:```completedWorkflowEmailId` (string)
- `completedWorkflowEmailPath` (string)
- `notificationWorkflowEmailId` (string)
- `notificationWorkflowEmailPath` (string)
New properties added to `workflowDefinition`:
``
- `completedWorkflowEmailId` (string)
- `completedWorkflowEmailPath` (string)
- `notificationWorkflowEmailId` (string)
- `notificationWorkflowEmailPath` (string)
New string property added to `site` :`````rootWorkflowEmailContainerId`New boolean property in `site-abilities`: `accessWorkflowEmails`New complex types: `workflowEmail` and `workflowEmailContainer`:
```
<complexType name="workflowEmail"> <complexContent> <extension base="impl:containered-asset"> <sequence> <!-- The subject of this email REQUIRED --> <element name="subject" maxOccurs="1" minOccurs="1" type="xsd:string"/> <!-- The body of this email REQUIRED --> <element name="body" maxOccurs="1" minOccurs="1" type="xsd:string"/> </sequence> </extension> </complexContent></complexType><complexType name="workflowEmailContainer"> <complexContent> <extension base="impl:containered-asset"> <sequence> <!-- the array of children --> <element name="children" maxOccurs="1" minOccurs="0" nillable="true" type="impl:container-children"/> </sequence> </extension> </complexContent></complexType>
```
## Cascade CMS 8.12
- In cases where structured data nodes have been removed from the Data Definition, but are still persisted with the asset, the nodes will be moved to the root level of `structured-data-nodes` and its `identifier` property will be changed to a static value of `<legacy>`.
- When reading an asset with structured data nodes, a `structured-data-node` will now be returned for all fields. This means that if a given asset is missing a value for a field, a `structured-data-node` with that field's default value will be returned.
## Cascade CMS 8.11
- The `dynamic-metadata-field-definition-value` complexType has an new `label` element allowing Dynamic Metadata Field items to be configured with an alternative label to coincide with a value.
- The `dynamic-metadata-field-type` simpleType now has an additional `datetime` value
- New properties added to `site`:`````accessibilityCheckerEnabled` (boolean)
- `widenDamIntegrationEnabled` (boolean)
- `widenDamIntegrationCategory` (string)
- `webdamDamIntegrationEnabled` (boolean)
- `rootSharedFieldContainerId` (string)``
New `entityTypeString` enumeration values: `sharedfield` and `sharedfieldcontainer```New boolean property in `site-abilities`: `accessSharedFields```````New complex type properties in `asset`: `sharedField` and `sharedFieldContainer`New complex types: `sharedField`, `sharedFieldContainer``<complexType name="sharedField">
<complexContent>
<extension base="impl:containered-asset">
<sequence>
<!-- The XML content of this shared field REQUIRED -->
<element name="xml" maxOccurs="1" minOccurs="1" type="xsd:string"/>
</sequence>
</extension>
</complexContent>
</complexType>
<complexType name="sharedFieldContainer">
<complexContent>
<extension base="impl:containered-asset">
<sequence>
<!-- the array of children -->
<element name="children" maxOccurs="1" minOccurs="0" nillable="true" type="impl:container-children"/>
</sequence>
</extension>
</complexContent>
</complexType>`
## Cascade CMS 8.9.1
- The `read` SOAP operation will now correctly return `<tag>` elements within `<tags>` for an assets with tags.
- The `listSubscribers` SOAP operation will now correctly return `<assetIdentifier>` elements within `<manualSubscribers>`
## Cascade CMS 8.9
#### Content Tags
The `indexBlock` complexType has a new boolean field called `indexTags` which specifies whether or not the block should render tags assigned to assets being indexed.
The `folder-contained-asset` complexType has a new field called `tags` which is used to read/edit tags associated with an asset.
There are also two new complexTypes, `tags` and `tag`, which are used to structure the tags assigned to an asset.
#### Related Asset Publishing
The `contentType` complexType has two new fields, `publishSetId` and `publishSetPath`, used to associate a Publish Set with the Content Type.
The `listSubscribers` operation has a new field called `manualSubscribers` to include relationships that are manually added to an asset.
The `publish` operation has a two new boolean fields:
- `publishRelatedAssets` - includes related assets in the publish job
- `publishRelatedPublishSet` - includes the Publish Set associated with the given Page's Content Type
#### Asset Review Scheduling
The `folder-contained-asset` complexType's `reviewEvery` property is now validated to ensure the provided value is: 0, 30, 90, 180, or 365.
#### System Preferences
When updating system preferences using the `editPreference` operation, the `system_pref_system_url` preference will be validated to ensure the provided `value` is a valid URL.
## Cascade CMS 8.8
#### Siteimprove Settings
The *siteImproveUrl** *property has been added to the *site* complexType which can be used to overwrite the Site URL if it differs from the URL specified within Siteimprove.
#### System Dictionary
A new ability,* modifyDictionary*,* *has been added to the *global-abilities *complexType to match new abilities available in the UI related to allowing users the ability to modify the System Dictionary.
## Cascade CMS 8.7
#### Asset Naming Rules
The following properties have been added to *site* asset:
- *inheritNamingRules*
- *namingRuleCase*
- *namingRuleSpacing*
- *namingRuleAssets*
#### Scheduling properties
Properties *reviewOnSchedule* and *reviewEvery* belong now to *dublin-aware-asset* rather than *folder-contained-asset*. This means that *references*, *formats* and *templates* no longer have these properties.
#### Move/rename workflow type
The *workflowDefinition* asset has a new boolean property: *move*.
## Cascade CMS 8.6
#### Extensions to Strip
The *extensionsToStrip** *property has been added to the *destination* and *site* complexTypes which can be used to remove extension(s) from links managed by Cascade CMS during publish.
#### LDAP Users
The *ldapDN* property has been added to the *user* compexType which can be used to update an existing LDAP User's binding DN, or manually create new LDAP Users using Web Services.
## Cascade CMS 8.5
#### Metadata Field Help Text
Metadata help text fields are now available for read/edit via web services to match the UI.  Fields *authorFieldHelpText, descriptionFieldHelpText, displayNameFieldHelpText, endDateFieldHelpText, expirationFolderFieldHelpText, keywordsFieldHelpText, reviewDateFieldHelpText, startDateFieldHelpText, summaryFieldHelpText, teaserFieldHelpText, *and* titleFieldHelpText* have been added to the* metadataSet *complexType and field *helpText *has been added to the*dynamicMetadataFieldDefinition *complexType to facilitate reading/editing help text.
#### Scheduled Asset Review
Configuring scheduled asset reviews is now available via web services.  The *reviewOnSchedule* and *reviewEvery *properties have been added to the *folder-contained-asset* complexType which can be used to enable and configure the scheduling of reviews on home area assets.
## Cascade CMS 8.4.1.2ccc4d6
In 8.4.1.2ccc4d6, it is possible to configure whether or not folders should be included in the Stale Content Report. This setting is available at a folder level through the "includeInStaleContent" property:
`` `<element name="includeInStaleContent" maxoccurs="1" minoccurs="0" nillable="true" type="xsd:boolean"></element>`
## Cascade CMS 8.3
#### WYSIWYG Editor Configurations
Customizable WYSIWYG Configurations, added in Cascade 8.3, can be manipulated via web services operations like most other assets in the system.  The available fields are displayed below:
`<complexType name="editorConfiguration">
<complexContent>
<extension base="impl:named-asset">
<sequence>
<!-- The Site in which the asset is located NOT REQUIRED when referencing the System Default Editor Configuration (id=DEFAULT, name=Default) One is REQUIRED for all other Editor Configurations -->
<element maxOccurs="1" minOccurs="0" name="siteId" nillable="true" type="xsd:string"></element>
<element maxOccurs="1" minOccurs="0" name="siteName" nillable="true" type="xsd:string"></element>
<!-- File containing css for the WYSIWYG editor Priority: cssFileId > cssFilePath NOT REQUIRED -->
<!-- When editing and selected asset is recycled, it is recommended to preserve this relationship by providing selected asset's id in case if the selected asset gets restored from the recycle bin. -->
<element maxOccurs="1" minOccurs="0" name="cssFileId" type="xsd:string"></element>
<!-- Path works only for non-recycled assets -->
<element maxOccurs="1" minOccurs="0" name="cssFilePath" type="xsd:string"></element>
<!-- NOT REQUIRED: For reading purposes only. Ignored when editing, copying etc. -->
<element maxOccurs="1" minOccurs="0" name="cssFileRecycled" type="xsd:boolean"></element>
<!-- JSON String for the configuration -->
<element maxOccurs="1" minOccurs="1" name="configuration" nillable="false" type="xsd:string"></element>
</sequence>
</extension>
</complexContent>
</complexType>`
A *listEditorConfigurations* operation has also been added which allows script writers to access all Wysiwyg Editor Configurations contained in a particular Site.
With the addition of WYSIWYG configurations, all WYSIWYG related properties on Groups and Sites have been removed.  Sites and Content Types have new properties *defaultEditorConfigurationId/defaultEditorConfigurationPath* and *editorConfigurationId/editorConfigurationPath* respectively, which allow editor configurations to be assigned to those asset types via web services.
New abilities* accessEditorConfigurations and bypassWysiwygEditorRestrictions *have been added to the *sites-abilities* complexType and the *accessDefaultEditorConfiguration* ability has been added to *global-abilities *to match new abilities available in the UI related to WYSIWYG configurations.
#### Global Area Cleanup and Other Misc Updates
In an effort to clean up remnants of the Global Area, most of the old Global Area abilities on Roles that are no longer applicable have been removed from the *global-abilities* complexType.
The *defaultGroup* property has also been removed from User objects as it has been removed from the system entirely.
The *accessAudits* ability has been added to the *global-abilities *complexType to match the UI.
## Cascade CMS 8.1.1
- Fixed: Blocks can not be read if underlying Data Definition has a field added to it
## Cascade CMS 8.1
#### Search Updates
The Web Services search API has been updated to mirror the new Advanced Search UI added in Cascade 8.0.  
It's now possible to filter search results by specific types, specific fields, and/or a specific site.  Search terms behave identically to how they behave in the UI.  Multi-word phrases can be searched for by surrounding the terms in double-quotes.  Unquoted terms will be matched individually.  For example, "mouse rat" will exactly match the phrase "mouse rat", but mouse rat will match mouse or rat or both.
Note that single term searches in 8.1 will also include partial word matches.  So, searching for housewill match milhouse and houseboat.  This did not happen in 8.0.x.
The "searchInformation" complexType has been changed to the following which more closely matches the new Advanced Search UI:
`<complexType name="searchInformation">
<sequence>
<element maxOccurs="1" minOccurs="1" name="searchTerms" type="xsd:string"></element>
<!-- Id or name of the site to search
NOT REQUIRED, if left blank, all sites will be searched -->
<element maxOccurs="1" minOccurs="0" name="siteId" nillable="false" type="xsd:string"></element>
<element maxOccurs="1" minOccurs="0" name="siteName" nillable="false" type="xsd:string"></element>
<!-- Asset fields to search (e.g. name, title, content), see searchField simpleType for valid values NOT REQUIRED -->
<element maxOccurs="1" minOccurs="0" name="searchFields" nillable="false" type="impl:searchFields"></element>
<!-- Asset types to search (e.g. page, folder, site) NOT REQUIRED, if left blank, all asset types will be searched -->
<element maxOccurs="1" minOccurs="0" name="searchTypes" nillable="false" type="impl:searchTypes"></element>
</sequence>
</complexType>`
Notice the elements to specify a site by either id or name, the element to specify the types of assets to match, and the element to specify the fields to match.
The searchTypes element can be populated with any of the values that already exist in the entityTypeString simpleType.
The searchFields element can be populated with any values present in the newly addedsearchFieldString simpleType displayed below.
`<simpleType name="searchFieldString">
<restriction base="xsd:string">
<!-- Basic fields -->
<enumeration value="name"/>
<enumeration value="path"/>
<enumeration value="createdBy"/>
<enumeration value="modifiedBy"/>
<!-- Metadata fields -->
<enumeration value="displayName"/>
<enumeration value="title"/>
<enumeration value="summary"/>
<enumeration value="teaser"/>
<enumeration value="keywords"/>
<enumeration value="description"/>
<enumeration value="author"/>
<!-- File content -->
<enumeration value="blob"/>
<!-- Velocity Format content -->
<enumeration value="velocityFormatContent"/>
<!-- WYSIWYG and Data Definition Page content, Text and XML Block content, Template content, XSLT Format content -->
<enumeration value="xml"/>
<!-- Symlink link text field -->
<enumeration value="link"/>
</restriction>
</simpleType>`
## Cascade CMS 8.0
#### Asset Factory Descriptions
With the addition of the "description" field for Asset Factories and Asset Factory Containers in the UI, the WSDL has been updated to allow configuring that field via web services.
`<element maxOccurs="1" minOccurs="0" name="description" type="xsd:string"></element>`
#### Goodbye Global!
With the removal of the Global Area from the system, all existing complexTypes containing a siteName and siteId now require that at least one of those fields be populated.  This includes all home area assets and site management components.  Note that this is not enforced in the WSDL but is enforced by the server whenever an edit or create operation is performed.
#### Ability Updates
The existing "accessAdminArea" global ability has been renamed to "accessManageSiteArea" and a new ability with the old name, "accessAdminArea", has been added which governs access to the new System Administration area and not the Manage Site area as the renamed ability does.
The New Site wizard and Site Migration wizard tools have been removed from the system and their corresponding global abilities in the WSDL, "newSiteWizard" and "siteMigration", have also been removed.
The Recycle Bin Checker and Path Repair database tools have also been removed from the system and their global abilities, "recycleBinChecker" and "pathRepairTool", have likewise been removed from the WSDL.
#### Search Updates
Search via the UI has been revamped; however, the WSDL has **not** yet been updated to be compatible with the new search functionality.  Searching via web services will be unpredictable at best and will outright fail at worst.  Stay tuned for search updates in a future release!
## Pre 8.0 Changelog
For all changes to the Cascade CMS SOAP Web Services API prior to Cascade CMS 8, see the previous changelog.
## Related Links
- Web Services Changelog

---

### SOAP Web Services Operations

## Introduction to Web Services Operations
When looking through the WSDL, you can find all of the operations available along with their responses at the top. Every operation is represented by an `<element>` block with the corresponding name for the operation; the response is simply the name of the operation with a "Response" suffix.
The responses contain an "operationResult", which is described by the following complexType in the WSDL:
```
<complexType name="operationResult"> <sequence> <element maxOccurs="1" name="success" type="xsd:string"></element> <element maxOccurs="1" name="message" nillable="true" type="xsd:string"></element> </sequence> </complexType>
```
This WSDL describes that inside the corresponding element (i.e. "editReturn") will appear two more elements: "success", which will be either "true" or "false", and a "message" element that will contain a relevant message from the server (generally only non-nill when the operation failed).
## Authentication
For each operation, it is necessary to include authentication information. This is specified by the required "authentication" element seen in every request type. Looking further in the WSDL, we see the following:
```
<complexType name="authentication"> <sequence> <element minOccurs="0" name="password" nillable="false" type="xsd:string"></element> <element minOccurs="0" name="username" nillable="false" type="xsd:string"></element> <element minOccurs="0" name="apiKey" nillable="false" type="xsd:string"></element> </sequence> </complexType>
```
This complex type corresponds to this authentication element. The authentication type must contain one of: username and password OR apiKey, which are each of the type String. This is used by Cascade CMS to authenticate the user making the SOAP request and to ensure that the user has the proper permissions to carry out that operation.
Example:
```
<m:authentication>  <m:username>admin</m:username>  <m:password>admin</m:password> </m:authentication><!-- OR --><m:authentication>  <m:apiKey>27c03f58-7c79-45d1-aa8f-76d697bbb10d</m:apiKey> </m:authentication>
```
## Operation Overview
Creating and Editing are two very similar operations. Looking at the WSDL, we see both the "create" and "edit" operations take two sub-elements: authentication (discussed above) and asset. Asset is a universal classification for all Cascade CMS assets and for including workflow information (when necessary). Looking at the "asset" complexType , we see the following:
```
<!-- asset is an aggregate type that includes all possible Cascade CMS assets bundled with workflow configuration. When a user does not have the privileges to bypass workflow, this configuration is used to configure the step assignments of the workflow --><complexType name="asset"> <sequence> <element maxOccurs="1" minOccurs="0" name="workflowConfiguration" type="impl:workflow-configuration"></element> <choice> <element maxOccurs="1" minOccurs="1" name="feedBlock" nillable="true" type="impl:feedBlock"></element> <element maxOccurs="1" minOccurs="1" name="indexBlock" nillable="true" type="impl:indexBlock"></element> <element maxOccurs="1" minOccurs="1" name="textBlock" nillable="true" type="impl:textBlock"></element> <element maxOccurs="1" minOccurs="1" name="xhtmlDataDefinitionBlock" nillable="true" type="impl:xhtmlDataDefinitionBlock"></element> <element maxOccurs="1" minOccurs="1" name="xmlBlock" nillable="true" type="impl:xmlBlock"></element> <element maxOccurs="1" minOccurs="1" name="file" nillable="true" type="impl:file"></element> <element maxOccurs="1" minOccurs="1" name="folder" nillable="true" type="impl:folder"></element> <element maxOccurs="1" minOccurs="1" name="page" nillable="true" type="impl:page"></element> <element maxOccurs="1" minOccurs="1" name="reference" nillable="true" type="impl:reference"></element> <element maxOccurs="1" minOccurs="1" name="xsltFormat" nillable="true" type="impl:xsltFormat"></element> <element maxOccurs="1" minOccurs="1" name="scriptFormat" nillable="true" type="impl:scriptFormat"></element> <element maxOccurs="1" minOccurs="1" name="symlink" nillable="true" type="impl:symlink"></element> <element maxOccurs="1" minOccurs="1" name="template" nillable="true" type="impl:template"></element> <!-- admin area assets (must be manager or higher to access, no workflowConfiguration needed --> <element maxOccurs="1" minOccurs="1" name="user" nillable="true" type="impl:user"></element> <element maxOccurs="1" minOccurs="1" name="group" nillable="true" type="impl:group"></element> <element maxOccurs="1" minOccurs="1" name="role" nillable="true" type="impl:role"></element> <element maxOccurs="1" minOccurs="1" name="assetFactory" nillable="true" type="impl:assetFactory"></element> <element maxOccurs="1" minOccurs="1" name="assetFactoryContainer" nillable="true" type="impl:assetFactoryContainer"></element> <element maxOccurs="1" minOccurs="1" name="contentType" nillable="true" type="impl:contentType"></element> <element maxOccurs="1" minOccurs="1" name="contentTypeContainer" nillable="true" type="impl:contentTypeContainer"></element> <element maxOccurs="1" minOccurs="1" name="connectorContainer" nillable="true" type="impl:connectorContainer"></element> <element maxOccurs="1" minOccurs="1" name="twitterConnector" nillable="true" type="impl:twitterConnector"></element> <element maxOccurs="1" minOccurs="1" name="facebookConnector" nillable="true" type="impl:facebookConnector"></element> <element maxOccurs="1" minOccurs="1" name="wordPressConnector" nillable="true" type="impl:wordPressConnector"></element> <element maxOccurs="1" minOccurs="1" name="googleAnalyticsConnector" nillable="true" type="impl:googleAnalyticsConnector"></element> <element maxOccurs="1" minOccurs="1" name="pageConfigurationSet" nillable="true" type="impl:pageConfigurationSet"></element> <element maxOccurs="1" minOccurs="1" name="pageConfigurationSetContainer" nillable="true" type="impl:pageConfigurationSetContainer"></element> <element maxOccurs="1" minOccurs="1" name="dataDefinition" nillable="true" type="impl:dataDefinition"></element> <element maxOccurs="1" minOccurs="1" name="dataDefinitionContainer" nillable="true" type="impl:dataDefinitionContainer"></element> <element maxOccurs="1" minOccurs="1" name="sharedField" nillable="true" type="impl:sharedField"></element> <element maxOccurs="1" minOccurs="1" name="sharedFieldContainer" nillable="true" type="impl:sharedFieldContainer"></element> <element maxOccurs="1" minOccurs="1" name="metadataSet" nillable="true" type="impl:metadataSet"></element> <element maxOccurs="1" minOccurs="1" name="metadataSetContainer" nillable="true" type="impl:metadataSetContainer"></element> <element maxOccurs="1" minOccurs="1" name="publishSet" nillable="true" type="impl:publishSet"></element> <element maxOccurs="1" minOccurs="1" name="publishSetContainer" nillable="true" type="impl:publishSetContainer"></element> <element maxOccurs="1" minOccurs="1" name="target" nillable="true" type="impl:target"></element> <element maxOccurs="1" minOccurs="1" name="siteDestinationContainer" nillable="true" type="impl:siteDestinationContainer"></element> <element maxOccurs="1" minOccurs="1" name="destination" nillable="true" type="impl:destination"></element> <element maxOccurs="1" minOccurs="1" name="fileSystemTransport" nillable="true" type="impl:fileSystemTransport"></element> <element maxOccurs="1" minOccurs="1" name="ftpTransport" nillable="true" type="impl:ftpTransport"></element> <element maxOccurs="1" minOccurs="1" name="databaseTransport" nillable="true" type="impl:databaseTransport"></element> <element maxOccurs="1" minOccurs="1" name="cloudTransport" nillable="true" type="impl:cloudTransport"></element> <element maxOccurs="1" minOccurs="1" name="transportContainer" nillable="true" type="impl:transportContainer"></element> <element maxOccurs="1" minOccurs="1" name="workflowDefinition" nillable="true" type="impl:workflowDefinition"></element> <element maxOccurs="1" minOccurs="1" name="workflowDefinitionContainer" nillable="true" type="impl:workflowDefinitionContainer"></element> <element maxOccurs="1" minOccurs="1" name="workflowEmail" nillable="true" type="impl:workflowEmail"></element> <element maxOccurs="1" minOccurs="1" name="workflowEmailContainer" nillable="true" type="impl:workflowEmailContainer"></element> <element maxOccurs="1" minOccurs="1" name="twitterFeedBlock" nillable="true" type="impl:twitterFeedBlock"></element> <!-- other assets --> <element maxOccurs="1" minOccurs="1" name="site" nillable="true" type="impl:site"></element> <element maxOccurs="1" minOccurs="1" name="editorConfiguration" nillable="true" type="impl:editorConfiguration"></element> </choice> </sequence> </complexType>
```
First, there is the workflowConfiguration element. This is necessary when the user executing the SOAP request does not have the required permissions to bypass workflow, and the operation is subject to workflow. For more information about workflow and SOAP, please see Workflow and Web Services Operations.
Next, there is the choice element that specifies that the user has a choice between all these assets, and each one corresponds to a specific asset type in Cascade CMS. Note that due to the choice element wrapping these elements and the maxOccurs="1" and minOccurs="1" attributes, only one asset may be specified at a time. If you wish to do bulk creation/editing, see the Batch Operation.
## Read Operation
All read operations conform to the following WSDL:
```
<element name="read"> <complexType> <sequence> <element name="authentication" type="impl:authentication"></element> <element name="identifier" type="impl:identifier"></element> </sequence> </complexType> </element>
```
Authentication has been discussed before, in the Authentication section.
The identifier complex type is defined in the following WSDL:
```
<complexType name="identifier"> <sequence> <choice> <element maxOccurs="1" name="id" type="xsd:string"></element> <element maxOccurs="1" name="path" type="impl:path"></element> </choice> <element maxOccurs="1" minOccurs="1" name="type" type="impl:entityTypeString"></element> </sequence> </complexType>
```
An identifier is a composite type used to identify a single asset in Cascade CMS. It melds an ID or Path, and a type.
When using a Path as an identifer, you must use a Path type, which is a string of the path, and a Site name or Site ID:
```
<complexType name="path"> <sequence> <element maxOccurs="1" name="path" type="xsd:string"></element> <choice> <element maxOccurs="1" name="siteId" nillable="true" type="xsd:string"></element> <element maxOccurs="1" name="siteName" nillable="true" type="xsd:string"></element> </choice> </sequence> </complexType>
```
The type is defined by the following enumeration:
```
<simpleType name="entityTypeString"> <restriction base="xsd:string"> <enumeration value="assetfactory"/> <enumeration value="assetfactorycontainer"/> <enumeration value="block"/> <enumeration value="block_FEED"/> <enumeration value="block_INDEX"/> <enumeration value="block_TEXT"/> <enumeration value="block_XHTML_DATADEFINITION"/> <enumeration value="block_XML"/> <enumeration value="block_TWITTER_FEED"/> <enumeration value="connectorcontainer"/> <enumeration value="twitterconnector"/> <enumeration value="facebookconnector"/> <enumeration value="wordpressconnector"/> <enumeration value="googleanalyticsconnector"/> <enumeration value="contenttype"/> <enumeration value="contenttypecontainer"/> <enumeration value="destination"/> <enumeration value="editorconfiguration"/> <enumeration value="file"/> <enumeration value="folder"/> <enumeration value="group"/> <enumeration value="message"/> <enumeration value="metadataset"/> <enumeration value="metadatasetcontainer"/> <enumeration value="page"/> <enumeration value="pageconfigurationset"/> <enumeration value="pageconfiguration"/> <enumeration value="pageregion"/> <enumeration value="pageconfigurationsetcontainer"/> <enumeration value="publishset"/> <enumeration value="publishsetcontainer"/> <enumeration value="reference"/> <enumeration value="role"/> <enumeration value="datadefinition"/> <enumeration value="datadefinitioncontainer"/> <enumeration value="sharedfield"/> <enumeration value="sharedfieldcontainer"/> <enumeration value="format"/> <enumeration value="format_XSLT"/> <enumeration value="format_SCRIPT"/> <enumeration value="site"/> <enumeration value="sitedestinationcontainer"/> <enumeration value="symlink"/> <enumeration value="target"/> <enumeration value="template"/> <enumeration value="transport"/> <enumeration value="transport_fs"/> <enumeration value="transport_ftp"/> <enumeration value="transport_db"/> <enumeration value="transport_cloud"/> <enumeration value="transportcontainer"/> <enumeration value="user"/> <enumeration value="workflow"/> <enumeration value="workflowdefinition"/> <enumeration value="workflowdefinitioncontainer"/> <enumeration value="workflowemail"/> <enumeration value="workflowemailcontainer"/> </restriction></simpleType>
```
## Delete Operation
The delete operation is just like the read operation in that it contains an identifier. The WSDL describing the delete operation is as follows:
```
<complexType name="delete"> <sequence> <element maxOccurs="1" minOccurs="0" name="workflowConfiguration" type="impl:workflow-configuration"></element> <element maxOccurs="1" minOccurs="1" name="identifier" type="impl:identifier"></element> <element maxOccurs="1" minOccurs="0" name="deleteParameters" type="impl:deleteParameters"></element> </sequence> </complexType>
```
The delete operation contains workflow information and an identifier, which are discussed in the Workflow and Web Services Operations and Read Operation sections, respectively.
## Move Operation
The move operation is just like the delete operation in that it contains an identifier. The WSDL describing the move operation is as follows:
```
<complexType name="move"> <sequence> <element maxOccurs="1" minOccurs="1" name="identifier" nillable="false" type="impl:identifier"></element> <element maxOccurs="1" minOccurs="1" name="moveParameters" nillable="false" type="impl:moveParameters"></element> <element maxOccurs="1" minOccurs="0" name="workflowConfiguration" nillable="false" type="impl:workflow-configuration"></element> </sequence></complexType>
```
The move operation contains workflow information and an identifier, which are discussed in the Workflow and Web Services Operations and Read Operation sections, respectively.
## Publish Operation
The publish operation is very similar to the read and delete operation:
```
<complexType name="publish"> <sequence> <element name="identifier" nillable="true" type="impl:identifier"></element> </sequence> </complexType>
```
This time the publish operation only takes an identifier and no workflow information. The identifier must reference only publishable assets: a file, folder, or page. Also, it is possible to specify a target, destination, or publish set by using the types target, destination, or publishset in the identifier. The user included in the authentication information must be of the publisher role or higher; otherwise they will not be able to publish and receive an response indicating a failure.
## Batch Operation
The batch operation is a simple way of accomplishing multiple operations while only transmitting a single SOAP request/response. Here is the WSDL for the "batch" element:
```
<element name="batch"> <complexType> <sequence> <element maxOccurs="1" minOccurs="1" name="authentication" type="impl:authentication"></element> <element maxOccurs="unbounded" name="operation" type="impl:operation"></element> </sequence> </complexType> </element>
```
Authentication has already been discussed; what is important here is the ability to specify any number of "operation" elements, each of which map to the "operation" complex type:
```
<complexType name="operation"> <choice> <element name="create" type="impl:create"></element> <element name="delete" type="impl:delete"></element> <element name="edit" type="impl:edit"></element> <element name="publish" type="impl:publish"></element> <element name="read" type="impl:read"></element> </choice> </complexType>
```
The operation complex type is simply an aggregate of all the other operation types available.
Here is a sample batch request:
```
<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"> <SOAP-ENV:Body> <m:batch xmlns:m="http://www.hannonhill.com/ws/ns/AssetOperationService"> <m:authentication> <m:password>admin</m:password> <m:username>admin</m:username> </m:authentication> <m:operation> <m:create> <m:asset> <m:page> <m:name>default</m:name> <m:parentFolderPath>/intranet</m:parentFolderPath> <m:path>/intranet/default</m:path> <m:metadata> <m:author>Zach Bailey</m:author> </m:metadata> <m:metadataSetId>ROOT</m:metadataSetId> <m:shouldBePublished>true</m:shouldBePublished> <m:shouldBeIndexed>true</m:shouldBeIndexed> <m:xhtml><![CDATA[<p>Welcome to my page!</p>]]></m:xhtml> </m:page> </m:asset> </m:create> <m:publish> <m:identifier> <m:path>/intranet/default</m:path> <m:type>page</m:type> </m:identifier> </m:publish> </m:operation> </m:batch> </SOAP-ENV:Body> </SOAP-ENV:Envelope>
```
This batch request edits the /intranet/default page and then publishes those changes.
## Workflow and Web Services Operations
When a user making an edit, create, or delete request does not have the role/permission to bypass workflow, it is necessary to include workflow information in the request message.
```
<complexType name="workflow-configuration"> <sequence> <element maxOccurs="1" minOccurs="1" name="workflowName" type="xsd:string"></element> <choice> <element maxOccurs="1" minOccurs="1" name="workflowDefinitionId" type="xsd:string"></element> <element maxOccurs="1" minOccurs="1" name="workflowDefinitionPath" type="xsd:string"></element> </choice> <element maxOccurs="1" minOccurs="1" name="workflowComments" type="xsd:string"></element> <element maxOccurs="1" minOccurs="0" name="workflowStepConfigurations" type="impl:workflow-step-configurations"></element> </sequence> </complexType>
```
This complex type allows the user to specify what to name the workflow instance and what workflow definition to use when instantiating workflow. Additionally, the user must provide workflow comments explaining the action and any workflow step configuration.
Configuring the Workflow Steps
The workflowStepConfigurations element corresponds to the following workflow-step-configurations complex type:
```
<complexType name="workflow-step-configurations"> <sequence> <element maxOccurs="unbounded" name="workflowStepConfiguration" type="impl:workflow-step-configuration"></element> </sequence> </complexType>
```
This complex type is just a list of workflowStepConfiguration elements which correspond to workflow-step-configuration complex types:
```
<complexType name="workflow-step-configuration"> <sequence> <element maxOccurs="1" minOccurs="1" name="stepIdentifier" type="xsd:string"></element> <element maxOccurs="1" minOccurs="1" name="stepAssignment" type="xsd:string"></element> </sequence> </complexType>
```
This allows the user to re-assign workflow steps with a given identifier (using the stepIdentifier element) to a given user or group (using the stepAssignment element). If no workflow step configurations are supplied, the workflow will be initialized with the default values for each step. If no default values are specified in the workflow definition, the user will receive an error explaining that the workflow's steps must be configured.
### Transitioning Between Workflow Steps
Workflow steps can be transistions with web services using the performWorkflowTransition call.  This call requires the workflowTransitionInformation complex type:
```
<complexType name="workflowTransitionInformation"> <sequence> <!-- REQUIRED: The id of the workflow to perform the transition on --> <element maxOccurs="1" minOccurs="1" name="workflowId" type="xsd:string"></element> <!-- REQUIRED: The identifier of the action to transition to --> <element maxOccurs="1" minOccurs="1" name="actionIdentifier" type="xsd:string"></element> <!-- NOT REQUIRED: The user's comment about the transition taken --> <element maxOccurs="1" minOccurs="0" name="transitionComment" nillable="true" type="xsd:string"></element> </sequence> </complexType>
```
## Search Operation
The search operation is defined by the following WSDL:
```
<element name="search"> <complexType> <sequence> <element name="authentication" type="impl:authentication"></element> <element name="searchInformation" type="impl:searchInformation"></element> </sequence> </complexType> </element>
```
This operation contains authentication information and `searchInformation`.
The `searchInformation` complex type, and related types, are defined as follows:
```
<complexType name="searchInformation"> <sequence> <element maxOccurs="1" minOccurs="1" name="searchTerms" type="xsd:string"></element> <!--Id or name of the site to search NOT REQUIRED, if left blank, all sites will be searched--> <element maxOccurs="1" minOccurs="0" name="siteId" nillable="false" type="xsd:string"></element> <element maxOccurs="1" minOccurs="0" name="siteName" nillable="false" type="xsd:string"></element> <!--Asset fields to search (e.g. name, title, content), see searchField simpleType for valid values NOT REQUIRED--> <element maxOccurs="1" minOccurs="0" name="searchFields" nillable="false" type="impl:searchFields"></element> <!--Asset types to search (e.g. page, folder, site) NOT REQUIRED, if left blank, all asset types will be searched--> <element maxOccurs="1" minOccurs="0" name="searchTypes" nillable="false" type="impl:searchTypes"></element> </sequence></complexType><complexType name="searchFields"> <sequence> <element maxOccurs="unbounded" minOccurs="0" name="searchField" nillable="false" type="impl:searchFieldString"></element> </sequence></complexType><complexType name="searchTypes"> <sequence> <element maxOccurs="unbounded" minOccurs="0" name="searchType" nillable="false" type="impl:entityTypeString"></element> </sequence></complexType><simpleType name="searchFieldString"> <restriction base="xsd:string"> <!--Basic fields--> <enumeration value="name"/> <enumeration value="path"/> <enumeration value="createdBy"/> <enumeration value="modifiedBy"/> <!--Metadata fields--> <enumeration value="displayName"/> <enumeration value="title"/> <enumeration value="summary"/> <enumeration value="teaser"/> <enumeration value="keywords"/> <enumeration value="description"/> <enumeration value="author"/> <!--File content--> <enumeration value="blob"/> <!--Velocity Format content--> <enumeration value="velocityFormatContent"/> <!--WYSIWYG and Data Definition Page content, Text and XML Block content, Template content, XSLT Format content--> <enumeration value="xml"/> <!--Symlink link text field--> <enumeration value="link"/> </restriction></simpleType>
```
This `searchInformation` complex type, and related types, contain all the fields that one would find in the Advanced Search screen from within the Cascade CMS web interface.
When executing a  search, Cascade CMS will return a Search Result object:
```
<complexType name="searchResult"> <complexContent> <extension base="impl:operationResult"> <sequence> <element maxOccurs="1" minOccurs="1" name="matches" type="impl:search-matches"></element> </sequence> </extension> </complexContent> </complexType>
```
This complex type contains a type called "search-matches", which is an array of identifiers:
```
<complexType name="search-matches"> <sequence> <element maxOccurs="unbounded" minOccurs="0" name="match" type="impl:identifier"></element> </sequence> </complexType>
```
## Authenticate Operation
The authenticate operation relies on the same authentication type the other Asset Operations use:
```
<element name="authenticate"> <complexType> <sequence> <element name="authentication" type="impl:authentication"></element> </sequence> </complexType> </element>
```
This authentication object contains username, password and apiKey elements; all of which are of type String. Either username and password OR apiKey are required.
**Note** - The Authenticate Operation is implemented in the Security Service, which is a different Cascade CMS Web Services Endpoint than the Endpoint used to accomplish the other operations (Asset Operation Handler). Make sure that when you are sending a request containing this operation that you are sending it to the correct endpoint (Security Service).

---

## Workflows

*8 articles in this category*

### Assign To Workflow Owner Trigger

## Overview
This trigger assigns the following step (the step that will occur as a result of this action) to the user that initiated the workflow. This is particularly useful in the case of a "Reject" / "Request Edits" action where the following step should always be assigned back to the workflow initiator.
## Declaration
```
<trigger class="com.cms.workflow.function.AssignToWorkflowOwner" name="AssignToWorkflowOwner"/>
```
## Usage
```
<trigger name="AssignToWorkflowOwner"/>
```
## Parameters
None.

---

### Assigning Workflows

## Overview
In Cascade CMS, workflows can either be used as part of an Asset Factory for the creation of new content, or assigned to a folder to control actions taken on contained content.
## Assigning a Workflow to an Asset Factory
You can use "Create" type Workflow Definitions in conjunction with Asset Factories to ensure a workflow is triggered when specific types of content are created, regardless of their placement folder. For example: You might attach a Workflow Definition containing a Marketing approval step to an Asset Factory responsible for creating press releases.
To assign a workflow to an Asset Factory:
1. Navigate to **Manage Site** > **Asset Factories**.
2. Select the Asset Factory and click **Edit**.
3. Under **Settings** > **Workflow Mode** choose **Selected workflow definition**.
4. Under **Workflow Definition**, select a workflow using the chooser.
5. Click **Submit**.
**Note** - Workflow Definitions assigned at the Asset Factory level will supercede any workflows applied to or inherited by the new content's placement folder.
## Assigning a Workflow to a Folder
Workflows aren't applicable to folder assets themselves, but they're assigned at the folder level and affect actions taken on content contained in that folder. You can assign multiple Workflow Definitions of all types to a folder; the type of action taken and the Workflow Definition's Applicable Groups will control which workflows are triggered for a user.
To assign a workflow to a folder:
1. While viewing the folder, click **More** > **Workflows** or right-click on the folder and select **Workflows** from the context menu.
2. Click **Choose Workflow Definition** and choose a workflow to assign. You can assign more than one workflow to a folder by choosing additional workflow definitions.
3. Configure the following options: - **Require Workflow on all contained assets** - Any assigned Workflow Definitions will be optional for users unless this setting is enabled. If users aren't permitted to bypass workflow and workflow is required, you must have a Workflow Definition available for each type of action a user might take (Create, Edit, Delete, etc.). - **Inherit Workflow Definitions from containing folders** - This setting allows you to manage workflows from the parent folder down and have subfolders inherit its assigned workflows. This setting isn't applicable to the base folder of a site, but can be used in conjunction with the **Apply setting to contained folders** option to propagate the setting to subfolders.
4. Click **Submit**.
**Note** - When applying workflow settings to multiple folders using **Apply setting to contained folders**, the process will run as a background task. You'll receive a notification once the process is complete.

---

### Custom Workflow Emails

## Overview
Custom Workflow Emails allow you to personalize your workflow notification and completion emails. A WYSIWYG editor plus dropdowns to insert placeholders for workflow details makes it simple to build templates for informative and actionable emails.
When creating a new template, you'll be started off with a basic example to give you an idea of what's possible. From there you can make it your own. Include instructions on what to look for when reviewing content, add a link to the live page for comparison, or add your organization's contact information.
## Creating Workflow Email Templates
To create a Custom Workflow Email:
1. Navigate to **Manage Site** > **Custom Workflow Emails**.
2. Navigate to the container in which the new Custom Workflow Email will be stored, or create a new container using **Add** > **Container**.
3. Click **Add** > **Custom Workflow Email**.
4. Configure the following fields: - **Name** - To make things easier when assigning templates to Workflow Definitions, we recommend including the email type in the name (i.e. "Notification" or "Completion"). - **Parent Container** - The container where your Custom Workflow Email will be stored. - **Email Subject** - The subject line of your email. - **Email Content** - The body of your email. See Workflow Detail Placeholders below for a list of placeholders you can use to populate your email with workflow details.
5. Click **Submit** to save your Custom Workflow Email.
**Note** - The **Insert/edit image** menu supports only **External** links for Custom Workflow Emails. You can use images managed in Cascade CMS, but you must use the fully-qualified, absolute URL to the published image.
## Workflow Detail Placeholders
The following placeholders are available to populate your emails with workflow details: 
| Name | Placeholder | Preview |
| --- | --- | --- |
| Asset Linked to its Cascade CMS Location | `{{ASSET_NAME}}` | [Contact Us](#example) |
| Asset Linked to its Live, Published Location | `{{ASSET_NAME_LIVE}}` | [Biology Faculty Directory](#example) |
| Current Date the Email is Sent | `{{CURRENT_DATE}}` | May 22, 2022 |
| Current Step's Name in the Workflow | `{{WORKFLOW_CURRENT_STEP_NAME}}` | [Editing by Approvers](#example) |
| Due Date | `{{WORKFLOW_DUE_DATE}}` | June 10, 2022 |
| Email Recipient | `{{WORKFLOW_EMAIL_RECIPIENT}}` | [Tessa Smith](#example) |
| History of Steps Passed in the Workflow and Any Comments Along the Way | `{{WORKFLOW_HISTORY}}` | #### History **May 16, 2019** ** [Chris Lee](#example) started workflow "Please review these changes." |
| Latest Comments on the Workflow | `{{WORKFLOW_LATEST_COMMENTS}}` | #### Latest Comments **Comments from [Amanda Sims](#example)** "Please review these changes." |
| Link to the Asset | `{{LINK_TO_ASSET}}` | `https://your.cascadecms.com/entity/open.act?id=d319a0886f000001453872c09d5ecb&type=page` |
| Link to the Workflow | `{{LINK_TO_WORKFLOW}}` | `https://your.cascadecms.com/entity/open.act?id=c228a0897f000001414ea872f06d5efd&type=workflow` |
| Live Link to the Asset | `{{LIVE_LINK_TO_ASSET}}` | `https://www.example.edu/link/to/asset` |
| Owner of the Workflow | `{{WORKFLOW_OWNER}}` | [Britt Wilson](#example) |
| Site Link of the Asset in Workflow | `{{WORKFLOW_SITE_LINK}}` | `https://your.cascadecms.com/entity/open.act?id=c228a0897f000001414ea872f06d5efd&type=folder` |
| Site the Asset in Workflow Belongs to | `{{WORKFLOW_SITE_NAME}}` | [Business Site](#example) |
| Start Date | `{{WORKFLOW_START_DATE}}` | Dec 14, 2022 |
| Step Actions (if any) | `{{WORKFLOW_STEP_ACTIONS}}` | #### Available Actions - [Approve](#example) - [Edit](#example) |
| Step Owner of the Current Workflow Step | `{{WORKFLOW_STEP_OWNER}}` | [Britt Wilson](#example) |
| User Options | `{{WORKFLOW_USER_OPTIONS}}` | #### User Options - [View your dashboard](#example) - View the asset: [Meet the team](#example) - View the workflow screen: [Approve and Publish](#example) |
| Version Comments | `{{VERSION_COMMENTS}}` | #### Version Comments Comments from [Amanda Sims](#example) "Updated title and tags." |
| Workflow with its Link | `{{WORKFLOW_NAME}}` | [News Article Approval: Registration Begins on August 21](#example) |
This table lists all available placeholders, but multiline placeholders are available in the email message body only.
**Note** - When used in an email subject, any placeholders that include a link (ex. `{{WORKFLOW_NAME}}`) will strip out the link and display only the name or label.**Note** - Placeholders that include user information will display the user's full name if found (ex. John Smith), otherwise the user's username will be displayed (ex. john.smith).
## Email Styling Best Practices
- Keep it simple. Using complicated HTML elements that rely on positioning or floats can be hit or miss when displayed across different email clients.
- If you need to position elements, use a `table` instead of a `div`. Avoid empty `td` elements and use `cellpadding` for spacing. You can add a `role="presentation"` attribute to your `table` to avoid screen readers treating it like tabular data.
- While extremely popular in web design, SVG images have limited support among email clients. Use PNG, JPG, or GIF as an alternative.
- Use fully-qualified, absolute links for images and be sure to include `alt` text attributes in case images are blocked by an email client.
- Images can be made responsive by adding the `responsive` class to the `img` tag.
- Use inline styles (optionally, with `!important`) to add or override styling for your content.
- Try to keep your total email size under 100kb to avoid getting caught in spam filters and having email clients such as Gmail clipping your content.
## Using Custom Workflow Emails
Use your Custom Workflow Emails by attaching them to one or more Workflow Definitions in the **Properties** tab under **Custom Workflow Emails**.
When attaching Custom Workflow Emails to a Workflow Definition, you can specify two types of emails: notification** and **completion**.
- **Notification** emails are sent when an Email trigger's mode is `notify` (or not specified) and should be used when a workflow requires the recipient to take action to move a workflow forward.
- **Completion** emails are sent when an Email trigger's mode is `completed` and should be used when a workflow is finished to provide the workflow owner information about the results of the workflow via the comments.

---

### Receiving Workflow Notifications

## Types of Notifications
You can be notified of workflows waiting for you or any of your Groups by email or in the My Workflows dashboard widget.
#### Via Email
A workflow Email trigger can be used to automatically email the next user or group in the workflow process with a message with a link to the workflow. Workflow emails can be customized by creating Custom Workflow Emails.
#### Via My Workflows / My Content
The My Content area or My Workflows dashboard widget will display any waiting workflows for you or your Groups. Workflows are automatically removed once they are advanced and/or reassigned.
####

---

### Sorry, workflow is required to be able to continue but no workflows are available to you.

This error means that the user's Site Role doesn't allow them to Bypass workflow, but there isn't an applicable workflow available for the type of action they're taking.
## If your site uses workflow:
1. Edit the appropriate Workflow Definition and ensure the user's Group is included in the **Groups** field. Only Groups selected there will be permitted to submit assets using that workflow.
2. Ensure there's an appropriate workflow type for the action the user is taking. For example, to delete a page, there must be a Workflow Definition with the type "Delete" applied to or inherited by the asset's parent folder.
3. If the user should be able to skip workflow altogether, edit their appropriate Site Role to enable the **Bypass workflow** ability.
## If your site doesn't use workflow:
If your site doesn't utilize workflow at all, you can disable workflow requirements entirely by following these steps:
1. Right-click the base folder of the site and select **Workflows**.
2. Under "Require workflow for all contained assets" select "No".
3. Check "Apply setting to contained folders" to propagate the change to all subfolders.
4. Click **Submit**.

## Related Links
- Workflows

---

### Workflow Triggers

## Overview
A workflow trigger is a plugin that enhances an action in the workflow process by executing code as the transition from a source step to a destination step occurs. It encapsulates some system logic to accomplish a non-workflow related function.
Cascade CMS comes with a series of pre-defined triggers, and custom plug-in triggers may also be added to execute custom code during a step transition. More than one workflow trigger may be attached to a workflow action.
A trigger may be enhanced by a parameter, which is an optional element that further specifies the system logic that should occur.
## Available Triggers
The following is a list of pre-defined workflow triggers. Click the title of a trigger to learn more about it and for implementation instructions:
1. Assign Step If User TriggerAdvances a workflow to the step specified by the next parameter, if previous step was executed by a specified user.
2. Assign To Content Owner of Asset TriggerAssigns the following step to the content owner of the asset in workflow.
3. Assign To Group Owning Asset TriggerAssigns the following step to the group with write access to the parent folder of the asset in workflow.
4. Assign to Specified Group TriggerThis trigger is used to assign a workflow to a group.
5. Assign To Workflow Owner TriggerAssigns the following step to the user that initiated the workflow.
6. Copy Folder TriggerCopies the parent folder of the asset in workflow into a designated location.
7. Create New Workflow TriggerThis trigger starts new workflows for analogous assets to support translation capabilities or cross-site content synchronization.
8. Delete Parent Folder TriggerThis trigger deletes the parent folder of the asset in workflow as well as all contents of that folder.
9. Delete TriggerThis trigger deletes the asset in the workflow.
10. Email TriggerIncluding this trigger will provide an email notification for the step immediately following.
11. Merge TriggerMerges any changes into the system repository.
12. Preserve Current User TriggerActs as a workaround solution when a workflow is submitted to a group instead of a user.
13. Publish Containing Publish Set TriggerThis trigger is used to publish out publish sets that the asset in workflow is a member of.
14. Publish Parent Folder TriggerPublishes the parent folder of the asset in workflow.
15. Publish Set TriggerPublishes all assets in a designated Publish Set.
16. Publish TriggerPublishes the current asset in workflow (if publishable) to all enabled Destinations available.
17. Unpublish and Delete TriggerAllows for unpublishing content and deleting it at the same time.
18. Version TriggerCreates a version of the page that will be stored as the most current version.

---

### Workflow XML Schema Reference

## System Workflow Definition
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| system-workflow-definition |   | The root tag for Workflow Definitions. | Yes |
### Attribute(s)
| Attribute Name | Values | Description | Req. |
| --- | --- | --- | --- |
| **name** | [string] | The name of the Workflow Definition. | Yes |
| **initial-step** | [step identifier] | The first step in the workflow process – the value here is the identifier for a step. | Yes |
---
## Triggers
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| triggers | system-workflow-definition  | Used to declare workflow triggers to be used later on by actions in the workflow. | No |
## Trigger
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| trigger | triggers, action | Used to execute a process in the CMS pertaining to the content in the workflow process. | No |
### Attribute(s)
| Attribute Name | Values | Description | Req. |
| --- | --- | --- | --- |
| **name** | [string] | The name of the trigger. | Yes |
| **class** | [package name] | The name of the Java class invoked by the trigger. This value is only needed in the initial declaration and not in subsequent invocations. Available triggers can be found on the Triggers listing page. | Yes |
## Steps
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| steps | system-workflow-definition | Used to denote the start of the steps section in the workflow. | Yes |
## Non-ordered Steps
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| non-ordered-steps | system-workflow-definition | Used to organize steps that are not part of the standard order in the workflow. | No |
### Attribute(s)
| Attribute Name | Values | Description | Req. |
| --- | --- | --- | --- |
| identifier | [string] | The name of the step used to refer to in other actions. | Yes |
## Step
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| step | steps, non-ordered-steps | An individual step in the workflow. Typical steps include edit, approval, and publish. | Yes |
### Attribute(s)
| Attribute Name | Values | Description | Req. |
| --- | --- | --- | --- |
| identifier | [string] | An identifying name for the step. | Yes |
| label | [string] | The text displayed on the screen as the title of the step. | Yes |
| type | transition, edit, system | The type of step in the system. | Yes |
| default-user | [user] | A default user to be supplied for this step. | No |
| default-group | [group] | A default group to be supplied for this step. | No |
| restrict-to-type | group, role | Restriction for the user chooser option associated with the step. | No |
| restrict-to-value | [group], Contributor, Approver, Publisher, Administrator | The actual filter for the restrict-to-type. | No |
| allow-user-group-change | true, false | If enabled, this feature allows the user or group assignment for the step to be changed when the workflow is started. | No |
| escalate-to | [string] | The step identifier of the step to escalate the workflow to. | No |
| escalation-hours | [string] | The number of hours to wait in this step before the workflow is escalated. | No |
## Actions
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| actions | step | Available actions for the step. Typical actions included approve, reject, make further changes, and publish. | Yes |
## Action
| Tag Name | Parent Element | Description | Req. |
| --- | --- | --- | --- |
| action | actions | A specific action item for the step. | Yes |
### Attribute(s)
| Attribute Name | Values | Description | Req. |
| --- | --- | --- | --- |
| identifier | [string] | The unique name identifying the action. | Yes |
| label | [string] | The text displayed on the screen as the link a user can click. | Yes |
| move | forward, reverse | The direction for the step to move. | No |
| next-id | [identifier] | The identifier of the next step in which to move. | No |

---

### Workflows Report

## Overview
The Workflows report displays a list of in-progress and/or completed workflows within sites that you can access.
The report defaults to displaying all **In Progress** workflows, but you can use the quick filter tabs at the top to display **Overdue** workflows as well. Additional filtering options are available under **Filter Results**, see "Filtering the Report" for more information.
**Note** - If there are workflows that are in an error state, an **In Error** quick filter tab will appear.
The workflows list provides the following information:
- **Workflow name** - The name of the workflow and a link to the workflow screen.
- **Asset in workflow** - The name of the asset in workflow and a link to the asset.
- **Submitted by** - The name of the user who initiated the workflow (also known as the "workflow owner").
- **Started on** - The date the workflow was initiated. Hover the value for an exact date and time.
- **Due date** - The date the workflow is due. Hover the value for an exact date and time.
## Filtering the Report
The following filters are available for filtering the report:
- **Workflow status** - Display in-progress, completed, or all workflows.
- **From/To** - Display workflows with any activity, such as the date they were initiated or the date they're due, within a specific timeframe.
- **Site** - Display workflows for assets within specified site(s) that you can access.
- **Started by** - Display workflows initiated by specified User(s) (also known as the "workflow owner").
- **Assigned to** - Display workflows currently waiting on specified Users and/or Group(s) (also known as the "current step owner").

---

## Search

*5 articles in this category*

### Full Search and Replace

## Overview
Full Search offers a more fine-tuned search capability than a basic search and includes filters to select Sites, asset types, and asset fields to search. Full Search searches all Home and Administration Area assets across the following fields:
- Username and Full Name
- Author, Owner, Created By, and Modified By
- System Name, Title, and Display Name
- Description
- Keywords
- Tags
- Summary
- Teaser
- Path
- Link
- Asset Type
- Asset ID
- Site and Site ID
- Velocity Format content
- XML content
- Binary Large OBject (BLOB) data
Note that not all fields are applicable for all asset types.
## Conducting a Full Search

To conduct a full search:
1. Enter your search terms in the Search box in the top-right of the Cascade CMS interface and either press Enter or click the **Go to Full Search** link. The list of results will populate as terms are added. - Only those assets for which you have read or write access will be listed. - By default, 20 assets will be listed per page. To jump to another page of results, select a page number or click previous or next below the search results.
2. Optionally, expand the **Advanced Options** menu to use the Site, asset types, and/or asset fields filters to further refine your list of results.
3. Click an asset to view it or right-click an asset to perform actions on it with the context menu.
#### Search Tips
- To match a multi-word phrase like "ice cream", put quotes `""` around your search terms.
- Use `?` as a single-character wildcard. For example, a search for `fac?s` will return "facts" and "faces".
- Use `*` as a multiple-character wildcard. For example, a search for `fac*s` will return "facts", "faces", and "factories".
**Note** - The maximum number of search results is capped at **5000**. If you're hitting this max, we recommend using the Advanced Options to limit the scope of your search operation.
## Replacing Content
The Replace Content feature allows users to quickly change multiple assets at once. To replace content:
1. Select the assets you wish to update from the list of search results and click **Replace Content** at the top of the list.
2. In the Replacement Text field, type the text you wish to replace the search terms with in the assets to be updated. - Text replacement will replace partial matches in content. Replacing the word "app" will replace "apple". - Text replacement is also case insensitive. Replacing the word "house" will replace "House" or "HOUSE".
3. Click **Replace**.
**Note** - Content replacement is only available to users with access to the Administration area and write access to the selected assets. Content replacement will not be processed through workflow.

---

### How do I rebuild my search indexes?

Search indexes can be rebuilt by following these steps:
1. Click **Menu > Administration**.
2. In the **Search** section, click **Search Indexing**.
3. Confirm that your **Index Location** is correct (this directory should exist on the application server directly under the tomcat folder, by default it will be named *indexes*).
4. Check the **Rebuild Search Index** box.
5. Click **Submit**.
At this point a background process will begin to rebuild the search indexes and the following message will appear in the *cascade.log* file:
```
INFO [SearchServiceImpl] Rebuilding search index
```
Once complete, a message similar to the following will appear:
```
INFO [SearchServiceImpl] Rebuilding search index finished in 5 minutes
```
For search indexes to be successfully maintained, the OS user account that starts the Cascade CMS process (found under **Administration > Logs & System Information > User Name**) must have full control of the directory listed in the **Search Index Location** field.
**Note**: This process can take anywhere from a couple of minutes to several hours. It is completely dependent on the size of the database as well as other operations that may be occurring in the system at the time of the rebuild. You can check on the status of the operation (as well as how long it has taken historically) by viewing the Background Tasks Report and filtering by *Task Type: Build Search Index*.**Note**: Search indexes are rebuilt automatically in the event that a Site is renamed or the environment is restarted.
## Related Links
- Search

---

### Packet for query is too large

When uploading a file into Cascade CMS, users may see an error similar to the following message:
```
An error occurred during editing: Error persisting this bean to storage:com.mysql.jdbc.PacketTooBigException: Packet for query is too large(####### > #######). You can change this value on the server by settingthe 'max_allowed_packet'variable.
```
This error means that the file being uploaded is greater than the maximum size allowed by MySQL.
To correct this problem, modify the `max_allowed_packet` value in the *my.cnf */ *my.ini* file (located in the root directory of MySQL) and specify a larger value. For example, in the `[mysqld]` section add:
```
max_allowed_packet=200M
```
MySQL will require a restart after this change has been made. For more information on the `max_allowed_packet` setting, see [MySQL's official documentation](https://dev.mysql.com/doc/refman/8.0/en/server-system-variables.html#sysvar_max_allowed_packet).

---

### Search

The search bar provides an easy way to perform powerful searches within the Cascade CMS content repository.

---

### Search isn't returning expected results

The steps outlined here can be followed if the Search functionality and/or the Full Search/Replace tools aren't returning expected results.
- Check (or have one of your admins check) the Background Tasks Report. While viewing this report, use the **Filter Results** option (top right) and change the **Task Type** dropdown to **Build Search Index**.
- Once the table loads, take a look at the **Status** column for the most recent task If the task shows as **Completed**, verify that the **Duration** column shows a value that is greater than `00:00`. If the Duration is `00:00`, this generally indicates that there is a permissions issue affecting the application's `indexes` directory. This can be verified by locating the cascade.log file for the day in question and searching for messages like the following: ``` ERROR [SearchServiceImpl] Could not reset lucene directory, assets will not be added to search index: java.io.IOException: Cannot delete C:\Program Files\Cascade CMS\tomcat\indexes\segments.gen ``` **Note**: If messages like the one above are found in the log files, your CMS administrator will need to ensure that the O/S account running Cascade CMS has full privileges to the application's `indexes` folder on the application server. To find the O/S account that is currently being used for the app, follow the steps outlined here.
- If the task shows as **Unfinished**, this would indicate that the application may have experienced an ungraceful shutdown during that rebuilding process. If this is the case, follow the steps in this article to begin a new rebuild task.**Note**: Pay special attention to the **Duration **that you see for previous rebuild tasks so that you have an idea of how long this may take. While search results will begin to populate immediately on rebuild, you may need to wait until the entire job is completed in order to see the results you're expecting.
- If the task shows as **Running**, wait until it completes and then check once again to see if your search terms return the results that you expect. To get an idea of how long the task may take to complete, look at the **Duration** of previous tasks for building the search indexes. In the event that results still aren't appearing, attempt to rebuild your search indexes once more.
**Still having trouble?** Reach out to support [at] hannonhill.com and we'll be happy to help investigate further.
## Related Links
- How do I rebuild my search indexes?
- How can I find the O/S account running Cascade CMS?
- Background Tasks
- Logs and System Information

---

## Linking

*7 articles in this category*

### Adding classes to links and images

To add a class to a link:
- Highlight the link in question or place your cursor somewhere in the link text. 
- Click the **Insert/edit link** icon (alternatively you can right-click on the link and select **Link**).
- In the **Styling** field, select one of the styles listed. 
- Click **Ok.**
To add a class to an image:
- In the editor, select the image in question by clicking on it.
- Click the **Insert/edit image** icon (alternatively, you can right-click the image and select **Image **in the pop-up menu that appears).
- In the **Styling** field, select the style that you wish to apply.
- Click **Ok.**
**Note**:
If the **Styling **field is not visible, this indicates that the underlying WYSIWYG Editor Configuration being used does not have any CSS classes configured in the **CSS classes to add** field. Reach out to your CMS or Site Administrator if you need assistance with having those options made available to you in the editor.**Tip: 
**Need to add a class to a figure instead? After clicking on the image in question, locate the element path in the status bar just below the editor (**figure » ****img**). Click on **figure** and then use the **Format -> Formats -> Custom** menu to apply any relevant classes to that element.
If no class names appear in the menu, verify that you've selected the **figure** in the element path within the status bar. If you still do not see any options at that point, reach out to your CMS or Site Administrator to confirm that the underlying WYSIWYG Editor Configuration has been configured to allow for classes to be added to figure elements.
## Related Links
- WYSIWYG Editor Configurations

---

### Broken Link Report

## Overview
The Broken Links Report displays the results of the scheduled broken Link Checker which can be configured in your System Preferences. Only pages and files that are marked as publishable are scanned for broken links.
## Enabling the Report
First, enable the Broken Links Report for your system:
1. Click the system menu button ( * *) > **Administration** > **Preferences > Reports**.
2. Under **Link Checker Configuration** configure the following options: - **Run Scheduled Link Checker**- choose which day of the week and time the report should run.
3. Click **Submit**.
Next, enable the Broken Links Report for one or more sites:
1. Choose your site from the **Site** menu and then select **Manage Site** > **Site Settings**.
2. Under **Link Checking**, enable the **Schedule Link Checking** option.
3. Click **Submit**.
4. Repeat these steps for each additional site for which you want to enable the report. A report will be available for the site in the **Reports** area after the next scheduled report date/time.
**Note** - To prevent impacting system performance for users, we recommend scheduling the Broken Links Report to run no more than once weekly during off peak hours, such as early morning on a weekend.
## Viewing the Report
Once the Broken Links Report has been enabled for your system and run for at least one site, you can view the report under **Reports** > **Broken Links Report**. To get started, choose a report-enabled site under **Filter Results**.

The top portion of the Broken Links report contains a summary of the following items:
- Number of Assets with Reported Broken Links.
- Number of Reported Broken Links.
- Number of Broken Links currently Ignored, Allowed, and having Valid Response Codes.
- Number of Broken Links Remaining (ones that have not been marked as fixed or ignored since the last time the scheduled Link Checker was run).
Below the overview is a results list of all broken links encountered during link checking. These links can be grouped by link, which displays all assets containing a particular broken link, or by asset, which displays all broken links found for each asset checked.
The results list contains the following information:
- **Source** - The asset in which the broken link was rendered.
- **Occurrences** -When grouping by link, this column will indicate the number of assets that were found to have been using a particular link.
- When grouping by asset, this column will indicate the number of broken links in the current asset.
- Clicking **Show** in this column will display either all assets containing a particular broken link or all links contained in a particular asset depending on whether the report is being grouped by link or by asset, respectively. Clicking **Hide** will collapse the rows.
**Type** -
- Internal links are links to resources within the system such as Files or Pages.
- External links are links to resources outside the system.
**Link Description** -
- For hyperlinks, the link description is the text contained inside the element or "Link with no text".
- For other types of links, this column will contain a description of the type of tag containing the link to help users locate the link on the page (e.g. "Broken image source").
**Broken Link** - This is the value of the attribute that is considered broken. For an `<a>` tag, this would be the value of the `<href>` attribute.
- Hover over or click on the question mark (  ) icon next to the link for more information on why the link is considered broken.
- See Elements Checked for Broken Links for a full listing of elements and attributes that are checked for broken links.
**Status** - This column indicates whether or not the broken link has been fixed yet or not.
- Users can click the dropdown and select **Fixed** to indicate that the link has been fixed in some way, or **Ignored** to indicate that the link should be excluded from the Link Checker.
- Marking a link as Fixed or Ignored will reduce the number of links that are considered broken in the Broken Links Remaining summary of the report.
- Links marked as Fixed will be displayed as Fixed for all other users in the system.
- Note that a status of Fixed will revert back to its original value of **Broken** the next time the Link Checker runs if the link has not actually been fixed inside the corresponding asset.
- The first row in each set of grouped rows in the report will have two additional values in the status dropdown: **Mark all fixed** and **Mark all broken**. These values will mark all grouped rows as either Fixed or Broken, respectively.
**Note** - To access the Broken Links report data for a Site, users need the **Access site-wide broken link report** ability enabled in their Site Role. To mark links fixed in the report, users also need the **Mark broken links as fixed on the site-wide broken link report** ability enabled.
## Filtering the Report

The following filters are available to refine the results of the report:
- **Site** - A Site must be selected to display report data.
- **Group By** -Grouping by **Asset** displays all broken links found for each asset checked.
- Grouping by **Link** displays all assets containing a particular broken link.
**Type** - 
- Internal links are links to resources within the system such as Files or Pages.
- External links are links to resources outside the system.
**Hide Fixed** - When this option is enabled, links marked as Fixed are hidden from the report.**Show Ignored, Allowed URLs and Valid Response Codes** - When this option is enabled, links marked Ignored, match a Allowed URL or responded with a Valid Response Code are displayed in the report.
## Fixing Broken Links
To fix a broken link:
1. Locate the link you'd like to fix in the **Broken Link** column.
2. Edit the asset listed in the **Source** column.
3. You can either fix the link manually by searching for it in the content of the asset or perform a **Check Content & Submit** for the asset and fix the link during the broken link content check.
It's important to note that although a "source" asset is listed with each link, the broken link itself may exist in a supporting asset such as a Template, Format, or Block. These and other non-publishable supporting assets don't get checked for broken links directly. When following the steps above, if the broken link can't be found manually or using the on-submit link check, then it's likely that the broken link exists in a supporting asset.
## Elements Checked for Broken Links
| Element | Attributes |
| --- | --- |
| a | href |
| td | background |
| link | href, src |
| script | src |
| img | src |
| iframe | src |
| area | href, src, background |
| frame | src |
| param | href, src, background |
| embed | href, src |
| table | background |
| input | href, src, background |
| body | src, background |
| video | src, poster |
| source | src |
| audio | src |

## Related Links
- System Preferences
- External Link Checking Preferences

---

### Creating an anchor link

Anchor links, sometimes called "skip links", allow you to link to a particular spot within the same page or a different page. To create an anchor link to a location within a page:
1. Place your cursor at the spot where you'd like your destination anchor to appear and click the **Anchor** button in the toolbar.
2. Enter a unique ID for your anchor and click **OK**. - Note: Remember this ID or copy it somewhere; you'll need it for the next steps.
3. If the anchor isn't in the same page as the anchor link, edit the page you'd like to contain the link to the anchor.
4. Use the **Insert/Edit link** button in the toolbar to create an "Internal" link.
5. Use the page chooser to browse for the page containing your anchor. For anchors within the same page, this will be the current page.
6. In the **Anchor** field, type or paste the exact ID you used when creating the destination anchor. This will append the anchor ID to the end of the link URL.

---

### External Links

An external link is an asset that points to a website hosted outside of Cascade CMS.

---

### Linking

## Overview
Cascade CMS provides a number of different ways to manage links in content depending on the type of asset containing the link, the type of link (internal or external), and the location of both assets.
## Asset links
**Asset links** or **internal links** are links between assets, such as Pages or Files, managed within the same Cascade CMS environment.
#### Same-site links
Same-site links are links to an asset within the same site as the current asset. Example same-site link paths:
`/path/to/page`
``
`<img src="/path/to/file.png"/>`
#### Cross-site links
Cross-site links are paths to an asset located in a different site than the current asset. They begin with a `site://` prefix followed by the name of the site where the linked-to asset is located. Example cross-site link paths:``
`site://Site Name/path/to/page`
`<a href="site://Site Name/path/to/page">Link</a>`
In order for a cross-site link to resolve correctly, the linked-to asset must be found at the site and path provided and must be published.
**Note** - Internal links to page assets should not include the page's file extension, because this is added during publish depending on the page's Configuration settings.
#### Link tracking
Most internal asset links are tracked, meaning the CMS creates an id-based relationship between the two assets and the link's path will be automatically updated if the linked-to asset is moved or renamed. (See "Asset links in XML-based content" below for more information.)
In contrast, **external links**, fully-qualified links to assets outside of the CMS including the file extension, are not tracked. Example external link:
`https://www.example.com/path/to/page.html`
While it's also possible to create an "external" link to a CMS-managed asset, it will not be tracked and won't be updated if that asset is moved or renamed.``
**Note** - In some scenarios, an asset link that would normally be tracked in the system fails to be tracked. To correct these untracked links, a background task runs once per day to realign internal links within recognized XML-based content.
## Asset links in XML-based content
Certain attributes of some elements in XML-based assets are automatically checked by Cascade CMS for asset links. Those XML-based assets are:
- Pages
- Templates
- XML Blocks
- XHTML Blocks
- XSLT Formats
The table below describes which elements and attributes are automatically checked for links to CMS-managed content when editing, creating, or rendering the content.
| Element | href | src | background |
| --- | --- | --- | --- |
| a | Yes | No | No |
| area | Yes | Yes | Yes |
| body | No | Yes | Yes |
| td | No | No | Yes |
| table | No | No | Yes |
| embed | Yes | Yes | No |
| frame | No | Yes | No |
| iframe | No | Yes | No |
| img | No | Yes | No |
| input | Yes | Yes | Yes |
| param | Yes | Yes | Yes |
| link | Yes | Yes | No |
| script | No | Yes | No |
## System-asset pseudo-tags
To create asset links in non-XML content or outside of a recognized attribute (see "Asset links in XML-based content" above), you can use system-asset pseudo-tags to mark the path as a CMS-managed asset.
[

---

### Path Repair Tool

## Overview
Assets in Cascade CMS cache their path in the site to speed up certain operations in the system. Normally these paths are updated as the assets and their ancestors are moved, but they have been known to get out of sync. Situations that cause this problem are corrected as they are found, but in the case that the database is already in this state the Path Repair Tool can be used to correct it. Diagnosing this situation, however, is not possible through the Cascade CMS interface so the tool should only be done under the explicit direction by Hannon Hill Support.
**Warning** - Before running any optimization tool, please backup your database to protect against data loss.
## Running the Path Repair Tool
To run the Path Repair Tool:
1. Click the system menu button ( * *) > **Administration** > **Optimize Database**.
2. Select **Path Repair Tool**.
3. Click **Submit**.
## Path Repair Tool Report
After running the Path Repair Tool, a report is given detailing the status of the repair.
The **Properties** section gives the timestamp of when the tool was started and the status of the attempt (whether any inconsistent paths were found and if they were updated successfully).
The section labeled **Successfully Repaired** lists all of the assets which were found to have incorrect paths and were repaired without problems, along with the site to which they belonged.
The **Errors** section lists any assets which were not able to be repaired. Each item also includes the error which was encountered during the repair. A common problem is that the asset fails validation, e.g. a page without a configuration or content type, which must be corrected before the path is repaired.

---

### References

## Overview
A reference is a special asset in Cascade CMS that represents an existing asset in another location; thus, a single asset can appear to exist in multiple locations. While a single asset appears in navigation as if it were in multiple locations, in actuality, it directs back to the original asset.
The reference, when indexed by an index block, will render content for the linked-to asset. Deleting the reference will have no effect on the referenced asset.
References are a great way of creating index block renders, as users can create a folder of explicitly-chosen content that can be quickly indexed by an index block that is set to render the references in the folder.
References are often used to display links in navigation menus in other folders than where the page actually resides.
## Creating a Reference
To create a reference:
1. Right-click on the asset to be referenced and select **Reference** from the context menu. Alternatively, click **More** > **Reference** while viewing the asset in question.
2. Select a **Name** for the reference. Note that the Title and Display Name for the reference will be pulled from the original asset being referenced.
3. Select a **Placement Folder** for the reference.
4. Click **Submit**.

---

## Integration

*8 articles in this category*

### Acquia DAM (Widen) Integration (Labs)

## Overview
The [Acquia DAM](https://www.widen.com/digital-asset-management) digital asset management (DAM) integration allows users to browse for and select images and assets from your Widen Collective library directly from the WYSIWYG editor.
This integration is available for Cascade Cloud clients only.
## Enabling Acquia DAM Integration
First, enable Acquia DAM integration for your system:
1. Click the system menu button ( * *) > **Administration** > **Preferences** > **Integrations & Plugins**.
2. Under **Digital Asset Management**, enter your **Widen Collective API key**. - For more information about locating your Widen API key, visit [Widen's FAQ](https://l.spct8.com/yrSUZq).
Next, enable Acquia DAM integration for one or more sites:
1. Choose a site from the **Site** menu, then select **Manage Site** > **Site Settings**.
2. Under **Digital Asset Management**, select **Enable Widen Collective Integration**.
3. Optionally, enter a **Default Category** which corresponds to a valid category in Widen. This will preload the chooser panel with assets from that category.
4. Click **Submit**.
## Selecting Assets from Acquia DAM
To select assets from your Acquia DAM library:
1. In the WYSIWYG editor, click either the **Insert/edit image** or **Insert/edit link** button.
2. Under **Image/Link Type**, select **External**.
3. Under **Image/Link Source**, click the **Browse Widen Collective for external images/files** link.
4. In the chooser panel, select an asset or search for assets using the search bar. Each asset has the following options: - **Download** ( * *) - Downloads the selected asset to your computer. - **Quick View** ( * *) - Opens a preview window for the asset. - **Share** ( * *) - Opens dimension options for the asset. Select a dimension and click **Submit** to insert the asset or link to the asset.
5. Update fields such as the **Image description** field as needed and click **OK** to insert your image or link.

---

### Connectors and Integrations

Connectors and integrations allow you to utilize third-party applications and tools within Cascade CMS.

---

### DubBot Integration

## Overview
The integration between Cascade CMS and the [DubBot platform ](https://dubbot.com/)provides users with an efficient and time-saving workflow to address website issues, such as accessibility, broken links, web governance, spelling, SEO, and more.
DubBot offers deep linking to Cascade CMS from DubBot reports to your page assets in Cascade CMS.
**Note**: The DubBot service is separate from Cascade CMS and is not included with the cost of your Cascade CMS subscription.
## Deep linking in DubBot
To make correcting issues in your content easier, DubBot offers [CMS Deep linking](https://help.dubbot.com/en/articles/2462550-deep-linking-with-cascade-cms#deep-linking). Deep linking creates links to your page assets in Cascade CMS from within reports in your DubBot account. To do this, the Cascade CMS ID of your page assets needs to be included in the page's published source.
You can include a page's ID in your Template(s) with a simple region and Velocity format:
1. Create a Velocity Format containing the following: ``` <meta name="id" content="${currentPage.identifier.id}"/> ```
2. Create a new region within the `<head>` tags of your Template(s). Example: ``` <!-- Page ID for DubBot deeplinking. --><system-region name="PAGE_ID"/> ```
3. Attach your Format to this new region in your Template(s).
4. Publish all pages that use the Template(s) to ensure that your page ID `<meta>` tag gets included the pages on your web server.

---

### Google Analytics Connector

## Overview
The Google Analytics Connector syncs data from your Google Analytics account with Cascade CMS to provide users with basic analytics information for Sites, Pages, Files, and Folders. Site analytics data is available through a Dashboard widget, the Google Analytics Statistics report, and by viewing **More > Analytics** when viewing any of the Site, Page, File, or Folder asset types.
## Creating a Google Analytics Connector
To create a Google Analytics Connector:
1. Navigate to  **Manage Site** > **Connectors**.
2. Navigate to the container in which the new Connector will be stored, or create a new container using  **Add** >  **Container**.
3. Click  **Add** >  **Connector**.
4. Select  **Google Analytics** and then click **Choose**. - If your selected site already has a Google Analytics Connector, you won't be able to add another unless you delete the existing Connector first.
5. In the  **Name** field, enter the name for your Connector.
6. In the  **Parent Container** field, select a container for your Connector, if desired.
7. In the **View/Property ID** field enter the View/Property ID of the profile you wish to pull data from in Google Analytics. **Note: ** For Google Analytics 4, the **Property ID** is found in **Admin > Property Settings > Property Details**.  
8. Optionally, enter a value for the **Base Path** field. - The Base Path is a path segment that is removed from URLs imported from Google Analytics to help Cascade determine which asset corresponds to a particular URL. - An example of when the Base Path could be used is when a site in Cascade corresponds to a sub-folder off of a particular domain. For instance, an athletics-oriented site might be published to www.myuniversity.edu/athletics. In Cascade, there is no "athletics" folder because it is represented by a site. The URLs coming from Google Analytics, however, look like "/athletics/index.html".  In order for Cascade to be able to match the URL to a particular page inside Cascade, it would need to know that "/athletics" should be removed from the URL in order to successfully locate the matching Page "index".
9. Click **Submit**.
## Google Analytics 4 data points
If you've been using the Connector to pull data from Universal Analytics, you'll notice a few differences in the data once you switch to Google Analytics 4.
Universal Analytics displayed Pageviews, Visits, Unique Pageviews, Average Time on Site, and Bounce Rate.
With Google Analytics 4, you'll see:
- Views
- Sessions
- Users
- Engagement Rate
- Average Engagement Time
You can find more about [comparing metrics between Universal Analytics and Google Analytics 4 on the Google website](https://support.google.com/analytics/answer/11986666#bounce_rate_vs_engagement_rate&zippy=%2Cin-this-article).
## Google Analytics 4 and Universal Analytics
Cascade CMS currently supports Universal Analytics Views and Google Analytics 4 (GA4) properties. However, Universal Analytics properties and views are being [phased out](https://support.google.com/analytics/answer/10759417). Standard Universal Analytics properties will stop collecting data on July 1, 2023 while 360 Universal Analytics properties will stop collecting data on July 1, 2024. Google recommends switching to GA4 as soon as possible
### Switching your Connector to Google Analytics 4
You'll want to follow the [migration guide](https://support.google.com/analytics/answer/10759417#zippy=%2Cin-this-article) to get set up Google Analytics 4 and start collecting data as soon as possible. To help, Google will [automatically create a GA4 property](https://support.google.com/analytics/answer/12938611#zippy=%2Cin-this-article) for you.
Once you have a sufficient amount of data associated with the new Google Analytics 4, you can go ahead and switch to the GA4 version:
1. Edit your existing Connector and update the View/Property ID field to reference the GA4 
2. Re-verify the Connector
3. Either manually import data or wait for the scheduled data sync
## Verifying/Unverifying the Google Analytics Connector
To verify/unverify your Google Analytics Connector:
1. While viewing (but not editing) the Connector, click **Verify**.
2. A new link will appear that says **Click here to allow and "Verify" again**.
3. The link will open a new window/tab to Google to grant Cascade access to the Google Analytics account.
4. If you're not already logged in, enter the account credentials which have access to the profile.
5. Copy the authentication token presented to you: 
6. Now that a new access token for your Google Analytics connector has been generated, copy the token, go back to the Connector verification dialog, paste the token into the field and click the **Submit**.
Your Google Analytics connector is now enabled. To manually synchronize the analytics data, click the link labeled **Click to manually import analytics data**. Otherwise, no analytics data will be available until the next automatic synchronization which will occur at 1:30 am.

---

### LDAP/Active Directory Authentication

## Overview
Your environment's LDAP Configuration interface can be found under **Administration** > **Security and Authentication** > **LDAP Configuration**. The LDAP Configuration interface consists of three main areas (tabs):
- **Options** - general information regarding how Cascade CMS should connect to your existing LDAP/AD server.
- **Policies** - an interface for building one or more user Policies. Policies specify which users you wish to sync/import into Cascade CMS and determine which Groups and Roles those users should inherit upon syncing.
- **XML** - an XML representation of your LDAP Configuration.
**Note:** You must have at least one Policy set up in order to use the LDAP functionality within Cascade CMS.
## Options
This screen contains general information regarding how Cascade CMS should connect to your existing LDAP/AD server. The fields located in this interface are self-documenting and for the most part self-explanatory; however, there are a couple of options here that are important to consider.
#### Orphaned LDAP Users
The **Orphaned LDAP Users** option determines the action that Cascade CMS should take when an existing LDAP User in the system is no longer synchronized/imported with any of the existing Policies. The three possible actions are:
- **Ignore** - does nothing, no action will be taken for the User account.******
- **Deactivate** - disables the User account. Disabled accounts can be manually re-enabled by an Administrator.
Note: The Delete option has been deprecated to prevent accidentally mass deleting users during an erroneous LDAP sync and will be removed in a future release of Cascade CMS. Until the behavior is removed as a valid option, configurations with Delete/Remove will fall back to Deactivate.
Consider the following scenario:
- As part of an LDAP sync, a User named "user1" is imported into Cascade CMS and configured to authenticate against your LDAP/AD server any time they log into the system.
- Some time later, "user1" has their DN modified in the LDAP/AD server such that they no longer match any of the Policies that have been set up to sync.
- Upon the next LDAP sync (manual or scheduled), the system marks this User as orphaned because they are an LDAP User in the system but are no longer being synced with any of the current Policies.
- When this occurs, the User account in Cascade CMS will either be ignored or deactivated depending on the option selected for **Orphaned LDAP Users**.
#### Scheduling and Reporting
In addition to manually syncing with LDAP, the system can be configured to sync on a schedule. We typically recommend that this option be set to **Repeat Every 1 days**. If you need to sync more often than this, we don’t recommend doing so more frequently than once per hour since syncing large numbers of Users can be resource intensive.
When running scheduled syncs, we also recommend using the **Generate Report** option to email a report to one or more system Administrators. This way, Administrators can be alerted to any potential syncing issues and see which users were added/removed during each sync.
## Policies
In order to sync/import users from an LDAP/AD server, a minimum of one Policy must be configured in this interface, but you can add as many additional Policies as needed to manage your Users, Groups, and Roles.
A Policy allows you to target specific subsets of users in your LDAP/AD server and import them into the system. This can be done either by pointing the configuration to one or more Container Identifiers (for type: User**) or by specifying a Security Group Id (for type: **Active Directory Security Group**).
#### User Policy 
When creating a Policy of type **User**, Cascade CMS will attempt to iterate over the first level of users residing in the Container Identifiers that you’ve specified. It will *not* traverse sub-containers within a specified Container Identifier.
The **Filter** section allows you to filter on particular users within containers by specifying one or more** Object Attribute Filter(s) **(name/value pairs) or by using a **Freeform Filter**. The Freeform Filter field can be used to provide a filter using standard LDAP query syntax.
#### Active Directory Security Group Policy
Using a Policy of type **Active Directory Security Group** allows you to point to the DN of a Security Group in your existing AD server. In addition to specifying the **Security Group Id**, you’ll also need to provide a **Group Member Attribute Id**. For this field, you’ll typically use a value of `member` as that is the attribute which specifies that a user is a member of the Security Group.**
#### Authentication Mode
The Authentication Mode** option specifies how the users synced/imported via your Policy will authenticate when logging into Cascade CMS. These options are:
- **Normal** - Use this option if you wish to import Users into Cascade CMS but not have them authenticate against your LDAP server. If selected, this option requires that you manually specify a password for each User that you’ve synced/imported into the system by editing each User account. Passwords for Normal Users are stored in the Cascade CMS database and are encrypted as well as salted and hashed.
- **LDAP** - This option should be selected if you want your users to authenticate directly against your LDAP/AD server each time they log in to Cascade CMS. In this scenario, no password information for those users will be stored in the Cascade CMS database.
- **Custom** - The Custom option is used to tell the application that the Users being synced/imported via your Policies will authenticate via your Single Sign-On (SSO) solution.
**Note:** In order for Users to authenticate via your SSO solution, you must have your Cascade CMS environment properly configured to direct users to your organization’s SSO login page. See Custom Authentication for more information on integrating Cascade CMS with Single Sign-On solutions.**Tip:** It's possible to configure a Policy to specify one authentication method while another Policy specifies a different authentication method. Example: Policy A can configure Users synced via Policy A to use Normal authentication while Policy B can configure Users in Policy B to authenticate via LDAP.
## XML
The **XML** tab provides an XML representation of your LDAP Configuration, which is a combination of the information entered in both the Options and Policies areas. This can be useful if you’re copying a configuration from one environment to another (from development to production, for example) or if to maintain a backup of a working configuration.

---

### Monsido Integration

## Overview
The integration between Cascade CMS and the [Monsido platform * *](https://monsido.com/) provides users with an efficient and time-saving workflow to address website issues, such as accessibility, broken links, misspellings and more.
Monsido's browser extension for Chrome allows users to work in the Cascade CMS interface but receive visual on-page highlights of errors. This allows Cascade CMS users to efficiently work in a task-oriented manner, and maintain a high-quality website for their visitors.

**Note**: The Monsido service is separate from Cascade CMS and is not included with the cost of your Cascade CMS subscription.
## Set up the page URL
In order for the Monsido integration to locate the page you're previewing in Cascade CMS in your Monsido Inventory, the published URL of the page must be available when previewing the page inside Cascade CMS.
To make the published page URL available:
Create a Velocity Format containing the following code:
[system-view:internal

---

### Secure LDAP sync fails after upgrade to Cascade CMS v8.11

Cascade CMS v8.11 comes bundled with a newer version of Java (JRE 8u191). This newer version of the JRE enables endpoint identification algorithms for LDAPS servers for added security. The change was included in JRE 8u181+ and more information on it can be found in the [Oracle/Java Release Notes](https://www.oracle.com/technetwork/java/javase/8u181-relnotes-4479407.html). Due to this, you may have problems syncing with your LDAPS server.
A common error as a result of this change may look like this:
`ERROR [LdapServiceImpl] {User: system, id: not specified, type: not specified} During LDAP user import, encountered an error and could not bind to the LDAP server:
javax.naming.CommunicationException: simple bind failed: xxx.xxx.xxx.xxx:636 [Root exception is javax.net.ssl.SSLHandshakeException: java.security.cert.CertificateException: No subject alternative names matching IP address xxx.xxx.xxx.xxx found]`
To work around this, you can disable endpoint identification algorithms by adding the following parameter to your startup script. For example:
## Linux/macOS
1. Stop Cascade CMS.
2. Edit *cascade.sh*.
3. In the `JAVA_OPTS` line, add `-Dcom.sun.jndi.ldap.object.disableEndpointIdentification=true`
4. Save.
5. Start Cascade CMS.
## Windows
1. Stop Cascade CMS.
2. Right-click the *tomcat/bin/CascadeCMSw.exe* file and select the **Run as Administrator** option.
3. Click the **Java** tab.
4. In the **Java Options** section, add the line `-Dcom.sun.jndi.ldap.object.disableEndpointIdentification=true`
5. Click **Apply/OK**.
6. Start Cascade CMS.

## Related Links
- LDAP/Active Directory Authentication

---

### Webdam by Bynder Integration (Labs)

## Overview
The [Webdam by Bynder](https://www.bynder.com/en/webdam/) digital asset management (DAM) integration allows users to browse for and select images and assets from your Webdam library directly from the WYSIWYG editor.
This integration is available for Cascade Cloud clients only.
## Enabling Webdam Integration
First, enable Webdam integration for your system:
1. Click the system menu button ( * *) > **Administration** > **Preferences** > **Integrations & Plugins**.
2. Under **Digital Asset Management**, enter your organization's **Webdam Domain**. Example: *https://yourorganization.webdam.com*
Next, enable Webdam integration for one or more Sites:
1. Choose a site from the **Site** menu, then select **Manage Site** > **Site Settings**.
2. Under **Digital Asset Management**, select **Enable Webdam Integration**.
3. Click **Submit**.
## Selecting Assets from Webdam
To select assets from your Webdam library:
1. In the WYSIWYG editor, click either the **Insert/edit image** or **Insert/edit link** button.
2. Under **Image/Link Type**, select **External**.
3. Under **Image/Link Source**, click the **Browse Webdam for external images/files** link.
4. In the chooser panel, browse for an asset or search for assets using the search bar. - Optionally, sort assets by attributes such as date uploaded, date created, name, or size. - Hover over an image to view an expanded preview.
5. Click an asset to select it. A checkmark will appear by your selected asset.
6. Choose your asset dimensions using the menu in the bottom left and click **Insert**.
7. Update fields such as the **Image description** field as needed and click **OK** to insert your image or link.

---

## Troubleshooting

*13 articles in this category*

### "Could not acquire change log lock" or "Waiting for changelog lock..."

During start-up, one of the following messages may appear in the cascade.log file and prevent Cascade CMS from starting:
`Waiting for changelog lock....`
`Caused by: liquibase.exception.LockException: Could not acquire change log lock. Currently locked by ...`
These can occur if the application experiences an ungraceful shutdown. To see which machine has locked the Cascade CMS database, execute the following SQL query:
```
select * from DATABASECHANGELOGLOCK;
```
Check the `lockedby` column to see who locked the table. Generally, the lock will be from the local machine.
Assuming this is the case (and no other machine has a lock on the database), take the following steps to resolve the issue:
1. Stop Cascade CMS process (if it's still running)
2. Execute the following SQL query against the Cascade CMS database: ``` update DATABASECHANGELOGLOCK set locked=0, lockgranted=null, lockedby=null where id=1 ```
3. Start Cascade CMS

---

### "Remember Me" Cookied Login Vulnerabilities

## Summary
We have identified several weaknesses in the cookied login progress that would allow a sophisticated attacker to access the CMS as another user using only "remember me" cookies.
### Cookie authenticity
Cookies were not expired or validated on the application side. It was previously possible to acquire a user's cookie, and, regardless of age, use it to gain access to the CMS. A valid expiration date was set in the cookie but not enforced in the application. Note that while the cookie itself was securely stored in the browser, the application was not taking the appropriate steps to verify its age and authenticity.
### Cookie hijacking
It was possible to hijack a user's "remember me" cookies by embedding a script within a page served up by CMS application.
It was also possible to login to a Custom Authentication user account using a valid "remember me" cookie even though Custom Authentication users cannot generate "remember me" cookies through the normal login process.
### Weak cookie encryption
The unique value stored in the cookie was weakly encrypted and vulnerable to brute force attack or to an attack where a sophisticated user reverse engineered and manufactured valid cookie values on behalf of users.
## Remediation
If you are an on-premise Cascade CMS customer, please update to Cascade CMS 8.22.1 or later as soon as possible.
If you are a Cascade Cloud customer, your system has already been patched.

---

### Configuring Cascade CMS Log Rotation and Compression

## Overview
This article is provided as an example of how to configure Cascade CMS application logging to use rotation and/or compression. It is for informational purposes only, and Hannon Hill Product Support cannot provide Log4j2 configuration support or assistance.
## Enabling log rotation
Cascade CMS application logging can be configured remove older log files over a specified number of rotations. To do so:
- On the application server, locate and edit `tomcat/webapps/ROOT/WEB-INF/classes/log4j2.properties`.
- Locate each of the commented-out lines that look like the following: ``` #appender.APPENDER_NAME.strategy.type = DefaultRolloverStrategy#appender.APPENDER_NAME.strategy.max = ${ROTATION_STRATEGY_MAX} ```
- Uncomment these lines by removing the hash sign (`#`) from the beginning of the line.
- Save the changes.
- Restart Cascade CMS.
**Note** - By default, rotation is configured to 7 days. To change this setting, locate the `property.ROTATION_STRATEGY_MAX` property towards the top of the same `log4j2.properties` configuration file and adjust the value to the desired number of days.
## Configuring log file compression
You can enable or disable automatic compression of rotated application log files using the following steps:
- On the application server, locate and edit `tomcat/webapps/ROOT/WEB-INF/classes/log4j2.properties`.
- Locate the `property.LOG_ROTATION_FILE_PATTERN` property towards the top.**Enable compression:** add a `.gz` (or `.zip`) extension to the filename pattern
- **Disable compression:** remove the `.gz` (or `.zip`) extension from the filename pattern
Save the changes.Restart Cascade CMS.

---

### CVE-2021-44228 Log4Shell

## What is CVE-2021-44228 (Log4Shell)?
In summary,
Log4j versions prior to 2.15.0 are subject to a remote code execution vulnerability via the ldap JNDI parser. As per [Apache's Log4j security guide](https://logging.apache.org/log4j/2.x/security.html): Apache Log4j2 <=2.14.1 JNDI features used in configuration, log messages, and parameters do not protect against attacker controlled LDAP and other JNDI related endpoints. An attacker who can control log messages or log message parameters can execute arbitrary code loaded from LDAP servers when message lookup substitution is enabled. From log4j 2.15.0, this behavior has been disabled by default.

---

### CVE-2021-45046 Log4Shell

## What is CVE-2021-45046 (Log4Shell)?
In summary,
It was found that the fix to address CVE-2021-44228 in Apache Log4j 2.15.0 was incomplete in certain non-default configurations. This could allows attackers with control over Thread Context Map (MDC) input data when the logging configuration uses a non-default Pattern Layout with either a Context Lookup (for example, $${ctx:loginId}) or a Thread Context Map pattern (%X, %mdc, or %MDC) to craft malicious input data using a JNDI Lookup pattern resulting in a denial of service (DOS) attack. Log4j 2.15.0 restricts JNDI LDAP lookups to localhost by default. Note that previous mitigations involving configuration such as to set the system property `log4j2.noFormatMsgLookup` to `true` do NOT mitigate this specific vulnerability. Log4j 2.16.0 fixes this issue by removing support for message lookup patterns and disabling JNDI functionality by default. This issue can be mitigated in prior releases (<2.16.0) by removing the JndiLookup class from the classpath (example: zip -q -d log4j-core-*.jar org/apache/logging/log4j/core/lookup/JndiLookup.class).

---

### CVE-2021-45105 Log4Shell

## What is CVE-2021-45105 (Log4Shell)?
In summary,
Apache Log4j2 versions 2.0-alpha1 through 2.16.0 (excluding 2.12.3) did not protect from uncontrolled recursion from self-referential lookups. This allows an attacker with control over Thread Context Map data to cause a denial of service when a crafted string is interpreted. This issue was fixed in Log4j 2.17.0 and 2.12.3.

---

### Error constructing implementation

When attempting to perform an operation that relies on SSL/TLS, you may see errors like the following:
`java.security.NoSuchAlgorithmException: Error constructing implementation (algorithm: Default, provider: SunJSSE, class: sun.security.ssl.SSLContextImpl$DefaultSSLContext)`
This is generally due to the system not being able to locate a valid certificate for the application server. There are a few areas of the system to check when troubleshooting this particular issue:
## Cascade CMS 8.21 and newer
To locate the keystore settings for the application:
- Go to System Preferences
- In the **System** tab, scroll down to the **SSL/TLS Key Store **section.
- Verify that:The **Key Store Path** points to a valid key store on the application server.
- The key store referenced in the **Key Store Path** field contains the proper SSL certificates for the application server itself.
- The **Key Store Password** field contains the correct password for the key store that is being referenced.
Any changes made will require restarting Cascade CMS**Note**: If using the bundled keystore in the Cascade CMS installation, the default password is **changeit**
## Prior to Cascade CMS 8.21
While it may not seem related at first, the LDAP Configuration in your instance can potentially be the cause of this problem. If you happen to be using LDAP to sync/authenticate users in your instance, check the following items in your configuration:
- In the **Binding** section, see if the **SSL** option is selected. If it is selected, verify that:The **Key Store Path** points to a valid key store on the application server.
- The key store referenced in the **Key Store Path** field contains the proper SSL certificates for the application server itself.
- The **Key Store Password** field contains the correct password for the key store that is being referenced.****
- Any changes made will require restarting Cascade CMS
**Note**: If using the bundled keystore in the Cascade CMS installation, the default password is **changeit**
If the **SSL** option is not selected, skip to [Default Java Key Store](#DefaultJavaKeyStore).
Important notes on using LDAP over SSL
- Any changes made in the LDAP configuration with respect to the key store require a restart of Cascade CMS in order to take effect.
- Any time an LDAP sync occurs, the application will load the key store that is being referenced in the **Key Store Path** field into memory. Because of this, it is important that you maintain a single key store on your application server that contains any necessary certificates for your environment. Having a single key store with all of the proper certificates in it can prevent issues with different key stores being referenced from different locations within the application environment.
## Default Java Key Store
For those who are either not using LDAP at all (prior to Cascade CMS 8.21) or are not specifying keystore information in the System Preferences (Cascade CMS 8.21+), the application will default to using the key store located within the application's Java installation. To find out which installation of Java the application is using, see this article.
After determining which Java installation is being used, you'll need to make sure that the key store (generally `lib/security/cacerts`) contains the certificates for the application server itself.

## Related Links
- LDAP/Active Directory Authentication
- How can I find which Java installation my Cascade CMS instance is using?

---

### How can I enable request logging for Cascade CMS?

Request logging for the application can be configured by taking the following steps:
- Stop Cascade CMS
- Edit the file `tomcat/conf/context.xml`
- Within the active `<Context>` element (for example, just before the closing `</Context>` tag), enter the following: ``` <Valve className="org.apache.catalina.valves.AccessLogValve" directory="logs" prefix="cascadecms_request." suffix=".log"  pattern="%t %U %a %m %H %b %h %s" resolveHosts="false" /> ```
- Start Cascade CMS
Using the sample configuration above, the request log will be created in the `tomcat/logs` directory and appear as `cascadecms_request.log`. Assuming there has been activity within the CMS, the contents of the file will look similar to the following:
```
[13/Dec/2022:13:51:35 -0500] /ajax/navigationtree.act 127.0.0.1 GET HTTP/1.1 731 127.0.0.1 200[13/Dec/2022:13:51:36 -0500] /render/page.act 127.0.0.1 GET HTTP/1.1 4285 127.0.0.1 200[13/Dec/2022:13:51:36 -0500] /renderfile/355799867f0000010020a239cfb967ab/files/css/hh-standard.css 127.0.0.1 GET HTTP/1.1 485 127.0.0.1 200
```
**Note**: Additional parameters and options for request logging can be found in the official [Apache Tomcat docs](https://tomcat.apache.org/tomcat-9.0-doc/config/valve.html#Access_Log_Valve).**Note**: It is not currently possible to output the Cascade CMS username within the requests. Using the remote IP address for requests; however, you can utilize the Audit functionality (filtered by type "Login") to see corresponding IPs of Users.

---

### How do I enable DEBUG logging?

Additional logging can be added for the application by following the instructions below:
1. Click **Administration**.
2. In the **Tools** section, click **Logging Configuration**.
3. Choose a category from the dropdown or enter a class name in the text field. (Note: Class names will need to be provided by Hannon Hill Product Support.) Example class name:` com.hannonhill.cascade.aspect.ServiceAspectLogger`
4. Change the next drop down menu to **DEBUG**.
5. Click **Add Category**.
**Note: **DEBUG logging can be extremely verbose, so it is important that the logging is reset after the necessary DEBUG logging has been collected. To reset the logging, go into the **Logging Configuration** area as mentioned above and then click **Reset to Default** (top right).

---

### Internal Cascade API Changelog

## Cascade CMS 8.25
### New methods added to existing Cascade API objects
- New `com.hannonhill.cascade.apl.asset.common.PermissionLevel` enum added with values `NONE`, `READ` and `WRITE`
- New methods added to `com.hannonhill.cascade.apl.asset.home.PermissionsCapableAsset``getAllPermissionLevel()` - returns the `PermissionLevel` applied to all users that do not have an explicit ACL entry
- `setAllPermissionLevel(PermissionLevel)` - updates the `PermissionLevel` for the asset
- `addReadAccessUser(String)` - adds an explicit READ permission for the given user name
- `addWriteAccessUser(String)` - adds an explicit WRITE permission for the given user name
- `addReadAccessGroup(String)` - adds an explicit READ permission for the given group name
- `addWriteAccessGroup(String)` - adds an explicit WRITE permission for the given group name
- `clearPermissions()` - Clears explicit ACL entries and sets all permission level to NONE
New methods added to `com.hannonhill.cascade.api.asset.common.StructuredDataNode` for consistency with `DynamicMetadataField`:
- `getValue()`
- `getValues()`
- `hasValue(String)`
## Cascade CMS 8.22
### New Query API Methods
- $_.query().byDataDefinition
- $_.query().bySiteName
- $_.query().byFolderPath
- $_.query().hasAnyPaths
- $_.query().hasStructuredData
- $_.query().hasAnyStructuredDataValues
- $_.query().hasStructuredDataByFieldId
- $_.query().hasAnyStructuredDataValuesByFieldId
- $_.query().preloadDynamicMetadata
- $_.query().preloadStructuredData
## Cascade Cloud v20220802
### New methods added to existing Cascade API objects
- New methods added to `com.hannonhill.cascade.api.asset.home.StructuredDataCapableAsset``getStructuredDataNodeWithFieldId()` - returns the first found `StructuredDataNode` that matches given `field-id`
- `getStructuredDataNodesWithFieldId()` - returns a `List<StructuredDataNode>` of `StructuredDataNode` objects that match given `field-id`
New methods added to `com.hannonhill.cascade.api.asset.common.StructuredDataNode`
- `getChildWithFieldId()` - returns the first found child `StructuredDataNode` that matches given `field-id`
- `getChildrenWithFieldId()` - returns a `List<StructuredDataNode>` of child `StructuredDataNode` objects that match given `field-id`
- `getDefinitionFieldId()` - returns the `field-id` for the `StructuredDataNode`
## Cascade CMS 8.16
### New Cascade API Objects
- `com.hannonhill.cascade.api.asset.admin.ContentType` - represents a Content Type assetThis object inherits all methods from `SiteManagementAreaAsset`
`com.hannonhill.cascade.api.asset.admin.MetadataSet` - represents a Metadata Set asset
- This object inherits all methods from `SiteManagementAreaAsset`
`com.hannonhill.cascade.api.asset.admin.StructuredDataDefinition` - represents a Data Definition asset
- This object inherits all methods from `SiteManagementAreaAsset`
`com.hannonhill.cascade.api.asset.common.FieldItem` - contains the `label` and `value` information of an individual item that can be selected for a given checkbox, radio, dropdown or multiselect Dynamic Metadata or Structured Data field. If no label is present, the value will be used as the field item's label.`com.hannonhill.cascade.api.asset.common.ImageDimensions` - contains the width and height (in pixels) for an image file
### New methods added to existing Cascade API Objects
- New methods added to `com.hannonhill.cascade.api.asset.home.Page``getDataDefinition()` - returns `com.hannonhill.cascade.api.asset.admin.StructuredDataDefinition`, which is the Data Definition associated with the Page
- `getContentType()` - returns `com.hannonhill.cascade.api.asset.admin.ContentType`, which is the Content Type associated with the Page
New method added to `com.hannonhill.cascade.api.asset.home.XHTMLDataDefinitionBlock`
- `getDataDefinition()` - returns `com.hannonhill.cascade.api.asset.admin.StructuredDataDefinition`, which is the Data Definition associated with the Block
New method added to `com.hannonhill.cascade.api.asset.home.MetadataAwareAsset`
- `getMetadataSet()` - returns `com.hannonhill.cascade.api.asset.admin.MetadataSet`, which is the Metadata Set associated with the asset
New method added to `com.hannonhill.cascade.api.asset.home.File`
- `getImageDimensions()` - returns `com.hannonhill.cascade.api.asset.common.ImageDimensions`, which are the dimentions of an image file, if present
`DynamicMetadataField.getPossibleFieldItems()` and `StructuredDataNode.getPossibleFieldItems()` returns a `List<FieldItem>` of all possible field items that can be selected for a given checkbox, radio, dropdown or multiselect field. An empty list will be returned for fields that do not support selecting field items.`DynamicMetadataField.getSelectedFieldItems()` and `StructuredDataNode.getSelectedFieldItems()` returns a `List<FieldItem>` of all selected field items for a given checkbox, radio, dropdown or multiselect field. An empty list will be returned for fields that do not support selecting field items.
- Note: dropdowns that allow custom values will return a field item which uses the custom value as its `label` and `value`.
Added `StructuredDataNode.getLabel()` to access the label of a given Structured Data field.
### New Locator Tool Methods
- `locateFormat(String path, String siteName)` and `locateFormat(String path)` - returns a Format at the given path and in the given site (optional).
- `locateLinkable(String path, String siteName)` and `locateLinkable(String path)` - returns a Page, File, External Link, or Block at the given path and in the given site (optional).
### Improvements
- When working with API objects, metadata and dynamic metadata fields will be cached after loading to improve rendering time during operations such as sorting on dynamic metadata values.
## Cascade CMS 8.13
### Fixed
- The `TextBlockAPIAdapter.getText` method will no longer return a wrapping `<system-xml>` element with the Block's text content.
## Cascade CMS 8.12
### Improvements
- Consecutive calls with `structuredData`, `getStructuredDataNode()`, or `getStructuredDataNodes()` will now be cached to improve rendering times.
### Removed
- `StructuredDataNode.identifier.id` will no longer return an `id` for `group` elements.
## Cascade CMS 8.11
### New Cascade API Methods
- `DynamicMetadataField.hasValue(String)` - checks if the given value is within the selected values.
- `DynamicMetadataField.isDatetime()` - returns `true` if the field is a date-time field.
## Cascade CMS 8.9
### New Cascade API methods:
- `FolderContainedAsset.getTags()` - Returns a list of Strings that are tag names assigned to given asset.Velocity example: `#set($pageTags = $page.tags)`.
`Site.getAvailableTags()` - Returns a list of Strings that are tags available in given site, which includes system level tags. The resulting list has unique values and #is sorted alphabetically.
- Velocity example: `#set($allTags = $page.site.availableTags)`
### New Query API methods:
- `hasAnyTags(['tag1', 'tag2'])` - Limits the search results to assets that have at least one of given tags
- `hasTag('tag')` - Same as calling `hasAnyTags(['tag'])`
- `hasAnyMetadataValues(String fieldName, Collection<String> fieldValues)` - Same as calling the existing `hasMetadata(String fieldName, Collection<String> fieldValues)`, but the method name has been updated to be more clear about the method is doing (similar to `hasAnyTags`).Deprecated:  `hasMetadata(fieldName, values)`
The `toString()` method for Query API with the information about tagsThe hard max limit on Query API returned assets has been **increased from 500 to 2,000** to help with use cases where 500 assets was not enough.
- A note about performance: tests have shown that fetching 2,000 assets takes ~2 times longer than fetching 400 assets.
### Other Improvements
- The `FolderContainedAsset.getLinkingAssets()` method will now return assets linked through Data Definition chooser fields
## Cascade CMS 8.7
`Site` asset has 3 new methods:
- `getNamingRuleCase()`
- `getNamingRuleSpacing()`
- `getNamingRuleAssets()`
These methods return effective naming rules inside of that site. This means that if the `Site` inherits naming rules, the system-wide naming rules will be returned.
Also, a new method `transform()` has been added to `FilenameNormalizer` that transforms given asset's name based on the naming rules inside of the asset's site. 
```
systemName = utilityProvider.getFilenameNormalizer().transform(asset, systemName);
```
## Cascade CMS 8.6
### Improvements
- Added a new method `StructuredDataNode.hasTextValue(String)` that checks if the given value is within the selected values.
### Fixed
- `StructuredDataNode.getTextValues()` no longer returns an extra empty value.
## Cascade CMS 8.1.1
### New methods exposed on objects
Asset now expose a label property `$asset.label` that returns Display Name, Title, or the asset's system name -- whichever is populated first. This is convenience method for quickly accessing this information.
## 8.0.2
### New API objects
- New API object` com.hannonhill.cascade.api.asset.admin.Site` that represents a Site assetThis object inherits all methods from `PermissionsCapableAsset`
- In addition to these methods, it has `getUrl``()` method that returns String URL of the Site.
New class that API objects inherit from `com.hannonhill.cascade.api.asset.admin.SiteManagementAreaAsset`
- This class inherits from com.hannonhill.cascade.api.asset.common.PermissionsCapableAsset
- It contains method getSite() which returns` com.hannonhill.cascade.api.asset.admin.Site,` which is a Site in which the asset is located.
API objects that now inherit from `com.hannonhill.cascade.api.asset.admin.SiteManagementAreaAsset`:
- `com.hannonhill.cascade.api.asset.admin.DestinationContainer`
- `com.hannonhill.cascade.api.asset.admin.Transport`
- `com.hannonhill.cascade.api.asset.admin.Destination`
- `com.hannonhill.cascade.api.asset.admin.AssetFactory`
### New methods in existing API objects
- New method in` com.hannonhill.cascade.webservice.schema.FolderContainedAsset``getSite() `- returns` com.hannonhill.cascade.api.asset.admin.Site,` which is a Site in which the asset is located.
New method in `com.hannonhill.cascade.api.asset.common.BaseAsset`
- `getAssetType``()` - returns a String that represents the type of the current asset, equivalent to calling `getIdentifer().getType().toString()`
New method in `com.hannonhill.cascade.api.asset.home.Block`
- `getBlockType``()` - returns a String that represents type of the block
New method in `com.hannonhill.cascade.api.asset.home.Format`
- `getFormatType()` - returns a String that represents type of the format
New method in `com.hannonhill.cascade.api.asset.home.MetadataAwareAsset``getLinkingAssets()` - returns a List of `com.hannonhill.cascade.api.asset.home.FolderContainedAssets`that contain links to this asset in their content through ', language: 'en', searchInputs: ['cludo-search-form', 'cludo-search-form-top'], hideSearchFilters: true, focusOnResultsAfterSearch: true, type: 'inline', template: 'InlineBasic', disableAutocomplete: true, }; CludoSearch = new Cludo(cludoSettings); CludoSearch.init();})();

---

### Login Failed

This article describes steps that Administrators can take to troubleshoot failed login attempts for their users.
**Note**: If you are an end user receiving this message when you attempt to log in, pay special attention to uppercase and lowercase letters in your username as the system is case sensitive. In most cases, usernames will be all lowercase and they will not contain the domain portion of your email address ('@your-org.com', for example). Reach out to your CMS administrator if you believe you are entering your credentials correctly but are still receiving errors.
In most cases, the reason for a user encountering this error will be due to them entering the wrong username (case matters!) and/or password. Assuming these have been ruled out, proceed to the next steps below.
## Verify that the user's account is Enabled
1. As an administrator, go into the **Administration** area and click on the **Users** link.
2. Click on the user account in question.
3. Confirm that the "Enabled" field is set to "Yes".
**Note**: If you are unable to access the interface (due to a 'Login Failed' error with your own account), you can verify whether or not the account is enabled by executing a database query like the following against your Cascade CMS database:
```
select isEnabled from cxml_user where username = '{username}';
```
(making sure to replace `{username}` with the username in question).
- A result of 0 means the account is *disabled*.
- A result of 1 means the account is *enabled*.
To enable a disabled account, execute the following query:
```
update cxml_user set isEnabled = 1 where username = '{username}';
```
If the user's account is enabled but they still receive the error, continue troubleshooting by following the steps below.
## Determine how the user is attempting to authenticate
1. As an administrator, go into the **Administration** area and click on the **Users** link.
2. Click on the user account in question.
3. Check the value listed for the "Authentication" field. It will be 1 of the 3 types listed below: - **Normal** - The user's account is managed entirely within Cascade CMS (the username and password are stored locally in the Cascade CMS database). If the user's account is enabled but they still receive a 'Login Failed' message when attempting to log in, an administrator should change the user's password and then provide the user with a new password. At that point, verify that the user is able to log in using the new password provided. - **LDAP** - The user's account is managed in your organization's existing LDAP/Active Directory instance. To investigate further, LDAP/AD administrators will want to see if the user account in question has an expired password (in which case a new password must be provided to the user) or if the user has simply entered a bad password (in which case the user may need to be provided with a new password as they may have forgotten the current one). In Active Directory, for example, the status of a user account can be found in the Attribute Editor. Specifically, you can check the badPasswordTime attribute to verify whether or not the user recently entered a bad password. - **Custom** - The user's account is managed in your organization's SSO system (CAS, Shibboleth, etc.). Your SSO administrator will need to check for errors related to the user's account from around the time of the failed login attempt(s).
**Note**: If you are unable to access the interface (due to a 'Login Failed' error with your own account), the authentication type for a user account can be determined by executing the following database query:
```
select authmode from cxml_user where username = '{username}';
```
- A result of 0 means the account is a "Normal" account.
- A result of 1 means the account is an "LDAP" account.
- A result of 2 means the account is a "Custom" account.
Still having trouble? Feel free to reach out to Hannon Hill Support and our team can help you troubleshoot further.

---

### Problems connecting via SFTP to Solarwinds Serv-U servers

When attempting to publish via SFTP to a Solarwinds Serv-U 15.3.2+ server, one or both of the following error messages may be seen in publish reports:
```
SFTP error: connection resetSFTP error occurred during SFTP Shuttle initialization: Session.connect: java.io.IOException: End of IO Stream Read
```
The messages are the result of updates made in Serv-U 15.3.2 which ultimately prevent Cascade CMS from being able to establish an SFTP connection.
To correct this issue, we recommend following the steps outlined in **Resolution 1** of the Solarwinds article here:
[SFTP connection not established for legacy Java clients](https://support.solarwinds.com/SuccessCenter/s/article/SFTP-connection-not-established-for-legacy-Java-clients?language=en_US)
In summary, resolution of the issue involves taking the following steps on the Serv-U server:
- Apply the Serv-U 15.3.2 hotfix 1 
- Enable non-RFC compliant connections using the new option: **Allow non-RFC compliant SSH protocol version exchange**

---

### The driver could not establish a secure connection to SQL Server by using Secure Sockets Layer (SSL) encryption. Error: "Unexpected rethrowing"

This particular error message can appear on startup. The full message will typically appear as the following:
`Error occurred fetching database vendor type: Cannot create PoolableConnectionFactory (The driver could not establish a secure connection to SQL Server by using Secure Sockets Layer (SSL) encryption. Error: "Unexpected rethrowing".)`
To resolve this issue:
- Stop Cascade CMS if it is running
- Edit the file `tomcat/conf/context.xml`
- Add the parameter `sslProtocol=TLSv1.2` to the existing connection string
For example, if your connection string is:
```
url="jdbc:sqlserver://yourDatabaseServerHost:1433;databaseName=CascadeCMS;SelectMethod=cursor"
```
The modified connection string will be:
```
url="jdbc:sqlserver://yourDatabaseServerHost:1433;databaseName=CascadeCMS;sslProtocol=TLSv1.2;SelectMethod=cursor"
```
- Start Cascade CMS``

---

## Other

*102 articles in this category*

### Accessibility

Cascade CMS offers a variety of features to help you create and publish accessible content. Learn more about accessibility features in Cascade CMS here.

---

### Accessibility Report

## Overview
The site Accessibility Report allows you to monitor and review WCAG 2.0 Level A - AAA accessibility issues across an entire site, based on a weekly report of content rendered within Cascade CMS. A list of issues is provided with links to relevant areas on the page and details about the violation, remediation steps, and the specific WCAG guidelines in violation.
The checker leverages the [Tenon.io](https://tenon.io/) accessibility API and is available for Cascade Cloud clients only.
## Enabling the Report
First, enable the Accessibility Report for your system:
1. Click the system menu button ( * *) > **Administration** > **Accessibility Checking**.
2. Under **Accessibility Check Configuration** choose which day of the week and time the report should run.
3. Click **Submit**.
Next, enable the Accessibility Report for one or more sites:
1. Choose your site from the **Site** menu and then select **Manage Site** > **Site Settings**.
2. Under **Accessibility Checking**, enable the **Accessibility Checker** option.
3. Click **Submit**.
4. Repeat these steps for each additional site for which you want to enable the report. A report will be available for the site in the **Reports** area after the next scheduled report date/time.
**Tip** - To avoid impacting system performance for users, we recommend configuring the Accessibility Report to run on a day and time when there will be few users working in the system, such as early morning on a weekend.
## Viewing the Report

Once the Accessibility Report has been enabled for your system and run for at least one site, you can view the report under **Reports** > **Accessibility Report**. To get started, choose a report-enabled site under **Filter Results**.
The following options are available to filter the results of the report:
- **Site** - An enabled site must be chosen to view report content.
- **WCAG Compliance Level** - Choose which WCAG level issues to include in the report. Note that this option is cumulative, so Level AAA will also include Level AA and Level A issues.
- **Hide Reviewed** - Enabling this option will hide issues that have been marked "Reviewed" from the report.
In the report summary, the percentage of pages with accessibility issues, the total number of issues, and total number of issues marked as "Reviewed" will be displayed.
## Reviewing Issues
To get started reviewing issues, you can either choose the **Page with the most issues** or **Start with a specific page** to open the page chooser. Click on any page in the chooser to view the list issues for that page.
In the page view, you'll see a static rendering of the page on the right, and a list of issues detected on the left. Click any issue in the list to highlight the region of the page where the issue occurs.
When an issue is highlighted, you'll see a description of the issue and remediation advice. You can also choose to:
- **See more details** - Click this link to see the exact HTML markup that was flagged.
- **Mark issue as reviewed** - Click this link to mark the issue as reviewed in the report.You can choose to hide issues marked as "Reviewed" using the **Filter Results** menu.
- Note that an issue will be re-listed as "Not Reviewed" if the same issue is detected during the next report.
Use the **Previous Page** and **Next Page** buttons to review each page in the report, or click the page chooser button to open the chooser and navigate to a specific page.
**Tip** - Right-click on the page chooser button to open the context menu for the current page. From the context menu, you can choose to **View** the page or open the page's **Edit** screen directly without leaving the report.

---

### Adding a caption to a table

To add a caption to a table:
- Click anywhere in the table to select it.
- In the menu bar that appears, click the **Table properties** icon.
- Under the **General** tab, select the **Caption** checkbox.
- Click **Ok**. At this point, a caption area will appear above the first table row.
- Place your cursor in the caption area and enter the text for your caption.

---

### Adding a caption to an image

To add a caption to an image:
- In the editor, click on the image that you wish to add a caption for.
- Click the **Insert/edit image** icon (alternatively, you can right-click on the image and select **Image**).
- In the popup dialog box, click the **Advanced** tab.
- Check the option **Use figure and figcaption for this image**.
- Click **Ok** (at this point, the word "*Caption*" will appear underneath your image).
- Modify the "*Caption*" text as needed to include your own caption.

---

### Adding a table header and footer

To add `<thead>` or `<tfoot>` elements to a table:
- Right-click somewhere in the row that you wish to specify as the table header or table footer.
- In the pop-up menu that appears, select **Row -> Row Properties**.
- In the pop-up dialog box under the **General** tab, use the **Row type** dropdown to select **Header** or **Footer** (depending on your use case).
**Note**: While **Body** is also an option for the **Row type,** the system automatically includes `<tbody>` tags for you when you create a table so this is option is typically not needed.
- Optionally set the **Alignment** and **Height** fields.
- Click Ok.

---

### Adding classes to tables

To apply a class to different areas of a table:
- Click the table, row, or cell where you wish to apply a class.
- Click the **Format** menu option, then select **Formats -> Custom**.
- Select the appropriate class name to apply it to your selection. 
**Notes**:
- Not seeing any classes under the **Formats -> Custom** menu? This would indicate that your developers have not configured any classes for you to apply to the content in the underlying WYSIWYG Editor Configuration and you need to reach out to them to request that they configure Custom Formatting options for you.
- If you're seeing class name under the **Formats -> Custom** menu but they appear greyed-out/disabled, that indicates that no classes are available for the element you've selected. See the tip below for verifying that you've targeted the correct tag in the editor when attempting to apply a Custom Format.
**Tip: **
When making selections in the WYSIWYG editor, the status bar at the bottom of the editor will display the element path for the selected element (and its parent elements). These elements are clickable and allow for you to easily target a specific element within a table. 
For example, if you need to apply a class to a table row, you must first click into a row which will select a table cell by default. In the status bar, this will appear as **table » tbody » tr » td**. Clicking the **tr **in the element path will select the table row (`<tr>`) and allow for you to apply a class to it as opposed to the table cell (`<td>`). Similarly, you can select the **table** element in the element path in order to target it so that you can apply a class directly to the `<table>` element.

---

### Adding header cells to a table

To add header cells to a table along with a scope attribute:
- Right-click in the cell that you wish to make a header cell.
- In the pop-up menu that appears, select **Cell -> Cell Properties**.
- In the **Cell type** field, select **Header cell**.
- Using the **Scope** field, set the scope as needed (options are None, Row, Column, Row group, Column group).

---

### AI Content and SEO Suggestions

## Overview  
Introducing Cascade CMS intelligence: new features to help you quickly create effective and SEO friendly content including metadata titles, summaries, keywords and alternative text for images.
## Using AI Suggestions
On any field with AI suggestions, you'll see the AI icon. Click it to generate content like titles, summaries, descriptions and keywords based on the asset's content. You can generate suggestions more than once and accept the ones.
When inserting images into content with the editor, use the AI suggest link to create alternative text description for an image using the image itself.

## Enable AI Suggestions
To get started, an administrator or someone with access to "Access Administration Area" and "Edit system preferences" Role abilities must navigate to the Administration menu > Administration > AI Features and opt-in. This gives your consent to share your content with our custom-built, third-party AI assistants.

---

### Announcements

## Overview
Announcements allow administrators to create and display messages to users working in the CMS. Notify users about scheduled maintenance, provide links to your own documentation or training materials, or display contact information for your web team or help desk.
## Creating Announcements

To create an announcement:
1. Click the system menu button (  *) > **Administration** > **Announcements**.
2. Click **Create**.
3. Fill in the following fields: - **Announcement Type** (required) - used to determine the style of the message.**Notification** - displays a popup-style message to all active users and users who log in before the announcement expires and persists until the user dismisses the message. - **Sticky** - displays in a Sticky widget on all user Dashboards and persists until the announcement is deleted.
4. **Subject** - a title displayed at the top of the message.
5. **Message** (required) - the content of the message.
6. **Start showing on** (for Notifications) - specifies when the message should start being displayed to users. If left blank, the message will start being displayed immediately.
7. **Stop showing on** (for Notifications) - specifies when the message should no longer be displayed to users. If left blank, the announcement will not expire.
8. Click **Submit**.
## Viewing and Deleting Announcements
The **Announcements** screen displays a list of all active and pending announcements and their authors. You can edit existing Sticky announcements at any time and Notifications before their start time has passed. Announcements that have expired (the **Stop showing on** date has passed) will not be displayed here.
To edit Sticky announcements or pending Notifications:
1. Click the announcement you'd like to edit.
2. Click the **Edit** link.
To delete active or pending announcements:
1. Use the checkboxes to select the announcement(s) you'd like to delete.
2. Click the **Delete** button that appears above the table listing to remove the selected announcement(s).
3. Alternatively, click the announcement you'd like to delete and then click the **Delete** link.

---

### Authentication

Cascade CMS can authenticate users natively, through an external LDAP server, or via custom authentication.

---

### Background Tasks

## Overview
The Background Tasks report provides a list of completed and running tasks in the system, including:
- Broken Link Report
- Build Search Index
- Copy
- Daily Content Report
- Google Analytics Sync
- Page Render (longer than 10 seconds)
- Recycle Bin Purge
- Site Export
- Site Import
- Scheduled LDAP Sync
The list of results contains the following information:
- **Task Type** - see above.
- **Initiated By** - the username of the user who initiated the task. For scheduled tasks this will be the system user.
- **Start Date** - the time the task was initiated. Hover over this column for for an exact date/time.
- **End Date** - the time the task completed or failed. Hover over this column for an exact date/time.
- **Related Asset** - for tasks such as page renders, the asset associated with the task.
- **Status** - indicates if the task completed, failed, or is still running.
- **Duration** - the time the task took to complete or fail.
## Filtering the Report
The following filters are available to refine the results of the report:
- **Start Date** - tasks initiated after the selected date/time.
- **End Date** - tasks that completed or failed before the selected date/time.
- **Minimum Duration in Seconds** - tasks that took longer than the selected duration to complete or fail.
- **Task Type** - see above.
- **Task Status** - whether the task completed, failed, or is still running.

---

### Comments and Mentions

## Mentioning Users (@mention)

Certain comment areas support the use of @mentions as a means to include users into a conversation by simply referencing their username with an `@` symbol. When a user is mentioned, they will receive a notification within Cascade CMS as well as an email notification.
**Note** - Email notifications will only be sent if Cascade CMS is properly configured to send email and the user mentioned has a valid email address.
## Asset Comments
All assets within the Site Content area support threaded commenting to provide a discussion about the asset. Individual comments can be replied to, (un)resolved, and deleted. Asset comments support [@mentions](#@mention).
## Task Comments
When interacting with Tasks in Cascade CMS, the comments field supports [@mentions](#@mention).
## Workflow Comments
Each transition step when an asset goes through Workflow contains a comments field allowing for a conversation about what has changed or to provide actionable feedback between transition steps.
## Version Comments
All assets within the Site Content area have a comments field during submission to enter information about what has changed for that particular version.
### Automatic Version Comments
Comments for a particular version of an asset will be automatically populated while a user is editing that asset. Periodically, when a draft is saved for an asset, the version comments field located at the bottom of the screen will be populated with information about fields that have been modified.  
The content of the comment will change depending on the number of fields updated and whether or not fields were cleared, updated, or went from being empty to being populated. For smaller changes, the content of modified fields will be included. As the number of fields changed grows, only the name of each field will be listed along with information about how the field was changed (cleared, updated, or populated). If the number of fields changed grows to a very large number, a comment reporting only the number of fields changed will be generated.
This auto-populated comment can be modified or cleared if the user wishes to customize the version comment or not to submit a version comment at all.
### Other Automatic Comment Scenarios
Listed below are other scenarios in which version comments will be automatically generated:
- Creating a new asset.
- Copying an asset.
- Importing an asset using Import Site.
- Importing an asset using a zip archive.
- Activating a previous version.

---

### Comparison method violates its general contract

During certain Velocity and XSLT transformations, you may encounter an error like the following:
```
An error occurred while rendering asset preview: org.apache.velocity.exception.MethodInvocationException: Invocation of method 'sort' in class com.hannonhill.cascade.velocity.NodeSortTool threw exception java.lang.IllegalArgumentException: Comparison method violates its general contract!
```
This typically occurs when one or more objects are missing a value for the property that is being used to sort on. 
Consider the following code which is intended to sort a number of stories by their Start Date:``
```
#set($stories = $_XPathTool.selectNodes($contentRoot, "/system-index-block/system-page"))$_SortTool.addSortCriterion("start-date", "en", "number", "descending", "upper-first")$_SortTool.sort($stories)
```
If any of those stories don't happen to have a value for their start-date, the sorting will fail with the aforementioned error. To prevent this from happening, one of the following strategies can be utilized:
**Using XPath:**
Rather than simply selecting all Pages and then attempting to sort by their Start Dates, you can select only Pages that have Start Dates to begin with by changing this line:
```
#set($stories = $_XPathTool.selectNodes($contentRoot, "/system-index-block/system-page"))
```
to this:
```
#set($stories = $_XPathTool.selectNodes($contentRoot, "/system-index-block/system-page[start-date]"))
```
**Using $_ListTool:**
Pages without a Start Date can be removed from consideration by using the ListTool's `removeNull` method just prior to sorting. For example:
```
#set($stories = $_XPathTool.selectNodes($contentRoot, "/system-index-block/system-page"))#set ($removed = $_ListTool.removeNull($stories, "child(start-date)"))$_SortTool.addSortCriterion("start-date", "en", "number", "descending", "upper-first")$_SortTool.sort($stories)
```
Optionally, you can then see which Pages did not have a Start Date by iterating over each of those items and outputting their path. 
```
#foreach ($r in $removed) $r.getChild("path").value#end
```

---

### Configuring a robots meta tag

This article walks through a sample setup that will allow for a "robots" meta tag to be included in the source of one or more pages. Using these options, it's possible to instruct search engines as to whether or not they should index particular pages and/or crawl links on those pages.
## Template setup
The very first step here will be to include a region in your Template where the resulting `<meta>` tag will be placed in the source code of your page(s).
- Edit the Template that your Pages are using
- Within the `<head>` tags somewhere, add the following code and save:
```
<system-region name="ROBOTS"/>
```
## Metadata Set setup
We'll add a field to our Metadata Set which will allow for users that edit Pages to select whether or not a Page should be indexed by search engines as well as whether or not links should be analyzed by search engines.
- Edit the Metadata Set that your Pages are using
- Switch to the **Custom Fields** tab
- Click to add a new **Checkbox** field
- Fill out the following fields with the values seen below:**Name**: *search-engine-options*
- **Field Label**: *Search engine behavior*
- **Help Text**: *Specify how this page should be treated by search engines in terms of appearing in search results and link crawling*
Under the **Configuration** field, switch to the **XML** tab
- Copy/paste the following XML into that field and click **Submit**
```
<checkbox> <item label="Prevent indexing of this page">noindex</item> <item label="Prevent crawling of links in this page">nofollow</item></checkbox>
```
## Format setup
With our metadata option set up, we now need to write a Velocity Format which will check to see which (if any) of the options have been selected for a Page and then output the corresponding `<meta>` tag based on those selections.
- Create a new Velocity Format
- For the contents of the Format, enter the following code:
```
#set ($searchEngineOptions = $currentPage.metadata.getDynamicField("search-engine-options"))#set ($robotsContent = $_DisplayTool.list($_ListTool.toList($searchEngineOptions.values), ","))#if (!$_PropertyTool.isEmpty($robotsContent))<meta name="robots" content="${robotsContent}"/>#end
```
## Final steps
Now that all of the pieces are in place, the final step of the process is to attach our Velocity Format to the "ROBOTS" region that we created in our Template. This assignment can be done at the Template level, the Configuration, or the individual Page level (just depending on which Pages you want to inherit that setup).
The most common method is to attach the Format to the region at the Template level (so that all Pages using that Template have the region available as a placeholder for that `<meta>` tag).
## End result
When users go to edit a Page that uses both the Template and Metadata Set as described above, the options will appear as indicated in the screen shot below:
If no options are selected, no `<meta>` tag will be added to the Page's source code. If one or both of the options are selected, the tag will be included with the corresponding attribute values. For example, if both options are selected, the output will be:
```
<meta content="nofollow,noindex" name="robots"/>
```
**Notes**:
- The sample above is just one of many different ways that you could approach this type of setup. Feel free to modify any of the steps here as needed for your specific use case.
- The term "indexing" in this article is *not to be confused with an asset's "Include when indexing" option* (which is specific to the CMS and has no effect/is unrelated to search engine behavior).

---

### Configuring Cascade CMS to point to a Java installation

## Overview
In order for Cascade CMS to use a particular Java installation, you'll need to make sure that the boot script is updated accordingly. Follow the instructions below that match your O/S (along with the method you use to start Cascade).
## Linux/*nix
1. Edit the *cascade.sh* file.
2. ``Update the `JRE_HOME` variable at the top of the script and point it to the new Java installation. Ex.: `export JRE_HOME=/usr/java/jdk11.0.7 `
## Windows (service)
1. Open Windows Explorer.
2. Navigate to *tomcat/bin*`` within the Cascade CMS installation folder.
3. Right-click the ``*cascadew.exe* file and select **Run as Administrator**
4. Click the **Java** tab.
5. In the **JVM** field, browse to the *jvm.dll*`` file within the new Java installation (Ex. path: ``*C:\Program Files\Java\jdk11.0.7\bin\server\jvm.dll*)
6. Click **Apply**/**OK**.****
7. Start/Restart the Cascade CMS service.
## Windows (command line)
1. Edit the *cascade.bat* file.``
2. Update the `JRE_HOME` variable at the top of the script and point it to the new Java installation. Ex.: `set JRE_HOME=C:\Program Files\Java\jdk11.0.7`

---

### Configuring table properties

To configure properties for a table:
- Click anywhere in the table to select it.
- In the pop-up menu that appears, click the **Table properties** icon (far left).
You'll be presented with 2 tabs: General and Advanced.
**General**
In the General tab, you can optionally enter values for **Width**, **Height**, **Cell spacing**, **Cell padding**, and **Border**. Values can be entered in number of pixels or by including a `%` sign. 
Additionally, you can set the **Alignment** of your table here (**None**, **Left**, **Center**, **Right**) and add a **Caption** if needed. See the page Adding a caption to a table for more details. 
**Advanced**
In the Advanced tab, you can choose to enter styles within the **Style** field. Fields are also available for setting a **Border color** as well as a **Background color**.

---

### Configuring the Heap Dump on Out of Memory option

## Overview
The steps listed below can be used to configure Cascade CMS to generate a heap dump file in the event that it runs out of memory. Heap dump files can be very useful when troubleshooting potential memory issues in the Cascade CMS environment.
**Important**: This option should be configured only as directed by the Hannon Hill Product Support team.
## Linux/*nix
1. Stop Cascade CMS.
2. Edit the ``*cascade.sh* file (found in the Cascade CMS root directory).
3. Add the parameter `-XX:+HeapDumpOnOutOfMemoryError` to the `JAVA_OPTS` variable.
4. Optionally add a parameter `-XX:HeapDumpPath=/path/to/directory` to specify a location where the heap dump will be stored (by default it will be placed in the working directory).
5. Restart Cascade CMS.
Example:
```
export JAVA_OPTS="-Xmx4096M -XX:MaxPermSize=192m -XX:+HeapDumpOnOutOfMemoryError -Djava.awt.headless=true -Dfile.encoding=UTF-8"
```
The resulting heap dump file will be will be named *java_pid<pid>.hprof* (where `<pid>` is the process id of the Java process).
## Windows (service)
1. Using Windows Explorer, navigate into the *tomcat/bin*`` folder.
2. Right-click the *CascadeCMSw.exe* file.
3. In the configuration UI click on the **Java** tab.
4. Add this line in the **Java Options**`` box: `-XX:+HeapDumpOnOutOfMemoryError`
5. Optionally add a line `-XX:HeapDumpPath=/path/to/directory` to specify a location where the heap dump will be stored (by default it will be placed in the working directory).
6. Click **Apply**.
7. Restart the Cascade CMS service.
The resulting heap dump file will be will be named ``*java_pid<pid>.hprof* (where `<pid>` is the process id of the Java/Tomcat process).
## Windows (command line)
1. Stop Cascade CMS.
2. Edit the ``*cascade.bat* file (found in the Cascade CMS root directory).
3. Add the parameter `-XX:+HeapDumpOnOutOfMemoryError` to the `JAVA_OPTS` variable.
4. Optionally add a parameter `-XX:HeapDumpPath=/path/to/directory` to specify a location where the heap dump will be stored (by default it will be placed in the working directory).
5. Restart Cascade CMS.
Example:
```
set JAVA_OPTS="-Xmx4096M -XX:MaxPermSize=192m -XX:+HeapDumpOnOutOfMemoryError -Djava.awt.headless=true -Dfile.encoding=UTF-8"
```
The resulting heap dump file will be will be named *java_pid<pid>.hprof* (where `<pid>` is the process id of the Java process).

---

### Content Checks

## Overview
You can check new and revised assets for spelling errors, invalid internal or external links and accessibility issues with Cascade CMS's built-in content checks.
To run these checks, ensure they're enabled for your site and select **Check Content & Submit** when creating or submitting an asset for changes.
**Tip** - You can enforce content checks for users by disabling the **Bypass Accessibility, Link, and Spell Checks when submitting content changes** ability in their Site Role.
## Spell Check
The Spell Check checks and reports all words (in asset content and metadata) that are not found in the system dictionary.
Depending on your role abilities, you have the following options for handling each misspelled word:
- **Add** - Add the word to the system dictionary.
- **Ignore** - Disregard the word.
- **Fix** - Enter your own correction or choose from a list of suggested replacements.
**Note** - Only users with the **Modify Dictionary** ability enabled in their System Role can add words to the system dictionary.
## Link Check
The Link Check ensures that all links between assets in the system and links to external resources are valid. The **Broken Link** column lists the URL of the broken link, and the **Link Text** column lists the text wrapped for hyperlinks or the tag name for other types of links. You can click the question mark icon ( * *) to the left of each link for more information on why the link is considered invalid.
You have two options for handling each broken link:
- **Ignore** - Disregard the link.
- **Fix** - Enter a corrected URL in a text box (for external links) or choose an asset within Cascade CMS via an asset chooser (for internal links).
#### Scheme-relative Link Checking
External links that do not include a protocol, such as "//google.com" rather than "http://google.com" or "https://google.com" are called scheme-relative links. On the live site, they will navigate the website visitor to the same protocol as the page they are on. Cascade CMS follows a slightly different checking routine for such links as it cannot predict which protocol the visitor is going to view the page on. It verifies the link works with any of the two protocols and reports the link as broken only if the connection fails for both of these protocols.
## Accessibility Check
The Accessibility content check ensures WYSIWYG content complies with the following accessibility guidelines:
- Image (`img`) tags must have alternate text describing the graphic. (Section 508 / WCAG 2.0)
- Table captions should not be empty. (HTML5 recommendation.)
For each issue found, you have the following options:
- **View Non-Compliant Content** - View the specific HTML markup flagged during the check.
- **Ignore** - Disregard the issue.
- **Fix** - Enter a value for the missing or flagged content. For example: alternate text for an image or caption for a table.
## Enabling Content Checks
#### At the System Level
1. Click the system menu button ( * *) > **Administration** > **Preferences** > **Content**.
2. Under **General** > **Content Checks** select one or more options.
3. Click **Submit**.
#### At the Site Level
1. Navigate to **Manage Site** > **Site Settings**.
2. In the **Properties** tab, select one or more options under **Content Checks**.
3. Alternatively, select **Inherit from system preferences** to enable the content checks selected in your system preferences.
4. Click **Submit**.

---

### Content Inventory Report

## Overview
The Content Inventory Report provides users with an overview of the assets contained within a Site. The report allows for Users to filter on various properties as described below.

## Filtering the Report
The following filters are available to refine the results of the report:
- **Site** - A Site must be selected to display report data.
- **Asset Types** - Select to display Blocks, Files, Pages, and/or Links. Additional filtering options are available to display those assets based on their indexing status, whether they are potentially unused, and/or if they are in an active Workflow.
- **Publish Status **- Select one of the following:any publish status
- are publishable
- are previously published
- have edits that have not been published
- are publishable but have never been published
- are not publishable
**Owner **- Optionally select from the following:
- any owner
- owned by me
- selected owners (a chooser will appear to allow for multiple Users to be selected)
- no owner
**Review date **- Optionally filter by various Review Dates.**Last updated **- Optionally filter by when assets were last updated.**Restrict to folders** - Optionally limit the results to assets within specified folders.
## Assign Content Ownership
Assets can be assigned owners from the Content Inventory report or directly from the asset. When assigning content ownership, remember:
- You must have write access to an asset to assign the content owner.
- You must share a Group with the User to whom you're assigning the asset or have the ability to view all Users.
To assign/unassign ownership of asset(s) from the report:
1. Select one or more assets from the results list.
2. To assign/re-assign ownership of asset(s), click **Assign owner** from the top of the list and select a User or click **Choose myself** to assign yourself ownership of the asset.
3. To unassign ownership of asset(s), click the **Unassign selected** icon from the top of the list.
To assign/unassign ownership directly from the asset:
1. While viewing the asset, click **Details** > **Properties**.
2. To assign/re-assign ownership, click **Choose User** in the **Content Owner** field and select a User or click **Choose myself** to assign yourself. You can clear the assignment by clicking the "x" icon.
## Identify Stale Content
The Content Inventory report can be used to display a list of assets that have not been modified within a specified time period. The definition of what content is considered stale is specific to each user, and only assets for which the user has write access are included in the results.
To identify assets that may be stale, use the **Last updated** dropdown to filter by items that were last updated within the following time periods:
- 30 days
- 60 days
- 90 days
- 120 days
- 360 days
## Send a Stale Content Notification

To send a stale content email notification:
1. Select one or more assets from the results list.
2. Click the **Notify by Email** envelope icon at the top of the list.
3. Click **Choose Users and Groups** and select Users/Groups to receive the notification email. You may also enter a comma-delimited list of email addresses.
4. Optionally, add a message to the notification recipients. By default, the system will send the user an email containing a brief description and link to the asset needing review.
5. Click **Notify**. An email will be sent using the email options configured in your System Preferences.
## Schedule a Review Date

To schedule a review date:
1. Select one or more assets from the results list.
2. Click the **Schedule Review** calendar/clock icon at the top of the list.
3. Select a date for future review. Options include 1 month, 3 months, 1 year, or a specific date.
4. Click **Schedule Review**. This will update the asset Review Date metadata field to the specified date. Modifying an item’s Review Date does not change the item’s Last Modified date.
## Identify Unused Assets
To see a list of suggested unused assets in the report, use the **Filter Results** button above the report and select the **Show only assets that are potentially unused **check box.
Assets listed in the results have no linked or manual Relationships with other assets in Cascade CMS; however, they may still be in use and/or linked indirectly via Format. For example, a news listing may link to news articles via the Query API, but the individual article pages may not have any Relationships.
If there are assets in the report that you know are in use but have no Relationships, you have the option to create a manual Relationship to an appropriate asset as described in the section that follows.
## Create a Manual Relationship to an Asset
To create a manual relationship for an asset in the report:
1. Select an asset from the list.
2. Click the **Create a manual relationship** button at the top of the list.
3. Click **Choose publishable site content** and select the asset(s) you wish to manually link to the current asset.
## Unpublish Assets
To unpublish one or more assets in the report:
1. Select one or more assets from the list.
2. Click the **Unpublish** ( * *) icon at the top of the list.
## Delete Assets
To delete one or more assets in the report:
1. Select one or more assets from the list.
2. Click the **Delete** ( * *) icon at the top of the list.
## Export Results as a CSV File
Information visible in the Content Inventory report can be exported as a CSV file using the **Export CSV** link in the top right corner. The file will also contain information about the current user, Site name, and type of report.

---

### Content Ownership Report

## Overview

The Content Ownership report displays assets owned by users in the system. Content owners are responsible for maintaining their content and will be the default recipient for notifications on issues related to that content. Content owners can be assigned to Pages, Files, Folders, Blocks, Formats and External Links. Assets created using the **Add Content** menu or via **Copy** or zip archive are automatically assigned a content owner based on the user that created them.
From the Content Ownership report, assets can be assigned/unassigned an owner either individually or in bulk. Users can see all assets to which they have read access. Reporting exists for viewing both owned and un-owned content.
## Filtering the Report

The following filters are available to refine the results of the report:
- **Site **- A Site must be selected to display report data.
- **Assets owned by me** - will display assets to which the current User is assigned as the owner.
- **Assets owned by selected owners** - will display assets owned by Users selected via the chooser. Leaving the field empty will result in all assets with any owner being displayed.
- **Assets with no owner** - will display all assets that do not have an owner.
## Assigning Content Ownership
Assets can be assigned owners from the Content Ownership report or directly from the asset. When assigning content ownership, remember:
- You must have write access to an asset to assign the content owner.
- You must share a Group with the User to whom you're assigning the asset or have the ability to view all Users.
To assign/unassign ownership of asset(s) from the report:
1. Select one or more assets from the results list.
2. To assign/re-assign ownership of asset(s), click **Assign owner** from the top of the list and select a User or click **Choose myself** to assign yourself ownership of the asset.
3. To unassign ownership of asset(s), click the **Unassign selected** "x" icon from the top of the list.
To assign/unassign ownership directly from the asset:
1. While viewing the asset, click **Details** > **Properties**.
2. To assign/re-assign ownership, click **Choose User** in the **Content Owner** field and select a User or click **Choose myself** to assign yourself. You can clear the assignment by clicking the "x" icon.

---

### Content Review

## Overview
The Review Date metadata field helps you to keep your content up to date by allowing you to schedule reviews for assets. For assets with a Review Date specified:
- The asset's Content Owner will receive upcoming review date notifications via email 7 days leading up to the Review Date.
- If the assets are workflow-enabled, an edit workflow will be started on the Review Date. See Review with Workflow.
Assets with upcoming review dates will be listed in the Content Reviews report and content ownership can be reviewed and reassigned in the Content Ownership report.
## Scheduling a Review
#### On an Asset
To schedule a review on an asset:
1. While viewing an asset, click **More** > **Schedule Review**.
2. To schedule a recurring review, enable **Review on a Schedule** and select an interval from the options provided: - Every Month - Every 3 Months - Every 6 Months - Every Year
3. To schedule a single review in the future, disable **Review on a Schedule** and select a review date from the options provided: - 1 month from now - 3 months from now - 6 months from now - 1 year from now - Calendar (Date Selection)
4. Click **Schedule Review**. This will update the asset Review Date metadata field to the specified date. Modifying an item’s Review Date does not change the item’s Last Modified date.
#### From the Content Reviews Report
You can also schedule reviews for assets in the Content Reviews report.
## Review with Workflow
If your assets are contained in a workflow-enabled folder, at the scheduled Review Date, the following will happen:
1. The system will initiate an edit-type workflow by choosing a Workflow Definition from those assigned directly to the asset's parent folder or from any inherited by the parent folder from higher-level folders.
2. If no applicable Workflow Definition is available, no review workflow is initiated.
3. If an applicable Workflow Definition is found, the system will assign a user to own it: - If there was a previous edit, the user who last edited the asset becomes the owner of the workflow. - If there was no previous edit, the user who created the asset becomes the owner of the workflow.
4. Assuming a valid user is located, the workflow is started, otherwise no review workflow takes place.
**Note** - If more than one edit-type Workflow Definition is assigned to the folder or inherited from containing folders, the choice of workflow is arbitrary. If you plan on using Review Date workflows, we recommend having only a single edit-type Workflow Definition either assigned to or inherited by the parent folder.
## Marking Assets as Reviewed
Once you've reviewed an asset, you can mark is as reviewed by clicking **More** > **Mark as Reviewed**.
If the asset is set to be reviewed on a recurring schedule, the Review Date will be updated to the next appropriate interval. If not, the Review Date will be cleared.

---

### Content Reviews Report

## Overview

The Content Reviews report provides a list of assets that have upcoming or past-due review dates.
- Page or file type assets may be considered stale.
- Only assets for which the user has write access are included in the results.
- Only assets with a date/time specified in their **Review Date** metadata fields are included in the results.
The list of results contains the following information:
- **Name** - The name of the asset and an asset link.
- **Review Date** - The date/time specified in the asset's Review Date metadata field. Hover over the entry in this column for an exact date/time.
- **Owned By** - The username of the owner of the asset.
- **Last Updated** - The time the asset was last modified. Hover over the entry in this column for an exact date/time.
- **Last Updated By** - The username of the user who last modified the asset.
## Filtering the Report

The following filters are available to refine the results of the report:
- **Site** - A site must be selected to display report data.
- **Overdue content or content due in __ days** - Manually enter for how many days from the current date that an asset would be considered up for review, or select from the dropdown of common values.
- **Asset Type** - Choose whether page and/or file assets are displayed in the results.
- **Show only content I own** - When this option is enabled, only assets that you are the owner of are displayed in the results.
- **Restrict to folders** - To restrict the results list to assets within certain folders, click **Choose Folder** and select a folder. Repeat these steps to add additional folders to the results list.
## Send a Stale Content Notification

To send a stale content email notification:
1. Select one or more assets from the results list.
2. Click the **Notify by Email** envelope icon at the top of the list.
3. Click **Choose Users and Groups** and select users/groups to receive the notification email. You may also enter a comma-delimited list of email addresses.
4. Optionally, add a message to the notification recipients. By default, the system will send the user an email containing a brief description and link to the asset needing review.
5. Click **Notify**. An email will be sent using the email options configured in your System Preferences.
**Note** - To send a stale content email notification, users need the **Notify users by email about stale content** ability enabled in their Site Role.
## Schedule a Review Date

To schedule a review date:
1. Select one or more assets from the results list.
2. Click the **Schedule Review** calendar/clock icon at the top of the list.
3. To schedule a recurring review, enable **Review on a Schedule** and select an interval from the options provided: - Every Month - Every 3 Months - Every Year
4. To schedule a single review in the future, disable **Review on a Schedule** and select a review date from the options provided: - 1 month from now - 3 months from now - 1 year from now - Calendar (Date Selection)
5. Click **Schedule Review**. This will update the asset Review Date metadata field to the specified date. Modifying an item’s Review Date does not change the item’s Last Modified date.
## Export Results as a CSV File
Information visible in the Content Reviews report can be exported as a CSV file using the **Export CSV** link in the top right corner. The file will also contain information about the current user, site name, and type of report.

---

### Content Tips

## About
Content Tips are a new feature designed to offer real-time SEO guidance as you edit assets with visible metadata fields, including Titles and Descriptions.
Content Tips include:
- **Character Length Guidance**: Suggestions to help you keep metadata within optimal character limits for better SEO.
- **Duplicate Field Values**: Identify assets that share the same metadata values to avoid SEO conflicts. (Note: Duplicate field values are based on the actual field values and do not account for dynamic values generated by Formats during rendering.)
## Opting in/out
Content Tips can be enabled for users across all Sites via a System Preference under the **Content** tab. This preference is enabled by default. Opting out of the System Preference allows the ability to opt into the feature on a per-Site basis for users who have access to that Site.

## Related Links
- Metadata Fields in Cascade
- Sites
- System Preferences

---

### Context Menu

## Overview
The context menu, accessible by right-clicking on any asset, provides you with a menu of available actions for that asset. Only actions you have permission to take will be available. For example, if you don't have permission to edit a page, the **Edit** option will not be available in the context menu.

## Available Actions
1. **Star / Unstar** ( / ) - Star the asset to easily find it again. Your starred assets can be found in the My Content area and Dashboard widget and in asset choosers.
2. **Name** - The system name of the asset, which is used in the published URL if it's a publishable asset such as a page, file, or folder. Click the asset link to preview it in the CMS or click the **View on the live website** ( ) link to view it on your live web server (if published).
3. **Path** - The site name and relative path of the asset within the site. Click the **Click to copy path** ( ) link to copy the asset's path to your clipboard.
4. **Edit** - Edit the asset.
5. **Publish** (for publishable assets such as files, pages, and folders) - Publish the asset.
Additional options are available are available under the **More** menu:
1. **Move** - Move the asset to another location.
2. **Rename** - Change the system name of the asset.
3. **Copy** - Make a copy of the asset.
4. **Delete** - Delete the asset.
5. **Unpublish** (for publishable assets such as files, pages, and folders) - Remove the asset from the web server.
6. **Access** - Set read and write permissions for the asset.
7. **Access for contents** (for folders) - Update permissions for assets inside the folder.
8. **Check-out/Lock** - Lock an asset to create a Working Copy and prevent others from submitting changes to it.
9. **Workflows** (for folders) - Assign workflows for the contents of the selected folder.
10. **Bulk Change** (for folders) - Change one or more of the following properties of assets contained in the selected folder in bulk: - Content Type (for pages) - Metadata Set (for folders, files, blocks, and/or links) - Data Definition (for XHTML/Data Definition blocks)
11. **Relationships** - View (and publish, if applicable) content that links to the asset.
12. **Audits** - View a summary of activities related to the asset.
13. **Versions** - View previous versions of the asset.
14. **Reference** - Create an aliased link that allows the asset to be indexed in another location.
15. **Tasks** - View tasks associated with the asset.

---

### Could not connect to FTPS server: NotAfter

When attempting to publish to an FTPS server, users may encounter messages like the following:
```
Could not connect to FTPS server (your.cascadecms.host:990) : NotAfter: Sat May 30 06:00:00 EDT 2020
```
This error indicates that the SSL/TLS certificate configured at the target FTPS server has expired. To resolve this issue, configure the FTPS server with a valid SSL/TLS certificate. For IIS web servers, for example, this involves taking the following steps:
1. Open IIS Manager
2. Click on the root node of the IIS server
3. Choose **FTP SSL settings** in the right pane
4. Choose and apply the new SSL/TLS certificate to the root node

---

### Creating a database backup

## MySQL
Execute a command similar to the following to create a database dump:
```
mysqldump -u root -p -e --default-character-set=utf8mb3 --add-drop-table cascade > cascade_backup.sql
```
**Note**: The example above assumes that the database name is `cascade`.
## SQL Server
SQL Server users should follow these instructions for creating a database dump in SQL Server Management Studio:
1. Right-click on the Cascade CMS database.
2. Select **Tasks > Back Up...**
3. On the **General** page: - **Backup Type**: Full - **Destination**: make note of the path to which the database will be dumped.
4. Click **OK**.
## Oracle
Oracle users should enter the following from a command prompt (or wherever `exp` can be executed):
```
expdp cascade/cascade directory=backups dumpfile=clientDATE.dmp
```
**Note**: When creating a database dump, **DO NOT** export using the system user.

---

### Creating Content

## Overview
To create new content in Cascade CMS:
1. Click **Add Content** and select an appropriate Asset Factory for the type of content you wish to create. - Asset Factories are set up by your Cascade CMS administrator(s), so if you're not seeing any options, reach out to your web team for assistance.
2. In the** Name** field, enter a name for your asset, if applicable. - Some Asset Factories are set up to create the asset name automatically based on the Title you provide or other metadata.
3. In the **Placement Folder** field, choose the folder where the asset should be stored, if applicable.
4. Depending on the asset type chosen, you may see either pre-defined content fields to fill out or a single code editor or WYSIWYG content editor.
5. Enter any necessary information in the Metadata Fields for your page (Title, Description, etc.), which may be located inline or on the **Metadata** tab.
6. Click **Preview Draft** to see a preview of what your content will look like.
7. Once you're ready to publish, click **Submit** and enter any version comments you'd like to be stored with the version history of the asset. - Cascade CMS pre-populates some comments, but you can also substitute your own or add additional details.
8. Click **Submit**, or **Check Content & Submit** if applicable, to check for spelling errors, broken links, and potential accessibility issues and submit your changes. - If your site uses workflow, you may be prompted to enter comments for the workflow reviewer and start the workflow at this point.
9. For publishable assets, click **Publish** to send your content to the web server. Or if your site uses workflow, wait for the workflow to be approved.

---

### CVE-2020-1938 Ghostcat

**UPDATE * (4/28/2020):* ** Cascade CMS 8.15 contains an updated version of Tomcat that addresses this vulnerability. The information below can still be useful for organizations that have not had a chance to upgrade to Cascade CMS 8.15+ yet or that happen to be proxying with Apache, Nginx, etc. (and need to configure the AJP Connector accordingly).
---
By default, all versions of Tomcat (which come bundled with Cascade CMS) contain an AJP Connector which is configured to listen on port 8009 across all IP addresses. With the recent discovery of [CVE-2020-1938](https://nvd.nist.gov/vuln/detail/CVE-2020-1938), Hannon Hill recommends taking the following action(s) to ensure that your organization's CMS instance remains secure.
### If you are using the bundled instance of Tomcat only to run Cascade CMS (not proxying with Apache, Nginx, etc.)
For standard installations of Cascade CMS which only rely on Tomcat and are not configured with a proxy server, we recommend taking the following action:
- Stop Cascade CMS.
- Edit the *tomcat/conf/server.xml* file.
- Locate the AJP Connector (around lines 116-117).
- Disable the AJP Connector by commenting it out. Example: ``` <!-- <Connector port="8009" protocol="AJP/1.3" redirectPort="8443" /> --> ```
- Start Cascade CMS.
### If you are using the HTTP Connector to proxy with Apache, Nginx, etc.
Organizations using the HTTP Connector (or some other method **not **using AJP ) to proxy should be sure to disable the AJP Connector using the same steps listed above.
### If you are using the AJP Connector to proxy with Apache, Nginx, etc.
For installations of Cascade CMS where the application is being accessed through a proxy that is configured via AJP, we recommend taking the following action(s):
- Ensure that your organization's firewall is configured such that port **8009 **(the default AJP port) is not exposed to the internet. Instead, this port should only be accessible to the local machine (if the proxy is on the local machine) or to the IP address of the proxy.
- Modify the AJP Connector to explicitly listen on a single IP address. This can be done by adding an `address` attribute to the AJP Connector in the *tomcat/conf/server.xml* file. Example: ``` <Connector port="8009" protocol="AJP/1.3" redirectPort="8443" address="127.0.0.1"/> ```
In the sample above, the AJP Connector will listen on port 8009 only for the localhost IP of `127.0.0.1` .
### Cascade Cloud customers
Organizations using Cascade Cloud (hosted by Hannon Hill) are not exposed to this vulnerability. No changes are necessary.

---

### CVE-2021-4104

## What is CVE-2021-4104
In summary,
A flaw was found in the Java logging library Apache Log4j in version 1.x . This allows a remote attacker to execute code on the server if the deployed application is configured to use JMSAppender. This flaw has been filed for Log4j 1.x, the corresponding flaw information for Log4j 2.x is available at: https://access.redhat.com/security/cve/CVE-2021-44228

---

### CVE-2022-22965 Spring4Shell

## What is CVE-2022-22965 (Spring4Shell)?
In summary, from [National Vulnerability Database](https://nvd.nist.gov/vuln/detail/CVE-2022-22965)
>
A Spring MVC or Spring WebFlux application running on JDK 9+ may be vulnerable to remote code execution (RCE) via data binding. The specific exploit requires the application to run on Tomcat as a WAR deployment. If the application is deployed as a Spring Boot executable jar, i.e. the default, it is not vulnerable to the exploit. However, the nature of the vulnerability is more general, and there may be other ways to exploit it.
National Vulnerability Database
More context from [Spring's website](https://spring.io/blog/2022/03/31/spring-framework-rce-early-announcement)
>
Overview
I would like to announce an RCE vulnerability in the Spring Framework that was leaked out ahead of CVE publication. The issue was first reported to VMware late on Tuesday evening, close to Midnight, GMT time by codeplutos, meizjm3i of AntGroup FG. On Wednesday we worked through investigation, analysis, identifying a fix, testing, while aiming for emergency releases on Thursday. In the mean time, also on Wednesday, details were leaked in full detail online, which is why we are providing this update ahead of the releases and the CVE report.
Vulnerability
The vulnerability impacts Spring MVC and Spring WebFlux applications running on JDK 9+. The specific exploit requires the application to run on Tomcat as a WAR deployment. If the application is deployed as a Spring Boot executable jar, i.e. the default, it is not vulnerable to the exploit. However, the nature of the vulnerability is more general, and there may be other ways to exploit it
## Is Cascade CMS affected by CVE-2022-22965 (Spring4Shell)?
No, this vulnerability does not impact Cascade Cloud or on-premise distributions of Cascade CMS. While Cascade CMS makes use of the Spring Framework for Dependency Injection and Inversion of Control, it does not include the affected `spring-mvc` package.

---

### CVE-2022-23302 JMSSink

## What is CVE-2022-23302 (JMSSink)?
In summary,
JMSSink in all versions of Log4j 1.x is vulnerable to deserialization of untrusted data when the attacker has write access to the Log4j configuration or if the configuration references an LDAP service the attacker has access to. The attacker can provide a TopicConnectionFactoryBindingName configuration causing JMSSink to perform JNDI requests that result in remote code execution in a similar fashion to CVE-2021-4104. Note this issue only affects Log4j 1.x when specifically configured to use JMSSink, which is not the default. Apache Log4j 1.2 reached end of life in August 2015. Users should upgrade to Log4j 2 as it addresses numerous other issues from the previous versions.

---

### CVE-2022-23305 JDBCAppender

## What is CVE-2022-23305 (JDBCAppender)?
In summary,
By design, the JDBCAppender in Log4j 1.2.x accepts an SQL statement as a configuration parameter where the values to be inserted are converters from PatternLayout. The message converter, %m, is likely to always be included. This allows attackers to manipulate the SQL by entering crafted strings into input fields or headers of an application that are logged allowing unintended SQL queries to be executed. Note this issue only affects Log4j 1.x when specifically configured to use the JDBCAppender, which is not the default. Beginning in version 2.0-beta8, the JDBCAppender was re-introduced with proper support for parameterized SQL queries and further customization over the columns written to in logs. Apache Log4j 1.2 reached end of life in August 2015. Users should upgrade to Log4j 2 as it addresses numerous other issues from the previous versions.

---

### CVE-2022-23307 Chainsaw Package

## What is CVE-2022-23307 (Chainsaw Package)?
In summary,
CVE-2020-9493 identified a deserialization issue that was present in Apache Chainsaw. Prior to Chainsaw V2.0 Chainsaw was a component of Apache Log4j 1.2.x where the same issue exists.

---

### CVE-2025-24813

### What is CVE-2025-24813?
In summary,
> Path Equivalence: 'file.Name' (Internal Dot) leading to Remote Code Execution and/or Information disclosure and/or malicious content added to uploaded files via write enabled Default Servlet in Apache Tomcat. This issue affects Apache Tomcat: from 11.0.0-M1 through 11.0.2, from 10.1.0-M1 through 10.1.34, from 9.0.0.M1 through 9.0.98. If all of the following were true, a malicious user was able to view security sensitive files and/or inject content into those files: - writes enabled for the default servlet (disabled by default) - support for partial PUT (enabled by default) - a target URL for security sensitive uploads that was a sub-directory of a target URL for public uploads - attacker knowledge of the names of security sensitive files being uploaded - the security sensitive files also being uploaded via partial PUT If all of the following were true, a malicious user was able to perform remote code execution: - writes enabled for the default servlet (disabled by default) - support for partial PUT (enabled by default) - application was using Tomcat's file based session persistence with the default storage location - application included a library that may be leveraged in a deserialization attack Users are recommended to upgrade to version 11.0.3, 10.1.35 or 9.0.98, which fixes the issue.
[National Vulnerability Database (CVE-2025-24813)](https://nvd.nist.gov/vuln/detail/CVE-2025-24813)
## Is Cascade CMS affected by CVE-2025-24813?
After review, it has been determined that Cascade CMS is not affected by CVE-2025-24813 as the attack vector relies on settings that are not enabled in our default installations. 
*~3/19/2025 8:09am ET*

---

### Daily Content Report

## Overview
The Daily Content Report is a daily email summary of your action items, content updates, and content health alerts across all of your sites in the following categories:
- **Action Items**Your Tasks - Outstanding tasks assigned to you.
- Your Drafts - Unsubmitted drafts.
- Workflows Waiting on You - Workflows for which you or one of your groups is the current step owner.
- Comments on Assets You Own - Unresolved comments on assets for which you are the content owner.
- Your Assets That Need Review - Assets that are approaching their scheduled Review Date and for which you are the content owner.
**Content Updates**
- Recently Created Content
- Recently Updated Content
**Content Health**
- Most Broken Links - Page assets containing the most broken links. The scheduled Link Checker must be enabled in your System Preferences and in your Site(s) Settings to populate this category.
- Most Views - Page assets with the most page views. You must have a verified Google Analytics Connector for your site(s) to populate this category.
The 10 most recent assets in each category will be displayed. Click on any of the items in your report to be taken to that asset or action item within Cascade CMS.
## Subscribing to the Daily Content Report
To subscribe to the Daily Content Report:
1. Click your **User icon **and then click **Settings**.
2. Under **Daily Content Report**, check **Receive a daily content report** and click **Submit**.
If the report is enabled for your organization and you have an email address associated with your User in Cascade CMS, you'll receive your Daily Content Report at the next scheduled interval.
## Scheduling the Daily Content Report
To enable/schedule the Daily Content Report for your users:
1. Click the system menu button ( * *) > **Administration** > **Preferences** > **Reports**.
2. Under **Daily Content Report**, enable **Send Daily Content Report to Subscribers**.
3. Select a time to run the report and click **Submit**.

---

### Database Export

## Overview
The Database Export is a support tool that exports the entire Cascade CMS database to a file, so that Hannon Hill can replicate a client database locally without the client having to go through the trouble of performing a database backup or stopping the server.
The Database Export tool should not be used to back up the Cascade CMS database as a part of routine server maintenance. Standard database backup procedures should be followed.
**Notes:**
- It is strongly recommended that exports be performed during periods of low activity as exporting can take a considerable amount of time and overall system performance may be impacted.
- This functionality is intended for use by Hannon Hill Support staff as part of troubleshooting for specific issues/problems. It is not intended to be used for any other purpose.
- This tool is not available in Cascade Cloud.
## Exporting the Database
To perform a database export:
1. Click the system menu button ( * *) > **Administration** > **Export Database**.
2. Configure the following options:**Include contents of File assets** - Enable this option only if you've been instructed to do so by Hannon Hill Support, as this can add significant time to the export process.
3. **Keep temporary export file** - Enable this option if you'd like to be able to keep the export on the server filesystem to be retrieved manually later.
Click **Export**.Wait until the message "Please wait. Your export is being created. This can take a long time." is replaced with the message "Export has completed successfully!"Click the download link to download the database export.
## Enabling Snapshot Isolation on SQL Server
SQL Server needs to have snapshot isolation enabled in order to export the database. To enable snapshot isolation, have the DBA execute the following queries and attempt the export again.
```
ALTER DATABASE [databaseName] SET ALLOW_SNAPSHOT_ISOLATION ON ALTER DATABASE [databaseName] SET READ_COMMITTED_SNAPSHOT ON
```

---

### Database Size Management Tips

## Overview
The overall size of your Cascade CMS database is dependent on a number of factors. Listed below are some of the more common culprits that can greatly affect the size of your database over time.
## Large file uploads
Since everything managed in the CMS is stored in the database itself, it is fairly common for a large percentage of storage to be used up by file content. To get a better sense as to whether files may be requiring large amounts of your database storage, check out this article for Viewing the largest binary files in the database which will give you an overview all file assets in your instance.
Ultimately, if you find that there are some extremely large files that would best be handled externally (on a media server, for example), the query results will allow for you to track them down in the application and potentially remove them as needed. It is also possible to delete old versions of files from within the interface which can also help to free up storage.
## Default Max Upload setting
The **Default Max Upload** setting is located within the Content Preferences. This setting controls the maximum size of files that users can upload into the application. Since everything managed in the CMS is stored in the database itself, it is important to consider what should be a good limit for file uploads based on how your organization uses the application.
For example, a reasonable setting might be around 20 megabytes for most organizations. This would allow for users to upload small media files (like hi-res images, videos and PDFs), but would prevent them from unknowingly (or knowingly) uploading file assets over 50+ megabytes in size.
Reducing the value for this setting will not retroactively affect any files that were uploaded prior to that modification.
## Max Asset Versions setting
The **Max Asset Versions** setting is also located within the Content Preferences. This particular setting is important to consider especially in conjunction with the Default Max Upload setting described above. Consider an environment with the following settings:
- Default Max Upload: 25000 KB
- Max Asset Versions: 50
With a max upload set to 25000 KB as seen above, a user is able to upload a file that is approximately 25 MB in size. This will immediately consume 25 MB of storage at the database level. 
Now we need to take into account what happens each time this particular file is edited. With any edit/submit of a File asset in the CMS, a version of that File is stored in the database in a version chain that is connected to the current version of the File. Therefore, any version of this File stored in the database will also require approximately 25 MB of additional storage. 
With a Max Asset Versions setting of 50, users in the system could potentially end up editing this particular file up to 49 times before the system begins to trim older versions (to keep the version chain at a maximum of 50). Since each edit of this file stores roughly 25 MB of content for the resulting version, the end result is that what was originally a 25 MB file now requires 1,250 MB (or 1.25 GB!) in order to store all of the related versions. 
We typically recommend that this particular setting be configured to somewhere between 20-30, although certain organizations may require that many more past versions be retained in the system. 
If you plan on reducing the number of versions available for assets in your environment, be sure to see this article on the Max Asset Versions setting for details on how changing this affects existing version chains in the system.
## High numbers of read/unread messages
Over time, users across the system tend to amass a lot of notifications (both messages that have been read along with messages that have gone unread). Many of these notifications come from automated tasks such as publish jobs and workflows, so it is easy for users to overlook ever discarding them manually.
It is possible to remove read, unread, and broadcast messages from the system by utilizing the option to **Remove notifications and expired broadcast messages** from within the Optimize Database tool. Depending on how large your `cxml_mail` table is to begin with, this operation can help to clear those items and potentially free up some additional storage space in your database.
**NOTE**: We **DO NOT** recommend running any of the other tools listed in the Optimize Database area unless directed by Product Support as they will not have any noticeable impact on the size of the database.
## Database vendor configuration
The scenarios and settings listed above are specific to Cascade CMS and how data is stored in the database. While the tips mentioned can potentially help to alleviate database storage issues (immediately or over time), keep in mind that there are settings specific to certain database vendors that can affect whether or not (and how much) space can be reclaimed after any of these steps are taken. Those settings are outside the scope of the application and should be handled by your organization's database administrator.

## Related Links
- How can I view the largest binary files within my database?
- How does the Max Asset Versions setting affect existing versions?
- Optimize Database

---

### Email Trigger

## Overview
Including this trigger will send an email regarding the following step in the workflow.
- If the step immediately following the Email trigger is a Transition or Edit step, the trigger will send an email to the step owner(s).
- If the step immediately following the Email trigger is a System step, the trigger will send an email to the initiator of the workflow, because a System step doesn't provide User/Group information to the trigger.
- Additional emails can be sent using the recipient parameters outlined below.
## Declaration
```
<trigger class="com.cms.workflow.function.EmailProvider" name="Email"/>
```
## Usage
```
<trigger name="Email"> <parameter> <name>mode</name> <value>notify</value> </parameter> <parameter> <name>recipients-email</name> <value>a@b.com,b@c.com, d@e.com, f@g.com</value> </parameter> </trigger>
```
## Parameters
Although not required, four optional parameters may be used which will change the default behavior described above.
##### Mode Parameter
```
<parameter> <name>mode</name> <value>completed</value> </parameter>
```
This parameter determines what type of notification should be sent. If the value is `notify`, the recipient will receive a notification email. If the value is `completed`, the recipient will receive a completion email.
**Tip** - The default Email trigger mode is `notify`, so this parameter can be omitted for notification emails.
##### Recipients-Email Parameter
```
<parameter> <name>recipients-email</name> <value>a@b.com,b@c.com, d@e.com, f@g.com</value> </parameter>
```
This parameter allows you to specify external email addresses to be notified. To specify who should receive notifications, the parameter should be added to the email trigger with the comma-delimited list of email addresses.
##### Recipient-Users Parameter
```
<parameter> <name>recipient-users</name> <value>user1,user2,user3</value> </parameter>
```
This trigger allows you to specify system users to be notified. To specify who should receive notifications, the parameter should be added to the email trigger with the comma-delimited list of usernames.
##### Recipient-Groups Parameter
```
<parameter> <name>recipient-groups</name> <value>group1,group2,group3</value> </parameter>
```
This trigger allows you to specify system groups to be notified. To specify who should receive notifications, the parameter should be added to the email trigger with the comma-delimited list of groups.

---

### Filtering queries based on multi-value fields

Using the [querytool](https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/script-formats/velocity-tools.html#QueryAPI), you may have a need to filter based on pages with specific checkbox or multi-select values selected. While filtering on these multi-value fields is not possible in a single query, it can be done using some additional logic. Rather than using something like the following:
```
$_.query().bySiteName("CascadeUniversity").byContentType("Page Types/News").hasStructuredData("details/is-featured", "Yes").execute()
```
You can iterate over the results of your query and utilize a conditional statement to get the desired results. For example:
```
#set ($list = $_.query().bySiteName("CascadeUniversity").byContentType("Page Types/News").execute())#foreach ($page in $list) #if ($page.getStructuredData("details/is-featured").hasTextValue("Yes")) ...your code here... #end#end
```

## Related Links
- Velocity Tools

---

### Firewall Considerations

## Inbound Connections
| Default Port | Used for |
| --- | --- |
| 80 | HTTP |
| 443 | HTTPS |
| 8080 | HTTP |
| 8443 | HTTPS |
## Outbound Connections
| Default Port | Used for |
| --- | --- |
| 21 | FTP, FTPS |
| 22 | SFTP |
| 25 | SMTP* |
| 80 | Link checking**, Connectors |
| 389 | LDAP |
| 443 | Link checking** |
| 636 | LDAPS |
| 990 | FTPS |
| 1433 | SQL Server |
| 1521 | Oracle |
| 3306 | MySQL, MySQL Database Publishing |
**Note**: As of Cascade CMS 8.13+, most system-generated emails will be sent via an external service (SendGrid). If you are not receiving emails from within the application, you may need to allow deliveries from  `*.sendgrid.com` at your email server to allow for deliveries. These emails will come from `noreply@cascadecms.com`. If you are using a proxy, Cascade CMS 8.16+ allows for configuring outbound connections for email as described in this article.**Note**: Since end users can link to any URL and port, the external link check could require other outbound ports for specific URLs. In general, you should be ok with only allowing port 80 and port 443.
## Related Links
- Configuring outbound proxy support for system-generated emails

---

### Forcing connections to use SSL/TLS

## Overview
Once the SSL/TLS connector has been enabled per these instructions, users may still be able to access the application through the default port `8080`. There are 2 options for preventing this from occurring:
1. Comment out the `HTTP/1.1` Connector in ``*tomcat/conf/server.xml* (leaving only the SSL/TLS Connector).
2. Force Tomcat over SSL. To do this, edit the ``*tomcat/conf/web.xml* file and add a `<security-constraint>` element just before the closing `</web-app>` element. For example: ``` <!-- Force SSL for entire site --> <security-constraint> <web-resource-collection> <web-resource-name>Cascade CMS</web-resource-name> <url-pattern>/*</url-pattern> </web-resource-collection> <user-data-constraint> <transport-guarantee>CONFIDENTIAL</transport-guarantee> </user-data-constraint> </security-constraint> ```
**Note**: More information on configuring SSL can be found at the [Apache Tomcat](https://tomcat.apache.org/tomcat-9.0-doc/ssl-howto.html) web site.
## Related Links
- SSL/TLS Configuration

---

### Frequently Asked Questions

Welcome to our Frequently Asked Questions (FAQs). Here you'll find advice and answers from the Cascade CMS Product Support team. Select a category below or use the search box above to search for answers.
* *
## General / How To
25 articles in this collection.
## How do I edit content or find out where to edit a certain region?
You may be able to edit your page content by simply clicking Edit at the top of the page, making any changes, submitting and then publishing.However, if you don't see the content you want to edit when editing the page, that content could be contained elsewhere. The content may be located in a...
## How do I upload a folder?
In addition to uploading individual files, Cascade CMS also supports the ability to upload an entire folder. To do this, you must first zip up the folder in question along with its contents.Once you have a zip file containing your folder(s), upload it by following the steps below:Click Add...
## How do I unlock a page or asset?
First, make sure you're looking at the working copy. Look for the drop-down to the left of the title. If it says Current, click it and select Working Copy.If you're the lock owner:You should now see options to either Commit Changes you've made, or Break Lock and discard those...
## How do I restore something I deleted from the trash / recycle bin?
The Trash bin is located above the left-hand folder tree when you're in the Site Content area. To restore one or more items from the Trash, select the checkbox next to the items and click the Restore button at the top of the list.Note for users - If you don't see the the Trash bin,...
## How do I give a User or Group access to a Site?
In order to access a Site via the Site drop down menu, a User must have a Site Role assigned to them at the Site level (either directly or via their Group membership).To see which Users/Groups have Site Roles assigned to them for a specific Site:Navigate to Manage Site > Site Settings.Click...
## How do I control User access to Folders and assets?
You can control Read/Write access to Site assets through Access rights. Access rights, or permissions, control which Users or Groups can view or edit assets. While viewing an asset (such as a Folder):Click More > Access.Select the Access level for all users. (Selecting None here will hide...
## How can I check what a User can do in a specific Site?
A user’s abilities in a Site will be determined by the Site Role that they are assigned to for that Site. There are a couple of very handy tools that you can use to quickly identify how your Users are configured.
## How can I tell who edited or published a page?
Audit trails provide a list of activities by users in Cascade CMS which can be handy when tracking down a particular event.Viewing an asset's audit trailWhile viewing an asset (such as a page or file) click More > Audits. You can filter the audit trail by timeframe or type of action.If you...
## How do I change the name or URL of my site?
To change the name and/or URL of your Site:Access your Site from the Sites system menu, the Site drop-down menu, or the My Sites widget on your dashboard.Once inside your Site, click Manage Site > Site Settings.Update the Name and/or URL field in the Properties tab.Click Submit.
## How do I delete a site?
To delete a site in Cascade CMS:Click the menu button ( ) in the upper-right corner of the interface.Click Sites.Select the site from the Sites list by checking the checkbox next to it.Click the Delete icon at the top of the list.Note: You can only delete one site at a...
## How do I publish changes to a block?
Blocks, such as XHTML/Data Definition blocks, aren't publishable by themselves. If you've made changes to a block, such as a navigation block, and you're not seeing your changes on your live site, you'll need to publish any pages that use that block.For blocks used on all or most every page in a...
## How do I rebuild my search indexes?
Search indexes can be rebuilt by following these steps:Click Menu > Administration.In the Search section, click Search Indexing.Confirm that your Index Location is correct (this directory should exist on the application server directly under the tomcat folder, by default it will be named...
## How do I configure 301 Redirects?
301 redirects should be handled by a configuration file on your web server. For example, an .htaccess file if using an Apache-driven web server or a web.config file if using a Microsoft (IIS) web server.While there is not a native feature in Cascade CMS regarding 301 redirects, you can maintain...
## How does the Max Asset Versions setting affect existing versions?
If you adjust the Max Asset Versions setting under Administration > Preferences > Content and the new value causes a given asset to have more than the allowed number of Versions, the Version chain will be trimmed for this asset the next time it's edited and submitted. For example, consider...
## Where can I find publish notifications?
To locate publish notifications for assets that you have published:Click your User profile picture or letter in the top-right corner of the screen.In the dropdown menu that appears, select Notifications.The subject line for a publish notification will look something like the...
## How can I find the O/S account running Cascade CMS?
To find out which O/S account is running the application:Navigate to the Logs and System Information areaScroll down to the User Name fieldThe value entered for this field is the account under which Cascade CMS is currently running.
## How can I generate a cron expression for my scheduled publishes?
When working with scheduled publishes in the CMS, one option for scheduling is to provide a cron expression.Since Cascade CMS uses Quartz for scheduling, the syntax for cron expressions may be slightly different from other applications where you've set up cron tasks. In order to generate...
## How do I delete a Workflow?
To delete a Workflow:Navigate to your workflowClick the Delete Workflow button in the top right of your screenTip: Having trouble locating your Workflow? Here are a few ways to get back to it:Navigate to the asset in Workflow and click the corresponding link to the workflow in the top...
## How do I determine where assets will be published?
Cascade CMS determines where to place files using a combination of the following values:The Transport Server Directory (if blank, the FTP/FTPS/SFTP user’s home directory).The Destination Directory.The folder path of your asset in your Site.For example, consider the following...
## Scheduled publishing for individual assets
Both the Start Date field (in an asset's Metadata) and the Optionally Publish Later option provide a way to schedule an asset to publish at a future date/time.See below for notes on when to use one versus the other:Start DateThe Start Date field, which is part of an asset's Metadata, allows...
## Granting Access to Specific Folders for Users/Groups
Since Sites typically consist of multiple Folders, there may be scenarios where you're looking to 'hide' many of those from particular Users and/or Groups.Take the following Folder structure into consideration:<Base Folder of Site>FolderAPageAPageBFolderBFolderCNow, consider...
## How do I rename an asset?
To rename an asset:While viewing the asset, click More -> Rename (you can also do this via the context menu)In the New "asset" Name field, enter the new nameClick RenameWarning: Renaming an asset will result in the asset being unpublished from all enabled...
## How do I reorder items in a navigation menu?
One of the most common strategies for implementing a navigation menu is to dynamically output links to the assets contained within a particular Folder. This type of setup often relies on the ordering of those items within that Folder when deciding how to display them within a navigation menu.To...
## Which algorithms are supported for SFTP?
When publishing to an SFTP server, Cascade CMS supports the following algorithms:KEX...
## Styles not loading for 404 pages
If you're managing a 404 page in the CMS and find that it doesn't display properly on your live site in certain scenarios, the issue is likely due to how CSS file(s) in the page are being referenced. To fix this, we'll want to change the link rewriting for the asset at the page...
* *
## Common Error Messages
17 articles in this collection.
## PageRenderException: Could not transform with Script format
When previewing a page, you may see a full-page error of the type Could not transform with Script format... . This indicates that a Format responsible for rendering part of the page's content is encountering an error.The path to the Format in question will be included in the first half of the...
## Sorry, workflow is required to be able to continue but no workflows are available to you.
This error means that the user's Site Role doesn't allow them to Bypass workflow, but there isn't an applicable workflow available for the type of action they're taking.If your site uses workflow:Edit the appropriate Workflow Definition and ensure the user's Group is included in the Groups...
## Login Failed
This article describes steps that Administrators can take to troubleshoot failed login attempts for their users.Note: If you are an end user receiving this message when you attempt to log in, pay special attention to uppercase and lowercase letters in your username as the system is case...
## Invalid XML: The prefix "o" for element "o:p" is not bound
If you receive this error when trying to create or submit changes to an asset, there may be <o:p> tags in the source code of your editor that will need to be removed or converted to regular <p> tags before the asset can be submitted.Usually these tags are leftovers from pasting...
## Table headers are poorly structured
If your content contains a table, you may see this error during accessibility checks:Table headers are poorly structuredBased on the standard being violated, 1.3.1 Info and Relationships, the cause may be that your table header cells lack scope attributes "to associate header cells and data...
## Header message of length [] received but the packetSize is only []
ProblemThe size of the request header exceeds what's configured for the application.SolutionEdit your tomcat/conf/server.xml configuration file and add a packetSize="65536" attribute to the appropriate connector. For example, change:<Connector port="8009" protocol="AJP/1.3"...
## Parameters missing
This article describes steps to take when you receive a 'Parameters missing' error while attempting to submit a file or page.The error message may appear when the amount of data being sent during a submission is larger than allowed by your application server's Tomcat configuration. For example,...
## Secure LDAP sync fails after upgrade to Cascade CMS v8.11
Cascade CMS v8.11 comes bundled with a newer version of Java (JRE 8u191). This newer version of the JRE enables endpoint identification algorithms for LDAPS servers for added security. The change was included in JRE 8u181+ and more information on it can be found in the Oracle/Java Release Notes....
## Error constructing implementation
When attempting to perform an operation that relies on SSL/TLS, you may see errors like the following:java.security.NoSuchAlgorithmException: Error constructing implementation (algorithm: Default, provider: SunJSSE, class: sun.security.ssl.SSLContextImpl$DefaultSSLContext)This is generally due...
## The index block with path {path} renders too much data
This message is displayed when an Index Block in the system renders a large amount of data and reaches the limit configured in the system Preferences. The size at which the application will stop rendering an Index Block can be configured by doing the following:Navigate to Administration >...
## Could not reset lucene directory
This particular error message generally appears in the log files as:ERROR [SearchServiceImpl] Could not reset lucene directory, assets will not be added to search index: java.io.IOException: Cannot delete /path/to/Cascade CMS/tomcat/indexes/xxxxxThe underlying problem is typically caused by the...
## Search failed: no segments file found
Users attempting to perform a search within Cascade CMS may run into an error similar to the one below:Search failed: no segments* file found in org.apache.lucene.store.FSDirectoryTo correct this problem, an Administrator should log into the system and follow the steps outlined here to rebuild...
## Could not get file content for lucene indexing
Users may see an error similar to the following when viewing the tomcat/logs/cascade.log file:ERROR [SearchWorkerImpl] : Could not get file content for lucene indexing: com.hannonhill.cascade.model.render.file.FileRenderException: Could not fetch contents of file...
## Could not create index writer
Error messages similar to the following may appear in the tomcat/logs/cascade.log file:Could not create index writer: org.apache.lucene.store.LockObtainFailedException:Lock obtain timed out: @/usr/local/Cascade_Server/tomcat/indexes/write.lockTo correct this problem, the following steps should...
## Invalid XML character was found in the element content of the document
When submitting an asset (like a Page or Block), users may encounter messages similar to the following:Invalid XML: An invalid XML character (Unicode: 0x2) was found in the element content of the document.In this particular case, the system has identified a control character (0x2) as appearing...
## Your roles do not allow you to advance workflow
This error indicates that the user's Site Role doesn't allow them to assign a Workflow to themselves or approve steps in a Workflow. To solve this, follow the steps below:Navigate to Menu -> Administration -> Roles.Edit the user's Site Role (the one they are inheriting for the Site in...
## Comparison method violates its general contract
During certain Velocity and XSLT transformations, you may encounter an error like the following:An error occurred while rendering asset preview: org.apache.velocity.exception.MethodInvocationException: Invocation of method 'sort' in class com.hannonhill.cascade.velocity.NodeSortTool threw...
* *
## Troubleshooting
16 articles in this collection.
## Why are my changes not appearing on the web site?
If you're seeing discrepancies between your asset in Cascade CMS and on your live website, see the steps below for possible resolutions.Verify that you've submitted the job for publishingAfter creating or editing an existing asset in Cascade CMS, you must publish your asset in order to see your...
## Why can't my users see anything in the Add Content menu?
In order to see a particular item in this menu, a User must be part of a Group that is configured in the Applicable Groups field for both the Asset Factory and the Asset Factory's Container. Steps for configuring both can be found below: Add Applicable Groups to the...
## Why can't my user upload images in the WYSIWYG or file chooser?
If your users don't see the Upload tab when inserting images in the WYSIWYG or browsing for files in a file chooser, you may need to adjust some Site Role abilities. Users need these two Site Role abilities enabled in order to upload files via the file chooser:Workflow: Bypass workflow*...
## Why can't my users access the full search feature?
If your users see the following error message when attempting to access Full Search:Your role does not authorize you to view this resource.you may need to adjust their System Role(s). Because the Full Search and Replace feature resides in the Administration area, you will need to enable access...
## Why am I seeing 'Asset does not exist' message in my Publish Notification?
This particular message indicates that the asset being published contains a link to another asset that the system is unable to locate. Refer to the following output from the Broken Links section of a sample Publish Notification:[Destination: Production Web Site] about/staff/directoryLink:...
## How can I view the largest binary files within my database?
The following SQL queries will list files from your database from largest to smallest.SQL ServerSELECT s.name as site_name, f.cachePath, b.id, datalength(data) FROM cxml_blob b join cxml_foldercontent f on b.id=f.fileBlobId join cxml_site s on s.id = f.siteid order by datalength(data)...
## Where can I find the Cascade CMS log files?
The log files for the application can be found in the following areas:From within the Cascade CMS interfaceUsers with access to the Administration area can obtain log files from the application by doing the following:Click Administration.In the Tools section, click Logs and System...
## How do I enable DEBUG logging?
Additional logging can be added for the application by following the instructions below:Click Administration.In the Tools section, click Logging Configuration.Choose a category from the dropdown or enter a class name in the text field. (Note: Class names will need to be provided by Hannon...
## Generating a thread dump
Get the process id (pid) of the Cascade CMS process by running the command ps aux | grep java. Results will look similar to the following:cascade 6415 1.2 67.9 8546368 5203156 ? Sl Jun28 635:49 /usr/local/cascade/java/jre/bin/java ...In this example, 6415 is the pid we're looking for.Execute...
## How can I find which Java installation my Cascade CMS instance is using?
To find the location of the Java installation that your Cascade CMS instance is using, you'll need to check the boot script for your environment:
## Why are "g" tags appearing in the WYSIWYG editor?
If you notice that <g> tags are being inserted into your WYSIWYG's source code, for example:<g class="gr_ gr_00 gr_alert gr_gramm gr_spell" data_gr_id="00" id="00">Here is some content.</g>The likely culprit is the Grammarly browser extension. You can remove those tags from...
## Assets are not appearing in Index Blocks
If your Index Blocks aren't rendering assets that you feel should be included, be sure to verify whether or not you may be running into one of the following scenarios:The 'Include when indexing' setting is disabledEdit the asset in question and click the Configure pane. Verify that the Include...
## Why does my Index Block stop indexing assets at a certain point?
There are two different settings which control the number of assets that will be indexed in an Index Block:Max Rendered Assets - this option is found in the Edit interface for Index BlocksMax Assets in Index Blocks - this option is found in Administration > Preferences > Content >...
## How can I enable request logging for Cascade CMS?
Request logging for the application can be configured by taking the following steps:Stop Cascade CMSEdit the file tomcat/conf/context.xmlWithin the active <Context> element (for example, just before the closing </Context> tag), enter the following:<Valve...
## Search isn't returning expected results
The steps outlined here can be followed if the Search functionality and/or the Full Search/Replace tools aren't returning expected results.Check (or have one of your admins check) the Background Tasks Report. While viewing this report, use the Filter Results option (top right) and...
## Generate a HAR file
The Hannon Hill Support Team may request that you generate a HAR file as part of a support investigation. Below we'll outline the steps to do this in Firefox, although the steps are very similar in other browsers:Navigate to the area of the CMS where the problem is occurringOpen the Firefox...
* *
## Development
27 articles in this collection.
## How do I make an XML sitemap?
An XML sitemap can help inform search engines about pages in your site that are available to crawl and the date they were last modified. We have an example SEO Sitemap   Velocity Format which can be applied to an Index Block configured to index your site.Here are the steps to create a...
## How do I create a "calling page" Index Block?
This Index Block, which is usually referred to as a calling page or current page Index Block, is one of the most used Blocks in Cascade CMS.Creating an Index BlockSelect Add Content > Block > Index.Choose a system name (e.g. "calling-page").For the Index Type field choose "Folder...
## Output content as JSON
With a combination of Template, Format, and Output, you can publish your page content as a JSON file.TemplateCreate a Template using skip tags and a "dummy" surrounding element:<!--#cascade-skip--><pass-through><system-region...
## How do I create an XML output for a page?
To create an XML Output for a page:Create a new Template with only the following content: <system-region name="DEFAULT"/>Navigate to Manage Site > Configuration.Select your existing Configuration and edit it.Click Add new Output.For the Name field, enter "XML".For the Template...
## How do I view sample XML when editing a Format?
Often times, when coding (or debugging) a Format, it is important to be able to view sample XML that may be applied to a Format. Or, if you are working with a Velocity Format, you may need to specify a context page in order to test the built in $currentPage and $currentPageSiteName variables.To...
## Testing for an empty WYSIWYG field
Testing to see if a WYSIWYG field can be tricky since the field could either contain plain text or HTML elements.One solution is to test if the value of an XML Element is not empty, or if the Element contains children (ie the HTML elements).Using VelocityWith the Cascade API## Record the...
## How do I access Dynamic / Custom Metadata Fields in Velocity?
With the XPath ToolIf you're using an Index Block and the XPath Tool, you can target the name of your Custom Metadata Field in your XPath Syntax. Example:#set ($category = $_XPathTool.selectSingleNode($contentRoot, "//calling-page/system-page/dynamic-metadata[name='category']/value"))#if...
## How do I sort on a Calendar field?
The format of a Calendar field value (distinct from a Date/Time field) is MM-dd-yyyy which can make it tricky to sort on without some additional work to convert it to a numerical timestamp.Here are some examples of using a lookup table to sort pages on a Calendar field:With the XPathTool#set...
## How can I set up canonical tags?
This article provides a couple of sample methods for configuring canonical tags in your Site(s). These are examples only and may require additional development/configuration depending on your organization's needs.
## How do I access a chooser field's chosen asset?
Cascade APIWhen working with the Cascade API and choosers, there is an asset property which will be set to the chosen asset's API Object if an asset is chosen, or null if no asset is chosen.Because the asset property will be null if no asset is chosen , it is advised to ensure an asset is...
## How do I add a code snippet to my content?
Depending on the type of code and how broadly it should be applied to your site, there are several possible methods for adding and maintaining a code snippet in Cascade CMS. See the following article for guidelines and tips.Determine where the code snippet should be appliedBefore getting...
## How do I include a page's ID in its contents?
Each asset in Cascade CMS has an unique ID, visible in the URL when viewing the asset in the interface. Including a page's ID in the published page source can be useful for things like deep linking to Cascade CMS from Siteimprove, DubBot, or other third-party reporting platforms.You can include...
## How do I include Open Graph or Twitter card meta tags in my page?
Open Graph meta tags and Twitter Card meta tags allow you to control what your pages look like when shared on social media sites such as Facebook and Twitter.To add these tags to your published pages, create a new system region within the <head> tags of your Template(s). For...
## How do I add a "title" tag to my page?
To add a title metadata tag and other metadata tags directly to your Template(s)Navigate to your Template and click Edit.Place the <system-page-title/> tag inside the <title></title> tags of your Templates and click Submit.When the page is rendered, Cascade pulls in the...
## How do I apply CSS?
You can apply CSS at the Template, Configuration, or Page level by linking to it in an XML Block.Create a Region in your Template:Navigate to your Template and click Edit.Create a new Region within the <head> tags of your Template by adding a System Region tag. Example:...
## How do I make CSS classes available in the WYSIWYG formats drop-down menu?
To allow users to apply styles to their content within the WYSIWYG editor:1a. At the Site Level:Click Manage Site > WYSIWYG Editor Configurations.Select your configuration or click Create to add one.In the CSS File field click Choose File and select the CSS file containing the classes you...
## Why aren't my CSS background images being displayed?
CSS background images require special tags that let the system know you are referring to an image that is managed by Cascade CMS. Consider the following lines in a CSS file:.content{ background-image: url('/images/photo.png');}To link to this image from the CSS file within Cascade, the...
## Why am I seeing <system-region> tags around my published content?
System region tags are automatically added to rendered and published content that doesn't contain valid XML. Specifically, due to a lack of a root element when Cascade CMS attempts to validate the content as XML during the rendering and publishing process.To generate non-XML compliant content,...
## How can I redesign a site using our existing content?
The following setup allows you to develop a new site design, using current site content, alongside your current design:Edit your site's Configurations and add a new Output. This Output will use your new Templates, Blocks, and/or Formats.Edit your site's Content Types and configure the Publish...
## How to update deprecated Velocity code
$_FieldTool.in("com.hannonhill.cascade.model.dom.identifier.EntityTypes")The $_FieldTool.in(String) method was used to obtain reference to entity types in order to locate assets using the Locator Tool. New methods added to the Locator Tool allow for locating each type of...
## Working with namespaces in Velocity
Consider the sample snippet below:<info xmlns:d="https://www.hannonhill.com"> <d:Title>Hannon Hill - Cascade CMS</d:Title></info>In order to access the <d:Title> element here using a Velocity Format, the following methods can be used:Method 1:#set ($dNs =...
## Filtering queries based on multi-value fields
Using the querytool, you may have a need to filter based on pages with specific checkbox or multi-select values selected. While filtering on these multi-value fields is not possible in a single query, it can be done using some additional logic. Rather than using something like the...
## Getting started with REST
Javascript (with jQuery)This changes title of a page “news/2003/best-of-show” in site “example.com” by performing a “read” operation first, changing title and then performing “edit”...
## Working with Server Side Includes
It is possible to publish snippets of HTML which can be pulled in via Server Side Includes (SSI) at runtime on your live web server. This method of including content can be useful for components like navigation menus, footers, and/or any other areas of your site that are commonly used...
## Configuring a robots meta tag
This article walks through a sample setup that will allow for a "robots" meta tag to be included in the source of one or more pages. Using these options, it's possible to instruct search engines as to whether or not they should index particular pages and/or crawl links on those pages.Template...
* *
## WYSIWYG Editor
11 articles in this collection.
## Adding an image to a page
If you're working in a WYSIWYG editor, you can add an image by uploading your image to Cascade CMS, then browsing for it in the WYSIWYG.Upload your image by clicking the Add Content button and using an appropriate file option available to you.These options are set up by your CMS...
## Adding a PDF to a page
If you're working in a WYSIWYG editor, you can add a link to a file such as a PDF by uploading your file to Cascade CMS, then linking to it in the WYSIWYG.Upload your file by clicking the Add Content menu and use the appropriate file option available to you.These options are set up...
## Creating an anchor link
Anchor links, sometimes called "skip links", allow you to link to a particular spot within the same page or a different page. To create an anchor link to a location within a page:Place your cursor at the spot where you'd like your destination anchor to appear and click the Anchor...
## Adding classes to links and images
To add a class to a link:Highlight the link in question or place your cursor somewhere in the link text. Click the Insert/edit link icon (alternatively you can right-click on the link and select Link).In the Styling field, select one of the styles listed. Click...
## Adding a caption to an image
To add a caption to an image:In the editor, click on the image that you wish to add a caption for.Click the Insert/edit image icon (alternatively, you can right-click on the image and select Image).In the popup dialog box, click the Advanced tab.Check the option Use figure and...
## Inserting a video
To include a video in your page content:Place your cursor in the editor at the location where you'd like the video to be inserted.Click the Insert/edit media icon.In the pop-up dialog box, there are a few tabs available to you which you can utilize depending on how you intend to...
## Adding a caption to a table
To add a caption to a table:Click anywhere in the table to select it.In the menu bar that appears, click the Table properties icon.Under the General tab, select the Caption checkbox.Click Ok. At this point, a caption area will appear above the first table row.Place your...
## Adding a table header and footer
To add <thead> or <tfoot> elements to a table:Right-click somewhere in the row that you wish to specify as the table header or table footer.In the pop-up menu that appears, select Row -> Row Properties.In the pop-up dialog box under the General tab,...
## Adding header cells to a table
To add header cells to a table along with a scope attribute:Right-click in the cell that you wish to make a header cell.In the pop-up menu that appears, select Cell -> Cell Properties.In the Cell type field, select Header cell.Using the Scope field, set the scope as needed...
## Adding classes to tables
To apply a class to different areas of a table:Click the table, row, or cell where you wish to apply a class.Click the Format menu option, then select Formats -> Custom.Select the appropriate class name to apply it to your selection. Notes:Not seeing any classes...
## Configuring table properties
To configure properties for a table:Click anywhere in the table to select it.In the pop-up menu that appears, click the Table properties icon (far left).You'll be presented with 2 tabs: General and Advanced.GeneralIn the General tab, you can optionally enter values for Width,...
* *
## Publish Errors
16 articles in this collection.
## The folder hierarchy does not allow this asset to be published
This error message indicates that one or more of the parent folders of the asset you're attempting to publish is not enabled for publishing. Assets contained in folders not enabled for publishing are not publishable, even if they're set to publish at an individual level.To enable a folder for...
## Asset is not set to publish. Please enable publishing for this asset and try again.
This error message indicates that the asset you're attempting to publish is not enabled for publishing. To enable the asset for publishing:Edit the asset.Select the Configure tab.Enable the Include when publishing option.Submit your changes.
## You are not authorized to schedule future publish dates
As of Cascade CMS v8.2 the Start Date field publishes the asset at the selected date. If a user receives the following error during submission, that means their Site Role does not allow them to Publish:You are not authorized to schedule future publish dates. Please contact an administrator for...
## SFTP: java.net.SocketTimeoutException: Read timed out
Users may see the following error message when attempting to publish to an SFTP server:com.hannonhill.cascade.model.publish.transmit.ShuttleRuntimeException: SFTP error occurred during SFTP Shuttle setup: Session.connect: java.net.SocketTimeoutException: Read timed outThis error is typically...
## This asset cannot be published because there are no publishable configurations
When attempting to publish a page, the following message may appear in the interface:This asset cannot be published because there are no publishable configurationsTo resolve this, you must enable publishing for at least one of the Outputs for the page:While previewing the page, click Details...
## Invalid privatekey error when publishing via SFTP
When using SSH Key authentication for SFTP Transports, you may see the following errors when testing the Transport or when publishing to a Destination using the Transport:SFTP error occurred during SFTP Shuttle initialization: invalid privatekey: [x@xxxxxxxTo resolve the issue, upload your SSH...
## Permissions issues when publishing to Filesystem Transports
To correct permission issues when using Filesystem Transports, you'll need to make sure that the boot script is updated accordingly. By default, the Tomcat container which Cascade CMS runs on will use a UMASK of 0027 which can lead to permission issues when trying to serve those files via a web...
## I won't open a connection to <ip address 1> (only to <ip address 2>)
When attempting to publish to an FTP server, users may encounter messages like the following:I won't open a connection to <ip address 1> (only to <ip address 2>)This error typically indicates that the underlying Transport is configured to use Active FTP while the target server only...
## Problems connecting via SFTP to Solarwinds Serv-U servers
When attempting to publish via SFTP to a Solarwinds Serv-U 15.3.2+ server, one or both of the following error messages may be seen in publish reports:SFTP error: connection resetSFTP error occurred during SFTP Shuttle initialization: Session.connect: java.io.IOException: End of IO Stream...
## No Destinations or WordPress Connectors available
When attempting to publish a page, the following message may appear in the interface:You cannot publish (or unpublish) this asset because there are no Destinations or WordPress Connectors available. The following scenarios could be the cause of the message:There are Destinations...
## You cannot publish (or unpublish) this asset because there are no Destinations or WordPress Connectors available.
This error message means that the User trying to publish (or unpublish) does not belong to an applicable group in any of the Site's Destination settings. To solve:Click Manage Site and then select Destinations.Edit the Destination or Destinations to which the User needs to...
## Could not connect to FTPS server: NotAfter
When attempting to publish to an FTPS server, users may encounter messages like the following:Could not connect to FTPS server (your.cascadecms.host:990) : NotAfter: Sat May 30 06:00:00 EDT 2020This error indicates that the SSL/TLS certificate configured at the target FTPS server has expired....
## Could not put file with path 'FILE_PATH' onto server: Permission denied
When publishing, users may see the following error message in their publish notifications:Error occurred during SFTP transport: Could not put file with path 'FILE_PATH' onto server: Permission deniedThis error indicates that the SFTP account being used to connect to the target server does not...
## Error occurred during FTP transport: Accept timed out
Users may see the following error message when attempting to publish to a FTP server:Error occurred during FTP transport: Accept timed outThis error is typically caused by the connection attempting to use Active mode as opposed to Passive mode when connecting to the target web server. To force...
## Unsupported or unrecognized SSL message
The following error may appear when publishing to a web server via FTPS:Could not connect to FTPS server (host:21) : Unsupported or unrecognized SSL messageThis error occurs when the FTPS Transport is configured to connect to a target server using explicit FTPS over port 21. Cascade CMS...
## Could not put file with path '<path>' onto server: Failure
When attempting to publish to an FTPS server, users may encounter messages like the following:Could not put file with path '<path>' onto server: FailureThe most common cause for this error is that the target web server has run out of disk space. It is recommended to check (or have your...
* *
## Database Errors
9 articles in this collection.
## MySQL 8: Public Key Retrieval is not allowed
After upgrading to MySQL 8, you may encounter the following error on startup:liquibase.exception.JDBCException: java.sql.SQLException: Cannot create PoolableConnectionFactory (Public Key Retrieval is not allowed)...Caused by: com.mysql.jdbc.exceptions.jdbc4.MySQLNonTransientConnectionException:...
## Packet for query is too large
When uploading a file into Cascade CMS, users may see an error similar to the following message:An error occurred during editing: Error persisting this bean to storage:com.mysql.jdbc.PacketTooBigException: Packet for query is too large(####### > #######). You can change this value on the...
## Error executing SQL DELETE FROM `cxml_history_item`
The following error message may appear when upgrading to Cascade 8 against a version of MySQL 5.7 prior to release 5.7.11:Migration failed for change set com/hannonhill/cascade/model/database/updater/updates/8_0/8_0_006.xml::8_0_006::artur.tomusiak: Reason: liquibase.exception.JDBCException:...
## ORA-22275: invalid LOB locator specified
Oracle users may encounter this error when attempting to copy, edit, or submit assets in the system. The behavior will cause messages similar to the following to appear in the cascade.log file:2015-09-14 07:54:10,936 WARN [JDBCExceptionReporter] SQL Error: 22275, SQLState: 999992015-09-14...
## MySQL: Can't create table
When starting Cascade CMS for the first time or after importing a new MySQL database, administrators may see an error message in the log file similar to the following:ERROR [StartupTasks] : *** Startup task: DatabaseIndexAndKeyManagerfailed to execute successfully: java.sql.SQLException: Can't...
## MySQL: Can't create/write to file
Organizations using MySQL may see an error message similar to the following when attempting to login to the system:Login failed: An error occurred: Startup task: DatabaseIndexAndKeyManager failed to execute successfully: java.sql.SQLException: Can't create/writeto file...
## "Could not acquire change log lock" or "Waiting for changelog lock..."
During start-up, one of the following messages may appear in the cascade.log file and prevent Cascade CMS from starting:Waiting for changelog lock....Caused by: liquibase.exception.LockException: Could not acquire change log lock. Currently locked by ...These can occur if the application...
## The driver could not establish a secure connection to SQL Server by using Secure Sockets Layer (SSL) encryption. Error: "Unexpected rethrowing"
This particular error message can appear on startup. The full message will typically appear as the following:Error occurred fetching database vendor type: Cannot create PoolableConnectionFactory (The driver could not establish a secure connection to SQL Server by using Secure Sockets Layer (SSL)...
## The driver could not establish a secure connection to SQL Server by using Secure Sockets Layer (SSL) encryption
When attempting to start Cascade CMS, organizations using SQL Server may be presented with the following error in the log files (which prevents the application from starting):("encrypt" property is set to "true" and "trustServerCertificate" property is set to "false" but the driver could not...
* *
## Security
11 articles in this collection.
## CVE-2020-1938 Ghostcat
UPDATE (4/28/2020): Cascade CMS 8.15 contains an updated version of Tomcat that addresses this vulnerability. The information below can still be useful for organizations that have not had a chance to upgrade to Cascade CMS 8.15+ yet or that happen to be proxying with Apache, Nginx, etc. (and...
## CVE-2021-44228 Log4Shell
In summary,Log4j versions prior to 2.15.0 are subject to a remote code execution vulnerability via the ldap JNDI parser. As per Apache's Log4j security guide: Apache Log4j2 <=2.14.1 JNDI features used in configuration, log messages, and parameters do not protect against attacker controlled...
## CVE-2021-4104
In summary,A flaw was found in the Java logging library Apache Log4j in version 1.x . This allows a remote attacker to execute code on the server if the deployed application is configured to use JMSAppender. This flaw has been filed for Log4j 1.x, the corresponding flaw information for Log4j...
## CVE-2021-45046 Log4Shell
In summary,It was found that the fix to address CVE-2021-44228 in Apache Log4j 2.15.0 was incomplete in certain non-default configurations. This could allows attackers with control over Thread Context Map (MDC) input data when the logging configuration uses a non-default Pattern Layout with...
## CVE-2021-45105 Log4Shell
In summary,Apache Log4j2 versions 2.0-alpha1 through 2.16.0 (excluding 2.12.3) did not protect from uncontrolled recursion from self-referential lookups. This allows an attacker with control over Thread Context Map data to cause a denial of service when a crafted string is interpreted. This...
## CVE-2022-23302 JMSSink
In summary,JMSSink in all versions of Log4j 1.x is vulnerable to deserialization of untrusted data when the attacker has write access to the Log4j configuration or if the configuration references an LDAP service the attacker has access to. The attacker can provide a...
## CVE-2022-23305 JDBCAppender
In summary,By design, the JDBCAppender in Log4j 1.2.x accepts an SQL statement as a configuration parameter where the values to be inserted are converters from PatternLayout. The message converter, %m, is likely to always be included. This allows attackers to manipulate the SQL by entering...
## CVE-2022-23307 Chainsaw Package
In summary,CVE-2020-9493 identified a deserialization issue that was present in Apache Chainsaw. Prior to Chainsaw V2.0 Chainsaw was a component of Apache Log4j 1.2.x where the same issue exists.National Vulnerability Database
## CVE-2022-22965 Spring4Shell
In summary, from National Vulnerability DatabaseA Spring MVC or Spring WebFlux application running on JDK 9+ may be vulnerable to remote code execution (RCE) via data binding. The specific exploit requires the application to run on Tomcat as a WAR deployment. If the application is deployed as a...
## "Remember Me" Cookied Login Vulnerabilities
We have identified several weaknesses in the cookied login progress that would allow a sophisticated attacker to access the CMS as another user using only "remember me" cookies.Cookie authenticityCookies were not expired or validated on the application side. It was previously possible to...
## CVE-2025-24813
What is CVE-2025-24813?In summary,Path Equivalence: 'file.Name' (Internal Dot) leading to Remote Code Execution and/or Information disclosure and/or malicious content added to uploaded files via write enabled Default Servlet in Apache Tomcat. This issue affects Apache Tomcat: from 11.0.0-M1...

---

### Generating a thread dump

## Linux/*nix
1. Get the process id (pid) of the Cascade CMS process by running the command `ps aux | grep java`. Results will look similar to the following: ``` cascade 6415 1.2 67.9 8546368 5203156 ? Sl Jun28 635:49 /usr/local/cascade/java/jre/bin/java ... ``` In this example, `6415` is the pid we're looking for.
2. Execute the following command to send a kill signal to the Cascade CMS process: `kill -3 <pid>`Continuing the example from above, the command will be: `kill -3 6415`
**Note**: This particular kill signal will not stop the application. It will simply output a thread dump within the *tomcat/logs/catalina.out* file.
## Windows (using PowerShell)
1. First, open Task Manager in Windows.
2. Locate the PID of the running Cascade CMS process and keep it handy (*tomcat9.exe*, for example, as seen below):
3. Open PowerShell using the **Run as Administrator** option.
4. Change directories into the *java\bin* folder. For example: `cd C:\Program Files\Cascade CMS\java\jdk\bin`
5. Execute a command like the one below making sure to replace the `<PID>` with the PID of the running Cascade CMS process: ``` ./jcmd <PID> Thread.print > cascade-thread-dump-dd-mm-yyyy.log ```
The thread dump will be generated in the file you've specified in the command directly above.

---

### Generating an RSS Feed

## Configure an Output for the feed
Creating an RSS Feed is similar to creating any new Output. It involves creating a new Template, Configuration, and Content Type as described below:
- Create a new Template with only the following content: **`<system-region name="DEFAULT"/>`
- Create a new Configuration.For the Name** field, enter "RSS Feed" (this can be anything you want to uniquely identify this type of Configuration).
- Click **Add new Output**.For the **Name** field, enter "RSS".
- For the **Template** field, browse to the Template that was created in the first step.
- For the **File Extension** field, enter ".rss" or ".xml".
- For the **Type of Data** field, select "XML".
- Leave the **Publishable** field checked for now (assuming you do want the feed to be published).
Click **Submit**.Create a new Content Type.
- For the **Name** field, enter "RSS Feed".
- For the **Configuration** field, select the Configuration that was created in the previous step.
- Select a Metadata Set.
- Leave the remaining fields as they are and click **Submit**.
At this point in the process, the underlying setup for displaying the RSS feed is in place.
Now, you'll need to generate the RSS Feed using information from relevant assets in your Site(s). 
## Generate the contents of the feed
You can obtain a listing of items to include in your feed by creating an Index Block to index them.
This Index Block can be of **Type: Folder Index** (if all of your RSS items happen to be contained within a particular Folder in the CMS) or you can choose to use **Type: Content Type Index** if want the Index Block to simply return all Pages using a particular Content Type.
A typical RSS setup will require that your Index Block has the following options selected:
- **Indexed Asset Content: **Regular Content, System Metadata, User Metadata
- **Indexed Asset Types:** Pages
- **Page XML:** Do not render page XML inline
**Note**: The settings above are typically going to be the minimum required for the purposes of this example. Your settings may need to be adjusted depending on which specific information you're looking to include in your RSS feed.

---

### Getting started with REST

## Language Specific Examples
### **Javascript (with jQuery)**
This changes title of a page “news/2003/best-of-show” in site “example.com” by performing a “read” operation first, changing title and then performing “edit” operation:
```
$.get("http://localhost:8080/api/v1/read/page/example.com/news/2003/best-of-show?u=hill&p=hill", function(data) {  if (data.success) {    data.asset.page.metadata.title = 'New title';    $.post("http://localhost:8080/api/v1/edit?u=hill&p=hill", JSON.stringify({      'asset': data.asset    }), function(data) {      if (data.success)        console.log('Success');      else        console.log('Error occurred when issuing an edit: ' + data.message);    }, 'json');  } else {    console.log('Error occurred when issuing a read: ' + data.message);  }}, 'json');
```
### **Javascript (with fetch)**
This is the same example as above but it does not require importing jQuery or any other libraries. It can be run even from browser's Developer Tools console.
```
fetch("http://localhost:8080/api/v1/read/page/example.com/news/2003/best-of-show", { "headers": { "Authorization": "Basic aGlsbDpoaWxs" } }) .then(r => r.json()) .then(data => { if (data.success) { data.asset.page.metadata.title = 'New title'; fetch("http://localhost:8080/api/v1/edit", { method: 'POST', headers: { "Authorization": "Basic aGlsbDpoaWxs" }, body: JSON.stringify({'asset': data.asset}) }) .then(r => r.json()) .then(data => { if (data.success) console.log('Success'); else console.log('Error occurred when issuing an edit: ' + data.message); }); } else { console.log('Error occurred when issuing a read: ' + data.message); } });
```
### **Javascript (with fetch and async/await)**
Again, this is the same example as above that does not require importing any libraries but it uses newer ES syntax, making the code a bit cleaner. It can be run from browser's Developer Tools console of a modern browser.
```
(async () => { const readResult = await fetch("http://localhost:8080/api/v1/read/page/example.com/news/2003/best-of-show", { headers: { "Authorization": "Bearer your-api-key" } }); const readData = await readResult.json(); if (readData.success) { readData.asset.page.metadata.title = 'New title'; const editResult = await fetch("http://localhost:8080/api/v1/edit", { method: 'POST', headers: { "Authorization": "Bearer your-api-key" }, body: JSON.stringify({asset: readData.asset}) }); const editData = await editResult.json(); if (editData.success) console.log('Success'); else console.log('Error occurred when issuing an edit: ' + editData.message); } else { console.log('Error occurred when issuing a read: ' + readData.message); }})();
```
#### **Reading and parsing a File's byte array contents**
```
(async (  url = "http://localhost:8080/api/v1/read/file/example.com/image/sample.png"", apiKey = "your-api-key") => { const readResult = await fetch(url, { headers: { "Authorization": `Bearer ${apiKey}` } }); const readData = await readResult.json(); if (readData.success) { const encoder = new TextEncoder(); const buffer = encoder.encode(readData.asset.file.text).buffer const sliced = Array.prototype.slice.call(new Uint8Array(buffer), 0); console.dir(sliced) } else { console.log('Error occurred when issuing a read: ' + readData.message); }})();
```
### **PHP**
GET operations are very simple. For instance, this reads a role with id “1”:
```
$reply = json_decode(file_get_contents('http://localhost:8080/api/v1/read/role/1?u=admin&p=admin'));print_r($reply);
```
POST operations are also simple with this utility function to be able to easily convert data between PHP array and JSON:
```
function apiOperation($url, $params){    return json_decode(file_get_contents($url, false, stream_context_create(array('http' => array('method'  => 'POST','content' => json_encode($params))))));}
```
Here is a PHP example similar to the Javascript example above:
```
$reply = json_decode(file_get_contents('http://localhost:8080/api/v1/read/page/example.com/news/2003/best-of-show?u=hill&p=hill'));if ($reply->success){    $reply->asset->page->metadata->title="A new title";    $reply = apiOperation('http://localhost:8080/api/v1/edit?u=hill&p=hill', array ('asset' => $reply->asset));    if ($reply->success)        echo "Success.";    else        echo "Error occurred when issuing an edit: " . $reply->message;}else    echo "Error occurred when issuing a read: " . $reply->message;
```

---

### Header message of length [] received but the packetSize is only []

## Problem
The size of the request header exceeds what's configured for the application.
## Solution
Edit your *tomcat/conf/server.xml* configuration file and add a `packetSize="65536"` attribute to the appropriate connector. For example, change:
```
<Connector port="8009" protocol="AJP/1.3" redirectPort="8443" />
```
to
```
<Connector port="8009" protocol="AJP/1.3" redirectPort="8443" packetSize="65536" />
```
If you are proxying with Apache over AJP you will want to also add a `ProxyIOBufferSize` directive to your `VirtualHost` that is set to the same value. This ensures both Apache and Tomcat are configured to use the same values. Example:
```
ProxyIOBufferSize 65536
```

---

### How can I find the O/S account running Cascade CMS?

To find out which O/S account is running the application:
- Navigate to the Logs and System Information area
- Scroll down to the **User Name** field
The value entered for this field is the account under which Cascade CMS is currently running.

---

### How can I find which Java installation my Cascade CMS instance is using?

To find the location of the Java installation that your Cascade CMS instance is using, you'll need to check the boot script for your environment:
## Linux/*nix and Mac OS X
- Navigate to the Cascade CMS installation directory
- View or edit the *cascade.sh* file
- See the `JRE_HOME` variable (top line)
For example:
```
export JRE_HOME="/usr/local/java/jre"
```
## Windows (service)
- Navigate to the Cascade CMS installation directory
- Right-click on the file *tomcat/bin/CascadeCMSw.exe* and select the option to *Run as Administrator*
- Click on the *Java* tab
- See the *Java Virtual Machine* field
For example:
```
C:\Program Files\Cascade CMS\java\jre\bin\server\jvm.dll
```
In this case, the Java installation is located at *C:\Program Files\Cascade CMS\java\jre*.
## Windows (command line)
- Navigate to the Cascade CMS installation directory
- View or edit the *cascade.bat* file
- See the `JRE_HOME` variable near the top
For example:
```
set JRE_HOME=C:\Program Files\Cascade CMS\java\jre
```
## Additional Information Regarding the JVM
If your instance of Cascade CMS is running, you can find some information about the JVM within the application itself:
- Click **Administration**
- Click **Logs and System Information**
- Click the **System Information** tab
In the **General Information** section, you'll be able to view the following details regarding your Java installation:
- Java Version
- Java Vendor
- JVM Version
- JVM Vendor
- JVM Implementation
- Java Runtime
- Java VM

---

### How can I set up canonical tags?

This article provides a couple of sample methods for configuring canonical tags in your Site(s). These are examples only and may require additional development/configuration depending on your organization's needs.
## Self-referencing canonical tags
1. Create a Velocity Format containing the following: ``` <link rel="canonical" href="${currentPage.link}" /> ```
2. Create a system-region within the `<head>` tags of your Template(s). For example: ``` <system-region name="CANONICAL" /> ```
3. Attach the Format to the `CANONICAL` system region (at the Template, Configuration, or Page level).
4. Visit **Manage Site >** **Site Settings** and change the **Link Rewriting **setting to **Absolute**.
5. Publish your page(s).
**Tip**: If you want to implement self-referencing canonical tags for an individual page only (or for just a few pages), you can attach this Format to the region at the page level. You can then set the page's link rewriting behavior to **Absolute** under **Edit > Configure > Override the current Site's asset link rewriting behavior for this asset**.
## Add option for alternative canonical URL
The example below illustrates how you can set up additional options for pages to output a self-referencing canonical tag or point to another page as the canonical page.
1. Create a system-region within the `<head>` tags of your Template(s). For example: ``` <system-region name="CANONICAL" /> ```
2. Create a Shared Field Group with the following XML: ``` <system-data-structure> <group identifier="canonical" label="Canonical Settings" restrict-to-groups="Administrators"> <text field-id="eff3e93cc0a8003d49767a63e99b3d5d" help-text="Enable this if the current page is NOT the canonical page, e.g. it's a duplicate." identifier="canonical-alternate" label="Specify alternate canonical URL?" required="true" type="checkbox"> <checkbox-item label="Yes" show-fields="canonical/canonical-url-type" value="yes"/> </text> <text field-id="eff3e93cc0a8003d49767a63e89422bd" identifier="canonical-url-type" label="Canonical URL Type" required="true" type="radiobutton"> <radio-item label="Choose Page" show-fields="canonical/page" value="page"/> <radio-item label="Enter URL" show-fields="canonical/url" value="url"/> </text> <asset field-id="eff3e93cc0a8003d49767a63755ff381" help-text="Select the canonical page." identifier="page" label="Choose Page" type="page"/> <text default="https://" field-id="eff3e93cc0a8003d49767a638b0b971b" help-text="Enter the URL for the canonical page." identifier="url" label="Enter URL"/> </group></system-data-structure> ```
3. Add this Shared Field Group to the top of one or more of your existing Data Definitions.
4. Create a Velocity Format containing the following: ``` #set ($canonical = $currentPage.getStructuredDataNode("canonical"))#if (!$canonical.getChild("canonical-alternate").hasTextValue("yes")) ## use current page's URL #set ($href = $currentPage.link)#else ## use alternate canonical page URL #if ($canonical.getChild("canonical-url-type").hasTextValue("page")) #set ($href = $canonical.getChild("page").asset.link) #elseif ($canonical.getChild("canonical-url-type").hasTextValue("url")) #set ($href = $canonical.getChild("url").textValue) #end#end## output the canonical tag<link href="${href}" rel="canonical" /> ```
5. Attach this Format to the `CANONICAL` system region (at the Template, Configuration, or Page level).
6. Visit **Manage Site >** **Site Settings** and change your **Link Rewriting **setting to **Absolute**.
7. Edit one or more pages, configure the additional canonical tag options, and publish the page(s).
**Note**: When editing a page with this setup, only users in the `Administrators` group will see these additional options. This is due to the `restrict-to-groups="Administrators"` attribute on the field group. You can remove this restriction or adjust it to include the names of the appropriate groups in your Cascade CMS environment.

---

### How do I add a code snippet to my content?

Depending on the type of code and how broadly it should be applied to your site, there are several possible methods for adding and maintaining a code snippet in Cascade CMS. See the following article for guidelines and tips.
### Determine where the code snippet should be applied
Before getting started, determine how broadly the snippet needs to be applied to your site, as this can help you determine the approach to use.
- Site-wide:**Consider using a tag manager (see "Using a tag manager" below) to deploy your code site-wide.
- Or apply the code at the Template(s) level so it's inherited by all pages using the Template(s).
A subsection of pages in the site:
- Consider using a tag manager (see "Using a tag manager" below) to deploy the tag if the page's URL matches certain conditions.
- Or apply the code at the Configuration(s) level so it's inherited by all pages using the Configuration(s).
- Or use a Format to render the tag only if the current page matches certain conditions, such as having a specific string in its path.
A single page:
- Apply the code at the individual page level.
- Or embed it in the source code of a WYSIWYG editor on the page (if applicable) if it can go within the `body` of the page. Use caution with this setup, as the code won't be visible to users working on the visual side of the WYSIWYG editor and it could be unintentionally altered or removed.
### Using a tag manager
If you're already using a tag manager such as [Google Tag Manager * * ](https://tagmanager.google.com), or would like to, we'd recommend using this method to deploy code snippets first. Especially if they should apply to your entire site or a large number of pages.
Tag managers have the advantage of not requiring the site to be re-published to update the live site, since it's loaded automatically when a visitor loads a page. This also makes it easier to update and deploy your code snippet in the future.
### Using the CMS
If you choose to maintain and deploy your code snippet with the CMS, before following the guidelines below, be sure to familiarize yourself with the implementation of other links and script tags in your site, as there may already be an appropriate place to add your code snippet.
For example, if you have a code snippet that should be added to the `head` of your page's markup, use **More > Show Regions** when previewing an example page to see if you already have an XML Block or Format assigned to a Template region within the `head` that your script could be added to.
**Note** - Code snippets, such as JavaScript script tags, often contain invalid XML in their content. To avoid XML validation errors in the CMS, wrap your snippet in a code section.
- Choose a protect code section for code that may contain invalid XML.
- Choose a passthrough code section if you only want to the snippet to render in the published page, for example, to avoid tracking activity within the CMS itself.
1. Create an XML Block or Format to house your code snippet. - Consider a Format if you'd like to add conditional statements for when the code snippet should be rendered. For example, if you only want to output the code if the current page is in a specific directory. - Click **Add Content** and then choose **Block > XML** or **Format**. - Add your code snippet to the Block or Format, making sure to wrap it in an appropriate code section (see note above) if needed.
2. Create a region in your Template(s). - Navigate to your Template and click Edit**. - Create a new Region in the appropriate area of the markup by adding a System Region tag. Example: `<system-region name="CHATBOT SCRIPT"/>` - **Submit** your changes.
3. Attach your Block or Format to the Template region. - Navigate to the appropriate Template, Configuration, or Page (see "Determine where the code snippet should be applied" above) and click **Edit**. - Locate the **Regions** listing. (For Templates and pages this is on the **Configure** tab.) - Assign the Block or Format to the region you created and **Submit** your changes.

## Related Links
- Code Sections

---

### How do I apply CSS?

You can apply CSS at the Template, Configuration, or Page level by linking to it in an XML Block.
## Create a Region in your Template:
1. Navigate to your Template and click **Edit**.
2. Create a new Region within the `<head>` tags of your Template by adding a System Region tag. Example: `<system-region name="CUSTOM CSS"/>`
3. **Submit** your changes.
## Upload your CSS:
1. Click **Add Content** and select the **File** asset type.
2. Drag and drop or choose your CSS file from your computer and click **Submit**.
## Create an XML Block:
1. Click **Add Content** and select the **Block** > **XML** asset type.
2. Add a link to your CSS file in the code editor and click **Submit**. Example: `<link rel="stylesheet" type="text/css" href="/_cascade/css/custom.css"/>`
## Attach your XML Block:
At the Template or Page level:
1. Navigate to your Template or Page and click **Edit** > **Configure**.
2. Locate the Region you created, click **Choose Block**, select your XML Block and click **Choose** to attach it to the Region.
3. Click **Submit**.
Or at the Configuration level:
1. Click **Manage Site** > **Configurations**, select your Configuration, and click **Edit**.
2. Locate the Region you created, click **Choose Block**, select your XML Block and click **Choose** to attach it to the Region.
3. Click **Submit**.

---

### How do I configure 301 Redirects?

[301 redirects](https://datatracker.ietf.org/doc/html/rfc7231#section-6.4.2) should be handled by a configuration file on your web server. For example, an *.htaccess* file if using an Apache-driven web server or a *web.config* file if using a Microsoft (IIS) web server.
While there is not a native feature in Cascade CMS regarding 301 redirects, you can maintain and update your configuration file in Cascade CMS and publish it to the root of your web server when needed.
Below are links to additional information on Apache and Microsoft configuration files:
- [Apache HTTP Server Tutorial](https://httpd.apache.org/docs/2.4/howto/htaccess.html)
- [Microsoft (IIS) HTTP Redirects](https://docs.microsoft.com/en-us/iis/configuration/system.webServer/httpRedirect/)

## Related Links
- Vanity URLs / Redirects

---

### How do I reorder items in a navigation menu?

One of the most common strategies for implementing a navigation menu is to dynamically output links to the assets contained within a particular Folder. This type of setup often relies on the ordering of those items within that Folder when deciding how to display them within a navigation menu.
To change the Order of items contained within a Folder, see the steps outlined here.
**Note**: While the steps above will work in many cases, you may find that reordering items in a Folder has no effect on your navigation menu. This means that your menu is being generated in some other way (i.e., alphabetically, in a static XHTML Block, etc.) and you would need to reach out to your CMS or Site Administrator to find out how updates are made to that menu. **Tip**: After making updates to a navigation menu, it is important to publish all Pages in your Site that contain that menu. This will ensure that each page on your live website gets updated with the latest changes.
## Related Links
- Folders

---

### How do I sort on a Calendar field?

The format of a Calendar field value (distinct from a Date/Time field) is `MM-dd-yyyy` which can make it tricky to sort on without some additional work to convert it to a numerical timestamp.
Here are some examples of using a lookup table to sort pages on a Calendar field:
## With the XPathTool
```
#set ($pages = $_XPathTool.selectNodes($contentRoot, "/system-index-block/system-page[system-data-structure[calendar-field != '/']]"))#if ($pages.size() > 0) #set ($lookupTable = []) #foreach ($p in $pages) #set ($date = $_DateTool.toDate("MM-dd-yyyy",$p.getChild("system-data-structure").getChild("calendar-field").value)) #set ($dateTimestamp = $date.getTime()) #set ($_void = $lookupTable.add({ "timestamp": $_MathTool.mul($dateTimestamp, 1), "page": $p })) #end #foreach($page in $_SortTool.sort($lookupTable, ["timestamp:desc"])) #set($timeStamp = $page.get("timestamp")) #set($item = $page.get("page")) #set($itemDate = $_EscapeTool.xml($item.getChild("system-data-structure").getChild("calendar-field").value)) #set($dateFormat = $_DateTool.getDateFormat("MM-dd-yyyy", $_DateTool.getLocale(), $_DateTool.getTimeZone())) #set($itemDate = $dateFormat.parse($itemDate)) #set($itemTitle = $_EscapeTool.xml($item.getChild("title").value)) $_DateTool.format( 'MM/dd/yyyy', $itemDate ) - ${timeStamp} - $itemTitle #end#end
```
## With our API
```
#set ($pages = $_.query().byContentType("path/to/Content Type").execute())#set ($removed = $_ListTool.removeNull($pages, "structuredDataNode(calendar-field).textValue"))#if ($pages.size() > 0) #set ($lookupTable = []) #foreach ($p in $pages) #set ($date = $_DateTool.toDate("MM-dd-yyyy",$p.getStructuredDataNode("calendar-field").textValue)) #set ($dateTimestamp = $date.getTime()) #set ($_void = $lookupTable.add({ "timestamp": $_MathTool.mul($dateTimestamp, 1), "page": $p })) #end #foreach($page in $_SortTool.sort($lookupTable, ["timestamp:desc"])) #set($timeStamp = $page.get("timestamp")) #set($item = $page.get("page")) $item.getStructuredDataNode("calendar-field").textValue - ${timeStamp} - $item.metadata.title #end#end
```

---

### I won't open a connection to &lt;ip address 1&gt; (only to &lt;ip address 2&gt;)

When attempting to publish to an FTP server, users may encounter messages like the following:
```
I won't open a connection to <ip address 1> (only to <ip address 2>)
```
This error typically indicates that the underlying Transport is configured to use Active FTP while the target server only supports Passive FTP. To address this:
- Edit the FTP Transport in question
- Check the option to **Use Passive FTP (PASV)**
- Submit

---

### Image Resizer Plug-in

## Overview
This plug-in resizes images with the specified width and height.
**Note** - This plug-in is applicable to Asset Factories for files only.**Note** - This plug-in relies on the Java Imaging API and is only able to work with freely-licensed image formats. This means this plug-in can work with JPEG, JPEG2000, BMP, PNG, WebP, and GIF images.
## Parameters
- **Height** - The height of the resized image, in pixels. If left blank, the height will be interpolated using the supplied width to maintain the aspect ratio of the original image.
- **Width** - The width of the resized image, in pixels. If left blank, the width will be interpolated using the supplied height to maintain the aspect ratio of the original image.
If you supply both a height and width parameter, the aspect ratio of the original image will not be maintained.

---

### Inserting a video

To include a video in your page content:
- Place your cursor in the editor at the location where you'd like the video to be inserted.
- Click the **Insert/edit media** icon.
In the pop-up dialog box, there are a few tabs available to you which you can utilize depending on how you intend to include your video. 
If you have a direct URL to the video in question, you can use the steps below to include it in an iframe:
- Under the **General** tab, enter/paste your video URL into the **Source** field.
- Optionally, you can change the width and height (in pixels) of the video using the **Dimensions** fields.
- Click **Ok**.
If you have embed code for the video that you'd like to include:
- Switch to the **Embed** tab.
- Enter/paste your embed code into the text area as indicated.
- Click **Ok**.

---

### Installation &amp; Upgrades

This section provides information on installing and upgrading Cascade CMS for on-premise environments.

---

### Installation/Upgrade (macOS)

## Before you begin
- Download Cascade CMS.
- If you're upgrading your environment, be sure leave your existing installation directory in place to reference configuration files and customizations, and choose a NEW installation directory when prompted by the installer or when unzipping the ZIP file.
- If you're installing Cascade CMS for the first time, make sure you've created and imported the default schema for the database vendor according to the corresponding instructions.
## Open the installer
Double-click the **cascade-{version}-osx.jar** file to begin the installation. Alternatively, the JAR package can be run by executing the following (from the terminal):
```
java -jar cascade-{VERSION}-osx.jar
```
1. Read the statement.
2. Check the box labeled *I have read and understand the preceding statement.*
3. Click **Next**.
## Select the installation type
1. Select **Full Cascade Installation**. A Full Cascade Installation will instruct the installer to install a fresh instance of Cascade CMS on the machine.
2. Click **Next**.
## Configure Cascade CMS
1. Fill in (or browse to) the **Cascade CMS installation directory**. By default, Cascade CMS will install to */Applications/Cascade CMS*
2. In the **Run Cascade CMS on port** field, enter the port on which Cascade CMS will be accessed. The default port is `8080`.
3. Fill in the **Maximum amount of memory Cascade can use (in MB)** field. The default setting is `512`.
4. Click **Next**.
## Configure the database
1. Select the **Database type** which will be used (MySQL, Microsoft SQL Server, or Oracle). Selecting **Manual Configuration** allows for configuring the database connection after the Cascade CMS installation.
2. Fill in the **Database hostname:port** field with the hostname and port of the database server that Cascade will use.
3. Enter the **Database name** to which Cascade CMS will connect. For Oracle, also fill out the **Schema name** and **Oracle SID** fields. In most cases, the Database name and Schema name should be the same.
4. Fill in the **Username** and **Password** fields for accessing the Cascade CMS database. For Oracle, the Username must match the Schema name.
5. *Optional:* Click the **Test Connection** button to test the connection to the database using the specified credentials.
6. Click **Next**.
## Complete the installation
1. Read the Cascade CMS license agreement.
2. Select *I accept the terms of this license agreement.* - Selecting *I do not accept the terms of this license agreement.* will prevent the installation from completing.
3. Click **Next**.
4. Wait for the **Pack Installation progress** bar to display **[Finished]** and **Overall installation progress** to display **1/1**.
5. Click **Done.**
## Apply customizations (if applicable)
Manually apply any further customizations you've made to Cascade CMS, including:
- Customizations to the *tomcat/conf/context.xml*`` file not including the database configuration (which is configured by the installer).
- Customizations to the ``*tomcat/conf/server.xml* file not including the HTTP port (which is configured by the installer).
- Customizations to the ``*tomcat/conf/web.xml* file.
- Copying custom Asset Factory plugins, Publish Triggers, and custom authentication modules from the old/existing *tomcat/webapps/ROOT/WEB-INF/lib* directory to the new installation folder's *tomcat/webapps/ROOT/WEB-INF/lib* directory.Note**:** The *tomcat/webapps/ROOT/WEB-INF/lib*`` directory will not exist in the new installation until the application has been deployed at least once. For this reason, the application will need to be started and stopped before copying over your custom JAR files.
**IMPORTANT** - The following files should **not** be copied from the old installation into the new installation as they can cause compatibility problems: ``*tomcat/conf/context.xml*, *tomcat/conf/server.xml*, and *tomcat/conf/web.xml*. Instead, they should be used only as a reference for updating the corresponding files in the new installation.
## Start Cascade CMS
1. Open a terminal window.
2. Change into the Cascade CMS installation directory (ex. */Applications/Cascade CMS*).
3. Type `./cascade.sh start`
## Log in
Once the application is running, you should be able to access it in your browser by navigating to `hostname:8080`. Where `hostname` is the host name of the machine on which Cascade is installed and `8080` is the port configured during the installation.
The default credentials to log in are:
```
username: adminpassword: admin
```
We recommend changing this password to something more secure immediately after logging in.

---

### Installation/Upgrade (Windows)

## Before you begin
- Download Cascade CMS.
- If you're upgrading your environment, be sure leave your existing installation directory in place to reference configuration files and customizations, and choose a NEW installation directory when prompted by the installer or when unzipping the ZIP file.
- If you're installing Cascade CMS for the first time, make sure you've created and imported the default schema for the database vendor according to the corresponding instructions.
## Remove the Windows Service (if applicable)
The Cascade CMS Windows service can be removed by following these steps:
1. Open a command prompt using the **Run as Administrator** option.
2. Change into to the Cascade CMS installation folder.
3. Enter: `removecascadeservice.bat`
The Windows service with the name `Cascade CMS` will be removed.
## Open the installer
1. Right-click on the **cascade-{version}-win.exe** or **cascade-{version}-win.jar** file and select the **Run as Administrator** option to begin the installation.
2. Read the statement.
3. Check the box labeled *I have read and understand the preceding statement.*
4. Click **Next**.
## Select your installation type
1. Select **Full Cascade Installation**. A full Cascade CMS installation will instruct the installer to install a fresh instance of Cascade CMS on the machine.
2. Click **Next**.
## Configure Cascade CMS
1. Fill in (or browse to) the **Cascade installation directory**. Cascade CMS will install to *C:\Program Files\Cascade CMS *by default. **Important:** If you have a prior installation of Cascade CMS, pick a new/different installation directory or rename the previous installation directory before proceeding.
2. In the **Run Cascade CMS on port** field, enter the port on which Cascade CMS will be accessed. The default port is 8080.
3. Fill in the **Maximum amount of memory Cascade can use (in MB)** field. The default setting is 512. (**NOTE:** This setting is only applicable for those running Cascade CMS from the command line. If Cascade CMS will run via Windows service, memory settings will need to be configured *after the installation is completed* according to: Modifying the Heap Size.)
4. Choose whether or not to **Start Cascade CMS Automatically on boot**. Selecting this option will install Cascade CMS as a Windows Service.
5. Click **Next**.
## Configure the database
1. Select the **Database type** which will be used (MySQL, Microsoft SQL Server, or Oracle). Selecting **Manual Configuration** allows for configuring the database connection after the Cascade CMS installation.
2. Fill in the **Database hostname:port** field with the hostname and port of the database server that Cascade will use.
3. Enter the **Database name** to which Cascade CMS will connect. For Oracle, also fill out the **Schema name** and **Oracle SID** fields. In most cases, the Database name and Schema name should be the same.
4. Fill in the **Username** and **Password** fields for accessing the Cascade CMS database. For Oracle, the Username must match the Schema name.
5. *Optional:* Click the **Test Connection** button to test the connection to the database using the specified credentials.
6. Click **Next**.
## Complete the installation
1. Read the Cascade CMS license agreement.
2. Select *I accept the terms of this license agreement.* - Selecting *I do not accept the terms of this license agreement.* will prevent the installation from completing.
3. Click **Next**.
4. Wait for the **Pack Installation progress** bar to display **[Finished]** and **Overall installation progress** to display **1/1**.
5. Click **Done.**
## Apply customizations (if applicable)
Manually apply any further customizations you've made to Cascade CMS, including:
- Customizations to the *tomcat/conf/context.xml*`` file not including the database configuration (which is configured by the installer).
- Customizations to the ``*tomcat/conf/server.xml* file not including the HTTP port (which is configured by the installer).
- Customizations to the ``*tomcat/conf/web.xml* file.
- Copying custom Asset Factory plugins, Publish Triggers, and custom authentication modules from the old/existing *tomcat/webapps/ROOT/WEB-INF/lib* directory to the new installation folder's *tomcat/webapps/ROOT/WEB-INF/lib* directory.Note**:** The *tomcat/webapps/ROOT/WEB-INF/lib*`` directory will not exist in the new installation until the application has been deployed at least once. For this reason, the application will need to be started and stopped before copying over your custom JAR files.
**IMPORTANT** - The following files should **not** be copied from the old installation into the new installation as they can cause compatibility problems: ``*tomcat/conf/context.xml*, *tomcat/conf/server.xml*, and *tomcat/conf/web.xml*. Instead, they should be used only as a reference for updating the corresponding files in the new installation.
## Start Cascade CMS
The application can be started using one of the following methods:
#### Windows Service
If you chose to install the Windows service, it can be started using the following steps:
- Navigate to the Windows Services dialog box.
- Right-click on the **Cascade CMS** service.
- Click **Start**.
#### Command Line
- Open a command prompt.
- Navigate to the Cascade installation directory ( ex. *C:\Program Files\Cascade CMS*).
- Type `cascade.bat start` .
**Note** - Use only one of the methods described above, as using both will lead to a port conflict with two instances of the application running simultaneously.
## Log in
Once the application is running, you should be able to access it in your browser by navigating to `hostname:8080`. Where `hostname` is the host name of the machine on which Cascade is installed and `8080` is the port configured during the installation.
The default credentials to log in are:
```
username: adminpassword: admin
```
We recommend changing this password to something more secure immediately after logging in.

---

### Installation/Upgrade (ZIP)

## Before you begin
- Download Cascade CMS.
- If you're upgrading your environment, be sure leave your existing installation directory in place to reference configuration files and customizations, and choose a NEW installation directory when prompted by the installer or when unzipping the ZIP file.
- If you're installing Cascade CMS for the first time, make sure you've created and imported the default schema for the database vendor according to the corresponding instructions.
## Edit the configuration files
1. Unzip the ZIP file into a new Cascade CMS installation directory. - Note: leave the current installation directory as is because you'll need to reference files from the existing installation later.
2. If using *nix/Linux, set execute permissions and ownership on the directory. Ex.: - `chmod -R u+x /path/to/cascade` - `chown -R {user}:{group} /path/to/cascade`
3. Edit *cascade.sh* (Linux/*nix/Mac OS) or ``*cascade.bat* (Windows)**`@{cascadeJRE}` - replace this string with the absolute path to your Java runtime folder which contains the *bin* sub-folder. - If you downloaded a full installer, which has the Java runtime bundled, enter the path to the *jdk* directory within the installer. - If you are choosing to use your own Java runtime, see configuring a Java installation.
4. `@{cascadeMemory}` - specify the maximum amount of memory available to Cascade CMS by replacing this string with a string of the form `-Xmx4096M`  where `4096` is the size of the memory in megabytes. See modifying the heap size for more information or the "Requirements" section of the Release Notes for additional information about recommended memory allocation.
Edit ``*tomcat/conf/context.xml* to configure the database connection.
1. ``Remove the first line containing `@{dbConf}`.
2. Uncomment the appropriate configuration for your database vendor.
3. Replace the following strings as specified: - `@{dbusername}` - the username for accessing your database - `@{dbpassword}` - the password for accessing your database - `@{dbhostport}` - the hostname and port separated by a colon (e.g. `localhost:3306`) - `@{dbname}` - the name of the database to use - `@{dbsid}` - the SID of the Oracle database server, usually `orcl`
Edit *tomcat/conf/server.xml*
- `@{dbschema}` - for Oracle, change this to the schema name of your database. For MySQL and SQL Server, remove the string entirely (e.g. `value=""` ).
- `@{cascadePort}` - the HTTP port on which Cascade will run (e.g. `8080`). See modify application ports for more information.
## Apply customizations (if applicable)
Manually apply any further customizations you've made to Cascade CMS, including:
- Customizations to the *tomcat/conf/context.xml*`` file not including the database configuration (which is configured by the installer).
- Customizations to the ``*tomcat/conf/server.xml* file not including the HTTP port (which is configured by the installer).
- Customizations to the ``*tomcat/conf/web.xml* file.
- Copying custom Asset Factory plugins, Publish Triggers, and custom authentication modules from the old/existing *tomcat/webapps/ROOT/WEB-INF/lib* directory to the new installation folder's *tomcat/webapps/ROOT/WEB-INF/lib* directory.Note:** The *tomcat/webapps/ROOT/WEB-INF/lib*`` directory will not exist in the new installation until the application has been deployed at least once. For this reason, the application will need to be started and stopped before copying over your custom JAR files.
**IMPORTANT** - The following files should **not** be copied from the old installation into the new installation as they can cause compatibility problems: ``*tomcat/conf/context.xml*, *tomcat/conf/server.xml*, and *tomcat/conf/web.xml*. Instead, they should be used only as a reference for updating the corresponding files in the new installation.
## Start Cascade CMS (Linux/*nix, macOS)
1. Open a terminal window.
2. Change into the Cascade CMS installation directory (ex. */Applications/Cascade CMS*).
3. Type `./cascade.sh start`
## Start Cascade CMS (Windows)
The application can be started using one of the following methods:
#### Windows Service
If you chose to install the Windows service, it can be started using the following steps:
1. Navigate to the Windows Services dialog box.
2. Right-click on the **Cascade CMS** service.
3. Click **Start**.
#### Command Line
1. Open a command prompt.
2. Navigate to the Cascade installation directory ( ex. *C:\Program Files\Cascade CMS*).
3. Type `cascade.bat start` .
**Note** - Use only one of the methods described above, as using both will lead to a port conflict with two instances of the application running simultaneously.
## Log in
Once the application is running, you should be able to access it in your browser by navigating to `hostname:8080`. Where `hostname` is the host name of the machine on which Cascade is installed and `8080` is the port configured during the installation.
The default credentials to log in are:
```
username: adminpassword: admin
```
We recommend changing this password to something more secure immediately after logging in.

## Related Links
- Running Cascade CMS as a Linux service

---

### Internal Cascade API

The internal Cascade API exposes a set of operations to developers for code run within Cascade CMS in Formats, Publish Triggers, Asset Factory Plugins, and other types of plugins.

---

### Invalid XML character was found in the element content of the document

When submitting an asset (like a Page or Block), users may encounter messages similar to the following:
`Invalid XML: An invalid XML character (Unicode: 0x2) was found in the element content of the document.```
In this particular case, the system has identified a control character (0x2) as appearing in the content of the asset. This can happen when such characters happen to be present in other documents which are copied/pasted into an editor within Cascade CMS.
To address the issue, you'll generally want to inspect the source code view of any and all WYSIWYG editors in the Page/Block. Control characters, for example, will typically appear with some additional highlighting in the source code view:
To allow the asset to save properly you'll need to remove the character(s) in question. This can generally be done by highlighting the character and then hitting the backspace or delete key. However, in some cases you may need to place your cursor just beyond the character in question and then hit the backspace key.

---

### Invalid XML: The prefix "o" for element "o:p" is not bound

If you receive this error when trying to create or submit changes to an asset, there may be `<o:p>` tags in the source code of your editor that will need to be removed or converted to regular `<p>` tags before the asset can be submitted.
Usually these tags are leftovers from pasting formatted content from Microsoft Word into the WYSIWYG editor. To avoid this error in the future, you can do one of the following:
- Enable the **Edit > Paste as text** option in the WYSIWYG and then paste your content.
- Paste the content into a plain-text editor like Notepad, TextEdit, or any code editor to remove formatting prior to pasting it into the WYSIWYG.

---

### Keyboard Shortcuts

## Overview
Cascade CMS features keyboard shortcuts in the following areas.
#### In Cascade CMS (General)
To see a list of available keyboard shortcuts in Cascade CMS, press Shift + ? on your keyboard while logged into the CMS to bring up the **Keyboard Shortcuts** menu.
Additional keyboard shortcuts are enabled by default, but you can toggle them by checking/unchecking the **Enable additional shortcuts** checkbox in the menu.
#### In Cascade CMS (Date/Time Fields)
When working in date/time fields such as Calendar or Date/Time fields the following shortcuts are available:

---

### Load Balancing

## Overview
Load balancing is the process by which activity in the system is evenly distributed across a network (multiple application servers) so that no single device/server is overwhelmed. 
With the re-architecture of Cascade CMS, users are provided the ability to load balance multiple application servers to reduce downtime and improve performance. This involves running multiple Cascade CMS machines behind a proxy, or load balancer; typically this will be Apache. To the end user, the CMS address stays the same; behind the scenes, one of many different application servers will handle each user’s requests.
Load balancing provides concurrency; it allows for more users in the system at one time. In addition, load balancing allows the system to handle server down-time more gracefully and includes failure detection. In the event of a server failure, for example, with three Cascade CMS servers running and Apache “in-front” of it handling load balancing, Apache will simply stop sending requests to the failing server.
Please note, when using Load Balancing, it is recommended that you have all of your servers living on the same LAN.

This diagram illustrates a typical CS load balanced network topology. Requests from end users are received by an Apache instance running the mod_jk module. These requests are then dispatched by mod_jk to the CS machines. The CS servers interact with the database normally. Typically one will be able to run multiple CS servers against a single database. Sometimes, depending on the configuration, it may be desirable for the database to also be load balanced; this is currently outside the scope of this document. At present, only CS load balancing is supported by Hannon Hill.
## Load Balancing Requirements
- All CS machines must be running the exact same version of the software.
- Running multiple CS nodes on the same physical machine is not supported.
- When upgrading a group of CS servers, all nodes must be brought down before the software is upgraded on each node.
- Hannon Hill supports using Apache 2+ mod_jk for fail-over and load balancing.
- Each CS node name must be unique.
If you have CS deployed in something other than the ROOT webapp, you will need to ensure that your JkMount directive uses the same webapp name as the mount point.
Session replication will not be a part of the CS load balancing strategy. That means that any user sessions that are on a node will be terminated if that node is brought down. The user will see this event as being redirected to the login screen.
When running in a load balanced configuration, all servers on which Cascade CMS are running must have their internal clocks synchronized to within one second of each other. The preferred solution is to use a common NTP (Network Time Protocol) server setting on all application servers.
All servers in a load balanced configuration must have their search index location (**Administration** > **Search Indexing** > **Index Location**) set to a shared disk space.
## Tomcat Configuration
Each CS application server runs off of an included Tomcat 8 instance. In order to enable load balancing, edit the *conf/server.xml* file:
Add a `jvmRoute=”nodename”` attribute to the `<Engine.../>` element:
```
<Engine name="Catalina" defaultHost="localhost" jvmRoute="xpproone">
```
The name of each node must be unique across all CS servers.
## Apache Configuration
The supported load balancing configuration includes Apache 2 + mod_jk. This document assumes that Apache 2 will load mod_jk as a shared module. This document also assumes that the reader has some familiarity with configuring Apache.
Once Apache 2 and mod_jk have been built, ensure that the following configuration file changes are made:
```
${apache.home}/conf/httpd.conf: LoadModule jk_module modules/mod_jk.so JkWorkersFile workers.properties JkShmFile mod_jk.shm JkLogFile logs/mod_jk.log JkLogLevel info JkLogStampFormat "[%a %b %d %H:%M:%S %Y] " JkMount /* loadbalancer
```
The JkMount directive assumes that the sole purpose of this apache instance is to proxy to a group of CS machines. If this is not the case, one may provide these directives in the context of a virtual host.
Note also that depending on how Apache is launched on your system, it may be necessary to provide full paths to the shared memory file, log file, and workers file.
```
${apache.home}/workers.properties: # Define the load balancer worker worker.list=loadbalancer worker.xpproone.type=ajp13 worker.xpproone.host=192.168.168.128 worker.xpproone.port=8009 worker.xpproone.lbfactor=1 worker.xpprotwo.type=ajp13 worker.xpprotwo.host=192.168.168.130 worker.xpprotwo.port=8009 worker.xpprotwo.lbfactor=1 worker.loadbalancer.type=lb worker.loadbalancer.balance_workers=xpproone, xpprotwo
```
The workers.properties file is the configuration file that mod_jk uses to determine where to relay requests. We’ll go over each one of the lines in this configuration:
```
# Define the load balancer worker worker.list=loadbalancer
```
This defines the load balancer worker. It will distribute requests to each CS server.
```
worker.xpproone.type=ajp13 worker.xpproone.host=192.168.168.128 worker.xpproone.port=8009 worker.xpproone.lbfactor=1
```
Defines a worker called xpproone. This must be the same name as that node’s jvmRoute attribute in server.xml. This worker is available at 192.168.168.128. Note that the port should be the same across all instances. This worker has a load factor of 1. Higher load factors will get more requests from mod_jk.
```
worker.xpprotwo.type=ajp13 worker.xpprotwo.host=192.168.168.130 worker.xpprotwo.port=8009 worker.xpprotwo.lbfactor=1
```
Similarly defines a worker called xpprotwo. The semantics in the previous section also apply here.
```
worker.loadbalancer.type=lb worker.loadbalancer.balance_workers=xpproone, xpprotwo
```
Defines the loadbalancer worker to be special type of worker that can distribute requests to other workers. Configures that worker to distribute its requests to xpproone and xpprotwo.
## Cache Configuration
In order for caching in load balanced Cascade CMS nodes to work properly, please follow these steps:
1. On each node, locate the *ehcache.properties* file in the directory: *tomcat/conf*.
2. Open the file in a text editor.
3. Verify whether or not your network has “multicast” enabled. If so, replace the `replication=none` property with `replication=multicast` in Section 1. If you are unsure if multicast is enabled, you can try it out with default settings and then confirm that cache synchronization works using the steps below. If you are aware of your specific multicast settings being different than the default ones, you will need to update the properties in Section 3.
4. If multicast is disabled, replace the `replication=none` property with `replication=manual` in Section 1 and proceed to Section 4 where you will need to provide current node's IP address in `thisnodeaddress` property and IP addresses of all the nodes in `node{n}address` properties where `{n}` is a consecutive number you can assign to each node starting from 1. It is important not to skip a number (e.g. by providing node1address and node3address but skipping node2address).
5. Optionally, you can change the port number the nodes will use to communicate with each other in Section 2. Change this if the default port 40001 is already taken by some other application. Change the `async` property to `false` if your nodes take too long time to synchronize with each other causing data inconsistency issues.
6. Copy the configuration to each node. For manual replication please remember to update `thisnodeaddress` property for each node.
**Important** - In addition to the `rmiport` setting in the *ehcache.properties* file (default: `40001`), the cache synchronization process must be able to dynamically allocate ports between `1024 - 65536` on every node in the cluster. Firewalls must be configured to allow all traffic between nodes over this entire port range.**Important** - These steps will need to be repeated after each upgrade of Cascade CMS from this point forward.
## Verifying Cache Synchronization
With nobody else accessing Cascade CMS at the time of this test, please perform the following steps:
1. Verify that **Index Block Rendering Cache** is enabled in the **Administration** >** Preferences** > **Content** > **Index Blocks** and that the **Use legacy caching strategy** option is disabled.
2. Log in to one node of your choice directly and create a folder Index Block with a folder selected so that at least one child asset’s name is being rendered in that Index Block when viewing it. Do not include the assets’ XML contents in your Index Block.
3. View that Index Block and take note of the child asset’s name inside of the rendering.
4. Log in to another node and rename that child asset.
5. Log back in to the first node and refresh the Index Block rendering. Verify that the new name is being displayed now.
If you still see the old name, it means that cache synchronization is not working properly. Potential reasons:
- Your firewall does not allow your nodes to communicate with each other. Please verify that the port provided in Section 2 as `rmiport` is open for communication between the nodes. Alternatively, change that port number to something else.
- If your configuration uses multicast replication you might need to adjust the multicast properties in Section 3. If you are unsure if multicast is enabled in your network at this point you might be better off by configuring manual replication.
- If you are using manual replication, please make sure that all the nodes’ IP addresses are correct, nodes numbers in property names are in consecutive order and that the `thisnodeaddress` property value is updated for each node.
- If you can verify your cache synchronization works using the steps above but it does not work using some other steps (especially if these steps involve making many asset modifications in short period of time), you can try disabling the `async` option is Section 2 which will end up with slower execution but it will make sure that all your nodes are synchronized as soon as changes are being made instead of performing the synchronization in the background.
## Tying it Together
Once configuration files have been edited, start Apache, and each Tomcat node. After the servers have been brought up, users should be able to access Cascade CMS through Apache.
## Troubleshooting
#### I try to log in, but keep getting redirected to the login screen over and over.
This is usually a result of a misconfiguration with mod_jk.  Make sure that each node’s jvmRoute attribute is set correctly, and is the name of the worker as defined in worker.properties.
#### I can log in, but I get automatically logged out repeatedly.
This is a common result of having asynchronized internal clocks on multiple servers. When running in a load balanced configuration, all servers on which Cascade CMS are running must have their internal clocks synchronized to within one second of each other. The preferred solution is to use a common NTP (Network Time Protocol) server setting on all application servers.

---

### Merge Trigger

## Overview
This trigger merges changes from the working copy into the current version. This should be called after the approvals are complete and right before publishing occurs.
**Note** - When adding the Version Trigger, Merge Trigger, and any publish trigger, they **must appear in this order** to properly perform all these actions in the database.
## Declaration
```
<trigger class="com.cms.workflow.function.Merge" name="Merge"/>
```
## Usage
```
<trigger name="Merge"/>
```
## Parameters
None.

---

### Migrating Cascade CMS to a new server

## Overview
The following is a general overview of steps you can take to migrate your instance of Cascade CMS to a new application server:
1. **Request a license for the new application server**. To do this, send an email to support [at] hannonhill.com and be sure to include: - The internal host name of the machine in question. To get this value, open a command prompt/terminal on the machine and enter:  `hostname` - The type of environment where you're installing Cascade CMS (production, test, development, etc).
2. **Download the Cascade CMS installer**. Visit our [downloads page](https://www.hannonhill.com/downloads/cascade) to obtain an installer *whose version matches - or is newer than - the version that you currently use* (on the machine you're migrating away from).
3. **Make a backup of your Cascade CMS database**. Create a backup of your database or verify that you have available backups from the previous night (just in case anything goes wrong).
4. **Install Cascade CMS**. Follow the steps for your O/S vendor to install/configure Cascade CMS. When prompted to enter the database connection information, be sure to enter the connection information for your existing Cascade CMS database.**Warning**: Before starting Cascade CMS on the new machine, be sure to **STOP** any other Cascade CMS processes on the old app server(s) that are running against the existing database.
5. **Start Cascade CMS**. Using the steps in your O/S vendor installation instructions, start Cascade CMS. When the application starts up, it will connect to your existing database (or whichever database you configured the app to point to during installation/configuration). When you browse to the login screen for the first time, you will be prompted to enter license (at which point you will enter the license key that you received from Hannon Hill in step 1).

---

### Migration Tool

## Overview
The Migration Tool is available from Hannon Hill's GitHub repository:
- [Download * *](https://github.com/hannonhill/Universal-Migration-Tool/releases)
- [Installation instructions * *](https://github.com/hannonhill/Universal-Migration-Tool/blob/master/README.md)
To utilize the tool after startup, open a web browser and type in `localhost:8081` in the address bar. You should see the following login screen.
Type the fully-qualified URL to your Cascade CMS instance into the first field. You will then type your username and password in the following fields. The Site Name dropdown will then populate with sites that are available in your Cascade CMS instance.
Choose the site that you would like to migrate your content into and select Save and Next.
You will then be presented with the screen to choose content from your computer that you would like to migrate.
Click on the Choose File button to choose a zip of the files that contain the content for migration. Once selected, click Save and Next.
**Note**: If you have already utilized the Migration Tool, radio options will appear to work with previous batches of content.
The above screen will allow you to map where links for sections of content that are  **not** being migrated should point. This is often helpful if you are migrating sections of content where you may be referencing the section using a relative link. If you are migrating all of your content in one migration, you can skip this screen by clicking Save and Next.
If you have relative links in your content being migrated to content not being migrated, you will need to decide whether that section of content should point to a Cross Site link or an External Link.
Use Cross Site link if the content will be or has been migrated into another site in Cascade CMS. Use External Link if the content will be maintained outside of Cascade CMS.
If you choose Cross Site radio option, enter the Site Name. If you choose External Link radio option, enter the fully qualified URL.
An example of the above would be ../athletics/some/link.html appearing in your content being migrated.
If athletics section of your site will be managed in the Athletics site and migrated separately:
- Input athletics into the Root Level text box
- Select Cross Site
- Enter Athletics in the corresponding text box
- Select Add Mapping
If athletics section of your site will be managed external to Cascade CMS:
- Input athletics into the Root Level text box
- Select External Link
- Enter `http://fullyQualifiedURLforAthleticsSite` (could even be something like `http://yourdomain.edu/athletics`) in the corresponding text box
- Select Add Mapping
Once all of your mappings are complete, select Save and Next.
The above screen will allow you to choose the page type (Content Type) from Cascade CMS that you would like your content to import into.
Select the appropriate page type from the dropdown. In the Page Extensions text box, enter the extensions for the files in your content set that you would like converted to pages in Cascade CMS.
The XHTML Block extensions field allows you to map file types in your import to become Cascade CMS blocks. It is alright to leave this field blank if no content should be converted to blocks.
Once you have entered your selections, select Save and Next.
The above screen will now allow you to map specific sections of content to specific fields in your page type in Cascade CMS. You should use XPath to target specific areas of content within your page source code. You can learn more about XPath by reviewing tutorials about XPath. XPath is **not **native to Cascade CMS.
Once you know your XPath, fill it into the text box below XPath. Then select the field you would like the content mapped to in the To Cascade Field dropdown. Select Add Mapping. Repeat this process as many times as necessary until all of your content areas are mapped.
Static values can also be mapped to Cascade CMS fields. Simply change XPath in the dropdown to Static Value. You will then fill in the content you would like mapped to the Cascade CMS field in the corresponding text field.
Three common mappings are for title, keywords, and description in the head of an html page.
The following XPath can typically be used for those fields:
- Keywords: //meta[@name="keywords"]/@content
- Description: //meta[@name="description"]/@content
- Title: //title/text()
To map images to File chooser fields:
- Target the element containing the `src` attribute that points to the image (do not target the `src` attribute directly)
- Ensure that the source files use relative image paths
Once all are mapped, select Save and Next.
The next screen will be the summary screen. The summary screen will present you with all of the information for what you selected to migrate. It will also have four different options for migrating content.
- Keep existing (adds numbers to the end of new asset names)This option is typically used if you have not migrated content to the site yet. This is great for testing mappings because it will produce the fastest migration process. If you have already migrated content, you may not want to use this option since it will create duplicate pages for content already migrated.
Overwrite existing (deletes and re-creates them)
- This option is typically used for migrating content if you have already migrated into the site previously and you needed to refine mappings. This will do a delete and recreate each page in the migration set.
Update existing (edits existing assets)
- This option is typically used for migrating content if you have already migrated into the site previously and you needed to refine mappings. This will do an edit to the page in the migration set. Please note: all content in the page being remigrated will be updated, not just specific fields. This is advantageous in case you had created new content outside of this site that links to content being remigrated. It will prevent broken links in those cases.
Skip existing (does nothing if asset already exists, always on for files)
- This option is typically used for migrating content that was left out of the original migration. Two commn use cases are the following: 1) You forgot to include a directory of content in your migration set and you have now added it into the original set of content being migrated. 2)There was a common error on pages being migrated that prevented them from being migrated. You have now fixed that error in all of the files and would like to rerun the tool over the migration set.
Once you have reviewed your mappings and selected the appropriate radio option, select Save and Next to start the migration process.
You will now see all of your files and pages being imported into Cascade CMS.

---

### Modifying Application Ports

## Changing the default port
1. Shut down Cascade CMS.
2. Edit the */tomcat/conf/server.xml*`` file.
3. Locate the `HTTP/1.1` Connector: `<Connector port="8080" maxHttpHeaderSize="8192" ../>`
4. Change the port attribute (the default is `8080`) and save the file.
5. Restart Cascade CMS.
6. Repeat the same steps for any other Connector used within the configuration (e.g. SSL and.or AJP).
## Multiple instances of Cascade CMS
While running multiple instances on one machine is discouraged, it is possible to do so if the HTTP and shutdown ports are modified to prevent the instances from interfering with one another.
**Warning**: Running multiple environments on a production machine is not supported.In addition to modifying the HTTP port (as mentioned above), administrators must also modify the shutdown port:
1. Edit the ``*/tomcat/conf/server.xml* file.**
2. Change the port attribute (the default is `8005`): `<Server port="8005" shutdown="SHUTDOWN">`
3. Save the file.
4. Restart Cascade CMS.

---

### Modifying the Heap Size

## Linux/*nix
1. Stop Cascade CMS
2. Edit the *cascade.sh*`` file (found in the Cascade CMS root directory).
3. Add/Modify the `-Xmx` and `-Xms` parameters in `JAVA_OPTS`. For example, the following line sets both the minimum and maximum heap size to **2048M**:`export JAVA_OPTS="-Xmx2048M -Djava.awt.headless=true -Dfile.encoding=UTF-8"`
4. Start Cascade CMS.
## Windows (service)
1. Right-click the *CascadeCMSw.exe*`` file (found in *tomcat/bin*) and select the **Run as Administrator** option.
2. In the configuration UI click on the **Java** tab.
3. Enter a value for the **Initial memory pool** field.
4. Enter a value for the **Maximum memory pool** field.
5. Click **Apply**.
6. Restart the Cascade CMS service.
## Windows (command line)
1. Stop Cascade CMS.
2. Edit the ``*cascade.bat* file (found in the Cascade CMS root directory).
3. Add/Modify the `-Xmx` and `-Xms` parameters in `JAVA_OPTS`. For example, the following line sets both the minimum and maximum heap size to **2048M**:`set JAVA_OPTS="-Xms2048M -Xmx2048M -Djava.awt.headless=true -Dfile.encoding=UTF-8"`
4. Start Cascade CMS.

---

### Modifying the Thread Stack Size

**Warning**: Do not change this parameter unless instructed to do so by Hannon Hill Product Support.**Note**: The default thread stack size is **1M**.
## Linux/*nix
1. Stop Cascade CMS.
2. Edit the ``*cascade.sh* file (found in the Cascade CMS installation directory).
3. Add/Modify the `-Xss` parameter in `JAVA_OPTS`. For example, the following sets the thread stack size to **4M**:` export JAVA_OPTS="-Xss4M -Xmx1024M -XX:MaxPermSize=256m -Djava.awt.headless=true -Dfile.encoding=UTF-8"`
4. Restart Cascade CMS.
## Windows (service)
1. Using Windows Explorer, navigate into the *tomcat\bin* folder
2. Right-click on the ``*CascadeCMSw.exe* file and select **Run as Administrator**.
3. In the Cascade CMS Properties UI, click on the **Java** tab.
4. In the **Thread stack size** field, enter a value (4000 KB, for example)
5. Click **Apply**/**OK**.
6. Restart the Cascade CMS service.
## Windows (command line)
1. Stop Cascade CMS.
2. Edit the *cascade.bat*`` file (found in the Cascade CMS installation directory).
3. Add/Modify the `-Xss` parameter in `JAVA_OPTS`. For example, the following sets the thread stack size to **4M**:` set JAVA_OPTS="-Xss4M -Xmx1024M -XX:MaxPermSize=256m -Djava.awt.headless=true -Dfile.encoding=UTF-8"`
4. Restart Cascade CMS.

---

### My Content

## Overview
The** My Content** area and dashboard widget allow you to quickly access all of the content you're responsible for:
- **Starred** - Assets you've starred.
- **Recent** - Assets you've accessed recently.
- **Owned Content** - Assets for which you're the assigned content owner.
- **Drafts** - Your unsubmitted drafts for both existing and newly-created assets. To discard drafts of assets in this list, select one or more drafts and click the **Discard** trash can icon at the top of the list.
- **Workflows** - Workflows you've started and workflows where you or one of your groups owns the current step.
- **Locked Assets** - Assets you've checked-out/locked. To discard changes to assets in this list, select one or more assets and click the **Break Lock** padlock icon at the top of the list.
- **Tasks Assigned to Me** - Your assigned tasks. From this list you can resolve or delete existing tasks or add new ones.
The content displayed in this area includes assets from all sites you have access to. You can sort and filter the assets in the My Content area by using the column headers and search boxes. Click on any item to view that asset or action item.

---

### MySQL 8: Public Key Retrieval is not allowed

After upgrading to MySQL 8, you may encounter the following error on startup:
```
liquibase.exception.JDBCException: java.sql.SQLException: Cannot create PoolableConnectionFactory (Public Key Retrieval is not allowed)...Caused by: com.mysql.jdbc.exceptions.jdbc4.MySQLNonTransientConnectionException: Public Key Retrieval is not allowed
```
To remedy this:
- Stop Cascade CMS
- Edit your tomcat/conf/context.xml file and add allowPublicKeyRetrieval=true to your url parameter. Example:
```
url="jdbc:mysql://localhost:3306/cascade?useUnicode=true&amp;characterEncoding=UTF-8&amp;useSSL=false&amp;allowPublicKeyRetrieval=true"
```
- Start Cascade CMS

---

### Optimize Database

## Overview
The Optimize Database tool removes and/or repairs various records within the database. It is NOT recommended to run this tool frequently.
**Warning** - Before running any optimization tool, please backup your database to protect against data loss.
## Running the Optimize Database Tool
To run the Optimize Database tool:
1. Click the system menu button ( * *) > **Administration** > **Optimize Database**.
2. Select **Optimize Database**.
3. Configure the following options: - **Remove notifications and expired announcements** - Removes notifications and expired announcements from the database. - **Remove Smart Publishing information** - Removes all cache information used to intelligently decide when a published file needs to be re-transmitted to the destination server. - **Remove old versions of assets** - Removes all but the current version for all version-capable assets from the database. This includes: pages, files, blocks, formats, templates and external links. - **Remove orphaned records** - Removes all child records from the database that are no longer referenced by a parent record (e.g. blobs, metadata, page configurations, page regions, etc.). - **Remove Background Task History** - Removes all background task history items before the selected start date/time.
4. Click **Submit**.

---

### ORA-22275: invalid LOB locator specified

Oracle users may encounter this error when attempting to copy, edit, or submit assets in the system. The behavior will cause messages similar to the following to appear in the cascade.log file:
```
2015-09-14 07:54:10,936 WARN [JDBCExceptionReporter] SQL Error: 22275, SQLState: 999992015-09-14 07:54:10,937 ERROR [JDBCExceptionReporter] ORA-22275: invalid LOB locator specified
```
This problem is caused by the following Oracle bug (Oracle account login required to view): [Bug 19703301 ORA-22275 "invalid lob locator specified" if fix for bug 14044260 present](https://support.oracle.com/epmos/faces/DocumentDisplay?parent=DOCUMENT&sourceId=1683799.1&id=19703301.8)
To correct the issue, apply *DATABASE PATCH SET UPDATE 12.1.0.2.160719 or greater *to your Oracle environment as described in the link above.

---

### Parameters missing

This article describes steps to take when you receive a 'Parameters missing' error while attempting to submit a file or page.
The error message may appear when the amount of data being sent during a submission is larger than allowed by your application server's Tomcat configuration. For example, it can occur on pages or files containing a large volume of XML or when using Data Definitions with many fields or groups.
If you receive this error, please try the following:
1. Stop Cascade CMS
2. Edit your *tomcat/conf/server.xml* file
3. In the the appropriate `<Connector>` element, add the following two attribute/value pairs: ``` maxPostSize="6000000"maxParameterCount="65536" ```
4. Start Cascade CMS
After completing the steps above, resubmit the file or page and verify that the operation completes. If you continue to receive the 'Parameters missing' error, please contact the Hannon Hill Product Support team for more assistance.

---

### Relationships

## Overview
View and publish content that links to an asset. You can view an asset's relationships by selecting **More > Relationships.**
The Relationships menu will display all assets that are related, either directly or manually, to another asset. For example, Pages or Blocks that link to the page you're viewing will be listed as Relationships for that page.
**Note: **Linked Relationships are created by a chooser OR a direct link (`<a href="..." />`). Links created dynamically in a Velocity Format will not show up as a Relationship, unless added as a Manual Relationship. 

## Related Links
- Publishing Related Content

---

### Rendering Metrics

## Overview
Rendering metrics is a tool used to evaluate rendering times of page. You can see how long it takes for each region in a page to render and can then adjust blocks and formats applied to slow regions to improve rendering times.
To view rendering metrics for a page, click **More** > **Rendering Metrics**.
**Total Rendering Time** is the overall time (in milliseconds) that it took to render the page.
Any regions where rendering time is greater than 250ms are considered "slow" and appear in the **Slow Regions** section.  Each region can be expanded to show the block and format assigned to the region and how long it took to render the block and apply the format.
Index Block metrics include the number of assets rendered and if the maximum number of indexed assets is reached. The asset count does not include assets rendered for Index Blocks that are rendered inside pages whose XML is rendered as a part of the original Index Block rendering. So, an Index Block that only indexes 1 page, where that 1 page contains an Index Block that indexes other pages, will only be displayed as having rendered a single asset as a part of the Index Block rendering.
The next section is **All Regions**, which displays every region in the page and how long it took to render each. Each region can be expanded the same way as the Slow Regions section.
The last section is **Other Rendering Operations**, which includes **Supporting Asset Load Time**, **Link Rewriting Time** and **Serialization Time**. Generally, you won't be able to do anything to change these numbers, but they could be a cause for concern if there are unreasonably high values reported.
**Note** - Note that the sum of the individual rendering times will not always add up to the total rendering time. This is because there are some system operations related to rendering that are not displayed as a part of rendering metrics and should be thought of as overhead rendering costs.
## Troubleshooting Slow Region Renders
Slow loading page regions are usually the result of slow loading Index Blocks associated with those regions. When troubleshooting a slow loading Index Block, consider the following:
- How many assets is the Index Block rendering?
- Could the depth or location of the index be changed to limit the number of assets being rendered?
- Could you use a Content Type Index Block instead of a Folder Index Block to index only pages using a particular Content Type?
- Indexing both asset content and metadata is more time consuming. Does your index block need to index asset content? Many dynamic content regions only require the metadata of other assets.

---

### Reports

Cascade CMS provides a number of reports geared towards monitoring user activity and content creation and management.

---

### Running Cascade CMS as a Linux service

## Using systemd
A sample systemd file can be found below:
```
[Unit]Description=Cascade CMSWants=network-online.targetAfter=network-online.target[Service]Type=forkingUser=cascadeExecStart=/path/to/cascade/cascade.sh startExecStop=/path/to/cascade/cascade.sh stop 15 -forceExecReload=/path/to/cascade/cascade.sh stop 15 -force | sleep 5 | /path/to/cascade/cascade.sh startRestart=on-failureRestartSec=30s[Install]WantedBy=multi-user.target
```
**Note**: The sample above assumes that your O/S account is named `cascade`.
**Using Apache as a proxy?** You'll want to change lines 3 and 4 above to the following:
```
Wants=network-online.target httpd.serviceAfter=network-online.target httpd.service
```
## Using init.d
A sample init.d file can be found below:
```
#!/bin/bash# Cascade startup script#chkconfig: 2345 80 05#description: Hannon Hill Cascade CMS# Source function library.. /etc/rc.d/init.d/functions# Wait time for stopping (and restarting) the serviceWAIT_TIME=15# Cascade Linux service controller scriptAPP=CASCADEBASE=/path/to/cascadeUSER=cascadecd $BASEfunction start { echo "Starting $APP" sudo -u $USER $BASE/cascade.sh start return $?}function stop { echo "Stopping $APP" sudo -u $USER -c $BASE/cascade.sh stop $WAIT_TIME -force return $?}case "$1" in start) start RETVAL=$? ;; stop) stop RETVAL=$? ;; restart) stop sleep $(($WAIT_TIME + 1)) start RETVAL=$? ;; *) echo "Usage: $0 {start|restart|stop}" RETVAL=2 ;;esacexit $RETVAL
```
**Note**: The sample above assumes that your O/S account is named `cascade`.
``
## Looking to create a system user for the service?
#### Create new system user with group
To create a new `cascade` system user without a home directory and without login/bash ability, along with a corresponding group, execute the following command:
```
sudo useradd -M -s /usr/sbin/nologin cascade
```
To verify the new user was created:
```
sudo id cascade
```
#### Configure `ulimit` for the new user
Cascade CMS can potentially open many files at a time which can sometimes lead to issues such as "too many open files" error messages. To add a user-specific ulimit configuration:
```
sudo touch /etc/security/limits.d/cascade_limits.confsudo bash -c 'echo "cascade - core unlimited" >> /etc/security/limits.d/cascade_limits.conf'sudo bash -c 'echo "cascade - nofile 999999" >> /etc/security/limits.d/cascade_limits.conf'
```
To verify the new limits:
```
sudo -u cascade bash -c "ulimit -Ha"
```
**Note:** The commands above may vary depending on the flavor of Linux you are using.
## Related Links
- Installation/Upgrade (ZIP)

---

### Securing session cookies

Follow the steps below to set the secure flag for Cascade CMS session cookies:
- Stop Cascade CMS
- Edit `tomcat/conf/web.xml`
- Locate `<session-config>` and place the following code within those tags: ``` <cookie-config> <http-only>true</http-only> <secure>true</secure> </cookie-config> ``` ````
- Save
- Start Cascade CMS

---

### Set Start Date Plug-in

## Overview
This plugin sets the Start Date metadata field value to the current date and time with an optional offset.
## Parameters
- **Offset **– The new asset's Start Date will be calculated by adding this offset (in seconds) to the asset's creation time.

---

### SFTP: java.net.SocketTimeoutException: Read timed out

Users may see the following error message when attempting to publish to an SFTP server:
```
com.hannonhill.cascade.model.publish.transmit.ShuttleRuntimeException: SFTP error occurred during SFTP Shuttle setup: Session.connect: java.net.SocketTimeoutException: Read timed out
```
This error is typically caused by a maximum concurrent connections limit on the SFTP server itself (either total concurrent connections or concurrent connections from a specific IP).
To resolve the issue, increase the connection limit(s) on the target SFTP server (we recommend a minimum of **25** connections, but some organizations may require more).
**Note**: Cascade CMS uses a parallel publishing model where up to 2 publish jobs from every Site can be publishing at the same time. A publish job will use at most 4 connections and a minimum of 1 connection (depending on the number of concurrent jobs publishing at once).
## Related Links
- Transports

---

### Shared Fields

## Overview
Shared Fields allow you to manage, update, and share fields and field groups across Data Definitions and across sites.
For example, you may maintain drop-down or multi-select lists for departments or academic majors. Or you may have field groups for creating contact information blocks or image carousels. If you need to add or remove an item from your list or field group, Shared Fields will let you update it one time, from one location, and the changes will immediately be made available in all Data Definitions using that field or field group.
## Creating Shared Fields
To created a shared field:
1. Navigate to **Manage Site** > **Shared Fields**.
2. Navigate to the container in which the new Shared Field will be stored, or create a new container using **Add** > **Container**.
3. Click **Add** > **Shared Field**.
4. Select the type of Shared Field you'd like to create and click **Choose**. - Note that only the **Group** Shared Field type can contain multiple fields or have additional fields added after creation.
5. In the **Name** field, enter a name for your Shared Field.
6. In the **Parent Container** field, select a container for the Shared Field, if desired.
7. In the **Builder** tab, configure the settings for your Shared Field or build a field group using the field types available in the toolbar. See Data Definitions for more information on field types and options.
8. Click **Submit** to save your Shared Field.
## Adding Shared Fields to Data Definitions
To add a Shared Field to a Data Definition:
1. Create a new Data Definition or edit an existing one.
2. In the **Builder** tab, click and drag a field corresponding to your Shared Field's type to the desired location in your Data Definition.
3. Click **Choose Shared Field**. - By default, only Shared Fields of the same type as the field chosen will be available in the chooser panel. - You can select a different field type by clicking the **Show all field types** link.
4. Select your Shared Field and click **Choose**.
5. In the **Field Properties** menu, configure any field settings you wish to override such as identifier, label, or whether the field is required. - Field settings that are overridden at the Data Definition level won't be updated when the corresponding setting is updated at the Shared Field level. - Field settings that are grayed out aren't able to be overridden and must be configured at the Shared Field level.
6. Click **Save**.
**Tip** - You can add the same Shared Field to a Data Definition multiple times, but the fields must have unique identifiers if they're contained in the same group.
## Replacing Fields with Shared Fields
Existing fields or field groups in a Data Definition can be replaced with a Shared Field so long as the identifier and type of the existing field and the identifier and type of the Shared Field are identical.
To replace an existing field or field group with a Shared Field:
1. Edit your Data Definition.
2. Edit the existing field or field group by clicking the pencil icon ( * *) next to it.
3. Click **Choose Shared Field**.
4. Select your Shared Field and click **Choose**.
5. In the **Field Properties** menu, configure any field settings you wish to override such as identifier, label, or whether the field is required. - The **Identifier** field must match the existing field's identifier exactly. - For Shared Field groups, the group **Identifier** field and identifiers and types of all contained fields must also match exactly. Contained field identifiers can't be overridden at the Data Definition level and must be configured in the Shared Field itself.
6. Click **Save**.
**Warning** - To avoid data loss when replacing existing fields with Shared Fields, ensure the field type and identifier of the Shared Field matches the field type and identifier of the existing field exactly. When replacing field groups, overall group identifiers must be identical and all contained fields must also have identical identifiers and field types. **Mismatched field identifiers and/or field types will result in existing field content being discarded when the asset is next submitted.**

---

### Smart Fields

## Overview
With Smart Fields, you can selectively show fields and field groups in a Data Definition based on values selected in checkbox, drop-down, radio, and multi-select fields.
For example, you may choose to reveal a set of fields for contact information is a "Contact Information" checkbox is enabled. Or a "Column Type" radio field may reveal a WYSIWYG if "Text" is selected and an image chooser field if "Image" is selected.
Required fields or fields with content validated with regular expressions but are hidden due to Smart Field rules are not validated on submit. This allows you to create conditionally-required and conditionally-validated fields in Data Definitions.
## Creating Smart Fields
Smart Fields are created by editing the **Show Fields** property for values in a checkbox, radio button, drop-down, or multi-select field and selecting which fields or field groups should be revealed when that value is selected.
To set up Smart Fields in the Data Definition Builder:
1. Create or edit your Data Definition.
2. Create or edit a checkbox, radio button, drop-down, or multi-select field.
3. In the **Show Fields** field associated with each **Value**, select the field and/or field groups that should be shown when that value is selected.
To set up Smart Fields in the XML view:
1. Create or edit your Data Definition.
2. Add a `show-fields` attribute to the `<item>` containing the value that should reveal the other fields or groups or fields.
3. Enter a comma-separated list of field identifiers. For fields inside of groups, use a slash `/` to indicate the group nesting, e.g. `group1/inside-field`.
**Note** - When editing a Data Definition, all fields are visible regardless of Smart Field rules. Help text below each field affected by Smart Field rules explains when these fields will be shown.**Tip** - When viewing a Data Definition, use the **Apply Smart Field rules** toggle to preview your form with Smart Field rules applied.
## Example
A use case that demonstrates a few different features of Smart Fields is a form with fields for an address including a "Country" dropdown and associated zip-code field.
When the Country "United States" is selected, a "5 digit zip code" field could be revealed whereas when "Canada" is selected, a "6 character postal code" field could be shown. If the "Country" field has no value selected, both "5 digit zip code" and "6 character postal code" fields could be hidden.
```
<system-data-structure> ... other fields ... <text identifier="Country" type="dropdown"> <dropdown-item show-fields="5-digit-zip" value="US"/> <dropdown-item show-fields="6-char-postal" value="Canada"/> ... other countries ... </text> <text identifier="5-digit-zip" label="US Zip Code (5 digit)"/> <text identifier="6-chart-postal" label="Canadian Postal Code (6 characters)"/></system-data-structure>
```
These rules can stack up as well. In the example above, we could have an "Include Address?" checkbox with the "Country" show-field selected. This would automatically cause the "Country" field, "5 digit zip code", and "6 character postal code" fields to be hidden by default when the "Show Address?" checkbox is unchecked, even if the "Country" field has a default value selected. This is because for the Smart Field rules, hidden fields count as if they had no value selected.
```
<system-data-structure> ... other fields ... <text identifier="include-address" label="Include Address?" type="checkbox"> <checkbox-item show-fields="Country,..other address fields..." value="yes"/> <checkbox-item value="no"/> </text> ... other address fields ... <text identifier="Country" type="dropdown"> <dropdown-item show-fields="5-digit-zip" value="US"/> <dropdown-item show-fields="6-char-postal" value="Canada"/> ... other countries ... </text> <text identifier="5-digit-zip" label="US Zip Code (5 digit)"/> <text identifier="6-char-postal" label="Canadian Postal Code (6 characters)"/> </system-data-structure>
```
Groups of fields can also be progressively disclosed, which would result in the group being hidden by default unless a specific value is selected. In the example above, the "Country", "5 digit zip code", and "6 character postal code" fields could be inside of "Address" group. Then, the "Include Address?" checkbox could have the "Address" group selected as a show-field.
```
<system-data-structure> ... other fields ... <text identifier="include-address" label="Include Address?" type="checkbox"> <checkbox-item show-fields="Address" value="yes"/> <checkbox-item value="no"/> </text> <group identifier="Address"> ... other address fields ... <text identifier="Country" type="dropdown"> <dropdown-item show-fields="5-digit-zip" value="US"/> <dropdown-item show-fields="6-char-postal" value="Canada"/> ... other countries ... </text> <text identifier="5-digit-zip" label="US Zip Code (5 digit)"/> <text identifier="6-char-postal" label="Canadian Postal Code (6 characters)"/> </group> </system-data-structure>
```
## Smart Fields and In-context Editing
When editing a page in-context, only the fields selected to be editable in-context for a given region are included in Smart Field rules.
For example, if only the "Address" group from the example above is selected to appear in an in-context editable region and the "Include Address?" checkbox is not selected, the "Address" group will be always visible. The Smart Field rules configured for the "Include Address?" field will be ignored because it's not included in the editable region.
## Smart Fields and Structured Data
Smart Field rules don't affect the structured data rendered on pages or in index blocks. This is important when writing Formats because you can assume all fields will always be visible.
As a Format writer, you may need to check the values of fields you're using to reveal other fields. For example, a field such as the "Country" dropdown in the example above may have a value set but may not be shown due to the fact that "Include address?" is not checked. Before outputting the "Country" field in your format, you'll want to check the value of "Include Address?" instead of just checking for the presence of a value for the "Country" field.

---

### Snippets

## Overview
Snippets are small but essential pieces of content across your website that can be centrally managed in the CMS. Once a Snippet is created by a content manager, contributors can then discover and leverage those through various fields while creating and editing assets. 
Some common use cases for this include an organization’s name, department names, tuition rates, faculty-to-student ratio, or enrollment numbers. 
## Creating/editing a Snippet
To create a Snippet:
- Click **Menu -> Administration -> Snippets.**
- Click **+Add Snippet.**
- Fill out the required fields as described below:**Title** - A Snippet label shown to users when browsing and selecting Snippets. The label can contain any characters and be changed at any time, unlike the Snippet name which cannot be modified after creation.
- **Name** - The unique name/key used for Snippet value replacement. This can not be changed after creation. *Example: a snippet named `hello-world` with value `Hello World` can be referenced as `{snip:hello-world}` within your content and will render as `Hello World`.*
- **Value** - The value that will be used to replace the snippet.
To edit an existing Snippet:
- Click **Menu -> Administration -> Snippets.**
- In the Snippets listing, place your cursor next to the **Title** or **Value** of the Snippet that you're looking to modify and then click the pencil icon that appears to the right of it.
- Make the necessary changes in the input field and then click Update (check mark icon).
**Note**: In order to view Snippets, Users must have a System Role with the A**ccess Administration Area** ability enabled. Snippet values can only contain text content (no HTML).
## Viewing Snippet Relationships
To see a listing of assets where a particular Snippet is in use:
- Click **Menu -> Administration -> Snippets.**
- In the table listing that appears, locate the Snippet in question and click the **Relationships** button (far right). This is useful for determining any assets that will be affected by changes that you may make to your Snippet.
- Optionally, you can publish the related assets by using the **Publish All** button (or by using the multi-select checkboxes next to each asset and then clicking the **Publish** icon). This is important if you're looking to ensure that any recent changes to your Snippet's value get pushed to your live website(s) for the affected assets.
## Inserting a Snippet
Snippets can be inserted into plain text fields as well as within WYSIWYG editors (assuming the option has been enabled). 
To insert a Snippet into a text field or WYSIWYG editor:
- Click the **Insert Snippet** icon as seen here: 
- In the pop-up menu that appears, click the **Insert Snippet** icon (**+**) next to the Snippet you wish to insert into the field.
You'll then see the Snippet inserted into the field using the proper syntax (ex. `{snip:hello.world}`).
**Tip**: If you already know the name of your Snippet, you can manually type `{snip:*your-snippet-name*}` into a text field or WYSIWYG and the tag will be replaced with your Snippet value. **Note**: If you don't see the Insert Snippet icon while working in a WYSIWYG editor, you may need to request that your administrator enable it for the underlying WYSIWYG Editor Configuration.

---

### Spectate Connector

## Creating a Spectate Connector
To create a Spectate Connector:
1. Obtain the API Key from your Spectate account by logging into Spectate, clicking the **My Settings** link, and copying the key.
2. Navigate to **Manage Site** > **Connectors**.
3. Navigate to the container in which the new Connector will be stored, or create a new container using **Add** > **Container**.
4. Click **Add** > **Connector**.
5. Select **Spectate** and then click **Choose**.
6. In the **Name** field, enter the name for your Connector.
7. In the **Parent Container** field, select a container for your Connector, if desired.
8. In the **Spectate API Key** field, paste the key you copied from your Spectate account.
9. Click **Submit**.
## Verifying/Unverifying the Spectate Connector
To verify or unverify your Spectate connector:
1. While viewing (but not editing) your Connector, click **Verify**. If unsuccessful, an appropriate error message will be displayed.
2. Once verified, the **Unverify** link is available to deactivate the Connector.
Your Spectate Connector is now enabled. You can now select and insert your Spectate forms through the WYSIWYG when editing a page.

---

### Stale Content Report

## Overview

The Stale Content report displays a list of assets that have not been modified within a specified time period. The definition of what content is considered stale is specific to each user, with some restrictions:
- Page or File type assets may be considered stale.
- Only assets for which the user has write access are included in the results.
- Only assets within Folders that have **Include in Stale Content report** enabled in their properties are included in the results.
The list of results contains the following information:
- **Name** - The name of the asset and an asset link.
- **Owned By** - The username of the owner of the asset.
- **Last Updated** - The time the asset was last modified. Hover over the entry in this column for an exact date/time.
- **Last Updated By** - The username of the user who last modified the asset.
## Filtering the Report

The following filters are available to refine the results of the report:
- **Site** - A Site must be selected to display report data.
- **Content last updated more than _ days ago** - Manually enter how many days an asset can exist without being modified before it is considered stale, or select from the dropdown of common values.
- **Asset Type** - Choose whether Page and/or File assets are displayed in the results.
- **Show only content I own** - When this option is enabled, only assets that you are the owner of are displayed in the results.
- **Restrict to folders** - To restrict the results list to assets within specified folders, click **Choose Folder** and select a folder. Repeat these steps to add additional folders to the results list.
**Note** - Filtering the report to specified Folders will also filter the results of the Stale Content widget on your Dashboard.
## Send a Stale Content Notification

To send a stale content email notification:
1. Select one or more assets from the results list.
2. Click the **Notify by Email** envelope icon at the top of the list.
3. Click **Choose Users and Groups** and select Users/Groups to receive the notification email. You may also enter a comma-delimited list of email addresses.
4. Optionally, add a message to the notification recipients. By default, the system will send the user an email containing a brief description and link to the asset needing review.
5. Click **Notify**. An email will be sent using the email options configured in your System Preferences.
**Note** - To send a stale content email notification, users need the **Notify users by email about stale content** ability enabled in their Site Role.
## Schedule a Review Date

To schedule a review date:
1. Select one or more assets from the results list.
2. Click the **Schedule Review** calendar/clock icon at the top of the list.
3. Select a date for future review. Options include 1 month, 3 months, 1 year, or a specific date.
4. Click **Schedule Review**. This will update the asset Review Date metadata field to the specified date. Modifying an item’s Review Date does not change the item’s Last Modified date.
## Export Results as a CSV File
Information visible in the Stale Content report can be exported as a CSV file using the **Export CSV** link in the top right corner. The file will also contain information about the current user, Site name, and type of report.

---

### Table headers are poorly structured

If your content contains a table, you may see this error during accessibility checks:
`Table headers are poorly structured`
Based on the standard being violated, [1.3.1 Info and Relationships](https://www.w3.org/TR/UNDERSTANDING-WCAG20/content-structure-separation-programmatic.html), the cause may be that your table header cells lack scope attributes "to associate header cells and data cells in data tables".
You can add those attributes either directly via the HTML source (if you have access to it), or by editing the table's header cells in the WYSIWYG.
1. Select the table's header cells, right-click, and select **Cell properties**. - Change the **Cell type** to "Header cell". - Change the **Scope** to "Column", "Row", or other option as appropriate for your table.
2. Right-click the table's header row (if applicable) and select **Row properties**: - Change the **Row type** to "Header".
These steps will add attributes to your `<th>` elements that look like this example:
```
<th scope="col">First Name</th><th scope="col">Last Name</th><th scope="col">Phone Number</th>
```

---

### Tags

## Overview
Content Tags are keywords or terms assigned to assets. In Cascade CMS, tags help describe content and allow it to be found through searching or indexing.
Tags can also be used in combination with Index Blocks or Query API to index content on your published website and create related content sections or category listings.
## Adding Tags to Content

When editing content, you can choose from existing site or system-wide tags, or create your own tags. To add tags to content:
1. Click **Edit**.
2. Scroll to the **Tags** field.
3. Select existing tags to apply to your content, or create new tags by typing your tag and selecting **Add...**
4. **Submit** your changes.
Tags created when editing content will become site tags (see below) and will be immediately available for all users in the same site.
## Site Tags
Site tags are available for all users creating and editing content within the same site. Site tags can be managed in the **Manage Site** area under **Tags**.
You can find assets using one or more tags by selecting them from the list and clicking **Find assets that match selected tags** ( * *).
To create a site tag:
1. Click **Manage Site** > **Tags**.
2. Enter a new tag value and click **Add Tag**.
3. Alternatively, create site tags by entering the new tag value in the **Tags** field when editing an asset.
To prevent tag duplication, you may not create a site tag with the same name as a system-wide tag and vice versa.
To delete a site tag:
1. Click Manage **Site** > **Tags**.
2. Select one or more tags from the list and click **Delete** ( * *).
If the tag you're attempting to delete is in use, you'll be prompted to review the number of assets using the tag and confirm your deletion.
## System-wide Tags
System-wide tags are available for all users creating and editing content in the system. System-wide tags can be managed in the **Administration** area under **System-wide Tags**.
You can find assets using one or more tags by selecting them from the list and clicking **Find assets that match selected tags** ( * *).
To create a system-wide tag:
1. Click **Administration** > **System-wide Tags**.
2. Enter a new tag value and click **Add Tag**.
To prevent tag duplication, you may not create a system-wide tag with the same name as a site tag and vice versa.
To delete a system-wide tag:
1. Click Manage **Administration** > **System-wide Tags**
2. Select one or more tags from the list and click **Delete** ( * *).
If the tag you're attempting to delete is in use, you'll be prompted to review the number of assets using the tag and confirm your deletion.
**Note** - If you move or copy an asset to a different site, all system-wide tags will remain assigned but any site tags that don't also exist in the new site will be dropped.

---

### Tasks

## Overview
Tasks allow content managers and contributors to create and organize their to-do lists in Cascade CMS. Tasks can be associated with all Site Content area assets including pages, files, blocks, and formats.
You can access your task list by clicking your **User icon/name** > **Tasks**. In the tasks menu, you'll find the following tasks lists:
- **Assigned to Me** - Tasks assigned to you.
- **Created by Me** - Tasks you've created, including those you're not assigned to.
- **Participating Only** - Tasks you're participating in, but didn't create and aren't assigned to.
- **Completed** - Tasks you've completed.
To view all tasks associated with an asset, click **More** > **Tasks** while viewing the asset. In the asset tasks menu, you'll find the following lists:
- **Tasks Assigned to Me** - Tasks associated with the asset and assigned to you.
- **All Active Tasks** - All tasks associated with the asset regardless of assignee.
## Creating a Task
You can create new tasks from several areas within Cascade CMS:
- From the Tasks menu by clicking **New Task**.
- From your My Upcoming Tasks dashboard widget by clicking **Add Task**.
- From the My Content menu by clicking **Add Task**.
- From the associated asset itself by clicking **More** > **Tasks** > **Add Task**.
1. In the Create a Task menu, enter to following: - **Name** - The name of the task. - **Description** - A short, text-only description or instructions for the task. - **Assigned User** - You can delegate the task to another user or click "Choose Myself" to assign the task to yourself. - **Priority** - Tasks can be labeled Low, Normal, or High priority for task list sorting purposes. - **Due Date** - The date by which the task should be completed. - **Related Asset** - The asset associated with the task.
2. Click **Create**.
## Adding Task Participants
By default, task participants include the user who created the task and the user assigned to the task. You can add additional participants to the task:
- By @mentioning the user(s) in a task comment.
- Manually, under Participants by clicking **Choose Users**.
New task participants will receive a notification that they've been included on the task.
**Note** - Users who are participating in a task can view it, comment on it, and resolve it. They cannot edit or delete it.
## Changing the Status of a Task
Tasks can be resolved/reopened by any participant when it is considered completed or needs to be re-opened. To resolve/reopen a task, participants can do one of the following:
- View the task and click **Resolve**/**Reopen**
- Right-click on a link for the task and click **Resolve/Reopen** in the context menu
- View the assigned tasks tab in My Content, or the Tasks screen, and select the desired task row(s). Click the **Resolve/Reopen** button at the top of the table.
Task participants will receive a notification when the status of a task is changed.

---

### The Dashboard

## Overview
The Cascade CMS dashboard is a bird's eye view of your action items, notifications, and site content. You can add or customize widgets to reflect data from one or more of your sites.

To view the dashboard:
1. Log in to Cascade CMS with your username and password. - Please note that usernames are case sensitive. - If your organization uses custom authentication, your login screen may look different.
2. By default, the dashboard includes the following widgets: - **Welcome** - You can add widgets or reset your dashboard from the Welcome widget. If you have unread notifications, you can click the badge on the date in this widget to view them. - **My Sites** - Sites you've recently visited will be listed here. Click any of them to switch into the site, or use the **Site** dropdown menu to view all sites you have access to. - **My Upcoming Tasks** - Tasks assigned to you will be listed here in order of their due date. - **New Content** - Create new assets right from the dashboard by clicking on any of the Asset Factories in this widget. - **My Content** - Quickly access your starred and recently-viewed assets, owned content, and drafts and working copies from this widget. - **My Workflows** - If you or a Group you're assigned to has waiting workflows, you'll find them here. - **Stale Content** - Keep your content fresh by monitoring stale assets that haven't been updated in a while. - **Notifications** - Your most recent notifications such as workflow notifications, publish reports, and user mentions will be listed here. - **Content to Review** - Assets with upcoming review dates will be listed here. - **Link Checker** - If a broken link check is scheduled for your site(s), the number of broken links and assets with broken links found will be displayed here.
## Customizing Your Dashboard
If you have a Default Site chosen in your account settings, newly-added widgets will be pre-configured to display data and content from that site.
**Tip** - Set a **Default Site** in your account settings and then click **Reset Dashboard** in the Welcome widget to quickly configure all default widgets to display data from that site.
To customize a widget:
1. Hover over the widget and click the pencil icon ( * *) in the upper-right corner.
2. Configure your widget and click **Save Settings**.
To move or reorder widgets on the dashboard:
1. Hover over the widget and click and hold the menu bar ( * *) in the upper-left corner.
2. Drag the widget to its new position on the dashboard.
To add widgets to your dashboard:
1. Click the **Add Widget** button in the Welcome widget.
2. Click the plus sign ( * *) next to the widget you'd like to add.
3. Note that you can have multiple widgets of the same type on your dashboard configured to reflect data from different sites.
To remove widgets from your dashboard:
1. Hover over the widget and click the **X** icon in the upper-right corner.
2. Confirm that you'd like to remove the widget from your dashboard.
To reset you dashboard to the default widget configuration:
1. Click the **Reset Dashboard** button in the Welcome widget.
2. If you have a **Default Site** set in your account settings, all reset widgets will display data from that site.
To switch into a Site:
1. Select a site from the **My Sites** widget or from the **Site** flyout menu in the upper-left corner of the top menu bar.
2. Site content will be displayed in the asset tree on the left.
3. The site's **Trash** bin is located directly above the asset tree.

---

### The driver could not establish a secure connection to SQL Server by using Secure Sockets Layer (SSL) encryption

When attempting to start Cascade CMS, organizations using SQL Server may be presented with the following error in the log files (which prevents the application from starting):
```
("encrypt" property is set to "true" and "trustServerCertificate" property is set to "false" but the driver could not establish a secure connection to SQL Server by using Secure Sockets Layer (SSL) encryption: Error: PKIX path building failed: sun.security.provider.certpath.SunCertPathBuilderException: unable to find valid certification path to requested target.
```
This error is due to a change in Microsoft's JDBC driver (10.2+) where the default value for the `encrypt` property is `true`. For organizations not connecting to the database over SSL, steps to resolve this are as follows:
- Stop Cascade CMS.
- Edit `tomcat/conf/context.xml`.
- Add `encrypt=false` to your existing connection string and save the file. For example:
```
url="jdbc:sqlserver://yourDatabaseServer.com:1433;databaseName=yourDB;SelectMethod=cursor;encrypt=false;"
```
- Start Cascade CMS.
**Note**: The steps above should only be used for organizations that explicitly wish to connect to the database without SSL. As a best practice, your organization should configure SQL Server to force encryption in which case the above steps would no longer be relevant (as the CMS would attempt to connect securely over SSL by default).

---

### Trash

## Overview
The **Trash** area allows you to view, restore, or empty all deleted assets in your Cascade CMS Site. Navigate to the Trash by clicking the   icon at the top of the **Site Content** menu.
**Notes:
**- Assets in the Trash may be scheduled for permanent deletion from the system via the **Remove items from Trash** after setting under **Manage Site > Site Settings**.
- The default setting for new Sites is **15 days**.
- Once items are removed from Trash there is no way to recover them after that point in time. 
## Related Links
- How do I restore something I deleted from the trash / recycle bin?

---

### Unsupported or unrecognized SSL message

The following error may appear when publishing to a web server via FTPS:
```
Could not connect to FTPS server (host:21) : Unsupported or unrecognized SSL message
```
This error occurs when the FTPS Transport is configured to connect to a target server using explicit FTPS over port `21`. Cascade CMS currently supports *implicit* FTPS only, so the steps to correct this are as follows:
- Configure the target FTPS server to allow implicit connections (typically over port `990`)
- Adjust the corresponding FTPS Transport in Cascade CMS to connect using port `990`

## Related Links
- Transports

---

### Upgrading Tomcat independently of Cascade CMS

## Before you start
- Verify that you are attempting to upgrade to the same minor version of the Tomcat release that we support. As an example, if the Cascade CMS installer comes bundled with **Tomcat 9.0.33**, you will have the ability to upgrade to **Tomcat 9.0.45** but ***not*** to **Tomcat 9.5** (if it becomes available) or **Tomcat 10.x**.
- To find out the current version of Tomcat that Cascade CMS is using in your environment, go to **Administration** > **Logs and System Information** > **Server Information**.
- If you are unsure whether or not a particular version of Tomcat is supported, please reach out to support [at] hannonhill.com for more information.
## Steps to upgrade Tomcat
**Note**: The steps below are specific to Linux/*nix installations, but similar steps may be used for other operating systems as well.
1. Stop Cascade CMS.
2. Make a copy of your existing *tomcat* directory and keep it somewhere safe (and outside of the Cascade CMS installation directory). You'll need this to copy and/or reference certain files for the new Tomcat installation. It can also be used to quickly restore the application if the new version of Tomcat fails.
3. Delete the existing *tomcat* folder from within the Cascade CMS installation.
4. Download the newer version of Tomcat (core [zip]) from [https://tomcat.apache.org](https://tomcat.apache.org) and place it where the existing *tomcat* folder was located in the Cascade CMS installation directory.
5. Extract the contents of the zip file. This will produce a folder ``*apache-tomcat-9.0.45*, for example.
6. Rename the extracted folder from ``*apache-tomcat-9.0.45* to *tomcat*.
7. Using the backup of your old *tomcat* directory, copy the following files from the *conf* folder into the new ``*tomcat/conf* folder: - *context.xml* - *server.xml* - *ehcache.properties* - *web.xml*````
8. Add execute permissions to the new Tomcat scripts (in *tomcat/bin*). Example: ``` $ cd /usr/local/cascade/tomcat/bin$ find . -name "*.sh" -exec chmod u+x {} \; ```
9. ``Using the backup of your old tomcat directory, copy the ``*tomcat/webapps/ROOT* folder into the new ``*tomcat/webapps* directory.
10. Start Cascade CMS.

---

### Using Apache 2.4 to proxy Cascade CMS

## Overview
This article is provided as an example of using Apache 2.4 to to proxy Cascade CMS. It is for informational purposes only, and Hannon Hill Product Support cannot provide Apache configuration support or assistance.
## Apache 2.4 modules used
- ` mod_authz_core`
- `mod_deflate`
- `mod_filter`
- `mod_rewrite`
- `mod_proxy`
- `mpd_proxy_ajp`
- `mod_proxy_wstunnel`
- `mod_ssl`
## Base Configuration
**Apache 2.4**
Apache 2.4 can be used to proxy requests to the Cascade CMS Tomcat container. The benefit being additional control over request handling and simplified SSL handling. Here is a sample configuration that forces connections over SSL using `mod_proxy`, handles SSL using `mod_ssl`, proxies requests to the Tomcat container using `mod_proxy` and `mod_proxy_ajp` and adds compression using `mod_deflate`:
```
Listen 0.0.0.0:443SSLStrictSNIVHostCheck off<VirtualHost *:80> ServerName cascade.example.edu RewriteEngine on RewriteRule ^(.*)$ https:/cascade.example.edu$1 [R=301,L]</VirtualHost><VirtualHost *:443> ServerName cascade.example.edu SSLEngine on SSLProtocol all -SSLv2 -SSLv3 SSLCipherSuite HIGH:!aNULL:!MD5 SSLCertificateFile /path/to/cert.crt SSLCertificateKeyFile /path/to/key.key SSLCertificateChainFile /path/to/intermediate.xrt> ProxyIOBufferSize 65536 # Websocket configuration ProxyPass /websocket ws://localhost:8080/websocket ProxyPassReverse /websocket ws://localhost:8080/websocket ProxyPass / ajp://localhost:8009/ ProxyPassReverse / ajp://localhost:8009/ AddOutputFilterByType DEFLATE "application/javascript" \ "application/json" \ "application/rss+xml" \ "application/vnd.ms-fontobject" \ "application/font-sfnt" \ "application/font-woff" \ "font/opentype" \ "font/woff2" \ "application/x-javascript" \ "application/xhtml+xml" \ "application/xml" \ "font/eot" \ "font/opentype" \ "image/svg+xml" \ "image/vnd.microsoft.icon" \ "image/x-icon" \ "text/css" \ "text/html" \ "text/javascript" \ "text/plain" \ "text/xml"</VirtualHost>
```
**Tomcat**
Given the apove Apache 2.4 configuration, the following Connectors are assumed within the Tomcat container's ``*server.xml* configuration:
```
<Connector port="8080" maxThreads="256" maxPostSize="6000000" protocol="HTTP/1.1" connectionTimeout="20000" redirectPort="8443" maxSwallowSize="-1" compression="on" compressionMinSize="1024" noCompressionUserAgents="gozilla, traviata" compressableMimeType="application/javascript,application/json,application/rss+xml,application/vnd.ms-fontobject,application/font-sfnt,application/font-woff,font/opentype,font/woff2,application/x-javascript,application/xhtml+xml,application/xml,font/eot,font/opentype,image/svg+xml,image/vnd.microsoft.icon,image/x-icon,text/css,text/html,text/javascript,text/plain,text/xml" /> <Connector port="8009" protocol="AJP/1.3" redirectPort="8443" tomcatAuthentication="true" packetSize="65536" maxPostSize="6000000" />
```
**Note**: The *server.xml* configuration file is located within the Cascade CMS installation directory at ``*tomcat/conf*.
## Websocket Support
Cascade CMS utilizes Websockets for almost-real-time notifications and partial UI refreshing, as opposed to repeatedly polling with AJAX requests. As such, the `mod_proxy_wstunnel` module and additional configuration are required in order to allow Apache to handle these websocket requests. Note the following section within the above configuration:
```
# Websocket configurationProxyPass /websocket ws://localhost:8080/websocketProxyPassReverse /websocket ws://localhost:8080/websocket
```
The key is the port within this directive needs to match the non-SSL port defined within the Tomcat container. Don't worry about this not being SSL here, normal web requests are forced over SSL and Cascade CMS will automatically change the websocket request over to `wss://`, which is the secure protocol for websockets.

---

### Which algorithms are supported for SFTP?

When publishing to an SFTP server, Cascade CMS supports the following algorithms:
**KEX algorithms:**
- `curve25519-sha256`
- `curve25519-sha256@libssh.org`
- `diffie-hellman-group16-sha512`
- `diffie-hellman-group18-sha512`
- `diffie-hellman-group14-sha256`
- `ext-info-c`
- `kex-strict-c-v00@openssh.com`
- `diffie-hellman-group-exchange-sha1`*
- `diffie-hellman-group1-sha1`*
- `diffie-hellman-group14-sha1`*
- `diffie-hellman-group-exchange-sha256`*
- `ecdh-sha2-nistp256`*
- `ecdh-sha2-nistp384`*
- `ecdh-sha2-nistp521`*
**Host key algorithms:**
- `ssh-ed25519`
- `rsa-sha2-512`
- `rsa-sha2-256`
- `ssh-rsa*`*
- `ssh-dss*`*
- `ecdsa-sha2-nistp256`*
- `ecdsa-sha2-nistp384`*
- `ecdsa-sha2-nistp521`*
**Ciphers:**
- `aes128-gcm@openssh.com`
- `aes256-gcm@openssh.com`
- *``*`blowfish-cbc`*
- `3des-cbc`*
- `aes128-cbc`*
- `aes192-cbc`*
- `aes256-cbc`*
- `3des-ctr`*
- `aes128-ctr`*
- `aes192-ctr`*
- `aes256-ctc`*
- `arcfour`*
- `arcfour128`*
- `arcfour256`*
**MACs:**
- `hmac-sha2-256-etm@openssh.com`
- `hmac-sha2-512-etm@openssh.com`
- `hmac-sha1-etm@openssh.com`
- `hmac-sha2-256`
- `hmac-sha2-512`
- `hmac-sha1`
- `hmac-md5`*
- `hmac-md5-96`*
- `hmac-sha1`*
- `hmac-sha1-96`*
**Note**: Items denoted with an asterisk (*) above are considered older/insecure algorithms and should only be used for backwards compatibility purposes. Wherever possible, we recommend disabling these on the target web server and instead utilizing the more secure algorithms.
## Related Links
- Transports

---

### Why aren't my CSS background images being displayed?

CSS background images require special tags that let the system know you are referring to an image that is managed by Cascade CMS. Consider the following lines in a CSS file:
```
.content{ background-image: url('/images/photo.png');}
```
To link to this image from the CSS file within Cascade, the following steps must to be taken:
Click **Edit** on the CSS file containing the reference to the background imageAdd [system-asset

---

### WordPress Connector

## Creating a WordPress Connector
To create a WordPress Connector:
1. Navigate to **Manage Site** > **Connectors**.
2. Navigate to the container in which the new Connector will be stored, or create a new container using **Add** > **Container**.
3. Click **Add** > **Connector**.
4. Select **WordPress** and then click **Choose**.
5. In the **Name** field, enter the name for your Connector.
6. In the **Parent Container** field, select a container for your Connector, if desired.
7. In the **Setting** tab, configure the following fields: - **URL** - Enter the URL to the WordPress environment. - **Username / Password** - Enter the username and password that you use to login into the WordPress environment selected above. If either field changes in WordPress, the Connector will need to be updated and re-verified.**
8. In the **Content Types** tab, configure the following fields: - **Content Type** - Select a Content Type to associate with the Connector.When selected, the page Output, Metadata mapping for categories, and Metadata mapping for tags fields will be auto-populated using information associated with the selected Content Type. - Due to the way Cascade publishes content to WordPress, multiple WordPress Connectors within a site cannot use the same Content Type and output combination.
9. **Output** - Select an output to use when publishing to the Connector.
10. **Metadata mapping for categories** - Dropdown menu of all available metadata fields associated with the Content Type to use for WordPress categories. - The values in the metadata fields are used to associate the WordPress post to a category. - Multiple categories can be assigned using a comma-separated list in plain-text fields, or radio button and multi-select dropdown dynamic metadata fields. - Start Date, End Date, Expiration Folder, Review Date and any hidden metadata fields do not appear in the metadata field dropdown.
11. **Metadata mapping for tags** - Same as metadata mapping for categories, but to associate the metadata values to WordPress tags on a post.
12. Click **Submit**.
## Verifying/Unverifying a WordPress Connector
To verify or unverify your WordPress connector:
1. While viewing (but not editing) your Connector, click **Verify**.
2. A message will be displayed indicating whether or not the Connector has been verified using the URL, username, and password specified. If unsuccessful, an appropriate error message will be displayed.
3. Once verified, the **Unverify** link is available to deactivate the Connector.
## Publishing Using a WordPress Connector
The rendered content in the default region of the output selected in your Connector's Content Type is the content that is synchronized with WordPress.
You can publish any of the following to sync your page with WordPress:
- The page itself.
- The parent folder of the page.
- The page's site via Manage Site.
- A Destination in the current site.
- A Publish Set containing the page.
When publishing only to WordPress, it's not necessary to select any Destinations in order for content to be synchronized. Connectors existing in the current site that are enabled will be listed on the publish screen and will be automatically processed when publishing.
Note, however, that only Connectors which are deemed applicable to assets included in the publish will be used during the publish. When publishing only with Connectors, assets that don't apply to any of the enabled Connectors will show up in the corresponding publish report under the Skipped Jobs section.
To publish an asset to both WordPress and a Destination, choose the Destinations to publish to on the publish screen.

---

### Working with Server Side Includes

It is possible to publish snippets of HTML which can be pulled in via Server Side Includes (SSI) at runtime on your live web server. This method of including content can be useful for components like navigation menus, footers, and/or any other areas of your site that are commonly used across your site.
One drawback of a push CMS (like Cascade CMS) is that if the contents of a navigation menu change, for example, a full site publish is needed in order to ensure that all of the pages on your site get their navigation menu updated accordingly. By utilizing SSI for these areas of your site(s), you can publish a single asset and have all pages on your site load the most up-to-date navigation menu almost instantaneously. 
The steps below will walk you through a very basic setup that allows you to create/publish a snippet of HTML and then pull that into your pages on the live website through a SSI directive.
## Set up a Page type for "include" files
- Create a new Template with the following code:
```
<!--#cascade-skip--><pass-through> <system-region name="DEFAULT"/></pass-through>
```
- Create a new Configuration with the following settings:Check the **Default Output** box
- Set the **Type of Data** field to HTML
- Set the **File Extension** field to `.shtml`
- In the **Template** field, select the Template that you created in the very first step
- Ensure that the **Publishable** check box is checked
Create a new Content Type with the following settings:
- In the **Configuration** field, select the Configuration you created in the step above
- In the **Metadata Set** field, select a Metadata Set (the Default will typically be fine in this case)
- In the ** Type of Content** field, select **No Data Definition (WYSIWYG Only)**
At this point, we can create a Page asset using this Content Type and supply the HTML snippet we're looking to publish to the web server, and then reference the include file we've created using an SSI directive. To do this, follow the steps outlined in the next section below.
## Create a new "include" Page
- From the **Add Content** menu, click to create a new XML Block
- In the content field of the Block, enter the following code and Submit:
```
<!--#protect-top<ul> <li>Sample item 1</li> <li>Sample item 2</li> <li>Sample item 3</li></ul>#protect-top-->
```
- Click the **Add Content** menu once again and click to create a new Default -> Page
- When prompted to select a Content Type for the Page, select the Content Type that you created in the previous section
- Give the Page a name of `include-file` and then click the **Configure** tab
- Scroll down to the **Regions** section and in the `DEFAULT` region, click the Block chooser and select the XML Block that you created above
- Submit the Page
- Publish the Page to your web server and verify that you can reach it by using the **More -> Live** option (you should see a mostly empty page with just our unordered list from earlier)
At this point, we have a Page asset that just contains our short HTML snippet (an unordered list containing 3 list items) and we can now pull it into other pages using an SSI directive.
## Add the SSI to your page(s)
- From the **Add Content** menu, click to create a new XML Block
- In the content field of the Block, enter the following code and Submit:
[

---
