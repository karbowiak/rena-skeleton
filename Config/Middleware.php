<?php

// Load middleware
foreach(glob(__DIR__ . "/Middleware/*.php") as $file)
    require_once($file);