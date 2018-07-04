<?php
class sspmod_deviceauth_Auth_Source_DVC extends sspmod_core_Auth_DevicePassBase {

    private $username;
    private $password;

    public function __construct($info, $config) {
        parent::__construct($info, $config);
        if (!is_string($config['username'])) {
            throw new Exception('Missing or invalid username option in config.');
        }
        $this->username = $config['username'];
        if (!is_string($config['password'])) {
            throw new Exception('Missing or invalid password option in config.');
        }
        $this->password = $config['password'];
    }

    protected function login($username, $password) {

	$uniqueIdentifier = "";
	$cn = "";
	$adminContact = "";
	$description = "";
	$deviceType = "";
	$l = "";
	$latitude = "";
	$longitude = "";
	$altitude = "";
	$disposition = "";
	$exposure = "";
	$status = "";

	$authok = "NOK";

	//echo "OKOKOKO";

	$server = "localhost";
	$connection = ldap_connect($server);
	ldap_set_option($connection, LDAP_OPT_PROTOCOL_VERSION, 3);
	$bind = ldap_bind($connection,"cn=admin,dc=idpiot,dc=cafeexpresso,dc=rnp,dc=br","idpidpidp");
	if($bind){
		$sr=ldap_search($connection,"ou=device,dc=idpiot,dc=cafeexpresso,dc=rnp,dc=br","uniqueIdentifier=$username");
		//echo "BIND OK";
		if($sr){
			$authok = "OK";
			$reg = ldap_get_entries($connection, $sr);
			$uniqueIdentifier = $reg[0]['uniqueIdentifier'][0];
			$cn = $reg[0]['cn'][0];
			$adminContact = $reg[0]['admincontact'][0];
			$description = $reg[0]['description'][0];
			$deviceType = $reg[0]['devicetype'][0];
			$l = $reg[0]['l'][0];
			$latitude = $reg[0]['latitude'][0];
			$longitude = $reg[0]['longitude'][0];
			$altitude = $reg[0]['altitude'][0];
			$disposition = $reg[0]['disposition'][0];
			$exposure = $reg[0]['exposure'][0];
			$status = $reg[0]['status'][0];
		}
	}

	ldap_close($connection);


        //if ($username !== $this->username || $password !== $this->password) {
	if($authok != "OK"){
            throw new SimpleSAML_Error_Error('WRONGUSERPASS');
        }
        return array(
            //'uid' => array($this->username),
            //'displayName' => array('Some Random Device'),
		'uniqueIdentifier' => array($username),
                'cn' => array($cn),
		'adminContact' => array($adminContact),
		'description' => array($description),
                'deviceType' => array($deviceType),
                'l' => array($l),
                'latitude' => array($latitude),
                'longitude' => array($longitude),
                'altitude' => array($altitude),
                'disposition' => array($disposition),
                'exposure' => array($exposure),
                'status' => array($status),
            //'eduPersonAffiliation' => array('member', 'employee'),
        );
    }

}

