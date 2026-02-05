<?php
$pageTitle =
    "Date tool essentials - Cascade CMS Knowledge Base";
$canonical =
    "https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/script-formats/date-tool-essentials.html";
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
                        <li aria-current="page">Date tool essentials</li>
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
                                            href="date-tool-essentials.php"
                                            >Date tool essentials</a
                                        >
                                        <ul>
                                            <li>
                                                <a
                                                    aria-label="Skip to Overview"
                                                    href="#DateToolOverview"
                                                    >Overview</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    aria-label="Skip to getDate vs toDate"
                                                    href="#GetDateVsToDate"
                                                    >getDate vs toDate</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    aria-label="Skip to getCalendar basics"
                                                    href="#GetCalendarBasics"
                                                    >getCalendar basics</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    aria-label="Skip to Using difference"
                                                    href="#DifferenceUsage"
                                                    >Using difference</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    aria-label="Skip to whenIs basics"
                                                    href="#WhenIsBasics"
                                                    >whenIs basics</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    aria-label="Skip to Formatting output"
                                                    href="#FormattingOutput"
                                                    >Formatting output</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    aria-label="Skip to Handling time zones"
                                                    href="#HandlingTimeZones"
                                                    >Handling time zones</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    aria-label="Skip to Sorting by date"
                                                    href="#SortingByDate"
                                                    >Sorting by date</a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    aria-label="Skip to Date tool tips"
                                                    href="#DateToolTips"
                                                    >Date tool tips</a
                                                >
                                            </li>
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
                                <h1>Date Tool Essentials</h1>
                            </header>
                            <a name="Date+Tool+Essentials"></a>

                            <section
                                aria-label="Overview"
                                class="anchor-heading"
                                id="Overview">
                                <h2>
                                    Overview
                                    <a
                                        aria-label="Skip to Overview"
                                        href="#Overview"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>
                                <p>
                                    The Date Tool lets you retrieve, parse,
                                    format, and compare date/time values in
                                    Velocity. It is especially useful when you
                                    are working with Unix timestamps in
                                    milliseconds (such as Index Block XML
                                    values), normalizing mixed time zones from
                                    feeds, or formatting human-readable dates
                                    for display.
                                </p>
                                <ul>
                                    <li>
                                        Convert Unix timestamps in milliseconds
                                        to Java Dates.
                                    </li>
                                    <li>
                                        Parse formatted strings into Dates
                                        with&#160;<code>toDate()</code>.
                                    </li>
                                    <li>
                                        Format Dates for display
                                        with&#160;<code>format()</code>.
                                    </li>
                                    <li>
                                        Compare two dates
                                        using&#160;<code>difference()</code>.
                                    </li>
                                </ul>
                            </section>

                            <section
                                aria-label=".getDate() vs .toDate()"
                                class="anchor-heading"
                                id="_getDatevs_toDate">
                                <h2>
                                    .getDate() vs .toDate()
                                    <a
                                        aria-label="Skip to .getDate() vs .toDate()"
                                        href="#_getDatevs_toDate"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>
                                <p>
                                    Use <code>.getDate()</code> when you already
                                    have a Unix timestamp in milliseconds (for
                                    example, from metadata like
                                    <code>$currentPage.metadata.startDate) and need a Java Date for formatting or
                                    comparison. If you omit the argument,
                                    getDate()</code> returns the current
                                    moment.
                                </p>
                                <p>
                                    If your input is a human-readable date
                                    string (like <code>03-21-2024</code>), use
                                    <code>.toDate()</code> instead. The pattern
                                    you pass must match the string exactly; if
                                    it does not, you will get
                                    <code>null</code> rather than a parsed date.
                                </p>
                                <p>
                                    A quick rule: numeric Unix timestamps go to
                                    <code>getDate()</code>, formatted strings go
                                    to <code>toDate()</code>. Keep your patterns
                                    consistent so your parsing and display stay
                                    in sync.
                                </p>
                                <p>
                                    These two are easy to mix up:
                                    <code>getDate()</code> expects (or defaults
                                    to) a numeric timestamp and hands you back a
                                    Date object, while
                                    <code>toDate()</code> converts a string
                                    <em>to</em> a Date object by matching the
                                    syntax in the string with your pattern.
                                </p>

                                <table class="table table-bordered table-hover">
                                    <caption>
                                        Quick compare: getDate vs toDate.
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">Method</th>
                                            <th scope="col">Input</th>
                                            <th scope="col">When to use</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <code>$_DateTool.getDate()</code>
                                            </td>
                                            <td>
                                                Unix timestamp in milliseconds
                                            </td>
                                            <td>
                                                Convert a numeric timestamp to a
                                                Date for formatting or
                                                comparison.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <code>$_DateTool.toDate()</code>
                                            </td>
                                            <td>
                                                Formatted date string + pattern
                                            </td>
                                            <td>
                                                Parse a human-readable date
                                                string into a Date.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <p>
                                    <strong>Pitfall</strong> -
                                    <code>getDate()</code> expects milliseconds.
                                    If you pass seconds, your date will land
                                    near 1970.
                                </p>

                                <h3 id="GetDateExamples">getDate examples</h3>
                                <p>
                                    Many <code>$currentPage</code> properties already return Date objects,
                                    so you can format them directly without conversion:
                                </p>
                                <pre><code>## These already return Date objects - no conversion needed
$currentPage.lastPublishedOn    ## Date of last publish
$currentPage.createdOn          ## Date asset was created
$currentPage.lastModified       ## Date of last modification

## Get the current date/time
$_DateTool.getDate()</code></pre>
                                <p>
                                    Format these dates directly:
                                </p>
                                <pre><code>## Format the last published date for a byline
Published $_DateTool.format("MMM d, yyyy", $currentPage.lastPublishedOn)
## Output: Published Jan 15, 2026

## Format creation date
Created $_DateTool.format("MMMM d, yyyy", $currentPage.createdOn)
## Output: Created January 10, 2026</code></pre>

                                <h3 id="ToDateExamples">toDate examples</h3>
                                <p>
                                    Use <code>toDate()</code> when you have a date as a string
                                    and need to parse it into a Date object:
                                </p>
                                <pre><code>## Parse a date string - pattern must match the input format exactly
#set ($dateString = "03-21-2024")
#set ($date = $_DateTool.toDate("MM-dd-yyyy", $dateString))
$_DateTool.format("MMMM d, yyyy", $date)
## Output: March 21, 2024</code></pre>
                                <pre><code>## ISO-style date format (common in feeds and APIs)
#set ($shipDateString = "2024-07-05")
#set ($shipDate = $_DateTool.toDate("yyyy-MM-dd", $shipDateString))
$_DateTool.format("MMM d, yyyy", $shipDate)
## Output: Jul 5, 2024</code></pre>
                                <pre><code>## Date with time - useful for event timestamps
#set ($stamp = "2024-07-05 14:30:00")
#set ($stampDate = $_DateTool.toDate("yyyy-MM-dd HH:mm:ss", $stamp))
$_DateTool.format("EEEE, MMM d 'at' h:mma", $stampDate)
## Output: Friday, Jul 5 at 2:30PM</code></pre>

                                <h3 id="RealWorldScenarios">Real-world scenarios</h3>
                                <p>
                                    Event listing with metadata dates:
                                </p>
                                <pre><code>## Display event start date from page metadata
#set ($startMillis = $currentPage.metadata.startDate)
#if ($startMillis && $startMillis > 0)
  #set ($eventDate = $_DateTool.getDate($startMillis))
  &lt;time datetime="$_DateTool.format('yyyy-MM-dd', $eventDate)"&gt;
    $_DateTool.format("MMMM d, yyyy", $eventDate)
  &lt;/time&gt;
#end</code></pre>
                                <p>
                                    News article with published date:
                                </p>
                                <pre><code>## Format last published date for byline
#set ($pubDate = $_DateTool.getDate($currentPage.lastPublishedOn))
Published $_DateTool.format("MMM d, yyyy", $pubDate)</code></pre>

                                <h3 id="IndexBlockPatterns">Working with Index Blocks</h3>
                                <p>
                                    Processing dates from Index Block XML:
                                </p>
                                <pre><code>## Index Block provides timestamps in milliseconds
#foreach ($page in $_XPathTool.selectNodes($contentRoot, "//system-page"))
  #set ($lastMod = $_XPathTool.selectSingleNode($page, "last-modified-on"))
  #set ($lastModDate = $_DateTool.getDate($lastMod.value))

  &lt;li&gt;
    $_XPathTool.selectSingleNode($page, "title").value
    - Updated $_DateTool.format("M/d/yy", $lastModDate)
  &lt;/li&gt;
#end</code></pre>
                                <p>
                                    Filtering Index Block results by date:
                                </p>
                                <pre><code>## Show only items modified in the last 30 days
#set ($now = $_DateTool.getDate())
#foreach ($page in $_XPathTool.selectNodes($contentRoot, "//system-page"))
  #set ($lastModMillis = $_XPathTool.selectSingleNode($page, "last-modified-on").value)
  #set ($lastModDate = $_DateTool.getDate($lastModMillis))
  #set ($diff = $_DateTool.difference($lastModDate, $now))

  #if ($diff.days &lt;= 30)
    ## Display this item
  #end
#end</code></pre>

                                <h3 id="EdgeCases">Handling edge cases</h3>
                                <p>
                                    Null-safe date handling:
                                </p>
                                <pre><code>## Always check for null before formatting
#set ($startMillis = $currentPage.metadata.startDate)
#if ($startMillis && $startMillis > 0)
  #set ($startDate = $_DateTool.getDate($startMillis))
  $_DateTool.format("MMMM d, yyyy", $startDate)
#else
  Date not set
#end</code></pre>
                                <p>
                                    Pattern mismatch returns null:
                                </p>
                                <pre><code>## toDate returns null if pattern doesn't match input
#set ($input = "March 15, 2024")
#set ($wrongPattern = $_DateTool.toDate("MM-dd-yyyy", $input))  ## null
#set ($rightPattern = $_DateTool.toDate("MMMM d, yyyy", $input)) ## works

#if (!$rightPattern)
  Could not parse date
#end</code></pre>
                                <p>
                                    Empty string handling:
                                </p>
                                <pre><code>## Empty strings also return null
#set ($emptyDate = "")
#set ($parsed = $_DateTool.toDate("yyyy-MM-dd", $emptyDate))

#if (!$parsed)
  No date provided
#end</code></pre>
                            </section>

                            <section
                                aria-label="Using difference()"
                                class="anchor-heading"
                                id="Usingdifference">
                                <h2>
                                    Using difference()
                                    <a
                                        aria-label="Skip to Using difference()"
                                        href="#Usingdifference"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>
                                <p>
                                    <code>difference()</code> returns a
                                    <strong>Comparison</strong> object that
                                    describes the distance between two
                                    dates. When printed, it renders a
                                    human-readable value (like
                                    <code>5 months</code>), and it also
                                    includes structured fields like
                                    <code>days</code>, <code>months</code>,
                                    <code>relative</code>, and
                                    <code>full</code>.
                                </p>
                                <h3 id="DifferenceBasic">
                                    Basic example: distance between two dates
                                </h3>
                                <p>
                                    Use
                                    <code>difference(dateA, dateB)</code>
                                    when you want the distance between two
                                    dates. This is best for countdowns,
                                    "time since" labels, or
                                    comparisons used in logic.
                                </p>
                                <pre><code>## Get today's date
#set ($today = $_DateTool.getDate())

## Parse a target date - pattern must match the input format
#set ($manualDate = "07-04-26")
#set ($targetDate = $_DateTool.toDate("MM-dd-yy", $manualDate))

## Compare today to the target date
#set ($difference = $_DateTool.difference($today, $targetDate))

$today       ## Wed Jan 14 14:36:28 EST 2026
$targetDate  ## Sat Jul 04 00:00:00 EDT 2026
$difference  ## 5 months</code></pre>
                                <h3 id="DifferenceUsefulFields">
                                    Useful fields on the Comparison object
                                </h3>
                                <p>
                                    The returned object is more than just a
                                    string. These are the fields
                                    you'll actually use in templates
                                    and UI labels:
                                </p>
                                <pre><code>$difference.abbr         ## 5 mos
$difference.difference    ## 5 months
$difference.relative      ## 5 months later
$difference.full          ## 5 months 2 weeks 6 days 8 hours 23 minutes ...

$difference.days          ## 170
$difference.weeks         ## 24
$difference.months        ## 5
$difference.years         ## 0</code></pre>
                                <h3 id="DifferenceBranchingLabel">
                                    Branching UI label: "Still coming up" vs "Happened"
                                </h3>
                                <p>
                                    For simple branching logic,
                                    <code>days</code> is the easiest field
                                    to work with. Just be consistent about
                                    argument order. In the example below, a
                                    positive number means the target date is
                                    in the future (relative to today).
                                </p>
                                <pre><code>#set ($today = $_DateTool.getDate())
#set ($manualDate = "07-04-26")
#set ($targetDate = $_DateTool.toDate("MM-dd-yy", $manualDate))
#set ($difference = $_DateTool.difference($today, $targetDate))

#if ($difference.days &gt;= 0)
  Still coming up (in $difference.abbr)
#else
  Happened ($difference.abbr ago)
#end</code></pre>
                                <p>
                                    Tip: For "ago" labels, you
                                    can also use
                                    <code>$difference.abs()</code> if you
                                    want a cleaner positive duration
                                    (example: <code>5 months</code> instead
                                    of <code>-5 months</code>).
                                </p>
                            </section>

                            <section
                                aria-label="whenIs() basics"
                                class="anchor-heading"
                                id="whenIsbasics">
                                <h2>
                                    whenIs() basics
                                    <a
                                        aria-label="Skip to whenIs() basics"
                                        href="#whenIsbasics"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>
                                <p>
                                    <code>whenIs()</code> answers the more human
                                    question: &#8220;When is A relative to
                                    B?&#8221; It also returns a
                                    <strong>Comparison</strong> object, but the
                                    output is naturally directional (<code
                                        >earlier
                                    / later</code>), which is great for
                                    client-facing labels.
                                </p>
                                <h3 id="WhenIsNow">
                                    No-arg usage: &#8220;now&#8221;
                                </h3>
                                <pre><code>## today is January 13, 2026 in this example
#set ($today = $_DateTool.getDate())

#set ($whenIs = $_DateTool.whenIs($today))
$whenIs
## now</code></pre>
                                <h3 id="WhenIsCompareTwoDates">
                                    Comparing two dates (both directions)
                                </h3>
                                <p>
                                    Argument order matters. Swapping them flips
                                    <code>earlier</code> vs <code>later</code>.
                                </p>
                                <pre><code>#set ($today = $_DateTool.getDate())

#set ($manualDate = "July 4, 2026")
#set ($targetDate = $_DateTool.toDate("MMMM dd, yyyy", $manualDate))

$targetDate
## Sat Jul 04 00:00:00 EDT 2026

## Target compared to today
#set ($whenIsA = $_DateTool.whenIs($targetDate, $today))
$whenIsA
## 5 months earlier

## Today compared to target
#set ($whenIsB = $_DateTool.whenIs($today, $targetDate))
$whenIsB
## 5 months later</code></pre>
                                <h3 id="WhenIsUsefulFields">
                                    Useful fields (same Comparison object)
                                </h3>
                                <p>
                                    Same object structure as
                                    <code>difference()</code>, but the human
                                    strings are usually what you want to show
                                    clients (<code>relative</code>,
                                    <code>abbr</code>, <code>full</code>).
                                </p>
                                <pre><code>$whenIsB.abbr        ## 5 mos later
$whenIsB.relative     ## 5 months later
$whenIsB.difference   ## 5 months
$whenIsB.full         ## 5 months 3 weeks 7 hours ... later

$whenIsB.days         ## 171
$whenIsB.months       ## 5
$whenIsB.years        ## 0

$whenIsB.class        ## class org.apache.velocity.tools.generic.ComparisonDateTool$Comparison</code></pre>
                                <h3 id="WhenIsBranchingLabel">
                                    Branching UI label: &#8220;didn&#8217;t
                                    happen yet&#8221; vs &#8220;you missed
                                    it&#8221;
                                </h3>
                                <p>
                                    This is a clean pattern for client-friendly
                                    messaging. Just decide what
                                    &#8220;positive&#8221; means for your
                                    argument order and stick to it.
                                </p>
                                <pre><code>#set ($today = $_DateTool.getDate())
#set ($manualDate = "July 4, 2026")
#set ($targetDate = $_DateTool.toDate("MMMM dd, yyyy", $manualDate))

## "today relative to target"
#set ($whenIs = $_DateTool.whenIs($today, $targetDate))

#if ($whenIs.days &gt; 0)
  Didn't happen yet ($whenIs.abbr)
#else
  You missed it ($whenIs.abbr)
#end</code></pre>
                            </section>

                            <section
                                aria-label="getCalendar basics"
                                class="anchor-heading"
                                id="getCalendarbasics">
                                <h2>
                                    getCalendar basics
                                    <a
                                        aria-label="Skip to getCalendar basics"
                                        href="#getCalendarbasics"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>
                                <p>
                                    <code>getCalendar()</code> returns a Java
                                    <code>Calendar</code> object representing
                                    the current date and time in Cascade&#8217;s
                                    configured time zone. Use it when you need
                                    to read specific parts of &#8220;now&#8221;
                                    (year, month, day, weekday, hour) as numeric
                                    values for logic.
                                </p>
                                <pre><code>#set ($cal = $_DateTool.getCalendar())

## Calendar field IDs (numbers) are used by:
## $cal.get(fieldId)

$cal.get(1)  ## YEAR
## Example output: 2026

$cal.get(2)  ## MONTH (zero-based: January = 0)
## Example output: 0

$cal.get(5)  ## DAY_OF_MONTH
## Example output: 15

$cal.get(7)  ## DAY_OF_WEEK (Sunday = 1 ... Saturday = 7)
## Example output: 5

$cal.get(11) ## HOUR_OF_DAY (0&#8211;23)
## Example output: 15</code></pre>
                                <p>
                                    These numeric field IDs are standard Java
                                    Calendar constants. You&#8217;ll typically
                                    only need a small subset of them when
                                    working with <code>getCalendar()</code>.
                                </p>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Field ID</th>
                                            <th>Meaning</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>1</code></td>
                                            <td>YEAR</td>
                                            <td>4-digit year</td>
                                        </tr>
                                        <tr>
                                            <td><code>2</code></td>
                                            <td>MONTH</td>
                                            <td>
                                                Zero-based: January =
                                                <code>0</code>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>5</code></td>
                                            <td>DAY_OF_MONTH</td>
                                            <td>1&#8211;31</td>
                                        </tr>
                                        <tr>
                                            <td><code>6</code></td>
                                            <td>DAY_OF_YEAR</td>
                                            <td>1&#8211;365/366</td>
                                        </tr>
                                        <tr>
                                            <td><code>7</code></td>
                                            <td>DAY_OF_WEEK</td>
                                            <td>
                                                Sunday = <code>1</code>,
                                                Saturday = <code>7</code>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>9</code></td>
                                            <td>AM_PM</td>
                                            <td>
                                                <code>0</code> = AM,
                                                <code>1</code> = PM
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>11</code></td>
                                            <td>HOUR_OF_DAY</td>
                                            <td>24-hour clock (0&#8211;23)</td>
                                        </tr>
                                        <tr>
                                            <td><code>12</code></td>
                                            <td>MINUTE</td>
                                            <td>0&#8211;59</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p>
                                    <strong>Important:</strong>
                                    <code>getCalendar()</code> is best treated
                                    as a read-only helper in Cascade. For date
                                    math or comparisons, use
                                    <code>difference()</code> or
                                    <code>whenIs()</code>. For formatting, use
                                    <code>format()</code>.
                                </p>
                            </section>

                            <section
                                aria-label="Formatting output"
                                class="anchor-heading"
                                id="Formattingoutput">
                                <h2>
                                    Formatting output
                                    <a
                                        aria-label="Skip to Formatting output"
                                        href="#Formattingoutput"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>
                                <p>
                                    Keep your output consistent by reusing a
                                    small set of format strings. Popular options
                                    include:
                                </p>
                                <ul>
                                    <li><code>MMMM d, yyyy</code></li>
                                    <li><code>MMM d, yyyy</code></li>
                                    <li><code>yyyy-MM-dd</code></li>
                                    <li><code>yyyyMMdd</code></li>
                                    <li>
                                        <code
                                            >EEEE, MMMM d, yyyy 'at'
                                            h:mma&lt;/code &gt;
                                        </code>
                                    </li>
                                    <li>
                                        <code
                                            >yyyy-MM-dd'T'HH:mm:ssXXX&lt;/code
                                            &gt; (ISO 8601 with offset)
                                        </code>
                                    </li>
                                    <li>
                                        <code>HH:mm</code> (24-hour) and
                                        <code>h:mma</code> (12-hour)
                                    </li>
                                    <li>
                                        <code>'Week' w, yyyy</code> (week
                                        number)
                                    </li>
                                </ul>
                                <p>Common symbols:</p>
                                <table class="table table-bordered table-hover">
                                    <caption>
                                        Common date format symbols
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">Symbol</th>
                                            <th scope="col">Meaning</th>
                                            <th scope="col">
                                                Variations / examples
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>y</code></td>
                                            <td>Year</td>
                                            <td>
                                                y=2024 <br />
                                                yy=24 <br />
                                                yyyy=2024
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>M</code></td>
                                            <td>Month (1-12)</td>
                                            <td>
                                                M=8 <br />
                                                MM=08 <br />
                                                MMM=Aug <br />
                                                MMMM=August
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>d</code></td>
                                            <td>Day of month</td>
                                            <td>
                                                d=5 <br />
                                                dd=05
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>E</code></td>
                                            <td>Day name</td>
                                            <td>
                                                E=Wed <br />
                                                EEE=Wed <br />
                                                EEEE=Wednesday
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>H</code></td>
                                            <td>Hour 0-23</td>
                                            <td>
                                                H=9 <br />
                                                HH=09
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>h</code></td>
                                            <td>Hour 1-12</td>
                                            <td>
                                                h=9 <br />
                                                hh=09
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>m</code></td>
                                            <td>Minute</td>
                                            <td>
                                                m=3 <br />
                                                mm=03
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>s</code></td>
                                            <td>Second</td>
                                            <td>
                                                s=7 <br />
                                                ss=07
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>a</code></td>
                                            <td>AM/PM marker</td>
                                            <td>a=AM</td>
                                        </tr>
                                        <tr>
                                            <td><code>z</code></td>
                                            <td>Time zone abbreviation</td>
                                            <td>
                                                z=EDT <br />
                                                zzzz=Eastern Daylight Time
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>X</code></td>
                                            <td>ISO 8601 offset</td>
                                            <td>
                                                X=-5 <br />
                                                XX=-0500 <br />
                                                XXX=-05:00
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>w</code></td>
                                            <td>Week of year</td>
                                            <td>
                                                w=34 <br />
                                                ww=34
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p>
                                    Practical examples using the same timestamp:
                                </p>
                                <pre><code>#set ($stamp = "2024-08-21 13:45:00")
#set ($date = $_DateTool.toDate("yyyy-MM-dd HH:mm:ss", $stamp))

$_DateTool.format("MMMM d, yyyy", $date)
## August 21, 2024

$_DateTool.format("EEE, MMM d 'at' h:mma", $date)
## Wed, Aug 21 at 1:45PM

$_DateTool.format("yyyy-MM-dd'T'HH:mm:ssXXX", $date, $_DateTool.getTimeZone("America/Chicago"))
## 2024-08-21T13:45:00-05:00

$_DateTool.format("'Week' w, yyyy", $date)
## Week 34, 2024</code></pre>
                                <p>
                                    If you need time zones, pass a
                                    <code>TimeZone</code> into
                                    <code>format()</code>:
                                </p>
                                <pre><code>#set ($stamp = "2024-07-05 14:30:00")
#set ($tz = $_DateTool.getTimeZone("America/New_York"))
#set ($dateTime = $_DateTool.toDate("yyyy-MM-dd HH:mm:ss", $stamp))

$_DateTool.format("MMMM d, yyyy 'at' h:mma z", $dateTime, $tz)
## Example output: July 5, 2024 at 2:30PM EDT</code></pre>
                                <p>
                                    When dates span multiple regions, keep the
                                    same format strings and swap in the
                                    appropriate time zone for each
                                    item&#8212;see Handling time zones below for
                                    a durable pattern.
                                </p>
                            </section>

                            <section
                                aria-label="Handling time zones"
                                class="anchor-heading"
                                id="Handlingtimezones">
                                <h2>
                                    Handling time zones
                                    <a
                                        aria-label="Skip to Handling time zones"
                                        href="#Handlingtimezones"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>
                                <p>
                                    Feeds frequently include timestamps paired with
                                    separate time zone identifiers (for example,
                                    <code>2024-08-21 13:00:00</code> with
                                    <code>America/Chicago</code>). If you format
                                    those dates using your server's default time
                                    zone, event times can appear hours off. To
                                    display the correct local time, you need to
                                    explicitly apply each event's time zone when
                                    formatting.
                                </p>

                                <h3 id="CloudApproach">Cloud approach (simple)</h3>
                                <p>
                                    In Cascade Cloud, you can pass a time zone
                                    string directly to
                                    <code>$_DateTool.getTimeZone().getTimeZone()</code>:
                                </p>
                                <pre><code>#set ($startDate = $currentPage.createdOn)

## Default server time zone
$_DateTool.format('EE MMM dd HH:mm:ss z yyyy', $startDate)
## Output: Wed Aug 21 14:08:26 EDT 2019

## Converted to UTC
$_DateTool.format('EE MMM dd HH:mm:ss z yyyy', $startDate, $_DateTool.getLocale(), $_DateTool.getTimeZone().getTimeZone("UTC"))
## Output: Wed Aug 21 18:08:26 UTC 2019

## Converted to Pacific time
$_DateTool.format('EE MMM dd HH:mm:ss z yyyy', $startDate, $_DateTool.getLocale(), $_DateTool.getTimeZone().getTimeZone("America/Los_Angeles"))
## Output: Wed Aug 21 11:08:26 PDT 2019</code></pre>

                                <h3 id="OnPremLimitation">On-premises limitation</h3>
                                <p>
                                    Some on-premises Cascade instances block the
                                    nested <code>.getTimeZone()</code> call due to
                                    Java security restrictions. If you see this error:
                                </p>
                                <pre><code>VelocityException: ASTMethod.execute() : exception invoking method 'getTimeZone' in class sun.util.calendar.ZoneInfo</code></pre>
                                <p>
                                    You can verify whether your instance has this
                                    restriction by testing these two calls:
                                </p>
                                <pre><code>## This works on all instances - returns a ZoneInfo object
$_DateTool.getTimeZone()

## This fails on some on-prem instances
$_DateTool.getTimeZone().getTimeZone("UTC")</code></pre>
                                <p>
                                    If the second call fails, use the reflection
                                    workaround below.
                                </p>

                                <h3 id="ReflectionWorkaround">On-premises workaround (reflection)</h3>
                                <p>
                                    This approach uses Java reflection to access
                                    the <code>TimeZone</code> class directly. It
                                    works on both Cloud and on-premises instances:
                                </p>
                                <pre><code>## Get the TimeZone class via reflection
#set ($tzClass = $_DateTool.getTimeZone().getClass().forName("java.util.TimeZone"))

## Create a TimeZone object for UTC
#set ($utcTz = $tzClass.getMethod("getTimeZone", $tzClass.forName("java.lang.String")).invoke(null, "UTC"))

## Format a date in UTC
$_DateTool.format('EE MMM dd HH:mm:ss z yyyy', $currentPage.createdOn, $_DateTool.getLocale(), $utcTz)
## Output: Wed Aug 21 18:08:26 UTC 2019</code></pre>

                                <h3 id="FeedExample">Processing feeds with mixed time zones</h3>
                                <p>
                                    When processing a JSON feed where each event
                                    has its own time zone, use the reflection
                                    approach with a dynamic zone value:
                                </p>
                                <pre><code>## Assume feed fields: $event.start (yyyy-MM-dd HH:mm:ss), $event.timezone (e.g., America/Chicago)

## Set up the TimeZone class reference once
#set ($tzClass = $_DateTool.getTimeZone().getClass().forName("java.util.TimeZone"))

#foreach ($event in $events)
  ## Get the TimeZone for this event
  #set ($eventTz = $tzClass.getMethod("getTimeZone", $tzClass.forName("java.lang.String")).invoke(null, $event.timezone))

  ## Parse the date string
  #set ($parser = $_DateTool.getDateFormat("yyyy-MM-dd HH:mm:ss", $_DateTool.getLocale(), $eventTz))
  #set ($startDate = $parser.parse($event.start))

  ## Format with the event's time zone
  $_DateTool.format("MMM d, yyyy 'at' h:mma z", $startDate, $_DateTool.getLocale(), $eventTz)
  ## Example output: Aug 21, 2024 at 1:00PM CDT
#end</code></pre>

                                <h3 id="ValidatingTimezones">Validating time zone IDs</h3>
                                <p>
                                    Time zone strings like <code>America/Chicago</code>
                                    or <code>America/New_York</code> must match Java's
                                    recognized identifiers. To see all valid IDs:
                                </p>
                                <pre><code>#set ($tzClass = $_DateTool.getTimeZone().getClass().forName("java.util.TimeZone"))
#set ($allIds = $tzClass.getMethod("getAvailableIDs", null).invoke(null, null))
$_ListTool.toList($allIds)</code></pre>
                                <p>
                                    This returns a list of all accepted time zone
                                    identifiers. As long as your feed's time zone
                                    values appear in this list, they will work with
                                    the examples above.
                                </p>
                            </section>

                            <section
                                aria-label="Sorting by date"
                                class="anchor-heading"
                                id="SortingByDate">
                                <h2>
                                    Sorting by date
                                    <a
                                        aria-label="Skip to Sorting by date"
                                        href="#SortingByDate"
                                        ><i
                                            class="fas fa-link icon-anchor-link"></i
                                    ></a>
                                </h2>
                                <p>
                                    Once you have dates, you'll often need to
                                    sort content chronologically. Cascade offers
                                    a few approaches depending on your data source.
                                </p>

                                <h3 id="IndexBlockSorting">Index Block sorting</h3>
                                <p>
                                    The simplest approach is to configure sorting
                                    directly in the Index Block asset. Under the
                                    block's settings, you can sort by system
                                    properties like <strong>Last Modified Date</strong>,
                                    <strong>Created Date</strong>, or
                                    <strong>Start Date</strong> (for pages with
                                    date metadata). This handles sorting before
                                    your Velocity code runs.
                                </p>

                                <h3 id="QueryToolSorting">Sorting with $_.query()</h3>
                                <p>
                                    The <code>$_.query()</code> tool lets you query
                                    assets directly in Velocity and sort the results
                                    by date fields. Use <code>sortBy()</code> to
                                    specify the field and <code>sortDirection()</code>
                                    for ascending or descending order.
                                </p>
                                <pre><code>## Query articles sorted by last modified date (newest first)
#set ($results = $_.query().byContentType("Article").sortBy("modified").sortDirection("desc").execute())

#foreach ($page in $results)
  $page.name - $_DateTool.format("MMM d, yyyy", $page.lastModified)
#end</code></pre>
                                <p>
                                    Available date fields for <code>sortBy()</code>:
                                    <code>created</code>, <code>modified</code>,
                                    <code>startDate</code>, <code>endDate</code>,
                                    and <code>reviewDate</code>.
                                </p>
                                <pre><code>## Sort events by start date (ascending)
#set ($events = $_.query().byContentType("Event").sortBy("startDate").sortDirection("asc").execute())</code></pre>

                                <h3 id="SortToolSorting">Sorting with $_SortTool</h3>
                                <p>
                                    When you need to sort a collection in Velocity,
                                    use <code>$_SortTool</code>. This is useful
                                    when working with structured data or when you
                                    need custom sort logic.
                                </p>
                                <pre><code>## Sort a list of pages by lastModified (ascending)
#set ($sorted = $_SortTool.sort($pages, "lastModified"))

## Sort descending (newest first)
#set ($sorted = $_SortTool.sort($pages, "lastModified:desc"))

## Sort by a metadata date field
#set ($sorted = $_SortTool.sort($pages, "metadata.startDate:desc"))</code></pre>

                                <h3 id="XPathSorting">Sorting with XPath</h3>
                                <p>
                                    When processing Index Block XML, you can sort
                                    nodes directly in your XPath expression using
                                    <code>sort-by</code>. Date fields from Index
                                    Blocks are Unix timestamps in milliseconds,
                                    which sort numerically.
                                </p>
                                <pre><code>## Sort pages by last-modified-on, newest first
#set ($pages = $_XPathTool.selectNodes(
  $contentRoot,
  "//system-page[sort-by(last-modified-on, 'number', 'descending')]"
))

#foreach ($page in $pages)
  #set ($lastMod = $_XPathTool.selectSingleNode($page, "last-modified-on").value)
  #set ($date = $_DateTool.getDate($lastMod))
  $_DateTool.format("MMM d, yyyy", $date)
#end</code></pre>
                                <p>
                                    For metadata date fields stored as timestamps,
                                    use the same numeric sort:
                                </p>
                                <pre><code>## Sort by a dynamic metadata date field (e.g., event start date)
#set ($events = $_XPathTool.selectNodes(
  $contentRoot,
  "//system-page[sort-by(dynamic-metadata[name='start-date']/value, 'number', 'ascending')]"
))</code></pre>
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
