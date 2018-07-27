function validation()
{
    var a = document.getElementById("message");
    var b = document.getElementById("type_id");
    if(a.value.length==0)
    {
        b.innerHTML = "Type something";
    }
    else{
        b.innerHTML = "Typing";
    }
}