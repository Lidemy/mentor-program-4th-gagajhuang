function capitalize(str) {
	let result ="";
	for(let i=0;i<str.length;i++){
		let code = str.charCodeAt(i);//可知 ASCll code 是多少
		if (code>=97 && code<=122){
			result += String.fromCharCode(code - 32);//小寫轉大寫
		}else{
			result +=str[i];//不做動作直接輸出
		}
	}
	// console.log(result);
	return result;
	//return str.charAt.toUpperCase() + str.slice(1) 同學解答
}

console.log(capitalize('hello'));
