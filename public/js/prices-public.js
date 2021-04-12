jQuery(document).ready(function($){

	var priceData = {
		product:null,
		jobAmount:0,
		staffAmount:0,
		recruitPrice:0,
		staffPrice:0,
		discount: 0,
		discountRemoved: 20,
		fullPrice: 0,
		totalPrice: 0,
		support:"standard",
		supportPrice:0,
		addons:[],
	}

	initialData = priceData;
	

	runCheckHash();

	

	// var windowHeight = $( window ).height();
	// var position = windowHeight - 170;
	// // $('.ba_price_summary-container').css({bottom:'-' + position + 'px'});
	// console.log(windowHeight);
	// $( window ).resize(function() {
	// windowHeight = $( window ).height();
	// console.log(windowHeight);
	// position = windowHeight - 170;
	// // $('.ba_price_summary-container').css({bottom:'-' + position + 'px'});
	// });
	



	function runCheckHash(){

		priceData = {
			product:null,
			jobAmount:0,
			staffAmount:0,
			recruitPrice:0,
			staffPrice:0,
			discount: 0,
			discountRemoved: 20,
			fullPrice: 0,
			totalPrice: 0,
			support:"standard",
			supportPrice:0,
			addons:[],
		}


		$('#staffAmount').val('');
		$('#recruitments').val(0);
		$('#staffAmountContainer').removeClass('mg-right');
		$('#staffAmountContainer').removeClass('active');
		$('#recruitmentsSelectContainer').removeClass('active');
		$('.each-support').removeClass('active');
		$('.each-support[data-support="standard"]').addClass('active');
		$('.each_featured_addon').removeClass('active');
		$('.single-addon-input').prop('checked', false);
		$('.ba_price_summary-container').removeClass('scrolledTo')

		if(window.location.hash) {
			var hash = window.location.hash;
			console.log(hash);
			if(hash === "#recruit"){
				showRecruit();
				$('#checkoutContainer').addClass('active');
			}
			if(hash === "#staff"){
				showStaff();
				$('#checkoutContainer').addClass('active');
			}
			if(hash === "#suite"){
				showBoth();
				$('#checkoutContainer').addClass('active');
			}
			if(hash === "enterprise"){
	
			}
		} else {
			$('#baCardsView').addClass('active');
		}
	}

	function showRecruit(){
		console.log("RAN");
		priceData.product = "recruit";
		$('#recruitmentsSelectContainer').addClass('active');
		$('.single-addon[data-product="recruit"]').addClass('show');
		$('.single-addon[data-product="both"]').addClass('show');

		renderPrices();
	}

	function showStaff(){
		console.log("RAN");
		priceData.product = "staff";
		$('#staffAmountContainer').addClass('active');
		$('.single-addon[data-product="staff"]').addClass('show');
		$('.single-addon[data-product="both"]').addClass('show');

		renderPrices();
	}

	function showBoth(){
		priceData.product = "suite";
		priceData.discount = 20;

		$('#recruitmentsSelectContainer').addClass('active');
		$('#staffAmountContainer').addClass('active');
		$('#staffAmountContainer').addClass('mg-right');
		$('.single-addon').addClass('show');

		renderPrices();
	}





	function renderRecruitPrice(){
		var minPrice = parseInt(recruitProduct.minPrice);
		var pricePerJob = parseInt(recruitProduct.pricePerJob);
		var totalPrice = parseInt(priceData.jobAmount) * pricePerJob;

		if(totalPrice <= minPrice){
			totalPrice = minPrice;
		}
		priceData.recruitPrice = totalPrice
		var html = `
		<div class="each-basic-price">
			<div>HR-ON Recruit</div>
			<div class="summary-price">From ${numberToNiceString(totalPrice)}</div>
		</div>
		`;
		return html;
	}

	function renderStaffPrice(){
		var minPrice = parseInt(staffProduct.minPrice);
		var pricePerUser = parseInt(staffProduct.pricePerUser);
		var totalPrice = parseInt(priceData.staffAmount) * pricePerUser;

		if(totalPrice <= minPrice){
			totalPrice = minPrice;
		}
		priceData.staffPrice = totalPrice
		var html = `
		<div class="each-basic-price">
			<div>HR-ON Staff</div>
			<div class="summary-price">From ${numberToNiceString(totalPrice)}</div>
		</div>
		`;
		return html;
	}

	function renderSupport(){
		if(priceData.support === "standard"){
			var price = standardSupport.price;
			var title = standardSupport.title;
		}else if(priceData.support === "silver"){
			var price = silverSupport.price;
			var title = silverSupport.title;
		}else if(priceData.support === "gold"){
			var price = goldSupport.price;
			var title = goldSupport.title;
		}
		var html = `
		<div class="each-basic-price" id="supportPrice">
			<div>Support - ${title}</div>
			<div class="summary-price">${numberToNiceString(price)}</div>
		</div>
		<div id="addonsPriceContainer">
		</div>
		`;
		return html;
	}

	function renderAddons(){
		$('#addonsSummaryContainer').empty();
		if(priceData.addons.length >= 1){
			$('#addonsSummaryContainer').append(`
			<div class="price-label">
				Addons
			</div>
			<div id="addonsPriceContainer">
			`)

			priceData.addons.forEach(addon => {

				$('#addonsSummaryContainer').append(`
				<div class="each-basic-price">
					<div>${addon.title}</div>
					<div class="summary-price">${numberToNiceString(addon.price)}</div>
				</div>
					`)
			});
		}
	}




	function renderPrices(){
		$('#basicPriceContainer').empty();
		if(priceData.product === "suite" || priceData.product === "recruit"){
			$('#basicPriceContainer').append(renderRecruitPrice());
		}
		if(priceData.product === "suite" || priceData.product === "staff"){
			$('#basicPriceContainer').append(renderStaffPrice());
		}
		$('#basicPriceContainer').append(renderSupport());
		$('#addonsSummaryContainer').append(renderAddons())

		var fullPrice = priceData.recruitPrice + priceData.staffPrice + priceData.supportPrice;

		priceData.addons.forEach(function(addon){
			fullPrice += addon.price;
		})
		$('#finalSummary').empty();
		$('#mobileHeaderPrice').empty();
		if(priceData.discount >= 1){
			var priceRemoved = fullPrice * priceData.discount / 100;
			var totalPrice = fullPrice - priceRemoved;

			priceData.fullPrice = fullPrice;
			priceData.totalPrice;

			$('#finalSummary').append(`
			<div class="each-summary-price">
				<div>Full price:</div>
				<div class="summary-price">From ${numberToNiceString(fullPrice)}</div>
			</div>
			<div class="each-summary-price">
				<div>Discount - ${priceData.discountRemoved}%:</div>
				<div class="summary-price">${numberToNiceString(priceRemoved)}</div>
			</div>
			<div class="each-summary-price each-full-price">
				<div>Total price:</div>
				<div class="summary-price">From <span class="ba_product_price" /> ${numberToNiceString(totalPrice)}</span> yearly</div>
			</div>
			`)
			$('#mobileHeaderPrice').append(`${numberToNiceString(totalPrice)}`);
		}else{
			$('#finalSummary').append(`
			<div class="each-summary-price each-full-price">
				<div>Total price:</div>
				<div class="summary-price">From <span class="ba_product_price" /> ${numberToNiceString(fullPrice)}</span> yearly</div>
			</div>
			`)
			$('#mobileHeaderPrice').append(`${numberToNiceString(fullPrice)}`);
		}

		
	}


	function numberToNiceString(nStr, languge = "danish")
	{
		if(parseInt(nStr) <= 0 || nStr === null){
			return "Free";
		}
		if(languge === "danish"){
			nStr += '';
			x = nStr.split(',');
			x1 = x[0];
			x2 = x.length > 1 ? ',' + x[1] : '';
			var rgx = /(\d+)(\d{3})/;
			while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + '.' + '$2');
			}
			return x1 + x2 + ' kr.';
		}else{
			nStr += '';
			x = nStr.split('.');
			x1 = x[0];
			x2 = x.length > 1 ? '.' + x[1] : '';
			var rgx = /(\d+)(\d{3})/;
			while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + ',' + '$2');
			}
			return x1 + x2 + ' kr.';
		}
		
	}

	function removeElementAddon(array, id) {
		var index = null;
		array.forEach(function(el,i){
			if(el.id === id){
				index = i;
			}
		})
		if (index > -1) {
			array.splice(index, 1);
		}

		return array;
	}







	$(document).on('click', '.ba_special_collapse_button', function(e){
		$parent = $(this).parent().parent();
		if($parent.hasClass('active')){
			$parent.removeClass('active');
		}else{
			$parent.addClass('active');
		}
	})

	$(document).on('click', '#backToProducts', function(e){
		$('#checkoutContainer').addClass('fade-out-bottom');
		setTimeout(function(){
			$('#checkoutContainer').removeClass('active');
			$('#checkoutContainer').removeClass('fade-out-bottom');
			$('#baCardsView').addClass('active');
			window.location.hash = '';
			runCheckHash();
		}, 400);
	})


	$(document).on('click', '.ba_cards_button', function(e){
		e.preventDefault();
		var link = $(this).attr("data-linkid")
		window.location.hash = link;

		$('#baCardsView').addClass('fade-out-bottom');
		setTimeout(function(){
			$('#baCardsView').removeClass('active');
			$('#baCardsView').removeClass('fade-out-bottom');
			$('#checkoutContainer').addClass('active');
			runCheckHash();
		}, 400);
	})

	$(document).on('keyup', '#staffAmount', function(e){
		e.preventDefault();
		if(this.value === null || this.value === NaN || this.value === ""){
			priceData.staffAmount = 0;
		}else{
			priceData.staffAmount = this.value;
		}
		renderPrices();
	})

	$(document).on('change','#recruitments',function(e){
		e.preventDefault();
		priceData.jobAmount = this.value;
		renderPrices();
	})

	$(document).on('click', '.each-support', function(e){
		$('.each-support').removeClass('active');
		$(this).addClass('active');
		priceData.support = $(this).attr('data-support');
		priceData.supportPrice = parseInt($(this).attr('data-price'));
		title = $(this).attr('data-title');

		renderPrices();
	})



	

	$(document).on('click','.each_featured_addon',function(e){
		var addon = {
			title: $(this).attr('data-title'),
			price: parseInt($(this).attr('data-price')),
			id: $(this).attr('data-myid')
		}
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			priceData.addons = removeElementAddon(priceData.addons, addon.id);

		}else{
			$(this).addClass('active');
			priceData.addons.push(addon);
		}
		renderPrices();

	})

	$(document).on('change','.single-addon-input',function(e){
		var addon = {
			title: $(this).attr('data-title'),
			price: parseInt($(this).attr('data-price')),
			id: $(this).attr('data-myid')
		}
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			priceData.addons = removeElementAddon(priceData.addons, addon.id);
		}else{
			$(this).addClass('active');
			priceData.addons.push(addon);
		}

		renderPrices();

	})

	$(document).on('click', '#finalSummaryMobileHeader', function(e){
		if(!$('.ba_price_summary-container').hasClass('scrolledTo')){
			
			
			if($('.ba_price_summary-container').hasClass('mobile-active')){
				$('.ba_price_summary-container').removeClass('mobile-active');
				$("html").css({ overflow: 'inherit' })
			}else{
				$('.ba_price_summary-container').addClass('mobile-active');
				$("html").css({ overflow: 'hidden' })
			}
		}
	})



	$.fn.followTo = function(pos){
		var $this = this;
		var $window = $(window);

			$window.scroll(function(e){
				var windowHeight = $window.height();
				var anchorOffset = $('.mobile-ancher').offset();
				var stickPos = (anchorOffset.top - windowHeight + 70);
				if($window.scrollTop() > stickPos){
					$this.addClass('scrolledTo');
				}else{
					$this.removeClass('scrolledTo');
				}
			})
		
	}

	$('.ba_price_summary-container').followTo(123);

})

