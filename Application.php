<?php
/**
 * @brief		(db) Partners Application Class
 * @author		<a href='https://dottbuff.eu'>dottbuff</a>
 * @copyright	(c) 2023 dottbuff
 * @package		Invision Community
 * @subpackage	(db) Partners
 * @since		23 Oct 2023
 * @version		
 */
 
namespace IPS\dbpartners;

/**
 * (db) Partners Application Class
 */
class _Application extends \IPS\Application
{
    /**
     * [Node] Get Icon for tree
     *
     * @note	Return the class for the icon (e.g. 'globe')
     * @return	string|null
     */
    protected function get__icon()
    {
        return 'users';
    }
}