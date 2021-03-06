<?php
	/*
	 * Copyright (c) 2017 Kruithne (kruithne@gmail.com)
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
	namespace KrameWork\HTTP;

	require_once(__DIR__ . '/HTTPHeader.php');

	/**
	 * Class CSPHeader
	 * Content Security Policy generator.
	 *
	 * @package KrameWork\Security
	 * @author Kruithne <kruithne@gmail.com>
	 */
	class CSPHeader extends HTTPHeader
	{
		const SOURCE_NONE = '\'none\''; // Nothing allowed.
		const SOURCE_SELF = '\'self\''; // Same-domain only.
		const SOURCE_INLINE = '\'unsafe-inline\''; // Inline allowed.
		const SOURCE_EVAL = '\'unsafe-eval\''; // Inline allowed (with eval).
		const SOURCE_HTTPS = 'https:'; // Apply rule to HTTPS protocol.
		const SOURCE_DATA = 'data:'; // Apply rule to DATA protocol.

		const DIRECTIVE_DEFAULT = 'default-src'; // Fallback.
		const DIRECTIVE_BASE = 'base-uri'; // <base> URI.
		const DIRECTIVE_CHILD = 'child-src'; // Workers/embedded frames.
		const DIRECTIVE_CONNECT = 'connect-src'; // XHR, WebSockets, EventSource.
		const DIRECTIVE_FONT = 'font-src'; // Fonts
		const DIRECTIVE_FORM = 'form-action'; // Valid endpoints for forms.
		const DIRECTIVE_ANCESTORS = 'frame-ancestors'; // frame, iframe, embed, applet
		const DIRECTIVE_IMAGE = 'img-src'; // Images
		const DIRECTIVE_MEDIA = 'media-src'; // Video/audio.
		const DIRECTIVE_OBJECT = 'object-src'; // Flash/multimedia plug-ins.
		const DIRECTIVE_PLUGIN = 'plugin-types'; // Invokable plug-in types.
		const DIRECTIVE_REPORT = 'report-uri'; // URL for browser to report to.
		const DIRECTIVE_STYLE = 'style-src'; // Stylesheets.
		const DIRECTIVE_SCRIPT = 'script-src'; // Scripts.
		const DIRECTIVE_UPGRADE = 'upgrade-insecure-requests'; // Upgrade HTTP to HTTPS

		/**
		 * CSPHeader constructor.
		 *
		 * @api __construct
		 * @param array|null $arr Initial policy input.
		 */
		public function __construct($arr = null) {
			$this->directives = [];
			$this->directives[self::DIRECTIVE_DEFAULT] = self::SOURCE_SELF;

			if (\is_array($arr))
				$this->fromArray($arr);
		}

		/**
		 * Add directive/source pairs from an array.
		 *
		 * @api fromArray
		 * @param array $arr Directive/source pair array.
		 */
		public function fromArray(array $arr) {
			foreach ($arr as $directive => $source)
				$this->add($directive, $source);
		}

		/**
		 * Add a directive to this policy.
		 *
		 * @api add
		 * @param array|string $directives Directive (use CSPHeader:: constants).
		 * @param array|string $source Source directive.
		 */
		public function add($directives, $source) {
			if (\is_array($source))
				$source = \implode(' ', $source);

			foreach (\is_array($directives) ? $directives : [$directives] as $directive)
				$this->directives[$directive] = $source;
		}

		/**
		 * Get the field name for this header.
		 *
		 * @api getFieldName
		 * @return string
		 */
		public function getFieldName(): string {
			return 'Content-Security-Policy';
		}

		/**
		 * Get the field value for this header.
		 *
		 * @api getFieldValue
		 * @return string
		 */
		public function getFieldValue(): string {
			$parts = [];
			foreach ($this->directives as $directive => $source)
				$parts[] = $directive . ' ' . $source;

			return \implode('; ', $parts);
		}

		/**
		 * @var array
		 */
		private $directives;
	}