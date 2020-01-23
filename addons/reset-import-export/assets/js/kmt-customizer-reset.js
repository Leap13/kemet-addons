/**
 * Kemet Customizer settings
 */
(function ($) {
	/**
	 * Setup the flow.
	 */
	function init() {
		customizerKmtButtons();
	}

	/**
	 * Reset button
	 */
	function customizerKmtButtons() {
		var $buttonsContainer = $('<div class="kmt-customizer-reset-footer"></div>');

		var $resetButton = $(
			'<button name="kmt-customizer-reset" class="button kmt-customizer-reset-button">' + kmtResetCustomizerObj.buttons.reset.text + '</button>'
		);

		$resetButton.on('click', resetCustomizer);

		$buttonsContainer.append($resetButton);

		$('#customize-footer-actions').prepend($buttonsContainer);
	}

	/**
	 * Reset customizer.
	 * 
	 * @param Event e Event object.
	 */
	function resetCustomizer(e) {
		e.preventDefault();

		if (!confirm(kmtResetCustomizerObj.message.resetWarning)) return;

		this.disabled = true;

		$.ajax({
			type: 'post',
			url: ajaxurl,
			data: {
				wp_customize: 'on',
				action: 'customizer_reset',
				nonce: kmtResetCustomizerObj.nonces.reset
			}
		}).done(function (r) {
			if (!r || !r.success) return;

			wp.customize.state('saved').set(true);
			location.reload();
		}).always(function () {
			this.disabled = false;
		});
	}

	// Start!
	init();

})(jQuery);