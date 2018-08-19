$( document ).ready( function () {
	
	jQuery.validator.addMethod("campo", function(value, element, param) {
		var snp_registro = $('#snp_registro').val();
		if (snp_registro == "" && value == "") {
			return false;
		}else{
			return true;
		}
	}, "Debe indicar el SNP registro o el No. Documento para poder realizar la consulta.");

	$("#snp_registro").convertirMayuscula().maxlength(20);
	$("#no_documento").bloquearTexto().maxlength(12);
	
	$( "#form" ).validate( {
		rules: {
			anio: 			{ required: true },
			prueba: 		{ required: true },
			snp_registro:	{ minlength: 4, maxlength: 20 },
			no_documento:	{ minlength: 4, maxlength: 12, campo: "#snp_registro"}
		},

		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );
			error.insertAfter( element );

		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (form) {
			return true;
		}
	});
	
	$("#btnSubmit").click(function(){		
		if ($("#form").valid() == true){
			var form = document.getElementById('form');
			form.submit();	
		}else
		{
			//alert('Error.');
		}
	});

});