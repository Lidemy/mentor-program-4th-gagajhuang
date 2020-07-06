//hw2：水仙花數

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

// 拿到所有資料
//1.先判斷幾位數  2.取出個別數字
function solve(lines) {
  // 5 200 → ['5', '200']
  let temp = lines[0].split(' ')
  let num01 = Number(temp[0])
  let num02 = Number(temp[1])
  for(let i=num01; i<=num02; i++) {
    if (isNarcissistic(i)) {
      console.log(i)
    }
  }
}
//回傳數字幾位數
function digitsCount(n){;
	if (n===0) return 1;
	//透過不停除以10，得知數字被除幾次，直到0為止
	let result = 0;//被除次數為0
	while (n!=0){
		n = Math.floor(n/10);//無條件捨去
		result++;//被除次數累加直到0停止
	}
	return result;
}
//1234 % 10 = 4
//123 % 10 = 3
//12 % 10 = 2
//1 % 10 = 1
//計算水仙花數↓↓↓
function isNarcissistic(n){
	let countN = n;//因為n會被拆解，所以另外宣告一個變數以防被改變
	let digits = digitsCount (n);//結果是幾位數?
	let sum = 0;
	while ( countN!=0){
		//取餘數
		let remainder = countN %10;
		sum +=remainder**digits;
		countN = Math.floor(countN/10);//數字慢慢拆解掉
	}
	
	//可簡化為 return sum === 0;
	if (sum ===n){
		return true;
	}else{
		return false;
	}
}