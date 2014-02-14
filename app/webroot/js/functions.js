/**
* remover(str, subs): Remove de 'str' as ocorrencias de 'subs'
*/
function remover(str, subs) {
	i = str.indexOf(subs);
	r = "";
	if (i == -1) return str;
	r += str.substring(0,i) + remover(str.substring(i + subs.length), subs);
	return r;
} 
		
/**
* validaCPF( cpf ): valida 'cpf'
*/
function validaCPF( cpf ) {
	cpf = remover(cpf,"_");
	
	if (cpf.length == 14) {

		var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;
		if (!filtro.test(cpf)){
			return false;
		}
   
	   cpf = remover(cpf, ".");
	   cpf = remover(cpf, "-");
    
		if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
			cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
			cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
			cpf == "88888888888" || cpf == "99999999999") {
                return false;
		}

		soma = 0;
		for (i = 0; i < 9; i++) {
			soma += parseInt(cpf.charAt(i)) * (10 - i);
		}
		resto = 11 - (soma % 11);
		if (resto == 10 || resto == 11) {
			resto = 0;
		}
		
		if (resto != parseInt(cpf.charAt(9))) {
            return false;
		}
		
		soma = 0;
		for(i = 0; i < 10; i ++) {
			soma += parseInt(cpf.charAt(i)) * (11 - i);
		}
		resto = 11 - (soma % 11);
		if(resto == 10 || resto == 11) {
			resto = 0;
		}
		if (resto != parseInt(cpf.charAt(10))) {
            return false;
		}
		return true;
	}
}

/**
* buscaEndereco( get_cep ): Busca o Endereço Completo de 'get_cep'
*/
function buscaEndereco( get_cep ) {
	var retorno = null;
	var cep = remover( get_cep, '-' );
	if (cep != '') {	   
		$.ajax({
			url: URL_BASE + "ajax/buscaCep",
			data: { 'cep' : cep },
			async: false,
            type: 'POST',
            beforeSend: function() { dialogLoading(); },
            complete: function() { closeLoading(); },
			dataType: "json",
			success: function(data) {
				if (data.resultado!=0) {
					retorno = data;	
				}
			}
		});
	}
	return retorno;
}

/**
* comparaData( data1, data2 ): Compara se data1 é maior que data2
*/
function comparaData( data1, data2 ) {
	
	var arr_data1 = data1.split( "/" );
	var arr_data2 = data2.split( "/" );
	
	if ( parseInt( arr_data1[2].toString() + arr_data1[1].toString() + arr_data1[0].toString() ) < parseInt( arr_data2[2].toString() + arr_data2[1].toString() + arr_data2[0].toString() ) ) {
  		return true;
	} else {
  		return false;
	}
}

function dialog( titulo, msg ) {
	$('#dialog_system').html( msg );
	$("#dialog_system").dialog({
		autoOpen: false,
		title: titulo,
		bgiframe: true,
		modal: true,
		resizable: false,
		draggable: false,
        open: function(event,ui){
            $(this).closest('div.ui-dialog').find('button').addClass('btn');
                $(this).closest('div.ui-dialog').find('button.ui-dialog-titlebar-close').addClass('entypo-icon-cancel ');
        },
		buttons: {
			'Ok': function() {
				$(this).dialog('close');
			}
		}
	 });
	 $("#dialog_system").dialog('open');
}
function closeDialog() { $('#dialog_system').dialog('close'); }

function dialogLoading() {
	$("#dialog_loading").dialog({
		autoOpen: false,
		title: 'Carregando...',
		bgiframe: true,
		modal: true,
		dialogClass: 'dialog',
		resizable: false,
		draggable: false,
        open: function(event,ui){
            $(this).closest('div.ui-dialog').find('button').addClass('btn');
            $(this).closest('div.ui-dialog').find('button.ui-dialog-titlebar-close').addClass('entypo-icon-cancel ');
        }
	 });
	 $("#dialog_loading").dialog('open');
}
function closeLoading() { $('#dialog_loading').dialog('close'); }

function validaCampo( elemento, boo, msg ) {
    if (!msg) { msg = 'Campo Obrigatório'; }
    if (boo) {
        elemento.removeClass('error').next('label.error').remove();
        
    } else {
        if (!elemento.hasClass('error')) {
            elemento
                .addClass('error')
                .after('<label class="error">' + msg + '</label>');            
        }
    }
}

function abreMenu() {
	mainNav = $('.mainnav>ul>li');
	mainNavCurrent = mainNav.find('a.current');
    
    if ( mainNavCurrent.length>0 ) {
        obj = mainNavCurrent.closest('ul').prev('a');
        
        obj.trigger('click');        
        //alert( obj.html() );
    }
}

/**
* validaEmail( email ): valida 'email'
*/
function validaEmail( email ) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

/**
* validaCNPJ( cnpj ): valida 'cnpj'
*/
function validaCNPJ( cnpj ) {
	cnpj = cnpj.replace('.','');
    cnpj = cnpj.replace('.','');
    cnpj = cnpj.replace('.','');
    cnpj = cnpj.replace('-','');
    cnpj = cnpj.replace('/','');
    
    var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
    digitos_iguais = 1;
    if (cnpj.length < 14 && cnpj.length < 15) {
        return false;
    }
    for (i = 0; i < cnpj.length - 1; i++) {
        if (cnpj.charAt(i) != cnpj.charAt(i + 1)) {
            digitos_iguais = 0;
            break;
        }
    }
    if (!digitos_iguais) {
        tamanho = cnpj.length - 2
        numeros = cnpj.substring(0,tamanho);
        digitos = cnpj.substring(tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2){
                pos = 9;
            }
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0)) {
            return false;            
        }
        tamanho = tamanho + 1;
        numeros = cnpj.substring(0,tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2) {
                pos = 9;                
            }
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1)) {
            return false;            
        }
        return true;
    } else {
        return false;
    }
}
