function updateAdPanel(name, id) {

	$.ajax({
		type: "POST",
		url: "/Ads/displayPool/"+id+"/"+name,
		success: function (data) {
			$('#'+name).html(data);
		}
		});
		


}
//alert('loaded up man');