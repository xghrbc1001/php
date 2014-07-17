// random color
function randomColor(){
	return '#'+('00000'+(Math.random()*0x1000000<<0).toString(16)).slice(-6);
}

// popup html
var POPUP_HTML='<div id="popup"><table>';
POPUP_HTML+='		<tr><td>';
POPUP_HTML+='			<label for="username" class="label">Title:</label></td><td>';
POPUP_HTML+='			<input id="title" name="title" type="text" class="input" /></td>';
POPUP_HTML+='		</tr>';
POPUP_HTML+='		<tr><td>';
POPUP_HTML+='			<label for="content" class="label">Content:</label></td><td>';
POPUP_HTML+='			<textarea id="content" name="content" rows="15" cols="100" class="input text"></textarea></td>';
POPUP_HTML+='		</tr>';
POPUP_HTML+='	<tr><td>';
POPUP_HTML+='			<label for="star" class="label">isStar:</label></td><td>';
POPUP_HTML+='	<input type="checkbox" id="star" /></td>';
POPUP_HTML+='	</tr>';
POPUP_HTML+='	<tr><td colspan="2" style="text-align:center">';
POPUP_HTML+='	<input type="button" value="Finish" class="btn" id="btnFinish" onclick="add();" /></td>';
POPUP_HTML+='	</tr>';
POPUP_HTML+='</table></div>';

function loadData(){
	var url='todolist/list.php?uid='+uid;
	$.ajax({ 
		type: "GET", 
		url: url, 
		datatype: "json",
		success: function(data){
			var contentHtml="";
			var dataObj=eval("("+data+")");
			var pre=0;
			$.each(dataObj,function(i,d){
				if(d.parent_id==0 && pre==0){
					contentHtml+='<li class="toggle"><a href="javascript:void(0)" class="lev1" >'+d.title+'</a>&nbsp;&nbsp;<a href="javascript:void(0)" class="addnew add" parent_id='+d.id+'>add new</a>';
				}
				if(d.parent_id!=0 && pre!=0){
					if(d.star==0){
						contentHtml+='<li><a href="javascript:void(0)" class="lev2" >'+d.title+'</a>&nbsp;&nbsp;<a href="javascript:void(0)" class="edit" tid='+d.id+' parent_id='+d.parent_id+'><img src="imgs/edit.png" /></a>';
					}else{
						contentHtml+='<li><a href="javascript:void(0)" class="lev2" >'+d.title+'</a>&nbsp;&nbsp;<a href="javascript:void(0)" class="edit" tid='+d.id+'  parent_id='+d.parent_id+'><img src="imgs/edit.png" /></a>&nbsp;<img src="imgs/star.png" />';
					}
				}
				if(d.parent_id==0 && pre!=0){
					contentHtml+='</ul><li class="toggle"><a href="javascript:void(0)" class="lev1" >'+d.title+'</a>&nbsp;&nbsp;<a href="javascript:void(0)" class="addnew add" parent_id='+d.id+'>add new</a>';
				}
				if(d.parent_id!=0 && pre==0){
					if(d.star==0){
						contentHtml+='<ul><li><a href="javascript:void(0)" class="lev2" >'+d.title+'</a>&nbsp;&nbsp;<a href="javascript:void(0)"  class="edit" tid='+d.id+'  parent_id='+d.parent_id+'><img src="imgs/edit.png" /></a>';
					}else{
						contentHtml+='<ul><li><a href="javascript:void(0)" class="lev2" >'+d.title+'</a>&nbsp;&nbsp;<a href="javascript:void(0)" class="edit" tid='+d.id+'  parent_id='+d.parent_id+'><img src="imgs/edit.png" /></a>&nbsp;<img src="imgs/star.png" />';
					}
				}
				pre=d.parent_id;
			});
			$("#todolist").html(contentHtml);
			$(".lev1").each(function(){
    				$(this).css("color",randomColor());
  			});
			$(".toggle").click(function() {
				$(this).find("ul").slideToggle();
			});
			$('.add').on('click', function(){
			    parent_id=$(this).attr("parent_id");
			    $.layer({
				type: 1,
				title: false, 
				shade: [0], 
				area: ['600px', '400px'],
				page: {html: POPUP_HTML}
			    });
			});
			$('.edit').on('click', function(){
	    			parent_id=$(this).attr("parent_id");
	    			tid=$(this).attr("tid");
				$.ajax({ 
					type: "GET", 
					url: "todolist/view.php?id="+tid, 
					success: function(data){
		   				var dataObj=eval("("+data+")");
					    	$.layer({
							type: 1,
							title: false, 
							shade: [0], 
							area: ['600px', '400px'],
							page: {html: POPUP_HTML}
					        });
						$("#title").val(dataObj.title);
						$("#content").val(dataObj.content);
						if(dataObj.star==0){
							console.log(0);
							$("#star").attr("checked",false);
						}else{
							console.log(1);
							$("#star").attr("checked",true);
						}

					}
				});
			});
		}
	});
}

$(function() {


	loadData();
});

function add(){
	var data='id='+tid+'&title='+$("#title").val()+'&content='+$("#title").val()+'&star=';
	if($("#star").is(":checked")){
		data+='1';
	}else{
		data+='0';
	}
	data+='&parent_id='+parent_id+'&user_id='+uid;
	$.ajax({ 
		type: "POST", 
		url: "todolist/add.php", 
		data: data,
		success: function(data){
			layer.closeAll();
			layer.msg('Saved success!', 2, -1);
			loadData();
		}
	});
}
$('#addLv1').on('click', function(){
    parent_id=$(this).attr("parent_id");
    $.layer({
	type: 1,
	title: false, 
	shade: [0], 
	area: ['600px', '400px'],
	page: {html: POPUP_HTML}
    });
});
