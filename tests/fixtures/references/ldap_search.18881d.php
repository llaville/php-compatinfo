<?php
// your ldap server
$ds = "ldap.myserver.com";

// the object itself instead of the top search level as in ldap_search
$dn = "cn=username,o=My Company, c=US";

// this command requires some filter
$filter ="(objectclass=*)";

//the attributes to pull, which is much more efficient than pulling all attributes if you don't do this
$justthese = array("ou", "sn", "givenname", "mail");

$sr = ldap_search($ds, $dn, $filter, $justthese);
