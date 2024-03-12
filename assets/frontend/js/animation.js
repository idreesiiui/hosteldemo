
    AOS.init({
        duration: 700
    });

 
<!-- Disable animation on less than 1200px, change value if you like -->

AOS.init({
  disable: function () {
    var maxWidth = 1200;
    return window.innerWidth < maxWidth;
  }
});

		
$().ready(function() {
		// validate the comment form when it is submitted
		$("#signupForm").validate({
			rules: {
				username: {
					required: true,
					minlength: 2
				},
				password: {
					required: true,
					minlength: 2,
					maxlength: 12
				}
			},
			messages: {
				username: {
					//required: "Please enter a username",
					minlength: "must be at least 2 characters"
				},
				password: {
					//required: "Please provide a password",
					minlength: "must be at least 2 characters "
				}
			}
			
		});
	});

		
