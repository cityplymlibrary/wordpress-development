// handler.js, ccp_lib_wp student id assist module, jake deery on behalf of ccp, 2020


// clear any previous session - for security
sessionStorage.removeItem('studentId');
sessionStorage.removeItem('studentEmail');

// DEBUG: show results befoe submit
//$('#results').css('display', 'block');

// disable the hash url function
jQuery( 'a[href="#"]' ).click( function( event ) {
	event.preventDefault();
});


// form submission procedure
$( '#studentIdForm' ).submit(function( event ) {
	// disable standard form submission procedure - ajax
	event.preventDefault();

	// do the fetch
	$.getJSON( 'engine.php', {
		'id': $('#studentId').val()
	}).done( function( data ) {
		// DEBUG: output data from engine to console
		console.log(data);

		// process the data we need

		// keep a record of the student id and email for later
		sessionStorage.setItem('studentId', data.id);
		sessionStorage.setItem('studentEmail', data.email);

		// show all student id login types
		$('.resultStudentId').each( function() {
			$(this).text(data.id);
		});

		// show all student email login types
		$('.resultStudentEmail').each( function() {
			$(this).text(data.email);
		});

		// populate the buttons with predefined urls
		$('#gmailGoto').attr('href', data.google.gmailUrl);
		$('#classroomGoto').attr('href', data.google.classroomUrl);
	}).fail( function( data ) {
		// unhide error text
		$('#studentIdError').css('display', 'inherit');
	});
});

// copy id to clipboard
$('.idCopy').click(function() {
	navigator.permissions.query({name: "clipboard-write"}).then(result => {
		if (result.state == "granted" || result.state == "prompt") {
			navigator.clipboard.writeText(sessionStorage.getItem('studentId'));
		}
	});
});

// copy email to clipboard
$('.emailCopy').click(function() {
	navigator.permissions.query({name: "clipboard-write"}).then(result => {
		if (result.state == "granted" || result.state == "prompt") {
			navigator.clipboard.writeText(sessionStorage.getItem('studentEmail'));
		}
	});
});
