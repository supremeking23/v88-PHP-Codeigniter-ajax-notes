<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<!-- Bootstrap CSS -->
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
			integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
			crossorigin="anonymous"
		/>

		<title>Ajax Posts</title>

        <link rel="stylesheet/less" type="text/css" href="<?= base_url() ?>assets/less/index.less" />
        <script src="//cdn.jsdelivr.net/npm/less@3.13" ></script>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

		<!-- google fonts -->

		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=McLaren&family=Montserrat:wght@300;500&display=swap" rel="stylesheet">
	</head>
	<body>
		<!-- As a heading -->
		<nav class="navbar navbar-light mb-5">
			<span class="navbar-brand mb-0 h1">My Notes</span>
		</nav>

		<div class="container-fluid">

<?= $this->session->userdata("add-note-success");?>
			<div class="alert note-alert"></div>

			<div class="row mt-5">
					<div class="col-md-4 mx-auto">
						<form action="notes/create" method="POST" class="add-note-form">
							<div class="form-group">
							
								<input type="text" class="form-control" id="title" name="title" placeholder="Title..." aria-describedby="title">
								
							</div>
							<div class="form-group">
								<textarea class="form-control" name="note" placeholder="Take a note..." id="note" rows="3"></textarea>
							</div>
							<button type="submit" class="btn-circle btn-primary add-note-button"><i class="fas fa-plus"></i></button>
							<div class="clear-fix"></div>
						</form>
					</div>
				</div>


				<div class="row notes mt-3">
				</div>
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
			crossorigin="anonymous"
		></script>
        <script>
            $(document).ready(function(){
                $.get('notes/index_html', function(res) {
                    $('.notes').html(res);
                });

				$('form').submit(function(){
					// there are three arguments that we are passing into $.post function
					//     1. the url we want to go to: '/quotes/create'
					//     2. what we want to send to this url: $(this).serialize()
					//            $(this) is the form and by calling .serialize() function on the form it will 
					//            send post data to the url with the names in the inputs as keys
					//     3. the function we want to run when we get a response:
					//            function(res) { $('#quotes').html(res) }
					$.post($(this).attr('action'), $(this).serialize(), function(res) {
						console.log("res");
						console.log(res);
						$('.notes').html(res);
						
						// if($("#title").val() =="" || ("#note").val() ==""){
						// 	// alert("please fix the following errors");
						// }else{	
						// 	$(".note-alert").html("A new note has been added successfully");
						// 	$(".note-alert").toggle()
						// 	$(".alert").addClass("alert-primary");
						// 	setTimeout(() => {
						// 		$(".note-alert").toggle();
						// 	}, 2500);
						// }

						$(".note-alert").html("A new note has been added successfully");
						$(".note-alert").toggle()
						$(".alert").addClass("alert-primary");
						setTimeout(() => {
							$(".note-alert").toggle();
						}, 2500);
						
					
						
						
					});

				
					$(this).trigger("reset");
					// We have to return false for it to be a single page application. Without it,
					// jQuery's submit function will refresh the page, which defeats the point of AJAX.
					// The form below still contains 'action' and 'method' attributes, but they are ignored.
					return false;
				});

				

				
            });
        </script>
	</body>
</html>
