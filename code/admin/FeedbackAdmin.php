<?php

class FeedbackAdmin extends ModelAdmin {
	private static $url_segment = "feedback";

	private static $menu_title = "Feedback";

	private static $managed_models = array(
		'Feedback'
	);
}