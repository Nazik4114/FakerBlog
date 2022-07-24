<?php

        try {

            $dbh = new PDO("mysql:host=localhost;dbname=test2", 'root', '');
            
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            } catch (PDOException $e) {
            
            die('Die with error: ' . $e->getMessage());
            
            }
    