var dataset = [];
var data =document.getElementById("demo").innerHTML = dataset;


function prepare(){

var data =document.getElementById("demo").innerHTML = dataset;
	data.sort(function(a, b){return a - b});


}
function add() {
	var data =document.getElementById("demo").innerHTML = dataset;
		data.sort(function(a, b){return a - b});


  var x=document.getElementById('newnum').value;
    var patt1 = /[1-9]/g;
    var result = x.match(patt1);
if (result) {


   dataset.push(x);
    document.getElementById("demo").innerHTML = dataset;

}else{


alert('lütfen sayı giriniz');
}



 
}

function median(){
	var data =document.getElementById("demo").innerHTML = dataset;
var median=0;
var len=data.length;
data.sort(function(a, b){return a - b});
if (data.length % 2 ==0) {

   alert(data[(len-1)/2] - data[(len/2)/2] );
}else{

 alert(data[(len-1)/2]);
}}



function  findrange(){
var data =document.getElementById("demo").innerHTML = dataset;
data.sort(function(a, b){return a - b});

   alert(data[data.length -1 ]- data[0]  );


}





function variance()
{

var len = 0;
var sum = 0;

var data =document.getElementById("demo").innerHTML = dataset;
data.sort(function(a, b){return a - b});
var leth=data.length-1;

   for(var i=0;i<data.length;i++)
  {
      
        len = len + 1;
        sum = sum + parseFloat(data[i]);
        
}
var mean =sum / len;
var v=0;
   for(var i=0;i<data.length;i++)
  {
      
       v=v+(data[i]-mean )*(data[i]-mean )
        
}

alert(v / leth); 
}



//calculate the mean of a number array
function mean()
{
var len = 0;
var sum = 0;

var data =document.getElementById("demo").innerHTML = dataset;
data.sort(function(a, b){return a - b});


   for(var i=0;i<data.length;i++)
  {
      
        len = len + 1;
        sum = sum + parseFloat(data[i]);
        
}
alert (sum / len);
}

function devitaion(){

var len = 0;
var sum = 0;

var data =document.getElementById("demo").innerHTML = dataset;
data.sort(function(a, b){return a - b});
var leth=data.length-1;

   for(var i=0;i<data.length;i++)
  {
      
        len = len + 1;
        sum = sum + parseFloat(data[i]);
        
}
var mean =sum / len;
var v=0;
   for(var i=0;i<data.length;i++)
  {
      
       v=v+(data[i]-mean )*(data[i]-mean )
        
}


alert(Math.sqrt(v / leth)); 

}

function mode(){
var datas =document.getElementById("demo").innerHTML = dataset;
datas.sort(function(a, b){return a - b});

 var modes = [], count = [], i,datas, maxIndex = 0;
 
    for (i = 0; i < datas.length; i += 1) {
       data = datas[i];
        count[data] = (count[data] || 0) + 1;
        if (count[data] > maxIndex) {
            maxIndex = count[data];
        }
    }
 
    for (i in count)
        if (count.hasOwnProperty(i)) {
            if (count[i] === maxIndex) {
                modes.push(Number(i));
            }
        }
 
    alert(modes);


}