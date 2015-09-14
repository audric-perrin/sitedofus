'use strict'
$(document).ready(main)

function main(){
	contentTextPriceSelect()
	searchGrow()
	test()
}

function contentTextPriceSelect(){
	var textPrice = $('.text-price')
	textPrice.focus(function(){ this.setSelectionRange(0, this.value.length) })
	textPrice.mouseup(function(){ return false })
}

function searchGrow(){
	var search = $('.text-search')
	var sizeSearch
	search.focus(function(){ 
		sizeSearch = 150
		var sizeCss = {
			width: sizeSearch
		}
		console.log(sizeSearch)
		$(this).animate(sizeCss, 500)
	})
	search.blur(function(){
		var valueSearch = search.val()
		if (valueSearch == ""){
			sizeSearch = 80
		}
		else{
			sizeSearch = 150
		}
		var sizeCss = {
			width: sizeSearch
		}
		console.log(sizeSearch)
		$(this).animate(sizeCss, 500)
	})
}

function test(){
	var button = $('.button-test')
	button.click(function(){
		console.log('salut')
		$.ajax({
			url: 'index.php'
		}).done(function(html){
			console.log(html)
		})
	})
}