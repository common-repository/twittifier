// JavaScript Document

function resetTextArea (objeto) {
	var msgs=new Array("usuario-twitter","123456","utilizame!","Escribe tu API Key","Del Blog:","#TrendTopic"); 
	var valor_obj = document.getElementById(objeto).value;
	
	for (i=0; i<msgs.length; i=i+1)
	{
		if (msgs[i] == valor_obj)
			document.getElementById(objeto).value="";
	}
}

jQuery(document).ready(function($) {
	setInterval("refreshTable()",5000); 

jQuery("#limpiat").click(function ($) {
								   if (confirm ("Eliminar todas las estadisticas excepto las requeridas por Twittifier"))
									  cleanTable ();
								  });

jQuery("#checkLogin").click(function ($) {
									  checkLogin ();
								  });
});

function refreshTable() {
	var url = location.href;
	jQuery.post(url,{ refresht: "1"}, function(data){
											  jQuery("#table").html(data);
											  return false;
											  
					});
	
}

function cleanTable() {
	var url = location.href;
	jQuery.post(url,{ refresht: "2"}, function (data) {
												if (data)
													alert ("Se eliminaron "+data+" registros");
													refreshTable();
					});
}

function checkLogin() {
	var url = location.href;
	jQuery.post(url,{ refresht: "3"}, function (data) {
												if (data)
													jQuery("#statusLogin").html(data);
					});
}