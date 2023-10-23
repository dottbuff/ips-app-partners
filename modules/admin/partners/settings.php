<?php


namespace IPS\dbpartners\modules\admin\partners;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * settings
 */
class _settings extends \IPS\Dispatcher\Controller
{
    /**
     * @brief	Has been CSRF-protected
     */
    public static $csrfProtected = TRUE;

    /**
     * Execute
     *
     * @return	void
     */
    public function execute()
    {
        \IPS\Dispatcher::i()->checkAcpPermission('settings_manage');

        $form = new \IPS\Helpers\Form;
        $form->add( new \IPS\Helpers\Form\YesNo( 'dbpartners_swiper_loop', \IPS\Settings::i()->dbpartners_swiper_loop ? 1 : 0, FALSE ) );
        $form->add( new \IPS\Helpers\Form\YesNo( 'dbpartners_swiper_autoplay', \IPS\Settings::i()->dbpartners_swiper_autoplay ? 1 : 0, FALSE,
            array( 'togglesOn' => array(
                'dbpartners_swiper_autoplay_delay'
            ) ), NULL, NULL, NULL, 'dbpartners_swiper_autoplay' ) );
        $form->add( new \IPS\Helpers\Form\Number( 'dbpartners_swiper_autoplay_delay', \IPS\Settings::i()->dbpartners_swiper_autoplay_delay, FALSE, [], NULL, NULL, NULL, 'dbpartners_swiper_autoplay_delay' ) );
        $form->add(new \IPS\Helpers\Form\Select('dbpartners_swiper_pagination', \IPS\Settings::i()->dbpartners_swiper_pagination, FALSE, [
            'options' => [
                'none' => \IPS\Member::loggedIn()->language()->addToStack('dbpartners_swiper_pagination_none'),
                'pagination' => \IPS\Member::loggedIn()->language()->addToStack('dbpartners_swiper_pagination_pagination'),
                'arrows' => \IPS\Member::loggedIn()->language()->addToStack('dbpartners_swiper_pagination_arrows'),
                'scrollbar' => \IPS\Member::loggedIn()->language()->addToStack('dbpartners_swiper_pagination_scrollbar')
            ], 'multiple' => FALSE
        ], NULL, NULL, NULL, 'dbpartners_swiper_pagination'));

        if ($values = $form->values(TRUE)) {
            $form->saveAsSettings($values);

            \IPS\Output::i()->redirect(\IPS\Http\Url::internal('app=dbpartners&module=partners&controller=settings'), 'saved');
        }

        \IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack('menu__dbpartners_partners_settings');
        \IPS\Output::i()->output = $form;
        parent::execute();
    }

    /**
     * ...
     *
     * @return	void
     */
    protected function manage()
    {
        // This is the default method if no 'do' parameter is specified
    }

    // Create new methods with the same name as the 'do' parameter which should execute it
}