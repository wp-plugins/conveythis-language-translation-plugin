<?php
/*
Plugin Name: ConveyThis Language Translation Plugin
Plugin URI: http://www.conveythis.com
Description: Allows your users to translate your blog into many different languages. The button is added to the bottom of every post.
Author: ConveyThis.com
Version: 2.3
Author URI: http://www.conveythis.com
*/
/*  Copyright 2008  ConveyThis.com  (email : mike@conveythis.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
class ConveyThisWidget {
	//==========================================
	// If your page is not written in
	// English, replace your language below.
	// The possible language list is:
	/*	
		"Arabic"
		"Brazilian Portuguese"
		"Bulgarian"
		"Catalan"
		"Chinese"
		"Chinese-simp"
		"Chinese-trad"
		"Croatian"
		"Czech"
		"Danish"
		"Dutch"
		"English"
		"Filipino"
		"Finnish"
		"French"
		"German"
		"Greek"
		"Hebrew"
		"Hindi"
		"Hungarian"
		"Icelandic"
		"Indonesian"
		"Italian"
		"Japanese"
		"Korean"
		"Latvian"
		"Lithuanian"
		"Norwegian"
		"Polish"
		"Portuguese"
		"Romanian"
		"Russian"
		"Serbian"
		"Slovak"
		"Slovenian"
		"Spanish"
		"Swedish"
		"Ukranian"
		"Welsh"
		"Vietnamese"
	*/
	// i.e. if your page is written in Spanish,
	// then the line:
	// var $conveythis_source = 'English';
	// Should be changed to:
	// var $conveythis_source = 'Spanish';
	
	var $conveythis_source = 'English';
	//==========================================
	
	// Constructor
	function ConveyThisWidget(){
		add_filter('the_content', array(&$this, 'codeToContent'));
	}
	
	function codeToContent($content){  
		// Add nothing to RSS feed.
		if (is_feed()) return $content;
		// Add nothing to categories.
		if (is_category()) return $content;
		// Get the link.
		$link  = urlencode(get_permalink());
		return $content.$this->getConveyThisCode($link);
	}
	
	// Get the actual button code.
	function getConveyThisCode($link) {
		$convey_code = '<script type="text/javascript">';
		$convey_code .=	'convey_source   = "'.$this->conveythis_source.'";';
		$convey_code .=	'</script>';
		$convey_code .=	'<a href="http://www.translation-services-usa.com/" id="conveythis_image" title="translation services" onmouseover="conveythis_show(this)" onmouseout="conveythis_start_timer()" onclick="return conveythis_prepWindow(this)" ><img src="http://no-stats.conveythis.com/kern_e2/images/translate1.gif" style="border-style: none;" /></a>';
		$convey_code .=	'<script type="text/javascript" src="http://no-stats.conveythis.com/kern_e2/javascript/e2_1.js"></script>';        
        return $convey_code;
	}
	
	function ConveyThisWidget_doposts($content){  
		for ($i=0; $i<10; $i++){
			$content .= $this->ConveyThisWidget_post($i);
		}
		return $content;
	}
	
	function ConveyThisWidget_post($entry){
		$link  = urlencode(get_permalink());
		if (!isset($link)){
			$widget_post  = $this->getConveyThisCode($link);
			$widget_post .= $this->ConveyThisWidget_postit($entry);
		}
		return $widget_post;
	}
	
	function ConveyThisWidget_postit($i){
		add_filter('the_content', array(&$this, 'codeToContent'));
		$content = $this->codeToContent($content);
		
		$cut = explode("|", $content);
		$post = $cut[0];
		$link  = $cut[1]; 
		return content . "<br />$link";
	}
}

$convey_this &= new ConveyThisWidget();
?>