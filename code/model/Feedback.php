<?php

class Feedback extends DataObject {

	private static $db = array(
		'Feedback' => 'Text',
		'Browser' => 'Varchar(255)',
		'URL' => 'Varchar(255)'
	);

	private static $summary_fields = array(
		'Feedback',
		'URL'
	);

	private static $default_sort = 'Created DESC';

	public function AbsoluteEditLink() {
		return Controller::join_links(singleton('AppAdmin')->Link('Feedback/EditForm/field/Feedback/item'), $this->ID, 'edit');
	}
}