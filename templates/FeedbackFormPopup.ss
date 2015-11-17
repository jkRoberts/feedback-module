<% include StatusMessage %>

<a href="#" id="feedback" data-toggle="modal" data-target="#feedback-form">Feedback</a>

<div class="modal fade" id="feedback-form" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>

				<h4 class="modal-title">Feedback</h4>
			</div>

			<div class="modal-body">
				$FeedbackForm
			</div>
		</div>
	</div>
</div>