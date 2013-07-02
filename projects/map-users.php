
<?php
// basic sequence with LDAP is connect, bind, search, interpret search
// result, close connection
$ad_user = 'time-inc-corp\jsimpson1271';
$ad_pass = "tucker24";
echo "<h3>LDAP query test</h3>";
echo "Connecting ...";
$ds = ldap_connect("ldaps://corp.ad.timeinc.com:3269")
	or die("Could not connect to LDAP server.");
	
$basedn = "DC=CORP,DC=AD,DC=TIMEINC,DC=com";

echo "connect result is " . $ds . "<br />";

if ($ds) { 

    echo "Binding ..."; 

     $r = ldap_bind($ds, $ad_user, $ad_pass);                    
    echo "Bind result is " . $r . "<br />";

    echo "Searching for (sn=S*) ...";
    // Search surname entry
   $filter = "(givenName=Jeff)";
   $justthese = array("ou", "cn", "givenname", "mail");
    $sr=ldap_search($ds, $basedn, $filter, $justthese); 
    
    if(!$sr){
    	echo "<br/>failure <br/>";
   
    }
     
    echo "Search result is " . $sr . "<br />";
    

    echo "Number of entries returned is " . ldap_count_entries($ds, $sr) . "<br />";

    echo "Getting entries ...<p>";
    $info = ldap_get_entries($ds, $sr);
    echo "Data for " . $info["count"] . " items returned:<p>";

    for ($i=0; $i<$info["count"]; $i++) {
        echo "dn is: " . $info[$i]["dn"] . "<br />";
        echo "first cn entry is: " . $info[$i]["cn"][0] . "<br />";
        echo "first email entry is: " . $info[$i]["mail"][0] . "<br /><hr />";
    }

    echo "Closing connection";
    ldap_close($ds);

} else {
    echo "<h4>Unable to connect to LDAP server</h4>";
}
?>