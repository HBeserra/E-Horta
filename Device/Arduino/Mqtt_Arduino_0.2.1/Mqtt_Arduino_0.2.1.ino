//================= Bibliotecas
#include <SPI.h>
#include <Ethernet.h>
#include <PubSubClient.h>

//================= Configurações
#define ID "5a7dfc913caee"
#define Token "5484ee184dc9df4adb2df5a05d350fea"
#define server "192.168.1.3"
#define serverPort 1883

//================= Definições
#define led 8
#define button 2
boolean buttonA = false;
char EstadoSaida = '0';
//================= Ethernet
// Update these with values suitable for your network.
byte mac[] = {0xDE, 0xED, 0xBA, 0xFE, 0xFE, 0xED};

EthernetClient ethClient;
PubSubClient client(ethClient);

void setup()
{
  Serial.begin(57600);
  Serial.println(ID " - " Token);

  pinMode(button, INPUT_PULLUP);
  pinMode(led, OUTPUT);
   
  client.setServer(server, serverPort);
  client.setCallback(callback);

  Ethernet.begin(mac);
  // Allow the hardware to sort itself out
  delay(1500);
}

void loop()
{
  if (!client.connected()) {
    reconnect();
  }
  int sensorVal = digitalRead(button);
 if(sensorVal == LOW){
  if(buttonA != LOW){
   client.publish((ID "/outTopic"), ("K" Token));
  Serial.println("buttonHIGH");
  }
   }
  if(sensorVal == HIGH){
  if(buttonA != HIGH){
    client.publish((ID "/outTopic"), "0");
  Serial.println("buttonLOW");
  
  }
   }
   buttonA = sensorVal;
  client.loop();
}

void reconnect() {
  // Loop until we're reconnected
  while (!client.connected()) {
    Serial.print("Attempting MQTT connection...");
    // Attempt to connect
    if (client.connect("arduinoClient" ID)) {
      Serial.println("connected");
      // Once connected, publish an announcement...
      client.publish((ID "/outTopic"),"hello world");
      // ... and resubscribe
      client.subscribe(ID "/inTopic");
      client.subscribe(ID "/status");
      client.subscribe(ID);


    } else {
      Serial.print("failed, rc=");
      Serial.print(client.state());
      Serial.println(" try again in 5 seconds");
      // Wait 5 seconds before retrying
      delay(5000);
    }
  }
}

void callback(char* topic, byte* payload, unsigned int length) {
  String msg;
  for(int i = 0; i < length; i++)
    {
       char c = (char)payload[i];
       msg += c;
    }
  Serial.print(msg);

  if (msg.equals("1"))
    {
        digitalWrite(led, HIGH);
        EstadoSaida = '1';
    }

    //verifica se deve colocar nivel alto de tensão na saída D0:
    if (msg.equals("0"))
    {
        digitalWrite(led, LOW);
        EstadoSaida = '0';
    }
}
