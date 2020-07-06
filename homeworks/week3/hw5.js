//hw5：聯誼順序比大小
var readline = require('readline');
var rl = readline.createInterface({
  input: process.stdin
});

var lines = []

rl.on('line', function (line) {
  lines.push(line)
});

rl.on('close', function() {
  solve(lines)
})

/*3
  1 2 1
  1 2 -1
  2 2 1*/
function solve(lines) {

	for(var i = 1; i < lines.length; i++){
	    var temp = lines[i].split(' ');
	    var A = Number(temp[0]);//擷取出第一個數字
	    var B = Number(temp[1]);//擷取出第二個數字
	    var K = Number(temp[2]);//擷取出第三個數字，獲勝條件：1 代表數字大，-1 代表數字小
	    //console.log(A,B,K);
	    console.log(compare(A,B,K));
	}
  		
}
function compare(A,B,K){
	if(A === B) return 'DRAW'
	if(K === 1){
	    if(A > B){
	    	return 'A';
	    }else {
	    	return 'B';
	    }
	}else{
	    if(A < B){
	    	return 'A';
	    }else{
	    	return 'B';
	    }
	}
}

solve([3,'1 2 1','1 2 -1','2 2 1'])