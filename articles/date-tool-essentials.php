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
                                    <span class="badge badge-danger"
                                        >Velocity Tools</span
                                    >
                                </div>
                                <header>
                                    <h1>Date tool essentials</h1>
                                </header>
                                <a name="Date+tool+essentials"></a>

                                <section
                                    aria-label="Overview"
                                    class="anchor-heading"
                                    id="DateToolOverview">
                                    <h2>
                                        Overview
                                        <a
                                            aria-label="Skip to Overview"
                                            href="#DateToolOverview"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <p>
                                        The Date Tool lets you retrieve, parse,
                                        format, and compare date/time values in
                                        Velocity. It is especially useful when
                                        you are working with Unix timestamps in
                                        milliseconds (such as Index Block XML
                                        values), normalizing mixed time zones
                                        from feeds, or formatting
                                        human-readable dates for display.
                                    </p>
                                    <ul>
                                        <li>
                                            Convert Unix timestamps in
                                            milliseconds to Java Dates.
                                        </li>
                                        <li>
                                            Parse formatted strings into Dates
                                            with <code>toDate()</code>.
                                        </li>
                                        <li>
                                            Format Dates for display with
                                            <code>format()</code>.
                                        </li>
                                        <li>
                                            Compare two dates using
                                            <code>difference()</code>.
                                        </li>
                                    </ul>
                                </section>

                                <section
                                    aria-label="getDate vs toDate"
                                    class="anchor-heading"
                                    id="GetDateVsToDate">
                                    <h2>
                                        getDate vs toDate
                                        <a
                                            aria-label="Skip to getDate vs toDate"
                                            href="#GetDateVsToDate"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <p>
                                        Use <code>.getDate()</code> when you
                                        already have a Unix timestamp in
                                        milliseconds (for example, from system
                                        fields like
                                        <code>last-published-on</code>) and need
                                        a Java Date for formatting or
                                        comparison.
                                    </p>
                                    <p>
                                        If your input is a human-readable date
                                        string (like <code>03-21-2024</code>),
                                        use <code>.toDate()</code> instead.
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity">$_DateTool.getDate()

#set ($pubDate = $currentPage.lastPublishedOn)
$_DateTool.getDate($pubDate)</code></pre>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity">#set ($dateString = "03-21-2024")
#set ($date = $_DateTool.toDate("MM-dd-yyyy", $dateString))
$_DateTool.format("MMMM d, yyyy", $date)</code></pre>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity">## Shorthand numeric format
#set ($shipDateString = "2024-07-05")
#set ($shipDate = $_DateTool.toDate("yyyy-MM-dd", $shipDateString))
$_DateTool.format("MMM d, yyyy", $shipDate)</code></pre>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity">## Specific timestamp format with time
#set ($stamp = "2024-07-05 14:30:00")
#set ($stampDate = $_DateTool.toDate("yyyy-MM-dd HH:mm:ss", $stamp))
$_DateTool.format("EEEE, MMM d 'at' h:mma", $stampDate)</code></pre>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity">## Unix milliseconds to display
#set ($ms = 1719878400000)
#set ($launchDate = $_DateTool.getDate($ms))
$_DateTool.format("yyyyMMdd", $launchDate)</code></pre>
                                    <table>
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
                                                    <code
                                                        >$_DateTool.getDate</code
                                                    >
                                                </td>
                                                <td>
                                                    Unix timestamp in
                                                    milliseconds
                                                </td>
                                                <td>
                                                    Convert a numeric timestamp
                                                    to a Date for formatting or
                                                    comparison.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <code
                                                        >$_DateTool.toDate</code
                                                    >
                                                </td>
                                                <td>
                                                    Formatted date string +
                                                    pattern
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
                                        <code>getDate()</code> expects
                                        milliseconds. If you pass seconds, your
                                        date will land near 1970.
                                    </p>
                                </section>

                                <section
                                    aria-label="getCalendar basics"
                                    class="anchor-heading"
                                    id="GetCalendarBasics">
                                    <h2>
                                        getCalendar basics
                                        <a
                                            aria-label="Skip to getCalendar basics"
                                            href="#GetCalendarBasics"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <p>
                                        <code>getCalendar()</code> returns a
                                        Java <code>Calendar</code>. Use it when
                                        you need parts of a date (month, day,
                                        weekday) or you need to add/subtract
                                        time in a precise way.
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity">#set ($cal = $_DateTool.getCalendar())
$cal.get($cal.YEAR)
## Example output: 2024
$cal.get($cal.MONTH) ## zero-based
## Example output: 6
$cal.get($cal.DAY_OF_MONTH)
## Example output: 5</code></pre>
                                    <p>
                                        You can also set the calendar to a
                                        specific date and add time:
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity">#set ($cal = $_DateTool.getCalendar())
$cal.setTime($_DateTool.getDate($pubDate))
$cal.add($cal.DATE, 7) ## add 7 days
$_DateTool.format("MMMM d, yyyy", $cal.getTime())
## Example output: July 12, 2024</code></pre>
                                </section>

                                <section
                                    aria-label="Using difference"
                                    class="anchor-heading"
                                    id="DifferenceUsage">
                                    <h2>
                                        Using difference
                                        <a
                                            aria-label="Skip to Using difference"
                                            href="#DifferenceUsage"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <p>
                                        <code>difference()</code> returns a
                                        Comparison object. When you print it, it
                                        renders a human-readable value (like
                                        <code>-2 weeks</code>), which is handy
                                        for relative-time labels.
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity"><span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$published</span> <span class="token operator">=</span> <span class="token variable">$currentPage</span><span class="token punctuation">.</span>lastPublishedOn<span class="token punctuation">)</span></span>
<span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$now</span> <span class="token operator">=</span> <span class="token query global">$_.date</span><span class="token punctuation">.</span>current<span class="token punctuation">()</span><span class="token punctuation">)</span></span>
<span class="token directive"><span class="token keyword">#set</span> <span class="token punctuation">(</span><span class="token variable">$compare</span> <span class="token operator">=</span> <span class="token variable">$now</span><span class="token punctuation">.</span>difference<span class="token punctuation">(</span><span class="token variable">$published</span><span class="token punctuation">)</span><span class="token punctuation">)</span></span>
$_DateTool.format("MMMM d, yyyy", $_DateTool.getDate($published)) ## Jul 5, 2024
$compare                                                            ## -1 week</code></pre>
                                    <p>
                                        Multiply <code>difference()</code> calls
                                        for more complex labels. For example,
                                        you can show a countdown until a launch
                                        date, then flip the label to "launched"
                                        when the target date passes:
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity">#set ($launchDate = $_DateTool.toDate("yyyy-MM-dd", "2024-08-01"))
#set ($days = $_DateTool.difference($launchDate, $_DateTool.getDate()))

#if ($days.getDays() &gt; 0)
    ## Future launch
    #set ($label = $days + " away")
#else
    ## Already launched
    #set ($label = "Launched " + $days.abs() + " ago")
#end</code></pre>
                                </section>

                                <section
                                    aria-label="whenIs basics"
                                    class="anchor-heading"
                                    id="WhenIsBasics">
                                    <h2>
                                        whenIs basics
                                        <a
                                            aria-label="Skip to whenIs basics"
                                            href="#WhenIsBasics"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <p>
                                        <code>whenIs()</code> helps you answer
                                        relative questions like "When is three
                                        weeks from today?" or "When is next
                                        Monday?".
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity">#set ($today = $_DateTool.getDate())
#set ($inThreeWeeks = $_DateTool.whenIs($today, 3, "week"))

$_DateTool.format("MMMM d, yyyy", $inThreeWeeks)
## Example output: July 26, 2024</code></pre>
                                </section>

                                <section
                                    aria-label="Formatting output"
                                    class="anchor-heading"
                                    id="FormattingOutput">
                                    <h2>
                                        Formatting output
                                        <a
                                            aria-label="Skip to Formatting output"
                                            href="#FormattingOutput"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <p>
                                        Keep your output consistent by reusing a
                                        small set of format strings. Popular
                                        options include:
                                    </p>
                                    <ul>
                                        <li><code>MMMM d, yyyy</code></li>
                                        <li><code>MMM d, yyyy</code></li>
                                        <li><code>yyyy-MM-dd</code></li>
                                        <li><code>yyyyMMdd</code></li>
                                        <li>
                                            <code
                                                >EEEE, MMMM d, yyyy 'at'
                                                h:mma</code
                                            >
                                        </li>
                                        <li>
                                            <code
                                                >yyyy-MM-dd'T'HH:mm:ssXXX</code
                                            >
                                            (ISO 8601 with offset)
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
                                    <p>
                                        Common symbols:
                                    </p>
                                    <table>
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
                                                    y=2024<br />
                                                    yy=24<br />
                                                    yyyy=2024
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><code>M</code></td>
                                                <td>Month (1-12)</td>
                                                <td>
                                                    M=8<br />
                                                    MM=08<br />
                                                    MMM=Aug<br />
                                                    MMMM=August
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><code>d</code></td>
                                                <td>Day of month</td>
                                                <td>
                                                    d=5<br />
                                                    dd=05
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><code>E</code></td>
                                                <td>Day name</td>
                                                <td>
                                                    E=Wed<br />
                                                    EEE=Wed<br />
                                                    EEEE=Wednesday
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><code>H</code></td>
                                                <td>Hour 0-23</td>
                                                <td>
                                                    H=9<br />
                                                    HH=09
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><code>h</code></td>
                                                <td>Hour 1-12</td>
                                                <td>
                                                    h=9<br />
                                                    hh=09
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><code>m</code></td>
                                                <td>Minute</td>
                                                <td>
                                                    m=3<br />
                                                    mm=03
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><code>s</code></td>
                                                <td>Second</td>
                                                <td>
                                                    s=7<br />
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
                                                    z=EDT<br />
                                                    zzzz=Eastern Daylight Time
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><code>X</code></td>
                                                <td>ISO 8601 offset</td>
                                                <td>
                                                    X=-5<br />
                                                    XX=-0500<br />
                                                    XXX=-05:00
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><code>w</code></td>
                                                <td>Week of year</td>
                                                <td>
                                                    w=34<br />
                                                    ww=34
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>
                                        Practical examples using the same
                                        timestamp:
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity">#set ($stamp = "2024-08-21 13:45:00")
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
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity">#set ($stamp = "2024-07-05 14:30:00")
#set ($tz = $_DateTool.getTimeZone("America/New_York"))
#set ($dateTime = $_DateTool.toDate("yyyy-MM-dd HH:mm:ss", $stamp))

$_DateTool.format("MMMM d, yyyy 'at' h:mma z", $dateTime, $tz)
## Example output: July 5, 2024 at 2:30PM EDT</code></pre>
                                    <p>
                                        When dates span multiple regions, keep
                                        the same format strings and swap in the
                                        appropriate time zone for each item—see
                                        Handling time zones below for a durable
                                        pattern.
                                    </p>
                                </section>

                                <section
                                    aria-label="Handling time zones"
                                    class="anchor-heading"
                                    id="HandlingTimeZones">
                                    <h2>
                                        Handling time zones
                                        <a
                                            aria-label="Skip to Handling time zones"
                                            href="#HandlingTimeZones"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <p>
                                        Feeds frequently mix timestamps and
                                        time zone strings (for example,
                                        <code>2024-08-21 13:00:00</code> with
                                        <code>America/Chicago</code>). If you
                                        format those dates with your server's
                                        default time zone, event times can
                                        appear hours off. Velocity can normalize
                                        each feed item by parsing the timestamp
                                        and explicitly applying the feed's time
                                        zone before rendering. Cloud
                                        environments can pass a zone string
                                        directly to
                                        <code>$_DateTool.getTimeZone()</code>,
                                        but some on-premises versions block
                                        nested calls like
                                        <code>$_DateTool.getTimeZone().getTimeZone()</code>.
                                        Use a reflection fallback to stay
                                        compatible.
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity">## feed fields: $event.start (yyyy-MM-dd HH:mm:ss), $event.timezone (e.g., America/Chicago)
#set ($tzClass = $_DateTool.getTimeZone().getClass().forName("java.util.TimeZone"))
#set ($targetTz = $tzClass.getMethod("getTimeZone", $tzClass.forName("java.lang.String")).invoke(null, $event.timezone))

#set ($parser = $_DateTool.getDateFormat("yyyy-MM-dd HH:mm:ss", $_DateTool.getLocale(), $_DateTool.getTimeZone()))
#set ($start = $parser.parse($event.start))

$_DateTool.format("MMM d, yyyy h:mma z", $start, $_DateTool.getLocale(), $targetTz)
## Example output: Aug 21, 2019 1:00PM CDT</code></pre>
                                    <p>
                                        Need to verify time zone strings? Call
                                        <code>getAvailableIDs</code> through the
                                        same class reference:
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity">#set ($allIds = $tzClass.getMethod("getAvailableIDs", null).invoke(null, null))
$_ListTool.toList($allIds)</code></pre>
                                    <p>
                                        Once you normalize each event's time
                                        zone, reuse the formats from the
                                        previous section to keep output
                                        consistent for every audience.
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
                                        Use the Query API's sort options where
                                        possible. If you need to sort in-memory,
                                        convert date strings into
                                        <code>Date</code> objects and then sort.
                                    </p>
                                    <pre
                                        tabindex="0"
                                        style="overflow: auto"
                                        class="language-velocity"><button class="btn-copy" aria-label="Copy code" data-original-html="&lt;i class=&quot;fa-regular fa-copy&quot;&gt;&lt;/i&gt;" style="width: 34px;"><i class="fa-regular fa-copy"></i></button><code class="language-velocity">#set ($events = $_.query()
    .byContentType("event")
    .preloadStructuredData()
    .sortBy("metadata.startDateTime") ## or your field
    .descending(false)
    .execute())</code></pre>
                                </section>

                                <section
                                    aria-label="Date tool tips"
                                    class="anchor-heading"
                                    id="DateToolTips">
                                    <h2>
                                        Date tool tips
                                        <a
                                            aria-label="Skip to Date tool tips"
                                            href="#DateToolTips"
                                            ><i
                                                class="fas fa-link icon-anchor-link"></i
                                        ></a>
                                    </h2>
                                    <ul>
                                        <li>
                                            Store dates in ISO
                                            (<code>yyyy-MM-dd</code> or
                                            <code>yyyy-MM-dd HH:mm:ss</code>)
                                            whenever possible.
                                        </li>
                                        <li>
                                            Pass time zones explicitly when
                                            formatting for audiences in a single
                                            region.
                                        </li>
                                        <li>
                                            Normalize user-entered dates to a
                                            consistent format before storing.
                                        </li>
                                        <li>
                                            Use <code>difference()</code> for
                                            relative labels like "3 days ago" or
                                            "in 2 weeks."
                                        </li>
                                        <li>
                                            Cache or preload when looping large
                                            result sets to avoid repeated round
                                            trips.
                                        </li>
                                        <li>
                                            Keep a short library of trusted
                                            format strings and reuse them across
                                            templates for consistency.
                                        </li>
                                        <li>
                                            When ingesting feeds, parse dates
                                            with the supplied time zone, then
                                            format with the audience's time zone
                                            to avoid "off by hours" displays.
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
