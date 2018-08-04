<?php

/*
 *
 *  ____                           _   _  ___
 * |  _ \ _ __ ___  ___  ___ _ __ | |_| |/ (_)_ __ ___
 * | |_) | '__/ _ \/ __|/ _ \ '_ \| __| ' /| | '_ ` _ \
 * |  __/| | |  __/\__ \  __/ | | | |_| . \| | | | | | |
 * |_|   |_|  \___||___/\___|_| |_|\__|_|\_\_|_| |_| |_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author  PresentKim (debe3721@gmail.com)
 * @link    https://github.com/PresentKim
 * @license https://www.gnu.org/licenses/agpl-3.0.html AGPL-3.0.0
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 */

declare(strict_types=1);

namespace kim\present\instantenchant\utils;

class Range{
	/** @var int */
	protected $min, $max;

	/**
	 * Range constructor.
	 *
	 * @param int $min
	 * @param int $max
	 */
	public function __construct(int $min, int $max){
		$this->min = $min;
		$this->max = $max;
	}

	/**
	 * @return int
	 */
	public function getMin() : int{
		return $this->min;
	}

	/**
	 * @param int $min
	 */
	public function setMin(int $min) : void{
		$this->min = $min;
	}

	/**
	 * @return int
	 */
	public function getMax() : int{
		return $this->max;
	}

	/**
	 * @param int $max
	 */
	public function setMax(int $max) : void{
		$this->max = $max;
	}

	/**
	 * @param int $value
	 *
	 * @return bool
	 */
	public function include(int $value) : bool{
		return $this->min <= $value && $value >= $this->max;
	}
}