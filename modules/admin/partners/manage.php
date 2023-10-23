<?php


namespace IPS\dbpartners\modules\admin\partners;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * manage
 */
class _manage extends \IPS\Node\Controller
{
    /**
     * @brief	Has been CSRF-protected
     */
    public static $csrfProtected = TRUE;

	/**
	 * Node Class
	 */
	protected $nodeClass = '\IPS\dbpartners\Partners';
	
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'manage_manage' );
		parent::execute();
	}
}