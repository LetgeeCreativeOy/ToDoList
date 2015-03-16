<?php

class idDB
{
    private $host, $username, $password;
    private $dbname;
    private $connection;
    
    public function idDB( $host, $username, $password )
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }
    
    public function Open( $dbname )
    {
        $this->dbname = $dbname;
        
        $this->connection = mysql_connect( $this->host, $this->username, $this->password ) or die( mysql_error() );
        mysql_select_db( $this->dbname ) or die( mysql_error() );
    }
    
    public function Close()
    {
        mysql_close( $this->connection );
    }

    public function Query( $query )
    {
        $result = mysql_query( $query ) or die( mysql_error() );
        return $result;
    }
}

?>