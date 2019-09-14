interface JStoredOptions {
    [key: string]: any;
}

interface JText {
    
    /**
     * Translates a string into the current language.
     *
     * @param key   The string to translate
     * @param def   Default string
     */     
    _(key: string, def?: string): string;
    
    /**
     * Load new strings in to Joomla.JText
     *
     * @param object  Object with new strings
     */
    load(object: { [key: string]: string }): JText;
}

interface Joomla {

    /**
     * Joomla options storage
     *
     * @since 3.7.0
     */
    optionsStorage: JStoredOptions;
        
    JText: JText;
    Text: JText;
    
    /**
     * Convert errors encountered during AJAX into localised human-readable
     * error messages.
     * Used by some javascripts such as sendtestmail.js and permissions.js
     *
     * @param xhr         XHR object.
     * @param textStatus  Type of error that occurred.
     * @param error       Textual portion of the HTTP status.
     *
     * @return JavaScript object containing the system error message.
     *
     * @since  3.6.0
     */    
    ajaxErrorsMessages(xhr: XMLHttpRequest, textStatus: string, error: string): { error: string[] };
    
    /**
     * Toggles the check state of a group of boxes
     *
     * Checkboxes must have an id attribute in the form cb0, cb1...
     *
     * @param checkbox  The number of box to 'check', for a checkbox element
     * @param stub      An alternative field name
     */    
    checkAll(checkbox: any, stub?: string): boolean;
    
    /**
     * Method to Extend Objects
     *
     * @param destination Destination object, will be merged onto
     * @param source Source object
     * @return Extended object
     */
    extend(destination: object, source: object): object;
    
    /**
     * Get script(s) options
     *
     * @param key  Name in Storage
     * @param def  Default value if nothing found
     *
     * @since 3.7.0
     */    
    getOptions(key: string, def?: any): any;

    /**
     * USED IN: administrator/components/com_cache/views/cache/tmpl/default.php
     * administrator/components/com_installer/views/discover/tmpl/default_item.php
     * administrator/components/com_installer/views/update/tmpl/default_item.php
     * administrator/components/com_languages/helpers/html/languages.php
     * libraries/joomla/html/html/grid.php
     *
     * @param isitchecked  Flag for checked
     * @param form         The form
     */
    isChecked(isitChecked: boolean, form?: HTMLFormElement): void;

    /**
     * USED IN: administrator/components/com_banners/views/client/tmpl/default.php
     * Actually, probably not used anywhere. Can we deprecate in favor of <input type="email">?
     *
     * Verifies if the string is in a valid email format
     *
     * @param text  The text for validation
     * @deprecated  4.0 No replacement. Use formvalidator
     */    
    isEmail(text: string): boolean;

    /**
     * Add Joomla! loading image layer.
     *
     * Used in: /administrator/components/com_installer/views/languages/tmpl/default.php
     *          /installation/template/js/installation.js
     *
     * @param task           The task to do [load, show, hide] (defaults to show).
     * @param parentElement  The HTML element where we are appending the layer (defaults to body).
     * @return The HTML loading layer element.
     * @since  3.6.0
     * @deprecated  4.0 No direct replacement.
     *              4.0 will introduce a web component for the loading spinner, therefore the spinner will need to
     *              explicitly be loaded in all relevant pages.
     */    
    loadingLayer(task: string, parentElement: HTMLElement): HTMLElement;
    
    /**
     * Load new options from given options object or from Element
     *
     * @param options  The options object to load. Eg {"com_foobar" : {"option1": 1, "option2": 2}}
     *
     * @since 3.7.0
     */
    loadOptions(options?: JStoredOptions): void;
    
    /**
     * USED IN: libraries/joomla/html/toolbar/button/help.php
     *
     * Pops up a new window in the middle of the screen
     *
     * @deprecated  4.0 No replacement
     */    
    popupWindow(mypage: string, myname: string, w: number, h: number, scroll: string): void;
    
    /**
     * Removes all system messages currently onscreen
     */
    removeMessages(): void;
    
    /**
     * Render messages send via JSON
     * Used by some javascripts such as validate.js
     *
     * @param messages    JavaScript object containing the messages to render. Example:
     *                    var messages = {
     *                        "message": ["Message one", "Message two"],
     *                        "error": ["Error one", "Error two"]
     *                    };
     */    
    renderMessages(messages: { [key: string]: string[] }): void;
    
    /**
     * Method to replace all request tokens on the page with a new one.
     * Used in Joomla Installation
     *
     * @param newToken  The new token
     */    
    replaceTokens(newToken: string): void;
    


    /**
     * Method to perform AJAX request
     *
     * @param options   Request options:
     * {
     *    url:       'index.php',  // Request URL
     *    method:    'GET',        // Request method GET (default), POST
     *    data:      null,         // Data to be sent, see https://developer.mozilla.org/docs/Web/API/XMLHttpRequest/send
     *    perform:   true,         // Perform the request immediately, or return XMLHttpRequest instance and perform it later
     *    headers:   null,         // Object of custom headers, eg {'X-Foo': 'Bar', 'X-Bar': 'Foo'}
     *
     *    onBefore:  function(xhr){}            // Callback on before the request
     *    onSuccess: function(response, xhr){}, // Callback on the request success
     *    onError:   function(xhr){},           // Callback on the request error
     * }
     *
     * @example
     *
     * 	Joomla.request({
     *		url: 'index.php?option=com_example&view=example',
     *		onSuccess: function(response, xhr){
     *			console.log(response);
     *		}
     * 	})
     *
     * @see    https://developer.mozilla.org/docs/Web/API/XMLHttpRequest
     */    
    request(options: object): XMLHttpRequest | boolean;
    
    /**
     * Default submit function. Can be overriden by the component to add custom logic
     *
     * @param task  The task to execute using the form contents
     */
    submitbutton(task: string): void;
    
    /**
     * Generic form submit handler
     *
     * @param task      The given task
     * @param form      The form element
     * @param validate  The form element
     */
    submitform(task: string, form?: Node, validate?: boolean): void;

    /**
     * USED IN: libraries/joomla/html/html/grid.php
     * In other words, on any reorderable table
     *
     * @param order  The order value
     * @param dir    The direction
     * @param task   The task
     * @param form   The form
     */    
    tableOrdering(order: string, dir: string, task: string, form: Node): void;
}

declare const Joomla: Joomla;