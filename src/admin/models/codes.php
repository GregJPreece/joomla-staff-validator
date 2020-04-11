<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Table\Table;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_gregsstaffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Staff Validator code list Model
 */
class GregsStaffValidatorModelCodes extends ListModel {

    public function __construct($config = []) {
        $config['filter_fields'] = [
            'time_expires',
            'code'
        ];
        parent::__construct($config);
    }
    
    /**
     * Method to delete one or more records.
     * (Swiped from Joomla's AdminModel class)
     *
     * @param   array  &$pks  An array of record primary keys.
     * @return  boolean  True if successful, false if an error occurs.
     * @since   1.6
     */
    public function delete(&$pks) {
        
        $pks = (array) $pks;
        $table = $this->getTable();

        // Include the plugins for the delete events.
        PluginHelper::importPlugin($this->events_map['delete']);

        // Iterate the items to delete each one.
        foreach ($pks as $i => $pk) {
            
            if ($table->load($pk)) {

                if ($this->canDelete($table)) {
                    $context = $this->option . '.' . $this->name;

                    // Multilanguage: if associated, delete the item in the _associations table
                    if ($this->associationsContext && Associations::isEnabled()) {
                        $db = $this->getDbo();
                        $query = $db->getQuery(true)
                                ->select('COUNT(*) as count, ' . $db->quoteName('as1.key'))
                                ->from($db->quoteName('#__associations') . ' AS as1')
                                ->join('LEFT', $db->quoteName('#__associations') . ' AS as2 ON ' . $db->quoteName('as1.key') . ' =  ' . $db->quoteName('as2.key'))
                                ->where($db->quoteName('as1.context') . ' = ' . $db->quote($this->associationsContext))
                                ->where($db->quoteName('as1.id') . ' = ' . (int) $pk)
                                ->group($db->quoteName('as1.key'));

                        $db->setQuery($query);
                        $row = $db->loadAssoc();

                        if (!empty($row['count'])) {
                            $query = $db->getQuery(true)
                                    ->delete($db->quoteName('#__associations'))
                                    ->where($db->quoteName('context') . ' = ' . $db->quote($this->associationsContext))
                                    ->where($db->quoteName('key') . ' = ' . $db->quote($row['key']));

                            if ($row['count'] > 2) {
                                $query->where($db->quoteName('id') . ' = ' . (int) $pk);
                            }

                            $db->setQuery($query);
                            $db->execute();
                        }
                    }

                    if (!$table->delete($pk)) {
                        $this->setError($table->getError());
                        return false;
                    }

                } else {
                    // Prune items that you can't change.
                    unset($pks[$i]);
                    $error = $this->getError();

                    if ($error) {
                        Log::add($error, Log::WARNING, 'jerror');
                    } else {
                        Log::add(Text::_('JLIB_APPLICATION_ERROR_DELETE_NOT_PERMITTED'), Log::WARNING, 'jerror');
                    }
                    return false;
                }
                
            } else {
                $this->setError($table->getError());
                return false;
            }
        }

        // Clear the component's cache
        $this->cleanCache();

        return true;
    }    

    /**
     * Fetches a table object, loads it if it is
     * not already loaded
     * 
     * @param string $type The table name. Optional.
     * @param string $prefix The class prefix. Optional.
     * @param array $config Configuration array for model. Optional.
     * @return Table The loaded table object
     */
    public function getTable($type = 'Code', $prefix = 'GregsStaffValidatorTable', $config = []) {
        return Table::getInstance($type, $prefix, $config);    
    }
    
    /**
     * Method to test whether a record can be deleted.
     *
     * @param   object  $record  A record object.
     * @return  boolean  True if allowed to delete the record. Defaults to the permission for the component.
     * @since   1.6
     */
    protected function canDelete($record) {
        return Factory::getUser()->authorise('core.delete', $this->option);
    }    
    
    /**
     * Method to build an SQL query to load the list data.
     *
     * @return string An SQL query
     */
    protected function getListQuery() {
        // Initialize variables.
        $db    = Factory::getDbo();
        $query = $db->getQuery(true);
        
        // Create the base select statement.
        $query->select([
            'codes.*',
            $db->qn('owner.name', 'ownerName'),
            $db->qn('owner.username', 'ownerUsername'),
            $db->qn('creator.name', 'creatorName'),
            $db->qn('creator.username', 'creatorUsername'),
            $db->qn('updater.name', 'updaterName'),
            $db->qn('updater.username', 'updaterUsername')
        ])
        ->from($db->qn('#__gregsstaffvalidator_codes', 'codes'))
        ->innerJoin($db->qn('#__users', 'owner') . ' ON ' . $db->qn('codes.user_id') . ' = ' . $db->qn('owner.id'))
        ->innerJoin($db->qn('#__users', 'creator') . ' ON ' . $db->qn('codes.created_by') . ' = ' . $db->qn('creator.id'))
        ->innerJoin($db->qn('#__users', 'updater') . ' ON ' . $db->qn('codes.user_id') . ' = ' . $db->qn('updater.id'));

        $query->order(
            $db->escape($this->getState('list.ordering', 'time_expires'))
            . ' ' .
            $db->escape($this->getState('list.direction', 'DESC'))
        );

        return $query;
    }

    protected function populateState($ordering = 'time_expires', $direction = 'DESC') {
        parent::populateState($ordering, $direction);
    }
}
