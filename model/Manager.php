<?php


class Manager
{
    /*
     * Connect to DB
     * */
    protected function getConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8','root','root');
        return $db;

    }
}