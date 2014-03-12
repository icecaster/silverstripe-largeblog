<?php
/**
 * Large Blog Entry Extension adding some nice tweaks to the modeladmin interface
 *
 * @author Tim Klein, Dodat Ltd <tim(at)doda(dot)co(dot)nz>
 */
class LargeBlogEntryExtension extends DataExtension {

	static $summary_fields = array(
		"Title",
		"Parent.Title"
	);

	static $field_labels = array(
		"Parent.Title" => "Blog"
	);

	static $searchable_fields = array(
		"Title",
		"ParentID" => array(
			"title" 	=> "Blog",
			"field" 	=> "LargeBlogEntryExtension_BlogSearchField",
			"filter" 	=> "ExactMatchFilter"
		),
		"Author"
	);
	
	/**
	* updates the fields used in the CMS
	* @param FieldSet $fields
	*/
	public function updateCMSFields(FieldList $fields){
		//main tab
		$fields->addFieldToTab('Root.Main', new DropdownField('ParentID', 'Select a Blog Holder', $this->getBlogHoldersMapped()), 'Content');
	}
	
	/**
	* returns a map of BlogHolders if any exist.
	* @return {SS_Map} SS_Map object if Blog holders exist
	* array if none exist.
	*/
	public function getBlogHoldersMapped(){
		if(BlogHolder::get()->count() >= 1){
			return BlogHolder::get()->map('ID', 'Title');
		}else {
			return array('There are currently no blog holders');
		}
	}
}


class LargeBlogEntryExtension_BlogSearchField extends GroupedDropdownField {

	function __construct($name, $title = null, $source = array(), $value = '', $form = null, $emptyString = true) {
		parent::__construct($name, $title, $source, $value, $form, $emptyString);

		$blogs = DB::query("SELECT ID, Title FROM SiteTree WHERE ID IN(SELECT DISTINCT ParentID FROM SiteTree WHERE ClassName='BlogEntry')")->map();
		$this->setSource($blogs);
	}
}
