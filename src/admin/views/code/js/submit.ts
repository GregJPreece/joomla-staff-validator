/// <reference path="../../../../../definitions/joomla.core.d.ts" />
/// <reference path="../../../../../definitions/joomla.validator.d.ts" /> 
/// <reference path="../../../../../vendor/npm-asset/types--jquery/index.d.ts" />

Joomla.submitbutton = function(task: string) {
    if (task !== '') {
        let isValid = true;
        let action = task.split('.');

        if (action[1] != 'cancel' && action[1] != 'close') {
            var forms = jQuery('form.form-validate');

            for (var i = 0; i < forms.length; i++) {
                if (!document.formvalidator.isValid(forms[i])) {
                    isValid = false;
                    break;
                }
            }
        }

        if (isValid) {
            Joomla.submitform(task);
            return true;
        } else {
            alert(Joomla.JText._('COM_GREGSSTAFFVALIDATOR_MANAGER_CODE_EDIT_VALIDATION_FAIL',
                                 'Some values are unacceptable'));
            return false;
        }
    }
}


