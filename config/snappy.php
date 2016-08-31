<?php

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {

    return array(


        'pdf' => array(
            'enabled' => true,
            'binary' => 'C:\wkhtmltopdf\bin\wkhtmltopdf', // '/usr/local/bin/wkhtmltox/bin/wkhtmltopdf',
            'timeout' => false,
            'options' => array(),
        ),
        'image' => array(
            'enabled' => true,
            'binary' => 'C:\wkhtmltopdf\bin\wkhtmltoimage', // '/usr/local/bin/wkhtmltox/bin/wkhtmltoimage',
            'timeout' => false,
            'options' => array(),
        ),


    );

}else{
    return array(


        'pdf' => array(
            'enabled' => true,
            'binary' =>  '/usr/local/bin/wkhtmltox/bin/wkhtmltopdf',
            'timeout' => false,
            'options' => array(),
        ),
        'image' => array(
            'enabled' => true,
            'binary' => '/usr/local/bin/wkhtmltox/bin/wkhtmltoimage',
            'timeout' => false,
            'options' => array(),
        ),


    );
}