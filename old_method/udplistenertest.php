 <?php
$socket = stream_socket_server("udp://0.0.0.0:5060", $errno, $errstr);

if (!$socket) {
    die("$errstr ($errno)\n");
}

while ($connect = stream_socket_accept($socket, -1)) {
    fwrite($connect, "HTTP/1.1 200 OK\r\nContent-Type: text/html\r\nConnection: close\r\n\r\nПривет");
    fclose($connect);
}

fclose($socket);
?> 
