<?php

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;
use Joomla\CMS\Date\Date;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_gregsstaffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<form action="<?= Route::_('index.php') ?>" method="post" id="adminForm" name="adminForm">
    <?= HTMLHelper::_('form.token'); ?>
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="filter_order" value="<?= $this->sortColumn; ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?= $this->sortDirection; ?>" />
    <input type="hidden" name="option" value="com_gregsstaffvalidator" />
    <input type="hidden" name="view" value="codes" />
    <table class="table table-striped table-hover sortable">
        <thead>
        <tr>
            <th width="1%"><?= Text::_('COM_GREGSSTAFFVALIDATOR_NUM'); ?></th>
            <th width="2%">
                <?= HTMLHelper::_('grid.checkall'); ?>
            </th>
            <th>
                <?= Text::_('COM_GREGSSTAFFVALIDATOR_FIELD_CODE_ID_LABEL'); ?>
            </th>
            <th>
                <?= Text::_('COM_GREGSSTAFFVALIDATOR_FIELD_CODE_USER_LABEL'); ?>
            </th>
            <th>
                <?= HTMLHelper::_(
                    'grid.sort',
                    Text::_('COM_GREGSSTAFFVALIDATOR_FIELD_CODE_VALUE_LABEL'),
                    'code',
                    $this->sortDirection,
                    $this->sortColumn
                ); ?>
            </th>
            <th>
                <?= HTMLHelper::_(
                    'grid.sort',
                    Text::_('COM_GREGSSTAFFVALIDATOR_FIELD_CODE_TIME_EXPIRES_LABEL'),
                    'time_expires',
                    $this->sortDirection,
                    $this->sortColumn
                ); ?>
            </th>
            <th>
                <?= Text::_('COM_GREGSSTAFFVALIDATOR_FIELD_CODE_CREATOR_LABEL'); ?>
            </th>
            <th>
                <?= Text::_('COM_GREGSSTAFFVALIDATOR_FIELD_CODE_UPDATED_LABEL'); ?>
            </th>
        </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="7">
                    <?= ($this->pagination) ? $this->pagination->getListFooter() : '' ?>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php if (!empty($this->items)) : ?>
                <?php foreach ($this->items as $i => $row) : 
                    $link = Route::_('index.php?option=com_gregsstaffvalidator&task=code.edit&id=' . $row->id);
                    $ownerLink = Route::_('index.php?option=com_users&view=user&layout=edit&id=' . $row->user_id);
                    $creatorLink = Route::_('index.php?option=com_users&view=user&layout=edit&id=' . $row->created_by);
                    $updaterLink = Route::_('index.php?option=com_users&view=user&layout=edit&id=' . $row->updated_by);
                ?>
                    <tr>
                        <td>
                            <?= $this->pagination->getRowOffset($i); ?>
                        </td>
                        <td>
                            <?= HTMLHelper::_('grid.id', $i, $row->id); ?>
                        </td>
                        <td>
                            <a href="<?= $link ?>" title="<?= Text::_('COM_GREGSSTAFFVALIDATOR_MANAGER_LIST_CODE_EDIT'); ?>">
                                <?= $row->id; ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?= $ownerLink ?>">
                                <?= $row->ownerName; ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?= $link ?>" title="<?= Text::_('COM_GREGSSTAFFVALIDATOR_MANAGER_LIST_CODE_EDIT'); ?>">
                                <?= $row->code; ?>
                            </a>
                        </td>
                        <td>
                            <?= (empty($row->time_expires)) 
                                ? Text::_('COM_GREGSSTAFFVALIDATOR_MANAGER_LIST_CODE_NO_EXPIRY')
                                : HTMLHelper::date($row->time_expires, Text::_('DATE_FORMAT_FILTER_DATETIME')); ?>
                        </td>
                        <td>
                            <a href="<?= $creatorLink ?>">
                                <?= Text::sprintf(
                                        'COM_GREGSSTAFFVALIDATOR_FIELD_CODE_CREATOR_TEXT',
                                        HtmlHelper::date($row->time_generated, Text::_('DATE_FORMAT_FILTER_DATETIME')),
                                        $row->creatorName) ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?= $updaterLink ?>">
                                <?= Text::sprintf(
                                        'COM_GREGSSTAFFVALIDATOR_FIELD_CODE_UPDATED_TEXT', 
                                        HTMLHelper::date($row->time_updated, Text::_('DATE_FORMAT_FILTER_DATETIME')),
                                        $row->updaterName) ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</form>