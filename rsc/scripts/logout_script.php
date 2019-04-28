<?php
require_once ("../../admin/dbcon.php");
session_destroy();
header('Refresh: 0; URL=../../index.php');