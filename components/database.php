<?php

/**
 * database short summary.
 *
 * database description.
 *
 * @version 1.0
 * @author a_koz
 */
class database
{
    private $dblogin = "root";
    private $dbpass = "";
    private $db = "|";
    private $dbhost="localhost";

    private $resource;
    private $query;
    private $err;
    private $result;
    private $data;
    private $fetch;

    function connect()
    {
        $this->resource = mysqli_connect($this->dbhost, $this->dblogin, $this->dbpass, $this->db);
    }

    function close()
    {
        mysqli_close($this->resource);
    }

    /**
     * request function.
     *
     * @requires query request
     * @return mysqli_result of mysqli_query
     */
    function request($query)
    {
        $this->query = $query;
        $this->result = mysqli_query($this->resource, $this->query);
        $this->err = mysqli_error($this->resource);

        return $this->result;
    }

    /**
     * fetch array function.
     *
     * @requires query request
     * @return array of mysqli_result
     */
    function fetcharray($query)
    {
        $this->request($query);

        if ($this->result === false)
            $a = false;
        else if ($this->result === true)
            $a = true;
        else
        {
            $a = [];
            while ($s = mysqli_fetch_array($this->result))
                $a[] = $s;
            mysqli_free_result($this->result);
        }
        return $a;
    }

    function stop()
    {
        unset($this->data);
        unset($this->result);
        unset($this->fetch);
        unset($this->err);
        unset($this->query);
    }

    function getLink()
    {
        return $this->resource;
    }
}
