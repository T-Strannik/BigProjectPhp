jQuery(function($) {
  $('#target').Jcrop({
  	aspectRatio: 1, //добавили параметры для плагина с оф сайта http://deepliquid.com/content/Jcrop.html
  	onSelect: showCoords,
      onChange: showCoords
  });

  function showCoords(c){
	// variables can be accessed here as
	// c.x, c.y, c.x2, c.y2, c.w, c.h
		$('input[name=x]').val(c.x);
		$('input[name=y]').val(c.y);
		$('input[name=w]').val(c.w);
		$('input[name=h]').val(c.h);
	};



});