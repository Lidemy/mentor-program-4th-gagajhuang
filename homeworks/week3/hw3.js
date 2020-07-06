//hw3：判斷質數

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

//判斷是否為質數
function isPrime(n){
    if(n===1) return false;//1不是質數 先將1排除
    for(let i = 2;i < n; i++){
        if(n % i === 0){
            return false;//如果全部都能被n整除，就不是質數
        }//如果這裡放 true，會導致不能被某數字整除，但是卻是非質數的值
    }
    return true;
}

function solve(lines) {
  for(let i = 1; i < lines.length; i++){
  	let num = Number(lines[i]);
    if(isPrime(num)){
        console.log("Prime")
    }else{
        console.log("Composite")
    }
  }	
}
solve([5,1,2,3,4,5]);