<?php
/*
Plugin Name: ConveyThis
Plugin URI: http://www.conveythis.com
Description: Help your users translate your blog. Adds a button to the bottom of every post.
Author: ConveyThis.com
Version: 1.0
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
	// Want stats with your ConveyThis plugin? 
	// Replace 'wordpress' with your ConveyThis
	// username.
	
	// i.e. if your name is testing, the line
	// should read:
	// var $conveythis_username = 'testing';
	
	// Also, if your page is not written in
	// English, replace your language below.
	// The possible language list is:
	/*  "Arabic"
		"Brazilian Portuguese"
		"Bulgarian"
		"Chinese"
		"Chinese-simp"
		"Chinese-trad"
		"Croatian"
		"Czech"
		"Danish"
		"Dutch"
		"English"
		"Finnish"
		"French"
		"German"
		"Greek"
		"Hindi"
		"Hungarian"
		"Icelandic"
		"Italian"
		"Japanese"
		"Korean"
		"Norwegian"
		"Polish"
		"Portuguese"
		"Romanian"
		"Russian"
		"Serbian"
		"Slovenian"
		"Spanish"
		"Swedish"
		"Welsh"
	*/
	// i.e. if your page is written in Spanish,
	// then the line:
	// var $conveythis_source = 'English';
	// Should be changed to:
	// var $conveythis_source = 'Spanish';
	
	var $conveythis_username = 'wordpress';
	var $conveythis_source = 'English';
	//==========================================
	
	// Constructor
	function ConveyThisWidget(){
		add_filter('the_content', array(&$this, 'codeToContent'));
	}
	
	function codeToContent($content){  
		$link  = urlencode(get_permalink());
		// alert the link here, to test.
		return $content.$this->getConveyThisCode($link);
	}
	
	// Get the actual button code
	function getConveyThisCode($link) {
		$convey_code = '<script type="text/javascript">';
		$convey_code .=	'convey_url      = "'.$link.'";';
		$convey_code .=	'convey_source   = "'.$this->conveythis_source.'";';
		$convey_code .=	'convey_user     = "'.$this->conveythis_username.'";';
		$convey_code .=	'convey_type     = 1;';
		$convey_code .=	'</script>';
		$convey_code .=	'<a href="http://www.conveythis.com/" title="free translation" onmouseover="javacript:conveythis_show(this); conveythis_stop_timer();" onmouseout="javascript:conveythis_start_timer();" onclick="javascript:conveythis_prepWindow(this); return false;" >';
		$convey_code .=	'<script type="text/javascript" src="http://www.conveythis.com/javascript/conveythis_v2-1.js"></script>';
		$convey_code .=	'</a>';
        
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