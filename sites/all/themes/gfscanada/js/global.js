$(document).ready(function() {
	$("a:has(img.imagecache-product_category_image_list)").wrap('<div class="drop-shadow" style="float: none;"><div class="drop-shadow-outer"><div class="drop-shadow-inner"></div></div></div>');
	$("a:has(img.imagecache-our_brands_image_list)").wrap('<div class="drop-shadow" style="float: none;"><div class="drop-shadow-outer"><div class="drop-shadow-inner"></div></div></div>');
  $(".drop-shadow-inner").prepend('<div class="drop-shadow-top-left"></div><div class="drop-shadow-top-right"></div><div class="drop-shadow-bottom-left"></div><div class="drop-shadow-bottom-right"></div>');

  $("#edit-search-block-form-1-wrapper input:text").focus(function() {
  var element = $(this);
  element.attr("rel",element.val());
  element.val('');
  });
  $("#edit-search-block-form-1-wrapper input:text").blur(function() {
  var element = $(this);
  if (element.val() == '') {
  element.val(element.attr("rel"));
  }
  });
  
  $("#msds-search-form input:text").focus(function() {
  var element = $(this);
  element.attr("rel",element.val());
  element.val('');
  });
  $("#msds-search-form input:text").blur(function() {
  var element = $(this);
  if (element.val() == '') {
  element.val(element.attr("rel"));
  }
  });

  $("#search-form #edit-keys-wrapper input:text").focus(function() {
  var element = $(this);
  element.attr("rel",element.val());
  element.val('');
  });
  $("#search-form #edit-keys-wrapper input:text").blur(function() {
  var element = $(this);
  if (element.val() == '') {
  element.val(element.attr("rel"));
  }
  });

});

function chopit(number, places) {
	x = Math.round(number * Math.pow(10,places))/Math.pow(10,places)+"";
	if (x.indexOf(".") != -1){
	y = x.substring(0,x.indexOf("."))
	}
	else y=x
	z = "";
	while (y.length > 3) {
	  z = "," + y.substring(y.length-3,y.length) +z;
	  y = y.substring(0,y.length-3); 
	}
	if (z.length > 0) {
	  z = y.substring(y.length-3,y.length) +z; 
	}
	else z=y;
	if (x.indexOf(".") != -1){
	z += x.substring(x.indexOf("."),x.length);	
	}
	if (z.indexOf(".") != -1){
		while (z.length <= (z.indexOf(".")+ places))
			{
			z=z + "0"
			}
	}
	else {
		if (places > 0) z=z+".00"
		}
	return(z)
}

function removecomma(x)
{
	y= "";
	for (i=0;i <= x.length;i++)
		{
		if (x.substring(i,i+1) != ",")
			{
			y=y+ x.substring(i,i+1);
			}
		}
	x = parseFloat(y);
	return (x);
}

function update(){
	document.fvf.priceperpound.value = chopit(document.fvf.pricesource.value , 4)
	document.fvf.weight.value = 100
	document.fvf.rawcost.value = chopit(document.fvf.pricesource.value *100, 4)
	document.fvf.wage.value = chopit(document.fvf.wagesource.value, 2)
	document.fvf.exodus.value = .0758
	document.fvf.laborperhour.value = chopit(0.0758 * document.fvf.wagesource.value, 4)
	document.fvf.poundsoproducts.value = 100
	document.fvf.laborcostst.value = chopit(document.fvf.laborperhour.value*100, 2)
	document.fvf.oilprice.value = chopit(document.fvf.oilsource.value, 4)
	document.fvf.oilperproduct.value = .1308
	document.fvf.oilcostperoundprod.value = chopit(document.fvf.oilsource.value*.0327, 4)
	document.fvf.poundsopie.value = 100
	document.fvf.totoilcost.value = chopit(document.fvf.oilcostperoundprod.value * 100, 2)

	document.fvf.totcosts.value = chopit(removecomma(document.fvf.rawcost.value) + removecomma(document.fvf.laborcostst.value) + removecomma(document.fvf.totoilcost.value), 2)
	document.fvf.raw.value = 100
	document.fvf.costperlbrawtot.value = chopit(document.fvf.totcosts.value / 100, 4)
	document.fvf.servingsperpound.value = 1.6352
	document.fvf.costsperservings.value = chopit((document.fvf.costperlbrawtot.value /1.6352), 4)

	document.fvf.priceperpound2.value = chopit(document.fvf.frysource.value,4)
	document.fvf.weight2.value = 100
	document.fvf.rawcost2.value = chopit(removecomma(document.fvf.frysource.value)*100,2)
	document.fvf.wage2.value = chopit(document.fvf.wagesource.value, 2)
	document.fvf.exodus2.value = .0361
	document.fvf.laborperhour2.value = chopit(.0361 * document.fvf.wagesource.value, 4)
	document.fvf.poundsoproducts2.value = 100
	document.fvf.laborcostst2.value = chopit(document.fvf.laborperhour2.value*100, 2)
	document.fvf.oilprice2.value = chopit(document.fvf.oilsource.value, 4)
	document.fvf.oilperproduct2.value = 0.0872
	document.fvf.oilcostperoundprod2.value = chopit(document.fvf.oilsource.value*0.0218, 4)
	document.fvf.poundsopie2.value = 100
	document.fvf.totoilcost2.value = chopit(document.fvf.oilcostperoundprod2.value * 100, 2)

	document.fvf.totcosts2.value = chopit(removecomma(document.fvf.rawcost2.value) + removecomma(document.fvf.laborcostst2.value) + removecomma(document.fvf.totoilcost2.value), 2)
	document.fvf.raw2.value = 100
	document.fvf.costperlbrawtot2.value = chopit(removecomma(document.fvf.totcosts2.value) / 100, 4)
	document.fvf.servingsperpound2.value = 2.3264
	document.fvf.costsperservings2.value = chopit((removecomma(document.fvf.costperlbrawtot2.value) /2.3264), 4)

	document.fvf.advan.value =chopit(removecomma(document.fvf.costsperservings.value) - removecomma(document.fvf.costsperservings2.value), 4)
	document.fvf.servingstotperday.value = removecomma(document.fvf.sourcesevings.value)
	document.fvf.savingperstoreperday.value = chopit(removecomma(document.fvf.advan.value) * removecomma(document.fvf.sourcesevings.value), 2)
	document.fvf.days.value =360
	document.fvf.savingserperyearperstore.value =chopit((removecomma(document.fvf.savingperstoreperday.value) * 365), 2)
	document.fvf.stoersnumber.value= document.fvf.storessource.value
	document.fvf.wow.value = chopit((removecomma(document.fvf.stoersnumber.value) * removecomma(document.fvf.savingserperyearperstore.value)), 2)	
}
