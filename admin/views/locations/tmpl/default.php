<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$app       = JFactory::getApplication();
$user      = JFactory::getUser();
$userId    = $user->get('id');
$listOrder = str_replace(' ' . $this->state->get('list.direction'), '', $this->state->get('list.fullordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$saveOrder = $listOrder == 'a.ordering';
$columns   = 10;

if (strpos($listOrder, 'publish_up') !== false)
{
	$orderingColumn = 'publish_up';
}
elseif (strpos($listOrder, 'publish_down') !== false)
{
	$orderingColumn = 'publish_down';
}
else
{
	$orderingColumn = 'created';
}

if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_dd_gmaps_locations&task=locations.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}

?>

<div id="dd_gmaps_locations-locations" class="row-fluid dd_gmaps_locations">
    <form action="<?php echo JRoute::_('index.php?option=com_dd_gmaps_locations&view=locations'); ?>" method="post" name="adminForm" id="adminForm">
	<?php if (!empty( $this->sidebar)) : ?>
    <div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
    </div>
    <div id="j-main-container" class="span10">
    <?php else : ?>
    <div id="j-main-container">
        <?php endif; ?>

        <!-- Filter Bar -->
        <div id="filter-bar" class="btn-toolbar">
            <div class="filter-search btn-group pull-left">
                <label for="filter_search"
                       class="element-invisible"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_SEARCH'); ?></label>
                <input type="text" name="filter_search" id="filter_search"
                       placeholder="<?php echo JText::_('COM_DD_GMAPS_LOCATIONS_SEARCH'); ?>"
                       value="<?php echo $this->escape($this->state->get('filter.search')); ?>"
                       title="<?php echo JText::_('COM_DD_GMAPS_LOCATIONS_SEARCH'); ?>"/>
            </div>
            <div class="btn-group pull-left">
                <button class="btn hasTooltip" type="submit"
                        title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>"><i class="icon-search"></i>
                </button>
                <button class="btn hasTooltip" type="button" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>"
                        onclick="document.getElementById('filter_search').value='';this.form.submit();"><i
                            class="icon-remove"></i></button>
            </div>

            <div class="btn-group pull-right hidden-phone">
                <label for="limit"
                       class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
                <?php echo $this->pagination->getLimitBox(); ?>
            </div>

            <div class="btn-group pull-right hidden-phone">
                <label for="directionTable"
                       class="element-invisible"><?php echo JText::_('JFIELD_ORDERING_DESC'); ?></label>
                <select name="directionTable" id="directionTable" class="input-medium"
                        onchange="Joomla.orderTable()">
                    <option value=""><?php echo JText::_('JFIELD_ORDERING_DESC'); ?></option>
                    <option value="asc" <?php if ($listDirn == 'asc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_ASCENDING'); ?></option>
                    <option value="desc" <?php if ($listDirn == 'desc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_DESCENDING'); ?></option>
                </select>
            </div>
            <div class="btn-group pull-right">
                <label for="sortTable" class="element-invisible"><?php echo JText::_('JGLOBAL_SORT_BY'); ?></label>
                <select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
                    <option value=""><?php echo JText::_('JGLOBAL_SORT_BY'); ?></option>
                    <?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder); ?>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="clearfix"></div>

        <?php if (empty($this->items)) : ?>
            <div class="alert alert-no-items">
                <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>
            <table class="table table-striped" id="articleList">
                <thead>
                <th width="1%" class="center hidden-phone">
                    <input type="checkbox" name="check-toggle" value=""
                           title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>"
                           onclick="Joomla.checkAll(this)" />
                </th>
                <th width="1%" style="min-width: 55px;" class="nowrap center">
                    <?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
                </th>
                <th style="min-width: 100px" class="nowrap title">
                    <?php echo JHtml::_('searchtools.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
                </th>
                <th width="10%" class="nowrap">
                    <?php echo JHtml::_('searchtools.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_STREET', 'a.street', $listDirn, $listOrder); ?>
                </th>
                <th width="10%" class="nowrap">
                    <?php echo JHtml::_('searchtools.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_LOCATION', 'a.location', $listDirn, $listOrder); ?>
                </th>
                <th width="4%" class="nowrap">
                    <?php echo JHtml::_('searchtools.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_ZIP', 'a.zip', $listDirn, $listOrder); ?>
                </th>
                <th width="10%" class="nowrap">
                    <?php echo JHtml::_('searchtools.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_COUNTRY', 'a.country', $listDirn, $listOrder); ?>
                </th>
                <th width="10%" class="nowrap hidden-phone">
                    <?php echo JHtml::_('searchtools.sort', 'JCATEGORY', 'c.category_title', $listDirn, $listOrder); ?>
                </th>
                <th width="1%" class="nowrap hidden-phone">
                    <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                </th>
                </thead>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <?php echo $this->pagination->getListFooter(); ?>
                    </td>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($this->items as $i => $item):
                    $canCheckin = $user->authorise('core.manage',     'com_checkin') || $item->checked_out == $user->get('id') || $item->checked_out == 0;
                    $canChange  = $user->authorise('core.edit.state', 'com_dd_gmaps_locations') && $canCheckin;
                    ?>
                    <tr class="row<?php echo $i % 2; ?>">
                        <td class="center hidden-phone">
                            <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                        </td>
                        <td class="center">
                            <?php echo JHtml::_('jgrid.published', $item->state, $i, 'locations.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
                        </td>
                        <td class="nowrap">
                            <a href="<?php echo JRoute::_('index.php?option=com_dd_gmaps_locations&task=location.edit&id=' . (int) $item->id);?> ">
                                <?php echo $this->escape($item->title);?>
                            </a>
                        </td>
                        <td class="nowrap">
                            <?php echo $this->escape($item->street); ?>
                        </td>
                        <td class="nowrap">
                            <?php echo $this->escape($item->location); ?>
                        </td>
                        <td class="nowrap">
                            <?php echo $this->escape($item->zip); ?>
                        </td>
                        <td class="nowrap">
                            <?php echo JText::_($this->escape($item->country)); ?>
                        </td>
                        <td class="nowrap hidden-phone">
                            <?php echo $this->escape($item->category_title); ?>
                        </td>
                        <td class="nowrap hidden-phone">
                            <?php echo (int) $item->id; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <?php echo JHtml::_('form.token'); ?>

        <!-- Component Credits -->
        <div class="row-fluid">
            <hr>
            <div class="text-center">
                <p><small><?php echo nl2br(JText::sprintf('COM_DD_GMAPS_LOCATIONS_CREDITS', DD_GMaps_LocationsHelper::getComponentCoyright())); ?></small></p>
            </div>
        </div>
    </div>
</form>
</div>
