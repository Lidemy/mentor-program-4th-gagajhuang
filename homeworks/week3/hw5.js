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
function solve(lines){
	for(var i = 1; i < lines.length; i++){
	    var temp = lines[i].split(' ');
	    var A = temp[0];//擷取出第一個字
	    var B = temp[1];//擷取出第二個字
	    var K = temp[2];//擷取出第三個字，獲勝條件：1 代表數字大，-1 代表數字小

	    //console.log(A,B,K);
	    console.log(compare(A,B,K));
	}
}
function compare(A,B,K){
	//先把數字當成 string 處理，就可以使用 length 當做幾位數的大小比較
	if (A === B) return 'DRAW';
	if(K === '1'){
	    if(A.length === B.length){
	    	return A > B ? 'A' : 'B';
	    }
	    return A.length > B.length ? 'A' : 'B';
	}
	if(K === '-1'){
	    if(A.length === B.length){
	    	return A < B ? 'A' : 'B';
	    }
	    return A.length < B.length ? 'A' : 'B';
	};
}

// solve([3,'1 2 1','1 2 -1','2 2 1'])