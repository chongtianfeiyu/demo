$(function(){
	user_check();
	// Tabs
	$('#tabs').tabs({
		//select: function(event, ui) {alert(event);}
	});
	$( "button").button();

});



/*用户相关*/
function user_master(){
	$( "#dialog:ui-dialog" ).dialog( "destroy" );
	$( "#user_master" ).dialog({
		resizable: true,
		height:250,
		width:450,
		modal: true,
		buttons: {
		"增加输入的用户": function() {
			var username=$("#username").val();
			var mastercode=$("#mastercode").val();
			$.get(URL+"/User/add", { username:username, mastercode:mastercode},
			function(data){
				if(data=='0'){
					alert('管理员密码不正确，请联系管理员！');
				}else{
					alert('加入用户成功，正在刷新页面！');
					document.location.href=REQUEST_URI;
				}
			});
		},
		"删除输入的用户": function() {
			var username=$("#username").val();
			var mastercode=$("#mastercode").val();
			$.get(URL+"/User/del", { username:username, mastercode:mastercode},
			function(data){
				if(data=='0'){
					alert('管理员密码不正确，请联系管理员！');
				}else{
					alert('删除用户成功，正在刷新页面！');
					document.location.href=REQUEST_URI;
				}
			});
		}
		}
	});
}

function user_swith(){
	$( "#dialog:ui-dialog" ).dialog( "destroy" );
	$( "#user_swith" ).dialog({
		resizable: true,
		height:200,
		width:450,
		modal: true,
		buttons: {
		"管理用户帐号": function() {
			$( this ).dialog( "close" );
			user_master();

		}
		}
	});
	$("#user_list").html('');
	$.getJSON(URL+"/User/loaduser",{},
	function(data){
		$.each(data,function(i){
			$("#user_list").append("<button onclick='do_user_swith("+data[i].id+");' title='点击就可以切换到了用户："+data[i].username+"'><span class='ui-icon ui-icon-person'></span>"+data[i].username+"</button>");
			$("button").button();
		})
	}
	);

}

function user_check(){
	$.get(URL+"/User/check",{},
	function(data){
		if(data=='0'){
			user_swith();
		}else{
			$('#login_username').html('<span class="ui-button-text">当前用户：'+data+'</span>');
		}
	}
	);
}

function do_user_swith(id){
	$.get(URL+"/User/swith",{uid:id},
	function(data){
		if(data=='0'){
			alert('没有找到用户！');
		}else{
			//$('#login_username').text='当前用户：'+data;
			document.location.href=REQUEST_URI;
		}
	}
	);
}
/*用户相关 end */

/*题库相关 */
function gettiku(type,page){

	$('#right_answer').hide();
	$('#foot_list').hide();
	$('#right_top').hide();

	$("#icons").html('');
	$.getJSON(URL+"/Tiku/IniTikuList",{type:type,page:page},
	function(data){
		$.each(data,function(i){
			if(i==0){
				var firstid=data[i].tid;
				getdetail(firstid,1);
			}
			$("#icons").append("<li id='"+data[i].tid+"' onclick='getdetail("+data[i].tid+","+data[i].id+");'>"+data[i].id+"</li>");
		})
	}
	);
	resettiku();

	$('#foot_list').show();
	$('#right_top').show();
}

function resettiku(){
	$('ul#icons li').hover(
	function(){$(this).addClass('ui-state-hover'); },
	function(){$(this).removeClass('ui-state-hover'); }
	);
}

function getdetail(tid,id){
	$('#icons li').removeClass('selli');
	$('#'+tid).addClass('selli');
	$.getJSON(URL+"/Tiku/detail",{tid:tid},
	function(data){
		$('#tid').val(tid);
		$('#id').val(id);
		$('#d_question').html(data.question);
		if(data.type=='判断'){
			$('#d_questioninfo').html('判断题没有选项！');
		}else{
			$('#d_questioninfo').html(data.questioninfo);
		}

		$('#d_num').html(id);
		$('#d_doanswer').html(data.answer);
		$('#d_answer').html(data.answer);
		$('#your_answer').html(data.myanswer);
		$('#d_obj').html(data.obj);
		$('#d_biztype0').html(data.biztype0);
		$('#d_biztype1').html(data.biztype1);
		$('#d_level').html(data.level);
		$('#d_type').html(data.type);
		fomat_answer(data.type);
		bin_answer(data.type);
		fomat_tools(data);

		$("#doanswer").buttonset();
		$("#tool").buttonset();

	}
	);
}

//根据题型产生输入形式
function fomat_answer(type){
	var text;
	if(type=='判断'){
		text='<input type="radio" id="pan0" name="pd" /><label for="pan0">正确</label>'+
		'<input type="radio" id="pan1" name="pd" /><label for="pan1">错误</label>';
	}else if(type=='单选'){
		text='<input type="radio" id="dan0" name="radio" /><label for="dan0">A</label>'+
		'<input type="radio" id="dan1" name="radio" /><label for="dan1">B</label>'+
		'<input type="radio" id="dan2" name="radio" /><label for="dan2">C</label>'+
		'<input type="radio" id="dan3" name="radio" /><label for="dan3">D</label>';
	}else if(type=='多选'){
		text='<input type="checkbox" id="A" name="A"  /><label for="A">A</label>'+
		'<input type="checkbox" id="B" name="B"  /><label for="B">B</label>'+
		'<input type="checkbox" id="C" name="C"  /><label for="C">C</label>'+
		'<input type="checkbox" id="D" name="D"  /><label for="D">D</label> '+
		'<input type="radio" id="sub3" /><label for="sub3">确认多选</label> '+
		'';
	}
	$('#doanswer').html(text);

}

function show_answer(d,tid,id){
	var next_tid,next_id;
	next_id=id*1+1;

	//因为是以0为起始的，所以不用加一;
	next_tid=$("#icons li:eq("+id+")").attr('id');
	var li_length=$('#icons li').length;
	//alert(next_tid);
	//alert(next_id);

	if(d=='Y'){
		$("#"+tid+"").html("<img src="+IMG+"y.gif>");
	}else{
		$("#"+tid+"").html("<img src="+IMG+"n.gif>");
	}
	if(id==li_length){
		alert('本题已是最后一题！');
	}else{
		getdetail(next_tid,next_id);
	}
}
function bin_answer(type){
	var tid,id;
	tid=$('#tid').val();
	id=$('#id').val();
	//alert(tid);
	//alert(id);
	if(type=='判断'){
		$( "#pan0" ).click(function() {
			$.get(URL+"/Tiku/getif",{tid:tid,id:id,an:'Y'},function(d){show_answer(d,tid,id);});
		});
		$( "#pan1" ).click(function() {
			$.get(URL+"/Tiku/getif",{tid:tid,id:id,an:'N'},function(d){show_answer(d,tid,id);});
		});
	}else if(type=='单选'){
		$( "#dan0" ).click(function() {
			$.get(URL+"/Tiku/getif",{tid:tid,id:id,an:'A'},function(d){show_answer(d,tid,id);});
		});
		$( "#dan1" ).click(function() {
			$.get(URL+"/Tiku/getif",{tid:tid,id:id,an:'B'},function(d){show_answer(d,tid,id);});
		});
		$( "#dan2" ).click(function() {
			$.get(URL+"/Tiku/getif",{tid:tid,id:id,an:'C'},function(d){show_answer(d,tid,id);});
		});
		$( "#dan3" ).click(function() {
			$.get(URL+"/Tiku/getif",{tid:tid,id:id,an:'D'},function(d){show_answer(d,tid,id);});
		});
	}else if(type=='多选'){
		$("#sub3").click(function() {
			var myids=new Array();
			var an;
			$("#doanswer label.ui-state-active").each(function(i,val){
				//$('#d_questioninfo').append(val);
				var tt=$(val).attr('for');

				if(tt!='sub3'){
					myids[i]=tt;
				}
			});
			an=myids.join(",");
			//alert(an);
			$.get(URL+"/Tiku/getif",{tid:tid,id:id,an:an},function(d){show_answer(d,tid,id);});
		});
	}
}

//根据内容产生工具操作
function fomat_tools(d){
	var ishide_text,iscool_text,issave_text,text;

	//是隐答案
	ishide_text=doishide();
	//是否冷宫
	iscool_text=doiscool(d.iscool);
	//是否保留
	issave_text=doissave(d.issave);

	tid=d.tid;

	text=ishide_text+iscool_text+issave_text;

	$('#tool').html(text);

	$( "#t0" ).click(function() {
		if($("#right_answer").is(":visible")==false){
			$("#right_answer").show("highlight");
			$("#t0").button( "option", "label", "隐藏答案" );
			$("#t0").button( "option", "checked", "checked" );
		}else{
			$("#right_answer").hide("highlight");
			$("#t0").button( "option", "label", "已隐答案" );
			$("#t0").button( "option", "checked", "" );
		}
	});

	$( "#t1" ).click(function() {
		$.get(URL+"/Tiku/doiscool",{tid:tid},
		function(data){
			if(data=='1'){
				$("#t1").button( "option", "label", "已入冷宫" );
				$("#t1").button( "option", "checked", "checked" );
			}else{
				$("#t1").button( "option", "label", "打入冷宫" );
				$("#t1").button( "option", "checked", "" );
			}
		}
		);
	});

	$( "#t2" ).click(function() {
		$.get(URL+"/Tiku/doissave",{tid:tid},
		function(data){
			if(data=='1'){
				$("#t2").button( "option", "label", "已经保留" );
				$("#t2").button( "option", "checked", "checked" );
			}else{
				$("#t2").button( "option", "label", "保留本题" );
				$("#t2").button( "option", "checked", "" );
			}
		}
		);
	});
}


function doishide(){
	if($("#right_answer").is(":visible")==false){
		return ' <input type="checkbox" id="t0" checked="checked" /><label for="t0">已隐答案</label>';
	}else{
		return ' <input type="checkbox" id="t0" /><label for="t0">显示答案</label>';
	}
}

function doiscool(d){
	//是否冷宫
	if(d=='1'){
		return ' <input type="checkbox" id="t1" checked="checked" /><label for="t1">已入冷宫</label>';
	}else{
		return ' <input type="checkbox" id="t1" /><label for="t1">打入冷宫</label>';
	}
}

function doissave(d){
	//是否保留
	if(d=='1'){
		return ' <input type="checkbox" id="t2" checked="checked" /><label for="t2">已经保留</label>';
	}else{
		return ' <input type="checkbox" id="t2" /><label for="t2">保留本题</label>';
	}
}
/*题库相关 end */