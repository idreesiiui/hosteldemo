	$().ready(function() {
		// validate the comment form when it is submitted
		$("#signupForm").validate({
			rules: {
				user: {
					required: true
				},
				password: {
					required: true,
					minlength: 5,
					maxlength: 12
				}
			},
			messages: {
				user: {
					required: "Please enter a username"
				},
				password: {
					required: "Please enter a password",
					minlength: "must be at least 5 characters",
					maxlength: "must be at least 12 characters"
				}
			},
			errorElement: "em",
			errorPlacement:errorPlacement,
			highlight:highlight,
			unhighlight:unhighlight
	
		});

		$("#forgotpwordForm").validate({
			rules: {
				email: {
					required: true,
					email: true
				}
			},
			messages: {
				email: {
					required:"Please enter an Email",
					email:"Enter a valid email address"
				}
			},
			errorElement: "em",
			errorPlacement:errorPlacement,
			highlight:highlight,
			unhighlight:unhighlight
	
		});
	});

	function errorPlacement( error, element ) {
		// Add the `invalid-feedback` class to the error element
		error.addClass( "invalid-feedback" );

		if ( element.prop( "type" ) === "checkbox" ) {
			error.insertAfter( element.next( "label" ) );
		} else {
			error.insertAfter( element );
		}
	}
	function highlight( element, errorClass, validClass ) {
		$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
	}	
	function unhighlight(element, errorClass, validClass) {
		$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
	}
