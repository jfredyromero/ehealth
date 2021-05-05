// PROGRAMA EHEALTH, INTEGRA LOS SENSORES DTH22, NEO 6 Y SENSOR DE LLUVIA

//-----------------------------DECLARACIÓN DE PUERTOS Y LIBRERÍAS--------------------------------------
#include "WiFi.h"
#include "DHT.h"
#include <splash.h>
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <TinyGPS++.h>                                  // Libreria Tiny GPS Plus para el uso del GPS Ublox Neo 6M
#include <SoftwareSerial.h>
#define DHTPIN 14                                      // El número que se le debe asignar a DHTPIN debe ser el número del pin GPIO de la tarjeta ESP32 que se utilice para conectar el sensor DHT22.
#define PIN_DIGITAL_RAIN_SENSOR 27                    //Pin asignado al sensor de lluvia
#define PinAnalogico
#define DHTTYPE DHT22                                // DHT 22  (AM2302), AM2321
#define OLED_RESET 4
Adafruit_SSD1306 display(128, 64, &Wire, OLED_RESET);

DHT dht(DHTPIN, DHTTYPE);
const char* ssid     = "LAS BELLAS";                             // SSID
const char* password = "3127828497";                   // Password
const char* host = "ehealth.gq";                    // Dirección IP local o remota, del Servidor Web
const int   port = 80;                                 // Puerto, HTTP es 80 por defecto, cambiar si es necesario.
const int   watchdog = 2000;                          // Frecuencia del Watchdog
unsigned long previousMillis = millis();
String estado;
int miestado;
String dato;
String cade;
String line;

static const int RXPin = 18, TXPin = 19;                // Definición de pines del GPS 2 RX y 4 TX
static const uint32_t GPSBaud = 9600;                  // Tasa de transmisión por defecto del Ublox GPS: 9600

TinyGPSPlus gps;                                       // Crea una instancia del objeto TinyGPS++ que se denomina gps
SoftwareSerial ss(RXPin, TXPin);                      // Determina la conexión serial con el GPS en los pines ya definidos, 2 y 4.

//--------------------------------------IDENTIFICADOR DE TARJETA-----------------------------------------------
int ID_TARJ = 3;                                    // Este dato identificará cual es la tarjeta que envía los datos, tener en cuenta que se tendrá más de una tarjeta.
// Se debe cambiar el dato (a 2,3,4...) cuando se grabe el programa en las demás tarjetas.

//--------------------------------------COMIENZA EL CÓDIGO-----------------------------------------------------
static void smartDelay(unsigned long ms)                // Un tipo de retraso que asegura la operación del gps
{
  unsigned long start = millis();
  do
  {
    while (ss.available())
      gps.encode(ss.read());
  } while (millis() - start < ms);
}

void setup() {
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
  //---------------------------------------CODIGO OLED-----------------------------------------

  display.begin(SSD1306_SWITCHCAPVCC, 0x3C); //or 0x3C
  display.clearDisplay();                               // Borra lo presentado en el display OLED
  display.setTextSize(1);                               // Fija el tamaño del texto en el display OLED
  display.setTextColor(WHITE);                          // Fija el color del texto
  display.setCursor(0, 0);                              // Fija el cursor en la posición 0,0 del display
  display.println("Localizacion por GPS");
  display.println(TinyGPSPlus::libraryVersion());
  // Actualiza el display, para que lo que se ha enviado hasta el momento, después de borrar, se presente en pantalla.
  delay(2500);                                          // Pausa de 2,5 segundos, para poder ver lo presentado en pantalla
  display.clearDisplay();                                      // Borra lo presentado en el display OLED
  display.setCursor(0, 0);                              // Fija el cursor en la posición 0,0 del display
  display.println("Conectando a...");
  display.display();
  display.println(ssid);
  display.display();
  // Actualiza el display, para que lo que se ha enviado hasta el momento, después de borrar, se presente en pantalla.
  delay(1500);                                          // Pausa de 1,5 segundos, para poder ver lo presentado en pantalla
  WiFi.begin(ssid, password);                           // Inicializa la conexión WiFi de la tarjeta ESP8266 12E
  display.clearDisplay();                                      // Borra lo presentado en el display OLED
  display.setCursor(0, 0);                              // Fija el cursor en la posición 0,0 del display
  display.print("Esperando conexion WiFi");
  display.display();
  // Actualiza el display, para que lo que se ha enviado hasta el momento, después de borrar, se presente en pantalla.
  while (WiFi.status() != WL_CONNECTED) {               // Espera a que se establezca la conexión con el WiFi, mientras tanto va presentando "puntos", hasta que se conecte.
    display.print(".");
    display.display();                                  // Actualiza el display, para que se vayan presentado los "puntos" de espera en pantalla.
    delay(500);
  }
  display.setCursor(0, 0);                              // Fija el cursor en la posición 0,0 del display
  display.clearDisplay();                                      // Borra lo presentado en el display OLED
  display.println("");
  display.display();
  display.println("WiFi conectado");
  display.display();
  display.println("Direccion IP: ");
  display.display();
  display.println(WiFi.localIP());                      // Envía al display la IP asignada
  display.display();
  // Actualiza el display, para que lo que se ha enviado hasta el momento, se presente en pantalla.
  delay(2000);                                          // Pausa de 2 segundos, para poder ver lo presentado en pantalla
  ss.begin(GPSBaud);                                    // Fija la velocidad del Puerto serial creado a 9600
}

void loop() {
  unsigned long currentMillis = millis();

 //---------------------------------------CODIGO DTH-----------------------------------------
  // Reading temperature or humidity takes about 250 milliseconds!
  // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
  float h = dht.readHumidity();
  // Read temperature as Celsius (the default)
  float t = dht.readTemperature();
  // Sensor detecta presencia de lluvia
  boolean l = digitalRead(PIN_DIGITAL_RAIN_SENSOR);

  Serial.print("Humidity: ");
  Serial.print(h);
  Serial.print(" %\t");
  Serial.print("Temperature: ");
  Serial.print(t);
  Serial.print(" *C ");
  Serial.print("Lluvia:  ");
  Serial.print(l);



  if ( currentMillis - previousMillis > watchdog ) {
    previousMillis = currentMillis;
    WiFiClient client;

    if (!client.connect(host, port)) {
      Serial.println("Conexión falló...");
      return;
    }
//---------------------------------------CODIGO VERIFICACIÓN DE ESTADO-----------------------------------------
String url2 = "/ehealth/procesos/validar_estado.php?id_tarj=";
      url2 += ID_TARJ;
      // Envío de la solicitud al Servidor
      client.print(String("GET ") + url2 + " HTTP/1.1\r\n" +
                   "Host: " + host + "\r\n" +
                   "Connection: close\r\n\r\n");
      unsigned long timeout = millis();
      while (client.available() == 0) {
        if (millis() - timeout > 5000) {
          Serial.println(">>> Superado tiempo de espera 1!");
          return;
        }
      }

      // Lee respuesta del servidor
      while (client.available()) {
        line = client.readStringUntil('\r');
        Serial.print(line);
      }
      int longitud = line.length();
      int longitud_f = longitud;
      longitud = longitud - 1;

      estado = line;
      cade = "Dato recibido es...";
      cade += estado;
      Serial.print(cade);


      char cadena[estado.length() + 1];
      estado.toCharArray(cadena, estado.length() + 1);
      miestado = atoi(cadena);

    if (!client.connect(host, port)) {
      Serial.println("Conexión falló...");
      return;
    }
//---------------------------------------CODIGO GPS-----------------------------------------
    double lati;
    double longi;
    display.clearDisplay();
    display.setCursor(0, 0);
    lati = gps.location.lat();                            // Obtiene el valor de latitud del GPS.
    int lat_entero;                                       // Las siguientes lineas son para almacenar en una variable el componente entero y en otra variable el componente decimal de la latitud
    int lat_decimal;                                      // para unirlos posteriormente, ya que si se deja todo en una sola variable, lo deja por defecto en dos decimales, lo cual no es suficiente
    int lat_entero_abs;                                   // para obtener una buena ubicación en un mapa. También se maneja una variable para valor absoluto, en casos de valores negativos.
    lat_entero = int(lati);
    lat_entero_abs = abs(lat_entero);
    lat_decimal = int((abs(lati) - lat_entero_abs) * 100000);
    if (lat_entero == 0)                                  // Se coloca éste condicional para que cuando el GPS apenas ha iniciado, no envíe valores de ubicación con 0, a la base de datos
    {
      display.print("Esperando obtener datos del GPS...");  // en caso de que los valores recibidos del GPS de latitud sean 0, presenta en pantalla que está esperando obtener datos del GPS.
      display.display();                                    // Actualiza el display para mostrar el mensaje.
      delay (1000);
      display.clearDisplay();
      // Actualiza el display para mostrar la pantalla limpia.
      delay (1000);
    }
    else
    {
      display.print("Latit   : ");                         // Envía a la pantalla (sin presentarlo aún, porque no hay update) el valor de latitud medido por el GPS.
      display.display();
      display.println(lati, 5);
      display.display();
      display.print("Longit  : ");
      display.display();
      longi = gps.location.lng();                          // Obtiene el valor de longitud del GPS.
      int lon_entero;                                      // Las siguientes lineas son para almacenar en una variable el componente entero y en otra variable el componente decimal de la longitud
      int lon_decimal;                                     // para unirlos posteriormente, ya que si se deja todo en una sola variable, lo deja por defecto en dos decimales, lo cual no es suficiente
      int lon_entero_abs;                                  // para obtener una buena ubicación en un mapa. También se maneja una variable para valor absoluto, en casos de valores negativos.
      lon_entero = int(longi);
      lon_entero_abs = abs(lon_entero);
      lon_decimal = int((abs(longi) - lon_entero_abs) * 100000);
      display.println(longi, 5);
      display.display();
      display.print("Satelit : ");                         // Envía a la pantalla (sin presentarlo aún, porque no hay update) el valor del # de satelites medido por el GPS.
      display.display();
      display.println(gps.satellites.value());
      display.display();
      display.print("Altitud : ");                         // Envía a la pantalla (sin presentarlo aún, porque no hay update) el valor de altitud en metros, medido por el GPS.
      display.display();
      display.print(gps.altitude.meters());
      display.display();
      display.println("mts");
      display.display();
      display.print("Hora/Min: ");                         // Envía a la pantalla (sin presentarlo aún, porque no hay update) el valor de hora, minutos y segundos, medido por el GPS.
      display.display();
      display.print(gps.time.hour());
      display.display();
      display.print(":");
      display.display();
      display.print(gps.time.minute());
      display.display();
      display.print(":");
      display.display();
      display.println(gps.time.second());
      display.display();
      display.print("Velocid : ");
      display.display();
      display.print(gps.speed.kmph());                     // Envía a la pantalla (sin presentarlo aún, porque no hay update) el valor de velocidad, calculado por el GPS.
      display.display();
      display.println(" km/h");
      display.display();
      display.print("Humedad : ");
      display.display();
      display.print(h);                                   // Envía a la pantalla el valor de la humedad
      display.display();
      display.print("      ");
      display.display();
      display.print("Tempera : ");
      display.display();
      display.print(t);                                   // Envía a la pantalla el valor de la temperatura
      display.display();

      // Actualiza la pantalla para mostrar lo que se ha enviado hasta el momento y presenta un retardo, para poder visualizarlo.
      delay(3000);

      if (!client.connect(host, port)) {
        Serial.print(line);
        display.setCursor(0, 0);                           // Si hay error en la conexión con el servidor web, se presenta un error de conexión fallida.
        display.clearDisplay();
        display.println("Conex. fallida al servidor...");
        display.display();
        delay(1000);
        return;
      }
 //---------------------------------------CODIGO SI EL ESTADO ES ACTIVO-----------------------------------------
      if (miestado == 1) {
        Serial.println("El estado es activo");
        String url = "/ehealth/procesos/nuevo_registro.php?humedad="; //URL ARCHIVO PHP
        url += h;
        url += "&temperatura=";
        url += t;
        url += "&ID_TARJ=";
        url += ID_TARJ;
        url += "&lluvia=";
        url += !l;
        url += "&latitud=";
        url += lat_entero;
        url += ".";
        url += lat_decimal;
        url += "&longitud=";
        url += lon_entero;
        url += ".";
        url += lon_decimal;
        url += "&velocidad=";
        url += gps.speed.kmph();
        url += "&altitud=";
        url += gps.altitude.meters();



        // Envío de la solicitud al Servidor
        client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                     "Host: " + host + "\r\n" +
                     "Connection: close\r\n\r\n");

          unsigned long timeout2 = millis();
          while (client.available() == 0) {
          if (millis() - timeout2 > 5000) {
            Serial.println(">>> Superado tiempo de espera!");
            client.stop();
            return;
          }
          }


        // Lee respuesta del servidor
        while (client.available()) {
          line = client.readStringUntil('\r'&'\n');
          Serial.print(line);
        }

        Serial.print("Dato ENVIADO");
        display.clearDisplay();
        display.setCursor(0, 0);
        display.print("Dato enviado...");
        display.display();
        delay(4000);
      }

 //---------------------------------------CODIGO SI EL ESTADO ES INACTIVO-----------------------------------------
      else {
        Serial.println("El estado es inactivo");
      }

    }
  }
    smartDelay(500);                                      // Ejecuta un retardo especial, para saber si hay o no respuesta del GPS.
    if (millis() > 5000 && gps.charsProcessed() < 10) {
      display.println(F("No GPS data received: check wiring"));
      display.display();
    }  // finaliza función loop
  }
