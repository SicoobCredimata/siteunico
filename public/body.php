<?php
header('access-control-allow-origin: *');

$page = $_POST['page'];
require_once './pages/' . $page . '.php';
