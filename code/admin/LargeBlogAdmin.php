<?php
/**
 * Large Blog Admin for managing lots of blog entries
 *
 * @author Tim Klein, Dodat Ltd <tim(at)dodat(dot)co(dot)nz>
 */
class LargeBlogAdmin extends ModelAdmin {

	public static $managed_models = array(
		"BlogEntry"
	);
	
	static $url_segment = "blog_admin";
	
	static $menu_title = "Blog";
	
	function getEditForm($id = null, $fields = null) {
		$form = parent::getEditForm();

		$fieldList = $form->Fields();

		foreach($fieldList as $field) {
			if($field instanceof GridField) {
				$class = $field->getList()->dataClass();
				if(Object::has_extension($class, "Versioned")) {
					$config = $field->getConfig();
					$config->removeComponentsByType('GridFieldDeleteAction')
						->removeComponentsByType('GridFieldDetailForm')
						->addComponents(new VersionedGridFieldDetailForm());
					$field->setConfig($config);
				}
			}
		}
		return $form;
	}

}
