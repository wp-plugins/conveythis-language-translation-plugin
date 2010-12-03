<?php
/*
Plugin Name: ConveyThis Language Translation Plugin
Plugin URI: http://www.conveythis.com/
Description: Allows your users to translate your blog into many different languages. The button is added to the bottom of every post.
Author: ConveyThis.com
Version: 2.5
Author URI: http://www.conveythis.com/
*/
/*  Copyright 2010  ConveyThis.com  (email : alex.buran@gmail.com)

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
	// You must use the language CODE of your 
	// website, not the full language name.
	// For a full list of usable languages and 
	// codes, please visit: 
	// http://code.google.com/apis/language/translate/v1/reference.html#LangNameArray
	// e.g. if your page is written in Spanish,
	// then the line:
	// var $conveythis_source = 'en';
	// Should be changed to:
	// var $conveythis_source = 'es';
	
	var $conveythis_source = 'en';
	//==========================================
	
	// Constructor
	function ConveyThisWidget(){
		add_filter('the_content', array(&$this, 'codeToContent'));
	}
	
	function codeToContent($content){  
		// Add nothing to RSS feed.
		if (is_feed()) {
			return $content;
		}
		
		// Add nothing to categories.
		if (is_category()) {
			return $content;
		}
		
		// Add the link to the content.
		$link  = urlencode(get_permalink());
		return $content.$this->getConveyThisCode($link);
	}
	
	// Get the actual button code.
	function getConveyThisCode($link) {
		$convey_code	= 	sprintf('<script type="text/javascript">');
		$convey_code	.=	sprintf('var conveythis_src = "%s";', $this->conveythis_source);
		$convey_code	.=	sprintf('</script>');
		$convey_code	.=	sprintf('<div class="conveythis"><a class="conveythis_drop" title="translation" href="http://www.translation-services-usa.com/"><span class="conveythis_button_1">translation</span></a></div>');
		$convey_code	.=	sprintf('<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>');
		$convey_code	.=	sprintf('<script type="text/javascript" src="http://s1.conveythis.com/e2/_v_3/javascript/e3.js"></script>');
		
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