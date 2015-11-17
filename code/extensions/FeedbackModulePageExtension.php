<?php

class FeedbackModulePageExtension extends Extension {
	private static $db = array(
		'ShowFeedbackModule' => 'Boolean'
	);

	public function updateCMSFields(FieldList &$fields) {
		$fields->addFieldToTab(
			'Root.Main',
			new CheckboxField('ShowFeedbackModule'),
			'Date'
		);
	}
}

class FeedbackModulePageControllerExtension extends Extension {

	private static $allowed_actions = array(
		'FeedbackForm',
		'doSubmitFeedback'
	);

	public function init() {
		parent::init();

		if($message = Session::get('Status')) {
			$this->owner->StatusMessage = DBField::create_field('HTMLText', $message['message']);
			$this->owner->StatusType = (isset($message['type'])) ? $message['type'] : 'success';

			Session::clear('Status');
		} else {
			$messages = Session::get_all();

			if($messages && isset($messages['FormInfo'])) {
				foreach($messages['FormInfo'] as $name => $message) {
					if(isset($message['formError'])) {
						$this->owner->StatusMessage = DBField::create_field('HTMLText',$message['formError']['message']);
						$this->owner->StatusType = (isset($message['formError']['type'])) ? $message['formError']['type'] : 'success';
					}
				}

				Session::clear('FormInfo');
			}
		}
		
		if ($this->owner->StatusMessage) {
			$this->owner->StatusMessage = html_entity_decode($this->owner->StatusMessage);
		}
	}
	/**
	 * Feedback form will be shown on specific pages.
	 *
	 * @return Form
	 */
	public function FeedbackForm() {
		$fields = new FieldList(
			new TextareaField('Feedback', 'Your Feedback'),
			new HiddenField('URL', '', (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : ''),
			new HiddenField('Browser', '', (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown')
		);

		$actions = new FieldList(
			new FormAction('doSubmitFeedback', 'Submit')
		);

		$required = new RequiredFields(array(
			'Feedback'
		));

		return new Form($this->owner, 'FeedbackForm', $fields, $actions, $required);
	}

	public function doSubmitFeedback($data, $form) {
		$feedback = new Feedback();
		$form->saveInto($feedback);
		$feedback->write();

		//TODO: Add email sender... to whom? Saying what?
//		AlertManager::SendEmail('john.milmine@dna.co.nz', 'Rhino Feedback', 'RhinoFeedback', $feedback);

		Session::set('Status', array(
			'message' => 'Feedback successfully submitted',
			'type' => 'success'
		));

		return $this->owner->redirectBack();
	}
}