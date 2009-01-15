=== ConveyThis Language Translation Plugin ===
Contributors: conveythis
Tags: conveythis, free, website, blog, translate, translation, translator
Tested up to: 2.6
Stable tag: 2.1

Allows your users to translate your blog into many different languages. The button is added to the bottom of every post.

== Description ==

A free translation button provided by [ConveyThis](http://www.conveythis.com/ "free translation") allowing visitors to translate 
your website into their native language. ConveyThis combines Google Translator, Live Translator, Babel Fish, and many other online 
translators into one small, easy to use button. Once installed, the button will appear at the bottom of every post on the main page, 
as well as at the bottom of the individual posts.

ConveyThis supports over 30 languages, and we will be adding more soon.

Please do not modify the code or link information, or the button may not display properly.

== Installation ==

1. Upload conveythis-language-translation-plugin to the /wp-content/plugins/ directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. If you have registered an account at [ConveyThis](http://www.conveythis.com/login.php "free translation"), you can enter your username to track 
statistics. To do this, open conveythis.php and change the line "var $conveythis_username = 'wordpress';" to include your username. ex. 
"var $conveythis_username = 'username_goes_here';"
1. Also, if your website is not in English, you must change the line "var $conveythis_source = 'English';" to the correct language. 
ex: for a Spanish page, change the line to "var $conveythis_username = 'Spanish';" Available languages include: 

* Arabic
* Brazilian Portuguese
* Bulgarian
* Chinese
* Chinese-simp
* Chinese-trad
* Croatian
* Czech
* Danish
* Dutch
* English
* Finnish
* French
* German
* Greek
* Hindi
* Hungarian
* Icelandic
* Italian
* Japanese
* Korean
* Norwegian
* Polish
* Portuguese
* Romanian
* Russian
* Serbian
* Slovenian
* Spanish
* Swedish
* Welsh

== Frequently Asked Questions ==

= When will you be adding support for new languages? =

Since the button only uses other popular online translators, we have no control of when new languages will be available. Once a translator 
does add a new language, we try to add support for that language as quickly as possible.

= A translator added a new language, and it's not available through ConveyThis. Why is that? =

When a translator adds a new language, it is not automatically available through ConveyThis. This is because we must make internal changes 
to our program telling it the language is available and how to handle it. Also, we need to add a flag image for that language. We make every 
effort to keep the translator's available language list as up to date as possible.

== Screenshots ==

1. The button on a sample post.
2. The open menu on a sample post.
3. A sample translation report.