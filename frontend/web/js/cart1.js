/*
@功能：购物车页面js
@作者：diamondwang
@时间：2013年11月14日
*/
function update(id,num) {
         $.getJSON('/cart/update-cart',{'id':id,'amount':num},function (data) {
               console.dir(data);
         })
}
$(function(){
    var total = 0;
    $(".col5 span").each(function(){
        total += parseFloat($(this).text());
    });
    $("#total").text(total.toFixed(2));
	//减少
	$(".reduce_num").click(function(){
		var amount = $(this).parent().find(".amount");
		if (parseInt($(amount).val()) <= 1){
			alert("商品数量最少为1");
		} else{
			$(amount).val(parseInt($(amount).val()) - 1);
		}
		var num = $(this).parent().find(".amount").val();
		var id = $(this).parent().parent().attr('id');
		update(id,num);
		//小计
		var subtotal = parseFloat($(this).parent().parent().find(".col3 span").text()) * parseInt($(amount).val());
		$(this).parent().parent().find(".col5 span").text(subtotal.toFixed(2));
		//总计金额
		var total = 0;
		$(".col5 span").each(function(){
			total += parseFloat($(this).text());
		});
		$("#total").text(total.toFixed(2));
	});

	//增加
	$(".add_num").click(function(){
		var amount = $(this).parent().find(".amount");
		$(amount).val(parseInt($(amount).val()) + 1);
		//小计
		var subtotal = parseFloat($(this).parent().parent().find(".col3 span").text()) * parseInt($(amount).val());
		$(this).parent().parent().find(".col5 span").text(subtotal.toFixed(2));
		//总计金额
		var total = 0;
		$(".col5 span").each(function(){
			total += parseFloat($(this).text());
		});

		$("#total").text(total.toFixed(2));
        var num = $(this).parent().find(".amount").val();
        var id = $(this).parent().parent().attr('id');
        update(id,num);
	});
	//直接输入
	$(".amount").blur(function(){
		if (parseInt($(this).val()) < 1){
			alert("商品数量最少为1");
			$(this).val(1);
		}
		//小计
		var subtotal = parseFloat($(this).parent().parent().find(".col3 span").text()) * parseInt($(this).val());
		$(this).parent().parent().find(".col5 span").text(subtotal.toFixed(2));
		//总计金额
		var total = 0;
		$(".col5 span").each(function(){
			total += parseFloat($(this).text());
		});

		$("#total").text(total.toFixed(2));
        var num = $(this).parent().find(".amount").val();
        var id = $(this).parent().parent().attr('id');
        update(id,num);
	});
});