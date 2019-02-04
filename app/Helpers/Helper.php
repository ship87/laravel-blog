<?php

if (!function_exists('u__')) {
	function u__($message)
	{
		return ucfirst(__($message));
	}
}