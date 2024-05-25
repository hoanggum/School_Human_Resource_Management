<?php
require __DIR__ . '../vendor/autoload.php';
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class VisitorCounter implements MessageComponentInterface {
    protected $clients;
    protected $visitorCount;
    protected $totalVisitors;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->visitorCount = 0;
        $this->totalVisitors = 0;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        $this->visitorCount++;
        $this->totalVisitors++; // Tăng cả tổng số lượt truy cập khi có kết nối mới mở
        $this->broadcastVisitorCount();
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        $this->visitorCount--;
        // Không giảm tổng số lượng truy cập khi kết nối đóng
        // Không broadcast ở đây
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // Không cần xử lý tin nhắn từ client
    }

    protected function broadcastVisitorCount() {
        foreach ($this->clients as $client) {
            $client->send(json_encode([
                'visitorCount' => $this->visitorCount,
                'totalVisitors' => $this->totalVisitors
            ]));
        }
    }
}

$server = new \Ratchet\App('localhost', 8080);
$server->route('/counter', new VisitorCounter, ['*']);
$server->run();
?>
