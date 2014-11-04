<?php
require_once('const.php');

session_start();
session_unset();

header('Location: ' . BASE_URL . 'index.php');