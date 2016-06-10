//connection.js
var conn;
function init(){
    console.log("function : init");
    conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function() {
        console.log(conn);
        var co = document.getElementById("connection");
        co.innerHTML="Connection established !";
    };
    conn.onmessage = function(e) {
        console.log(conn);
        var content = document.getElementById("chat");
        content.innerHTML = content.innerHTML + "<li>"+ e.data+"</li>";
    };
    conn.onclose = function(){
        console.log(conn);
        var co = document.getElementById("connection");
        co.innerHTML="Connection closed !";
    }
    conn.onerror = function(){
        alert("Connection failed : There is no server on this port !");
    }
}
function closeCon(){
    conn.close();
}
function sendMessage(){
    var mes = document.getElementById("message").value;
    if(mes != ""){
        conn.send(mes, function(event){
            event.preventDefault();
            console.log(event);
        } );
    }
}