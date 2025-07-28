<?php
// WhatsApp Business API ile mesaj gönderme
function sendWhatsAppMessage($phone, $message) {
    // WhatsApp Business API endpoint
    $url = 'https://graph.facebook.com/v17.0/YOUR_PHONE_NUMBER_ID/messages';
    
    // Access token (WhatsApp Business API'den alınacak)
    $access_token = 'YOUR_ACCESS_TOKEN';
    
    // Mesaj verisi
    $data = [
        'messaging_product' => 'whatsapp',
        'to' => $phone,
        'type' => 'text',
        'text' => [
            'body' => $message
        ]
    ];
    
    // cURL ile API çağrısı
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $access_token,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return [
        'success' => $http_code === 200,
        'response' => $response,
        'http_code' => $http_code
    ];
}

// Form verilerini al
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message_text = $_POST['message'] ?? '';
    
    // WhatsApp mesajını oluştur
    $whatsapp_message = "🆕 Yeni Əlaqə Mesajı\n\n";
    $whatsapp_message .= "👤 Ad: {$name}\n";
    $whatsapp_message .= "📧 E-poçt: {$email}\n";
    $whatsapp_message .= "📞 Telefon: {$phone}\n";
    $whatsapp_message .= "📋 Mövzu: {$subject}\n\n";
    $whatsapp_message .= "💬 Mesaj:\n{$message_text}\n\n";
    $whatsapp_message .= "🌐 Səhifə: " . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    // WhatsApp'a gönder
    $result = sendWhatsAppMessage('380972580000', $whatsapp_message);
    
    if ($result['success']) {
        echo json_encode(['success' => true, 'message' => 'Mesaj uğurla göndərildi!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Mesaj göndərilə bilmədi. Xəta: ' . $result['response']]);
    }
}
?> 