<?php
 defined('_JEXEC') or die('Restricted access');
/**
 * Class JFormFieldTest класс поля
 */
class JFormFieldMediaold extends JFormField
{
    /**
     * @var string Тип поля (Должен называться как файл с полем)
     */
    protected $type = 'Mediaold';
 
    /**
     * Создание поля
     * @return string
     */
    protected function getInput()
    {
       	// Load the modal behavior script.
		JHtml::_('behavior.modal');

		// Include jQuery
		JHtml::_('jquery.framework');
		JHtml::_('script', 'media/mediafield-mootools.min.js', true, true, false, false, true);

		// Tooltip for INPUT showing whole image path
		$options = array(
			'onShow' => 'jMediaRefreshImgpathTip',
		);

		JHtml::_('behavior.tooltip', '.hasTipImgpath', $options);
        $html = '';
  		if (!empty($class))
		{
			$class .= ' hasTipImgpath';
		}
		else
		{
			$class = 'hasTipImgpath';
		}

		$attr = '';

		$attr .= ' title="' . htmlspecialchars('<span id="TipImgpath"></span>', ENT_COMPAT, 'UTF-8') . '"';

		// Initialize some field attributes.
		$attr .= !empty($class) ? ' class="input-small field-media-input ' . $class . '"' : ' class="input-small"';
		$attr .= !empty($size) ? ' size="' . $size . '"' : '';

		// Initialize JavaScript field attributes.
		$attr .= !empty($onchange) ? ' onchange="' . $onchange . '"' : '';
		$html .='<div class="input-prepend input-append">';
		// The Preview.
		$showPreview = true;
		$showAsTooltip = false;

		
		$html .='	<input type="text" name="' . $this->name . '" id="'.$this->id.'" value="'. htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '" readonly="readonly"' . $attr . ' data-basepath="'
	. JUri::root() . '"/>';

		$html .='<a class="modal btn"';
		$html .='title="'.JText::_('JLIB_FORM_BUTTON_SELECT').'" ';
		$html .='href="';
		$html .='index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;asset=' . $this->asset . '&amp;author='. $this->authorField . '&amp;fieldid=' .$this->id . '';
		$html .='&amp;folder=' . $this->folder . '"'; 
		$html .='rel="{handler: \'iframe\', size: {x: 800, y: 500}}"';
		$html .='>';

		$jsclick = ".jInsertFieldValue('', '$this->id').";
	 	$html .=''.JText::_('JLIB_FORM_BUTTON_SELECT').'';
	 	$html .='</a>';
	 	$html .='<a class="btn hasTooltip" title="'.JText::_('JLIB_FORM_BUTTON_CLEAR').'" href="#" ';
	 	$html .='onclick="'.$jsclick.'';
	 	$html .=';return false';
	 	$html .='">';
		$html .='<i class="icon-remove"></i></a>';

		$html .='</div">';
  
        return $html;

    }
}
