<?php

require "libs/rb.php";

R::setup( 'mysql:host=localhost;dbname=test_blog',
    'root', '' );
session_start();