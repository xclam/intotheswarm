<?php

include '../inc/dynamics_crm.php';
// CRM Online
$url = "https://grcprod.climespace.fr/IGLOO365";
$username = "D70\WV5309";
$password = "eZ3VSFlu2W6pHGVq3gmM";
$dynamicsCrmHeader = new DynamicsCrmHeader ();
$authHeader = $dynamicsCrmHeader->GetHeaderOnPremise ( $username, $password, $url );

// print_r($authHeader);

