// PROGRAMA DENOMINADO programa1.ino
// PARA CAPTURAR DATOS DE LOS SENSORES
// Y ENVIAR A UNA BASE DE DATOS EN UN SERVIDOR WEB.

#include "WiFi.h"
#include "DHT.h"
#define DHTPIN 15     // El número que se le debe asignar a DHTPIN debe ser el número del pin GPIO de la tarjeta ESP32 que se utilice para conectar el sensor DHT22.
#define PIN_DIGITAL_RAIN_SENSOR 23     //Pin asignado al sensor de lluvia
#define PinAnalogico  //
#define DHTTYPE DHT22   // DHT 22  (AM2302), AM2321

DHT dht(DHTPIN, DHTTYPE);
const char* ssid     = "Muñoz Garces";      // SSID
const char* password = "antonia14";      // Password
const char* host = "ehealth.gq";  // Dirección IP local o remota, del Servidor Web
const int   port = 80;            // Puerto, HTTP es 80 por defecto, cambiar si es necesario.
const int   watchdog = 2000;        // Frecuencia del Watchdog
unsigned long previousMillis = millis();

String dato;
String cade;
String line;

int gpio5_pin = 5; // El GPIO5 de la tarjeta ESP32, corresponde al pin D5 identificado físicamente en la tarjeta. Este pin será utilizado para una salida de un LED.
int gpio15_pin =15;// Pin empleado para la salida de un led del sensor de lluvia
int ID_TARJ=3; // Este dato identificará cual es la tarjeta que envía los datos, tener en cuenta que se tendrá más de una tarjeta.
              // Se debe cambiar el dato (a 2,3,4...) cuando se grabe el programa en las demás tarjetas.


void setup() {
  pinMode(gpio5_pin, OUTPUT);
  pinMode(gpio15_pin, OUTPUT);
  Serial.begin(115200);
  Serial.print("Conectando a...");
  Serial.println(ssid);

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  dht.begin();

  Serial.println("");
  Serial.println("WiFi conectado");
  Serial.println("Dirección IP: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  unsigned long currentMillis = millis();

  // Reading temperature or humidity takes about 250 milliseconds!
  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
  float h = dht.readHumidity();
  // Read temperature as Celsius (the default)
  float t = dht.readTemperature();
  // Sensor detecta presencia de lluvia
  boolean l= digitalRead(23);

  Serial.print("Humidity: ");
  Serial.print(h);
  Serial.print(" %\t");
  Serial.print("Temperature: ");
  Serial.print(t);
  Serial.print(" *C ");
  Serial.print("Lluvia:  ");
  Serial.print(l);



  digitalWrite(gpio5_pin, LOW);
  digitalWrite(gpio15_pin,LOW);

  if ( currentMillis - previousMillis > watchdog ) {
    previousMillis = currentMillis;
    WiFiClient client;

    if (!client.connect(host, port)) {
      Serial.println("Conexión falló...");
      return;
    }

    String url ="/ehealth/procesos/nuevo_registro.php?humedad=";
    url += h;
    url += "&temperatura=";
    url += t;
    url += "&ID_TARJ=";
    url += ID_TARJ;
    url +="&lluvia=";
    url += !l;



    // Envío de la solicitud al Servidor
    client.print(String("POST ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Connection: close\r\n\r\n");
    unsigned long timeout = millis();
    while (client.available() == 0) {
      if (millis() - timeout > 5000) {
        Serial.println(">>> Superado tiempo de espera!");
        client.stop();
        return;
      }
    }

    // Lee respuesta del servidor
    while(client.available()){
      line = client.readStringUntil('\r');
      Serial.print(line);
    }
      digitalWrite(gpio5_pin, HIGH);
      digitalWrite(gpio15_pin, HIGH);
      Serial.print("Dato ENVIADO");
      delay(4000);

  }
}
