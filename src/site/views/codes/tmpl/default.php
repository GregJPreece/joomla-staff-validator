<?php

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;
use Joomla\CMS\Date\Date;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_staffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?= $this->renderToolbar(); ?>
<form action="<?= Route::_('index.php?option=com_staffvalidator&view=codes') ?>" method="post" id="adminForm" name="adminForm">
    <?= HTMLHelper::_('form.token'); ?>
    <input type="hidden" name="option" value="com_staffvalidator">
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="filter_order" value="<?= $this->sortColumn; ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?= $this->sortDirection; ?>" />
    <table class="table table-striped table-hover sortable">
        <thead>
        <tr>
            <th width="1%"><?= Text::_('COM_STAFFVALIDATOR_NUM'); ?></th>
            <th width="2%">
                <?= HTMLHelper::_('grid.checkall'); ?>
            </th>
            <th>
                <?= HTMLHelper::_(
                    'grid.sort',
                    Text::_('COM_STAFFVALIDATOR_FIELD_CODE_VALUE_LABEL'),
                    'code',
                    $this->sortDirection,
                    $this->sortColumn
                ); ?>
            </th>
            <th>
                <?= HTMLHelper::_(
                    'grid.sort',
                    Text::_('COM_STAFFVALIDATOR_FIELD_CODE_TIME_EXPIRES_LABEL'),
                    'time_expires',
                    $this->sortDirection,
                    $this->sortColumn
                ); ?>
            </th>
        </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="7">
                    <?= $this->pagination->getListFooter(); ?>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php if (!empty($this->items)) : ?>
                <?php foreach ($this->items as $i => $row) : 
                    $link = Route::_('index.php?option=com_staffvalidator&task=code.edit&id=' . $row->id);
                ?>
                    <tr>
                        <td>
                            <?= $this->pagination->getRowOffset($i); ?>
                        </td>
                        <td>
                            <?= HTMLHelper::_('grid.id', $i, $row->id); ?>
                        </td>
                        <td>
                            <a href="<?= $link ?>" title="<?= Text::_('COM_STAFFVALIDATOR_LIST_EDIT'); ?>">
                                <?= $row->code; ?>
                            </a>
                        </td>
                        <td>
                            <?= (empty($row->time_expires)) 
                                ? Text::_('COM_STAFFVALIDATOR_LIST_NO_EXPIRY')
                                : HTMLHelper::date($row->time_expires, Text::_('DATE_FORMAT_FILTER_DATETIME')); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</form>