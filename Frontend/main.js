window.onload= function (){

document.getElementById("button").onclick=function(){
var emailRegExp = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}/ ;   
var email_data=document.getElementById("emailText").value;
var name_data=document.getElementById("nameText").value;
var message_data=document.getElementById("messageText").value;
var name_inp=document.getElementById("nameText");
var email_inp=document.getElementById("emailText");    
if (email_data =="" && name_data == "")
{
            name_inp.className='errorBorders';
            name_inp.getAttributeNode('placeholder').value="Имя должно содержать минимум 3 символа";
            email_inp.className='errorBorders';
            email_inp.getAttributeNode('placeholder').value="Поле E-mail должно содержать @";
}
else if(name_data.length<3)
        {   
            name_inp.className='errorBorders';
            name_inp.value="Имя должно содержать минимум 3 символа";
           }
else if (email_data.search(emailRegExp)) {
     
            email_inp.className='errorBorders';
            email_inp.value="Поле E-mail должно содержать @";   
    alert('Поле E-mail должно содержать @');
    }
 else{
        
var new_div=document.createElement('div');
var message_p=document.createElement('p');
message_p.className=message_p.className+'message_p'; 
new_div.className=new_div.className+'messageView';   
var parent_div=document.getElementById("messageBox");
parent_div.insertBefore(new_div,parent_div.firstChild);     
new_div.appendChild(message_p);
message_p.innerHTML=message_data;      
    }
    };
};