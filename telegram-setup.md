# Telegram Bot Kurulum Rehberi

## 1. Telegram Bot Oluşturma

1. **BotFather'a mesaj gönderin:**
   - Telegram'da @BotFather'ı arayın
   - `/newbot` komutunu gönderin
   - Bot adını girin (örn: "OstWindGroup Contact Bot")
   - Bot kullanıcı adını girin (örn: "ostwindgroup_contact_bot")

2. **Bot Token'ını alın:**
   - BotFather size bir token verecek
   - Bu token'ı kopyalayın

## 2. Chat ID Alma

1. **Bot'a mesaj gönderin:**
   - Oluşturduğunuz bot'a gidin
   - Herhangi bir mesaj gönderin

2. **Chat ID'yi alın:**
   - Bu URL'yi tarayıcıda açın:
   ```
   https://api.telegram.org/botYOUR_BOT_TOKEN/getUpdates
   ```
   - `YOUR_BOT_TOKEN` yerine bot token'ınızı yazın
   - JSON yanıtında `chat_id` değerini bulun

## 3. Kod Güncelleme

`telegram-send.php` dosyasında şu satırları güncelleyin:

```php
$bot_token = 'YOUR_BOT_TOKEN'; // Bot token'ınızı buraya yazın
$chat_id = 'YOUR_CHAT_ID'; // Chat ID'nizi buraya yazın
```

## 4. Test Etme

1. Formu doldurun ve gönderin
2. Telegram'da bot'unuza mesaj geldiğini kontrol edin
3. E-posta da gönderildiğini kontrol edin

## 5. Güvenlik

- Bot token'ınızı güvenli tutun
- Token'ı public repository'de paylaşmayın
- Gerekirse bot'u private yapın

## 6. Özellikler

- ✅ E-posta gönderimi
- ✅ Telegram mesaj gönderimi
- ✅ HTML formatında mesajlar
- ✅ Emoji desteği
- ✅ Hata kontrolü
- ✅ Başarı mesajları

## 7. Sorun Giderme

**Bot mesaj göndermiyorsa:**
1. Token'ın doğru olduğunu kontrol edin
2. Chat ID'nin doğru olduğunu kontrol edin
3. Bot'a en az bir mesaj gönderdiğinizi kontrol edin
4. Bot'un aktif olduğunu kontrol edin

**E-posta gelmiyorsa:**
1. Sunucu mail ayarlarını kontrol edin
2. Spam klasörünü kontrol edin
3. Hosting sağlayıcınızla iletişime geçin 