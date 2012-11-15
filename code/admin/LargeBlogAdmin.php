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

}
