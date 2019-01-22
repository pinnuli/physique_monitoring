/*添加管理员验证*/
     function test(){
        var per=/[0-9a-zA-Z]{6,20}/;
        var tt=document.getElementById("name");
        if(tt.value==""){
            document.getElementById("test_name").innerHTML="用户名不能为空";
            document.getElementById("test_name").style.color="red";
        }
                 document.getElementById("test_password").style.color="black";
                 document.getElementById("test_password").innerHTML=" ";
    }
    function change(){
        document.getElementById("test_name").innerHTML=" ";
    }
    function test1(){
        var kk=document.getElementById("password1");
        var pp=document.getElementById("name");
        if(kk.value==""&&pp.value==""){
            document.getElementById("test_name").innerHTML="用户名不能为空";
            document.getElementById("test_name").style.color="red";
            document.getElementById("test_password").innerHTML="密码不能为空";
            document.getElementById("test_password").style.color="red";
        }
        else if(kk.value==""){
            document.getElementById("test_name").innerHTML="用户名不能为空";
            document.getElementById("test_name").style.color="red";         
        }
        else if(kk.value.length<6||kk.value.length>20){
            document.getElementById("test_password").innerHTML="密码由6-20位字符组成";
            document.getElementById("test_password").style.color="red";
        }
        document.getElementById("test_password_again").innerHTML=" ";
    }

    function check(){
        var pass=document.getElementById("password1");
        var v=document.getElementById("password2");
        var me=document.getElementById("name");
        if(me.value==""||(pass.value.length<6)||(pass.value.length>20)||pass.value==""){
            if(me.value==""&&pass.value==""){
            document.getElementById("test_name").innerHTML="用户名不能为空";
            document.getElementById("test_name").style.color="red";
            document.getElementById("test_password").innerHTML="密码不能为空";
            document.getElementById("test_password").style.color="red";
                     }
             if(me.value==""){
            document.getElementById("test_name").innerHTML="用户名不能为空";
            document.getElementById("test_name").style.color="red";
            }
                    if(pass.value==""){
                    document.getElementById("test_password").innerHTML="密码不能为空";
            document.getElementById("test_password").style.color="red";
                    }
                               if(pass.value.length<6||pass.value.length>20){
            document.getElementById("test_password").style.color="red";
                    }
                    return false;
                  }
                  if(v.value==""||(pass.value!=v.value)||pass.value==""){
                    if(v.value==""&&pass.value==""){
                    document.getElementById("test_password").innerHTML="密码不能为空";
            document.getElementById("test_password").style.color="red"; 
            return false;            
                              }
                    else if(v.value==""){
            document.getElementById("test_password_again").innerHTML="请重复输入密码,以确认无误！";
            document.getElementById("test_password_again").style.color="red";
                    }
                      else{
            document.getElementById("test_password_again").innerHTML="两次密码输入不同，请重新输入！";
            document.getElementById("test_password_again").style.color="red";
                     }
                    return false;
                  }
                 return true;
    }