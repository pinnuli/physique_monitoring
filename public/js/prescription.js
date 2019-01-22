
	function prescription(a,b){
		var A=a;
		var B=b;
        show(A, B);
    }
    function prescription1(a,b){
        if(a=='男'){
            var A='引体向上';
        }
        if(a=='女'){
            var A='仰卧起坐';
        }
        var B=b;
        show(A,B);
    }
    function prescription2(a,b){
        if(a=='男'){
            var A='1000米跑';
        }
        if(a=='女'){
            var A='800米跑';
        }
        var B=b;
        show(A,B);
    }
    function show(A,B){
		var grade=document.getElementById('p_grade');
		grade.innerHTML=" ";
		            
		var purpose=document.getElementById('p_purpose');
		purpose.innerHTML="  ";
		var event=document.getElementById("p_event");
		event.innerHTML="  ";
		var intensity=document.getElementById("p_intensity");
		intensity.innerHTML="  ";
		var time=document.getElementById("p_time");
		time.innerHTML="  ";
		var freq=document.getElementById("p_frequency");
		freq.innerHTML="    ";
        
		$.ajax({
        type: "GET",//方法类型
        dataType:'json',
        // dataType: "json",//预期服务器返回的数据类型
        url:"/auth/prescription",//url
        data:{"item":A,"grade":B},   
        success: function (result) {
            // console.log(result);//打印服务端返回的数据(调试用)
           var data=eval(result);
            if (result.code == 200) {           	
            	console.log(data);

            	grade.innerHTML=data.prescription.item_grade;
            	            
            	purpose.innerHTML=data.prescription.sport_purpose;

            	event.innerHTML=data.prescription.sport_event;

            	intensity.innerHTML=data.prescription.sport_intensity;

            	time.innerHTML=data.prescription.sport_time;

            	freq.innerHTML=data.prescription.frequency;



            }
        },
        error : function() {
            alert("异常！");
        }
    });
	 }