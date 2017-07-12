<?php         
$sendStr = '30 32 30 34 03 30 33';  
// 16进制数据
$sendStrArray = str_split(str_replace(' ', '', $sendStr), 2); 
// 将16进制数据转换成两个一组的数组
$socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname("tcp"));
// 创建Socket
        
if (socket_connect($socket, "192.168.1.100", 8080)) {
  //连接             
for ($j = 0; $j < count($sendStrArray); $j++) {                 
	socket_write($socket, chr(hexdec($sendStrArray[$j])));  
	// 逐组数据发送             
}
            $receiveStr = ""; 
            $receiveStr = socket_read($socket, 1024, PHP_BINARY_READ);  
			// 采用2进制方式接收数据             
			$receiveStrHex = bin2hex($receiveStr);  
			// 将2进制数据转换成16进制
            echo "client:" . $receiveStrHex;         
}         socket_close($socket);  
// 关闭Socket         