<?php
/**
 * @brief		File Storage Extension: Images
 * @author		<a href='https://www.invisioncommunity.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) Invision Power Services, Inc.
 * @license		https://www.invisioncommunity.com/legal/standards/
 * @package		Invision Community
 * @subpackage	(db) Partners
 * @since		23 Oct 2023
 */

namespace IPS\dbpartners\extensions\core\FileStorage;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !\defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * File Storage Extension: Images
 */
class _Images
{
    /**
     * Count stored files
     *
     * @return	int
     */
    public function count()
    {
        return \IPS\Db::i()->select( 'COUNT(*)', 'dbpartners_partners', 'dbpartners_image IS NOT NULL' )->first();
    }

    /**
     * Move stored files
     *
     * @param	int			$offset					This will be sent starting with 0, increasing to get all files stored by this extension
     * @param	int			$storageConfiguration	New storage configuration ID
     * @param	int|NULL	$oldConfiguration		Old storage configuration ID
     * @throws	\Underflowexception				When file record doesn't exist. Indicating there are no more files to move
     * @return	void
     */
    public function move( $offset, $storageConfiguration, $oldConfiguration=NULL )
    {
        $partner = \IPS\dbpartners\Partners::constructFromData( \IPS\Db::i()->select( '*', 'dbpartners_partners', 'dbpartners_image IS NOT NULL', 'id', array( $offset, 1 ) )->first() );

        try
        {
            $partner->icon = \IPS\File::get( $oldConfiguration ?: 'dbpartners_Images', $partner->dbpartners_image )->move( $storageConfiguration );
            $partner->save();
        }
        catch( \Exception $e )
        {
            /* Any issues are logged */
        }
    }

    /**
     * Fix all URLs
     *
     * @param	int			$offset					This will be sent starting with 0, increasing to get all files stored by this extension
     * @return void
     */
    public function fixUrls( $offset )
    {
        $partner = \IPS\dbpartners\Partners::constructFromData( \IPS\Db::i()->select( '*', 'dbpartners_partners', 'dbpartners_image IS NOT NULL', 'id', array( $offset, 1 ) )->first() );

        if ( $new = \IPS\File::repairUrl( $partner->dbpartners_image ) )
        {
            $partner->dbpartners_image = $new;
            $partner->save();
        }
    }

    /**
     * Check if a file is valid
     *
     * @param	string	$file		The file path to check
     * @return	bool
     */
    public function isValidFile( $file )
    {
        try
        {
            \IPS\Db::i()->select( 'id', 'dbpartners_partners', array( 'dbpartners_image=?', $file ) )->first();
            return TRUE;
        }
        catch ( \UnderflowException $e )
        {
            return FALSE;
        }
    }

    /**
     * Delete all stored files
     *
     * @return	void
     */
    public function delete()
    {
        foreach( \IPS\Db::i()->select( '*', 'dbpartners_partners', "dbpartners_image IS NOT NULL" ) as $partner )
        {
            try
            {
                \IPS\File::get( 'dbpartners_Images', $partner['dbpartners_image'] )->delete();
            }
            catch( \Exception $e ){}
        }
    }
}