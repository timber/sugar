<?php
/*
Plugin Name: Timber Sugar
Plugin URI: http://timber.upstatement.com
Description: Some bonus features to make templates fun again
Author: Jared Novack + Upstatement
Version: 0.0.1
Author URI: http://upstatement.com/
*/

	class TimberSugar {

		function __construct(){
			add_filter('get_twig', function($twig){
				$twig->addFilter('dummy', new Twig_Filter_Function(array($this, 'apply_dummy_filter')));
				$twig->addFunction(new Twig_SimpleFunction('dummy', array(&$this, 'apply_dummy')));
				
				$twig->addFilter('twitterify', new Twig_Filter_Function(array($this, 'twitterify')));
				$twig->addFilter('twitterfy', new Twig_Filter_Function(array($this, 'twitterify')));
				return $twig;
			});
		}

		function apply_dummy_filter($text, $words){
			if (!strlen(trim($text))){
				return self::apply_dummy($words);
			}
			return $text;
		}

		function apply_dummy($words){
			$text = file_get_contents(__DIR__.'/assets/lorem-ipsum.txt');
			$starting_position = rand(0, strlen($text));
			$leading_text = substr( $text , $starting_position);
			$text = ucfirst(trim($leading_text)) . ' ' .$text;
			$text = self::simple_truncate($text, $words);
			return $text;
		}

		private function simple_truncate($phrase, $max_words){
			$phrase_array = explode(' ',$phrase);
			if(count($phrase_array) > $max_words && $max_words > 0){
				$phrase = implode(' ',array_slice($phrase_array, 0, $max_words));
			}
			return $phrase;
		}

		public static function twitterify($ret) {
			$ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $ret);
			$ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);
			$pattern = '#([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.';
			$pattern .= '[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)#i';
			$ret = preg_replace($pattern, '<a href="mailto:\\1">\\1</a>', $ret);
			$ret = preg_replace("/\B@(\w+)/", " <a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $ret);
			$ret = preg_replace("/\B#(\w+)/", " <a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $ret);
			return $ret;
		}

	}

	$GLOBALS['timber_sugar'] = new TimberSugar();
