<?php

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_staffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

?>
<h1><?= Text::_('COM_STAFFVALIDATOR_VALIDATED_TITLE') ?></h1>
<p>
    <?= Text::_('COM_STAFFVALIDATOR_VALIDATED_MESSAGE') ?>
    <strong><?= $this->successObject->name ?></strong>
</p>

<?php if (!empty($this->validatePostamble)): ?>
    <p class="validation-preamble">
        <?= $this->validatePostamble ?>
    </p>
<?php endif; ?>    