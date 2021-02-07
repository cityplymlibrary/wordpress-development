<?php
	// window.html, ccp_lib_wp student it assist module, jake deery on behalf of ccp, 2020

	// deliver as json
	header('Content-Type: application/json');

	// get data from url
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$email = $id . "@cityplym.ac.uk";
	} else {
		die('{"error": "noId"}');
	}

	// ensure the id is numeric
	if(!is_numeric($id)) die('{"error": "idNan"}');

	// ensure the id is == 8 in len
	if(strlen($id) != 8) die('{"error": "idLen"}');

	// all is good - setup
	$data = (object)[]; // a new object
	$data->id = $id;
	$data->email = $email;

	// define google data
	$data->google = (object)[];
	$data->google->defaultLogin = $email;
	$data->google->loginUrl = "https://accounts.google.com/ServiceLogin?service=accountsettings&passive=true&Email=" . $id . "&hd=cityplym.ac.uk";
	$data->google->gmailUrl = "https://accounts.google.com/ServiceLogin?service=mail&passive=true&Email=" . $id . "&hd=cityplym.ac.uk&continue=https://mail.google.com/mail/u/" . $email . "/";
	$data->google->classroomUrl = "https://accounts.google.com/ServiceLogin?service=classroom&passive=true&Email=" . $id . "&hd=cityplym.ac.uk&continue=https://classroom.google.com/u/" . $email . "/h";

	// define moodle data
	$data->moodle = (object)[];
	$data->moodle->defaultLogin = $id;
	$data->moodle->feLoginUrl = "https://moodle.cityplym.ac.uk/login/?username=" . $id;
	$data->moodle->heLoginUrl = "https://moodle.cityplym.ac.uk/auth/mnet/jump.php?hostid=3&wantsurl=/mod/page/view.php?id=172775";

	// define mis data
	$data->mis = (object)[];
	$data->mis->defaultLogin = $id;
	$data->mis->loginUrl = "https://stepup.cityplym.ac.uk/login";

	// define bksp data
	$data->bksb = (object)[];
	$data->bksb->defaultLogin = $id;
	$data->bksb->loginUrl = "https://cityplym.bksblive2.co.uk/bksbLive2/Login.aspx?username=" . $id;

	// define koha data
	$data->koha = (object)[];
	$data->koha->defaultLogin = $id;
	$data->koha->loginUrl = "https://ccp.koha-ptfs.co.uk/cgi-bin/koha/opac-user.pl";
	$data->koha->defaultPin = substr($id, -4);

	// setup done - parse to requesting client
	$json = json_encode($data);
	printf($json);
	// done
?>
