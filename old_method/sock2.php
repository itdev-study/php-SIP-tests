 <?php
error_reporting(E_ALL);

echo "<h2>TCP/IP Connection</h2>\n";

/* Get the port for the WWW service. */
//$service_port = getservbyname('www', 'tcp');

$service_port = '5060';

/* Get the IP address for the target host. */
//$address = gethostbyname('www.example.com');
$address = gethostbyname('192.168.254.166');


/* Create a TCP/IP socket. */
$socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
if ($socket < 0) {
    echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
} else {
    echo "OK.\n";
}

echo "Attempting to connect to '$address' on port '$service_port'...";
$result = socket_connect($socket, $address, $service_port);
if ($result < 0) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
} else {
    echo "OK.\n";
}

//$in = "HEAD / HTTP/1.1\r\n";
//$in .= "Host: www.example.com\r\n";
//$in .= "Connection: Close\r\n\r\n";

$in  = 'INVITE sip:192.168.254.166 SIP/2.0
Via: SIP/2.0/UDP 192.168.254.101:5060;branch=z9hG4bK584583368
From: "192.168.254.101" <sip:192.168.254.101@192.168.254.101>;tag=847215909
To: <sip:192.168.254.166@192.168.254.166:5060>
Call-ID: 368681527@192.168.254.101
CSeq: 1 INVITE
Contact: <sip:192.168.254.101@192.168.254.101:5060>
Content-Type: application/sdp
Allow: INVITE, INFO, PRACK, ACK, BYE, CANCEL, OPTIONS, NOTIFY, REGISTER, SUBSCRIBE, REFER, PUBLISH, UPDATE, MESSAGE
Max-Forwards: 70
User-Agent: Yealink SIP-T38G 38.70.14.5
Supported: replaces
Allow-Events: talk,hold,conference,refer,check-sync
Content-Length: 300

v=0
o=- 20022 20022 IN IP4 192.168.254.101
s=SDP data
c=IN IP4 192.168.254.101
t=0 0
m=audio 11782 RTP/AVP 0 8 18 9 101
a=rtpmap:0 PCMU/8000
a=rtpmap:8 PCMA/8000
a=rtpmap:18 G729/8000
a=fmtp:18 annexb=no
a=rtpmap:9 G722/8000
a=fmtp:101 0-15
a=rtpmap:101 telephone-event/8000
a=sendrecv';

$out = '';

echo "Sending HTTP HEAD request...";
echo('===============================');
echo($in);
echo('===============================');
socket_write($socket, $in, strlen($in));
echo "OK.\n";

echo "Reading response:\n\n";
while ($out = socket_read($socket, 2048)) {
    echo $out;
}

echo "Closing socket...";
socket_close($socket);
echo "OK.\n\n";
?> 
