  #include <SPI.h>
  #include <MFRC522.h>
  #include <ESP8266WiFi.h>
  #include <ESP8266HTTPClient.h>

  #define SS_PIN D8
  #define RST_PIN D0
  MFRC522 rfid(SS_PIN, RST_PIN); // Instance of the class
  MFRC522::MIFARE_Key key;
  // Init array that will store new NUID
  byte nuidPICC[4];

  //----------------------------------------SSID and Password of your WiFi router--------------------------------------//
  const char* ssid = "manhhung";
  const char* password = "12345678";

  // const char* ssid = "Wifi Nha";
  // const char* password = "0393709493";

  // const char* ssid = "ThaoAnhNhi_2.4G";
  // const char* password = "chung!@#$%19102130";

  const char* apiKeyValue = "tPmAT5Ab3j7F9";
  WiFiClient client;
  void setup() {
    Serial.begin(115200);
    Serial.println("-------------------------------------------");
    Serial.println("Connecting to WiFi...");
    WiFi.begin(ssid, password);
    while (WiFi.status() != WL_CONNECTED) {
      delay(1000);
      Serial.println("Connecting...");
    }
    Serial.println("Connected to WiFi");
    SPI.begin(); // Init SPI bus
    rfid.PCD_Init(); // Init MFRC522
    Serial.println();
    Serial.print(F("Reader: "));
    rfid.PCD_DumpVersionToSerial();
    for (byte i = 0; i < 6; i++) {
      key.keyByte[i] = 0xFF;
    }
    Serial.println();
    Serial.println(F("This code scans the MIFARE Classic NUID."));
    Serial.print(F("Using the following key: "));
    printHex(key.keyByte, MFRC522::MF_KEY_SIZE);
  }


  void loop() {
    if (WiFi.status() != WL_CONNECTED) {
      Serial.println("WiFi Disconnected");
      return;
    }
    // Reset the loop if no new card present on the sensor/reader. This saves the entire process when idle.
    if (!rfid.PICC_IsNewCardPresent())
      return;
    // Verify if the NUID has been read
    if (!rfid.PICC_ReadCardSerial())
      return;
    Serial.print(F("PICC type: "));
    MFRC522::PICC_Type piccType = rfid.PICC_GetType(rfid.uid.sak);
    Serial.println(rfid.PICC_GetTypeName(piccType));
    // Check if the PICC is of Classic MIFARE type
    if (piccType != MFRC522::PICC_TYPE_MIFARE_MINI &&
        piccType != MFRC522::PICC_TYPE_MIFARE_1K &&
        piccType != MFRC522::PICC_TYPE_MIFARE_4K) {
      Serial.println(F("Your tag is not of type MIFARE Classic."));
      return;
    }
    if (rfid.uid.uidByte[0] != nuidPICC[0] ||
        rfid.uid.uidByte[1] != nuidPICC[1] ||
        rfid.uid.uidByte[2] != nuidPICC[2] ||
        rfid.uid.uidByte[3] != nuidPICC[3]) {
      Serial.println(F("A new card has been detected."));
      // Store NUID into nuidPICC array
      for (byte i = 0; i < 4; i++) {
        nuidPICC[i] = rfid.uid.uidByte[i];
      }
      Serial.println(F("The NUID tag is:"));
      Serial.print(F("In hex: "));
      printHex(rfid.uid.uidByte, rfid.uid.size);
      Serial.println();
      Serial.print(F("In dec: "));
      printDec(rfid.uid.uidByte, rfid.uid.size);
      Serial.println();
      HTTPClient http;    // Declare object of class HTTPClient
      String UIDresultSend, postData;
      UIDresultSend = String(rfid.uid.uidByte[0]) + String(rfid.uid.uidByte[1]) + String(rfid.uid.uidByte[2]) + String(rfid.uid.uidByte[3]);
      // Data to be sent
      postData = "apikey=" +  String(apiKeyValue) + "&idcard=" + UIDresultSend;
      http.begin(client,"http://192.168.137.1/CheckInDaiHoiV/connect.php");  // Specify request destination
      http.addHeader("Content-Type", "application/x-www-form-urlencoded"); // Specify content-type header
      int httpCode = http.POST(postData);   // Send the requests
      String payload = http.getString();    // Get the response payload                     
      Serial.println(postData);
      Serial.print("code return: ");
      Serial.println(httpCode);   // Print HTTP return code
      Serial.println(payload);    // Print request response payload
      http.end();  // Close connection
    }
    else {
      Serial.println(F("Card read previously."));
    }
    // Halt PICC
    rfid.PICC_HaltA();
    // Stop encryption on PCD
    rfid.PCD_StopCrypto1();
    Serial.println("---------------------------------------");  
  }

  /**
  * Helper routine to dump a byte array as hex values to Serial.
  */
  void printHex(byte *buffer, byte bufferSize) {
    for (byte i = 0; i < bufferSize; i++) {
      Serial.print(buffer[i] < 0x10 ? " 0" : " ");
      Serial.print(buffer[i], HEX);
    }
  }

  /**
  * Helper routine to dump a byte array as dec values to Serial.
  */
  void printDec(byte *buffer, byte bufferSize) {
    for (byte i = 0; i < bufferSize; i++) {
      Serial.print(buffer[i] < 0x10 ? " 0" : " ");
      Serial.print(buffer[i], DEC);
    }
  }
