<?php

if (!function_exists('u__')) {
	function u__($message)
	{
		return ucfirst(__($message));
	}
}

if (!function_exists('s__')) {
	function s__($message)
	{
		return strtoupper(__($message));
	}
}