<?php
	/*
	 * Copyright (c) 2017 Morten Nilsen (morten@runsafe.no)
	 * https://github.com/Kruithne/KrameWork7
	 *
	 * Permission is hereby granted, free of charge, to any person obtaining a copy
	 * of this software and associated documentation files (the "Software"), to deal
	 * in the Software without restriction, including without limitation the rights
	 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	 * copies of the Software, and to permit persons to whom the Software is
	 * furnished to do so, subject to the following conditions:
	 *
	 * The above copyright notice and this permission notice shall be included in all
	 * copies or substantial portions of the Software.
	 *
	 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
	 * SOFTWARE.
	 */

	namespace KrameWork\Data;
	require_once(__DIR__ . '/Value.php');

	/**
	 * Class DateValue
	 * A date value
	 * @author docpify <morten@runsafe.no>
	 */
	class DateValue extends Value
	{
		/**
		 * DateValue constructor.
		 * @param string|int $value String to be converted to a timestamp, or a unix timestamp
		 */
		public function __construct($value) {
			parent::__construct(\is_numeric($value) || $value === null ? $value : \strtotime($value));
		}

		/**
		 * Convert the timestamp into a format suitable for exporting in JSON
		 * @return null|string The timestamp formatted according to ISO 8601, or null
		 */
		public function json() {
			// Use ISO 8601 format to support moment.js client side
			return $this->value === null ? null : \date('c', $this->value);
		}

		/**
		 * Utility function for sorting a list of values
		 * @param $to Value|mixed A value to compare against
		 * @return int Sorting index
		 */
		public function compare($to) {
			// Dates should be compared without time
			$a = $this->value == null ? null : date('Ymd', $this->value);
			if ($to instanceof DateValue)
				$b = $to->real() == null ? null : \date('Ymd', $to->real());
			else
				$b = $to;

			if ($b === null)
				return $a === null ? 0 : 1;
			else if (!\is_numeric($b))
				$b = \date('Ymd', \strtotime($b));

			if ($a === null)
				return -1;

			return $a - $b;
		}

		/**
		 * @return string The encapsulated value as presented by a string
		 */
		public function __toString() {
			return \date('d.m.Y', $this->value);
		}
	}