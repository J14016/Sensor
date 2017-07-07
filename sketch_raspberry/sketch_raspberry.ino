
int val = 0;

void setup() {
  Serial.begin(9600);
  establishConnection();
}

void establishConnection()
{
  while(Serial.available() > 0)
  {
    Serial.println("1");
    delay(300);
  }

  Serial.read();
}


void loop() {

  if (Serial.available() > 0)
  {
    Serial.read();
    
    val = analogRead(0);
    Serial.print(val);
    Serial.print('\n');
    
  }
}

