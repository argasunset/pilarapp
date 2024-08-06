<?php
include 'config.php';

if (isset($_POST['id']) && isset($_POST['status'])) {
    $userId = intval($_POST['id']);
    $newStatus = intval($_POST['status']);

    $query = "UPDATE pelanggan SET status = $newStatus WHERE id = $userId";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }
    mysqli_close($conn);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid parameters']);
}
?>
