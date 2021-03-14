<!DOCTYPE html>
<html>
<head>
	<title>INTERFACE ADMIN</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class="container" data-appurl="{{env("APP_URL")}}">
	<div class="d-flex flex-column align-items-center mt-3">
		<h3>INTERFACE ADMIN</h3>
		<div class="alert alert-danger alert-dismissible fade show my-3" id="alert-error" role="alert">
		  Le rêve est déjà publié ou n'existe pas !
		  <button type="button" class="close" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
			<div class="alert alert-success alert-dismissible fade show my-3" id="alert-success" role="alert">
		  Le rêve a été publié !
		  <button type="button" class="close" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
			<input type="text" placeholder="access_id du rêve" id="access_id" name="access_id" />
			<button class="mt-2" id="button-publish">Valider</button>


	</div>
</div>

<style>
	body
	{
		background-color: lightgrey;
	}

	.alert
	{
		display: none;
	}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
	$(function() {
    const appUrl = $(".container").data("appurl");
    $("#button-publish").click(async ()=>{
    	$(".alert").hide()
    	const accessId = $("#access_id").val();
    	if(accessId)
    	{
    		let res = await $.get(appUrl+"/api/publish_dream/"+accessId)
    		if(res.error)
    		{
    			$('#alert-error').show()
    		}
    		if(res.success)
    		{
    			$('#alert-success').show()
    		}
    	}
    })

    $(".close").click(function () { $(".alert").hide()})
});

</script>

</body>
</html>