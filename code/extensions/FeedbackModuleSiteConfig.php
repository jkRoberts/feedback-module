<?php

class FeedbackModuleSiteConfig extends DataExtension {
	private static $db = array(
		'FeedbackFormTitle' => 'Varchar(255)'
	);

	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab(
			'Root.FeedbackForm',
			new TextField('FeedbackFormTitle', 'Feedback Form Title')
		);
	}
}