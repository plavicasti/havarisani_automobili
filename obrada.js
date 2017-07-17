$(document).ready(function(){

	$("#odjava").click(function(){
		$.ajax({
			url: "/havarisani_automobili/skripte/odjava.php",
			complete: function(){
				window.location = "/havarisani_automobili/index.php"
			}
		})

	})

})