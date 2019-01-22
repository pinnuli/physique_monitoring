/**
 * http://blog.csdn.net/wangyi201212/article/details/42870009
 * @authors Your Name (you@example.org)
 * @date    2018-01-27 17:37:39
 * @version $Id$
 */
function checkKeyword(){
  if(document.getElementById("keyword").value.length>8){
    alert("关键字长度不能超过8");
    return false;
  }
  
}



	
		// var data=[{
  //       "topic_id":1,
  //       "topic_title":"1.体测系统开工啦！",
  //       "topic_content":"<p>干活啦少年</p>",
  //       "topic_replies":[{
  //               "reply_content":"请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！请认真干活好吧哈哈！",
  //         },
  //         {
  //               "reply_content":"请认真干活好吧哈哈！",
  //         }],
  //         "topic_sponsor":"hahahha"
  //     },
  //    {
  //       "topic_id":2,
  //       "topic_title":"2.开工啦！",
  //       "topic_content":"<p>干活啦</p>",
  //       "topic_replies":[{
  //               "reply_content":"请认真干活！",
  //       }], 
  //       "topic_sponsor":"hahahha"    	
  //     },
  //    {
  //       "topic_id":2,
  //       "topic_title":"3.开工啦！",
  //       "topic_content":"<p>干活啦</p>",
  //       "topic_replies":[{
  //               "reply_content":"请认真干活！",
  //           },
  //           {
  //               "reply_content":"请认真干活！",
  //           },
  //       ], 
  //       "topic_sponsor":"hahahha"    	
  //     }
  //   ]
  //   var data1=[{
  //        "id":1,
  //       "name":"运动"
  //   },
  //   {
  //        "id":1,
  //       "name":"运动"
  //   },
  //   {
  //        "id":2,
  //       "name":"成绩"
  //   }]
	
	
//   window.onload=function(){
//     		$.ajax({
//     			url: '/auth/topic/index', 
//                 type: 'GET', 
//                 dataType: 'json', 
//                 timeout: 1000, 
//                 cache: false, 
//                 success: succFunction
//     		})
//  }
// /*留言显示*/
//   function succFunction(data_json){
//     	var data=eval(data_json.topic);
//     	var data1=eval(data_json.topic_type);
//   		var s=document.getElementById("selection");
// 		  for(var i=0;i<data1.length;i++){
// 			var opt=document.createElement("option");
// 			opt.value=data1[i].name;
// 			opt.text=data1[i].name;  
// 			s.appendChild(opt);
//      }
// 			var appendtopic=document.getElementById("search_result_display");
//    	    	 appendtopic.innerHTML="";
// 			for(var i=0;i<data.length;i++){
// 				var result=document.createElement("li");
// 				var title=document.createElement("div");
// 				title.innerHTML="<strong>"+data[i].topic_sponsor+":&nbsp;&nbsp;&nbsp;"+"<strong>"+data[i].topic_title;
// 				result.appendChild(title);


//         var content=document.createElement("div");
// 				content.innerHTML="<strong>留言内容:</strong>"+data[i].topic_content;
// 				result.appendChild(content);

// 				// var pt=document.createElement("img");
// 				// pt.setAttribute("src","http://img.mukewang.com/52da54ed0001ecfa04120172.jpg");//插入图片
// 				// pt.style="width: 157px; height: 145px;";
// 				// result.appendChild(pt);

//         var replies=document.createElement("div");
//         var rp=document.createElement("p");
// 			  rp.innerHTML="<strong>管理员回复：</strong>";
// 				replies.appendChild(rp);
//                 for(var j=0;j<data[i].topic_replies.length;j++){
//                 	var rp=document.createElement("p");
// 				    rp.innerHTML=data[i].topic_replies[j].reply_content;
// 				    replies.appendChild(rp);
//                 }
//                 result.appendChild(replies);

// 				appendtopic.appendChild(result);
// 			} 
// }

//    	    $("#search").click(function(){
//    	    	var tp=document.getElementById("selection");
//    	    	var tpy=tp.options[tp.selectedIndex].text;
//    	    	var kw=document.getElementById("keyword").value;
 
//    	    		$.ajax({
//    	    		url: '/auth/topic/index', 
//    	    		data:{topic_type:tpy,keyword:kw},
//             type: 'GET', 
//             dataType: 'json', 
//             timeout: 1000, 
//             cache: false, 
//             success:succFunction
//    	    	})
  
//          })


 

