'use strict'
$(document).ready(main)

function main(){
	contentTextPriceSelect()
	preparAjax()
}

function contentTextPriceSelect(){
	var textPrice = $('.text-price')
	textPrice.focus(function(){ this.setSelectionRange(0, this.value.length) })
	textPrice.mouseup(function(){ return false })
}

function htmlResult(html){
	var result = $('.result')
	result.html(html)
	preparAjax()
}

function preparAjax(){
	var buttons = $('.button-own')
	buttons.click(function(){
		console.log('bouton own')
		var ownId = $(this).parent().find('.ownId').val()
		var oldOwned = $(this).parent().find('.oldOwn').val()
		console.log(ownId)
		var options = {
			url: 'api/archi.php',
			method: 'POST',
			data: {
				ownId: ownId,
				oldOwned: oldOwned
			} 
		}
		$.ajax(options).done(htmlResult)
	})
}