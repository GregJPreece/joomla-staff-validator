export interface Window {
    
    /**
     * USED IN: administrator/components/com_content/views/article/view.html.php
     * actually, probably not used anywhere.
     *
     * Changes a dynamically generated list
     *
     * @param listname The name of the list to change
     * @param source A javascript array of list options in the form [key,value,text]
     * @param key The key to display
     * @param orig_key The original key that was selected
     * @param orig_val The original item value that was selected
     * @deprecated  4.0 No replacement
     */
    changeDynaList(listname: string, source: string[], key: string, orig_key: string, orig_val: string): void;


    /**
     * Checks all the boxes unless one is missing then it assumes it's checked out.
     * Weird. Probably only used by ^saveorder
     *
     * @param n     The total number of checkboxes expected
     * @param task  The task to perform
     * @deprecated 4.0  No replacement
     */
    checkAll_button(n: number, task: string): void;

    /**
     * USED IN: administrator/components/com_users/views/mail/tmpl/default.php
     * Let's get rid of this and kill it
     *
     * @param frmName The form name to fetch a value from
     * @param srcListName The name of the input to fetch the value for
     * @deprecated  4.0 No replacement
     */
    getSelectedValue(frmName: string, srcListName: string): string | null;

    /**
     * USED IN: all over :)
     *
     * Submits an admin list form with a specific task for a record, such
     * as "edit" or "delete". Used for actions such as "edit row" in an
     * admin record list.
     *
     * @param id Name of the checkbox set to check
     * @param task The task to submit: edit, delete, etc
     * @deprecated 4.0  Use Joomla.listItemTask() instead
     */
    listItemTask(id: string, task: string): boolean;

    /**
     * USED IN: administrator/components/com_menus/views/menus/tmpl/default.php
     * Probably not used at all
     *
     * Returns the value of the radio button that is checked.
     * Returns an empty string if none are checked, or
     * there are no radio buttons
     *
     * @param radioObj Single or set of radio buttons to get values for 
     * @deprecated  4.0 No replacement
     */
    radioGetCheckedValue(radioObj: HTMLInputElement | HTMLInputElement[]): string;

    /**
     * USED IN: libraries/joomla/html/html/grid.php
     * Internally, just calls window.checkAll_button()
     *
     * @see checkAll_button
     * @deprecated 4.0  No replacement
     */
    saveorder(n: number, task: string): void;

    /**
     * Default submit function. Usually would be overriden by the component
     * Internally delegates to Joomla.submitbutton()
     * 
     * @param task  The task to execute using the form contents
     * @deprecated 4.0  Use Joomla.submitbutton() instead.
     */        
    submitbutton(task: string): void;
    
    /**
     * Submit the admin form
     * Internally delegates to Joomla.submitform()
     *
     * @param task  The task to execute using the form contents
     * @deprecated 4.0  Use Joomla.submitform() instead.
     */    
    submitform(task: string): void;
    
    /**
     * USED IN: administrator/components/com_modules/views/module/tmpl/default.php
     *
     * Writes a dynamically generated list
     *
     * @param selectParams The parameters to insert into the <select> tag
     * @param source A javascript array of list options in the form [key,value,text]
     * @param key The key to display for the initial state of the list
     * @param orig_key The original key that was selected
     * @param orig_val The original item value that was selected
     * @param element The elem where the list will be written
     * @deprecated  4.0 No replacement
     */    
    writeDynaList(selectParams: string, source: string[], key: string, orig_key: string, orig_val: string, element?: Node): void;    
        
}