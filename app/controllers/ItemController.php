<?php
require_once __DIR__ . '/../models/Item.php';

class ItemController
{
    public function read($id = null)
    {
        $item = new Item();
        if ($id) {
            $stmt = $item->readById($id);
            if ($stmt) {
                $items = $stmt->fetch(PDO::FETCH_ASSOC);
                echo json_encode($items);
            } else {
                echo json_encode(["message" => "Failed to retrieve item"]);
            }
        } else {
            $stmt = $item->read();
            if ($stmt) {
                $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($items);
            } else {
                echo json_encode(["message" => "Failed to retrieve items"]);
            }
        }
    }

    // 添加其他方法來處理POST、PUT、DELETE請求
    // public function create() { ... }
    // public function update() { ... }
    // public function delete() { ... }
}
?>