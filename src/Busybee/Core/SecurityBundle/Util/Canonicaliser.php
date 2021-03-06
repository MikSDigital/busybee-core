<?php

namespace Busybee\Core\SecurityBundle\Util;

class Canonicaliser implements CanonicaliserInterface
{
	public function canonicalise($string)
	{
		return null === $string ? null : mb_convert_case($string, MB_CASE_LOWER, mb_detect_encoding($string));
	}
}
