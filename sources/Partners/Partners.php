<?php

/**
 * @brief		(db) Partners Partners Class
 * @author		<a href='https://dottbuff.eu'>dottbuff</a>
 * @copyright	(c) 2023 dottbuff
 * @package		Invision Community
 * @subpackage	(db) Partners
 * @since		23 Oct 2023
 * @version
 */

namespace IPS\dbpartners;

class _Partners extends \IPS\Node\Model
{
    /**
     * Multiton Store
     */
    protected static $multitons = array();

    /**
     * Node Title
     */
    public static $nodeTitle = 'menu__dbpartners_partners_manage';

    /**
     * Database Table
     */
    public static $databaseTable = 'dbpartners_partners';
    public static $databasePrefix = 'dbpartners_';
    public static $databaseColumnOrder = 'position';

    /**
     * Get URL
     *
     * @return	\IPS\Http\Url
     * @throws	\BadMethodCallException
     */
    public function url()
    {
        return;
    }

    /**
     * [Node] Add/Edit Form
     *
     * @param	\IPS\Helpers\Form	$form	The form
     * @return	void
     */
    public function form(&$form)
    {
        $form->addHeader( 'dbpartners_header_partners_details' );
        $form->add(new \IPS\Helpers\Form\Text( 'dbpartners_name', $this->name, TRUE ));
        $form->add( new \IPS\Helpers\Form\Upload( 'dbpartners_image', $this->image ? \IPS\File::get( 'dbpartners_Images', $this->image ) : NULL, TRUE, array( 'image' => TRUE, 'storageExtension' => 'dbpartners_Images' ), NULL, NULL, NULL, 'dbpartners_image' ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'dbpartners_linkEnabled', $this->linkEnabled ? 1 : 0, FALSE, array( 'togglesOn' => array( 'dbpartners_link' ) ), NULL, NULL, NULL, 'dbpartners_linkEnabled' ) );
        $form->add(new \IPS\Helpers\Form\Url( 'dbpartners_link', $this->link, FALSE, [], NULL, NULL, NULL, 'dbpartners_link' ));
    }

    /**
     * [Node] Perform actions after saving the form
     *
     * @param	array	$values	Values from the form
     * @return	void
     */
    public function postSaveForm($values)
    {
    }

    /**
     * [Node] Format form values from add/edit form for save
     *
     * @param	array	$values	Values from the form
     * @return	array
     */
    public function formatFormValues($values)
    {
        return $values;
    }

    /**
     * [Node] Get Title
     *
     * @return	string
     */
    protected function get__title()
    {
        return $this->name;
    }

    /**
     * [Node] Get Node Description
     *
     * @return	string|null
     */
    protected function get__description()
    {
        return $this->linkEnabled ? $this->link : \IPS\Member::loggedIn()->language()->addToStack('dbpartners_link_empty');
    }
}