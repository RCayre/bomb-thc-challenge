#include <Adafruit_GFX.h>   
#include <Adafruit_TFTLCD.h>
// On envoie le sha1 et non la chaîne xorée directement, car les données sont trop longues pour la liaison Serial

#define BLACK   0x0000
#define BLUE    0x001F
#define RED     0xF800
#define GREEN   0x07E0
#define CYAN    0x07FF
#define MAGENTA 0xF81F
#define YELLOW  0xFFE0
#define WHITE   0xFFFF

#define START 3599

Adafruit_TFTLCD tft;
unsigned int colors[8] = {BLACK,BLUE,RED,GREEN,CYAN,MAGENTA,YELLOW,WHITE};
int background_color = 0;
int foreground_color = 1;
int compteur = START;
int continuer = true;

void setup(void) {
  Serial.begin(9600);
  tft.reset();

  uint16_t identifier = tft.readID();
  tft.begin(identifier);

  tft.fillScreen(BLACK);
}
unsigned int getBackgroundColor() {
    return colors[background_color];
}
unsigned int getForegroundColor() {
    return colors[foreground_color];
}
void changeBackgroundColor() {
    background_color = (background_color+1)%8;
}
void changeForegroundColor() {
    foreground_color = (foreground_color+1)%8;
}
void displayTime(int number) {
    char *test = malloc(6);
    if (number==0) {
      sprintf(test, "BOOM!");  
      continuer = false;
    }
    else {
      int minutes = number / 60;
      int secondes = number % 60;
      sprintf(test, "%02d:%02d",minutes,secondes);
    }
    tft.fillScreen(getBackgroundColor());
    tft.setRotation(3);
    tft.setCursor(30, 70);
    tft.setTextColor(getForegroundColor());
    tft.setTextSize(9);
    Serial.println(test);
    tft.println(test);
    // Eviter un dépassement de mémoire en nettoyant les objets alloués dans le tas
    free(test);
}

String readSerialCommand() {
      String cmd ="";
      if (Serial.available() >0) {
        while (Serial.available() >0) {
          char c = Serial.read();
          cmd += c; 
      }
    }
    return cmd;
}
// Note : le protocole est en clair pour l'instant, ce ne sera pas le cas dans la version finale
void executeCommand(String cmd) {
   if (cmd.length()>0) {
   Serial.println(cmd);
   
  if (cmd == "6aad8ea9ef6c749f67ff40a9a7866f0bdfc85f2c") { //CHANGE_BGCOLORZESECRET
    changeBackgroundColor();    
  }
  else if (cmd == "7e16590b049220113aae2d35f2249b75b7e80eda") { //CHANGE_FGCOLORZESECRET
    changeForegroundColor();
  }
  else if (cmd == "3596173f163f3cabf68cbe1bef8ed24737aceb76") { //STARTZESECRET
    compteur = START;
    continuer = true;
  }
  else if (cmd == "2a8f369ee664cb6e7e975c15e783a9e840a62c6a") { //STOPZESECRET
    continuer = false;
    Serial.println("YOU WIN !");
  }
  }
}
void loop(void) {
    String cmd = readSerialCommand();
    executeCommand(cmd);
    if (continuer) {
      displayTime(compteur--);
    }
    delay(1000);
    // Eviter un débordement de RAM en nettoyant le buffer de sortie
    Serial.flush();
}

