//hw1：好多星星

var readline = require('readline');
var rl = readline.createInterface({
  input: process.stdin
});

var lines = [2]

rl.on('line', function (line) {
  lines.push(line)
});

rl.on('close', function() {
  solve(lines)
})
function solve(lines) {
   let star = Number(lines[0]);
    for (let i=1;i<=star;i++){
      printStar(i)
  }
}
function printStar(n){
	let sum = '';
	for (let i=1;i<=n;i++){
		sum +='*'
	}
	console.log(sum) 
}


