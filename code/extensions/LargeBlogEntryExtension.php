<?php

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
}


class LargeBlogEntryExtension_BlogSearchField extends GroupedDropdownField {

	function __construct($name, $title = null, $source = array(), $value = '', $form = null, $emptyString = true) {
		parent::__construct($name, $title, $source, $value, $form, $emptyString);

		$blogs = DB::query("SELECT ID, Title FROM SiteTree WHERE ID IN(SELECT DISTINCT ParentID FROM SiteTree WHERE ClassName='BlogEntry')")->map();
		$this->setSource($blogs);
	}
}
