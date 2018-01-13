/*
@功能：购物车页面js
@作者：diamondwang
@时间：2013年11月14日
*/
$(function(){
    // 声明一个全局变量用来储存总的金额
	var totalMoney=0;
    // 声明一个全局变量用来储存总的金额+运费
	var money=10.00;
	$(".total").each(function (i,v) {
       totalMoney+=parseInt($(v).text());
    })
	$("#totalAmount").text(totalMoney);
	$("#amountAll,#amountAlls").text(totalMoney+parseInt(money));
	//收货人修改
	$("#address_modify").click(function(){
		$(this).hide();
		$(".address_info").hide();
		$(".address_select").show();
	});

	$(".new_address").click(function(){
		$("form[name=address_form]").show();
		$(this).parent().addClass("cur").siblings().removeClass("cur");

	}).parent().siblings().find("input").click(function(){
		$("form[name=address_form]").hide();
		$(this).parent().addClass("cur").siblings().removeClass("cur");
	});

	//送货方式修改
	$("#delivery_modify").click(function(){
		$(this).hide();
		$(".delivery_info").hide();
		$(".delivery_select").show();
	})

	$("input[name=delivery]").click(function(){
		$(this).parent().parent().addClass("cur").siblings().removeClass("cur");
	});
	//运费的更改，
	$(".delivery_select table tr td input").click(function () {
		 money = $(this).parent().parent().find('.money').text();
		$("#freight").text(money);
        $("#amountAll,#amountAlls").text(totalMoney+parseInt(money));
    })

	$("input[name=pay]").click(function(){
		$(this).parent().parent().addClass("cur").siblings().removeClass("cur");
	});

	//发票信息修改
	$("#receipt_modify").click(function(){
		$(this).hide();
		$(".receipt_info").hide();
		$(".receipt_select").show();
	})

	$(".company").click(function(){
		$(".company_input").removeAttr("disabled");
	});

	$(".personal").click(function(){
		$(".company_input").attr("disabled","disabled");
	});

});