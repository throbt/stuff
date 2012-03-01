#!/usr/bin/env php
<?php

    // Remove various whitespace errors and convert to LF from CRLF line endings
    // written by Barnabas Debreceni
    // licensed under the terms of WFTPL (http://en.wikipedia.org/wiki/WTFPL)

    // handle no args
    if( $argc <2 ) die( "nothing to do" );


    // blacklist

    $bl = array( 'smarty' . DIRECTORY_SEPARATOR . 'templates_c' . DIRECTORY_SEPARATOR . '.*' );

    // whitelist

    $wl = array(    '\.tpl', '\.php', '\.inc', '\.js', '\.css', '\.sh', '\.html', '\.txt', '\.htc', '\.afm',
                    '\.cfm', '\.cfc', '\.asp', '\.aspx', '\.ascx' ,'\.lasso', '\.py', '\.afp', '\.xml',
                    '\.htm', '\.sql', '\.as', '\.mxml', '\.ini', '\.yaml', '\.yml', '\.e?rb', '\.rake', '\.less' );

    // remove $argv[0]
    array_shift( $argv );

    // make file list
    $files = getFileList( $argv );

    // sort files
    sort( $files );

    // filter them for blacklist and whitelist entries

    $filtered = preg_grep( '#(' . implode( '|', $wl ) . ')$#', $files );
    $filtered = preg_grep( '#(' . implode( '|', $bl ) . ')$#', $filtered, PREG_GREP_INVERT );

    // fix whitespace errors
    fix_whitespace_errors( $filtered );





    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////


    // whitespace error fixer
    function fix_whitespace_errors( $files ) {
        foreach( $files as $file ) {

            // read in file
            $rawlines = file_get_contents( $file );

            // remove \r
            $lines = preg_replace( "/(\r\n)|(\n\r)/m", "\n", $rawlines );
            $lines = preg_replace( "/\r/m", "\n", $lines );

            // remove spaces from before tabs
            $lines = preg_replace( "/\040+\t/m", "\t", $lines );

            // remove spaces and tabs from line endings
            $lines = preg_replace( "/[\040\t]+$/m", "", $lines );

            // remove EOF newlines
            $lines = preg_replace( "/\n+$/", "", $lines );

            // write file if changed and set old permissions
            if( strlen( $lines ) != strlen( $rawlines )){

                $perms = fileperms( $file );

                // Uncomment to save original files

                //rename( $file, $file.".old" );
                file_put_contents( $file, $lines);
                chmod( $file, $perms );
                echo "${file}: FIXED\n";
            } else {
                echo "${file}: unchanged\n";
            }

        }
    }

    // get file list from argument array
    function getFileList( $argv ) {
        $files = array();
        foreach( $argv as $arg ) {
          // is a direcrtory
            if( is_dir( $arg ) )  {
                $files = array_merge( $files, getDirectoryTree( $arg ) );
            }
            // is a file
            if( is_file( $arg ) ) {
                $files[] = $arg;
            }
        }
        return $files;
    }

    // recursively scan directory
    function getDirectoryTree( $outerDir ){
        $outerDir = preg_replace( ':' . DIRECTORY_SEPARATOR . '$:', '', $outerDir );
        $dirs = array_diff( scandir( $outerDir ), array( ".", ".." ) );
        $dir_array = array();
        foreach( $dirs as $d ){
            if( is_dir( $outerDir . DIRECTORY_SEPARATOR . $d ) ) {
                $otherdir = getDirectoryTree( $outerDir . DIRECTORY_SEPARATOR . $d );
                $dir_array = array_merge( $dir_array, $otherdir );
            }
            else $dir_array[] = $outerDir . DIRECTORY_SEPARATOR . $d;
        }
        return $dir_array;
    }
?>