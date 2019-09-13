/**
 * Unobtrusive Form Validation library
 *
 * Inspired by: Chris Campbell <www.particletree.com>
 *
 * @since  1.5
 */
interface JFormValidator {
    
    /**
     * Attaches the validator to the given HTML form
     * @param form Form element to attach to
     */
    attachToForm(form: HTMLElement): void;
    
    /**
     * Check validity for a HTML form
     * @param form Form to validate
     */
    isValid(form: HTMLElement): boolean;
    
    /**
     * Sets a custom validation handler for elements in the form
     * @param name Name of the handler
     * @param fn Handler function, should take (value, element)
     * @param en Enabled
     */
    setHandler(name: string, fn: Function, en: boolean): void;
    
    /**
     * Validates an element in the form, updates its visual state
     * to match its validation state, and returns validation success/failure
     * @param el The form element to validate
     */
    validate(el: HTMLInputElement): boolean;
}

interface Document {
    formvalidator: JFormValidator;
}