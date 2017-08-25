<html>
<body onload="updateScroll()">
<head><script src="https:/ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script></head>
<script src="https:/ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<style>

@import "https:/fonts.googleapis.com/css?family=Open+Sans:400,600,700";
* {
    box-sizing: border-box;
}
body {
background: none repeat scroll 0 0 #fff;
color: #FFFFFF;
font-family: "Open Sans";
line-height: 26px;
width: 400px;
margin: 0 auto;
overflow: hidden;
position: relative;
}
#inner{
width: 100%;
height 100%;
overflow: auto;
psdding right: 15px;
}
.bottom {
 width: 400px;
 height: 50px;
 position: fixed;
 bottom: 0px;
 border-top: 1px solid #CCC;
 background-color: #EBEBEB;
}
.msginput {
 padding: 5px;
 margin: 10px;
 font-size: 14px;
 width: 380px;
 outline: none;
}
.left {
  position: absolute;
  top: 0;
  left: 35px;
  font-size: 18px
}
.left:after {
 border: 3px solid #2095FE;
 border-right: 3px solid transparent;
 border-top: 3px solid transparent;
 content: " ";
 height: 14px;
 left: -20px;
 position: absolute;
 top: 20px;
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  transform: rotate(45deg);
    width: 14px;
}
.list{
padding: 5px;
overflow: auto;
height: 100%;
padding-bottom: 40px;
width: 400px;
}
.right {
  position: absolute;
  top: 0;
  right: 15px;
  font-size: 18px
}
header {
color: #2095FE;
background: #eee;
border: 1px solid #ccc;
border-bottom: 1px solid #bbb;
box-shadow: 0 1px 2px rgba(1,1,1,0.2);
height: 60px;
text-align: center;
font-size: 20px;
line-height: 58px;
white-space: nowrap;
position: relative;
display: none;
}
header h2 {
  font-weight: bold;
  color: #111111;
}
.messages-wrapper {
position: relative;
border-top: 0 none;
height: 100%;
padding-right: 20px;
}
.message {
border-radius: 20px 20px 20px 20px;
margin: 0 15px 10px;
padding: 5px 20px;
position: relative;
}
.message.to {
background-color: #2095FE;
color: #fff;
margin-left: 80px;
}
.message.from {
background-color: #E5E4E9;
color: #363636;
margin-right: 80px;
}
.message.to + .message.to,
.message.from + .message.from {
  margin-top: -7px;
}
.message:before {
border-color: #2095FE;
border-radius: 50% 50% 50% 50%;
border-style: solid;
border-width: 0 20px;
bottom: 0;
clip: rect(20px, 35px, 42px, 0px);
content: " ";
height: 40px;
position: absolute;
right: -50px;
width: 30px;
z-index: -1;
}
.message.from:before {
border-color: #E5E4E9;
left: -50px;
transform: rotateY(180deg);
}
</style>
<?php ?>

<header><span class="left">Messages</span><p>Jonathan Ive</p><span class="right">Contact</span></header>
<div class="messages-wrapper"><div id="inner">
<ul id="mylist" style="list-style-type:none" class="list" onload="updateScroll()">
</ul>
</div>
<form><div class="bottom"><input type="text" onsumbit"sendmsg()" name="msginput" class="msginput" id="msginput" value="" placeholder="send a msg..."/></div>
</form>
</div>
<script>

document.body.onload = function(){
var element = document.getElementById("mylist");
element.scrollTop = element.scrollHeight;
}

function updateScroll(){
var element = document.getElementById("mylist");
element.onscroll = function(){
setTimeout(function (){}, 5000);
}
 element.scrollTop = element.scrollHeight;
}

function foo(){

var ourRequest = new XMLHttpRequest();
ourRequest.open('GET', 'msg_grabber.php', true);
ourRequest.send();

ourRequest.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
var ourData = JSON.parse(ourRequest.responseText);
var both = troll(ourData);
var from = both[0];
var to = both[1];
var messg_stack = update(from, to);
messgPrinter(messg_stack);
}
};
}//foo

var to = [];
var from = [];

function troll(ourData){
while(ourData.length > 0){
var tmp = ourData.pop();
var res = tmp.split("");
if(res[0] === "*"){
var fin = tmp.split("*");
to.push(fin[1]);
} else { from.push(tmp); }
}//while
var both = [from, to];
return both;
}//troll

class messg{
constructor(id, msg, right){
this.id = id;
this.msg = msg;
this.right = right;
}
}

function update(left_stack, right_stack){

var messg_left_stack = [];
var messg_right_stack = [];

while(left_stack.length > 0){
var item = left_stack.pop();
var res = item.split("~");
var id = res[0];
var m = res[1];
let tmp = new messg(id, m, false);
messg_left_stack.push(tmp);
}
while(right_stack.length > 0){
var it = right_stack.pop();
var r = it.split("~");
var idd = r[0];
var mes = r[1];
let tmpr = new messg(idd, mes, true)
messg_right_stack.push(tmpr);
}

while(messg_right_stack.length > 0){messg_left_stack.push(messg_right_stack.pop());}
var master = messg_left_stack;
master.sort(function(a, b){return b.id - a.id;});

return master;
}//update()

var o;//declared for print
function messgPrinter(messg_stack){

class messg{
constructor(id, msg, right){
this.id = id;
this.msg = msg;
this.right = right;
}
}
//t is how many items to print
if(o == null || o < 0){o = 0;}
var n = messg_stack.length;
var t = n - o;
o = o + t;

for(var i=0; i<t; i++){
if(t==1){
var item = messg_stack[0];
} else { var item = messg_stack.pop(); }

if(item.right){
var nodee = document.createElement("li");
var tmpp = item.msg;
var textnodee = document.createTextNode(tmpp);
nodee.className = "message to";
nodee.setAttribute("id", "e4");
nodee.appendChild(textnodee);
document.getElementById("mylist").appendChild(nodee);
}
if(item.right == false){
var node = document.createElement("li");
var tmp = item.msg;
var textnode = document.createTextNode(tmp);
node.className = "message from";
node.setAttribute("id", "e4");
node.appendChild(textnode);
document.getElementById("mylist").appendChild(node);
}
}//for
}//messgPrinter

function sendmsg(){
var message = msginput.value;
window.location.href = "send_to_db.php?name=" + message;
updateScroll();
}//sendmsg function

document.getElementById('msginput').onkeypress = function(e){
if (!e) e = window.event;
var keyCode = e.keyCode || e.which;
if (keyCode == '13'){
sendmsg();
return false;
}
}
setInterval(function(){ foo()}, 300);
setInterval(function(){ updateScroll()}, 1000);
</script>
</body>
</html>

