function checkRaiseTopic(){

  if(($('#tp_title').val()==""||$('#ct').val()=="")&&document.getElementById("tp_title").value.length>12)	{
  	alert("请将内容填写完整，且话题标题长度不能超过12");
  	return false;
  }
  if($('#tp_title').val()==""||$('#ct').val()==""){
  	alert("请将内容填写完整!");
    return false;
  }
   if(document.getElementById("tp_title").value.length>12){
    alert("话题标题长度不能超过12");
    return false;
  }  
}


// var data=[{
//         "topic_id":1,
//         "topic_title":"1.体测系统开工啦！",
//         "topic_content":"<p>干活啦少年</p>",
//         "topic_replies":[{
//                 "reply_content":"请认真干活好吧哈哈！",
//           },
//           {
//                 "reply_content":"请认真干活好吧哈哈！",
//           }]
//       },
//      {
//         "topic_id":2,
//         "topic_title":"2.开工啦！",
//         "topic_content":"<p>干活啦</p>",
//         "topic_replies":[{
//                 "reply_content":"请认真干活！",
//         }],     	
//       },
//      {
//         "topic_id":2,
//         "topic_title":"3.开工啦！",
//         "topic_content":"<p>干活啦</p>",
//         "topic_replies":[{
//                 "reply_content":"请认真干活！",
//             },
//             {
//                 "reply_content":"请认真干活！",
//             },
//         ],     	
//       }
//     ]
//     var data1=[{
//          "id":1,
//         "name":"运动"
//     },
//     {
//          "id":1,
//         "name":"运动"
//     },
//     {
//          "id":2,
//         "name":"成绩"
//     }]
//  $(function(){	
//     window.onload=function(){
//     $.ajax({
//     		 	url: '/auth/topic/getAdd', 
//           type: 'GET', 
//           dataType: 'json', 
//           timeout: 1000, 
//           cache: false, 
//           success: succFunction
//     		 })
//        }
//      function succFunction(data_json){
//      		var data=eval(data_json.topic);
//     		var data1=eval(data_json.topic_type);
//         /*获取话题分类*/
//         var s=document.getElementById("selection");
//         for(var i=0;i<data1.length;i++){
//         var _option=document.createElement("option");
//         _option.value=data1[i].id;
//         _option.text= data1[i].name;  
//         s.appendChild(_option);
//      }
//    }
//   }
// });