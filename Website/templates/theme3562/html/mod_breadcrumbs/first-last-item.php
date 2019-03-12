<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_breadcrumbs
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

?>

<ul itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb<?php echo $moduleclass_sfx; ?>">
	<?php if ($params->get('showHere', 1)) : ?>
		<li>
			<?php echo JText::_('MOD_BREADCRUMBS_HERE'); ?>&#160;
		</li>
	<?php else : ?>
		<li class="active">
			<span class="divider icon-location"></span>
		</li>
	<?php endif; ?>

	<?php
	// Get rid of duplicated entries on trail including home page when using multilanguage
	for ($i = 0; $i < $count; $i++)
	{
		if ($i === 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link === $list[$i - 1]->link)
		{
			unset($list[$i]);
		}
	}

	// Find last and penultimate items in breadcrumbs list
	end($list);
	$last_item_key   = key($list);
	prev($list);
	$penult_item_key = key($list);

	// Make a link if not the last item in the breadcrumbs
	$show_last = $params->get('showLast', 1);

	// Generate the trail
	foreach ($list as $key => $item) :
	if ($key != $last_item_key)
	{
		if($key == 0){
			echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
			if (!empty($item->link))
			{
				echo '<a itemprop="item" href="' . $item->link . '" class="pathway"><span itemprop="name">' . $item->name . '</span></a>';
			}
			echo '</li>';
		}
	}
	elseif ($show_last)
	{
		// Render last item if reqd.
		echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active">';
		echo '<span itemprop="name">' . $item->name . '</span><meta itemprop="position" content="'.($key+1).'">';
		echo '</li>';
	}
	endforeach; ?>
</ul>
