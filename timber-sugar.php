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

	}

	$GLOBALS['timber_sugar'] = new TimberSugar();
