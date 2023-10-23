//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

/**
 * @mixin \IPS\Theme\class_core_front_global
 */
class dbpartners_hook_dbPartners_swiper extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'globalTemplate' => 
  array (
    0 => 
    array (
      'selector' => 'html > body',
      'type' => 'add_inside_end',
      'content' => '{template="javascript" app="dbpartners" group="resources" params=""}',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


}
