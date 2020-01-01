/**
 * Customizer controls toggles
 *
 * @package Kemet
 */

( function( $ ) {

	/* Internal shorthand */
	var api = wp.customize;

	/**
	 * Trigger hooks
	 */
	KMTControlTrigger = {

	    /**
	     * Trigger a hook.
	     *
	     * @method triggerHook
	     * @param {String} hook The hook to trigger.
	     * @param {Array} args An array of args to pass to the hook.
		 */
	    triggerHook: function( hook, args )
	    {
	    	$( 'body' ).trigger( 'kemet-control-trigger.' + hook, args );
	    },

	    /**
	     * Add a hook.
	     *
	     * @method addHook
	     * @param {String} hook The hook to add.
	     * @param {Function} callback A function to call when the hook is triggered.
	     */
	    addHook: function( hook, callback )
	    {
	    	$( 'body' ).on( 'kemet-control-trigger.' + hook, callback );
	    },

	    /**
	     * Remove a hook.
	     *
	     * @method removeHook
	     * @param {String} hook The hook to remove.
	     * @param {Function} callback The callback function to remove.
	     */
	    removeHook: function( hook, callback )
	    {
		    $( 'body' ).off( 'kemet-control-trigger.' + hook, callback );
	    },
	};

	/**
	 * Helper class that contains data for showing and hiding controls.
	 *
	 * @class KMTCustomizerToggles
	 */
	KMTCustomizerToggles = {
        'kemet-settings[header-layouts]':
		[
			{
				controls: [
					'kemet-settings[enable-transparent]',
				],
				callback: function (value) {

					if (value == 'header-main-layout-6' || value == 'header-main-layout-8') {
						return false;
					}
					return true;
				}
			},
			{
				controls: [
					'kemet-settings[header-icon-label]',
				],
				callback: function (value) {

					if (value == 'header-main-layout-7' || value == 'header-main-layout-5') {
						return true;
					}
					return false;
				}
			},
		],
	};
} )( jQuery );