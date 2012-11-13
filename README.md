silverstripe-largeblog
===============================
(well, its more a detailform, but who searches for silverstripe versioned gridfield detail form)


## Requirements

 * SilverStripe 3.0 or newer
 * VersionedGridFieldDetailForm ( https://github.com/icecaster/silverstripe-versioned-gridfield )
 
 Not causing any errors if not there, but pointless without -
 * ExcludeChildren - to exclude blogentries from the SiteTree ( https://github.com/micschk/silverstripe-excludechildren )

## Introduction

This module provides an alternative interface for managing blog with lots of posts by excluding them from the sitetree.

## Usage / Installation

clone or download into directory of your choice, recommend webroot/largeblog
do the same for VersionedGridField and ExcludeChildren.

Add the following line to your _config.php to remove BlogEntries from the SiteTree in the CMS:

	Object::add_extension("BlogHolder", "ExcludeChildren");
	Config::inst()->update("BlogHolder", "excluded_children", array("BlogEntry"));
	

