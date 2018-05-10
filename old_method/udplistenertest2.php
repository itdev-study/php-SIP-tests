 <?php
$address="192.168.254.101";
        $port=5060;
				$socket=socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
                socket_set_option($socket, SOL_SOCKET, SO_BROADCAST, 1);
                socket_set_option($socket, SOL_SOCKET, SO_KEEPALIVE, 1);
                socket_bind($socket,$address,$port);
				socket_connect($socket, '192.168.254.166', 5060 );
				
        while(true){
               
                $buf=socket_read($socket,2048,PHP_BINARY_READ);
				echo($buf);
				socket_write($socket, $buf, strlen($buf));
               // file_put_contents("logs/cstrike.log","$buf\n",FILE_APPEND);
        }
?> 
