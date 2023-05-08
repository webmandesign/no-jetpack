<?php

namespace Automattic\Jetpack;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Automattic\Jetpack\Status' ) ) {

	class Status {

		public function is_offline_mode() {
			return true;
		}
	}
}
