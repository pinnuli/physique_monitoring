 //查询特定留言时信息是否填写完整
function checkSearch(){
	if(	$('#keyword_search').val().length>8){
		alert("关键字长度不能大于8");
		return false;
	}
	else{
		return true;
	}
}
//判断修改话题时信息是否填写完整，同上
function checkModify(){
    var m=$("input[name='topic_title']").val();
	if(m==""){
        alert("话题标题不能为空不能为空");
        return false;		
	}
	else if(m.length>6){
        alert("话题标题长度不能大于6");
        return false;		
	}
	else{
		return true;
	}
    }

// 判断回复话题时信息是否填写完整，同上
// function checkReply(a){
//     alert(a);
//     var k=document.getElementById(a);
//     alert(k.innerHTML);
// 	if(k.innerHTML==""){
//     		alert("回复内容不能为空！");
//     		return false;
//     	}
// 	return true;  		
// }


//确认删除话题
    function checkDelete(){
    	// var tp_id=document.getElementById("delete");
    	// var id=document.createElement("input");
    	// id.setAttribute("name","topic_id");
    	// id.setAttribute("type","hidden");
    	// id.setAttribute("value",topic_idRecod);
    	// tp_id.appendChild(id);
    	return true;
    }