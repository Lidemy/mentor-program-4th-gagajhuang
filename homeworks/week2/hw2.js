function capitalize(str) {
	let result ="";
	let code = str.charCodeAt(0);
	if (code>=97 && code<=122){
		result += String.fromCharCode(code - 32);//小寫轉大寫
		// console.log(result);
		for(let i=1;i<str.length;i++){
			result += str[i];
		}
		// console.log(result);
		return result;
	}else{
		return str;//不做動作直接輸出
	}
	//return str.charAt.toUpperCase() + str.slice(1) 同學解答
}

console.log(capitalize('hello'));
