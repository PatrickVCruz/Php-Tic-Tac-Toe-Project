var x = "";
var s = "";
var last ="";
var pid;
var i=0;

onmessage = function s(e) {
    x =e.data;  
};

function refresh() {
        if(x == "ERROR-NOMOVES"){
            postMessage("You can play");
        }
        else {
            s = x.split("\n");
            last = s[s.length-1];
            pid = last.split(",");
            postMessage(pid[0]);
        }
        setInterval("refresh()",1000);
}
    
refresh();    


