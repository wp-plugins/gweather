=== Gweather ===
Contributors: mouring
Tags: rss, atom, feed, inline, embed, rdf, weather, google
Requires at least: 2.5
Tested up to: 2.9.1
Stable tag: 1.00

With the gweather plugin you can display and embed Google Weather Feeds in your Wordpress posts and pages.

== Description ==

With the gweather plugin you can display and embed Google Weather Feeds in your Wordpress posts and pages using the following shortcode:

`[gweather city="City" country="Country Shortcode" temp="C" credit="1"]`


FILTER USAGE

* Simple:
   
Just put a `[gweather city="city" country="country shortcode" temp="C" credit="1"]` in your post, and the weather will show up.

* NAMED PARAMETERS

For some customisation there are some options you can use.

- city : Which city would you like the weather for
- country : Your Country Shortcode (e.g. US for the United States, ZA for South Africa, NL for the Netherlands)
- temp: C for celcius or F for Fahrenheit
- credit: 1 if you want to show a credit link, 0 if you don't want to show a credit link (I hope you would like to show it)

Examples:

`[gweather city="Pretoria" country="ZA" temp="C" credit=0]` (weather in pretoria in Celcius with no credit link)

`[gweather city="London" country="UK" temp="F" credit="1"]` (weather in london in Fahrenheit with credit link)

Finally note the whole thing must be on ONE line.  No line breaks or else it won't work.

There is no styling in the table, but the table is generated with a class of gweather. So you can style the look of the output by adding a class for that in your stylesheet

1.00 Initial release.
1.10 Bug Fix Cities with spaces where not renedered properly
== Installation ==

Just unzip in your plugin folder, and actived in your wordpress admin panel.