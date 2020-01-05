<?php

use Joomla\CMS\Form\FormRule;

class JFormRuleCode extends FormRule {
    
    protected $regex = '[a-zA-Z0-9]{4,10}';
    
}