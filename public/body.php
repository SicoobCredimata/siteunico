<?php
header('access-control-allow-origin: *');

$page = $_POST['page'];
header('location: ./pages/' . $page . '.php');
